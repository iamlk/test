<?php

/**
 * This is the model class for table "tourguide".
 *
 * The followings are the available columns in table 'tourguide':
 * @property int(10) unsigned $_id
 * @property int(10) unsigned $tourguide_id
 * @property varchar(45) $position
 * @property tinyint(3) unsigned $guide_experience
 * @property decimal(8,2) $hour_price
 * @property decimal(8,2) $day_price
 * @property varchar(45) $traffic
 * @property text $introduction
 *
 * The followings are the available model relations:
 * @property Customer $tourguide
 */
class Tourguide extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tourguide_id, position, guide_experience, hour_price, day_price, traffic, introduction', 'required'),
			array('guide_experience', 'numerical', 'integerOnly'=>true),
			array('tourguide_id', 'length', 'max'=>10),
			array('position, traffic', 'length', 'max'=>45),
			array('hour_price, day_price', 'length', 'max'=>8),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('_id, tourguide_id, position, guide_experience, hour_price, day_price, traffic, introduction', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s._id>10', $this->getTableAlias(true, false)));
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'tourguide' => array(self::BELONGS_TO, 'Customer', 'tourguide_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'_id' => 'ID',
			'tourguide_id' => 'Tourguide ID',
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
		$criteria->compare('tourguide_id',$this->tourguide_id,true);
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