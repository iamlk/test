<?php

/**
 * This is the model class for table "itinerary_review".
 *
 * The followings are the available columns in table 'itinerary_review':
 * @property int(10) unsigned $itinerary_review_id
 * @property int(10) unsigned $parent_id
 * @property int(10) unsigned $itinerary_id
 * @property int(10) unsigned $customer_id
 * @property int(10) $created
 * @property tinyint(1) $is_active
 * @property text $content
 *
 * The followings are the available model relations:
 * @property Customer $customer
 * @property Itinerary $itinerary
 * @property ItineraryReview $parent
 * @property ItineraryReview[] $itineraryReviews
 * @property mixed $itineraryReviewCount
 */
class ItineraryReview extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('itinerary_id, customer_id, created, content', 'required'),
			array('created, is_active', 'numerical', 'integerOnly'=>true),
			array('parent_id, itinerary_id, customer_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('itinerary_review_id, parent_id, itinerary_id, customer_id, created, is_active, content', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.itinerary_review_id>10', $this->getTableAlias(true, false)));
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
			'itinerary' => array(self::BELONGS_TO, 'Itinerary', 'itinerary_id'),
			'parent' => array(self::BELONGS_TO, 'ItineraryReview', 'parent_id'),
			'itineraryReviews' => array(self::HAS_MANY, 'ItineraryReview', 'parent_id'),
			'itineraryReviewCount' => array(self::STAT, 'ItineraryReview', 'parent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'itinerary_review_id' => 'Itinerary Review ID',
			'parent_id' => 'Parent ID',
			'itinerary_id' => 'Itinerary ID',
			'customer_id' => 'Customer ID',
			'created' => 'Created',
			'is_active' => 'Is Active',
			'content' => 'Content',
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

		$criteria->compare('itinerary_review_id',$this->itinerary_review_id,true);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('itinerary_id',$this->itinerary_id,true);
		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('content',$this->content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getProvider($criteria = null, $pageSize=10){
        $criteria = $criteria?$criteria:new CDbCriteria;
        $criteria->order = $criteria->order?$criteria->order:'itinerary_review_id DESC';
    	$dataProvider=new CActiveDataProvider('ItineraryReview', array(
    			'criteria'=>$criteria,
                'pagination'=>array('pageSize'=>$pageSize,'pageVar'=>'qpage'),
    	));
    	return $dataProvider;
    }
}