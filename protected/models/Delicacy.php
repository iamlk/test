<?php

/**
 * This is the model class for table "delicacy".
 *
 * The followings are the available columns in table 'delicacy':
 * @property string $delicacy_id
 * @property string $food_id
 * @property integer $created
 * @property integer $updated
 * @property string $longitude
 * @property string $latitude
 * @property string $customer_id
 * @property string $image
 */
class Delicacy extends CActiveRecord
{
    public $title;
    public $content;
    public $type;
    public $type_id;
    public $_flatTree;
    public $_pages;
    public $city_id;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Delicacy the static model class
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
		return 'delicacy';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('food_id, order, created, updated, longitude, latitude, customer_id, image', 'required'),
			array('created, updated, visit', 'numerical', 'integerOnly'=>true),
			array('food_id, customer_id, order', 'length', 'max'=>10),
            array(
                'longitude',
                'numerical',
                'min' => -180,
                'max' => 180,
                'numberPattern' => '/^[\+\-]?\d{1,3}\.?\d{0,6}$/'),
            array(
                'latitude',
                'numerical',
                'min' => -90,
                'max' => 90,
                'numberPattern' => '/^[\+\-]?\d{1,2}\.?\d{0,6}$/'),
			array('image', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('delicacy_id, food_id, created, updated, longitude, visit, latitude, customer_id, image, order', 'safe', 'on'=>'search'),
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
        'addendum'=>array(self::HAS_ONE, 'DelicacyAddendum', 'delicacy_id', 'condition'=>'language="'.Yii::app()->language.'"'),
        'customer'=>array(self::BELONGS_TO, 'Customer', 'customer_id'),
        'review'=>array(self::HAS_MANY, 'DelicacyReview', 'delicacy_id'),
        'reviewOne'=>array(self::HAS_ONE, 'DelicacyReview', 'delicacy_id'),//rick add
        'food'=>array(self::BELONGS_TO, 'Food', 'food_id'),
        'shareCount'=>array(self::STAT, 'SiteShare', 'object_id', 'condition'=>'object_type="Delicacy"'),
        'favoriteCount'=>array(self::STAT, 'SiteFavorite', 'object_id', 'condition'=>'object_type="Delicacy"'),
        'reviewCount'=>array(self::STAT, 'DelicacyReview', 'delicacy_id', 'condition'=>'parent_id=0 AND is_active=1'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'delicacy_id' => 'Delicacy',
			'food_id' => 'Food',
			'created' => 'Created',
			'updated' => 'Updated',
            'order' => 'Order',
			'longitude' => 'Longitude',
			'latitude' => 'Latitude',
			'customer_id' => 'Customer',
			'image' => 'Image',
            'visit' => 'Visit',
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

		$criteria->compare('delicacy_id',$this->delicacy_id,true);
		$criteria->compare('food_id',$this->food_id,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);
        $criteria->compare('order',$this->order);
		$criteria->compare('longitude',$this->longitude,true);
		$criteria->compare('latitude',$this->latitude,true);
		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('image',$this->image,true);
        $criteria->compare('visit',$this->visit);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}



	/**
	 * @author darren
	 * @return get sum of all review
	 */
    public function getReviewCount(){
    	$dataProvider = $this->getReviewsProvider();
    	return count($dataProvider->getData());
    }

    /**
     * @author darren
     * @return return all review
     */
    public function getReviewsProvider()
	{
    	$delicacy_id = $this->delicacy_id;
    	// c
     	$criteria = new CDbCriteria();
        $criteria->order = 'delicacy_review_id DESC ';
        $criteria->addCondition('parent_review_id=0');
        $criteria->addCondition('is_active=1');
        $criteria->addCondition('delicacy_id=:delicacy_id');
        $criteria->params = array(':delicacy_id'=>$delicacy_id);
        // d
        $dataProvider = new CActiveDataProvider('delicacyReview',array(
            'criteria'=>$criteria,
            'pagination'=>array('pageVar'=>'review_page'),
        ));
    	return $dataProvider;
    }

    public function getAllReview()
    {
        if ($this->_flatTree == null)
        {
            $criteria = new CDbCriteria();
            $criteria->addCondition('delicacy_id=:delicacyId');
            $criteria->addCondition('is_active=1');
            $criteria->params = array(':delicacyId' => $this['delicacy_id']);
            $dataProvider = new CActiveDataProvider('DelicacyReview', array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 20, 'pageVar' => 'npage'),
            ));
            $this->_pages = $dataProvider->pagination;
            $this->_findChildren($flatTree, $dataProvider->getData(), 0, false, 0, 0);
            $this->_flatTree = $flatTree;
        }

