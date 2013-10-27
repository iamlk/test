<?php
/**
 * 房子
 * @author zyme  leo
 */
class PropertyController extends BaseController
{

    /** 布局 **/
    public $layout = '//layouts/property.base';
    public $goods_id = 0;

    /** 房子.主表 **/
    private $_property = null;

    private $_goods = null;

    private $_property_rooms = null;



    /** 过滤器 **/
    public function filters()
    {
        return array(
            'accessControl',
            'hasProperty + info,contact,attention,other,price,msg',
            //'ajaxOnly + showPrice',
            );
    }
    /** 限制操作者 **/
    public function accessRules()
    {
        return array(
            array('allow', 'actions' => array('detail','showPrice', 'ajaxPostQualification')),
            array('allow', 'expression' => '!$user->isGuest'),
            array('deny'),
            );
    }
    /** 需要指定房子 **/
    public function filterHasProperty($filterChain)
    {
        // 房子.主表 // 必须要指定哪个房子
        $this->_property = Property::model()->findByPk((int)Yii::app()->request->getParam('property_id'));
        if ($this->_property == null)
        {
             $this->redirect('/');
        }

        $this->_goods = Goods::model()->findByPk($this->_property->goods_id);
         if ($this->_goods == null)
        {
             $this->redirect('/');
        }
        // 判断是不是自己 is_self
        if(U_ID != $this->_goods->customer_id)
        {
             $this->redirect('/');
        }

        $this->_property_rooms = Property::model()->findAll(array('condition'=>'parent_property_id='.$this->_property->property_id,'order'=>"property_id asc"));
        $this->params['title'] = '住房发布-个人中心-房东认证';
        $filterChain->run();

    }

    /**
     * 查看价格详情
    */
    public function actionShowPrice()
    {

       $month           = Yii::app()->request->getParam('month');
       $year            = Yii::app()->request->getParam('year');
       $property_id     = (int)Yii::app()->request->getParam('property_id');

       $time_str = $year.'-'.$month.'-01';
       $time = strtotime($time_str);

       $data = Property::model()->showPrice($property_id,$time);

       $respos = array();
       $respos['status'] = 'no';
       $respos['month']  = $month;
       $respos['year']   = $year;
       if(empty($data))
       {
        $respos['data'] = array();
        die(json_encode($respos));
       }
       $t_arr = array();
       foreach($data as $key=>$v)
       {
        $t_y = date("Y",strtotime($key));
        $t_m = date("m",strtotime($key));
        if($t_y == $year && $t_m == $month)
        {
            $t_arr[] = $v;
        }
       }
       if(empty($t_arr))
       {
        $respos['data'] = array();
        die(json_encode($respos));
       }

       $respos['status'] = 'yes';
       $respos['data'] = $t_arr;
       die(json_encode($respos));


    }

    /**
     * (所有).查看房屋 - 所有信息 - 类同List里的detail
     */
    //public function actionDetail()
    //{
        //$this->goods_id = $this->_property->goods_id;
        //$this->redirect(array('propertyList/detail', 'id' => $this->_property->property_id));
    //}
    /**
     * 列表：搜索的结果
     */
    public function actionDetail($id)
    {
        $id = (int)Yii::app()->request->getParam('id');
        $id = $id ?$id :(int)Yii::app()->request->getParam('property_id');
        //以上被Fedora屏蔽
        if(intval($id) == 0)
        {
            $this->redirect($this->createUrl("site/index"));
        }
        $property = Property::model()->findByPk($id);
        $this->goods_id = $property->goods_id;
        $goods = Goods::model()->findByPk($this->goods_id);
        if($goods)
        {
            $goods->browse = $goods->browse+1;
            $goods->save(false);
        }
        $this->renderPartial('detail', array('property' => $property));


    }

    /**
     * (房东).创建房屋 - 基本信息 - 附至少3张外观图
     */
    public function actionCreate()
    {
        // 主表
        $property = new Property;
        $goods    = new Goods;
        $this->params['title'] = '住房发布-个人中心-房东认证';
        if (isset($_POST['Property']))
        {
            //print_r($_POST);die;
            // 如果$property有错误用引用返回
            $this->_base_add($_POST,$property,$goods);
        }

        //print_r($property->getErrors());

        // r
        $this->render('create', array('property' => $property));
    }

