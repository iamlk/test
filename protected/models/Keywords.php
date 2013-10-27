<?php

/**
 * This is the model class for table "keywords".
 *
 * The followings are the available columns in table 'keywords':
 * @property int(10) unsigned $_id
 * @property char(32) $hash
 * @property tinyint(4) $type
 * @property varchar(50) $word
 * @property int(10) $rank
 * @property int(10) $is_active
 * @property int(10) $visited
 * @property int(10) $created
 * @author leo 2013
 */
class Keywords extends BaseActiveRecord
{
    
    /** sensor 列表显示 */
    const  _MAX_SHOW = 5; 
    
     /** 最大列表显示 */
    const  _MAX_LIMIT = 1000; 
    
    static  $_ACT_ARR= array('tour','property','attract','share','constract','together','food','city');
    
    const _IS_CACHE_DEBUG = false;// 关闭
    
    const _CACHE_OUT_TIME = 3600;// 一小时
    

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('word','required'),
			array('type, rank, is_active, visited, created', 'numerical', 'integerOnly'=>true),
			array('hash', 'length', 'max'=>32),
			array('word', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('_id, hash, type, word, rank, is_active, visited, created', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
    public function defaultScope()
    {
        return array('condition' => sprintf('%s._id>10', $this->getTableAlias(true, false)));
    }
     */

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'_id' => 'ID',
			'hash' => 'Hash',
			'type' => '类型',
			'word' => '关键词',
			'rank' => '权重',
			'is_active' => '是否激活',
			'visited' => 'Visited',
			'created' => 'Created',
		);
        foreach ($t as $k => $v) $t[$k] = Yii::t($this->tableName(), $v);
        return $t;
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{

		$criteria=new CDbCriteria;
        $criteria->order = '_id desc';
		$criteria->compare('_id',$this->_id,true);
		$criteria->compare('hash',$this->hash,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('word',$this->word,true);
		$criteria->compare('rank',$this->rank);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('visited',$this->visited);
		$criteria->compare('created',$this->created);

		return new CActiveDataProvider($this, array('criteria'=>$criteria));
	}
    /** 后台管理相关*/
    
    public static function getWordType($i = false)
    {
        $arr = array();
        $arr[0] = "默认类型";
        $arr[1] = '行程类型';
        $arr[2] = '住房类型';
        $arr[3] = '景点类型';
        $arr[4] = '城市类型';
        $arr[5] = 'XSS类型';
        if($i === false)
        return $arr;
        else
        return $arr[$i];
    }
    
    public static function getWordRank()
    {
        $arr = array();
        for($i=0;$i<=10;$i++)
        {
           $i== 0 ? $arr[$i]="默认权重": $arr[$i]='权重'.$i;
        }
        return $arr;
    }
    
    
    
    
    /** 后台管理相关结束*/
    
    
    /** 搜索主要模块*/
    /**  结果集处理查询显示 */
    public function getTotalData($word,$inner = false)
    {
      $data_inner = $data = $temp =  array();
      $r = Yii::app()->cache->get(md5($word));
      $r = json_decode($r,true);
      
      if($inner && $r && (self::_IS_CACHE_DEBUG) ) return $r;
      
        $data_inner['tour'] = $temp = $this->getTourData($word);
        if($temp)$data[] = $temp;
        $data_inner['property'] = $temp = $this->getPropertyData($word);
        if($temp)$data[] = $temp;
        $data_inner['attract'] =  $temp= $this->getAttractData($word);
        if($temp)$data[] = $temp;
        $data_inner['share'] = $temp = $this->getShareData($word);
        if($temp)$data[] = $temp;
        $data_inner['constract'] = $temp = $this->getConstractData($word);
        if($temp)$data[] = $temp;
        
        $data_inner['city'] = $temp = $this->getCityData($word);
        if($temp)$data[] = $temp;
        
        if(false)
        {
            // 备注  结伴同一贴功能已经暂时屏蔽
            //$data_inner['together'] = $temp = $this->getTogetherData($word);
            //if($temp)$data[] = $temp;
        }
        
        $data_inner['food'] = $temp= $this->getFoodData($word);
        if($temp)$data[] = $temp;
        //$temp = $this->getYouAskMeToAnswerData($word);
        //if($temp)$data[] = $temp;
        
        Yii::app()->cache->set(md5($word),json_encode($data_inner),self::_CACHE_OUT_TIME);

        return $inner ? $data_inner : $data;
        
    }
    
    
    // 短期行程搜索
    private function getTourData($word)
    {
        $lang = Yii::app()->language;
        $lang = $lang?$lang:"zh_cn";
        $product_id_array = $new_ids = $data = array();  
          
         // 开始城市
         $criteria = new CDbCriteria;
         $criteria->alias = 'product_start_city';
         $criteria->order = 'product_start_city.product_id desc';
         $criteria->select = 'product_start_city.product_id';
        // $criteria->with = array('city','city.cityAddendum');
         $criteria->join = "left join city_addendum on city_addendum.city_id = product_start_city.city_id";
        
         $criteria->addCondition("city_addendum.language='$lang'");
         $criteria->addSearchCondition('city_addendum.name',$word,true);
          foreach (ProductStartCity::model()->findAll($criteria) as $row)
          {
            $product_id_array[] = $row->product_id;
          }
          
           // 途径城市
         $criteria = new CDbCriteria;
         $criteria->alias = 'product_visiting_city';
         $criteria->order = 'product_visiting_city.product_id desc';
         $criteria->select = 'product_visiting_city.product_id';
         $criteria->join = "left join city_addendum on city_addendum.city_id = product_visiting_city.city_id and city_addendum.language = '$lang'";
         $criteria->addSearchCondition('city_addendum.name',$word,true);
          foreach (ProductVisitingCity::model()->findAll($criteria) as $row)
          {
            $product_id_array[] = $row->product_id;
          }
          
          //行程名字
         $criteria = new CDbCriteria;
         $criteria->alias = 'product_addendum';
         $criteria->order = 'product_addendum.product_id desc';
         $criteria->select = 'product_addendum.product_id';
         $criteria->addInCondition('language',array($lang));
         $criteria->addSearchCondition('title',$word,true);
          foreach (ProductAddendum::model()->findAll($criteria) as $row)
          {
            $product_id_array[] = $row->product_id;
          }
          
           //print_r($product_id_array);die;
          $new_ids = array_unique($product_id_array);
         
          if($new_ids)
          {
            
            $count = count($new_ids);
            rsort($new_ids);
            $data['id'] = $new_ids;
            $new_ids = array_chunk($new_ids,self::_MAX_SHOW);
            $new_ids = $new_ids[0];
          
            $criteria=new CDbCriteria;
            $criteria->addInCondition('product_id',$new_ids);
            $criteria->alias    = 'product';
            $criteria->order    = 'product_id desc';
            $criteria->select   = 'product_id';
            $p_objs = Product::model()->findAll($criteria);
            
            $temp_data = array();
            
             foreach($p_objs as $v)
             {
                $temp_data[$v->product_id]['name']  = $v->productAddendum->title;
                $temp_data[$v->product_id]['url']   = Yii::app()->createUrl('search/index',array('key'=>$word,'act'=>self::$_ACT_ARR[0]));
             }
             
             $data['title'] = '行程';
             $data['count'] = $count;
             $data['data']  = $temp_data; 
          }
          
          return $data;
    
    }
    // 住房搜索
    public function getPropertyData($word)
    {
           
        $lang = Yii::app()->language;
        $lang = $lang?$lang:"zh_cn";
        
         $property_id_array = $new_ids = $data = array(); 
         
          // 洲省匹配
         $criteria = new CDbCriteria;
         $criteria->alias = 'property';
         $criteria->order = 'property.property_id desc';
         $criteria->select = 'property.property_id';
         $criteria->addCondition('property.parent_property_id = 1');
         $criteria->join = "left join state_addendum on state_addendum.state_id = property.state_id ";
         $criteria->addCondition("state_addendum.language = '$lang'");
         $criteria->addSearchCondition('state_addendum.name',$word,true);
         
          foreach (Property::model()->findAll($criteria) as $row)
          {
            $property_id_array[] = $row->property_id;
          } 
        
          
         // 城市匹配
         $criteria = new CDbCriteria;
         $criteria->alias = 'property';
         $criteria->order = 'property.property_id desc';
         $criteria->select = 'property.property_id';
         $criteria->addCondition('property.parent_property_id = 1');
         $criteria->join = "left join city_addendum on city_addendum.city_id = property.city_id ";
         $criteria->addCondition("city_addendum.language = '$lang'");
         $criteria->addSearchCondition('city_addendum.name',$word,true);
          foreach (Property::model()->findAll($criteria) as $row)
          {
            $property_id_array[] = $row->property_id;
          }
         
           // 住房
         $criteria = new CDbCriteria;
         $criteria->alias = 'property_addendum';
         $criteria->order = 'property_addendum.property_id desc';
         $criteria->select = 'property_addendum.property_id';
         $criteria->addInCondition('language',array($lang));
         $criteria->addSearchCondition('title',$word,true);
         $criteria->addSearchCondition('direction',$word,true);
          foreach (PropertyAddendum::model()->findAll($criteria) as $row)
          {
            $property_id_array[] = $row->property_id;
          }
          
          // print_r($property_id_array);die;
          $new_ids = array_unique($property_id_array);
         
          if($new_ids)
          {
            
            $count = count($new_ids);
            rsort($new_ids);
            $data['id'] = $new_ids;
            $new_ids = array_chunk($new_ids,self::_MAX_SHOW);
            $new_ids = $new_ids[0];
          
            $criteria=new CDbCriteria;
            $criteria->addInCondition('property_id',$new_ids);
            $criteria->alias = 'property';
            $criteria->order = 'property_id desc';
            $criteria->select = 'property_id';
            $criteria->addCondition('parent_property_id = 1');
            $p_objs = Property::model()->findAll($criteria);
            
            $temp_data = array();
             foreach($p_objs as $v)
             {
                $temp_data[$v->property_id]['name'] = $v->propertyAddendum->title;
                $temp_data[$v->property_id]['url'] = Yii::app()->createUrl('search/index',array('key'=>$word,'act'=>self::$_ACT_ARR[1]));
             }
             $data['title'] = '住房';
             $data['count'] = $count;
             $data['data']  = $temp_data; 
          }
          
          return $data;
    }
     // 景点搜索
    public function getAttractData($word)
    {
       
        $lang = Yii::app()->language;
        $lang = $lang?$lang:"zh_cn";
        
         $attraction_id_array = $new_ids = $data = array(); 
         
          //景点匹配
         $criteria = new CDbCriteria;
         $criteria->alias = 'attraction';
         $criteria->order = 'attraction.attraction_id desc';
         $criteria->select = 'attraction.attraction_id';
         $criteria->join = "left join attraction_addendum on attraction_addendum.attraction_id = attraction.attraction_id ";
         $criteria->addCondition("attraction_addendum.language = '$lang'");
         $criteria->addSearchCondition('attraction_addendum.name',$word,true);
         //$criteria->addSearchCondition('attraction_addendum.description',$word,true);
          foreach (Attraction::model()->findAll($criteria) as $row)
          {
            $attraction_id_array[] = $row->attraction_id;
          } 
          
          $new_ids = array_unique($attraction_id_array);
         
          if($new_ids)
          {
            $count = count($new_ids);
            rsort($new_ids);
            $data['id'] = $new_ids;
            $new_ids = array_chunk($new_ids,self::_MAX_SHOW);
            $new_ids = $new_ids[0];
          
            $criteria=new CDbCriteria;
            $criteria->addInCondition('attraction_id',$new_ids);
            $criteria->alias = 'attraction';
            $criteria->order = 'attraction_id desc';
            $criteria->select = 'attraction_id';
            $p_objs = Attraction::model()->findAll($criteria);
            $temp_data = array();
             foreach($p_objs as $v)
             {
                $temp_data[$v->attraction_id]['name'] = $v->addendum->name;
                $temp_data[$v->attraction_id]['url'] = Yii::app()->createUrl('search/index',array('key'=>$word,'act'=>self::$_ACT_ARR[2]));
             }
             $data['title'] = '景点';
             $data['count'] = $count;
             $data['data']  = $temp_data; 
          }
          
          return $data;   
    }
    
     // 目的地搜索
    public function getCityData($word)
    {
       
        $lang = Yii::app()->language;
        $lang = $lang?$lang:"zh_cn";
        
         $city_name_array = $city_id_array = $new_ids = $data = array(); 
         
          //景点匹配
         $criteria = new CDbCriteria;
         $criteria->alias = 'city';
         $criteria->order = 'city.city_id desc';
         $criteria->select = 'city.city_id';
         $criteria->join = "left join city_addendum on city_addendum.city_id = city.city_id ";
         $criteria->addCondition("city_addendum.language = '$lang'");
         $criteria->addSearchCondition('city_addendum.name',$word,true);
         $criteria->addCondition('city.is_active = 1');
          foreach (City::model()->findAll($criteria) as $row)
          {
            $city_id_array[] = $row->city_id;
            $city_name_array[$row->city_id] = $row['name'];
          } 
          
          $new_ids = array_unique($city_id_array);
         
          if($new_ids)
          {
            $count = count($new_ids);
            rsort($new_ids);
            $data['id'] = $new_ids;
            $new_ids = array_chunk($new_ids,self::_MAX_SHOW);
            $new_ids = $new_ids[0];
          
           
            $temp_data = array();
             foreach($new_ids as $v)
             {
                $temp_data[$v]['name'] = $city_name_array[$v];
                $temp_data[$v]['url'] = Yii::app()->createUrl('search/index',array('key'=>$word,'act'=>self::$_ACT_ARR[7]));
             }
             $data['title'] = '目的地';
             $data['count'] = $count;
             $data['data']  = $temp_data; 
          }
          
          return $data;   
    }
    
    
    // 获取分享的行程单
    public function getShareData($word)
    {
        /*
        思路   从行程 与住房里面搜索 id  再在行程单匹配  结果
        */
        $lang = Yii::app()->language;
        $lang = $lang?$lang:"zh_cn";
        
        //找到所有分享的 city_id goods_id
        
         $criteria = new CDbCriteria;
         $criteria->alias = 'itinerary_detail';
         $criteria->select = "itinerary_detail.goods_id,itinerary_detail.city_id,itinerary_detail.entity_type";
         $criteria->limit = self::_MAX_LIMIT;
         $criteria->order = 'itinerary_detail._id desc';
         $city_ids = $goods_ids = array();
         $city_ids_real = $goods_ids_real = array();
         foreach (ItineraryDetail::model()->findAll($criteria) as $row)
         {
            $city_ids[] = $row->city_id;
            $goods_ids[$row->entity_type][] = $row->goods_id;
         }
         
         if($city_ids)
         {
             $criteria = new CDbCriteria;
             $criteria->alias = 'city_addendum';
             $criteria->select = "city_id";
             $criteria->addInCondition('city_id',$city_ids);
             $criteria->addCondition("language ='$lang'");
             $criteria->addSearchCondition('name',$word);
            
             foreach(CityAddendum::model()->findAll($criteria) as $row)
             {
                $city_ids_real[] = $row->city_id;
             }
         }
         $city_ids_real = array_unique($city_ids_real);
         if($goods_ids)
         {
             if($goods_ids[1])
             {
                 // 短期行程
                 //商品相关联的
                 $criteria = new CDbCriteria;
                 $criteria->alias = 'product';
                 $criteria->select = 'product.goods_id';
                 $criteria->addInCondition('product.goods_id',$goods_ids[1]);
                 $criteria->join = "left join product_addendum on product_addendum.product_id = product.product_id ";
                 $criteria->addCondition("product_addendum.language='$lang'");
                 $criteria->addSearchCondition('product_addendum.title',$word,true);
                 foreach(Product::model()->findAll($criteria) as $row)
                 {
                    $goods_ids_real[] = $row->goods_id;
                 }
                 
                 $goods_ids_real = array_unique($goods_ids_real);
                
                 
                 if($city_ids_real)
                 {   
                    
                    //开始城市相关联的
                     $criteria = new CDbCriteria;
                     $criteria->alias = "product_start_city";
                     $criteria->select = "product_id";
                     $criteria->addInCondition('city_id',$city_ids_real);
                     foreach(ProductStartCity::model()->findAll($criteria) as $row)
                     {
                        $goods_ids_real[] = $row->product->goods_id;
                     }
                     
                     
                      //途径城市相关联的
                     $criteria = new CDbCriteria;
                     $criteria->alias = "product_visiting_city";
                     $criteria->select = "product_id";
                     $criteria->addInCondition('city_id',$city_ids_real);
                     foreach(ProductVisitingCity::model()->findAll($criteria) as $row)
                     {
                        $goods_ids_real[] = $row->product->goods_id;
                     }
                     
                 }
                 
                 
          
             }
             if($goods_ids[2])
             {
                // 住房公寓
                 $criteria = new CDbCriteria;
                 $criteria->alias = 'property';
                 $criteria->select = 'property.goods_id';
                 $criteria->addInCondition('property.goods_id',$goods_ids[2]);
                 $criteria->join = "left join property_addendum on property_addendum.property_id = property.property_id ";
                 $criteria->addCondition("property_addendum.language = '$lang'");
                 $criteria->addSearchCondition('property_addendum.title',$word,true);
                 foreach(Property::model()->findAll($criteria) as $row)
                 {
                    $goods_ids_real[] = $row->goods_id;
                 }
                 
                 $goods_ids_real = array_unique($goods_ids_real);
                 
                 if($city_ids_real)
                 {   
                    //开始城市相关联的
                     $criteria = new CDbCriteria;
                     $criteria->alias = "property";
                     $criteria->select = "property.goods_id";
                     $criteria->addInCondition('city_id',$city_ids_real);
                     foreach(Property::model()->findAll($criteria) as $row)
                     {
                        $goods_ids_real[] = $row->goods_id;
                     }
                     
                 }
             }
         }
         
        
        
         $data = $temp = array();
         $goods_ids_real = array_unique($goods_ids_real);
         $city_ids_real = array_unique($city_ids_real);
         
         $criteria = new CDbCriteria;
         $criteria->alias = 'itinerary_detail';
         $criteria->select = "itinerary_detail.itinerary_id";
         $criteria->limit = self::_MAX_LIMIT;
         $criteria->order = 'itinerary_detail._id desc';
         if($goods_ids_real)
         {
            $criteria->addInCondition('goods_id',$goods_ids_real);
         }
         if($goods_ids_real)
         {
            $criteria->addInCondition('city_id',$city_ids_real);
         }


         foreach (ItineraryDetail::model()->findAll($criteria) as $row)
         {
            $temp[] = $row->itinerary_id;
         }
         $temp = array_unique($temp);
         rsort($temp);
         $_data = array();
         $count = count($temp);
         //print_r($temp);
         if($temp)
         {
            $criteria = new CDbCriteria;
            $criteria->alias = 'itinerary';
            $criteria->order = 'itinerary_id desc';
            $criteria->select = "itinerary_id,title";
            $criteria->limit = self::_MAX_SHOW;
            $criteria->addInCondition('itinerary_id',$temp);
            foreach(Itinerary::model()->findAll($criteria) as $row)
            {
                $_data[$row->itinerary_id]['name'] = $row->title;
                $_data[$row->itinerary_id]['url'] = Yii::app()->createUrl('search/index',array('key'=>$word,'act'=>self::$_ACT_ARR[3]));
            }
            
            
         }
         $data['id'] = $temp;
         $data['title'] = '行程单';
         $data['count'] = $count;
         $data['data']= $_data;
      
         return $data;
    }
     // 获取功率咨询
    public function getConstractData($word)
    {
       
        $lang = Yii::app()->language;
        $lang = $lang?$lang:"zh_cn";
        
         $artilcle_id_array = $new_ids = $data = array(); 
         
          //景点匹配
         $criteria = new CDbCriteria;
         $criteria->alias = 'article';
         $criteria->order = 'article.article_id desc';
         $criteria->select = 'article.article_id';
         $criteria->join = "left join article_addendum on article_addendum.article_id = article.article_id ";
         $criteria->addCondition("article_addendum.language = '$lang'");
         $criteria->addSearchCondition('article_addendum.title',$word,true);
        
          foreach (Article::model()->findAll($criteria) as $row)
          {
            $artilcle_id_array[] = $row->article_id;
          } 
          
          $new_ids = array_unique($artilcle_id_array);
         
          if($new_ids)
          {
            $count = count($new_ids);
            rsort($new_ids);
            $data['id'] = $new_ids;
            $new_ids = array_chunk($new_ids,self::_MAX_SHOW);
            $new_ids = $new_ids[0];
          
            $criteria=new CDbCriteria;
            $criteria->addInCondition('article.article_id',$new_ids);
            $criteria->alias = 'article';
            $criteria->order = 'article.article_id desc';
            $criteria->select = 'article.article_id';
            $p_objs = Article::model()->findAll($criteria);
            $temp_data = array();
             foreach($p_objs as $v)
             {
                $temp_data[$v->article_id]['name'] = $v->addendum->title;
                $temp_data[$v->article_id]['url'] = Yii::app()->createUrl('search/index',array('key'=>$word,'act'=>self::$_ACT_ARR[4]));
             }
             $data['title'] = '攻略';
             $data['count'] = $count;
             $data['data']  = $temp_data; 
          }
          
          return $data;     
    }
    // 获取结伴贴
    public function getTogetherData($word)
    {
         $lang = Yii::app()->language;
         $lang = $lang?$lang:"zh_cn";
        
         $company_id_array = $new_ids = $data = array(); 
         
          //景点匹配
         $criteria = new CDbCriteria;
         $criteria->alias = 'travel_companion';
         $criteria->order = 'travel_companion.travel_companion_id desc';
         $criteria->select = 'travel_companion.travel_companion_id,title';
         $criteria->limit = self::_MAX_LIMIT;
       
         $criteria->addSearchCondition('travel_companion.title',$word,true,'or');
         $criteria->addSearchCondition('travel_companion.content',$word,true,'or');
         
         $obj = TravelCompanion::model()->findAll($criteria);
         
        
        
          foreach ($obj as $row)
          {
            $company_id_array[] = $row->travel_companion_id;
          } 
          
          $new_ids = array_unique($company_id_array);
         
          if($new_ids)
          {
            $count = count($new_ids);
            rsort($new_ids);
            $data['id'] = $new_ids;
            $new_ids = array_chunk($new_ids,self::_MAX_SHOW);
            $new_ids = $new_ids[0];
          
          
            $temp_data = array();
             foreach($obj as $v)
             {
                //print_r($v->attributes);
                if(in_array($v->travel_companion_id,$new_ids))
                {
                     $temp_data[$v->travel_companion_id]['name'] = $v->title;
                     $temp_data[$v->travel_companion_id]['url'] = Yii::app()->createUrl('search/index',array('key'=>$word,'act'=>self::$_ACT_ARR[5]));
                }
               
             }
             $data['title'] = '结伴贴';
             $data['count'] = $count;
             $data['data']  = $temp_data; 
          }
          
          return $data;        
    }
     // 获取美食
    public function getFoodData($word)
    {
        
         $lang = Yii::app()->language;
         $lang = $lang?$lang:"zh_cn";
        
         $food_id_array = $new_ids = $data = array(); 
         
          //景点匹配
         $criteria = new CDbCriteria;
         $criteria->alias = 'food';
         $criteria->order = 'food.food_id desc';
         $criteria->select = 'food.food_id';
         $criteria->join = "left join food_addendum on food_addendum.food_id = food.food_id ";
         $criteria->addCondition("food_addendum.language = '$lang'");
         $criteria->addSearchCondition('food_addendum.name',$word,true);
         $criteria->addSearchCondition('food_addendum.description',$word,true);
        
          foreach (Food::model()->findAll($criteria) as $row)
          {
            $food_id_array[] = $row->food_id;
          } 
          
          $new_ids = array_unique($food_id_array);
         
          if($new_ids)
          {
            $count = count($new_ids);
            rsort($new_ids);
            $data['id'] = $new_ids;
            $new_ids = array_chunk($new_ids,self::_MAX_SHOW);
            $new_ids = $new_ids[0];
          
            $criteria=new CDbCriteria;
            $criteria->addInCondition('food.food_id',$new_ids);
            $criteria->alias = 'food';
            $criteria->order = 'food.food_id desc';
            $criteria->select = 'food.food_id';
            $p_objs = Food::model()->findAll($criteria);
            $temp_data = array();
             foreach($p_objs as $v)
             {
                $temp_data[$v->food_id]['name'] = $v->addendum->name;
                $temp_data[$v->food_id]['url'] = Yii::app()->createUrl('search/index',array('key'=>$word,'act'=>self::$_ACT_ARR[6]));
             }
             $data['title'] = '美食';
             $data['count'] = $count;
             $data['data']  = $temp_data; 
          }
          
          return $data;        
    }
    // 获取你问我答
    public function getYouAskMeToAnswerData($word)
    {
         $data = $temp = array();
         for($i=22;$i<24;$i++)
         {
            $temp[$i]['name'] = 'do you have a dream?';
            $temp[$i]['url'] = Yii::app()->createUrl('search/index',array('keyword'=>urlencode($temp[$i]['name'])));
         }
           $data['title'] = '你问我答';
           $data['count'] = '2';
           $data['data']= $temp; 
           return $data;
    }
    
}