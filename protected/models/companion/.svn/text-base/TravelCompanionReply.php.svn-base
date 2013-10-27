<?php

/**
 * This is the model class for table "travel_companion_reply".
 *
 * The followings are the available columns in table 'travel_companion_reply':
 * @property int(10) unsigned $travel_companion_reply_id
 * @property int(10) unsigned $parent_travel_companion_reply_id
 * @property text $content
 * @property tinyint(1) $is_private
 * @property timestamp $created
 * @property timestamp $updated
 * @property int(10) unsigned $travel_companion_id
 * @property int(10) unsigned $customer_id
 *
 * The followings are the available model relations:
 * @property TravelCompanionReply $parentTravelCompanionReply
 * @property TravelCompanionReply[] $travelCompanionReplies
 * @property mixed $travelCompanionReplyCount
 * @property Customer $customer
 * @property TravelCompanion $travelCompanion
 */
class TravelCompanionReply extends BaseActiveRecord
{
    public function getProvider($attributes=array(),$pageSize=10,$order='travel_companion_reply_id DESC'){
        $criteria = new CDbCriteria;
        if($attributes){
            foreach($attributes as $key=>$value){
                $criteria->addCondition('`t`.`'.$key.'` ="'.$value.'"');
            }
        }
        $criteria->order = $order;
    	$dataProvider=new CActiveDataProvider('TravelCompanionReply', array(
    			'criteria'=>$criteria,
                'pagination'=>array('pageSize'=>$pageSize,'pageVar'=>'qpage'),
    	));
    	return $dataProvider;
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content, updated, travel_companion_id, customer_id', 'required'),
			array('is_private', 'numerical', 'integerOnly'=>true),
			array('parent_travel_companion_reply_id, travel_companion_id, customer_id', 'length', 'max'=>10),
			array('created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('travel_companion_reply_id, parent_travel_companion_reply_id, content, is_private, created, updated, travel_companion_id, customer_id', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.travel_companion_reply_id>10', $this->getTableAlias(true, false)));
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'parentTravelCompanionReply' => array(self::BELONGS_TO, 'TravelCompanionReply', 'parent_travel_companion_reply_id'),
			'travelCompanionReplies' => array(self::HAS_MANY, 'TravelCompanionReply', 'parent_travel_companion_reply_id'),
			'travelCompanionReplyCount' => array(self::STAT, 'TravelCompanionReply', 'parent_travel_companion_reply_id'),
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
			'travelCompanion' => array(self::BELONGS_TO, 'TravelCompanion', 'travel_companion_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'travel_companion_reply_id' => 'Travel Companion Reply ID',
			'parent_travel_companion_reply_id' => 'Parent Travel Companion Reply ID',
			'content' => 'Content',
			'is_private' => 'Is Private',
			'created' => 'Created',
			'updated' => 'Updated',
			'travel_companion_id' => 'Travel Companion ID',
			'customer_id' => 'Customer ID',
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

		$criteria->compare('travel_companion_reply_id',$this->travel_companion_reply_id,true);
		$criteria->compare('parent_travel_companion_reply_id',$this->parent_travel_companion_reply_id,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('is_private',$this->is_private);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('travel_companion_id',$this->travel_companion_id,true);
		$criteria->compare('customer_id',$this->customer_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}