    /**
     * (房东).创建房屋 基本信息 - 提交的处理
     * @autor leo
     * @note   创建页面基本信息
     */
    private function _base_add($post, &$property,&$goods)
    {
        $_t = time();
        $temp_goods = array();
        $temp_goods['entity_type'] = Goods::ENTITY_PROPERTY;
        $temp_goods['price'] = 0.00;
        $temp_goods['is_active'] = 2;//编辑中
        $temp_goods['customer_id'] = Yii::app()->user->customer_id;
        $temp_goods['created'] = $_t;

        //print_r($temp_goods);
        //print_r(array_keys($post['Property']));

         $goods->attributes = $temp_goods;

        ////// 检查数据.主表
        $property->attributes = $post['Property'];
        // 房屋的父级为1值只有整租
        $property->parent_property_id = 1;
        // 房东值/没开放/政策值

        $property->property_policy_id = $property->property_policy_id?:1;
        ////// 检查数据.副表

        ////// 校验
        $isok = $property->validate(array_keys($post['Property']));
         //var_dump($isok);
        $isok = $goods->validate(array_keys($temp_goods)) && $isok;


        //print_r($goods->getErrors());
         // 验证公共设施
        $amenity_arr = $post['Property']['amenity'];

        if($amenity_arr)
        {

            $amenity_str = implode(',',$amenity_arr);
            $amenity_str = trim($amenity_str,',');
            $arr = Property::ckAmenityValide($amenity_str);

            //print_r($arr);die(2);

            if(empty($arr))
            {
                 $property->addError('amenity','选择了无效的便利设施');
                  $isok = false;
            }
            else
            {
                $property->amenity = json_encode($arr);
            }
        }
        else
        {
            $property->amenity = json_encode(array());
        }


        //var_dump($isok);die;
        ////// 保存
        if ($isok)
        {
            if($goods->save(false))
            {
                $goods->code = Goods::GOODS_CODE_PRRIX.$goods->goods_id;
                $goods->is_active = 2;
                $goods->save(false);

                $property->goods_id = $goods->goods_id;
                ////// 保存基本信息，主表+副表，注意只有部分数据
                $post->step = Property::$_STEP[1];
                $property->save(false);
                $property->autoMakeRoom();
               // $this->render('done1', array('property' => $property));
                $this->redirect($this->createUrl('/property/msg',array('property_id'=>$property->property_id)));
            }

        }
    }
    public function actionMsg()
    {
        $property = $this->_property;
        $this->render('done1', array('property' => $property));
    }


    /**
     * 动态级联国家省市选择，用于AJAX的替换选项
     * 动态级联国家省市选择，用于AJAX的替换选项，
     * 返回JSON
      **/
    public function actionDynamicZone()
    {
        // 搜索参数:type=country/state/city,word=文字,?id=上级id
        $type = Yii::app()->request->getParam('act');
        $id = (int)Yii::app()->request->getParam('id');
        // 分别处理
        $arr = array();
        if ($type == 'country')
        {
           $arr = Property::getCountries();
        }
        if ($type == 'state')
        {
            $arr = Property::getStates($id);
        }
        if ($type == 'city')
        {
           $arr = Property::getCities($id);
        }
        // JSON
        echo CJSON::encode($arr);
        Yii::app()->end();
    }



    private  function getMenu($param = array())
    {
        $act = 'info';
        $act = $param['act'];
        $step = explode(',',trim($param['step'],','));

        return $this->renderPartial('_menu',array('act'=>$act,'step'=>$step),true);
    }

