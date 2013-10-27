<?php

/**
 * This is the model class for table "admin_action_log".
 *
 * The followings are the available columns in table 'admin_action_log':
 * @property int(10) unsigned $_id
 * @property int(10) unsigned $admin_id
 * @property int(10) unsigned $admin_group_id
 * @property varchar(45) $created
 * @property varchar(45) $route
 * @property varchar(255) $uri
 * @property tinyint(3) unsigned $is_post
 * @property varchar(45) $ip
 * @property text $user_agent
 * @property varchar(45) $port
 *
 * The followings are the available model relations:
 * @property Admin $admin
 * @property AdminGroup $adminGroup
 */
class AdminActionLog extends BaseActiveRecord
{

    public $logPath = './protected/admin_log/action_log';
    
    public function append($route)
    {
        $logPath = $this->logPath;
        if(!is_dir($logPath)){
            mkdir($logPath,0777);
            chmod($logPath,0777);
        }
        $route = strtolower(str_replace('/','-',$route));
        $route_path = $logPath.'/'.$route;
        if(!is_dir($route_path)){
            mkdir($route_path,0777);
            chmod($route_path,0777);
        }
        $file_path = $route_path.'/'.date('Y-m-d');
        
        $data = array();
        $data['admin_id'] = A_ID;
        $data['admin_group_id'] = Yii::app()->user->group_id;
        $data['created'] = date('Y-m-d H:i:s');
        $data['route'] = $route;
        $data['uri'] = str_replace('/index.php?','',$_SERVER['REQUEST_URI']);
        $data['is_post'] = $_POST?'POST':'GET';
        $data['ip'] = G4S::getIp();
        $data['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        $data['port'] = $_SERVER['REMOTE_PORT'];
        if(file_exists($file_path)){
            file_put_contents($file_path,"\r\n".json_encode($data),FILE_APPEND);
        }else{
            file_put_contents($file_path,json_encode($data));
        }
        
    }
    
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('admin_id, admin_group_id, created, route, uri', 'required'),
			array('admin_id, admin_group_id', 'length', 'max'=>10),
			array('is_post,created, route, ip, port', 'length', 'max'=>45),
			array('uri', 'length', 'max'=>255),
			array('user_agent', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('_id, admin_id, admin_group_id, created, route, uri, is_post, ip, user_agent, port', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
    public function defaultScope()
    {
        return array('condition' => sprintf('%s._id>10', $this->getTableAlias(true, false)));
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
			'admin' => array(self::BELONGS_TO, 'Admin', 'admin_id'),
			'adminGroup' => array(self::BELONGS_TO, 'AdminGroup', 'admin_group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'_id' => 'ID',
			'admin_id' => 'Admin ID',
			'admin_group_id' => 'Admin Group ID',
			'created' => 'Created',
			'route' => 'Route',
			'uri' => 'Uri',
			'is_post' => 'Is Post',
			'ip' => 'Ip',
			'user_agent' => 'User Agent',
			'port' => 'Port',
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
		$criteria->compare('admin_id',$this->admin_id,true);
		$criteria->compare('admin_group_id',$this->admin_group_id,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('route',$this->route,true);
		$criteria->compare('uri',$this->uri,true);
		$criteria->compare('is_post',$this->is_post);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('port',$this->port,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}