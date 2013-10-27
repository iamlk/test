<?php

/**
 * This is the model class for table "admin".
 *
 * The followings are the available columns in table 'admin':
 * @property int(10) unsigned $admin_id
 * @property varchar(120) $username
 * @property varchar(32) $password
 * @property tinyint(1) unsigned $is_active
 * @property int(10) unsigned $admin_group_id
 * @property int(10) unsigned $created
 * @property int(10) unsigned $parend_admin_id
 *
 * The followings are the available model relations:
 * @property AdminGroup $adminGroup
 * @property AdminMsgLog[] $adminMsgLogs
 * @property mixed $adminMsgLogCount
 * @property AdminMsgTmp[] $adminMsgTmps
 * @property mixed $adminMsgTmpCount
 * @property AlloAdminGroup[] $alloAdminGroups
 * @property mixed $alloAdminGroupCount
 */
class Admin extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, admin_group_id, created, parend_admin_id', 'required'),
			array('is_active', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>120),
			array('password', 'length', 'max'=>32),
			array('admin_group_id, created, parend_admin_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('admin_id, username, password, is_active, admin_group_id, created, parend_admin_id', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.admin_id>10', $this->getTableAlias(true, false)));
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
			'adminGroup' => array(self::BELONGS_TO, 'AdminGroup', 'admin_group_id'),
			'adminMsgLogs' => array(self::HAS_MANY, 'AdminMsgLog', 'admin_id'),
			'adminMsgLogCount' => array(self::STAT, 'AdminMsgLog', 'admin_id'),
			'adminMsgTmps' => array(self::HAS_MANY, 'AdminMsgTmp', 'admin_id'),
			'adminMsgTmpCount' => array(self::STAT, 'AdminMsgTmp', 'admin_id'),
			'alloAdminGroups' => array(self::HAS_MANY, 'AlloAdminGroup', 'admin_id'),
			'alloAdminGroupCount' => array(self::STAT, 'AlloAdminGroup', 'admin_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'admin_id' => 'Admin ID',
			'username' => 'Username',
			'password' => 'Password',
			'is_active' => 'Is Active',
			'admin_group_id' => 'Admin Group ID',
			'created' => 'Created',
			'parend_admin_id' => 'Parend Admin ID',
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

		$criteria->compare('admin_id',$this->admin_id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('admin_group_id',$this->admin_group_id,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('parend_admin_id',$this->parend_admin_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    /**
     * return array()
     *  @author leo 
     * @note 应用于后台管理左边菜单配置项
    */
    public  function getMenuConfig()
    {
        $file = Yii::app()->basePath.'/config/menu_conf.php';
        if(!is_file($file)) 
        {
            Throw new CException("File not find: $file---".date('Y-m-d'));
        }
        return  include_once($file);
    }
}