    /** 详细设置**/// echo substr(__METHOD__,strlen(__CLASS__.'::action'));
    public function actionInfo()
    {
         // 房屋
        $property = $this->_property;
        // print_r($property->attributes);
        //die($property->property_id);
        // 副表.一条
        $propertyAddendum = $property->propertyAddendum;
        if(is_null($propertyAddendum))
        {
            $propertyAddendum = new PropertyAddendum;
            $propertyAddendum->property_id = $property->property_id;
        }

        $pic_arr = array();

        if(isset($_POST['Property']) && isset($_POST['PropertyAddendum']) )
        {
            $post = $_POST;

            $property->attributes = $post['Property'];

            if(!isset($post['Property']['amenity']))
            {
                $property->amenity = json_encode(array());
                //$property->addError('amenity','请选择便利设施');
            }


             $propertyAddendum->attributes = $post['PropertyAddendum'];
             $propertyAddendum->language = Yii::app()->language;
             $isok = $property->validate(array_keys($post['Property']));

             $isok = $propertyAddendum->validate(array_keys($post['PropertyAddendum'])) && $isok;


                // 未设置
                if (!isset($post['ProductImages']['path']))
                {
                    //$propertyPictures->addError('path', '至少需要3张照片.');
                    Yii::app()->user->setFlash('p_image_no','至少需要3张照片(未保存)');
                    $isok = false;
                }
                // 设置但数量不够
                if(count($post['ProductImages']['path']) < 3)
                {

                     foreach ($post['ProductImages']['path'] as $k => $path)
                    {
                        if (!$post['ProductImages']['path']) continue;
                        $pic_arr[$k] = array('path' => $path, 'note' => $post['ProductImages']['title'][$k]);
                    }
                     Yii::app()->user->setFlash('p_image_no','至少需要3张照片(未保存)');
                    $isok = false;
                }
                else
                {
                    foreach ($post['ProductImages']['path'] as $k => $path)
                    {
                        if (!$post['ProductImages']['path']) continue;
                        $pic_arr[$k] = array('path' => $path, 'note' => $post['ProductImages']['title'][$k]);
                    }
                }

                if($isok)
                {
                       $t_step = $property->step;

                        $t_step = trim($t_step,',');
                        $t_step  = explode(',',$t_step);
                        $t_step[]= Property::$_STEP[2];
                        $t_step = array_unique($t_step);
                        sort($t_step);
                        if($t_step)
                        {
                            $_flag_step = true;
                            for($i=1;$i<=4;$i++)
                            {
                                if(!in_array($i,$t_step))
                                {
                                    $_flag_step = false && $_flag_step;
                                }
                            }
                            if($_flag_step)
                            {
                                $goods = Goods::model()->findByPk($property->goods_id);
                                if($goods)
                                {
                                    $goods->is_active = 1;
                                    $goods->save(false);
                                }
                            }
                        }
                        $property->step = implode(',',$t_step);


                    $property->save(false);
                    $propertyAddendum->save(false);
                    $property->autoMakeRoom();
                    // 照片，多张，数组，专用保存，带验证
                    PropertyPicture::model()->updatePictures($property->property_id, $pic_arr, 1);


                    Yii::app()->user->setFlash('is_ok','详细信息保存成功');
                    $this->redirect($this->createUrl("property/price",array('property_id'=>$property->property_id)));

                }

        }


        // 照片.多张，表单要求是数组，默认至少要1张
        $propertyPictures = array();
        foreach ($property->propertyPictureFaces as $k => $row) $propertyPictures[$k] = array('path' => $row->attributes['path'], 'note' => $row->attributes['note']);
        if(empty($propertyPictures))
        {
            $propertyPictures = $pic_arr;
        }

        $act = strtolower(substr(__METHOD__,strlen(__CLASS__.'::action')));

        // r
        $this->render('_main', array(
          'menu'=>$this->getMenu(array('act'=>$act,'step'=>$property->step)),
          'act' =>$act,
            'property' => $property,
            'propertyAddendum' => $propertyAddendum,
            'propertyPictures' => $propertyPictures,
            ));


    }
      /**
       *  价格设置
       * echo number_format(523*(5.5/10),2,'.','');
      **/
    public function actionPrice()
    {
        // 房子.主表
        $property = $this->_property;

        //print_r($property->attributes);

        $goods = $this->_goods;
        // 此时最后的基本价格.一条
        $propertyPrice = $property->propertyPrice or $propertyPrice = new PropertyPrice;
        $propertyPrice->property_id = $propertyPrice->property_id?:$property->property_id;

        // 此时最近的覆盖价格.一组
        $propertyPriceOverride = $property->propertyPriceOverride or $propertyPriceOverride = new PropertyPriceOverride();
        $propertyPriceOverride->property_id = $property->property_id;

        if(isset($_POST['PropertyPrice']) && isset($_POST['PropertyPriceOverride']) && isset($_POST['Property']))
        {


            //print_r($_POST);    die;

            if($_POST['Property']['property_id']!= $property->property_id)
            {
                $propertyPrice->addError('day_price','提交数据有误');
            }
            elseif(!$_POST['PropertyPrice']['start_date'])
            {
                 $propertyPrice->addError('start_date','起始有效期有误');
            }
            elseif(!$_POST['PropertyPrice']['end_date'])
            {
                $propertyPrice->addError('end_date','截止有效期有误');
            }
             elseif(!$_POST['PropertyPrice']['end_date'])
            {
                $propertyPrice->addError('end_date','截止有效期有误');
            }

            else
            {
                $isok = true;
                if($_POST['PropertyPrice']['start_date'] && $_POST['PropertyPrice']['end_date'])
                {
                    if(strtotime($_POST['PropertyPrice']['start_date']) && strtotime($_POST['PropertyPrice']['end_date']))
                    {
                        if(strtotime($_POST['PropertyPrice']['start_date']) >= strtotime($_POST['PropertyPrice']['end_date']))
                        {
                             $propertyPrice->addError('end_date','有效期设置有误');
                             $isok = false;
                        }
                    }
                    else
                    {
                        //$propertyPrice->addError('end_date','截止有效期有误');
                         $propertyPrice->addError('end_date','有效期设置有误');
                          $isok = false;
                    }
                }

                $post = $_POST;

                $price = floatval($post['PropertyPrice']['day_price']);
                $week_dis = floatval($post['PropertyPrice']['week_discount']);
                $month_dis = floatval($post['PropertyPrice']['month_discount']);
                $day_dis = 0;
                if($post['PropertyPriceOverride']['is_rise'] == 0)
                {
                     $day_dis = floatval($post['PropertyPriceOverride']['day_discount']);
                }
                $_rise = 0;
                if($post['PropertyPriceOverride']['is_rise'] == 1)
                {
                    $_rise = intval($post['PropertyPriceOverride']['rise_float']);
                }

                $propertyPrice->attributes = $post['PropertyPrice'];
                $propertyPriceOverride->attributes = $post['PropertyPriceOverride'];

               $isok = $propertyPrice->validate(array_keys($post['PropertyPrice'])) && $isok;
               $isok = $propertyPriceOverride->validate(array_keys($post['PropertyPriceOverride'])) && $isok;

               if($isok)
               {
                    $t = $_SERVER['REQUEST_TIME'];
                    $post['PropertyPrice']['week_price'] = number_format($price*($week_dis/10),2,'.','');
                    $post['PropertyPrice']['month_price'] = number_format($price*($month_dis/10),2,'.','');
                    if($post['PropertyPriceOverride']['is_rise'] == 0)
                    $post['PropertyPriceOverride']['day_price'] = number_format($price*($day_dis/10),2,'.','');
                    if($post['PropertyPriceOverride']['is_rise'] == 1)
                    $post['PropertyPriceOverride']['day_price'] = number_format($price*((100+$_rise)/100),2,'.','');
                    $post['PropertyPrice']['datetime'] = date('Y-m-d H:i:s',$t);
                    $post['PropertyPriceOverride']['datetime'] = date('Y-m-d H:i:s',$t);

                    $propertyPrice->attributes = $post['PropertyPrice'];
                    $propertyPriceOverride->attributes = $post['PropertyPriceOverride'];

                    $isok = $propertyPrice->validate(array('week_price','month_price')) && $isok;
                    $isok = $propertyPriceOverride->validate(array('day_price')) && $isok;
                    //print_r($propertyPriceOverride->attributes);die;
                    //var_dump($isok);

                    if($isok)
                    {
                        $goods->price = $price;
                        if($goods->save(false) && $propertyPrice->save(false))
                        {
                            if($propertyPriceOverride->day_price != 0.00 && $propertyPriceOverride->day_price !=0 )
                            {
                                 $propertyPriceOverride->save(false);
                            }

                                $t_step = $property->step;

                                    $t_step = trim($t_step,',');
                                    $t_step  = explode(',',$t_step);
                                    $t_step[]= Property::$_STEP[3];
                                    $t_step = array_unique($t_step);
                                    sort($t_step);
                                    if($t_step)
                                    {
                                        $_flag_step = true;
                                        for($i=1;$i<=4;$i++)
                                        {
                                            if(!in_array($i,$t_step))
                                            {
                                                $_flag_step = false && $_flag_step;
                                            }
                                        }
                                        if($_flag_step)
                                        {
                                            $goods = Goods::model()->findByPk($property->goods_id);
                                            if($goods)
                                            {
                                                $goods->is_active = 1;
                                                $goods->save(false);
                                            }
                                        }
                                    }
                                    $property->step = implode(',',$t_step);
                                    $property->save(false);




                               Yii::app()->user->setFlash('is_ok','价格设置成功');
                               $this->redirect($this->createUrl("property/attention",array('property_id'=>$property->property_id)));
                        }
                    }

                }



            }
        }

        //$act = 'price';
         $act = strtolower(substr(__METHOD__,strlen(__CLASS__.'::action')));
        // r
        $this->render('_main', array(
          'menu'=>$this->getMenu(array('act'=>$act,'step'=>$property->step)),
           'act' => $act,
            'property' => $property,
            'propertyPrice' => $propertyPrice,
            'propertyPriceOverride' => $propertyPriceOverride,
            ));


    }
     /** 注意事项**/
    public function actionAttention()
    {
         //$act = 'attention';
         $act = strtolower(substr(__METHOD__,strlen(__CLASS__.'::action')));
         $property = $this->_property;
         $propertyAddendum = $property->propertyAddendumLocal;
         if(is_null($propertyAddendum))
         {
            $propertyAddendum = new PropertyAddendum;
         }
         if(isset($_POST['Property']) && isset($_POST['PropertyAddendum']) )
        {
            //print_r($_POST);die;
            $post = $_POST;

            $property->attributes = $post['Property'];

            $isok = $property->validate(array_keys($post['Property']));
            //var_dump($isok);die;
            $post['PropertyAddendum']['language'] = Yii::app()->language;
            $post['PropertyAddendum']['property_id'] = $property->property_id;
            $propertyAddendum->attributes = $post['PropertyAddendum'];
            $isok = $propertyAddendum->validate(array_keys($post['PropertyAddendum']))&& $isok;
              //var_dump($isok);

              if($isok)
              {
                 $t_step = $property->step;

                    $t_step = trim($t_step,',');
                    $t_step  = explode(',',$t_step);
                    $t_step[]= Property::$_STEP[4];
                    $t_step = array_unique($t_step);
                    sort($t_step);
                    if($t_step)
                        {
                            $_flag_step = true;
                            for($i=1;$i<=4;$i++)
                            {
                                if(!in_array($i,$t_step))
                                {
                                    $_flag_step = false && $_flag_step;
                                }
                            }
                            if($_flag_step)
                            {
                                $goods = Goods::model()->findByPk($property->goods_id);
                                if($goods)
                                {
                                    $goods->is_active = 1;
                                    $goods->save(false);
                                }
                            }
                        }
                    $property->step = implode(',',$t_step);


                  if($property->save(false) && $propertyAddendum->save(false))
                   {
                     Yii::app()->user->setFlash('is_ok','注意事项保存成功');
                     $this->redirect($this->createUrl("property/other",array('property_id'=>$property->property_id)));
                   }

              }

        }


        // r
        $this->render('_main', array(
                        'menu'=>$this->getMenu(array('act'=>$act,'step'=>$property->step)),
                        'act' => $act,
                        'property' => $property,
                        'propertyAddendum' => $propertyAddendum,
            ));


    }
     /** 其他信息**/
    public function actionOther()
    {
         $property = $this->_property;
         $propertyAddendum = $property->propertyAddendumLocal;
         $propertyRoom = $this->_property_rooms;

         if(is_null($propertyAddendum))
         {
            $propertyAddendum = new PropertyAddendum;
            $propertyAddendum->property_id = $property->property_id;
         }

         if($_POST)
         {


                // 卧室信息保存
                if(isset($_POST['Property']) && count($_POST['Property']) === 7  )
                {
                      //print_r($_POST);die;

                      $temp_room_obj = null;

                      foreach($propertyRoom as $v)
                      {

                        if($v->property_id ==$_POST['Property']['property_id'] && $v->parent_property_id ==$_POST['Property']['parent_property_id'] && $property->property_id==$_POST['Property']['parent_property_id'])
                        {
                            $temp_room_obj = $v;
                        }
                      }
                      if(!is_null($temp_room_obj))
                      {
                         $temp_room_obj->attributes = $_POST['Property'];
                         $isok = $temp_room_obj->validate(array_keys($_POST['Property']));
                         if($isok)
                         {
                            if($temp_room_obj->save(false))
                            {
                                Yii::app()->user->setFlash('is_ok','卧室信息保存成功');
                            }
                         }

                      }

                      $_flag = true;
                      foreach($propertyRoom as $v)
                      {
                        //print_r($v->attributes);
                          if($v->bed && $v->bed_type)
                          {
                            $_flag = true && $_flag;
                          }
                          else
                          {
                            $_flag = false && $_flag;
                          }
                      }

                      if($_flag)
                      {
                            $t_step = $property->step;
                            $t_step = trim($t_step,',');
                            $t_step  = explode(',',$t_step);
                            $t_step[]= Property::$_STEP[5];
                            $t_step = array_unique($t_step);
                            sort($t_step);
                            if($t_step)
                            {
                                $_flag_step = true;
                                for($i=1;$i<=4;$i++)
                                {
                                    if(!in_array($i,$t_step))
                                    {
                                        $_flag_step = false && $_flag_step;
                                    }
                                }
                                if($_flag_step)
                                {
                                    $goods = Goods::model()->findByPk($property->goods_id);
                                    if($goods)
                                    {
                                        $goods->is_active = 1;
                                        $goods->save(false);
                                    }
                                }
                            }
                            $property->step = implode(',',$t_step);
                            $property->save(false);

                      }

                }

                // 其他信息保存
                if(isset($_POST['Property']) && isset($_POST['PropertyAddendum']))
                {

                    if($_POST['Property']['property_id'] != $property->property_id)
                    {
                        $propertyAddendum->addError('other','无效住房数据');
                    }
                    else
                    {
                        $propertyAddendum->other = trim($_POST['PropertyAddendum']['other']);
                        $propertyAddendum->language = Yii::app()->language;
                        $isok = $propertyAddendum->validate(array_keys($_POST['PropertyAddendum']));
                        if($isok)
                        {
                            if($propertyAddendum->save(false))
                            {
                                   /** $t_step = $property->step;
                                    $t_step = trim($t_step,',');
                                    $t_step  = explode(',',$t_step);
                                    $t_step[]= Property::$_STEP[6];
                                    $t_step = array_unique($t_step);
                                    sort($t_step);
                                    $property->step = implode(',',$t_step);
                                    $property->save(false);*/


                                Yii::app()->user->setFlash('is_ok','其他信息保存成功');
                            }
                        }
                    }
                }

                 $_flag = true;
              foreach($propertyRoom as $v)
              {
                //print_r($v->attributes);
                  if($v->bed && $v->bed_type)
                  {
                    $_flag = true && $_flag;
                  }
                  else
                  {
                    $_flag = false && $_flag;
                  }
              }
              if($propertyAddendum->other && $_flag)
              {
                // 判断是否进入下一个页面
                 $this->redirect($this->createUrl("property/contact",array('property_id'=>$property->property_id)));
              }






         }


         $act = strtolower(substr(__METHOD__,strlen(__CLASS__.'::action')));
        // r
        $this->render('_main', array(
            'menu'=>$this->getMenu(array('act'=>$act,'step'=>$property->step)),
            'act' => $act,
            'property' => $property,
            'propertyAddendum' => $propertyAddendum,
            'propertyRoom'=>$propertyRoom
            ));


    }
     /** 联系方式**/
    public function actionContact()
    {
        //$act = 'contact';
         $act = strtolower(substr(__METHOD__,strlen(__CLASS__.'::action')));
        $property = $this->_property;


        if(isset($_POST['Property']) && isset($_POST['tel_bf'])&& isset($_POST['tel_af']))
        {
            //print_r($_POST);die;
            $post = $_POST;
            $tel = true;
            if($post['tel_bf'] && $post['tel_af'])
            {
                if( !preg_match('/^\d{3,}$/',$post['tel_bf']) || !preg_match('/^\d{5,9}$/',$post['tel_af']))
                {
                   //$property->addError('telephone','座机号码有误');
                   $tel = false;
                   Yii::app()->user->setFlash('telephone','座机号码有误');
                }
                else
                 $property->telephone =$post['Property']['telephone'] = $post['tel_bf'].'[#]'.$post['tel_af'];

            }
            else
            $property->telephone = '[#]';

            //var_dump($tel);
            $property->phone = $post['Property']['phone'];

            $isok = $property->validate(array_keys($post['Property'])) && $tel;

            if($isok)
            {
                $t_step = $property->step;

                    $t_step = trim($t_step,',');
                    $t_step  = explode(',',$t_step);
                    $t_step[]= Property::$_STEP[6];
                    $t_step = array_unique($t_step);
                    sort($t_step);
                    if($t_step)
                        {
                            $_flag_step = true;
                            for($i=1;$i<=4;$i++)
                            {
                                if(!in_array($i,$t_step))
                                {
                                    $_flag_step = false && $_flag_step;
                                }
                            }
                            if($_flag_step)
                            {
                                $goods = Goods::model()->findByPk($property->goods_id);
                                if($goods)
                                {
                                    $goods->is_active = 1;
                                    $goods->save(false);
                                }
                            }
                        }
                    $property->step = implode(',',$t_step);


                if($property->save(false))
                {
                     Yii::app()->user->setFlash('is_ok','联系方式保存成功');
                }
            }

        }

        // r
        $this->render('_main', array(
            'menu'=>$this->getMenu(array('act'=>$act,'step'=>$property->step)),
            'act' => $act,
            'property'=>$property
            ));
    }

