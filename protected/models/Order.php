<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property int(10) unsigned $order_id
 * @property varchar(45) $first_name
 * @property varchar(45) $last_name
 * @property varchar(45) $cellphone
 * @property varchar(80) $email
 * @property int(10) unsigned $country_id
 * @property date $start_date
 * @property date $end_date
 * @property varchar(45) $visitor_key
 * @property text $json
 * @property decimal(10,2) $payment_total
 * @property char(3) $payment_currency
 * @property decimal(10,5) $payment_currency_rate
 * @property tinyint(2) unsigned $booking_type
 * @property int(10) $created
 * @property timestamp $updated
 * @property varchar(45) $order_code
 * @property smallint(5) unsigned $order_status
 * @property int(10) $expired
 * @property int(10) unsigned $payment_method_id
 * @property int(10) unsigned $customer_id
 * @property int(10) unsigned $itinerary_id
 *
 * The followings are the available model relations:
 * @property Country $country
 * @property Customer $customer
 * @property Itinerary $itinerary
 * @property PaymentMethod $paymentMethod
 * @property OrderDetail[] $orderDetails
 * @property mixed $orderDetailCount
 */
class Order extends BaseActiveRecord
{

    const EXPIRED = 259200;
    const UNPAID_STATUS = 0; //未付款
    const CANCEL_STATUS = 1; //卖家已取消
    const EXPIRED_STATUS = 2; //订单过期未支付
    const PAID_STATUS = 3; //已支付
    const ITINERARY_STATUS = 4; //已分享行程单
    const ORDERSHOW = 0; //0 显示订单
    const ORDERHIDDEN = 1; // 1隐藏订单


