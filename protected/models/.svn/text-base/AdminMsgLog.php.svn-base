<?php

/**
 * This is the model class for table "admin_msg_log".
 *
 * The followings are the available columns in table 'admin_msg_log':
 * @property int(10) unsigned $_id
 * @property int(10) unsigned $admin_id
 * @property varchar(250) $title
 * @property text $content
 * @property varchar(45) $send_total
 * @property int(10) unsigned $arrived
 * @property int(10) unsigned $read
 * @property int(10) unsigned $created
 * @property varchar(45) $signed
 * @property tinyint(3) unsigned $msg_type
 * @property tinyint(3) unsigned $send_type
 *
 * The followings are the available model relations:
 * @property Admin $admin
 */
class AdminMsgLog extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('admin_id, title, content, send_total, arrived, read, created, signed, msg_type, send_type', 'required'),
			array('msg_type, send_type', 'numerical', 'integerOnly'=>true),
			array('admin_id, arrived, read, created', 'length', 'max'=>10),
			array('title', 'length', 'max'=>250),
			array('send_total, signed', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('_id, admin_id, title, content, send_total, arrived, read, created, signed, msg_type, send_type', 'safe', 'on'=>'search'),
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
			'admin_id' => 'Admin ID',
			'title' => 'Title',
			'content' => 'Content',
			'send_total' => 'Send Total',
			'arrived' => 'Arrived',
			'read' => 'Read',
			'created' => 'Created',
			'signed' => 'Signed',
			'msg_type' => 'Msg Type',
			'send_type' => 'Send Type',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('send_total',$this->send_total,true);
		$criteria->compare('arrived',$this->arrived,true);
		$criteria->compare('read',$this->read,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('signed',$this->signed,true);
		$criteria->compare('msg_type',$this->msg_type);
		$criteria->compare('send_type',$this->send_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    //Fedora
    public function getProvider($criteria = null, $pageSize = 10)
    {
        $criteria = $criteria ? $criteria : new CDbCriteria;
        $criteria->order = $criteria->order ? $criteria->order : '_id DESC';
        $dataProvider = new CActiveDataProvider('AdminMsgLog', array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => $pageSize, 'pageVar' => 'qpage'),
            ));
        return $dataProvider;
    }
    
    public function createByMsg($msg,$total,$ok)
    {
        $this->attributes = $msg->attributes;
        $this->admin_id = Yii::app()->user->admin_id;
        $this->_id = null;
        $this->created = time();
        $this->isNewRecord = true;
        $this->send_total = $total;
        $this->arrived = $ok;
        $this->read = 0;
        return $this->save();
    }
}