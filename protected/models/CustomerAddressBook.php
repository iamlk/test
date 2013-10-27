<?php

/**
 * This is the model class for table "customer_address_book".
 *
 * The followings are the available columns in table 'customer_address_book':
 * @property int(10) unsigned $customer_address_book_id
 * @property int(10) unsigned $customer_id
 * @property varchar(45) $first_name
 * @property varchar(45) $last_name
 * @property int(10) unsigned $country_id
 * @property varchar(45) $email
 * @property varchar(45) $telephone
 * @property varchar(45) $cellphone
 *
 * The followings are the available model relations:
 * @property Customer $customer
 */
class CustomerAddressBook extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_id', 'required'),
			array('customer_id, country_id', 'length', 'max'=>10),
			array('first_name, last_name, email, telephone, cellphone', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('customer_address_book_id, customer_id, first_name, last_name, country_id, email, telephone, cellphone', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.customer_address_book_id>10', $this->getTableAlias(true, false)));
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
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'customer_address_book_id' => 'Customer Address Book ID',
			'customer_id' => 'Customer ID',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'country_id' => 'Country ID',
			'email' => 'Email',
			'telephone' => 'Telephone',
			'cellphone' => 'Cellphone',
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

		$criteria->compare('customer_address_book_id',$this->customer_address_book_id,true);
		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('country_id',$this->country_id,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('cellphone',$this->cellphone,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}