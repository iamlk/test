<?php

/**
 * This is the model class for table "order_detail".
 *
 * The followings are the available columns in table 'order_detail':
 * @property int(10) unsigned $order_detail_id
 * @property date $goods_start_date
 * @property date $goods_end_date
 * @property text $goods_dates
 * @property smallint(4) $total_people
 * @property text $json
 * @property decimal(8,2) $price
 * @property tinyint(4) unsigned $entity_type
 * @property int(10) unsigned $goods_id
 * @property int(10) unsigned $order_id
 * @property int(10) unsigned $city_id
 * @property int(10) unsigned $provider_id
 *
 * The followings are the available model relations:
 * @property Goods $goods
 * @property Order $order
 * @property City $city
 * @property Customer $provider
 */
class OrderDetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OrderDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('entity_type, order_status, goods_id, order_id, created', 'required'),
			array('total_people, entity_type, order_status, status_provider, status_customer', 'numerical', 'integerOnly'=>true),
			array('price', 'length', 'max'=>8),
			array('status_provider, status_customer', 'length', 'max'=>3),
			array('goods_id, order_id, city_id, provider_id, created', 'length', 'max'=>10),
			array('goods_start_date, goods_end_date, goods_dates, json', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('status_provider, status_customer, order_detail_id, goods_start_date, goods_end_date, goods_dates, total_people, json, price, entity_type, order_status, goods_id, order_id, city_id, provider_id, created', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.order_detail_id>10', $this->getTableAlias(true, false)));
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
			'goods' => array(self::BELONGS_TO, 'Goods', 'goods_id'),
			'order' => array(self::BELONGS_TO, 'Order', 'order_id'),
			'city' => array(self::BELONGS_TO, 'City', 'city_id'),
			'provider' => array(self::BELONGS_TO, 'Customer', 'provider_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'order_detail_id' => 'Order Detail ID',
			'goods_start_date' => 'Goods Start Date',
			'goods_end_date' => 'Goods End Date',
			'goods_dates' => 'Goods Dates',
			'total_people' => 'Total People',
			'json' => 'Json',
			'price' => 'Price',
			'entity_type' => 'Entity Type',
            'order_status' => 'order_status',
			'goods_id' => 'Goods ID',
			'order_id' => 'Order ID',
			'city_id' => 'City ID',
			'status_provider' => 'status provider',
			'status_customer' => 'status customer',
			'provider_id' => 'Provider ID',
            'created' =>'Created Time'
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

		$criteria->compare('order_detail_id',$this->order_detail_id,true);
		$criteria->compare('goods_start_date',$this->goods_start_date,true);
		$criteria->compare('goods_end_date',$this->goods_end_date,true);
		$criteria->compare('goods_dates',$this->goods_dates,true);
		$criteria->compare('total_people',$this->total_people);
		$criteria->compare('json',$this->json,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('entity_type',$this->entity_type);
		$criteria->compare('order_status',$this->order_status);
		$criteria->compare('goods_id',$this->goods_id,true);
		$criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('status_provider',$this->status_provider);
		$criteria->compare('status_customer',$this->status_customer);
		$criteria->compare('city_id',$this->city_id,true);
		$criteria->compare('provider_id',$this->provider_id,true);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function create($detail,&$order)
    {
        $total =0;
        foreach($detail as $d){
            $dt = new OrderDetail;
            $dt->attributes = $d->attributes;
            $goods = Goods::model()->findByPk($dt->goods_id);
            $dt->provider_id = $goods->customer_id;
            $json = json_decode($dt->json,true);
            $dt->created = time();
            $dt->order_id = $order->order_id;
            //计算价格
            if($dt->entity_type == Goods::ENTITY_PRODUCT){
                if($goods->product->entity_type==2){//多日游
                    $rooms =$json['rooms'];
                    $dt->price = $goods->product->countMultiDaysPrice($dt->goods_start_date,$json['adult'],$json['child'],$rooms,$goods->product->product_id);
                }else{
                    $dt->price = $goods->product->countOneDayPrice($dt->goods_start_date,$json['adult'],$json['child'],$goods->product->product_id);
                }
            }else{
                $dt->price = $goods->property->countTotalPrice($dt->goods_start_date,$dt->goods_end_date,$goods->property->property_id);
            }
            $dt->json = json_encode($json);
            $dt->isNewRecord = true;
            $dt->save();
            $total += $dt->price;
        }
        $order->payment_total = $total;
        $order->save();
        return true;
    }
    
    public function buildList($order)
    {
        $plan = array();
        $goods = $this->findAll('order_id = '.$order->order_id);
        $from = $order->start_date;
        $to = $order->end_date;
        $last = G4S::countDays($from,$to);
        //填充日期
        for($i = 0; $i<=$last; $i++){
            $tmp = array();
            $tmp[] = date('Y年m月d日',strtotime('+'.$i.' day',strtotime($from)));
            $plan[] = $tmp;
        }
        //填充产品
        foreach($goods as $g){
            if($g->goods->entity_type == Goods::ENTITY_PRODUCT){
                if(strtotime($g->goods_start_date)<1) {$plan[$g->day_step][]=$g;continue;}
                $i = G4S::countDays($order->start_date,$g->goods_start_date);
                $plan[$i][1]=$g->city_id;
                $plan[$i][]=$g;
            }elseif($g->goods->entity_type == Goods::ENTITY_PROPERTY){
                if(strtotime($g->goods_start_date)<1) {$plan[$g->day_step][]=$g;continue;}
                $dates = json_decode($g->goods_dates,true);
                $g->created = 1;
                foreach($dates as $date){
                    $i = G4S::countDays($order->start_date,$date);
                    $plan[$i][1]=$g->city_id;
                    $plan[$i][]=$g;
                }
            }
        }
        return $plan;
    }
    
    public function getTotalPeople($order_id)
    {
        $details = $this->findAll('order_id = '.intval($order_id));
        $total =0;
        $count =0;
        foreach($details as $detail){
            if(!$detail->total_people) continue;
            $count++;
            $total +=  $detail->total_people;
        }
        return $count?ceil($total/$count):1;
    }
}