    public static $status_name = array(
        0 => '未付款',
        1 => '买家已取消',
        2 => '订单过期未支付',
        3 => '已支付',
        4 => '已分享行程单');

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('start_date, end_date, created, updated, order_code, customer_id',
                    'required'),
            array(
                'booking_type, created, order_status, expired',
                'numerical',
                'integerOnly' => true),
            array(
                'first_name, last_name, cellphone, visitor_key, order_code',
                'length',
                'max' => 45),
            array(
                'email',
                'length',
                'max' => 80),
            array(
                'country_id, payment_total, payment_currency_rate, payment_method_id, customer_id, itinerary_id',
                'length',
                'max' => 10),
            array(
                'payment_currency,ext_status',
                'length',
                'max' => 3),
            array('json', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'order_id, ext_status, first_name, last_name, cellphone, email, country_id, start_date, end_date, visitor_key, json, payment_total, payment_currency, payment_currency_rate, booking_type, created, updated, order_code, order_status, expired, payment_method_id, customer_id, itinerary_id',
                'safe',
                'on' => 'search'),
            );
    }

    /**
     * @return array the query criteria.
     * public function defaultScope()
     * {
     * return array('condition' => sprintf('%s.order_id>10', $this->getTableAlias(true, false)));
     * }
     */

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'country' => array(
                self::BELONGS_TO,
                'Country',
                'country_id'),
            'customer' => array(
                self::BELONGS_TO,
                'Customer',
                'customer_id'),
            'itinerary' => array(
                self::BELONGS_TO,
                'Itinerary',
                'itinerary_id'),
            'paymentMethod' => array(
                self::BELONGS_TO,
                'PaymentMethod',
                'payment_method_id'),
            'orderDetails' => array(
                self::HAS_MANY,
                'OrderDetail',
                'order_id'),
            'orderDetailCount' => array(
                self::STAT,
                'OrderDetail',
                'order_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $t = array(
            'order_id' => 'Order ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'cellphone' => 'Cellphone',
            'email' => 'Email',
            'country_id' => 'Country ID',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'visitor_key' => 'Visitor Key',
            'json' => 'Json',
            'payment_total' => 'Payment Total',
            'payment_currency' => 'Payment Currency',
            'payment_currency_rate' => 'Payment Currency Rate',
            'booking_type' => 'Booking Type',
            'created' => 'Created',
            'updated' => 'Updated',
            'ext_status' => 'extStatus',
            'order_code' => 'Order Code',
            'order_status' => 'Order Status',
            'expired' => 'Expired',
            'payment_method_id' => 'Payment Method ID',
            'customer_id' => 'Customer ID',
            'itinerary_id' => 'Itinerary ID',
            );
        foreach ($t as $k => $v)
            $t[$k] = Yii::t($this->tableName(), $v);
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

        $criteria = new CDbCriteria;

        $criteria->compare('order_id', $this->order_id, true);
        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('cellphone', $this->cellphone, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('country_id', $this->country_id, true);
        $criteria->compare('start_date', $this->start_date, true);
        $criteria->compare('end_date', $this->end_date, true);
        $criteria->compare('visitor_key', $this->visitor_key, true);
        $criteria->compare('json', $this->json, true);
        $criteria->compare('payment_total', $this->payment_total, true);
        $criteria->compare('payment_currency', $this->payment_currency, true);
        $criteria->compare('payment_currency_rate', $this->payment_currency_rate, true);
        $criteria->compare('booking_type', $this->booking_type);
        $criteria->compare('created', $this->created);
        $criteria->compare('updated', $this->updated, true);
        $criteria->compare('order_code', $this->order_code, true);
        $criteria->compare('order_status', $this->order_status);
        $criteria->compare('ext_status', $this->ext_status);
        $criteria->compare('expired', $this->expired);
        $criteria->compare('payment_method_id', $this->payment_method_id, true);
        $criteria->compare('customer_id', $this->customer_id, true);
        $criteria->compare('itinerary_id', $this->itinerary_id, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }

    public function getProvider($criteria = null, $pageSize = 10)
    {
        $criteria = $criteria ? $criteria : new CDbCriteria;
        $criteria->order = $criteria->order ? $criteria->order : 'order_id DESC';
        $dataProvider = new CActiveDataProvider('Order', array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => $pageSize, 'pageVar' => 'qpage'),
            ));
        return $dataProvider;
    }

    public function create($basket, $detail)
    {
        $this->attributes = $basket->attributes;
        $this->country_id = 1;
        //读取通讯录
        $model = CustomerAddressBook::model()->find('customer_id=' . Yii::app()->user->
            customer_id);
        if ($model) {
            $this->first_name = $model->first_name;
            $this->last_name = $model->last_name;
            $this->cellphone = $model->cellphone;
            $this->email = $model->email;
            $this->country_id = $model->country_id;
        }
        $this->created = time();
        $this->order_code = date('Ymd');
        $this->expired = Order::EXPIRED + time();
        $this->updated = date('Y-m-d H:i:s');
        $this->payment_method_id = 11;
        $this->isNewRecord = true;
        $this->save();
        if ($this->order_id) {
            $this->order_code .= str_pad($this->order_id, 8, '0', STR_PAD_LEFT);
            $this->save();
            $r = OrderDetail::model()->create($detail, $this);
        }
        if ($r) {
            //CustomerBasketDetail::model()->deleteAll('customer_basket_id = '.$basket->customer_basket_id);
            $basket->is_favorite = 2;
            $basket->save();
            return $this->order_id;
        } else {
            return false;
        }
    }


    public function checkDetails($detail)
    {
        foreach ($detail as $d) {
            if (!$d->is_deal)
                return false;
        }
        return true;
    }

    /**
     * rick add 2013-8-15   根据类型获取用户的ORDER订单(用户=买家)
     */
    public function getAllBuyerOrder($customer_id = null, $page, $type = null, $classly =
        'all')
    {

        $criteria = new CDbCriteria;
        $criteria->alias = 'order';
        $criteria->order = 'order.created desc';
        $criteria->with = array('orderDetails');
        if ($type != null) {
            $criteria->addCondition("orderDetails.entity_type = " . $type);
        }
        if ($customer_id != null) {

            $criteria->addCondition("order.customer_id = " . $customer_id);
        }
        if ($classly !== 'all') {

            $criteria->addCondition("order.order_status = " . $classly);

        }
        $criteria->addCondition("order.ext_status = " . Order::ORDERSHOW);

        $data = Order::model()->findAll($criteria);
        $dataProvider = new CArrayDataProvider($data, array('pagination' => array('pageSize' =>
                    $page), ));

        return $dataProvider;

    }

    /**
     * rick add 2013-8-15   根据类型获取用户的ORDER订单(用户=卖家)
     */
    public function getAllSellerOrder($provider_id = null, $page, $type = null)
    {

        $criteria = new CDbCriteria;
        $criteria->alias = 'order';
        $criteria->order = 'order.created desc';
        $criteria->with = array('orderDetails');
        if ($type != null) {

            $criteria->addCondition("orderDetails.entity_type = " . $type);
        }

        if ($provider_id != null) {

            $criteria->addCondition("orderDetails.provider_id = " . $provider_id);
        }
        $criteria->addCondition("orderDetails.status_provider = " . Order::ORDERSHOW);
        $data = Order::model()->findAll($criteria);
        $dataProvider = new CArrayDataProvider($data, array('pagination' => array('pageSize' =>
                    $page), ));

        return $dataProvider;

    }
    /**
     * 根据产品类型获取产品的出发地
     */
    public function getGoodsGoAddress($product_id, $good_type)
    {

        switch ($good_type) {

            case 1:
                $data = Yii::app()->db->createCommand()->select('city_id')->from('product_start_city')->
                    where('product_id=:id', array(':id' => $product_id))->queryAll();
                return $this->CityidToCityName($data[0]['city_id']);


        }


    }

    /**
     *   rick  add 城市ID转化为具体城市
     */
    public function CityidToCityName($city_id)
    {

        $data = Yii::app()->db->createCommand()->select('name')->from('city_addendum')->
            where('city_id=:id', array(':id' => $city_id))->queryAll();
        return $data[0]['name'];


    }

    /**
     *   rick  add 国家名字转化为国家ID
     */
    public function getCountryId($country_name)
    {

        $data = Yii::app()->db->createCommand()->select('country_id')->from('country_addendum')->
            where('name=:name', array(':name' => $country_name))->queryRow();
        return $data['country_id'];


    }

    /**
     *   rick  add 账户总支出
     */
    public function AllPayMoney($uid)
    {

        $data = Yii::app()->db->createCommand()->select('sum(payment_total) as money')->
            from('order')->where('customer_id=:id and order_status>2', array(':id' => $uid))->
            queryAll();
        return $data[0]['money'];

    }

    /**
     *  推荐订单
     */
    public function getFriendOrder()
    {

        $data = Yii::app()->db->createCommand()->select('o.*,d.*')->from('order o')->
            join('order_detail d', 'o.order_id=d.order_id')->where('o.order_status > :id and customer_id != :cid',
            array(':id' => 2,':cid'=>U_ID))->limit(5)->queryAll();

        return $data;
    }

    //获取用户买到的商品
    public function getUserBuyAllGoods($id, $type = null, $page = null)
    {

        $data = Yii::app()->db->createCommand()->select('d.*')->from('order_detail d')->
            join('order o', 'd.order_id=o.order_id')->where('o.customer_id=:id and o.order_status >2 and o.ext_status=0 and d.entity_type=:type',
            array(':id' => $id, ':type' => $type))->queryAll();

        $dataProvider = new CArrayDataProvider($data, array('pagination' => array('pageSize' =>
                    $page), ));

        return $dataProvider;

    }

    //rick add  个人中心我是卖家搜索功能(住所 短期行程)
    public function searchOrders($arr, $type, $uid,$page=5)
    {

        $criteria = new CDbCriteria;
        $criteria->alias = 'order';
        $criteria->order = 'order.created desc';
        $criteria->with = array('orderDetails');
        $criteria->addCondition("orderDetails.entity_type = " . $type); //产品类型 1=短期行程 2=住所
        $criteria->addCondition("orderDetails.provider_id = " . $uid); //当前用户卖出的产品订单
        $criteria->addCondition("orderDetails.status_provider = " . Order::ORDERSHOW); //显示没有被删除的订单
        if (!empty($arr['search_order_code'])) {
            $criteria->addCondition("order.order_code = '" . $arr['search_order_code'] . "'"); //订单号条件
        }
        if (!empty($arr['search_order_name'])) {
            //卖家昵称转化为ID
            $cid = Customer::model()->getUserId($arr['search_order_name']);

            $criteria->addCondition("order.customer_id = " . $cid); //卖家姓名条件
        }

        if (!empty($arr['country']) && $arr['country'] !=='all') {
            //国家转化为ID
      
            $criteria->addCondition("order.country_id = " . intval($arr['country'])); //国家查询
        }

        if (isset($arr['order']) && $arr['order'] !=='all') {
            //国家转化为ID
            $criteria->addCondition("order.order_status = " . $arr['order']); 
        }

        if (!empty($arr['search_orderdown_time_start'])) {
            //单独查询下单时间最小开始
            $criteria->addCondition("order.created >= UNIX_TIMESTAMP('".$arr['search_orderdown_time_start']."')");
        }

        if (!empty($arr['search_orderdown_time_end'])) {
            //单独查询下单时间最大结束
            $criteria->addCondition("order.created <= UNIX_TIMESTAMP('".$arr['search_orderdown_time_end']."')");
        }
        if (!empty($arr['search_go_time_start'])) {
            //单独查询出发/入住时间最小开始
            $criteria->addCondition("UNIX_TIMESTAMP(goods_start_date) >= UNIX_TIMESTAMP('" . $arr['search_go_time_start'] . "')");
        }

        if (!empty($arr['search_go_time_end'])) {
            //单独查询出发/入住时间最大结束
            $criteria->addCondition("UNIX_TIMESTAMP(goods_end_date) <= UNIX_TIMESTAMP('" . $arr['search_go_time_end'] . "')");
        }

        $data = Order::model()->findAll($criteria);

        $dataProvider = new CArrayDataProvider($data, array('pagination' => array('pageSize' =>$page),) );

        return $dataProvider;
    }


}
