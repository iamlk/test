<?php

/**
 * This is the model class for table "delicacy_review".
 *
 * The followings are the available columns in table 'delicacy_review':
 * @property string $delicacy_review_id
 * @property integer $parent_id
 * @property string $delicacy_id
 * @property string $customer_id
 * @property integer $created
 * @property integer $is_active
 * @property string $content
 */
class DelicacyReview extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DelicacyReview the static model class
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
		return 'delicacy_review';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('delicacy_id, customer_id, created, content', 'required'),
			array('parent_id, created, is_active', 'numerical', 'integerOnly'=>true),
			array('delicacy_id, customer_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('delicacy_review_id, parent_id, delicacy_id, customer_id, created, is_active, content', 'safe', 'on'=>'search'),
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
        'delicacy'=>array(self::BELONGS_TO, 'Delicacy', 'delicacy_id'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'delicacy_review_id' => 'Delicacy Review',
			'parent_id' => 'Parent',
			'delicacy_id' => 'Delicacy',
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

		$criteria->compare('delicacy_review_id',$this->delicacy_review_id,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('delicacy_id',$this->delicacy_id,true);
		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('content',$this->content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        /**
     *  RICK ADD  2013-8-16  获取当前用户美食的评论（不包含回复）
     */
    public function getDelicacyReview($uid){

         $data = Yii::app()->db->createCommand()->select('*')->from('delicacy_review')->where('customer_id=:id  and parent_id=0',array(':id' => $uid))->order('created desc')->queryAll();
          return $data;
    }

      /**
     *  RICK ADD  2013-8-16  获取当前用户美食的评论的回复
     */
    public function getDelicacyReviewHF($id){

         $data = Yii::app()->db->createCommand()->select('*')->from('delicacy_review')->where(' parent_id=:id', array(':id' => $id))->order('created desc')->queryAll();
          return $data;
    }

         /**
     *  RICK ADD  获取用户接收到的美食回复
     */
    public function getDelicacyReviewRecive($uid)
    {
  
        $data = Yii::app()->db->createCommand()
        ->select('*')
        ->from('delicacy a')
        ->join('delicacy_review r', 'a.delicacy_id=r.delicacy_id')
        ->where('a.customer_id=:id and  r.parent_id=0',array(':id' => $uid))
        ->order('r.created desc')
        ->queryAll();
     
        return $data;


    }


}