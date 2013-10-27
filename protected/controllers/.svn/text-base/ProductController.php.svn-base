<?php
class ProductController extends BaseController
{
    /**
     * @author leo.yan
     * @copyright zxy 2013-06
     */
     public $layout = '//layouts/property.base';
    public $goods_id = 0;
     /** 过滤器 **/
    public function filters()
    {
        return array(
            'accessControl',
            );
    }
    /** 限制操作者 **/
    public function accessRules()
    {
        return array(
            array('allow', 'actions'=>array('test','detail','showCalendar','ajaxPostReview','ajaxPostReviewHelpful','ajaxPostReviewReply', 'ajaxPostQualification'),'users'=>array('*')),
            //array('allow', 'expression' => '!$user->isGuest and $user->business_id>0'),
            array('allow', 'expression' => '!$user->isGuest'),
            array('deny'),
            );
    }

     private function getNoteShow($product_id)
     {
        $modelNote = ProductNote::model()->findByAttributes(array("product_id" => $product_id));
                if ($modelNote === null)
                {
                    $modelNote = new ProductNote;
                    $array_default = array(
                        'product_id' => $product_id,
                        'max_per_day_num_for_adults' => 30,
                        'max_per_day_num_for_kids' => 5,
                        'min_age_for_kids' => 16,
                        'max_hotle_booking' => 15,
                        'max_room_for_adults' =>4,
                        'max_room_for_kids' => 2,
                        'max_room_bed' => 2);
                    $modelNote->attributes = $array_default;
                    $modelNote->save();
                }
           return $this->renderPartial('_new_set_jion',array('note'=>$modelNote),true);
     }

