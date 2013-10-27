<?php

/**
 * This is the model class for table "product_review".
 *
 * The followings are the available columns in table 'product_review':
 * @property string $product_review_id
 * @property integer $is_active
 * @property integer $rating_1
 * @property integer $rating_2
 * @property integer $rating_3
 * @property integer $rating_4
 * @property integer $rating_total
 * @property integer $helpful_yes_counter
 * @property integer $helpful_no_counter
 * @property string $created
 * @property string $parent_review_id
 * @property string $product_id
 * @property string $customer_id
 * @property string $name
 * @property string $description
 */
class ProductReview extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductReview the static model class
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
		return 'product_review';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created, product_id, customer_id, name, description', 'required'),
			array('is_active, rating_1, rating_2, rating_3, rating_4, rating_total, helpful_yes_counter, helpful_no_counter, created', 'numerical', 'integerOnly'=>true),
			array('parent_review_id, product_id, customer_id', 'length', 'max'=>10),
			array('name', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('product_review_id, is_active, rating_1, rating_2, rating_3, rating_4, rating_total, helpful_yes_counter, helpful_no_counter, created, parent_review_id, product_id, customer_id, name, description', 'safe', 'on'=>'search'),
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
        'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
        'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
        'parentReview' => array(self::BELONGS_TO, 'ProductReview', 'product_review_id'),
        'replies' => array(self::HAS_MANY, 'ProductReview', 'parent_review_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'product_review_id' => 'Product Review',
			'is_active' => 'Is Active',
			'rating_1' => 'Rating 1',
			'rating_2' => 'Rating 2',
			'rating_3' => 'Rating 3',
			'rating_4' => 'Rating 4',
			'rating_total' => 'Rating Total',
			'helpful_yes_counter' => 'Helpful Yes Counter',
			'helpful_no_counter' => 'Helpful No Counter',
			'created' => 'Created',
			'parent_review_id' => 'Parent Review',
			'product_id' => 'Product',
			'customer_id' => 'Customer',
			'name' => 'Name',
			'description' => 'Description',
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

		$criteria->compare('product_review_id',$this->product_review_id,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('rating_1',$this->rating_1);
		$criteria->compare('rating_2',$this->rating_2);
		$criteria->compare('rating_3',$this->rating_3);
		$criteria->compare('rating_4',$this->rating_4);
		$criteria->compare('rating_total',$this->rating_total);
		$criteria->compare('helpful_yes_counter',$this->helpful_yes_counter);
		$criteria->compare('helpful_no_counter',$this->helpful_no_counter);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('parent_review_id',$this->parent_review_id,true);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /**
     * @author darren
     * @return return AVG
     */
      public function getReviewsPer($product_id){
         $product_id = intval($product_id);
         if(!$product_id) return false;
         $reviews_per_sql = "select AVG(rating_total) as rating_total, AVG(rating_1) as rating_1, AVG(rating_2) as rating_2, AVG(rating_3) as rating_3, AVG(rating_4) as rating_4 from ".ProductReview::model()->tableName()." where parent_review_id=0 AND product_id = '" . $product_id . "' AND is_active='1'";
         $all_avg = ProductReview::model()->findBySql($reviews_per_sql);
         return $all_avg;
      }

    /**
     * @author darren
     * Save reviews to database
     */
    public function saveReviewInfo($review_name, $review_descrition){
        $rating_total = ($this->rating_1+$this->rating_2+$this->rating_3+$this->rating_4)/4;
        $review_status = 1;
//        if ($rating == 100){
//            $review_status = '1';
//        }
        $data_array = array(
            'parent_review_id' => intval($this->parent_review_id),
            'product_id' => intval($this->product_id),
            'customer_id' => intval($this->customer_id),
            'created' => time(),
            'is_active' => $review_status,
            'rating_1'  => $this->rating_1,
            'rating_2'  => $this->rating_2,
            'rating_3'  => $this->rating_3,
            'rating_4'  => $this->rating_4,
            'rating_total' => $rating_total,
            'name' => $review_name,
            'description' => $review_descrition
        );
        $this->attributes = $data_array;
        if($this->insert())
        {
            return true;
        }else{
            $this->addError('review', Yii::t('review', ERROR_SAVE));
            return false;
        }
    }
}