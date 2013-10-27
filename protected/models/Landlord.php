<?php

/**
 * This is the model class for table "landlord".
 *
 * The followings are the available columns in table 'landlord':
 * @property int(10) unsigned $_id
 * @property int(10) unsigned $landlord_id
 *
 * The followings are the available model relations:
 * @property Customer $landlord
 * @property Property[] $properties
 * @property mixed $propertyCount
 */
class Landlord extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('landlord_id', 'required'),
			array('landlord_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('_id, landlord_id', 'safe', 'on'=>'search'),
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
			'landlord' => array(self::BELONGS_TO, 'Customer', 'landlord_id'),
			'properties' => array(self::HAS_MANY, 'Property', 'landlord_id'),
			'propertyCount' => array(self::STAT, 'property', 'landlord_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'_id' => 'ID',
			'landlord_id' => 'Landlord ID',
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
		$criteria->compare('landlord_id',$this->landlord_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}