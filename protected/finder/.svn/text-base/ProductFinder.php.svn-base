<?php
/**
 * 产品搜索
 * @package 搜索者
 * @author leo.yan
 * @desc 用于搜索产品的信息
 *
 */
final class ProductFinder extends ZFinder
{
   const __CACHE_TIME = 3600; 
   const __CACHE_OPEN = false;
   static $_default_city = 136;//洛杉矶 
   private $_pageSize = 5;//10;

        // 1解析querystring
        // 2城市怎么样  开始城市 途径城市 结束城市
        //b 3默认城市推荐
        //a 3行程类型
        //a 3途径景点
        //a 3持续时间
        // 模糊搜索

     /** 入：查询字，setter **/
    private $_queryString;
    public function setQueryString($queryString)
    {
        $this->_queryString = $queryString;
    }

    /** 出：数据集，getter，默认null **/
    private $_dataProvider;
    public function getDataProvider()
    {
        return $this->_dataProvider;
    }

    /** 出：查询集，getter，默认array() **/
    public $_queries = array();
    public function getQueries()
    {
        return $this->_queries;
    }
    /** 数组  **/
    private $_filterData = array();
    public function getFilterData()
    {
        return $this->_filterData;
    }
    
    private $_productId = array();
    public function getProductId()
    {
        return $this->_productId;
    }

    /** ****************************************************************************************************************** **/
    /** ****************************************************************************************************************** **/

    /** 准备：组织查询项 **/ // TODO: 过滤？
    private function _makeQueries()
    {
        $arr = array();
        parse_str($this->_queryString, $arr);
        preg_match_all('/[1-9]\d*/', $arr['type'], $_a);
        $arr['type'] = $_a[0];
        preg_match_all('/[1-9]\d*/', $arr['attraction'], $_a);
        $arr['attraction'] = $_a[0];
        preg_match_all('/[1-9]\d*/', $arr['day'], $_a);
        $arr['day'] = $_a[0];
        $this->_queries = $arr;
    }

    private function _makePrepare()
    {
        $city = $this->_queries['city']?$this->_queries['city']:self::$_default_city;
        
        $_cacheFilterData = array();
        if(self::__CACHE_OPEN)
        {
            $_cacheFilterData_json = Yii::app()->cache->get("filter_".$city);
            $_cacheFilterData = json_decode($_cacheFilterData_json,true);
        }
        
        //print_r($_cacheFilterData);die;
        if($_cacheFilterData)
        {
             $this->_filterData = $_cacheFilterData;
        }
        else
        {
            $_cacheFilterData = $this->typeListFilterByCityId($city);
             
            if($_cacheFilterData)
            {
                Yii::app()->cache->set("filter_".$city,json_encode($_cacheFilterData),self::__CACHE_TIME);
            }
             $this->_filterData = $_cacheFilterData;
        }
        
    }

    /** 准备：查询 **/ // TODO:效率问题，使用临时表或内存表
    private function _makeDataProvider()
    {
         //Yii::app()->cache->flush();  
        $rawData = array();
        $key_string = md5(json_encode($this->_queries));
        if(self::__CACHE_OPEN)
        {
            $_cacheRawData_json = Yii::app()->cache->get($key_string);
            $rawData = json_decode($_cacheRawData_json,true);
            
        }
        if(empty($rawData))
        {
            
             $filterdata = $this->_filterData;
            // 数据集
            $criteria = new CDbCriteria;
            $criteria->alias = 'product';
            $criteria->limit = 500;// 找到最多当前记录条数据就返回不继续往下找了 提高执行效率
            $criteria->order = 'product.product_id desc';
            $criteria->select= 'product.product_id,product.duration,product.entity_type,product.goods_id';//提高执行效率
            //$criteria->with = array('goods','productAttractions','productStartCity','productEndCity');
            $criteria->with = array('goods');
            $criteria->addCondition('goods.is_active = 1');
           
            // 默认城市
            if($this->_productId)
            {
                $criteria->addInCondition('product.product_id',$this->_productId);
            }
            // 默认
            //if($this->_queries['city'])
            //{
            //    $criteria->addInCondition('product.product_id',$this->_productIdArray,'or');
            //}
            // 过滤行程类型
            if($this->_queries['type'])
            {
                $criteria->addInCondition('product.product_type_id',$this->_queries['type']);
            }
            // 过滤途径景点
            if($this->_queries['attraction'])
            {
                $criteria->join = "left join product_attraction on product_attraction.product_id = product.product_id";
                $criteria->addInCondition('product_attraction.attraction_id',$this->_queries['attraction']);
                //$criteria->distinct = true;
            }
            // 持续时间
            if($this->_queries['day'])
            {
               $criteria->addInCondition('product.entity_type',$this->_queries['day']);
            }
    
            foreach (Product::model()->findAll($criteria) as $row)
            {
    
                $temp_arr = array();
            
                // 收集
                $temp_arr['id'] = $row->product_id;
                $temp_arr['title'] = $row->addendum->title;
                $temp_arr['price'] = $row->goods->price;
                $temp_arr['description'] = $row->addendum->description;
                $temp_arr['path'] = $row->productImages[0]->path;
                $temp_arr['note'] = $row->productImages[0]->note;
                $temp_arr['city'] = $row->productStartCity->city->cityAddendum->name;
                $temp_arr['duration'] = $row->duration;
                $temp_arr['entity_type'] = $row->entity_type;
                $temp_arr['percentage'] = Product::model()->getPercentage($temp_arr['id']);
                $temp_arr['username'] = $row->goods->customer->nick_name;
                $temp_arr['userid'] = $row->goods->customer_id;
                $temp_arr['face'] = $row->goods->customer->avator;
                $temp_arr['goods_id'] = $row->goods_id;
                // 保存
                $rawData[$temp_arr['id']] = $temp_arr;
    
            }
            
            if($rawData)
            {
                 Yii::app()->cache->set($key_string,json_encode($rawData),self::__CACHE_TIME);
            }
        }
       
        // return
        $this->_dataProvider = new CArrayDataProvider($rawData,array('pagination'=>array('pageSize'=>$this->_pageSize)));
    }

