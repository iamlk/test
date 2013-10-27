<?php

/**
 * This is the model class for table "home_page_image".
 *
 * The followings are the available columns in table 'home_page_image':
 * @property string $home_page_image_id
 * @property integer $belong_to_type
 * @property string $belong_to_id
 * @property integer $is_active
 * @property integer $order
 * @property integer $start_time
 * @property integer $end_time
 * @property string $image
 */
class HomePageImage extends CActiveRecord
{
    public $title;
    public $name;
    public $assess;
    public $type;
    public $avatar;
    public $customer_id;
    public $goods_id;
    public $price;
    public $start_hour;
    public $end_hour;
    public $click_count;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HomePageImage the static model class
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
		return 'home_page_image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('belong_to_type, belong_to_id, order, start_time, end_time, image, stars', 'required'),
			array('belong_to_type, is_active, order, start_time, end_time, stars', 'numerical', 'integerOnly'=>true),
			array('belong_to_id', 'length', 'max'=>10),
			array('image, jump_url', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('home_page_image_id, belong_to_type, belong_to_id, is_active, order, start_time, end_time, image, stars, jump_url', 'safe', 'on'=>'search'),
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
        'property' => array(self::BELONGS_TO, 'Property', 'belong_to_id'),
        'propertyAddendum' => array(self::HAS_ONE, 'PropertyAddendum', '', 'on'=>'propertyAddendum.property_id = belong_to_id'),
        'product' => array(self::BELONGS_TO, 'Product', 'belong_to_id'),
        'productAddendum' => array(self::HAS_ONE, 'ProductAddendum', '', 'on'=>'productAddendum.product_id = belong_to_id'),
        'customer'=> array(self::BELONGS_TO, 'Customer', 'customer_id'),
        'review'=>array(self::HAS_MANY, 'ArticleReview', 'article_id'),
        'city'=>array(self::BELONGS_TO, 'City', 'city_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'home_page_image_id' => 'Home Page Image',
			'belong_to_type' => 'belong_to Type',
			'belong_to_id' => 'belong_to',
			'is_active' => 'Is Active',
			'order' => 'Order',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
			'image' => 'Image',
            'stars' => 'Stars',
            'jump_url' => 'Jump Url',
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

		$criteria->compare('home_page_image_id',$this->home_page_image_id,true);
		$criteria->compare('belong_to_type',$this->belong_to_type);
		$criteria->compare('belong_to_id',$this->belong_to_id,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('order',$this->order);
		$criteria->compare('start_time',$this->start_time);
		$criteria->compare('end_time',$this->end_time);
		$criteria->compare('image',$this->image,true);
        $criteria->compare('stars',$this->stars,true);
        $criteria->compare('jump_url',$this->jump_url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function afterFind()
    {
        $this->start_hour = date('H',$this['start_time']);
        $this->end_hour = date('H',$this['end_time']);
        switch($this->belong_to_type)
        {
            case 1:$this->title = $this->property->propertyAddendum['title'];
                   $this->name = $this->property->goods->customer['nick_name'];
                   $this->avatar = $this->property->goods->customer['avator'];
                   $this->customer_id = $this->property->goods['customer_id'];
                   $this->goods_id = $this->property->goods['goods_id'];
                   $this->click_count = $this->property->goods['browse'];
                   $this->price = $this->property->goods['price'];
                   $img_arr = array_fill(0, 5, '<img src="/images/icon/icon_star_%u.gif" />');
                   $reviews_per_sql = "select AVG(rating_total) as rating_total from ".PropertyReview::model()->tableName()." where parent_review_id=0 AND property_id = '".$this->belong_to_id."' AND is_active='1'";
                   $temporary_avg = PropertyReview::model()->findBySql($reviews_per_sql);
                   $all_avg = round($temporary_avg['rating_total']);
                   $this->assess = $this['stars']?'<p class="grade"><span style="width:'.($this['stars']*20).'%">星级</span></p>':'<p class="grade"><span style="width:'.$all_avg.'%">星级</span></p>';
                   $this->type = '度假公寓';
                   break;
            case 2:$this->title = $this->product->productAddendum['title'];
                   $this->name = $this->product->goods->customer['nick_name'];
                   $this->avatar = $this->product->goods->customer['avator'];
                   $this->customer_id = $this->product->goods['customer_id'];
                   $this->goods_id = $this->product->goods['goods_id'];
                   $this->click_count = $this->product->goods['browse'];
                   $this->price = $this->product->goods['price'];
                   $img_arr = array_fill(0, 5, '<img src="/images/icon/icon_star_%u.gif" />');
                   $reviews_per_sql = "select AVG(rating_total) as rating_total from ".ProductReview::model()->tableName()." where parent_review_id=0 AND product_id = '".$this->belong_to_id."' AND is_active='1'";
                   $temporary_avg = ProductReview::model()->findBySql($reviews_per_sql);
                   $all_avg = round($temporary_avg['rating_total']);
                   $this->assess = $this['stars']?'<p class="grade"><span style="width:'.($this['stars']*20).'%">星级</span></p>':'<p class="grade"><span style="width:'.$all_avg.'%">星级</span></p>';
                   $this->type = '短期行程';
                   break;
        }
    }

    /**
     * This function get all name from table
     */
    public function getAll($belong_to_type)
    {
        switch($belong_to_type)
        {
            case 1:$_a[] = '请选择';
                   $sql = 'SELECT title, property_id FROM '.PropertyAddendum::model()->tableName();
                   $data = $this->commandBuilder->createSqlCommand($sql)->queryAll();
                   foreach ($data as $item)
                   {
                     $_a[$item['property_id']] = $item['title'];
                   }
                   break;
            case 2:$_a[] = '请选择';
                   $sql = 'SELECT title, product_id FROM '.ProductAddendum::model()->tableName();
                   $data = $this->commandBuilder->createSqlCommand($sql)->queryAll();
                   foreach ($data as $item)
                   {
                     $_a[$item['product_id']] = $item['title'];
                   }
                   break;
        }
        return $_a;
    }

    /**
     * 自动动态调整
     */
    public function automationSet()
    {
        $model = new HomePageImage;
        $model->updateAll(array('is_active'=>1),'start_time < :current_time AND end_time > :current_time',array(':current_time'=>time()));
        $model->updateAll(array('is_active'=>0),'start_time > :current_time or end_time < :current_time',array(':current_time'=>time()));
    }

    public function searchProduct($params)
    {
        $criteria = new CDbCriteria;
        $criteria->alias = 'product';
        $criteria->with = array('productAddendum');
        if ($params['title']) $criteria->addSearchCondition('`productAddendum`.title', $params['title']);
        $model = Product::model()->findAll($criteria);
        return $model;
    }

    public function searchProperty($params)
    {
        $criteria = new CDbCriteria;
        $criteria->alias = 'property';
        $criteria->with = array('propertyAddendum');
        if ($params['title']) $criteria->addSearchCondition('`propertyAddendum`.title', $params['title']);
        $model = Property::model()->findAll($criteria);
        return $model;
    }
}