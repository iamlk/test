<?php

/**
 * This is the model class for table "customer_basket_detail".
 *
 * The followings are the available columns in table 'customer_basket_detail':
 * @property int(10) unsigned $customer_basket_detail_id
 * @property date $goods_start_date
 * @property date $goods_end_date
 * @property text $goods_dates
 * @property smallint(4) $total_people
 * @property text $json
 * @property decimal(8,2) $price
 * @property tinyint(4) unsigned $entity_type
 * @property int(10) unsigned $goods_id
 * @property int(10) unsigned $city_id
 * @property int(10) unsigned $provider_id
 * @property int(10) unsigned $customer_basket_id
 * @property smallint(5) unsigned $day_step
 * @property tinyint(1) unsigned $is_deal
 *
 * The followings are the available model relations:
 * @property Customer $provider
 * @property CustomerBasket $customerBasket
 * @property City $city
 * @property Goods $goods
 * @property CustomerBasketDetailAttribute[] $customerBasketDetailAttributes
 * @property mixed $customerBasketDetailAttributeCount
 */
class CustomerBasketDetail extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('entity_type, goods_id, customer_basket_id', 'required'),
			array('total_people, entity_type, day_step, is_deal', 'numerical', 'integerOnly'=>true),
			array('price', 'length', 'max'=>8),
			array('goods_id, city_id, provider_id, customer_basket_id', 'length', 'max'=>10),
			array('goods_start_date, goods_end_date, goods_dates, json', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('customer_basket_detail_id, goods_start_date, goods_end_date, goods_dates, total_people, json, price, entity_type, goods_id, city_id, provider_id, customer_basket_id, day_step, is_deal', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.customer_basket_detail_id>10', $this->getTableAlias(true, false)));
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
			'provider' => array(self::BELONGS_TO, 'Customer', 'provider_id'),
			'customerBasket' => array(self::BELONGS_TO, 'CustomerBasket', 'customer_basket_id'),
			'city' => array(self::BELONGS_TO, 'City', 'city_id'),
			'goods' => array(self::BELONGS_TO, 'Goods', 'goods_id'),
			'customerBasketDetailAttributes' => array(self::HAS_MANY, 'CustomerBasketDetailAttribute', 'customer_basket_detail_id'),
			'customerBasketDetailAttributeCount' => array(self::STAT, 'CustomerBasketDetailAttribute', 'customer_basket_detail_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'customer_basket_detail_id' => 'Customer Basket Detail ID',
			'goods_start_date' => 'Goods Start Date',
			'goods_end_date' => 'Goods End Date',
			'goods_dates' => 'Goods Dates',
			'total_people' => 'Total People',
			'json' => 'Json',
			'price' => 'Price',
			'entity_type' => 'Entity Type',
			'goods_id' => 'Goods ID',
			'city_id' => 'City ID',
			'provider_id' => 'Provider ID',
			'customer_basket_id' => 'Customer Basket ID',
			'day_step' => 'Day Step',
			'is_deal' => 'Is Deal',
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

		$criteria->compare('customer_basket_detail_id',$this->customer_basket_detail_id,true);
		$criteria->compare('goods_start_date',$this->goods_start_date,true);
		$criteria->compare('goods_end_date',$this->goods_end_date,true);
		$criteria->compare('goods_dates',$this->goods_dates,true);
		$criteria->compare('total_people',$this->total_people);
		$criteria->compare('json',$this->json,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('entity_type',$this->entity_type);
		$criteria->compare('goods_id',$this->goods_id,true);
		$criteria->compare('city_id',$this->city_id,true);
		$criteria->compare('provider_id',$this->provider_id,true);
		$criteria->compare('customer_basket_id',$this->customer_basket_id,true);
		$criteria->compare('day_step',$this->day_step);
		$criteria->compare('is_deal',$this->is_deal);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function create($basket_id,&$order)
    {
        $list  = OrderDetail::model()->findAll('order_id='.intval($order->order_id));
        foreach($list as $detail){
            $new  = new CustomerBasketDetail;
            $new->attributes = $detail->attributes;
            $new->customer_basket_id = $basket_id;
            $new->day_step = 0;
            $new->is_deal = 1;
            $new->isNewRecord =true;
            $new->save();
        }
        $order->order_status = Order::CANCEL_STATUS;
        $order->save();
    }

    public function addDetailByCustomerBasketId($basket_id,$data,$start_date)
    {
        $goods_id = intval($data['goods_id']);
        $goods = Goods::model()->findByPk($goods_id);
        if(!$goods) return false;
        $product = $goods->{Goods::$goods_type[$goods->entity_type]};
        $detail = $this->find('customer_basket_id = '.$basket_id.' AND goods_id = '.$goods_id);
        $tmp = array();
        //每次都需要更新的数据
        if($data['goods_start_date']) $tmp['goods_start_date'] = $data['goods_start_date'];
        if($data['goods_end_date']) $tmp['goods_end_date'] = $data['goods_end_date'];
        if($data['adult'] || $data['child']) $tmp['total_people'] = intval($data['adult'])+intval($data['child']);
        //$tmp['day_step'] = intval($data['day_step']);
        //计算相对日期（没有选日期的产品）
        $basket = CustomerBasket::model()->getBasket();
        //插入的时候填写的数据
        if($detail){
            $json = json_decode($detail->json,true);
        }else{//第一次才插入的数据
            $detail = &$this;
            $tmp['customer_basket_id'] = $basket_id;
            $tmp['goods_id'] = $goods_id;
            $tmp['provider_id'] = $goods->customer_id;
            $tmp['entity_type'] = $goods->entity_type;
            if($goods->entity_type==Goods::ENTITY_PRODUCT){
                $tmp['city_id'] = $product->productStartCity->city_id;
            }elseif($goods->entity_type==Goods::ENTITY_PROPERTY){
                $tmp['city_id'] = $product->city_id;
            }
            $json = array();
            $json['img'] = $product->goodsImage->path;
            $json['title'] = $product->addendum->title;
            $json['_id'] = $product->{Goods::$goods_type[$goods->entity_type].'_id'};
        }
        $json['adult'] = intval($data['adult']);
        $json['child'] = intval($data['child']);
        if($_POST['roomtype'] && $_POST['rooms']){
            $type = explode(',',$_POST['roomtype']);
            $room = explode(',',$_POST['rooms']);
            $rooms = array();
            foreach($type as $i => $t){
                $rooms[$t]=intval($room[$i]);
            }
            $json['rooms'] = $rooms;
        }
        $tmp['json'] = json_encode($json);
        $detail->attributes = $tmp;
        //给没有设置日期的自动设置一个日期
        if(strtotime($detail->goods_start_date)<1){
            $detail->goods_start_date = date('Y-m-d',strtotime('+'.$basket->current_day_step.' day',strtotime($start_date)));
        }
        //判断当前产品是否已经可以计算价格了
        $detail->is_deal = 0;
        if($goods->entity_type == Goods::ENTITY_PRODUCT){
            if($product->entity_type==2){//多日游
                $detail->price = $product->countMultiDaysPrice($detail->goods_start_date,$data['adult'],$data['child'],$json['rooms'],$product->product_id);
            }else{
                $detail->price = $product->countOneDayPrice($detail->goods_start_date,$data['adult'],$data['child'],$product->product_id);
            }
            if(strtotime($detail->goods_start_date)>1 && $detail->total_people ){//需要开始日期和人数
                $detail->is_deal = 1;
                if($product->entity_type == 2){
                    $tmp_room = 0;
                    foreach($json['rooms'] as $rt=>$rs){
                        $tmp_room += intval($rs);
                    }
                    if(!$tmp_room) $detail->is_deal = 0;
                }
            }
        }else{
            $detail->price = $product->countTotalPrice($detail->goods_start_date,$detail->goods_end_date,$product->property_id);
            if(strtotime($detail->goods_start_date)<1){//没有选择入住日期
                $json = '';
            }elseif(strtotime($detail->goods_end_date)<1){//只选择了入住日期
                $json = array($detail->goods_start_date);
            }else{
                $i = G4S::countDays($detail->goods_start_date,$detail->goods_end_date);
                $dates403 = Property::model()->getOccupied($detail->goods_id);
                $json = array();
                for($j=0;$j<=$i;$j++){
                    $_date = date('Y-m-d',strtotime('+'.$j.' day',strtotime($detail->goods_start_date)));
                    if(in_array($_date,$dates403)) continue;
                    $json[] = $_date;
                }
            }
            $detail->goods_dates = json_encode($json);
            if(strtotime($detail->goods_start_date)>1 && strtotime($detail->goods_end_date)>1){// && $detail->total_people ){
                $detail->is_deal = 1;
            }
        }
        if(!$detail->save()) return false;
        //$attributeModel = new CustomerBasketDetailAttribute;
        //$attributeModel->addAttributeByDetailId($this->customer_basket_detail_id,$data);
        return true;
    }
}