<?php

/**
 * This is the model class for table "shopcart_detail".
 *
 * The followings are the available columns in table 'shopcart_detail':
 * @property int(10) unsigned $shopcart_detail_id
 * @property date $start_date
 * @property smallint(5) unsigned $adults
 * @property smallint(5) unsigned $kids
 * @property int(10) unsigned $package_id
 * @property text $json
 * @property decimal(8,2) $price
 * @property tinyint(3) unsigned $entity_type
 * @property int(10) unsigned $goods_id
 * @property int(10) unsigned $city_id
 * @property int(10) unsigned $provider_id
 * @property int(10) unsigned $shopcart_id
 * @property tinyint(3) unsigned $is_deal
 *
 * The followings are the available model relations:
 * @property City $city
 * @property Goods $goods
 * @property Customer $provider
 * @property Shopcart $shopcart
 */
class ShopcartDetail extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('start_date, package_id, json, price, entity_type, goods_id, city_id, provider_id, shopcart_id, is_deal', 'required'),
			array('adults, kids, entity_type, is_deal', 'numerical', 'integerOnly'=>true),
			array('package_id, goods_id, city_id, provider_id, shopcart_id', 'length', 'max'=>10),
			array('price', 'length', 'max'=>8),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('shopcart_detail_id, start_date, adults, kids, package_id, json, price, entity_type, goods_id, city_id, provider_id, shopcart_id, is_deal', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.shopcart_detail_id>10', $this->getTableAlias(true, false)));
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
			'city' => array(self::BELONGS_TO, 'City', 'city_id'),
			'goods' => array(self::BELONGS_TO, 'Goods', 'goods_id'),
			'provider' => array(self::BELONGS_TO, 'Customer', 'provider_id'),
			'shopcart' => array(self::BELONGS_TO, 'Shopcart', 'shopcart_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'shopcart_detail_id' => 'Shopcart Detail ID',
			'start_date' => 'Start Date',
			'adults' => 'Adults',
			'kids' => 'Kids',
			'package_id' => 'Package ID',
			'json' => 'Json',
			'price' => 'Price',
			'entity_type' => 'Entity Type',
			'goods_id' => 'Goods ID',
			'city_id' => 'City ID',
			'provider_id' => 'Provider ID',
			'shopcart_id' => 'Shopcart ID',
			'is_deal' => 'Is Deal',
		);
        foreach ($t as $k => $v) $t[$k] = Yii::t($this->tableName(), $v);
        return $t;
	}
    
    public function saveGoods($data,$shopcart)
    {
        $goods = Goods::model()->findByPk((int)($data['goods_id']));
        if($goods) return '没有找到该产品！';
        $tmp = $goods->entity_type.'|'.($_GET['edit']?1:0);
        switch($tmp)
        {
            case '1|0':
                return $this->addTour($data,$shopcart,$goods);
                break;
            case '1|1':
                return $this->updateTour($data,$shopcart,$goods);
                break;
            case '2|0':
                return $this->addProperty($data,$shopcart,$goods);
                break;
            case '2|1':
                return $this->updateProperty($data,$shopcart,$goods);
                break;
        }
        return 'E-SWITCH未知错误！';
    }
    
    private function setAttributesBy($data,$shopcart,$goods)
    {
        //start_date,price,is_deal比较特殊
        $attributes = array();
        $attributes['adults']     = (int)($data['adults']);
        $attributes['kids']       = (int)($data['kids']);
        $attributes['package_id'] = (int)($data['package_id']);
        $attributes['json']       = json_encode(array('created'=>date('Y-m-d H:i:s'),'customer_id'=>U_ID));
        $attributes['entity_type']= $goods->entity_type;
        $attributes['goods_id']   = $goods->goods_id;
        $attributes['city_id']    = $goods->city_id;
        $attributes['provider_id']= $goods->customer_id;
        $attributes['shopcart_id']= $shopcart->shopcart_id;
        return $attributes;
    }
    
    //判断行程是否可以设置为deal了
    private function checkTour($model)
    {
        if(!$model->adults || !$model->package_id) return false;
        //判定package_id
    }
    
    public function addTour($data,$shopcart,$goods)
    {
        $detail = new ShopcartDetail;
        $detail->attributes = $this->setAttributesBy($data,$shopcart,$goods);
        if(true)
        {
            // TO DO
            $detail->price = 0.00;
            $detail->is_deal=0;
        }
        $return = $detail->save();
        if($return) return true;
        $return = $detail->firstError;
        return $return?$return:'E-ADD-TOUR未知错误！';
    }
    
    public function updateTour($data,$shopcart,$goods)
    {
        $detail = $this->findAllByPk((int)($_GET['edit']));
        if(!$detail) return '没有添加过该产品！';
        $json = json_decode($detail->json,true);
        if($json['customer_id'] != U_ID) return '非法操作！';
        $detail->attributes = $this->setAttributesBy($data,$shopcart,$goods);
        if(true)
        {
            // TO DO
            $detail->price = 0.00;
            $detail->is_deal=0;
        }
        $return = $detail->save();
        if($return) return true;
        $return = $detail->firstError;
        return $return?$return:'E-UPDATE-TOUR未知错误！';
    }
    

    
    
    
    
    
    
    
    
    
    
    
    
    
}