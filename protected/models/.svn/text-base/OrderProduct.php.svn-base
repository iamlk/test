<?php

/**
 * This is the model class for table "order_product".
 *
 * The followings are the available columns in table 'order_product':
 * @property int(10) unsigned $order_product_id
 * @property date $product_start_date
 * @property date $product_end_date
 * @property text $product_dates
 * @property smallint(4) $total_people
 * @property text $json
 * @property tinyint(4) $product_type
 * @property int(10) unsigned $product_id
 * @property decimal(10,2) $payment_total
 * @property decimal(10,2) $refund_total
 * @property char(3) $refund_currency
 * @property decimal(10,5) $refund_currency_rate
 * @property datetime $refund_time
 * @property int(10) unsigned $provider_id
 * @property int(10) unsigned $order_id
 */
class OrderProduct extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_end_date, total_people, json, product_type, product_id, provider_id, order_id', 'required'),
			array('total_people, product_type', 'numerical', 'integerOnly'=>true),
			array('product_id, payment_total, refund_total, refund_currency_rate, provider_id, order_id', 'length', 'max'=>10),
			array('refund_currency', 'length', 'max'=>3),
			array('product_start_date, product_dates, refund_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('order_product_id, product_start_date, product_end_date, product_dates, total_people, json, product_type, product_id, payment_total, refund_total, refund_currency, refund_currency_rate, refund_time, provider_id, order_id', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.order_product_id>10', $this->getTableAlias(true, false)));
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
			'order_product_id' => 'Order Product ID',
			'product_start_date' => 'Product Start Date',
			'product_end_date' => 'Product End Date',
			'product_dates' => 'Product Dates',
			'total_people' => 'Total People',
			'json' => 'Json',
			'product_type' => 'Product Type',
			'product_id' => 'Product ID',
			'payment_total' => 'Payment Total',
			'refund_total' => 'Refund Total',
			'refund_currency' => 'Refund Currency',
			'refund_currency_rate' => 'Refund Currency Rate',
			'refund_time' => 'Refund Time',
			'provider_id' => 'Provider ID',
			'order_id' => 'Order ID',
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

		$criteria->compare('order_product_id',$this->order_product_id,true);
		$criteria->compare('product_start_date',$this->product_start_date,true);
		$criteria->compare('product_end_date',$this->product_end_date,true);
		$criteria->compare('product_dates',$this->product_dates,true);
		$criteria->compare('total_people',$this->total_people);
		$criteria->compare('json',$this->json,true);
		$criteria->compare('product_type',$this->product_type);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('payment_total',$this->payment_total,true);
		$criteria->compare('refund_total',$this->refund_total,true);
		$criteria->compare('refund_currency',$this->refund_currency,true);
		$criteria->compare('refund_currency_rate',$this->refund_currency_rate,true);
		$criteria->compare('refund_time',$this->refund_time,true);
		$criteria->compare('provider_id',$this->provider_id,true);
		$criteria->compare('order_id',$this->order_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}