<?php

/**
 * This is the model class for table "restaurant_review".
 *
 * The followings are the available columns in table 'restaurant_review':
 * @property integer $restaurant_review_id
 * @property integer $parent_id
 * @property string $restaurant_id
 * @property string $customer_id
 * @property integer $created
 * @property integer $is_active
 * @property string $content
 */
class RestaurantReview extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RestaurantReview the static model class
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
		return 'restaurant_review';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('restaurant_id, customer_id, created, content', 'required'),
			array('parent_id, created, is_active', 'numerical', 'integerOnly'=>true),
			array('restaurant_id, customer_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('restaurant_review_id, parent_id, restaurant_id, customer_id, created, is_active, content', 'safe', 'on'=>'search'),
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
        'restaurant'=>array(self::BELONGS_TO, 'Restaurant', 'restaurant_id'),
        'addendum' =>array(self::BELONGS_TO, 'Restaurant', 'restaurant_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'restaurant_review_id' => 'Restaurant Review',
			'parent_id' => 'Parent',
			'restaurant_id' => 'Restaurant',
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

		$criteria->compare('restaurant_review_id',$this->restaurant_review_id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('restaurant_id',$this->restaurant_id,true);
		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('content',$this->content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /**
     *  RICK ADD  2013-8-16  获取当前用户餐厅的评论（不包含回复）
     */
    public function getRestaurantReview($uid){

         $data = Yii::app()->db->createCommand()->select('*')->from('restaurant_review')->where('customer_id=:id  and parent_id=0',array(':id' => $uid))->order('created desc')->queryAll();
          return $data;
    }

      /**
     *  RICK ADD  2013-8-16  获取当前用户餐厅的评论的回复
     */
    public function getRestaurantReviewHF($id){

         $data = Yii::app()->db->createCommand()->select('*')->from('restaurant_review')->where('parent_id=:id', array(':id' => $id))->order('created desc')->queryAll();
          return $data;
    }

    /**
     *  RICK ADD  获取用户接受到的餐厅回复
     */
    public function getRestaurantReviewRecive($uid)
    {

        $data = Yii::app()->db->createCommand()
        ->select('*')
        ->from('restaurant a')
        ->join('restaurant_review r', 'a.restaurant_id=r.restaurant_id')
        ->where('a.customer_id=:id and  r.parent_id=0',array(':id' => $uid))
        ->order('r.created desc')
        ->queryAll();

        return $data;


    }



}