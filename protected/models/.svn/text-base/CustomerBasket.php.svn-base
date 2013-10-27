<?php

/**
 * This is the model class for table "customer_basket".
 *
 * The followings are the available columns in table 'customer_basket':
 * @property int(10) unsigned $customer_basket_id
 * @property date $start_date
 * @property date $end_date
 * @property tinyint(1) unsigned $is_favorite
 * @property varchar(45) $visitor_key
 * @property int(10) unsigned $created
 * @property int(10) unsigned $itinerary_id
 * @property int(10) unsigned $customer_id
 *
 * The followings are the available model relations:
 * @property Customer $customer
 * @property Itinerary $itinerary
 * @property CustomerBasketDetail[] $customerBasketDetails
 * @property mixed $customerBasketDetailCount
 */
class CustomerBasket extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('start_date, end_date, created, itinerary_id, customer_id, current_day_step', 'required'),
			array('is_favorite', 'numerical', 'integerOnly'=>true),
			array('visitor_key', 'length', 'max'=>45),
			array('created, itinerary_id, customer_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('customer_basket_id, start_date, end_date, is_favorite, visitor_key, created, itinerary_id, customer_id, current_day_step', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.customer_basket_id>10', $this->getTableAlias(true, false)));
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
			'itinerary' => array(self::BELONGS_TO, 'Itinerary', 'itinerary_id'),
			'customerBasketDetails' => array(self::HAS_MANY, 'CustomerBasketDetail', 'customer_basket_id'),
			'customerBasketDetailCount' => array(self::STAT, 'CustomerBasketDetail', 'customer_basket_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'customer_basket_id' => 'Customer Basket ID',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'is_favorite' => 'Is Favorite',
			'visitor_key' => 'Visitor Key',
			'created' => 'Created',
			'itinerary_id' => 'Itinerary ID',
			'customer_id' => 'Customer ID',
            'current_day_step' => 'xxx',
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
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('customer_basket_id',$this->customer_basket_id,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('is_favorite',$this->is_favorite);
		$criteria->compare('visitor_key',$this->visitor_key,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('itinerary_id',$this->itinerary_id,true);
		$criteria->compare('customer_id',$this->customer_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * 用户提交的产品添加到购物车.
	 * @return Boolean.
	 */
    public function addGoods($data)
    {
        if(!$data) return false;
        $basket = $this->basket;
        if(!$basket)
        {
            if(!$this->createBasket($data)) return false;
            $basket = $this->basket;
        }
        //取消了日期限制if(!$basket->isInLimitedDate($data['goods_start_date'],$data['goods_end_date'])) return false;
        $detailModel = new CustomerBasketDetail;
        $result = $detailModel->addDetailByCustomerBasketId($basket->customer_basket_id,$data,$basket->start_date);
        $this->updatePlanDate();
        return $result;
    }

    public function createBasket($data)
    {
        $tmp = array();
        $tmp['start_date'] = $data['start_date']?$data['start_date']:date('Y-m-d',strtotime('+1 day'));
        $tmp['end_date'] = $data['end_date']?$data['end_date']:date('Y-m-d',strtotime('+1 day'));
        $tmp['is_favorite'] = 0;
        $tmp['created'] = time();
        $tmp['itinerary_id'] = 1;
        $tmp['current_day_step'] = intval($data['current_day_step']);
        if(Yii::app()->user->isGuest){
            $tmp['visitor_key'] = session_id();
            $tmp['customer_id'] = 1;
        }else{
            $tmp['visitor_key'] = '.';
            $tmp['customer_id'] = Yii::app()->user->customer_id;
        }
        $this->attributes = $tmp;
        $this->isNewRecord = true;
        if($this->save()) return true;
        return false;
    }

    //检查加入的日期是否超过$last天的跨度
    public function isInLimitedDate($date,$ext_date='')
    {
        $result = true;
        $last = 60;
        //允许添加的产品没有选择日期
        if(!$date) return $result;
        //$detail = CustomerBasketDetail::model()->findAll('goods_start_date > "1980-01-01" AND customer_basket_id = '.$this->customer_basket_id);
        $detail = CustomerBasketDetail::model()->findAll('customer_basket_id = '.$this->customer_basket_id);
        //所有已添加产品都没有选择日期
        if(!$detail) return $result;
        $from = $this->start_date;
        $to = $this->end_date;
        //添加日期跨度超过60天了
        if($date < $from && G4S::countDays($date,$to) > $last || $to < $date && G4S::countDays($from,$date) > $last) $result = false;
        if(!$ext_date) return $result;
        if($ext_date < $from && G4S::countDays($ext_date,$to) > $last || $to < $ext_date && G4S::countDays($from,$ext_date) > $last) $result = false;
        return $result;
    }

    public function getBasket($basket_id = 0)
    {
        if($basket_id){
            return $this->find('customer_basket_id = '.intval($basket_id));
        }elseif(Yii::app()->user->isGuest){
            return $this->find('visitor_key = "'.session_id().'"');
        }else{
            return $this->find('customer_id = "'.Yii::app()->user->customer_id.'" AND is_favorite < 2');
        }
    }
    
    
    //从订单返回编辑
    public function create($order)
    {
        $basket = $this->getBasket();
        if($basket) {$basket->is_favorite = 2; $basket->save();}
        $this->start_date = $order->start_date;
        $this->end_date = $order->end_date;
        $this->is_favorite = 1;
        $this->visitor_key = '.';
        $this->created = time();
        $this->itinerary_id = $order->itinerary_id;
        $this->customer_id = $order->customer_id;
        $this->current_day_step = 0;
        $this->isNewRecord = true;
        $r = $this->save();
        if(!$r) return false;
        CustomerBasketDetail::model()->create($this->customer_basket_id,$order);
        return $this->customer_basket_id;
    }

    //更新行程单的开始日期和结束日期
    public function updatePlanDate()
    {
        $detail = new CustomerBasketDetail;
        $basket = $this->getBasket();
        //没有找到当前行程单
        if(!$basket) return null;
        if(strtotime($basket->end_date)<1){
            $basket->end_date = $basket->start_date;
            $basket->current_day_step = 0;
            $basket->save();
            return $basket;
        }
        $list = $detail->findAll('customer_basket_id = '.$basket->customer_basket_id);
        $from = $to = '';
        //第一次遍历找到
        foreach($list as $d){
            if(strtotime($d->goods_start_date)<1) continue;
            $from = $to = $d->goods_start_date;
            break;
        }
        //如果所有产品都没有填写时间，结束日期就由day_step决定
        if(!$from){
            $max_day_step = $detail->find(array('condition'=>'customer_basket_id='.$basket->customer_basket_id,'order'=>'day_step desc','limit'=>1));
            $basket->end_date = date('Y-m-d',strtotime('+'.$max_day_step->day_step.' day',strtotime($basket->start_date)));
            $basket->save();
            return $basket;
        }
        $last = 0;
        //第二次遍历
        foreach($list as $d){
            if(strtotime($d->goods_start_date)<1){
                if($d->day_step>$last) $last = $d->day_step;
                continue;
            }
            if($d->goods_start_date<$from) $from = $d->goods_start_date;
            if($d->goods_end_date>$to) $to = $d->goods_end_date;
            if($d->goods_start_date>$to) $to = $d->goods_start_date;
        }
        //如果day_step大于选定时间的产品
        if(G4S::countDays($from,$to)<$last){
            $to = date('Y-m-d',strtotime('+'.$last.' day',strtotime($from)));
        }
        if($basket->current_day_step >= G4S::countDays($from,$to)) $basket->current_day_step = 0;
        $basket->start_date = $from;
        $basket->end_date = $to;
        if($basket->save()) return $basket;
        return false;
    }
}