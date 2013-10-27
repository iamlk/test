<?php

/**
 * This is the model class for table "push".
 *
 * The followings are the available columns in table 'push':
 * @property int(10) unsigned $_id
 * @property varchar(50) $email
 * @property tinyint(4) $is_active
 * @property char(20) $created
 * @author leo
 */
class Push extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email', 'required'),
            array('name','safe'),
			array('is_active', 'numerical', 'integerOnly'=>true),
			array('email', 'length', 'max'=>50),
			array('created', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('_id, email, is_active, created', 'safe', 'on'=>'search'),
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
			'email' => 'Email',
			'is_active' => 'Is Active',
			'created' => 'Created',
            'name' => 'Name',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('created',$this->created,true);
        	$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    // 订阅
    public function add($data)
    {
        $reson = array('state'=>'0','reason'=>'error');
      
        if(trim($data['email']))
        {
            $cache_key = md5($data['email']);
            
            if(Yii::app()->cache->get($cache_key) === '1')
            {
                $reson['state'] = '0';
                $reson['reason'] = '此邮箱已经订阅成功,感谢您的支持';
                return $reson;
            }
            
            
            $model = Push::model()->findByAttributes(array('email'=>$data['email']));
            if($model)
            {
                // 已经有啦 返回错误状态 但是提示
                $reson['state'] = '0';
                $reson['reason'] = '此邮箱已经订阅成功,感谢您的支持';
            }
            else
            {
                $model = new Push;
                $model->attributes = $data;
                if($model->save(false))
                {
                    $_is_send_ok = false;
                    try
                    {
                         $_is_send_ok = G4S::sendEmail(trim($data['email']));
    
                    }
                    catch( exception $e)
                    {
                        // 已经有啦 返回错误状态 但是提示
                        $reson['state'] = '0';
                        $reson['reason'] = '此邮箱已经订阅成功,感谢您的支持';
                    }
                    
                    if($_is_send_ok)
                    {
                                    // 返回正确状态 并提示
                              $reson['state'] = '1';
                              $reson['reason'] = '此邮箱已经订阅成功';
                              Yii::app()->cache->set($cache_key,'1',300);
                              // 看是否发送邮件提示 或控制器调用邮件发送器
                    }
                     
                }
            }
        }
        return $reson;
        
    }
}