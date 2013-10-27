<?php

/**
 * This is the model class for table "admin_login_history".
 *
 * The followings are the available columns in table 'admin_login_history':
 * @property int(10) unsigned $admin_login_history_id
 * @property timestamp $last_login
 * @property int(11) $login_count
 * @property char(15) $ip
 * @property int(10) unsigned $admin_id
 *
 * The followings are the available model relations:
 * @property Admin $admin
 */
class AdminLoginHistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdminLoginHistory the static model class
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
		return 'admin_login_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login_count, ip, admin_id', 'required'),
			array('login_count', 'numerical', 'integerOnly'=>true),
			array('ip', 'length', 'max'=>15),
			array('admin_id', 'length', 'max'=>10),
			array('last_login', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('admin_login_history_id, last_login, login_count, ip, admin_id', 'safe', 'on'=>'search'),
		);
	}



	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'admin' => array(self::BELONGS_TO, 'Admin', 'admin_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'admin_login_history_id' => 'Admin Login History ID',
			'last_login' => 'Last Login',
			'login_count' => 'Login Count',
			'ip' => 'Ip',
			'admin_id' => 'Admin ID',
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

		$criteria->compare('admin_login_history_id',$this->admin_login_history_id,true);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('login_count',$this->login_count);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('admin_id',$this->admin_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}