    /**
     * 基本信息添加
     */
    public function actionCreate()
    {

        $model = new Product;
        $goods = new Goods;
        $productImages = array();//array_fill(0, 3, '');
        $mname = new ProductAddendum; //产品附属性
        $mscity = new ProductStartCity; //开始城市
        $mecity = new ProductEndCity; //结束的城市

        if(Yii::app()->request->isAjaxRequest || $_POST )
        {

             $respon = array("state"=>'0','data'=>"","reason"=>"提交数据不完整");
             //die(json_encode($respon));
                /** 提交验证处理**/
               // if (isset($_POST['Product']) && isset($_POST['ProductAddendum']) && isset($_POST['ProductDescription']) && isset($_POST['ProductImages'])&& isset($_POST['vcity'])&& isset($_POST['acity']) )
                if (isset($_POST['Product']) && isset($_POST['ProductAddendum']) && isset($_POST['ProductDescription']) && isset($_POST['ProductImages'])&& isset($_POST['vcity']) )
                {

                    // 验证
                    $model->attributes = $_POST['Product'];

                    $ptype = ProductType::model()->findByPk($model->product_type_id);
                    if($ptype == null)
                    {
                        $respon['reason'] = "错误的行程类型";
                        die(json_encode($respon));
                    }
                    if(!preg_match("/^\d*$/",$model->duration))
                    {
                        $respon['reason'] = "持续时间有误";
                        die(json_encode($respon));
                    }
                    if(! in_array($model->duration_type,array("days","hours")))
                    {
                        $respon['reason'] = "持续时间类型有误";
                        die(json_encode($respon));
                    }
                    /*
                    if(!preg_match('/^([1-9]\d{1,7}|\d)(\.\d{1,2})?$/',$model->price))
                     {
                         $respon['reason'] = "基本价格有误";
                        die(json_encode($respon));
                     }
                     */

                    $startC = City::model()->findByPk((int)$_POST['start_id']);

                    if($startC == null)
                    {
                        $respon['reason'] = "起始城市有误";
                        die(json_encode($respon));
                    }
                    $endC = City::model()->findByPk((int)$_POST['end_id']);

                    if($endC == null)
                    {
                        $respon['reason'] = "结束城市有误";
                        die(json_encode($respon));
                    }

                    // 途径城市 验证

                    $v_citys = $_POST['vcity'];
                    $visitcityStr = $v_citys ? implode(',',$v_citys):"0";
                    //$visitcityStr = trim($_POST['visitcityId'],'{L}');
                    //$visitcityStr = str_ireplace("{L}",',',$visitcityStr);
                    $visitcityStr = trim($visitcityStr,',');


                    $hasVisitCitys = City::model()->findAll(array('condition'=>"city_id in ($visitcityStr)"));

                    if(is_null($hasVisitCitys))
                    {

                         $respon['reason'] = "请选择途径城市";
                        die(json_encode($respon));
                    }


                    // 景点验证
                    $a_citys = $_POST['acity'];
                    $attractcityStr = $a_citys ? implode(',',$a_citys):'0';
                    //$attractcityStr= trim($_POST['attractcityId'],'{L}');
                    //$attractcityStr = str_ireplace("{L}",',',$attractcityStr);
                    $attractcityStr = trim($attractcityStr,',');

                    $hasAttraCitys = Attraction::model()->findAll(array('condition'=>"attraction_id in ($attractcityStr)"));

                    if(is_null($hasAttraCitys))
                    {
                        //$respon['reason'] = "请选择途径景点";
                        //die(json_encode($respon));
                    }



                    if($model->duration_type == 'days')
                    {
                        if($model->duration == '1')
                        {
                            $model->entity_type = '1';//1日游
                        }
                        else
                        {
                            $model->entity_type = '2';//多日游
                        }
                    }
                    else
                    {
                          $model->entity_type = '3';//小时游
                    }


                     $mname->attributes = $_POST['ProductAddendum'];

                     if(!$mname->title)
                     {

                        $respon['reason'] = "产品名字不能为空";
                        die(json_encode($respon));
                     }
                     if(!$mname->description)
                     {
                        $respon['reason'] = "产品描述不能为空";
                        die(json_encode($respon));
                     }

                     //print_r($_POST);die;

                     if(count($_POST['ProductImages']['path'])<3 || count($_POST['ProductImages']['title'])<3)
                     {
                        $respon['reason'] = "请至少上传3张产品图片";
                        die(json_encode($respon));
                     }
                     // 行程描述 验证
                     if($model->entity_type == '1')
                     {
                        // one day tours
                        if(!$_POST['ProductDescription'][1]['name'])
                        {
                            $respon['reason'] = "行程概述不能为空";
                            die(json_encode($respon));
                        }
                        if(!$_POST['ProductDescription'][1]['description'])
                        {
                            $respon['reason'] = "行程详情不能为空";
                            die(json_encode($respon));
                        }
                        if(!$_POST['ProductDescription'][1]['url_path'])
                        {
                            $respon['reason'] = "请至少上传一张行程图片";
                            die(json_encode($respon));
                        }

                     }
                     elseif($model->entity_type == '2')
                     {
                        // muit day tours

                        for($i=1;$i<=$model->duration;$i++)
                        {

                                if(!$_POST['ProductDescription'][$i]['name'])
                                {

                                     $respon['reason'] = "第".$i."天行程概述不能为空";
                                    die(json_encode($respon));
                                }
                                if(!$_POST['ProductDescription'][$i]['description'])
                                {

                                     $respon['reason'] = "第".$i."天行程详情不能为空";
                                    die(json_encode($respon));
                                }
                                if(!$_POST['ProductDescription'][$i]['url_path'])
                                {
                                     $respon['reason'] = "第".$i."天至少上传一张行程图片";
                                    die(json_encode($respon));
                                }
                        }


                     }
                     elseif($model->entity_type == '3')
                     {

                          for($i=1;$i<=$model->duration;$i++)
                        {

                                if(!$_POST['ProductDescription'][$i]['hour']['name'])
                                {

                                     $respon['reason'] = "第".$i."段行程概述不能为空";
                                    die(json_encode($respon));
                                }
                                if(!$_POST['ProductDescription'][$i]['hour']['description'])
                                {

                                     $respon['reason'] = "第".$i."段行程详情不能为空";
                                    die(json_encode($respon));
                                }
                                if(!$_POST['ProductDescription'][$i]['hour']['url_path'])
                                {
                                     $respon['reason'] = "第".$i."段至少上传一张行程图片";
                                    die(json_encode($respon));
                                }
                        }


                     }

                     //酒店及验证
                     if($model->entity_type == '2')
                     {
                        // 必须填写酒店信息
                         if(isset($_POST['ProductHotel']) && isset($_POST['HotelImages']))
                         {
                            $ct_hotel = Count($_POST['ProductHotel']);
                            for($i=1;$i<=$ct_hotel;$i++)
                            {
                                if(empty($_POST['ProductHotel'][$i]['name']))
                                {
                                     $respon['reason'] = "区段酒店名字不能为空";
                                     die(json_encode($respon));
                                }
                                if(empty($_POST['ProductHotel'][$i]['desc']))
                                {
                                     $respon['reason'] = "区段酒店描述不能为空";
                                     die(json_encode($respon));
                                }
                                if(count($_POST['HotelImages'][$i]['path'])<1)
                                {
                                     $respon['reason'] = "区段酒店至少上传一张图片";
                                     die(json_encode($respon));
                                }
                            }
                         }
                         elseif(!isset($_POST['HotelImages']))
                         {
                             $respon['reason'] = "区段酒店至少上传一张图片";
                             die(json_encode($respon));
                         }
                         else
                         {
                             $respon['reason'] = "酒店相关信息不能为空";
                             die(json_encode($respon));
                         }

                     }




                     // 验证完毕 保存

                    $_t = time();
                    $temp_goods = array();
                    $temp_goods['entity_type'] = Goods::ENTITY_PRODUCT;
                    $temp_goods['price'] = 0.00;
                    $temp_goods['is_active'] = 1;//编辑中
                    $temp_goods['customer_id'] = Yii::app()->user->customer_id;
                    $temp_goods['created'] = $_t;

                    $goods->attributes = $temp_goods;
                    $goods->save(false);
                    //$goods->price = $model->price;
                    $goods->code = Goods::GOODS_CODE_PRRIX.$goods->goods_id;
                    $goods->save(false);
                    $model->goods_id = $goods->goods_id;
                    $model->step = Product::$_STEP[1];
                     //商品保存
                     if($model->save())
                     {
                            // 商品附属性保存
                            $mname->product_id = $model->product_id;
                            $mname->language = Yii::app()->language;
                            $mname->save(false);

                            //商品相册保存
                            $i = 0;
                            foreach($_POST['ProductImages']['title'] as $v)
                            {
                                $imageObj = new ProductImage;
                                $imageObj->path = $_POST['ProductImages']['path'][$i];
                                $imageObj->note = $v;
                                $imageObj->product_id = $model->product_id;
                                $imageObj->save(false);
                                $i++;
                            }

                            // 开始城市
                            $mscity->city_id = $_POST['start_id'];
                            $mscity->product_id = $model->product_id;
                            $mscity->save(false);

                            // 结束城市
                            $mecity->city_id = $_POST['end_id'];
                            $mecity->product_id = $model->product_id;
                            $mecity->save(false);

                            // 途径城市
                            foreach($hasVisitCitys as $city)
                            {
                                $productVisitCity = new ProductVisitingCity;
                                $productVisitCity->city_id = $city->city_id;
                                $productVisitCity->product_id = $model->product_id;
                                $productVisitCity->save(false);
                            }


                            // 途径景点
                            if($hasAttraCitys)
                            {
                                foreach($hasAttraCitys as $attract)
                                {
                                    $productAttraction = new ProductAttraction;
                                    $productAttraction->attraction_id = $attract->attraction_id;
                                    $productAttraction->product_id = $model->product_id;
                                    $productAttraction->save(false);
                                }
                            }


                            // 行程描述保存

                             if($model->entity_type == '1')
                             {

                                $descObj = new ProductDescription;
                                $descObj->product_id = $model->product_id;
                                $descObj->language = Yii::app()->language;
                                $descObj->day = 1;
                                $descObj->name = trim($_POST['ProductDescription'][1]['name']);
                                $descObj->description = trim($_POST['ProductDescription'][1]['description']);
                                $descObj->url_path = trim($_POST['ProductDescription'][1]['url_path']);
                                // one day tours
                                $descObj->save(false);

                             }
                             elseif($model->entity_type == '2')
                             {
                                // muit day tours

                                for($i=1;$i<=$model->duration;$i++)
                                {

                                        $descObj = new ProductDescription;
                                        $descObj->product_id = $model->product_id;
                                        $descObj->language = Yii::app()->language;
                                        $descObj->day = $i;
                                        $descObj->name = trim($_POST['ProductDescription'][$i]['name']);
                                        $descObj->description = trim($_POST['ProductDescription'][$i]['description']);
                                        $descObj->url_path = trim($_POST['ProductDescription'][$i]['url_path']);
                                        $descObj->save(false);
                                }


                             }
                             elseif($model->entity_type == '3')
                             {

                                 for($i=1;$i<=$model->duration;$i++)
                                {

                                        $descObj = new ProductDescription;
                                        $descObj->product_id = $model->product_id;
                                        $descObj->language = Yii::app()->language;
                                        $descObj->day = $i;
                                        $descObj->name = trim($_POST['ProductDescription'][$i]['hour']['name']);
                                        $descObj->description = trim($_POST['ProductDescription'][$i]['hour']['description']);
                                        $descObj->url_path = trim($_POST['ProductDescription'][$i]['hour']['url_path']);
                                        $descObj->save(false);
                                }


                             }

                             // 酒店描述及图片保存
                             if(isset($_POST['ProductHotel']) && isset($_POST['HotelImages']))
                             {
                                $c = 1;
                                foreach($_POST['ProductHotel'] as $v)
                                {
                                    $tempHotelObj = new ProductHotel;
                                    $tempHotelObj->product_id = $model->product_id;
                                    if($tempHotelObj->save(false))
                                    {
                                        // 多语言属性字段保存
                                        $tempHotelAddendum = new ProductHotelAddendum;
                                        $tempHotelAddendum->hotel_id = $tempHotelObj->hotel_id;
                                        $tempHotelAddendum->name = trim($v['name']);
                                        $tempHotelAddendum->description = trim($v['desc']);
                                        $tempHotelAddendum->language = Yii::app()->language;
                                        $is_ok = $tempHotelAddendum->save();

                                        if($is_ok)
                                        {
                                                // 图片保存

                                                foreach($_POST['HotelImages'][$c]['path'] as $h_img)
                                                {
                                                     $tempHotelImage = new ProductHotelImage;
                                                     $tempHotelImage->hotel_id = $tempHotelObj->hotel_id;
                                                     $tempHotelImage->path = trim($h_img);
                                                     $tempHotelImage->save();
                                                }
                                        }
                                    }

                                    $c++;
                                }

                             }


                          $respon['state'] = '1';
                          //$respon['data'] = $this->createUrl('product/fullInfo',array('id'=>$model->product_id));
                          $respon['url'] = $this->createUrl('product/msg',array('product_id'=>$model->product_id));
                          $respon['reason'] = "保存数据操作成功";
                          die(json_encode($respon));

                     }

                      $respon['reason'] = "提交数据有误,保存失败";
                      die(json_encode($respon));


                }

           if(empty($_POST['Product']) || empty($_POST['ProductAddendum']))
           {
             $respon['reason'] = '请输入完整的行程信息';
           }
           else if(empty($_POST['ProductDescription']))
           {
            $respon['reason'] = '请输入行程介绍';
           }
           else if(empty($_POST['ProductImages']))
           {
             $respon['reason'] = '请至少上传3张产品图片';
           }
           else if(empty($_POST['vcity']))
           {
             $respon['reason'] = '请选择途径城市';
           }
           else if(empty($_POST['acity']))
           {
             //$respon['reason'] = '请选择途径景点';
           }

          die(json_encode($respon));

        }

        // 行程介绍
       // $modelDesc = new ProductDescription;
       $this->params['title'] = '行程发布-个人中心-商家认证';

        $this->render('create', array(
            'model' => $model,
            'mname' => $mname,
            'mscity' => $mscity,
            'mecity' => $mecity,
            'modelType'=>$modelType,
            'productImages' => $productImages,

            ));
    }
    public function actionMsg()
    {
        $product_id = (int)Yii::app()->request->getParam('product_id');
        if(Yii::app()->user->isGuest || empty($product_id))
        $this->redirect("");
        $this->render('msg',array('url'=>$this->createUrl('product/fullInfo',array('id'=>$product_id))));
    }

