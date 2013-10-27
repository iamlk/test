<?php

/**
 * This is the model class for table "site_history".
 *
 * The followings are the available columns in table 'site_history':
 * @property bigint(20) unsigned $_id
 * @property varchar(40) $hash
 * @property varchar(20) $name
 * @property char(16) $ip
 * @property varchar(100) $uri
 * @property varchar(200) $agent
 * @property int(10) $time
 */
class SiteHistory extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hash, name, ip, uri, agent, request,port,flag', 'safe'),
			array('_id, hash, name, ip, uri, agent, time', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'_id' => 'ID',
			'hash' => 'Hash',
			'name' => 'Name',
			'ip' => 'Ip',
			'uri' => 'Uri',
			'agent' => 'Agent',
			'time' => 'Time',
            'flag' => 'flag',
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

		$criteria->compare('_id',$this->_id,true);
		$criteria->compare('hash',$this->hash,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('uri',$this->uri,true);
		$criteria->compare('agent',$this->agent,true);
		$criteria->compare('time',$this->time,true);
        $criteria->compare('flag',$this->flag,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public static function addHistory()
    {
        $data               = array();
        $data['name']       = Yii::app()->user->customer_name?Yii::app()->user->customer_name:'Guest';
        $data['ip']         = G4S::getIp();
        $data['uri']        = $_SERVER['REQUEST_URI'];
        $data['agent']      = $_SERVER['HTTP_USER_AGENT'];
        $data['port']       = $_SERVER['REMOTE_PORT'];
        $data['request']    = $_SERVER['REQUEST_TIME'];
        $data['hash']       = md5($data['HTTP_USER_AGENT'].$data['uri']);
        $data['flag']       = 0;
        //print_r($data);
        if(!preg_match('/([\.png]|[\.jpg]|[\.bmp]|[\.gif]|[\.ico])$/isU',$data['uri']))
        {
            $obj                = new SiteHistory;
            $obj->attributes    = $data;
            return  $obj->save(false);
        }
        return false;
        
    }
    /**
     * 后台控制访问
    */
     public static function addAdmHistory()
    {
        $data               = array();
        $data['name']       = Yii::app()->user->admin_name?Yii::app()->user->admin_name:'管理员';
        $data['ip']         = G4S::getIp();
        $data['uri']        = $_SERVER['REQUEST_URI'];
        $data['agent']      = $_SERVER['HTTP_USER_AGENT'];
        $data['port']       = $_SERVER['REMOTE_PORT'];
        $data['request']    = $_SERVER['REQUEST_TIME'];
        $data['hash']       = md5($data['HTTP_USER_AGENT'].$data['uri']);
        $data['flag']       = 1;
        //print_r($data);
        if(!preg_match('/([\.png]|[\.jpg]|[\.bmp]|[\.gif]|[\.ico])$/isU',$data['uri']))
        {
            $obj                = new SiteHistory;
            $obj->attributes    = $data;
            return  $obj->save(false);
        }
        return false;
        
    }
    
}