        return array('reviews'=>$this->_flatTree,'pages'=>$this->_pages);
    }

    private function _findChildren(&$reviews, $data, $parent_id, $customer_name, $customer_id, $level=0)
    {
        //echo count($data);exit;
        reset($data);
        while (list($key, $row) = each($data))
        {
            if (!$customer_name == false)
            {
                if ($row['parent_id'] == $parent_id)
                {
                    $res .= '<li>';
                    $res .= '<div class="comments_item_bd_1" style="left:'. ($level-1)*40 .'px;">';
                    $res .= '<div class="comment-user-pic"><a href="'.Dynamic::goUrl($row->customer['customer_id'],'center').'"><img src="'.$row->customer['avator'].'" alt="'.$row->customer['nick_name'].'"></a></div>';
                    $res .= '<div class="comment-content-1">';
                    $res .= '<a href="'.Dynamic::goUrl($row->customer['customer_id'],'center').'" target="_blank" title="'.$row->customer['nick_name'].'">'.$row->customer['nick_name'].'</a> 回复 <a href="'.Dynamic::goUrl($customer_id,'center').'" target="_blank" title="'.$customer_name.'">'.$customer_name.'</a> : ';
                    $res .= $row['content'];
                    $res .= '<p class="raiders-detail-time">'.date('Y-m-d H:i:s', $row['created']).'</p></div><a href="javascript:void(0)" class="reply-comment reply-again" id="'.$row['delicacy_review_id'].'">回复</a>';
                    $res .= '</li>';
                    $reviews[] = $res;
                    unset($data[$key],$res);

                    $this->_findChildren($reviews, $data, $row['delicacy_review_id'], $row->customer['nick_name'], $row->customer['customer_id'], $level+1);
                }
            }
            else
            {
                if ($row['parent_id'] == $parent_id)
                {
                    $res .= '<li>';
                    $res .= '<div class="comment-user-pic"><a href="'.Dynamic::goUrl($row->customer['customer_id'],'center').'"><img src="'.$row->customer['avator'].'" alt="'.$row->customer['nick_name'].'"></a></div>';
                    $res .= '<div class="comment-content">';
                    $res .= '<a href="'.Dynamic::goUrl($row->customer['customer_id'],'center').'" target="_blank" title="'.$row->customer['nick_name'].'">'.$row->customer['nick_name'].'</a> : ';
                    $res .= $row['content'];
                    $res .= '<p class="raiders-detail-time">'.date('Y-m-d H:i:s', $row['created']).'</p></div><a href="javascript:void(0)" class="reply-comment" id="'.$row['delicacy_review_id'].'">回复</a>';
                    $res .= '</li>';
                    $reviews[] = $res;
                    unset($data[$key],$res);
                    $this->_findChildren($reviews, $data, $row['delicacy_review_id'], $row->customer['nick_name'], $row->customer['customer_id'], $level+1);
                }
            }
        }
    }

    /**
     *
     */
    public function getWholeAssess($assess)
    {
        $msg = ceil($assess/20);
        $img_arr = str_repeat('<img src="/images/icon/icon_star_1.gif" />', $msg);
        $img_arr .= str_repeat('<img src="/images/icon/icon_star_2.gif" />', 5-$msg);
        return $img_arr;
    }

    /**
     * @return CActiveDataProvider
     */
    public function getProvider($attributes=array(),$pageSize=10,$order='delicacy_id DESC')
    {
        $condition = '';
        if($attributes){
            $condition = '1=1';
            foreach($attributes as $key=>$value){
                $condition .= ' AND '.$key.' ="'.$value.'"';
            }
        }
    	$dataProvider=new CActiveDataProvider('delicacy', array(
    			'criteria'=>array('condition'=>$condition,'order'=>$order),
                'pagination'=>array('pageSize'=>$pageSize,'pageVar'=>'qpage'),
    	));
    	return $dataProvider;
    }

    public function afterFind()
    {
        $this->title = $this->addendum['title'];
        $this->content = $this->addendum['content'];
        $this->type = 'delicacy';
        $this->type_id = $this['delicacy_id'];
        $this->city_id = $this->food['city_id'];

    }

    public function afterSave()
    {
        $_POST['Delicacy']['content'] = str_replace('/js/ueditor/php/', '', $_POST['Delicacy']['content']);
        $_POST['Delicacy']['content'] = str_replace('../../..', '', $_POST['Delicacy']['content']);
        if ($this->addendum)
        {
            $this->addendum['attributes'] = $_POST['Delicacy'];
            $this->addendum->save();
        }
        elseif ($model = new DelicacyAddendum)
        {
            $model['attributes'] = array('delicacy_id' => $this['delicacy_id'], 'language' => Yii::app()->language);
            $model['attributes'] = $_POST['Delicacy'];
            $model->save();
        }
    }
}