    private function getMultiDayList($product_id)
    {
        $modelview = ProductMultiDayPrice::model()->findAll(array('condition'=>'product_id='.$product_id,'order'=>'_id desc','limit'=>'1'));
        $modelview2 = ProductMultiDayPriceOverride::model()->findAll(array('condition'=>'product_id='.$product_id,'order'=>'_id desc','limit'=>'1'));
        return $this->renderPartial("_mult_day_price_list",array( 'modelview' => $modelview,'modelview2' => $modelview2,'product_id'=>$product_id),true);
    }
    private function getOneDayList($product_id)
    {
        $modelview = ProductOneDayPrice::model()->findAll(array('condition'=>'product_id='.$product_id,'order'=>'_id desc','limit'=>'1'));
        $modelview2 = ProductOneDayPriceOverride::model()->findAll(array('condition'=>'product_id='.$product_id,'order'=>'_id desc','limit'=>'1'));
        return $this->renderPartial("_one_day_price_list",array( 'modelview' => $modelview,'modelview2' => $modelview2,'product_id'=>$product_id),true);
    }


    /**
     * 完善基本信息
     * *
    */
    public function actionFullInfo()
    {
        $this->params['title'] = '行程发布-个人中心-商家认证';
        $product_id = (int)Yii::app()->request->getParam('id');
        $error = array("state"=>"0",'reason'=>'填写数据有误','data'=>'');

        //验证
        $product = Product::model()->findByPk($product_id);
        //print_r($product->attributes);die;
        if($product == null )
        {
            if(Yii::app()->request->isAjaxRequest)
            {
                $error['reason'] = '无效产品';
                die(json_encode($error));
            }

            $this->redirect($this->createUrl("product/create"));
        }

        $goods = Goods::model()->findByPk($product->goods_id);

        if($goods == null)
        {
            if(Yii::app()->request->isAjaxRequest)
            {
                $error['reason'] = '无效产品';
                die(json_encode($error));
            }
           $this->redirect($this->createUrl("product/create"));
        }

        /**
        基本信息修改
         */

        if(isset($_POST['Product']) && isset($_POST['ProductAddendum']))
        {

            //print_r($_POST);die;

            // 验证
            if($product->product_id != $_POST['Product']['product_id'])
            {
                $error['reason'] ='无效产品';
                die(json_encode($error));
            }

            $product_type_id = (int)$_POST['Product']['product_type_id'];

            $ptype = ProductType::model()->findByPk($product_type_id);
            if($ptype == null)
            {
                $error['reason'] ='无效的行程类型';
                die(json_encode($error));
            }
            $product->product_type_id = $product_type_id;

            $startC = City::model()->findByPk((int)$_POST['start_id']);

            if($startC == null)
            {
                 $error['reason'] ='起始城市有误';
                die(json_encode($error));
            }
            $endC = City::model()->findByPk((int)$_POST['end_id']);

            if($endC == null)
            {
                $error['reason'] ='结束城市有误';
                die(json_encode($error));
            }

            // 途径城市 验证
            $v_citys = $_POST['vcity'];
            $visitcityStr = $v_citys ? implode(',',$v_citys):'0';
            //$visitcityStr = trim($_POST['visitcityId'],'{L}');
            //$visitcityStr = str_ireplace("{L}",',',$visitcityStr);
            $visitcityStr = trim($visitcityStr,',');
            $hasVisitCitys = null;
            if($visitcityStr)
            {
                $hasVisitCitys = City::model()->findAll(array('condition'=>"city_id in ($visitcityStr)"));
            }


            if(is_null($hasVisitCitys))
            {

                 $error['reason'] = "请选择途径城市";
                die(json_encode($error));
            }
             // 景点验证
            $a_citys = $_POST['acity'];
            $attractcityStr = $a_citys ? implode(',',$a_citys):'0';
            //$attractcityStr= trim($_POST['attractcityId'],'{L}');
            //$attractcityStr = str_ireplace("{L}",',',$attractcityStr);
            $attractcityStr = trim($attractcityStr,',');
            $hasAttraCitys = null;
            if($attractcityStr)
            {
                 $hasAttraCitys = Attraction::model()->findAll(array('condition'=>"attraction_id in ($attractcityStr)"));
            }
            if(is_null($hasAttraCitys))
            {

                //$error['reason'] = "请选择途径景点";
                //die(json_encode($error));
            }

             if(!$_POST['ProductAddendum']['title'])
             {

                $error['reason'] ='产品名字不能为空';
                die(json_encode($error));
             }
             if(!$_POST['ProductAddendum']['description'])
             {
                $error['reason'] ='产品描述不能为空';
                die(json_encode($error));
             }
             $pic_arrs = array();
             if(isset($_POST['ProductImages']) || isset($_POST['ProductImages_set']) )
             {

                 if(isset($_POST['ProductImages']))
                 {
                      $i=0;
                    foreach($_POST['ProductImages']['title'] as $v)
                    {
                           $t_pic = array();
                           if($_POST['ProductImages']['path'][$i])
                           {
                             $t_pic['path'] = trim($_POST['ProductImages']['path'][$i]);
                             $t_pic['note'] = strip_tags($v);
                             $pic_arrs[]=$t_pic;
                           }
                          $i++;
                    }


                }

               if(isset($_POST['ProductImages_set']))
               {
                    foreach($_POST['ProductImages_set'] as $v)
                    {
                        $t_pic = array();
                        if((int)$v['id'] && $v['path'])
                        {

                            $t_pic['path'] = trim($v['path']);
                            $t_pic['note'] = strip_tags($v['title']);
                            $pic_arrs[]=$t_pic;
                        }
                    }

               }

             }

            if(count($pic_arrs)<3)
            {
                    $error['reason'] ='请至少上传3张图片';
                    die(json_encode($error));
            }

            $t_step = $product->step;
            if($t_step)
            {
                $t_step     = trim($t_step,',');
                $t_step     = explode(',',$t_step);
                $t_step[]   = Product::$_STEP[2];
                $t_step     = array_unique($t_step);
                sort($t_step);
                $product->step = implode(',',$t_step);
            }


              if($product->save())
             {
                   // 价格一致保存
                   //$goods->price = $product->price;
                   //$goods->save(false);

                    $mname = ProductAddendum::model()->findByAttributes(array('product_id'=>$product->product_id,'language'=>Yii::app()->language));
                    // 商品附属性保存
                    if($mname)
                    {
                        $mname->attributes =$_POST['ProductAddendum'];
                        $mname->save(false);
                    }

                     //PropertyPicture::model()->updatePictures($property->property_id, $pic_arr, 1);

                    //商品相册保存

                    if($pic_arrs)
                    {
                        ProductImage::model()->updatePictures($product->product_id,$pic_arrs,1);

                    }




                    // 开始城市
                    // $citys_id = City::model()->findByPk((int)$_POST['start_id']);
                    // if(is_null($citys_id))
                    // {
                    //     $error['message'] ='开始城市有误';
                    //     die(json_encode($error));
                    // }
                    $mscity = ProductStartCity::model()->findByAttributes(array('product_id'=>$product->product_id));
                    if($mscity)
                    {
                        $mscity->city_id = (int)$_POST['start_id'];
                        $mscity->save(false);
                    }

                    // $citye_id = City::model()->findByPk((int)$_POST['end_id']);
                    // if(is_null($citye_id))
                    // {
                    //     $error['message'] ='结束城市有误';
                   //      die(json_encode($error));
                   //  }

                     $mecity = ProductEndCity::model()->findByAttributes(array('product_id'=>$product->product_id));
                    // 结束城市
                    if($mecity)
                    {
                        $mecity->city_id = (int)$_POST['end_id'];
                        $mecity->save(false);
                    }

                    //途径城市
                     if($hasVisitCitys)
                     {

                        // 先删除 在添加
                        ProductVisitingCity::model()->deleteAllByAttributes(array('product_id'=>$product->product_id));
                        foreach($hasVisitCitys as $city)
                        {
                            $t_visitObj = new ProductVisitingCity;
                            $t_visitObj->city_id = $city->city_id;
                            $t_visitObj->product_id = $product->product_id;
                            $t_visitObj->save(false);
                        }
                     }
                    // 途径景点

                    if($hasAttraCitys)
                    {
                        ProductAttraction::model()->deleteAllByAttributes(array('product_id'=>$product->product_id));

                        foreach($hasAttraCitys as $attractcity)
                        {
                                $t_visitObj = new ProductAttraction;
                                $t_visitObj->attraction_id = $attractcity->attraction_id;
                                $t_visitObj->product_id = $product->product_id;
                                $t_visitObj->save(false);
                        }
                    }
                    //渲染返回数据
                    $respon['state']='1';
                    $respon['data'] = $this->renderPartial('_show_base',array('data'=>$product),true);
                    $respon['reason']= 'yes';

                    $key = Product::getStatus($product->product_id);
                    if($key)
                    {
                        $respon['extention'] = $key;
                    }

                    die(json_encode($respon));

             }


        }


        /**
        行程单介绍
        */

        if(isset($_POST['ProductDescription']))
        {

            //print_r($_POST);die;

            // 验证
                foreach($_POST['ProductDescription'] as $v)
                {


                          // 小时 1日游
                        if($product->entity_type !=2)
                        {

                            if(!$v['name'])
                            {
                                $error['reason'] = "行程概述有误";
                                die(json_encode($error));
                            }
                            if(!$v['description'])
                            {
                                $error['reason'] = "行程详细有误";
                                die(json_encode($error));
                            }
                            if(!$v['url_path'])
                            {
                                $error['reason'] = "请添加图片";
                                die(json_encode($error));
                            }

                        }
                        else
                        {
                            //多日游
                            if(!$v['name'])
                            {
                                $error['reason'] = "第".$v['day']."天行程概述有误";
                                die(json_encode($error));
                            }
                            if(!$v['description'])
                            {
                                $error['reason'] = "第".$v['day']."天行程详细有误";
                                die(json_encode($error));
                            }
                            if(!$v['url_path'])
                            {
                                $error['reason'] = "第".$v['day']."天行程图片添加有误";
                                die(json_encode($error));
                            }


                        }
             }

            // 多日游 &酒店 及图片验证
            if($product->entity_type == 2)
            {
                if(isset($_POST['ProductHote']))
                {
                    foreach($_POST['ProductHote'] as $v)
                    {
                        $hasHotelObj = ProductHotel::model()->findByPk((int)$v['hotel_id']);
                        if(is_null($hasHotelObj) || $hasHotelObj->product_id!=$product->product_id)
                        {
                             $error['reason'] = "无效酒店信息";
                             die(json_encode($error));
                        }
                        if(empty($v['name']))
                        {
                             $error['reason'] = "入住酒店不能为空";
                             die(json_encode($error));
                        }
                         if(empty($v['desc']))
                        {
                             $error['reason'] = "酒店描述不能为空";
                             die(json_encode($error));
                        }
                        $is_ok_c = false;
                        if(isset($_POST['HotelImageSet']))
                        {
                            $ct_h = count($_POST['HotelImageSet'][$v['hotel_id']]);
                            if($ct_h>1)
                            {
                                $is_ok_c = true;
                            }
                        }
                        if(isset($_POST['HotelImages']))
                        {
                            $ct_h = count($_POST['HotelImageSet'][$v['hotel_id']]['path']);
                            if($ct_h>1)
                            {
                                $is_ok_c = true;
                            }
                        }
                        if($is_ok_c == false)
                        {
                            $error['reason'] = "请至少上传一张酒店图片";
                            die(json_encode($error));
                        }

                    }
                }
            }



          // 保存
          foreach($_POST['ProductDescription'] as $v)
          {
            $tempDesc = ProductDescription::model()->findByPk($v['id']);
            if($tempDesc)
            {
                    //$tempDesc->day = max(1,intval($v['day']));
                    $tempDesc->name = trim($v['name']);
                    $tempDesc->description = trim($v['description']);
                    $tempDesc->url_path = trim($v['url_path']);
                    $tempDesc->language = Yii::app()->language;
                    $tempDesc->save(false);
            }

          }

           $t_step = $product->step;
            if($t_step)
            {
                $t_step     = trim($t_step,',');
                $t_step     = explode(',',$t_step);
                $t_step[]   = Product::$_STEP[3];
                $t_step     = array_unique($t_step);
                sort($t_step);
                $product->step = implode(',',$t_step);
                $product->save(false);
            }

          if($product->entity_type == 2)
          {
            if($_POST['ProductHotel'])
            {
                 foreach($_POST['ProductHotel'] as $v)
                 {
                    $obj = ProductHotelAddendum::model()->findByAttributes(array('hotel_id'=>$v['hotel_id'],'language'=>Yii::app()->language));
                    if($obj)
                    {
                        $obj->name = trim($v['name']);
                        $obj->description = trim($v['desc']);
                        $obj->language = Yii::app()->language;
                        if($obj->save())
                        {
                          if(isset($_POST['HotelImages'][$v['hotel_id']]['path']))
                          {
                             foreach($_POST['HotelImages'][$v['hotel_id']]['path'] as $img)
                             {
                                $tem_obj = new ProductHotelImage;
                                $tem_obj->hotel_id = $v['hotel_id'];
                                $tem_obj->path = trim($img);
                                $tem_obj->save();
                             }
                          }
                        }
                    }
                 }
            }
          }

          // 显示

        $hotel = ProductHotel::model()->findAllByAttributes(array('product_id'=>$product->product_id));
        $hoteArray = array();
        $i = 0;
         foreach($hotel as $v)
          {
            $hoteArray[$i]['id']=$v->hotel_id;
            $hoteArray[$i]['name']=$v->addendum->name;
            $hoteArray[$i]['desc']=$v->addendum->description;
            $hoteArray[$i]['path']= array();
            foreach($v->productHotelImages as $img)
            {
                $hoteArray[$i]['path'][$img->_id]=$img->path;
            }

            $i++;
          }
        $html = $this->renderPartial("_show_desc",array('model'=>$product,'hoteArray'=>$hoteArray),true);
        $error['data'] = $html;
        $error['state'] = '1';
        $error['reason'] = '操作成功';
        $key = Product::getStatus($product->product_id);
        if($key)
        {
         $error['extention'] = $key;
        }

        die(json_encode($error));


        }




        /**
        多日游价格设置 及 价格相关
        */
        if(isset($_POST['ProductMultiDayPrice']))
        {

             $multiDayPrice = new ProductMultiDayPrice;
             $multiDayPrice->attributes = $_POST['ProductMultiDayPrice'];
             $multiDayPrice->sunday = isset($_POST['ProductMultiDayPrice']['sunday'])?1:0;
             $multiDayPrice->monday = isset($_POST['ProductMultiDayPrice']['monday'])?1:0;
             $multiDayPrice->tuesday = isset($_POST['ProductMultiDayPrice']['tuesday'])?1:0;
             $multiDayPrice->wednesday = isset($_POST['ProductMultiDayPrice']['wednesday'])?1:0;
             $multiDayPrice->thursday = isset($_POST['ProductMultiDayPrice']['thursday'])?1:0;
             $multiDayPrice->friday = isset($_POST['ProductMultiDayPrice']['friday'])?1:0;
             $multiDayPrice->saturday = isset($_POST['ProductMultiDayPrice']['saturday'])?1:0;
             $multiDayPrice->create_time = time();

                if(empty($_POST['ProductMultiDayPrice']['price_kids']))
                {
                    $multiDayPrice->price_kids = 0.00;//sprintf('%0.2f',($multiDayPrice->price_adult/2));
                }
                $is_ok = $multiDayPrice->validate(array_keys($_POST['ProductMultiDayPrice']));
                if(($_error = $multiDayPrice->getErrors()))
                {
                    $is_ok = false;
                    foreach($_error as $_e)
                    {
                       if(is_array($_e))
                          $error['reason'] = $_e[0];else $error['reason'] = $_e;
                          die(json_encode($error));
                    }
                }

                if($multiDayPrice->sunday == 0 && $multiDayPrice->monday == 0 && $multiDayPrice->tuesday == 0 && $multiDayPrice->wednesday == 0
                && $multiDayPrice->thursday == 0 && $multiDayPrice->friday == 0 && $multiDayPrice->saturday == 0)
                {
                     $error['reason'] = '请至少选择一个星期日期';
                     die(json_encode($error));
                }


                if($is_ok)
                {
                    // 查看是否有
                   $havemultiDayPrice =  ProductMultiDayPrice::model()->findByAttributes(array('product_id'=>(int)$_POST['ProductMultiDayPrice']['product_id']));
                   if($havemultiDayPrice)
                   {
                     $havemultiDayPrice->attributes = $multiDayPrice->attributes;
                     $havemultiDayPrice->start_date = strtotime( $havemultiDayPrice->start_date);
                     $havemultiDayPrice->end_date = strtotime( $havemultiDayPrice->end_date);
                     $havemultiDayPrice->create_time = time();
                     if($havemultiDayPrice->save(false))
                     {
                         $goods->price = $havemultiDayPrice->price_adult;
                         $goods->save(false);
                         $t_step = $product->step;
                         if($t_step)
                         {
                                $t_step     = trim($t_step,',');
                                $t_step     = explode(',',$t_step);
                                $t_step[]   = Product::$_STEP[4];
                                $t_step     = array_unique($t_step);
                                sort($t_step);
                                $product->step = implode(',',$t_step);
                                $product->save(false);
                         }

                     }

                   }
                   else
                   {
                     $multiDayPrice->start_date = strtotime($multiDayPrice->start_date);
                     $multiDayPrice->end_date = strtotime($multiDayPrice->end_date);
                     if($multiDayPrice->save(false))
                     {
                         $goods->price = $multiDayPrice->price_adult;
                         $goods->save(false);
                         $t_step = $product->step;
                         if($t_step)
                         {
                                $t_step     = trim($t_step,',');
                                $t_step     = explode(',',$t_step);
                                $t_step[]   = Product::$_STEP[4];
                                $t_step     = array_unique($t_step);
                                sort($t_step);
                                $product->step = implode(',',$t_step);
                                $product->save(false);
                         }
                     }
                   }

                     $error['state']='1';
                     $error['reason'] = 'ok';
                     $error['data'] = $this->getMultiDayList($product_id);

                     $key = Product::getStatus($product->product_id);
                    if($key)
                    {
                     $error['extention'] = $key;
                    }

                     die(json_encode($error));

                }


               die(json_encode($error));


        }
        /** 多日游特殊价格设置*/
         if(isset($_POST['ProductMultiDayPriceOverride']))
        {


             $multiDayPriceOver = new ProductMultiDayPriceOverride;
             $multiDayPriceOver->attributes = $_POST['ProductMultiDayPriceOverride'];
             $multiDayPriceOver->sunday = isset($_POST['ProductMultiDayPriceOverride']['sunday'])?1:0;
             $multiDayPriceOver->monday = isset($_POST['ProductMultiDayPriceOverride']['monday'])?1:0;
             $multiDayPriceOver->tuesday = isset($_POST['ProductMultiDayPriceOverride']['tuesday'])?1:0;
             $multiDayPriceOver->wednesday = isset($_POST['ProductMultiDayPriceOverride']['wednesday'])?1:0;
             $multiDayPriceOver->thursday = isset($_POST['ProductMultiDayPriceOverride']['thursday'])?1:0;
             $multiDayPriceOver->friday = isset($_POST['ProductMultiDayPriceOverride']['friday'])?1:0;
             $multiDayPriceOver->saturday = isset($_POST['ProductMultiDayPriceOverride']['saturday'])?1:0;
             $multiDayPriceOver->create_time = time();

                if(empty($_POST['ProductMultiDayPriceOverride']['price_kids']))
                {
                    $multiDayPriceOver->price_kids = 0.00;//sprintf('%0.2f',($multiDayPrice->price_adult/2));
                }
                $is_ok = $multiDayPriceOver->validate(array_keys($_POST['ProductMultiDayPriceOverride']));
                if(($_error = $multiDayPriceOver->getErrors()))
                {
                    $is_ok = false;
                    foreach($_error as $_e)
                    {
                              if(is_array($_e))
                          $error['reason'] = $_e[0];else $error['reason'] = $_e;
                          die(json_encode($error));
                    }
                }

                if($multiDayPriceOver->sunday == 0 && $multiDayPriceOver->monday == 0 && $multiDayPriceOver->tuesday == 0 && $multiDayPriceOver->wednesday == 0
                && $multiDayPriceOver->thursday == 0 && $multiDayPriceOver->friday == 0 && $multiDayPriceOver->saturday == 0)
                {
                     $error['reason'] = '请至少选择一个星期日期';
                     die(json_encode($error));
                }
                if($is_ok)
                {
                    // 查看是否有
                   $havemultiDayPriceOver =  ProductMultiDayPriceOverride::model()->findByAttributes(array('product_id'=>(int)$_POST['ProductMultiDayPriceOverride']['product_id']));
                   if($havemultiDayPriceOver)
                   {
                     $havemultiDayPriceOver->attributes = $multiDayPriceOver->attributes;
                     $havemultiDayPriceOver->start_date = strtotime( $havemultiDayPriceOver->start_date);
                     $havemultiDayPriceOver->end_date = strtotime( $havemultiDayPriceOver->end_date);
                     $havemultiDayPriceOver->create_time =time();
                     if($havemultiDayPriceOver->save(false))
                     {
                     }

                   }
                   else
                   {
                     $multiDayPriceOver->start_date = strtotime($multiDayPriceOver->start_date);
                     $multiDayPriceOver->end_date = strtotime($multiDayPriceOver->end_date);
                     if($multiDayPriceOver->save(false))
                     {
                     }
                   }

                 $error['state']='1';
                 $error['reason'] = 'ok';
                 $error['data'] = $this->getMultiDayList($product_id);
                 $key = Product::getStatus($product->product_id);
                if($key)
                {
                 $error['extention'] = $key;
                }
                 die(json_encode($error));

                }


               die(json_encode($error));


        }

        /** 最新小时 或者1日游价格设定 */
          if(isset($_POST['ProductOneDayPrice']))
          {
                //print_r($_POST['ProductOneDayPrice']);//die;
                $oneDayPrice = new ProductOneDayPrice;
                $oneDayPrice->attributes = $_POST['ProductOneDayPrice'];
                $oneDayPrice->sunday = isset($_POST['ProductOneDayPrice']['sunday'])?1:0;
                $oneDayPrice->monday = isset($_POST['ProductOneDayPrice']['monday'])?1:0;
                $oneDayPrice->tuesday = isset($_POST['ProductOneDayPrice']['tuesday'])?1:0;
                $oneDayPrice->wednesday = isset($_POST['ProductOneDayPrice']['wednesday'])?1:0;
                $oneDayPrice->thursday = isset($_POST['ProductOneDayPrice']['thursday'])?1:0;
                $oneDayPrice->friday = isset($_POST['ProductOneDayPrice']['friday'])?1:0;
                $oneDayPrice->saturday = isset($_POST['ProductOneDayPrice']['saturday'])?1:0;
                $oneDayPrice->create_time = time();
                if(empty($_POST['ProductOneDayPrice']['price_kids']))
                {
                    $oneDayPrice->price_kids = 0.00;//sprintf('%0.2f',($oneDayPrice->price_adult/2));
                }
                $is_ok = $oneDayPrice->validate(array_keys($_POST['ProductOneDayPrice']));
                if(($_error = $oneDayPrice->getErrors()))
                {
                    $is_ok = false;
                    foreach($_error as $_e)
                    {
                              if(is_array($_e))
                          $error['reason'] = $_e[0];else $error['reason'] = $_e;
                          die(json_encode($error));
                    }
                }
                if($oneDayPrice->sunday == 0 && $oneDayPrice->monday == 0 && $oneDayPrice->tuesday == 0 && $oneDayPrice->wednesday == 0
                && $oneDayPrice->thursday == 0 && $oneDayPrice->friday == 0 && $oneDayPrice->saturday == 0)
                {
                     $error['reason'] = '请至少选择一个星期日期';
                     die(json_encode($error));
                }
                if($is_ok)
                {
                    // 查看是否有
                   $haveOneDayPrice =  ProductOneDayPrice::model()->findByAttributes(array('product_id'=>(int)$_POST['ProductOneDayPrice']['product_id']));
                   if($haveOneDayPrice)
                   {
                     $haveOneDayPrice->attributes = $oneDayPrice->attributes;
                     $haveOneDayPrice->start_date = strtotime( $haveOneDayPrice->start_date);
                     $haveOneDayPrice->end_date = strtotime( $haveOneDayPrice->end_date);
                     $haveOneDayPrice->create_time = time();
                     if($haveOneDayPrice->save(false))
                     {
                         $goods->price = $haveOneDayPrice->price_adult;
                         $goods->save(false);
                         $t_step = $product->step;
                         if($t_step)
                         {
                                $t_step     = trim($t_step,',');
                                $t_step     = explode(',',$t_step);
                                $t_step[]   = Product::$_STEP[4];
                                $t_step     = array_unique($t_step);
                                sort($t_step);
                                $product->step = implode(',',$t_step);
                                $product->save(false);
                         }

                     }


                   }
                   else
                   {
                     $oneDayPrice->start_date = strtotime($oneDayPrice->start_date);
                     $oneDayPrice->end_date = strtotime($oneDayPrice->end_date);
                     if($oneDayPrice->save(false))
                     {
                         $goods->price = $oneDayPrice->price_adult;
                         $goods->save(false);
                         $t_step = $product->step;
                         if($t_step)
                         {
                                $t_step     = trim($t_step,',');
                                $t_step     = explode(',',$t_step);
                                $t_step[]   = Product::$_STEP[4];
                                $t_step     = array_unique($t_step);
                                sort($t_step);
                                $product->step = implode(',',$t_step);
                                $product->save(false);
                         }
                     }
                   }

                    $error['state']= 1;
                    $error['reason'] = 'ok';
                    $error['data'] =  $this->getOneDayList($product_id);
                    $key = Product::getStatus($product->product_id);
                    if($key)
                    {
                     $error['extention'] = $key;
                    }
                    die(json_encode($error));

                }


                     die(json_encode($error));



          }

           /** 最新小时 或者1日游特殊价格设定 */
          if(isset($_POST['ProductOneDayPriceOverride']))
          {

            $oneDayPriceOver = new ProductOneDayPriceOverride;
            $oneDayPriceOver->attributes = $_POST['ProductOneDayPriceOverride'];
            $oneDayPriceOver->sunday = isset($_POST['ProductOneDayPriceOverride']['sunday'])?1:0;
            $oneDayPriceOver->monday = isset($_POST['ProductOneDayPriceOverride']['monday'])?1:0;
            $oneDayPriceOver->tuesday = isset($_POST['ProductOneDayPriceOverride']['tuesday'])?1:0;
            $oneDayPriceOver->wednesday = isset($_POST['ProductOneDayPriceOverride']['wednesday'])?1:0;
            $oneDayPriceOver->thursday = isset($_POST['ProductOneDayPriceOverride']['thursday'])?1:0;
            $oneDayPriceOver->friday = isset($_POST['ProductOneDayPriceOverride']['friday'])?1:0;
            $oneDayPriceOver->saturday = isset($_POST['ProductOneDayPriceOverride']['saturday'])?1:0;
            $oneDayPriceOver->create_time = time();

            //print_r($oneDayPriceOver->attributes);die;

            if(empty($_POST['ProductOneDayPriceOverride']['price_kids']))
            {
                $oneDayPriceOver->price_kids = 0.00;//sprintf('%0.2f',($oneDayPriceOver->price_adult/2));
            }
            $is_ok = $oneDayPriceOver->validate(array_keys($_POST['ProductOneDayPriceOverride']));
            if(($_error = $oneDayPriceOver->getErrors()))
            {
                $is_ok = false;
                foreach($_error as $_e)
                {
                        if(is_array($_e))
                          $error['reason'] = $_e[0];else $error['reason'] = $_e;

                      break;

                }
                die(json_encode($error));
            }
            if($oneDayPriceOver->sunday == 0 && $oneDayPriceOver->monday == 0 && $oneDayPriceOver->tuesday == 0 && $oneDayPriceOver->wednesday == 0
                && $oneDayPriceOver->thursday == 0 && $oneDayPriceOver->friday == 0 && $oneDayPriceOver->saturday == 0)
            {
                     $error['reason'] = '请至少选择一个星期日期';
                     die(json_encode($error));
            }
            if($is_ok)
            {
                // 查看是否有
               $haveOneDayPriceOver =  ProductOneDayPriceOverride::model()->findByAttributes(array('product_id'=>(int)$_POST['ProductOneDayPriceOverride']['product_id']));
               if($haveOneDayPriceOver)
               {
                 $haveOneDayPriceOver->attributes = $oneDayPriceOver->attributes;
                 $haveOneDayPriceOver->start_date = strtotime($haveOneDayPriceOver->start_date);
                 $haveOneDayPriceOver->end_date = strtotime($haveOneDayPriceOver->end_date);
                 $haveOneDayPriceOver->create_time = time();

                 //print_r($haveOneDayPriceOver->attributes);die;
                 if($haveOneDayPriceOver->save(false))
                 {

                 }
                 //print_r($haveOneDayPriceOver->getErrors());die;

               }
               else
               {
                 $oneDayPriceOver->start_date = strtotime($oneDayPriceOver->start_date);
                 $oneDayPriceOver->end_date = strtotime($oneDayPriceOver->end_date);
                 if($oneDayPriceOver->save(false))
                 {
                 }
               }

                $error['state']='1';
                $error['reason'] = 'ok';
                $error['data'] =  $this->getOneDayList($product_id);
                $key = Product::getStatus($product->product_id);
                if($key)
                {
                 $error['extention'] = $key;
                }
                die(json_encode($error));

            }

                die(json_encode($error));

          }


        /**
        接待人数设置
        */

          if(isset($_POST['ProductNote']) && isset($_POST['ProductNote']['product_id']) )
            {


              $productNote = ProductNote::model()->findByAttributes(array("product_id"=>$product_id));

                $productNote->attributes = $_POST['ProductNote'];

                // 验证
                if(!preg_match("/^\d*$/",$productNote->max_per_day_num_for_adults))
                {
                    $error["reason"] = "每天接待人数有误";
                     die(json_encode($error));
                }
                /*
                if(!preg_match("/^\d*$/",$productNote->max_per_day_num_for_kids))
                {
                    $error["message"] = "每天参团儿童人数有误";
                     die(json_encode($error));
                }
                if(!preg_match("/^\d*$/",$productNote->min_age_for_kids))
                {
                    $error["message"] = "最小儿童年龄有误";
                     die(json_encode($error));
                }
                */
                if(!preg_match("/^\d*$/",$productNote->max_hotle_booking))
                {
                    $error["reason"] = "酒店房间预订有误";
                     die(json_encode($error));
                }
                if(!preg_match("/^\d*$/",$productNote->max_room_for_adults))
                {
                    $error["reason"] = "入住每间人数有误";
                     die(json_encode($error));
                }
                /*
                if(!preg_match("/^\d*$/",$productNote->max_room_for_kids))
                {
                    $error["message"] = "入住每间儿童有误";
                     die(json_encode($error));
                }*/
                 if(!preg_match("/^\d*$/",$productNote->max_room_bed))
                {
                    $error["reason"] = "入住每间人数有误";
                     die(json_encode($error));
                }

                $is_ok = $productNote->save(false);

                if($is_ok)
                {
                     $t_step = $product->step;
                    if($t_step)
                    {
                        $t_step     = trim($t_step,',');
                        $t_step     = explode(',',$t_step);
                        $t_step[]   = Product::$_STEP[5];
                        $t_step     = array_unique($t_step);
                        sort($t_step);
                        $product->step = implode(',',$t_step);
                        $product->save(false);
                    }

                    $respon['state']="1";
                    $respon["reason"] = "操作成功";
                    $respon['data']=$this->getNoteShow($product_id);
                    $key = Product::getStatus($product->product_id);
                    if($key)
                    {
                     $respon['extention'] = $key;
                    }
                    die(json_encode($respon));
                }
                else
                {
                     $respon["reason"] = "提交数据有误";
                }
                die(json_encode($respon));
            }


        /**
        注意事项
        */
        if(isset($_POST['ProductNote']['attention_rules']))
        {

            $modelNote = ProductNote::model()->findByAttributes(array("product_id"=>$product_id));
            if($modelNote == null)
            {
                 $modelNote = new ProductNote;
                    $array_default = array(
                        'product_id' => $product_id,
                        'max_per_day_num_for_adults' => 30,
                        'max_per_day_num_for_kids' => 5,
                        'min_age_for_kids' => 16,
                        'max_hotle_booking' => 15,
                        'max_room_for_adults' =>4,
                        'max_room_for_kids' => 2);
                    $modelNote->attributes = $array_default;
                    $modelNote->save(false);
            }
            $modelNote->attention_rules = $_POST['ProductNote']['attention_rules'];
            $is_ok = $modelNote->save(false);
            if($is_ok)
            {

                    $t_step = $product->step;
                    if($t_step)
                    {
                        $t_step     = trim($t_step,',');
                        $t_step     = explode(',',$t_step);
                        $t_step[]   = Product::$_STEP[6];
                        $t_step     = array_unique($t_step);
                        sort($t_step);
                        $product->step = implode(',',$t_step);
                        $product->save(false);
                    }
                    $error['state']='1';
                    $error['reason'] = 'ok';
                    $key = Product::getStatus($product->product_id);
                    if($key)
                    {
                     $error['extention'] = $key;
                    }
                    $error['data'] = $modelNote->attention_rules;
            }
            else
            {
                     $error['reason'] = '提交数据有误';
            }

            die(json_encode($error));
        }


       // 默认接待设置
        $modelNote = ProductNote::model()->findByAttributes(array("product_id" => $product_id));

        if ($modelNote === null)
        {
                    $modelNote = new ProductNote;
                    $array_default = array(
                        'product_id' => $product_id,
                        'max_per_day_num_for_adults' => 30,
                        'max_per_day_num_for_kids' => 5,
                        'min_age_for_kids' => 16,
                        'max_hotle_booking' => 15,
                        'max_room_for_adults' =>4,
                        'max_room_for_kids' => 2);
                    $modelNote->attributes = $array_default;
                    $modelNote->save(false);
        }

        $modelPrice = $modelPriceOver = null;
        $listHtml = '';


        if($product->entity_type=="2")
        {
           // 多天
            $modelPrice = ProductMultiDayPrice::model()->findByAttributes(array('product_id'=>$product->product_id));
            if(is_null($modelPrice))
           $modelPrice = new ProductMultiDayPrice;
           $modelPriceOver = ProductMultiDayPriceOverride::model()->findByAttributes(array('product_id'=>$product->product_id));
            if(is_null($modelPriceOver))
           $modelPriceOver = new ProductMultiDayPriceOverride;
           $listHtml = $this->getMultiDayList($product->product_id);

        }
        else
        {
            // 小时
            $modelPrice = ProductOneDayPrice::model()->findByAttributes(array('product_id'=>$product->product_id));
            if(is_null($modelPrice))
            $modelPrice = new ProductOneDayPrice;
            $modelPriceOver = ProductOneDayPriceOverride::model()->findByAttributes(array('product_id'=>$product->product_id));
            if(is_null($modelPriceOver))
            $modelPriceOver = new ProductOneDayPriceOverride;
           $listHtml = $this->getOneDayList($product->product_id);
        }

        $modelPrice->product_id = $modelPriceOver->product_id = $product->product_id;
        $hotel = ProductHotel::model()->findAllByAttributes(array('product_id'=>$product->product_id));
        $hoteArray = array();
        $i = 0;
         foreach($hotel as $v)
          {
            $hoteArray[$i]['id']=$v->hotel_id;
            $hoteArray[$i]['name']=$v->addendum->name;
            $hoteArray[$i]['desc']=$v->addendum->description;
            $hoteArray[$i]['path']= array();
            foreach($v->productHotelImages as $img)
            {
                $hoteArray[$i]['path'][$img->_id]=$img->path;
            }

            $i++;
          }

        //print_r($product->productStartCity->city->cityAddendum->name);die;
        //print_r($hoteArray);die;
        $this->render("information",array("model"=>$product,'modelPrice'=>$modelPrice,'modelPriceOver'=>$modelPriceOver,'modelNote'=>$modelNote,'modelDetail'=>$modelDetail,'modelDetailData'=>$modelDetailData,
                'productDepartureData'=>$productDepartureData,'priceList'=>$listHtml,'hoteArray'=>$hoteArray));


    }