    /** ****************************************************************************************************************** **/
    /** ****************************************************************************************************************** **/

    /** 执行：串起来，最后一步 **/
    public function execute()
    {
        // 搜索条件整理
        $this->_makeQueries();

        // 准备和整理
        $this->_makePrepare();
        // 找到商品
        $this->_makeDataProvider();
    }

    /** ****************************************************************************************************************** **/
    /** ****************************************************************************************************************** **/

     // return  array   city_id 136 洛杉矶
    public function typeListFilterByCityId($city_id = 0)
    {
        $data =  array();
        $data[0] = $this->ToursType($city_id);
        $data[1] = $this->ToursAttraction($city_id);
        $data[2] = $this->ToursDelayTime($city_id);
        $_productId = array_merge($this->_productIdArray,$this->_product_ids);
        $this->_productId = array_unique($_productId);
        //print_r($data[1]);
        return $data;
    }
      // 行程类型
    private $_productIdArray = array();
    private function ToursType($city_id=0)
    {
        $data = array();
        
        /*
        $p = ProductType::model()->findAll(array('select'=>"product_type_id"));
        
        foreach($p as $v)
        {
            $data[$v->product_type_id] = $v->productTypeAddendumLocal->type_name;
        }
        return $data;
        */
        
       // 开始城市
       $startCitys =  ProductStartCity::model()->findAll(array('select'=>'city_id,product_id','condition'=>"city_id=$city_id"));
       foreach($startCitys as $v)
       {
        $data[]=$v->product_id;
       }
       // 结束城市
       $endCitys = ProductEndCity::model()->findAll(array('select'=>'city_id,product_id','condition'=>"city_id=$city_id"));
       foreach($endCitys as $v)
       {
        $data[]=$v->product_id;
       }
       //去重复
       $data = array_unique($data);
       // 访问过的城市
       $visitCitys = ProductVisitingCity::model()->findAll(array('select'=>'city_id,product_id','condition'=>"city_id=$city_id"));
       foreach($visitCitys as $v)
       {
        $data[]=$v->product_id;
       }
       $data = array_unique($data);
       sort($data);
       //$this->_productIdArray = $data;
       if($data)
       {
         $data_product_ids = $data_type_ids = array();

         $id = implode(',',$data);
         $id = trim($id,',');
         $products = Product::model()->findAll(array('select'=>'product_id,product_type_id','condition'=>'product_id in ('.$id.')'));
         foreach($products as $v)
         {
            $data_type_ids[] = $v->product_type_id;
            $data_product_ids[] = $v->product_id;
         }

         $data_type_ids = array_unique($data_type_ids);
        $this->_productIdArray =  $data_product_ids = array_unique($data_product_ids);
         $data_type_value = array();
         if($data_type_ids)
         {
            $type_id = '';
            $type_id = implode(',',$data_type_ids);
            $type_id = trim($type_id,',');
            $types = ProductType::model()->findAll(array('condition'=>'product_type_id in ('.$type_id.')'));
            foreach($types as $v)
            {
                $data_type_value[$v->product_type_id] = $v->productTypeAddendumLocal->type_name;
            }
         }

         return $data_type_value;

       }

       return $data;
    }
    private $_product_ids = array();
      // 途径景点
    private function ToursAttraction($city_id=0)
    {
        $data = array();
        $arracitions = Attraction::model()->findAll(array('select'=>'attraction_id','condition'=>"parent_type = 3 and parent_id = $city_id"));
        // 找商品编号
        $arracitions_id =  $product_ids = array();
        foreach($arracitions as $v)
        {
            $data[$v->attraction_id] = $v->addendum->name;
            $arracitions_id[] = $v->attraction_id;
        }
        if($arracitions_id)
        {
            $arracitions_id_str = implode(',',$arracitions_id);
            $arracitions_id_str = trim($arracitions_id_str,',');
            $products = ProductAttraction::model()->findAll(array('select'=>'attraction_id,product_id','condition'=>"attraction_id in($arracitions_id_str)"));
            foreach($products as $v)
            {
                $product_ids[] = $v->product_id;
            }
           
        }
        
       
        $this->_product_ids = array_unique($product_ids);
        $data = array_unique($data);
       
        krsort($data);
        return $data;
    }
    // 持续时间
    private function ToursDelayTime($city_id=0)
    {
         return  array('3'=>"时段",'1'=>"一日","2"=>"多日");
    }

}

?>