    /**
     *
     */
    public function actionAjaxPostReview()
    {
        $property_id = (int)Yii::app()->request->getParam('property_id');
        $review_title = Yii::app()->request->getParam('review_title');
        $review_content = Yii::app()->request->getParam('review_content');
        $customer_id = U_ID;
        if(!$customer_id)
        {
            echo CJSON::encode(array('code' => 0, 'msg' => '请先登录后再进行评论！'));
            return;
        }

        $condition = Property::model()->findByPk($property_id);
        $is_buy = OrderDetail::model()->with('order')->findAll(array('condition'=>'order.customer_id = :customer_id AND t.goods_id = :goods_id','params'=>array(':customer_id'=>$customer_id,':goods_id'=>$condition['goods_id'])));
        foreach($is_buy as $item)
        {
            $_a = $item['order_status'];
        }
        if(!in_array(3,$_a))
        {
            echo CJSON::encode(array('code' => 0, 'msg' => '对不起，请购买后在评论！'));
            return;
        }

        $criteria = new CDbCriteria();
        $criteria->addCondition('property_id=:property_id');
        $criteria->params[':property_id'] = $property_id;
        $criteria->addCondition('name=:review_title OR description=:review_content');
        $criteria->params[':review_title'] = $review_title;
        $criteria->params[':review_content'] = $review_content;
        $criteria->addCondition('customer_id=:customer_id');
        $criteria->params[':customer_id'] = $customer_id;
        $has = PropertyReview::model()->count($criteria);
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
        $rating_5 = Yii::app()->request->getParam('starsResult5') * 20;
        $rating_6 = Yii::app()->request->getParam('starsResult6') * 20;
        //insert to review  use Review API
        $_r = new PropertyReview;
        $_r->property_id = $property_id;
        $_r->customer_id = $customer_id;
        $_r->rating_1 = $rating_1;
        $_r->rating_2 = $rating_2;
        $_r->rating_3 = $rating_3;
        $_r->rating_4 = $rating_4;
        $_r->rating_5 = $rating_5;
        $_r->rating_6 = $rating_6;
        $isok = $_r->saveReviewInfo($review_title, $review_content);
        echo CJSON::encode(array('code' => ($isok?1:0), 'msg' => $isok?'谢谢，评论成功！':'对不起，评论失败！'));
        Yii::app()->end();
    }