    // 汇聚所有相关ajax请求  get
    public function actionAjaxGet()
    {

        if("city"===trim($_GET["act"]))
        {
            $respon = array();
            $key = trim($_GET["key"]);
            $respon =City::model()->searchCity(array('name'=>$key));
            foreach($respon as &$v)
            {
                $v['id'] = $v["city_id"];
            }

            echo json_encode($respon);die;
        }
         elseif("attraction"===trim($_GET["act"]))
        {
            $respon = array();
            $key = trim($_GET["key"]);
            $respon =Attraction::model()->searchAttraction(array('name'=>$key));
            foreach($respon as &$v)
            {
                $v['id'] = $v["attraction_id"];
            }

            echo json_encode($respon);die;
        }

    }

    public function actionShowCalendar()
    {
         $product_id = (int)$_GET['pid'];
        $year = (int)$_GET['year'];
        $month = (int)$_GET['month'];
        $data = Product::model()->showClander($product_id,$year,$month);
        die(json_encode($data));
    }
     public function actionTestCalendar()
    {
        echo "<pre>";
         $product_id = 21;
         $product_id = 23;
         //$product_id = 62;
         //$product_id = 304;
        // $product_id = 67;
        $year = 2013;
        $month = 10;
        $data = Product::model()->showClander($product_id,$year,$month);

        print_r($data);die;
        die(json_encode($data));
    }


