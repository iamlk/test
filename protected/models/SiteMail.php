<?php

/**
 * This is the model class for table "site_mail".
 *
 * The followings are the available columns in table 'site_mail':
 * @property int(10) unsigned $_id
 * @property tinyint(4) $type
 * @property varchar(200) $title
 * @property int(10) $content
 * @property int(10) $created
 * @property varchar(20) $owner
 */
class SiteMail extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content', 'required'),
			array('title', 'length', 'max'=>200),
			array('owner', 'length', 'max'=>20),
  	        array('ip,type', 'safe'),
			array('_id, type, title, content, created, owner', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'_id' => 'ID',
			'type' => 'Type',
			'title' => 'Title',
			'content' => 'Content',
			'created' => 'Created',
			'owner' => 'Owner',
            'ip' => 'Ip',
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
		$criteria->compare('type',$this->type);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content);
		$criteria->compare('created',$this->created);
		$criteria->compare('owner',$this->owner,true);
        $criteria->compare('ip',$this->ip,true);
        $criteria->order = '_id desc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    /**
     * 邮件发送邮件类型
    */
    static function getMailType($id = '')
    {
        $_data = array( 0=>'默认其他',
                        1=>'订单邮件',
                        2=>'订阅邮件',
                        3=>'咨询问答',
                        4=>'注册验证',
                        5=>'个人邮件'
        );
        
        return $id !='' ? $_data[$id]:$_data;
    }

    
    
}