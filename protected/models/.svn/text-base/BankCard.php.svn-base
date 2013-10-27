<?php

/**
 * This is the model class for table "bank_card".
 *
 * The followings are the available columns in table 'bank_card':
 * @property int(10) $bankcard_id
 * @property varchar(60) $bank_name
 * @property varchar(80) $bank_address
 * @property varchar(30) $banknumber
 * @property varchar(50) $banker
 * @property int(10) $created
 * @property int(10) unsigned $customer_id
 *
 * The followings are the available model relations:
 * @property Customer $customer
 */
class BankCard extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bank_name, bank_address, banknumber, banker, created, customer_id', 'required'),
			array('created', 'numerical', 'integerOnly'=>true),
			array('bank_name', 'length', 'max'=>60),
			array('bank_address', 'length', 'max'=>80),
			array('banknumber', 'length', 'max'=>30),
			array('banker', 'length', 'max'=>50),
			array('customer_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('bankcard_id, bank_name, bank_address, banknumber, banker, created, customer_id', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.bankcard_id>10', $this->getTableAlias(true, false)));
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
			'bankcard_id' => 'Bankcard ID',
			'bank_name' => 'Bank Name',
			'bank_address' => 'Bank Address',
			'banknumber' => 'Banknumber',
			'banker' => 'Banker',
			'created' => 'Created',
			'customer_id' => 'Customer ID',
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

		$criteria->compare('bankcard_id',$this->bankcard_id);
		$criteria->compare('bank_name',$this->bank_name,true);
		$criteria->compare('bank_address',$this->bank_address,true);
		$criteria->compare('banknumber',$this->banknumber,true);
		$criteria->compare('banker',$this->banker,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('customer_id',$this->customer_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}