     /**
     * 商品详情
     * 还需要进一步优化来源页面    leo
     *
    **/

    public function actionDetail($id)
    {
        if(intval($id) == 0)
        {
            $this->redirect($this->createUrl("site/index"));
        }

        $model = Product::model()->findByPk($id);

        if($model)
        {
            $goods_id = $model->goods_id;
            $goods = Goods::model()->findByPk($goods_id);
            if($goods)
            {
                $goods->browse = $goods->browse+1;
                $goods->save(false);
            }
            /**
            if(strpos($_SERVER['HTTP_REFERER'],'city') === false)
            {
                $this->redirect($this->createUrl("goods/index",array('id'=>$model->goods_id)));
            }
            else
            {
                $this->renderPartial("product_detail",array('model'=>$model));
            }
            */
            $this->renderPartial("product_detail",array('model'=>$model));
        }


    }
    public function actionItem($id)
    {
        $model = Product::model()->findByPk($id);
        $data =  Product::model()->caclTime($model->entity_type,$model->product_id);
        $this->renderPartial("product_item",array('model'=>$model,'data'=>$data));
    }


    /**
     //////////////////////////////////////////---this is a test for ajax request  leo.yan---////////////////////////////////////////////////////////////////////*
    **/
   public function actionLeo()
    {


        //return ;
        //CHttpSession::add('aa','ddd');CHttpSession::closeSession(); CHttpSession::clear(); CHttpSession::add('aa','dsssdd');
        //echo CHttpSession::get('aa');

       $data = Product::model()->caclTime(3,49);
       //$data1 = Product::model()->caclTime(1,21);
       echo "<pre>";
       print_r($data);
      // print_r($data1);
    }
     private $quotes = array(
        array('你要相信世界上每一个人都精明，要令人信服并喜欢和你交往,那才最重要。', '李嘉诚'),
        array('该放下时且放下，你宽容别人，其实是给自己留下来一片海阔天空。', '于丹'),
        array('免费，是世界上最贵的东西。', '马云'),
        array('没有捕捉不到的猎物，就看你有没有野心去捕;没有完成不了的事情，就看你有没有野心去做。', '狼图腾'),
        array('君志所向，一往无前，愈挫愈勇，再接再厉。', '孙中山'),
    );


