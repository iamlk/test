<?php
/**
 * 城市
 * @author darren
 * This is the model class for table "city".
 *
 * The followings are the available columns in table 'city':
 * @property string $city_id
 * @property integer $state_id
 * @property integer $created
 * @property integer $updated
 * @property string $image
 */
class City extends BaseActiveRecord
{
    public $name;
    public $description;
    public $content;
    public $state_id;
    public $country_id;
    public $continent_id;
    public $shareCount;

    // add by leo
     function getCityList($city_id = null)
    {
        $citys = array();


        $arr = $this->searchCity();

        foreach($arr as $v)
        {
            $citys[$v["city_id"]]=$v["name"];
        }

        return $city_id ?$citys[$city_id]:$citys;
    }


    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('state_id, created, updated, is_active, longitude, latitude, image, order', 'required'),
            array(
                'state_id, created, updated, is_active, order',
                'numerical',
                'integerOnly' => true),
			array('image', 'length', 'max'=>250),
            array(
                'longitude',
                'numerical',
                'min' => -180,
                'max' => 180,
                'numberPattern' => '/^[\+\-]?\d{1,3}\.?\d{0,6}$/'),
            array(
                'latitude',
                'numerical',
                'min' => -90,
                'max' => 90,
                'numberPattern' => '/^[\+\-]?\d{1,2}\.?\d{0,6}$/'),
             array('code','safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'city_id, state_id, created, updated, is_active, longitude, latitude, image, order',
                'safe',
                'on' => 'search'),
            );
    }


    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.city_id>10', $this->getTableAlias(true, false)));
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'cityAddendums' => array(
                self::HAS_MANY,
                'CityAddendum',
                'city_id'), // by zyme
            'cityAddendumLocal' => array(
                self::HAS_ONE,
                'CityAddendum',
                'city_id',
                'scopes' => 'local'), // by zyme
            'cityAddendum' => array(
                self::HAS_ONE,
                'CityAddendum',
                'city_id',
                'scopes' => 'local'), // by zyme
            'addendum' => array(
                self::HAS_ONE,
                'CityAddendum',
                'city_id',
                'condition' => 'addendum.language='.'"'.Yii::app()->language.'"'),
            //'article' => array(self::HAS_MANY,'Article','','on'=>'article.city_id like"%'.$_GET['cid'].'%"'),
            'article' => array(self::HAS_MANY,'ArticleCity','city_id'),
            'attraction' => array(
                self::HAS_MANY,
                'Attraction',
                'parent_id',
                'condition' => 'attraction.parent_type=3'
                ),
            'food' => array(
                self::HAS_ONE,
                'Food',
                'city_id'),
            'state' => array(
                self::BELONGS_TO,
                'State',
                'state_id'),
            'cityRecommend' => array(
                self::HAS_ONE,
                'CityRecommend',
                'city_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'city_id' => 'City',
            'state_id' => 'State',
            'is_active' => 'Is Active',
            'created' => 'Created',
            'updated' => 'Updated',
            'image' => 'Image',
            'order' => 'Order',
             'code' => 'Code',
            );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('city_id', $this->city_id, true);
        $criteria->compare('state_id', $this->state_id);
        $criteria->compare('is_active', $this->is_active, true);
        $criteria->compare('created', $this->created);
        $criteria->compare('updated', $this->updated);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('order', $this->order, true);
        $criteria->compare('code', $this->code, true);
        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }


    /**
     * 获取推荐下一个城市
     */
    public function getNextStation($id)
    {
        $model = City::model()->findByPk($id);
        $criteria = new CDbCriteria;
        $criteria->addCondition('is_active=:isActive');
        $criteria->addCondition('city_id!=:cityId');
        $criteria->params = array('isActive'=>1,':cityId'=>$model['city_id']);
        $all = City::model()->findAll($criteria);

        foreach ($all as $item)
        {
            $distance[strval($this->getDistance($item['latitude'], $item['longitude'], $model['latitude'], $model['longitude']))] = $item;
        }

        ksort($distance);
        return $distance;
    }

    private function rad($d)
    {
        return $d * 3.1415926535898 / 180.0;
    }
    private function getDistance($lat1, $lng1, $lat2, $lng2)
    {
        $EARTH_RADIUS = 6378.137;
        $radLat1 = $this->rad($lat1);
        $radLat2 = $this->rad($lat2);
        $a = $radLat1 - $radLat2;
        $b = $this->rad($lng1) - $this->rad($lng2);
        $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2)));
        $s = $s * $EARTH_RADIUS;
        $s = round($s * 10000) / 10000;
        return $s;
    }

    /**
     * 返回城市信息
     */
    public function searchCity($params = array('local' => true))
    {
        // f
        $criteria = new CDbCriteria;
        $criteria->alias = 'city';
        $criteria->with = array('cityAddendums' => ((isset($params['local']) and !$params['local'])?array():array('scopes' => 'local')));
        if ($params['state_id']) $criteria->addCondition(sprintf("`city`.state_id='%u'", $params['state_id']));
        if ($params['city_id']) $criteria->addInCondition('`city`.city_id', explode(',', $params['city_id']));
        if ($params['name']) $criteria->addSearchCondition('`cityAddendums`.name', $params['name']);
        $model = City::model()->findAll($criteria);
        // r
        $arr = array();
        foreach ($model as $city)
        {
            foreach ($city->cityAddendums as $cityAddendum)
            {
                $arr[] = array_merge($city->getAttributes(array('city_id', 'state_id')), $cityAddendum->getAttributes(array('name')));
            }
        }
        return $arr;
    }

    /**
     *
     */
    public function getDropdownList($obj, &$_a = array('|-TOP'), &$level = 1)
    {
        $type = array(
            '1' => 'continent',
            '2' => 'country',
            '3' => 'state',
            '4' => 'city');
        $index = $type[$level].'_id';
        $num = $type[$level + 1];

        foreach ($obj as $item)
        {
            $_a[strval($level.'-'.$item[$index])] = str_repeat('&nbsp;&nbsp;', $level).'|-'.$item->addendum['name'];

            if ($num != NULL && $item->$num)
            {
                $this->getDropdownList($item->$type[++$level], $_a, $level);
            }
        }

        --$level;
        return $_a;
    }

    /**
     * This function get all name from table
     */
    public function getAll($id, $is_null=false)
    {
        $_a[] = '请选择';

        if($is_null)return $_a;

        if(!$id)
        {
            $sql = 'SELECT name, city_id FROM '.CityAddendum::model()->tableName().' WHERE language="'.Yii::app()->language.'"';
            $data = $this->commandBuilder->createSqlCommand($sql)->queryAll();
        }else{
            $data = City::model()->findAll('state_id=:stateID', array(':stateID'=>$id));
        }
        foreach ($data as $item)
        {
            $_a[$item['city_id']] = $item['name'];
        }
        return $_a;
    }

    public function afterFind()
    {
        $this->name = $this->addendum['name'];
        $this->description = $this->addendum['description'];
        $this->content = $this->addendum['content'];
        $this->state_id = $this->state['state_id'];
        $this->country_id = $this->state->country['country_id'];
        $this->continent_id = $this->state->country->continent['continent_id'];
    }

    public function afterSave()
    {
        $_POST['City']['content'] = str_replace('/js/ueditor/php/', '', $_POST['City']['content']);
        $_POST['City']['content'] = str_replace('../../..', '', $_POST['City']['content']);
        if ($this->addendum)
        {
            $this->addendum['attributes'] = $_POST['City'];
            $this->addendum->save();
        }
        elseif ($model = new CityAddendum)
        {
            $model['attributes'] = array('city_id' => $this['city_id'], 'language' => Yii::app()->language);
            $model['attributes'] = $_POST['City'];
            $model->save();
        }
    }

    /**
     * @return CActiveDataProvider
     */
    public function getProvider($attributes=array(),$pageSize=10,$order='city_id DESC'){
        $criteria = new CDbCriteria;
        if($attributes){
            foreach($attributes as $key=>$value){
                $criteria->addCondition('`t`.`'.$key.'` ="'.$value.'"');
            }
        }
        $criteria->order = $order;
    	$dataProvider=new CActiveDataProvider('City', array(
    			'criteria'=>$criteria,
                'pagination'=>array('pageSize'=>$pageSize,'pageVar'=>'qpage'),
    	));
    	return $dataProvider;
    }
    //Fedora
    public static function getCityName($city_id)
    {
        $data = CityAddendum::model()->find('city_id='.intval($city_id).' AND language="'.Yii::app()->language.'"');
        return $data->name;
    }
    /** leo add 09/04
     *   指南目的地
     */
    public static function getItemList($city_id_arr = array(),$limit = 4)
    {
        $data = array();

        if(empty($city_id_arr))return $data;

        $criteria           = new CDbCriteria;
        $criteria->alias    = 'city';
        $criteria->select   = 'city_id,image';
        $criteria->order    = 'city_id desc';
        $criteria->limit    = $limit;
        $criteria->distinct = true;

        $criteria->addCondition('is_active = 1');
        $criteria->addInCondition('city_id',$city_id_arr);



        $models = City::model()->findAll($criteria);

        foreach($models as $city)
        {
            $_tmep = array();
            $_tmep['city_id'] = $city->city_id;
            $_tmep['city_name'] = $city['name'];
            $_tmep['image'] = $city->image;
            $data[] = $_tmep;
        }

        return $data;

    }

      /**
       *  leo add 09/04
       *  目的地更多列表详情
       */
    public static function getItemListDetail($state_id = 0,$limit = 2000,$page_size = 20)
    {
        $data = null;
        $name = '';


        if(empty($state_id))return $data;
        $data =  Country::model()->getPopWindow();
        //print_r($data);
        $_id_arr = array();
        foreach($data as $v)
        {
            if($v['id'] == $state_id)
            {
                $_id_arr = array_keys($v['list']);
                $name = $v['name'];
            }
        }
        if(!$_id_arr) return $data;

        $criteria           = new CDbCriteria;
        $criteria->alias    = 'city';
        $criteria->select   = 'city_id,image';
        $criteria->order   = 'city_id desc';
        $criteria->limit    = $limit;

        $criteria->addCondition('is_active = 1');
        $criteria->addInCondition('city_id',$_id_arr);
        $dataProvider = new CActiveDataProvider('city', array('criteria' => $criteria));
        $dataProvider->pagination->pageSize = $page_size;
        $data =  $dataProvider;
        return array('name'=>$name,'data'=>$data);

    }


}
