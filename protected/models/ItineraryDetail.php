<?php

/**
 * This is the model class for table "itinerary_detail".
 *
 * The followings are the available columns in table 'itinerary_detail':
 * @property int(10) unsigned $_id
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
 * @property int(10) unsigned $itinerary_id
 *
 * The followings are the available model relations:
 * @property Goods $goods
 * @property City $city
 * @property Itinerary $itinerary
 * @property Customer $provider
 */
class ItineraryDetail extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('entity_type, goods_id, itinerary_id', 'required'),
			array('total_people, entity_type', 'numerical', 'integerOnly'=>true),
			array('price', 'length', 'max'=>8),
			array('goods_id, city_id, provider_id, itinerary_id', 'length', 'max'=>10),
			array('goods_start_date, goods_end_date, goods_dates, json', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('_id, goods_start_date, goods_end_date, goods_dates, total_people, json, price, entity_type, goods_id, city_id, provider_id, itinerary_id', 'safe', 'on'=>'search'),
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
			'goods' => array(self::BELONGS_TO, 'Goods', 'goods_id'),
			'city' => array(self::BELONGS_TO, 'City', 'city_id'),
			'itinerary' => array(self::BELONGS_TO, 'Itinerary', 'itinerary_id'),
			'provider' => array(self::BELONGS_TO, 'Customer', 'provider_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'_id' => 'ID',
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
			'itinerary_id' => 'Itinerary ID',
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

		$criteria->compare('_id',$this->_id,true);
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
		$criteria->compare('itinerary_id',$this->itinerary_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function create($order_id,$itinerary_id)
    {
        $details = OrderDetail::model()->findAll('order_id = '.intval($order_id));
        foreach($details as $detail){
            $det = new ItineraryDetail;
            $det->attributes = $detail->attributes;
            $det->itinerary_id = intval($itinerary_id);
            $det->isNewRecord = true;
            $det->save();
        }
    }
    
    
    
    public function buildList($itinerary)
    {
        $plan = array();
        $goods = $this->findAll('itinerary_id = '.$itinerary->itinerary_id);
        $from = $itinerary->start_date;
        $to = $itinerary->end_date;
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
                $i = G4S::countDays($itinerary->start_date,$g->goods_start_date);
                $plan[$i][1]=$g->city_id;
                $plan[$i][]=$g;
            }elseif($g->goods->entity_type == Goods::ENTITY_PROPERTY){
                if(strtotime($g->goods_start_date)<1) {$plan[$g->day_step][]=$g;continue;}
                $dates = json_decode($g->goods_dates,true);
                foreach($dates as $date){
                    $i = G4S::countDays($itinerary->start_date,$date);
                    $plan[$i][1]=$g->city_id;
                    $plan[$i][]=$g;
                }
            }
        }
        return $plan;
    }

}