    /**
     *
     */
    public function actionAjaxPostReview()
    {
        $product_id = (int)Yii::app()->request->getParam('product_id');
        $review_title = Yii::app()->request->getParam('review_title');
        $review_content = Yii::app()->request->getParam('review_content');
        $customer_id = U_ID;
        if(!$customer_id)
        {
            echo CJSON::encode(array('code' => 0, 'msg' => '请先登录后再进行评论！'));
            return;
        }
        //double_submit => deny
        $condition = Product::model()->findByPk($product_id);
        $is_buy = OrderDetail::model()->with('order')->findAll(array('condition'=>'order.customer_id = :customer_id AND t.goods_id = :goods_id','params'=>array(':customer_id'=>$customer_id,':goods_id'=>$condition['goods_id'])));
        foreach($is_buy as $item)
        {
            $_a[] = $item['order_status'];
        }

        if(!in_array(3,$_a))
        {
            echo CJSON::encode(array('code' => 0, 'msg' => '请购买后再进行评论！'));
            return;
        }

        $criteria = new CDbCriteria();
        $criteria->addCondition('product_id=:product_id');
        $criteria->params[':product_id'] = $product_id;
        $criteria->addCondition('name=:review_title OR description=:review_content');
        $criteria->params[':review_title'] = $review_title;
        $criteria->params[':review_content'] = $review_content;
        $criteria->addCondition('customer_id=:customer_id');
        $criteria->params[':customer_id'] = $customer_id;
        $has = ProductReview::model()->count($criteria);
        if ($has)
        {
            echo CJSON::encode(array('code' => 0, 'msg' => '对不起，请不要重复评论！'));
            Yii::app()->end();
        }
        //rating  rules by vincent
        $rating_1 = Yii::app()->request->getParam('starsResult1') * 20;
        $rating_2 = Yii::app()->request->getParam('starsResult2') * 20;
        $rating_3 = Yii::app()->request->getParam('starsResult3') * 20;
        $rating_4 = Yii::app()->request->getParam('starsResult4') * 20;
        //insert to review  use Review API
        $_r = new ProductReview;
        $_r->product_id = $product_id;
        $_r->customer_id = $customer_id;
        $_r->rating_1 = $rating_1;
        $_r->rating_2 = $rating_2;
        $_r->rating_3 = $rating_3;
        $_r->rating_4 = $rating_4;
        $isok = $_r->saveReviewInfo($review_title, $review_content);
        echo CJSON::encode(array('code' => ($isok?1:0), 'msg' => $isok?'谢谢，评论成功！':'对不起，评论失败！'));
        Yii::app()->end();
    }

