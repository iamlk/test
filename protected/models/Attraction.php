<?php
/**
 * This is the model class for table "attraction".
 *
 * The followings are the available columns in table 'attraction':
 * @property string $attraction_id
 * @property integer $parent_type
 * @property integer $parent_id
 * @property string $longitude
 * @property string $latitude
 * @property string $image
 */
class Attraction extends CActiveRecord
{
    public $name;
    public $description;
    public $content;
    public $city_id = 0;
    public $state_id = 0;
    public $country_id = 0;
    public $continent_id = 0;
    public $product_id;
    public $product_price;
    public $product_name;
    public $product_image;
    public $_flatTree;
    public $_pages;
    public $shareCount;


    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Attraction the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'attraction';
    }

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.attraction_id>10', $this->getTableAlias(true, false)));
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('parent_type, parent_id, longitude, latitude, image, order, visitors, is_active', 'required'),
            array(
                'parent_type, parent_id, order, is_active',
                'numerical',
                'integerOnly' => true),
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
            array(
                'image',
                'length',
                'max' => 250),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'attraction_id, parent_type, parent_id, longitude, latitude, image, order, visitors, is_active',
                'safe',
                'on' => 'search'),
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
            'attractionAddendums' => array(
                self::HAS_MANY,
                'AttractionAddendum',
                'attraction_id'), // by zyme
            'addendum' => array(
                self::HAS_ONE,
                'AttractionAddendum',
                'attraction_id',
                'condition' => 'addendum.language='.'"'.Yii::app()->language.'"'),
            'customer' => array(
                self::BELONGS_TO,
                'Customer',
                'customer_id'),
            'visitorCount' => array(
                self::STAT,
                'AttractionVisitor',
                'attraction_id'),
            'article' => array(
                self::HAS_MANY,
                'Article',
                'attraction_id'),
            'review' => array(
                self::HAS_MANY,
                'AttractionReview',
                'attraction_id'),
             'reviewOne' => array( //rick add
                self::HAS_ONE,
                'AttractionReview',
                'attraction_id'),

            'visitor' => array(
                self::HAS_ONE,
                'AttractionVisitor',
                'attraction_id',
                'condition' => 'visitor.customer_id='.'"'.U_ID.'"'),
            'products' => array(
                self::HAS_MANY,
                'ProductAttraction',
                'attraction_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'attraction_id' => 'Attraction',
            'parent_type' => 'Parent Type',
            'parent_id' => 'Parent',
            'longitude' => 'Longitude',
            'latitude' => 'Latitude',
            'order' => 'Order',
            'image' => 'Image',
            'visitors' => 'Visitors',
            'is_active' => 'Is Active',
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

        $criteria = new CDbCriteria;

        $criteria->compare('attraction_id', $this->attraction_id, true);
        $criteria->compare('parent_type', $this->parent_type);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('longitude', $this->longitude, true);
        $criteria->compare('latitude', $this->latitude, true);
        $criteria->compare('order', $this->order, true);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('visitors', $this->visitors, true);
        $criteria->compare('is_active', $this->is_active, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }

    /**
     * @author darren
     * @return get sum of all review
     */
    public function getReviewCount()
    {
        $dataProvider = $this->getReviewsProvider();
        return count($dataProvider->getData());
    }

    /**
     * @author darren
     * @return return all review
     */
    public function getReviewsProvider()
    {
        $attraction_id = $this->attraction_id;
        // c
        $criteria = new CDbCriteria();
        $criteria->order = 'attraction_review_id DESC ';
        $criteria->addCondition('parent_review_id=0');
        $criteria->addCondition('is_active=1');
        $criteria->addCondition('attraction_id=:attraction_id');
        $criteria->params = array(':attraction_id' => $attraction_id);
        // d
        $dataProvider = new CActiveDataProvider('AttractionReview', array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 2, 'pageVar' => 'npage'),
            ));
        return $dataProvider;
    }

    public function getAllReview()
    {
        if ($this->_flatTree == null)
        {
            $criteria = new CDbCriteria();
            $criteria->addCondition('attraction_id=:attractionId');
            $criteria->addCondition('is_active=1');
            $criteria->params = array(':attractionId' => $this['attraction_id']);
            $dataProvider = new CActiveDataProvider('AttractionReview', array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 20, 'pageVar' => 'npage'),
            ));
            $this->_pages = $dataProvider->pagination;
            $this->_findChildren($flatTree, $dataProvider->getData(), 0, false, 0);
            $this->_flatTree = $flatTree;
        }

        return array('reviews'=>$this->_flatTree,'pages'=>$this->_pages);
    }

    private function _findChildren(&$reviews, $data, $parent_id, $customer_name, $level=0)
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
                    $res .= '<div class="comment-user-pic"><a href="#"><img src="'.$row->customer['avator'].'" alt="'.$row->customer['nick_name'].'"></a></div>';
                    $res .= '<div class="comment-content-1">';
                    $res .= '<a href="" target="_blank" title="'.$row->customer['nick_name'].'">'.$row->customer['nick_name'].'</a> 回复 <a href="" target="_blank" title="'.$customer_name.'">'.$customer_name.'</a> : ';
                    $res .= $row['content'];
                    $res .= '<p class="raiders-detail-time">'.date('Y-m-d H:i:s', $row['created']).'</p></div><a href="javascript:void(0)" class="reply-comment reply-again" id="'.$row['attraction_review_id'].'">回复</a>';
                    $res .= '</li>';
                    $reviews[] = $res;
                    unset($data[$key],$res);

                    $this->_findChildren($reviews, $data, $row['attraction_review_id'], $row->customer['nick_name'], $level+1);
                }
            }
            else
            {
                if ($row['parent_id'] == $parent_id)
                {
                    $res .= '<li>';
                    $res .= '<div class="comment-user-pic"><a href="#"><img src="'.$row->customer['avator'].'" alt="'.$row->customer['nick_name'].'"></a></div>';
                    $res .= '<div class="comment-content">';
                    $res .= '<a href="" target="_blank" title="'.$row->customer['nick_name'].'">'.$row->customer['nick_name'].'</a> : ';
                    $res .= $row['content'];
                    $res .= '<p class="raiders-detail-time">'.date('Y-m-d H:i:s', $row['created']).'</p></div><a href="javascript:void(0)" class="reply-comment" id="'.$row['attraction_review_id'].'">回复</a>';
                    $res .= '</li>';
                    $reviews[] = $res;
                    unset($data[$key],$res);
                    $this->_findChildren($reviews, $data, $row['attraction_review_id'], $row->customer['nick_name'], $level+1);
                }
            }
        }
    }

    /**
     *
     *
     */
    public function getWholeAssess($assess)
    {
        $msg = ceil($assess / 20);
        $img_arr = str_repeat('<img src="/images/icon/icon_star_1.gif" />', $msg);
        $img_arr .= str_repeat('<img src="/images/icon/icon_star_2.gif" />', 5 - $msg);
        return $img_arr;
    }

    /**
     *
     */
    public function afterFind()
    {
        $this->name = $this->addendum['name'];
        $this->description = $this->addendum['description'];
        $this->content = $this->addendum['content'];
    }

    /**
     *
     */
    public function afterSave()
    {
        $_POST['Attraction']['content'] = str_replace('/js/ueditor/php/', '', $_POST['Attraction']['content']);
        $_POST['Attraction']['content'] = str_replace('../../..', '', $_POST['Attraction']['content']);
        if ($this->addendum)
        {
            $this->addendum['attributes'] = array('attraction_id' => $this['attraction_id'], 'language' => Yii::app()->language);
            $this->addendum['attributes'] = $_POST['Attraction'];
            $this->addendum->save();
        }
        elseif ($model = new AttractionAddendum)
        {
            $model['attributes'] = array('attraction_id' => $this['attraction_id'], 'language' => Yii::app()->language);
            $model['attributes'] = $_POST['Attraction'];
            $model->save();
        }
    }

    /**
     *
     */
    public function getDropdownList($obj, &$_a = array('|-TOP'), &$level = 1)
    {
        $type = array(
            '1' => 'continent',
            '2' => 'country',
            '3' => 'state',
            '4' => 'city',
            '5' => 'attraction');

        $index = $type[$level].'_id';
        $num = $type[$level + 1];

        foreach ($obj as $item)
        {
            $_a[strval($level.'-'.$item[$index])] = str_repeat('&nbsp;&nbsp;', $level).'|-'.$item['name'];

            if (in_array($level, array(2, 3)) && $item->attraction)
            {
                foreach ($item->attraction as $review)
                {
                    $_a['5-'.$review['attraction_id']] = str_repeat('&nbsp;&nbsp;', 5).'|-'.$review['name'];
                }
            }

            if ($num != NULL && $item->$num)
            {
                $this->getDropdownList($item->$type[++$level], $_a, $level);
            }
        }

        --$level;
        return $_a;
    }
    /**
     * 返回景点信息
     */
    public function searchAttraction($params = array('local' => true))
    {
        // f
        $criteria = new CDbCriteria;
        $criteria->alias = 'attraction';
        $criteria->with = array('attractionAddendums' => ((isset($params['local']) and !$params['local'])?array():array('scopes' => 'local')));

        if ($params['name']) $criteria->addSearchCondition('`attractionAddendums`.name', $params['name']);
        $model = Attraction::model()->findAll($criteria);
        // r
        $arr = array();
        foreach ($model as $attraction)
        {
            foreach ($attraction->attractionAddendums as $attractionAddendum)
            {
                $arr[] = array_merge($attraction->getAttributes(array(
                    'attraction_id',
                    'parent_type',
                    'parent_id')), $attractionAddendum->getAttributes(array('name')));
            }
        }
        return $arr;
    }

    /**
     * @return CActiveDataProvider
     */
    public function getProvider($attributes=array(),$pageSize=10,$order='attraction_id DESC')
    {
        $condition = '';
        if($attributes){
            $condition = '1=1';
            foreach($attributes as $key=>$value){
                $condition .= ' AND '.$key.' ="'.$value.'"';
            }
        }
    	$dataProvider=new CActiveDataProvider('Attraction', array(
    			'criteria'=>array('condition'=>$condition,'order'=>$order),
                'pagination'=>array('pageSize'=>$pageSize,'pageVar'=>'qpage'),
    	));
    	return $dataProvider;
    }

    /**
     * leo   指南景点
     */
    public static function getItemList($city_id = 0,$limit = 4)
    {
        $data = array();

        if(empty($city_id))return $data;

        $criteria           = new CDbCriteria;
        $criteria->alias    = 'attraction';
        $criteria->select   = 'attraction_id,parent_id,image';
        $criteria->order    = 'attraction_id desc';
        $criteria->limit    = $limit;
        $criteria->distinct = true;
        $criteria->addCondition('is_active = 1');
        $criteria->addCondition('parent_type = 3');
        $criteria->addCondition('parent_id ='.$city_id);


        $models = Attraction::model()->findAll($criteria);

        foreach($models as $attraction)
        {
            $_tmep                      = array();

            $_tmep['attraction_id']     = $attraction->attraction_id;
            $_tmep['attraction_name']   = $attraction->addendum->name;
            $_tmep['city_id']           = $attraction->parent_id;
            $_tmep['image']             = $attraction->image;

            $data[]                     = $_tmep;
        }
        return $data;

    }
     /**
       *  leo add 09/04
       *  景点更多列表详情
       */
    public static function getItemListDetail($city_id = 0,$limit = 2000,$page_size = 20)
    {
        $data = null;
        if(empty($city_id))return $data;

        $criteria           = new CDbCriteria;
        $criteria->alias    = 'attraction';
        $criteria->select   = 'attraction_id,parent_id,image';
        $criteria->order    = 'attraction_id desc';
        $criteria->limit    = $limit;

        $criteria->addCondition('is_active = 1');
        $criteria->addCondition('parent_type = 3');
        $criteria->addCondition('parent_id ='.$city_id);

        $dataProvider = new CActiveDataProvider('attraction', array('criteria' => $criteria));
        $dataProvider->pagination->pageSize = $page_size;

        $data =  $dataProvider;
        return $data;

    }

}
