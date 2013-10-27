<?php

/**
 * This is the model class for table "travel_companion_application".
 *
 * The followings are the available columns in table 'travel_companion_application':
 * @property int(10) unsigned $travel_companion_application_id
 * @property varchar(50) $name_en
 * @property varchar(50) $name_cn
 * @property enum('0','1','2') $gender
 * @property varchar(50) $email
 * @property varchar(50) $phone
 * @property smallint(6) $people_num
 * @property text $content
 * @property enum('0','1','2') $verify_status
 * @property tinytext $verify_status_sms
 * @property timestamp $date_time
 * @property int(10) unsigned $customer_id
 * @property int(10) unsigned $travel_companion_id
 *
 * The followings are the available model relations:
 * @property Customer $customer
 * @property TravelCompanion $travelCompanion
 */
class TravelCompanionApplication extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name_en, name_cn, gender, email, phone, content, verify_status, customer_id, travel_companion_id', 'required'),
			array('people_num', 'numerical', 'integerOnly'=>true),
			array('name_en, name_cn, email, phone', 'length', 'max'=>50),
			array('gender, verify_status', 'length', 'max'=>1),
			array('customer_id, travel_companion_id', 'length', 'max'=>10),
			array('date_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('travel_companion_application_id, name_en, name_cn, gender, email, phone, people_num, content, verify_status, verify_status_sms, date_time, customer_id, travel_companion_id', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.travel_companion_application_id>10', $this->getTableAlias(true, false)));
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
			'travelCompanion' => array(self::BELONGS_TO, 'TravelCompanion', 'travel_companion_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'travel_companion_application_id' => 'Travel Companion Application ID',
			'name_en' => 'Name En',
			'name_cn' => 'Name Cn',
			'gender' => 'Gender',
			'email' => 'Email',
			'phone' => 'Phone',
			'people_num' => 'People Num',
			'content' => 'Content',
			'verify_status' => 'Verify Status',
			'verify_status_sms' => 'Verify Status Sms',
			'date_time' => 'Date Time',
			'customer_id' => 'Customer ID',
			'travel_companion_id' => 'Travel Companion ID',
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

		$criteria->compare('travel_companion_application_id',$this->travel_companion_application_id,true);
		$criteria->compare('name_en',$this->name_en,true);
		$criteria->compare('name_cn',$this->name_cn,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('people_num',$this->people_num);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('verify_status',$this->verify_status,true);
		$criteria->compare('verify_status_sms',$this->verify_status_sms,true);
		$criteria->compare('date_time',$this->date_time,true);
		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('travel_companion_id',$this->travel_companion_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}