    /**
     *
     */
    public function actionAjaxPostReviewHelpful()
    {
        $product_review_id = (int)Yii::app()->request->getParam('product_review_id');
        $helpful = Yii::app()->request->getParam('helpful');
        //update review
        if ($_COOKIE["review_helpful_$product_review_id"])
        {
            echo CJSON::encode(array('code' => 0, 'msg' => '请勿重复投票！'));
            Yii::app()->end();
        }
        else
        {
            $_r = ProductReview::model()->findByPk($product_review_id);
            $helpful == 'no' and $_r->helpful_no_counter += 1 or $_r->helpful_yes_counter += 1;
            $isok = $_r->update() and setcookie("review_helpful_$product_review_id", 1, strtotime('+1 week'), '/');
            echo CJSON::encode(array('code' => ($isok?1:0), 'msg' => $isok?'<font color="#ff9900;">非常感谢您的评价！</font>':'对不起，投票失败！'));
            Yii::app()->end();
        }
    }

    /**
     *
     */
    public function actionAjaxPostReviewReply()
    {
        $parent_review_id = Yii::app()->request->getParam('parent_review_id');
        $product_id = (int)Yii::app()->request->getParam('product_id');
        $review_title = Yii::app()->request->getParam('review_title');
        $review_content = Yii::app()->request->getParam('review_content');
        $customer_id = Yii::app()->user->customer_id?Yii::app()->user->customer_id:1;
        //double_submit => deny
        $criteria = new CDbCriteria();
        $criteria->addCondition('product_id=:product_id');
        $criteria->params[':product_id'] = $product_id;
        $criteria->addCondition('description=:review_content');
        $criteria->params[':review_content'] = $review_content;
        $criteria->addCondition('customer_id=:customer_id');
        $criteria->params[':customer_id'] = $customer_id;
        $has = ProductReview::model()->count($criteria);
        if ($has)
        {
            echo CJSON::encode(array('code' => 0, 'msg' => '对不起，请不要重复回复！'));
            Yii::app()->end();
        }
        //rating  rules by vincent
        $rating_1 = 100;
        $rating_2 = 100;
        $rating_3 = 100;
        $rating_4 = 100;
        //insert to review  use Review API
        $_r = new ProductReview;
        $_r->product_id = $product_id;
        $_r->customer_id = $customer_id;
        $_r->rating_1 = $rating_1;
        $_r->rating_2 = $rating_2;
        $_r->rating_3 = $rating_3;
        $_r->rating_4 = $rating_4;
        $_r->parent_review_id = $parent_review_id;
        $isok = $_r->saveReviewInfo($review_title, $review_content);
        echo CJSON::encode(array('code' => ($isok?1:0), 'msg' => $isok?'谢谢，回复成功！':'对不起，回复失败！'));
        Yii::app()->end();
    }

    /**
     *
     */
    public function actionAjaxPostQualification()
    {
        $product_id = (int)Yii::app()->request->getParam('product_id');
        $customer_id = U_ID;

        if(!$customer_id)
        {
            echo json_encode(array('state' => 0, 'reason' => '请先登录后再进行评论！'));
            return;
        }

        $condition = Product::model()->findByPk($product_id);
        $is_buy = OrderDetail::model()->with('order')->findAll(array('condition'=>'order.customer_id = :customer_id AND t.goods_id = :goods_id','params'=>array(':customer_id'=>$customer_id,':goods_id'=>$condition['goods_id'])));

        foreach($is_buy as $item)
        {
            $_a[] = $item['order_status'];
        }

        if(!in_array(3,$_a))
        {
            echo json_encode(array('state' => 0, 'reason' => '请购买后再进行评论！'));
            return;
        }

        echo json_encode(array('state' => 1));
    }
    
    public function actionTest()
    {
        $this->render('test');
    }
}

