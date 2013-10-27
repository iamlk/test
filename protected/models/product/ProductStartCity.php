<?php

/**
 * This is the model class for table "product_start_city".
 *
 * The followings are the available columns in table 'product_start_city':
 * @property int(10) unsigned $_id
 * @property int(10) unsigned $city_id
 * @property int(10) unsigned $product_id
 *
 * The followings are the available model relations:
 * @property City $city
 */
class ProductStartCity extends BaseActiveRecord
{


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_start_city';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('city_id, product_id', 'required'),
			array('city_id, product_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('_id, city_id, product_id', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s._id>0', $this->getTableAlias(true, false)));
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'city' => array(self::BELONGS_TO, 'City', 'city_id'),
            'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$a =  array(
			'_id' => 'ID',
			'city_id' => '起始城市',
			'product_id' => '商品编号',
		);
        foreach ($a as $k => $v) $a[$k] = Yii::t($this->tableName(), $v);
        return $a;
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
		$criteria->compare('city_id',$this->city_id,true);
		$criteria->compare('product_id',$this->product_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}