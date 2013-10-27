<?php

/**
 * This is the model class for table "product_one_day_price_override".
 *
 * The followings are the available columns in table 'product_one_day_price_override':
 * @property int(10) unsigned $_id
 * @property int(10) $start_date
 * @property int(10) $end_date
 * @property tinyint(1) $sunday
 * @property tinyint(1) $monday
 * @property tinyint(1) $tuesday
 * @property tinyint(1) $wednesday
 * @property tinyint(1) $thursday
 * @property tinyint(1) $friday
 * @property tinyint(1) $saturday
 * @property decimal(10,2) $price_adult
 * @property decimal(10,2) $price_kids
 * @property int(10) unsigned $product_id
 * @property int(10) $create_time
 *
 * The followings are the available model relations:
 * @property Product $product
 */
class ProductOneDayPriceOverride extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('start_date, end_date, price_adult, price_kids, product_id', 'required'),
		//	array('sunday, monday, tuesday, wednesday, thursday, friday, saturday', 'numerical', 'integerOnly'=>true),
			array('price_adult, price_kids, product_id', 'length', 'max'=>10),
            array('sunday, monday, tuesday, wednesday, thursday, friday, saturday','in','range'=>array(0,1)),
            array(
                'product_id',
                'exist',
                'className' => 'Product'),
            array(
                'start_date,end_date',
                'date',
                'format' => array('yyyy-MM-dd')),
            array(
                'price_adult, price_kids',
                'numerical',
                'min' => 0,
                'max' => 99999999.99,
                'numberPattern' => '/^([1-9]\d{1,7}|\d)(\.\d{1,2})?$/'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('_id, start_date, end_date, sunday, monday, tuesday, wednesday, thursday, friday, saturday, price_adult, price_kids, product_id, create_time', 'safe', 'on'=>'search'),
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
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
        	$t = array(
			'_id' => 'ID',
			'start_date' => '开始日期',
			'end_date' => '结束日期',
			'sunday' => 'SUN',
			'monday' => 'MON',
			'tuesday' => 'TUE',
			'wednesday' => 'WED',
			'thursday' => 'THU',
			'friday' => 'FRI',
			'saturday' => 'SAT',
			'price_adult' => '成人价格',
			'price_kids' => '儿童价格',
			'product_id' => 'Product ID',
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
		$criteria->compare('start_date',$this->start_date);
		$criteria->compare('end_date',$this->end_date);
		$criteria->compare('sunday',$this->sunday);
		$criteria->compare('monday',$this->monday);
		$criteria->compare('tuesday',$this->tuesday);
		$criteria->compare('wednesday',$this->wednesday);
		$criteria->compare('thursday',$this->thursday);
		$criteria->compare('friday',$this->friday);
		$criteria->compare('saturday',$this->saturday);
		$criteria->compare('price_adult',$this->price_adult,true);
		$criteria->compare('price_kids',$this->price_kids,true);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('create_time',$this->create_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}