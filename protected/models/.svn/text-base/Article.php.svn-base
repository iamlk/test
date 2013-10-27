<?php

/**
 * This is the model class for table "article".
 *
 * The followings are the available columns in table 'article':
 * @property integer $article_id
 * @property integer $customer_id
 * @property integer $city_id
 * @property integer $article_category_id
 * @property integer $created
 * @property integer $updated
 * @property integer $is_active
 */
class Article extends CActiveRecord
{
    public $title;
    public $content;
    public $_flatTree;
    public $_pages;
//    public $productCount;
//    public $propertyCount;
//    public $articleCount;


	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Article the static model class
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
		return 'article';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_id, created, updated, is_active, order, draft', 'required'),
			array('customer_id, created, updated, is_active, visit, order, draft', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('article_id, customer_id, created, updated, is_active, visit, order, draft', 'safe', 'on'=>'search'),
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
        'addendum' => array(self::HAS_ONE, 'ArticleAddendum', 'article_id'),
        'customer'=> array(self::BELONGS_TO, 'Customer', 'customer_id'),
        'review'=>array(self::HAS_MANY, 'ArticleReview', 'article_id'),
        'reviewOne'=>array(self::HAS_ONE, 'ArticleReview', 'article_id'), //rick add
//        'city'=>array(self::BELONGS_TO, 'City', 'city_id'),
//        'products'=>array(self::HAS_MANY, 'Goods', '', 'on'=>'products.entity_type=1 AND customer_id=products.customer_id AND products.is_active=1'),
//        'propertys'=>array(self::HAS_MANY, 'Goods', '', 'on'=>'propertys.entity_type=2 AND customer_id=propertys.customer_id AND products.is_active=1'),
        'articleCity'=>array(self::HAS_MANY, 'ArticleCity', 'article_id'),
        'shareCount'=>array(self::STAT, 'SiteShare', 'object_id', 'condition'=>'object_type="Article"'),
        'favoriteCount'=>array(self::STAT, 'SiteFavorite', 'object_id', 'condition'=>'object_type="Article"'),
        'reviewCount'=>array(self::STAT, 'ArticleReview', 'article_id', 'condition'=>'parent_id=0 AND is_active=1'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'article_id' => 'Article',
			'customer_id' => 'Customer',
			'created' => 'Created',
			'updated' => 'Updated',
			'is_active' => 'Is Active',
            'visit' => 'Visit',
            'order' => 'Order',
            'draft' => 'Draft',
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

		$criteria->compare('article_id',$this->article_id);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);
		$criteria->compare('is_active',$this->is_active);
        $criteria->compare('visit',$this->visit);
        $criteria->compare('order',$this->order);
        $criteria->compare('draft',$this->draft);



		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /**
     * @return CActiveDataProvider
     */
    public function getProvider($attributes=array(),$pageSize=10,$order='article_id DESC'){
        $condition = '';
        if($attributes){
            $condition = '1=1';
            foreach($attributes as $key=>$value){
                $condition .= ' AND '.$key.' ="'.$value.'"';
            }
        }
    	$dataProvider=new CActiveDataProvider('Article', array(
    			'criteria'=>array('condition'=>$condition,'order'=>$order),
                'pagination'=>array('pageSize'=>$pageSize,'pageVar'=>'qpage'),
    	));
    	return $dataProvider;
    }

    public function afterFind()
    {
        $this->title = $this->addendum['title'];
        $this->content = $this->addendum['content'];
//        $this->productCount = count($this->products);
//        $this->propertyCount = count($this->propertys);
//        $this->articleCount = $this->countByAttributes(array('customer_id'=>$this['customer_id']));
    }

    public function afterDelete()
    {
        if($this->addendum)$this->addendum->delete();
        if($this->review)
        {
            foreach($this->review as $del)
            {
                $del->delete();
            }
        }
        if($this->articleCity)
        {
            foreach($this->articleCity as $del)
            {
                $del->delete();
            }
        }
    }

    public function afterSave()
    {
      if($_POST['cid']){
        $_POST['content'] = str_replace('/js/ueditor/php/', '', $_POST['content']);
        $_POST['content'] = str_replace('../../..', '', $_POST['content']);
        if ($this->addendum)
        {
            $this->addendum['attributes'] = array('title'=>$_POST['title'],'content'=>$_POST['content']);
            $this->addendum->save();

            ArticleCity::model()->deleteAllByAttributes(array('article_id'=>$this['article_id']));
            $sql = 'INSERT INTO '.ArticleCity::model()->tableName().'(city_id,article_id) VALUES';
            if(is_array($_POST['cid']))
            {
                foreach($_POST['cid'] as $cid)
                {
                    $sql .= '('.$cid.','.$this['article_id'].'),';
                }
                $sql = rtrim($sql,',');
            }else{
                $sql .= '('.$_POST['cid'].','.$this['article_id'].')';
            }

            Yii::app()->db->createCommand($sql)->query();
        }
        elseif ($articleAddendum = new ArticleAddendum)
        {
            $articleAddendum['attributes'] = array('article_id' => $this['article_id'], 'language' => Yii::app()->language,'title'=>$_POST['title'],'content'=>$_POST['content']);
            $articleAddendum->save();

            $sql = 'INSERT INTO '.ArticleCity::model()->tableName().'(city_id,article_id) VALUES';
            if(is_array($_POST['cid']))
            {
                foreach($_POST['cid'] as $cid)
                {
                    $sql .= '('.$cid.','.$this['article_id'].'),';
                }
                $sql = rtrim($sql,',');
            }else{
                $sql .= '('.$_POST['cid'].','.$this['article_id'].')';
            }

            Yii::app()->db->createCommand($sql)->query();
        }
      }
    }

    /**
     * 获取指定攻略的回复条数
     */
     public function getArticlenums($article_review_id){

        $arr = Yii::app()->db->createCommand()->select('*')->from('article_review')->
                where('article_id = :id', array(':id' =>
                    $article_review_id))->queryAll();

                    return count($arr);

     }

    public function getAllReview()
    {
        if ($this->_flatTree == null)
        {
            $criteria = new CDbCriteria();
            $criteria->addCondition('article_id=:articleId');
            $criteria->addCondition('is_active=1');
            $criteria->params = array(':articleId' => $this['article_id']);
            $dataProvider = new CActiveDataProvider('ArticleReview', array(
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
                    $res .= '<div class="comments_item_bd" style="left:'. ($level-1)*40 .'px;">';
                    $res .= '<div class="comment-user-pic"><a href="'.Dynamic::goUrl($row->customer['customer_id'],'center').'"><img src="/thumb/48_48/'.Customer::model()->getUserHeaderImage($row->customer['customer_id']).'" alt="'.$row->customer['nick_name'].'"></a></div>';
                    $res .= '<div class="comment-content">';
                    $res .= '<a href="'.Dynamic::goUrl($row->customer['customer_id'],'center').'" target="_blank" title="'.$row->customer['nick_name'].'">'.$row->customer['nick_name'].'</a> 回复 <a href="'.Dynamic::goUrl($customer_id,'center').'" target="_blank" title="'.$customer_name.'">'.$customer_name.'</a> : ';
                    $res .= $row['content'];
                    $res .= '<p class="raiders-detail-time">'.date('Y-m-d H:i:s', $row['created']).'</p></div><a href="javascript:void(0)" class="reply-comment" id="'.$row['article_review_id'].'">回复</a>';
                    $res .= '</li>';
                    $reviews[] = $res;
                    unset($data[$key],$res);

                    $this->_findChildren($reviews, $data, $row['article_review_id'], $row->customer['nick_name'], $row->customer['customer_id'], $level+1);
                }
            }
            else
            {
                if ($row['parent_id'] == $parent_id)
                {
                    $res .= '<li>';
                    $res .= '<div class="comment-user-pic"><a href="'.Dynamic::goUrl($row->customer['customer_id'],'center').'"><img src="/thumb/48_48/'.Customer::model()->getUserHeaderImage($row->customer['customer_id']).'"></a></div>';
                    $res .= '<div class="comment-content">';
                    $res .= '<a href="'.Dynamic::goUrl($row->customer['customer_id'],'center').'" target="_blank" title="'.$row->customer['nick_name'].'">'.$row->customer['nick_name'].'</a> : ';
                    $res .= $row['content'];
                    $res .= '<p class="raiders-detail-time">'.date('Y-m-d H:i:s', $row['created']).'</p></div><a href="javascript:void(0)" class="reply-comment" id="'.$row['article_review_id'].'">回复</a>';
                    $res .= '</li>';
                    $reviews[] = $res;
                    unset($data[$key],$res);
                    $this->_findChildren($reviews, $data, $row['article_review_id'], $row->customer['nick_name'], $row->customer['customer_id'], $level+1);
                }
            }
        }
    }
}