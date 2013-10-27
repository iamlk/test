<?php

/**
 * This is the model class for table "site_inner_sms".
 *
 * The followings are the available columns in table 'site_inner_sms':
 * @property int(10) unsigned $site_inner_sms_id
 * @property varchar(50) $key_type
 * @property int(10) unsigned $key_id
 * @property text $content
 * @property int(10) unsigned $created
 * @property int(10) unsigned $customer_id
 * @property int(10) unsigned $to_customer_id
 * @property tinyint(3) unsigned $customer_status
 * @property tinyint(3) unsigned $to_customer_status
 *
 * The followings are the available model relations:
 * @property Customer $customer
 * @property Customer $toCustomer
 */
class SiteInnerSms extends BaseActiveRecord
{
    const KEY_TYPE_TRAVEL_COMPANION = 'travel_companion';
    const KEY_TYPE_SYSTEM_TO_ALL    = 'system_to_all';
    const KEY_TYPE_SYSTEM_TO_ONE    = 'system_to_one';
    const KEY_TYPE_USER_TO_USER     = 'customer_to_customer';

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('key_type, content, customer_id, to_customer_id', 'required'),
			array('customer_status, to_customer_status', 'numerical', 'integerOnly'=>true),
			array('key_type', 'length', 'max'=>50),
			array('key_id, created, customer_id, to_customer_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('site_inner_sms_id, key_type, key_id, content, created, customer_id, to_customer_id, customer_status, to_customer_status', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.site_inner_sms_id>10', $this->getTableAlias(true, false)));
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
			'toCustomer' => array(self::BELONGS_TO, 'Customer', 'to_customer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'site_inner_sms_id' => 'Site Inner Sms ID',
			'key_type' => 'Key Type',
			'key_id' => 'Key ID',
			'content' => 'Content',
			'created' => 'Created',
			'customer_id' => 'Customer ID',
			'to_customer_id' => 'To Customer ID',
			'customer_status' => 'Customer Status',
			'to_customer_status' => 'To Customer Status',
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

		$criteria->compare('site_inner_sms_id',$this->site_inner_sms_id,true);
		$criteria->compare('key_type',$this->key_type,true);
		$criteria->compare('key_id',$this->key_id,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('to_customer_id',$this->to_customer_id,true);
		$criteria->compare('customer_status',$this->customer_status);
		$criteria->compare('to_customer_status',$this->to_customer_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * @return int the unread amount
 	 */
	public static function getUnreadAmount($customer_id) {
		if((int)$customer_id) {
			$sql = "select count(*) from ".self::model()->tableName()." where owner_id=$customer_id and to_customer_id=$customer_id and `read`='0'";
			return Yii::app()->db->createCommand($sql)->queryScalar();
		}
	}
    
	/**
	 * @author Fedora
     * @params $type=array('travel_companion','109');默认情况留空
 	 */
    public function send($from_customer_id,$to_customer_id,$content,$type=array())
    {
        if(!$from_customer_id || !$to_customer_id || !$content) return false;
        if(!$type[0] || !$type[1])
        {
            if($from_customer_id == 1 && $to_customer_id == 1)
            {
                $this->key_type = SiteInnerSms::KEY_TYPE_SYSTEM_TO_ALL;
                $this->key_id   = 0;
            }
            elseif($from_customer_id == 1 && $to_customer_id > 1)
            {
                $this->key_type = SiteInnerSms::KEY_TYPE_SYSTEM_TO_ONE;
                $this->key_id   = 0;
            }
            elseif($from_customer_id >1 && $to_customer_id > 1)
            {
                $this->key_type = SiteInnerSms::KEY_TYPE_USER_TO_USER;
                $this->key_id   = 0;
            }
            else
            {
                return false;
            }
        }
        else
        {
            $this->key_type = $type[0];
            $this->key_id   = $type[1];
        }
        $this->content = $content;
        $this->created = time();
        $this->customer_id = $from_customer_id;
        $this->to_customer_id = $to_customer_id;
        $this->customer_status = 0;
        $this->to_customer_status = 0;
        $this->isNewRecord = true;
        $r = $this->save();
        if($to_customer_id == 1)//给所有人发就直接返回
        {
            return $r;
        }
        if(!$r) return false;
        $log = new SiteInnerSmsUser;
        $log_mode = $log->find('customer_id='.intval($to_customer_id));
        
        if($log_mode)//找到该用户的信息LOG
        {
            $log_mode->sms++;
            return $log_mode->save();
        }
        else
        {
            $log->isNewRecord = true;
            $log->customer_id = $to_customer_id;
            $log->log = json_encode(array());
            $log->sms = 1;
            return $log->save();
        }
    }
    
/*
	public function send($from, $to, $content, $related, $active=true) {
		if((int)$from && (int)$to && $content && $related) {
			$this->owner_id = (int)$to;
			$this->customer_id = (int)$from;
			$this->to_customer_id = (int)$to;
			$this->content = trim($content);
			$this->key_type = $related['key'];
			$this->key_id = (int)$related['id'];
			$this->read = '0';
			$this->created = new CDbExpression('NOW()');
			$this->save();
			if(!$active) {
				$another = clone $this;
				$another->owner_id = (int)$from;
				$another->save();
			}
			return true;
		}
		return false;
	}
*/
}