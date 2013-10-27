<?php

/**
 * This is the model class for table "shopcart".
 *
 * The followings are the available columns in table 'shopcart':
 * @property int(10) unsigned $shopcart_id
 * @property date $start_date
 * @property date $end_date
 * @property tinyint(1) unsigned $is_favorite
 * @property varchar(45) $visitor_key
 * @property int(10) unsigned $created
 * @property int(10) unsigned $itinerary_id
 * @property int(10) unsigned $customer_id
 * @property smallint(5) unsigned $current_day_step
 *
 * The followings are the available model relations:
 * @property Itinerary $itinerary
 * @property Customer $customer
 * @property ShopcartDetail[] $shopcartDetails
 * @property mixed $shopcartDetailCount
 */
class Shopcart extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('start_date, created, itinerary_id, customer_id', 'required'),
			array('is_favorite, current_day_step', 'numerical', 'integerOnly'=>true),
			array('visitor_key', 'length', 'max'=>45),
			array('created, itinerary_id, customer_id', 'length', 'max'=>10),
			array('end_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('shopcart_id, start_date, end_date, is_favorite, visitor_key, created, itinerary_id, customer_id, current_day_step', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.shopcart_id>10', $this->getTableAlias(true, false)));
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
			'itinerary' => array(self::BELONGS_TO, 'Itinerary', 'itinerary_id'),
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
			'shopcartDetails' => array(self::HAS_MANY, 'ShopcartDetail', 'shopcart_id'),
			'shopcartDetailCount' => array(self::STAT, 'ShopcartDetail', 'shopcart_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'shopcart_id' => 'Shopcart ID',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'is_favorite' => 'Is Favorite',
			'visitor_key' => 'Visitor Key',
			'created' => 'Created',
			'itinerary_id' => 'Itinerary ID',
			'customer_id' => 'Customer ID',
			'current_day_step' => 'Current Day Step',
		);
        foreach ($t as $k => $v) $t[$k] = Yii::t($this->tableName(), $v);
        return $t;
	}

    public function getShopcart($shopcart_id = 0)
    {
        if($shopcart_id){
            return $this->find('shopcart_id = '.intval($shopcart_id));
        }elseif(Yii::app()->user->isGuest){
            return $this->find('visitor_key = "'.session_id().'"');
        }else{
            return $this->find('customer_id = "'.U_ID.'" AND is_favorite < 2');
        }
    }

    public function createShopcart($data)
    {
        $tmp = array();
        $tmp['start_date']      = $data['start_date']?$data['start_date']:date('Y-m-d',strtotime('+1 day'));
        $tmp['end_date']        = $tmp['start_date'];
        $tmp['created']         = time();
        $tmp['itinerary_id']    = 1;
        $tmp['current_day_step']= 0;
        if(Yii::app()->user->isGuest){
            $tmp['visitor_key'] = session_id();
            $tmp['customer_id'] = 1;
        }else{
            $tmp['customer_id'] = U_ID;
        }
        $this->attributes = $tmp;
        $this->isNewRecord = true;
        if($this->save()) return true;
        return false;
    }

	/**
	 * 用户提交的产品添加到购物车.
	 * @return Boolean.
	 */
    public function addGoods($data)
    {
        if(!$data) return false;
        $shopcart = $this->shopcart;
        if(!$shopcart)
        {
            if(!$this->createShopcart($data)) return false;
            $shopcart = $this->shopcart;
        }
        $detailModel = new ShopcartDetail;
        $result = $detailModel->saveGoods($data,$shopcart);
        $this->updatePlanDate();
        return $result;
    }
}