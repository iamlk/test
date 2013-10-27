<?php

/**
 * This is the model class for table "product_hotel".
 *
 * The followings are the available columns in table 'product_hotel':
 * @property int(10) unsigned $hotel_id
 */
class ProductHotel extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('hotel_id', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.hotel_id>10', $this->getTableAlias(true, false)));
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
            'product' => array(
                self::BELONGS_TO,
                'Product',
                'product_id'),
            'productHotelAddendums' => array(
                self::HAS_MANY,
                'productHotelAddendum',
                'hotel_id'),
            'addendum' => array(
                self::HAS_ONE,
                'ProductHotelAddendum',
                'hotel_id',
                'condition' => 'addendum.language=' . '"' . Yii::app()->language . '"'),
            
            'productHotelImages' => array(
                self::HAS_MANY,
                'ProductHotelImage',
                'hotel_id'),
           
                );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'hotel_id' => 'Hotel ID',
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

		$criteria->compare('hotel_id',$this->hotel_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}