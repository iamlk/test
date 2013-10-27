<?php

/**
 * This is the model class for table "admin_msg_tmp".
 *
 * The followings are the available columns in table 'admin_msg_tmp':
 * @property int(10) unsigned $_id
 * @property varchar(250) $title
 * @property text $content
 * @property int(10) unsigned $created
 * @property int(10) unsigned $updated
 * @property int(10) unsigned $admin_id
 * @property int(10) unsigned $send_count
 * @property tinyint(2) $send_type
 * @property varchar(45) $msg_key
 * @property tinyint(3) unsigned $msg_type
 * @property varchar(45) $signed
 *
 * The followings are the available model relations:
 * @property Admin $admin
 */
class AdminMsgTmp extends BaseActiveRecord
{

    const SEND_HANDLE   = 0; //手动发送
    const SEND_PHP      = 1; //程序发送
    const SEND_SERVER   = 2; //计划任务发送
    
    const TYPE_INNER_SMS= 0; //站内信
    const TYPE_EMAIL    = 1; //邮箱
    const TYPE_SMS      = 2; //短信
    
    public static $msgType = array('站内信','邮箱','短信');
    public static $sendType= array('手动发送','程序发送','计划任务');
    
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content, created, updated, admin_id, send_count, send_type, msg_type, signed', 'required'),
			array('send_type, msg_type', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>250),
			array('created, updated, admin_id, send_count', 'length', 'max'=>10),
			array('msg_key, signed', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('_id, title, content, created, updated, admin_id, send_count, send_type, msg_key, msg_type, signed', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'_id' => 'ID',
			'title' => 'Title',
			'content' => 'Content',
			'created' => 'Created',
			'updated' => 'Updated',
			'admin_id' => 'Admin ID',
			'send_count' => 'Send Count',
			'send_type' => 'Send Type',
			'msg_key' => 'Msg Key',
			'msg_type' => 'Msg Type',
			'signed' => 'Signed',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('admin_id',$this->admin_id,true);
		$criteria->compare('send_count',$this->send_count,true);
		$criteria->compare('send_type',$this->send_type);
		$criteria->compare('msg_key',$this->msg_key,true);
		$criteria->compare('msg_type',$this->msg_type);
		$criteria->compare('signed',$this->signed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    //Fedora
    public function getProvider($criteria = null, $pageSize = 10)
    {
        $criteria = $criteria ? $criteria : new CDbCriteria;
        $criteria->order = $criteria->order ? $criteria->order : '_id DESC';
        $dataProvider = new CActiveDataProvider('AdminMsgTmp', array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => $pageSize, 'pageVar' => 'qpage'),
            ));
        return $dataProvider;
    }
}