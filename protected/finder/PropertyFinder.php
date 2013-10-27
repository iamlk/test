<?php
/**
 * 房子搜索
 * @package 搜索者
 * @author zyme  leo
 *
 * @desc 用于搜索房子的信息，基于目的地坐标
 * @note 查询参数：type=类型=数组[1,2,3]
 * @note 查询参数：type=1,2,3
 */
final class PropertyFinder extends ZFinder
{
    private $_pageSize = 5;
    static $_default_city = 145;//曼谷
    
    const __CACHE_TIME = 3600; 
    const __CACHE_OPEN = false; 

    /** 入：查询字，setter **/
    private $_queryString;
    public function setQueryString($queryString)
    {
        $this->_queryString = $queryString;
    }

    /** ****************************************************************************************************************** **/
    /** ****************************************************************************************************************** **/

    /** 出：数据集，getter，默认null **/
    private $_dataProvider;
    public function getDataProvider()
    {
        return $this->_dataProvider;
    }

    /** 出：查询集，getter，默认array() **/
    private $_queries = array();
    public function getQueries()
    {
        return $this->_queries;
    }
    
    /** 设施 **/
    private $_amenity = array();
    public function getAmenity()
    {
        return $this->_amenity;
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
        preg_match_all('/[1-9]\d*/', $arr['amenity'], $_a);
        $arr['amenity'] = $_a[0];
        preg_match('/[1-9]\d*/', $arr['room'], $_a);
        $arr['room'] = array($_a[0]);
        preg_match('/[1-9]\d*/', $arr['bed'], $_a);
        $arr['bed'] = array($_a[0]);
        preg_match('/[1-9]\d*/', $arr['bath'], $_a);
        $arr['bath'] = array($_a[0]);
        $this->_queries = $arr;
    }

   
    /** 准备：准备和整理 **/
    private function _makePrepare()
    {
       $city = $this->_queries['city']?$this->_queries['city']:self::$_default_city;
       
    
      
      $_temp = array();
      if(self::__CACHE_OPEN)
      {
            $_cacheFilterData_json = Yii::app()->cache->get("filter_property_".$city);
            $_temp = json_decode($_cacheFilterData_json,true);
             //print_r($_temp);
      }
      
      if($_temp)
      {
         $this->_amenity = $_temp;
          //print_r($_temp);die;
      }
      else
      {
         $amenitys =  Property::model()->findAll(array('select'=>'amenity','condition'=>"city_id =$city"));
         
          foreach($amenitys as $v)
          {
            $amenitys_str = $v->amenity;
            if($amenitys_str)
            {
                $amenitys_arr = json_decode($amenitys_str,true);
                if($amenitys_arr)
                {
                   $_temp = array_merge($amenitys_arr,$_temp); 
                }
            }
          }
      
        $_temp = array_unique($_temp);
        if($_temp)
        {
             Yii::app()->cache->set("filter_property_".$city,json_encode($_temp),self::__CACHE_TIME);
        }
      
        $this->_amenity = $_temp;
      }
      
        
       
    }

