<?php

/**
 * This is the model class for table "business".
 *
 * The followings are the available columns in table 'business':
 * @property int(10) unsigned $_id
 * @property int(10) unsigned $business_id
 * @property varchar(45) $position
 * @property tinyint(3) unsigned $guide_experience
 * @property decimal(8,2) $hour_price
 * @property decimal(8,2) $day_price
 * @property varchar(45) $traffic
 * @property text $introduction
 *
 * The followings are the available model relations:
 * @property Customer $business
 * @property Property[] $properties
 * @property mixed $propertyCount
 */
class Business extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Business the static model class
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
		return 'business';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('business_id, position, guide_experience, hour_price, day_price, traffic, introduction', 'required'),
			array('guide_experience', 'numerical', 'integerOnly'=>true),
			array('business_id', 'length', 'max'=>10),
			array('position, traffic', 'length', 'max'=>45),
			array('hour_price, day_price', 'length', 'max'=>8),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('_id, business_id, position, guide_experience, hour_price, day_price, traffic, introduction', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.business_id>10', $this->getTableAlias(true, false)));
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'customer' => array(self::BELONGS_TO, 'Customer', 'business_id'),
			'properties' => array(self::HAS_MANY, 'Property', 'business_id'),
			'propertyCount' => array(self::STAT, 'property', 'business_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'_id' => 'ID',
			'business_id' => 'Business ID',
			'position' => 'Position',
			'guide_experience' => 'Guide Experience',
			'hour_price' => 'Hour Price',
			'day_price' => 'Day Price',
			'traffic' => 'Traffic',
			'introduction' => 'Introduction',
		);
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
		$criteria->compare('business_id',$this->business_id,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('guide_experience',$this->guide_experience);
		$criteria->compare('hour_price',$this->hour_price,true);
		$criteria->compare('day_price',$this->day_price,true);
		$criteria->compare('traffic',$this->traffic,true);
		$criteria->compare('introduction',$this->introduction,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}