    /**
     *
     */
    public function actionAjaxPostReviewHelpful()
    {
        $property_review_id = (int)Yii::app()->request->getParam('property_review_id');
        $helpful = Yii::app()->request->getParam('helpful');
        //update review
        if ($_COOKIE["review_helpful_$property_review_id"])
        {
            echo CJSON::encode(array('code' => 0, 'msg' => '请勿重复投票！'));
            Yii::app()->end();
        }
        else
        {
            $_r = PropertyReview::model()->findByPk($property_review_id);
            $helpful == 'no' and $_r->helpful_no_counter += 1 or $_r->helpful_yes_counter += 1;
            $isok = $_r->update() and setcookie("review_helpful_$property_review_id", 1, strtotime('+1 week'), '/');
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
        $property_id = (int)Yii::app()->request->getParam('property_id');
        $review_title = Yii::app()->request->getParam('review_title');
        $review_content = Yii::app()->request->getParam('review_content');
        $customer_id = U_ID;
        if(!$customer_id)
        {
            echo CJSON::encode(array('code' => 0, 'msg' => '请先登录后再进行评论！'));
            return;
        }
        // double_submit => deny
        $criteria = new CDbCriteria();
        $criteria->addCondition('property_id=:property_id');
        $criteria->params[':property_id'] = $property_id;
        $criteria->addCondition('description=:review_content');
        $criteria->params[':review_content'] = $review_content;
        $criteria->addCondition('customer_id=:customer_id');
        $criteria->params[':customer_id'] = $customer_id;
        $has = PropertyReview::model()->count($criteria);
        if ($has)
        {
            echo CJSON::encode(array('code' => 0, 'msg' => '对不起，请不要重复回复！'));
            Yii::app()->end();
        }
        // rating // rules by vincent
        $rating_1 = 100;
        $rating_2 = 100;
        $rating_3 = 100;
        $rating_4 = 100;
        $rating_5 = 100;
        $rating_6 = 100;
        // insert to review // use Review API
        $_r = new PropertyReview;
        $_r->property_id = $property_id;
        $_r->customer_id = $customer_id;
        $_r->rating_1 = $rating_1;
        $_r->rating_2 = $rating_2;
        $_r->rating_3 = $rating_3;
        $_r->rating_4 = $rating_4;
        $_r->rating_5 = $rating_5;
        $_r->rating_6 = $rating_6;
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
        $property_id = (int)Yii::app()->request->getParam('property_id');
        $customer_id = U_ID;

        if(!$customer_id)
        {
            echo CJSON::encode(array('state' => 0, 'reason' => '请先登录后再进行评论！'));
            return;
        }

        $condition = Property::model()->findByPk($property_id);
        $is_buy = OrderDetail::model()->with('order')->findAll(array('condition'=>'order.customer_id = :customer_id AND t.goods_id = :goods_id','params'=>array(':customer_id'=>$customer_id,':goods_id'=>$condition['goods_id'])));

        foreach($is_buy as $item)
        {
            $_a = $item['order_status'];
        }

        if(!in_array(3,$_a))
        {
            echo CJSON::encode(array('state' => 0, 'reason' => '对不起，请购买后在评论！'));
            return;

        }
        echo json_encode(array('state' => 1));
    }
}