    /** 准备：房子集.过滤出**/
    private function _makeDataProvider()
    {
        $rawData = array();
        $key_string = md5(json_encode($this->_queries));
        if(self::__CACHE_OPEN)
        {
            $_cacheRawData_json = Yii::app()->cache->get($key_string);
            $rawData = json_decode($_cacheRawData_json,true);
            
        }
        if(empty($rawData))
        {
                        // 数据集
            $criteria = new CDbCriteria;
            $criteria->alias = 'property';
            $criteria->order = 'property.property_id desc';
            $criteria->limit = 500;// 找到最多当前记录条数据就返回不继续往下找了 提高执行效率
            $criteria->with = array("goods","propertyType");
            $criteria->select= 'property.property_id,property.person,property.room,property.bed,property.bathroom,property.amenity,property.goods_id';//提高执行效率
           
           // 只是整租
            $criteria->addCondition("property.parent_property_id = 1");
           // 已发布
            $criteria->addCondition("goods.is_active = 1");
            
            // 默认
            if($this->_queries['city'])
            {
                $criteria->addInCondition('property.city_id',array($this->_queries['city']));
            }
            // 过滤类型
            if($this->_queries['type'])
            {
                $criteria->addInCondition('property.property_type_id',$this->_queries['type']);
            }
              // 房间数
            if($this->_queries['room'] && !is_null($this->_queries['room'][0]))
            {
                $criteria->addInCondition('property.room',$this->_queries['room']);
            }
              // 床位数
            if($this->_queries['bed'] && !is_null($this->_queries['bed'][0]))
            {
                $criteria->addInCondition('property.bed',$this->_queries['bed']);
            }
              // 浴室数
            if($this->_queries['bath'] && !is_null($this->_queries['bath'][0]))
            {
                $criteria->addInCondition('property.bathroom',$this->_queries['bath']);
            }
            // 过滤价格 
          
            $start = sprintf('%0.2f',($this->_queries['price_min']));
            $end   = sprintf('%0.2f',($this->_queries['price_max']));
            
            $start = $start?$start:0.00;
            $end = $end?$end:999999;
            
            if(($start == 0.00) && $end && ($end!= 999999) && ($end!= 0.00))
            {
                $criteria->addCondition('goods.price<='.$end);
            }
            elseif(($start != 0.00) && $start && ($end == 999999))
            {
                 $criteria->addCondition('goods.price>='.$start);
            }
            elseif($start && $end && ($start != 0.00) && ($end!= 999999) && ($end!= 0.00) )
            {
                $criteria->addBetweenCondition('goods.price',$start,$end);
            }
         
            //$criteria->join = "left join property_price on property.property_id = property_price.property_id";
            //$criteria->addBetweenCondition('property_price.day_price',$start,$end);
            //$criteria->addBetweenCondition('goods.price',$start,$end);
           
            
          
           
     
            
            foreach (Property::model()->findAll($criteria) as $row) 
            {
                
               // var_dump($row->propertyType->attributes);die;
                
                $temp_arr = array();
              
                // 收集
                $temp_arr['id'] = $row->property_id;
                $temp_arr['title'] = $row->propertyAddendumLocal->title;
                $temp_arr['price'] = $row->goods->price;
                $temp_arr['description'] = $row->propertyAddendumLocal->description;
                $temp_arr['path'] = $row->propertyPictureFaces[0]->path;
                $temp_arr['note'] = $row->propertyPictureFaces[0]->note;
                $temp_arr['person'] = $row->person;
                $temp_arr['room'] = $row->room;
                $temp_arr['bed'] = $row->bed;
                $temp_arr['bathroom'] = $row->bathroom;
                $temp_arr['type'] = $row->propertyType->propertyTypeAddendumLocal->type;
                $temp_arr['percentage'] = Property::model()->getPercentage($temp_arr['id']);
                $temp_arr['username'] = $row->goods->customer->nick_name;
                $temp_arr['userid'] = $row->goods->customer_id;
                $temp_arr['face'] = $row->goods->customer->avator;
                $temp_arr['goods_id'] = $row->goods_id;
                
                if($this->_queries['amenity'] && !is_null($this->_queries['amenity']))
                {
                    $temp_amenity = $row->amenity;
                    $temp_amenity_arr = json_decode($temp_amenity,true);
                    if(is_null($temp_amenity_arr))
                    {
                        continue;
                    }
                    foreach($this->_queries['amenity'] as $v)
                    {
                        if(in_array($v,$temp_amenity_arr))
                        {
                             $rawData[$temp_arr['id']] = $temp_arr;
                        }
                    }
                   
                }
                else
                {
                  // 保存
                    $rawData[$temp_arr['id']] = $temp_arr;
                }
            }
            
            if($rawData)
            {
                 Yii::app()->cache->set($key_string,json_encode($rawData),self::__CACHE_TIME);
            }
        }
        

       // print_r($rawData);
        
        $this->_dataProvider = new CArrayDataProvider($rawData,array('pagination'=>array('pageSize'=>$this->_pageSize)));
        
    }

    /** ****************************************************************************************************************** **/
    /** ****************************************************************************************************************** **/

    /** 执行：串起来，最后一步 **/
    public function execute()
    {
        // 搜索条件整理
        $this->_makeQueries();
        // 确定目的地
        // 准备和整理
        $this->_makePrepare();
        // 找到房子
        $this->_makeDataProvider();
    }


}
