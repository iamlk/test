<?php

/**
 * This is the model class for table "customer_basket_detail_attribute".
 *
 * The followings are the available columns in table 'customer_basket_detail_attribute':
 * @property int(10) unsigned $customer_basket_detail_attribute_id
 * @property char(1) $price_prefix
 * @property decimal(10,2) $option_value_price
 * @property int(10) unsigned $product_option_id
 * @property int(10) unsigned $product_option_value_id
 * @property int(10) unsigned $customer_basket_detail_id
 *
 * The followings are the available model relations:
 * @property CustomerBasketDetail $customerBasketDetail
 */
class CustomerBasketDetailAttribute extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('price_prefix, option_value_price, product_option_id, product_option_value_id, customer_basket_detail_id', 'required'),
			array('price_prefix', 'length', 'max'=>1),
			array('option_value_price, product_option_id, product_option_value_id, customer_basket_detail_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('customer_basket_detail_attribute_id, price_prefix, option_value_price, product_option_id, product_option_value_id, customer_basket_detail_id', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.customer_basket_detail_attribute_id>10', $this->getTableAlias(true, false)));
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'customerBasketDetail' => array(self::BELONGS_TO, 'CustomerBasketDetail', 'customer_basket_detail_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'customer_basket_detail_attribute_id' => 'Customer Basket Detail Attribute ID',
			'price_prefix' => 'Price Prefix',
			'option_value_price' => 'Option Value Price',
			'product_option_id' => 'Product Option ID',
			'product_option_value_id' => 'Product Option Value ID',
			'customer_basket_detail_id' => 'Customer Basket Detail ID',
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

		$criteria->compare('customer_basket_detail_attribute_id',$this->customer_basket_detail_attribute_id,true);
		$criteria->compare('price_prefix',$this->price_prefix,true);
		$criteria->compare('option_value_price',$this->option_value_price,true);
		$criteria->compare('product_option_id',$this->product_option_id,true);
		$criteria->compare('product_option_value_id',$this->product_option_value_id,true);
		$criteria->compare('customer_basket_detail_id',$this->customer_basket_detail_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function addAttributeByDetailId($detail_id,$data)
    {
        $option = $data['option_id'];
        if(!$option) return false;
        foreach($option as $option_id){
            $attribute = $this->find('customer_basket_detail_id = '.$detail_id.' AND product_option_id = '.intval($option_id));
            if($attribute) continue;
            $tmp = array();
            $tmp['price_prefix'] = '+';
            $tmp['option_value_price'] = '0.00';
            $tmp['product_option_id'] = $option_id;
            $tmp['product_option_value_id'] = 'x';
            $tmp['customer_basket_detail_id'] = $detail_id;
            $this->attributes = $tmp;
            $this->customer_basket_detail_attribute_id = null;
            $this->isNewRecord = true;
            $this->save();
        }
        return true;
    }
}