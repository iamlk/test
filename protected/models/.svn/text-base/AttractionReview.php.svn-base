<?php

/**
 * This is the model class for table "attraction_review".
 *
 * The followings are the available columns in table 'attraction_review':
 * @property string $attraction_review_id
 * @property integer $parent_id
 * @property string $attraction_id
 * @property string $customer_id
 * @property integer $created
 * @property integer $is_active
 * @property string $content
 */
class AttractionReview extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AttractionReview the static model class
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
		return 'attraction_review';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('attraction_id, customer_id, created, content', 'required'),
			array('parent_id, created, is_active', 'numerical', 'integerOnly'=>true),
			array('attraction_id, customer_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('attraction_review_id, parent_id, attraction_id, customer_id, created, is_active, content', 'safe', 'on'=>'search'),
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
        'customer'=>array(self::BELONGS_TO, 'Customer', 'customer_id'),
        'attraction'=>array(self::BELONGS_TO, 'Attraction', 'attraction_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'attraction_review_id' => 'Attraction Review',
			'parent_id' => 'Parent',
			'attraction_id' => 'Attraction',
			'customer_id' => 'Customer',
			'created' => 'Created',
			'is_active' => 'Is Active',
			'content' => 'Content',
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

		$criteria->compare('attraction_review_id',$this->attraction_review_id,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('attraction_id',$this->attraction_id,true);
		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('content',$this->content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        /**
     *  RICK ADD  2013-8-22  获取当前用户景点的评论（不包含回复）
     */
    public function getAttractionReview($uid){

         $data = Yii::app()->db->createCommand()->select('*')->from('attraction_review')->where('customer_id=:id  and parent_id=0',array(':id' => $uid))->order('created desc')->queryAll();
          return $data;
    }

      /**
     *  RICK ADD  2013-8-22  获取当前用户景点的评论的回复
     */
    public function getAttractionReviewHF($id){

         $data = Yii::app()->db->createCommand()->select('*')->from('attraction_review')->where(' parent_id=:id', array(':id' => $id))->order('created desc')->queryAll();
          return $data;
    }
    
    
        /**
     *  RICK ADD  获取用户接受到的餐厅回复  (系统用户使用))
     */
    public function getAttractionReviewRecive($uid)
    {

        $data = Yii::app()->db->createCommand()
        ->select('*')
        ->from('attraction a')
        ->join('attraction_review r', 'a.attraction_id=r.attraction_id')
        ->where('a.customer_id=:id and r.parent_id=0',array(':id' => $uid))
        ->order('r.created desc')
        ->queryAll();
    
        return $data;


    }



}