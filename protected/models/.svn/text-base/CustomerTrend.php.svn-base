<?php

/**
 * This is the model class for table "customer_trend".
 *
 * The followings are the available columns in table 'customer_trend':
 * @property int(10) unsigned $customer_trend_id
 * @property int(10) unsigned $customer_id
 * @property tinyint(3) unsigned $action_type
 * @property varchar(100) $action_title
 * @property varchar(100) $action_url
 * @property tinyint(3) unsigned $ext_type
 * @property text $content
 * @property timestamp $created
 * @property int(10) unsigned $from_customer_trend_id
 *
 * The followings are the available model relations:
 * @property Customer $customer
 * @property CustomerTrendComment[] $customerTrendComments
 * @property mixed $customerTrendCommentCount
 */
class CustomerTrend extends CActiveRecord
{
    const NONE = 0 ;
    const AT = 1 ;
    const PRODUCT = 2;
    const FAVORITE = 3;
    const QUESTION = 4;
    /**
     * avaliable product entiry types
     * @var String[]
     * @author fedora.liu@toursforfun.com
     */
    public $action =  array(
    self::NONE=>'',//
    self::AT=>'在',
    self::PRODUCT=>'发布了商品',
    self::FAVORITE=>'收藏了',
    self::QUESTION=>'进行了问题咨询。'
    );


    public function getCustomerName(){
        $customer = Customer::model()->findByPk($this->customer_id);
        return $customer->full_name;
    }

    public function getFavorite(){
        return 0;
    }

    public function getComment(){
        if($this->customer_trend_id)
            return CustomerTrendComment::model()->count('customer_trend_id='.$this->customer_trend_id);
        else
            return 0;
    }

    public function getTime(){
        $time = time()-strtotime($this->created);
        if($time<60){
            return '刚刚';
        }elseif($time<3600){
            return ceil($time/60).'分钟前';
        }elseif($time<86400){
            return ceil($time/3600).'小时前';
        }
        return $this->created;
    }

    public function getRepublic(){
        return 0;
    }
    public function getAct(){
        return $this->action[$this->action_type];
    }
    public function getExt(){
        return $this->action[$this->ext_type];
    }
    public function getActionUrl(){
        eval('$url =  Yii::app()->'.$this->action_url.';');
        return $url;
    }

    public function recordWeibo($content){
        $this->content=$content;
        $this->customer_id = Yii::app()->user->getCustomer_id();
        $this->action_type = self::NONE;
        $this->ext_type = self::NONE;
        $this->created = date('Y-m-d H:i:s');
        if($this->validate())
        {
            $this->save(false);
            return $this->attributes['question_id'];
        }else{
            return 0;
        }
    }

    /**
     * @return CActiveDataProvider
     */
    public function getProvider($attributes=array(),$pageSize=10,$order='customer_trend_id DESC'){
        $condition = '';
        if($attributes){
            $condition = '1=1';
            foreach($attributes as $key=>$value){
                $condition .= ' AND `t`.`'.$key.'` ="'.$value.'"';
            }
        }
    	$dataProvider=new CActiveDataProvider('CustomerTrend', array(
    			'criteria'=>array('condition'=>$condition,'order'=>$order),
                'pagination'=>array('pageSize'=>$pageSize,'pageVar'=>'qpage'),
    	));
    	return $dataProvider;
    }

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CustomerTrend the static model class
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
		return 'customer_trend';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_id, created', 'required'),
			array('action_type, ext_type', 'numerical', 'integerOnly'=>true),
			array('customer_id, from_customer_trend_id', 'length', 'max'=>10),
			array('action_title, action_url', 'length', 'max'=>100),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('customer_trend_id, customer_id, action_type, action_title, action_url, ext_type, content, created, from_customer_trend_id', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.customer_trend_id>10', $this->getTableAlias(true, false)));
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
			'customerTrendComments' => array(self::HAS_MANY, 'CustomerTrendComment', 'customer_trend_id'),
			'customerTrendCommentCount' => array(self::STAT, 'customerTrendComment', 'customer_trend_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'customer_trend_id' => 'Customer Trend ID',
			'customer_id' => 'Customer ID',
			'action_type' => 'Action Type',
			'action_title' => 'Action Title',
			'action_url' => 'Action Url',
			'ext_type' => 'Ext Type',
			'content' => 'Content',
			'created' => 'Created',
			'from_customer_trend_id' => 'From Customer Trend ID',
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

		$criteria->compare('customer_trend_id',$this->customer_trend_id,true);
		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('action_type',$this->action_type);
		$criteria->compare('action_title',$this->action_title,true);
		$criteria->compare('action_url',$this->action_url,true);
		$criteria->compare('ext_type',$this->ext_type);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('from_customer_trend_id',$this->from_customer_trend_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}