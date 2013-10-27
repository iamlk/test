<?php

/**
 * This is the model class for table "dynamic".
 *
 * The followings are the available columns in table 'dynamic':
 * @property int(10) $dynamic_id
 * @property int(10) $interfix_id
 * @property tinyint(5) $interfix_type
 * @property int(10) $created
 * @property int(10) unsigned $customer_id
 *
 * The followings are the available model relations:
 * @property Customer $customer
 */
class Dynamic extends BaseActiveRecord
{
    //1=短期行程  2=住所  3=攻略  4=餐厅 5=相册 6=行程单 7=回复' 8=商品评价 9 餐厅 (旧)

    //product=短期行程 ProductReview=短期行程评论  Property=住所 PropertyReview=住所评论 Article=攻略 ArticleReview=攻略评论 Delicacy=美食 DelicacyReview=美食评论 Restaurant=餐厅 RestaurantReview=餐厅评论 Album=相册  AttractionReview=景点评论 (新)
    const PRODUCT = 'Product';
    const PRODUCTREVIEW = 'ProductReview';
    const PROPERTY = 'Property';
    const PROPERTYREVIEW = 'PropertyReview';
    const ARTICLE = 'Article';
    const ARTICLEREVIEW = 'ArticleReview';
    const DELICACY = 'Delicacy';
    const DELICACYREVIEW = 'DelicacyReview';
    const RESTAURANT = 'Restaurant';
    const RESTAURANTREVIEW = 'RestaurantReview';
    const ALBUM = 'Album';
    const ALBUMREVIEW = 'AlbumReview';
    const ALBUMIMAGE = 'AlbumImage';
    const ATTRACTION = 'Attraction';
    const ATTRACTIONREVIEW = 'AttractionReview';
    const TRAVEL = 'Travel';
    const FOOD = 'Food';
    const CITY = 'City';
    
    const IS_ACTIVE=0;//评论显示开关
    
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('interfix_id, interfix_type, created, customer_id', 'required'),
            array(
                'dynamic_id, interfix_id , created',
                'numerical',
                'integerOnly' => true),
            array(
                'customer_id',
                'length',
                'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'dynamic_id, interfix_id, interfix_type, created, customer_id',
                'safe',
                'on' => 'search'),
            );
    }

    /**
     * @return array the query criteria.
     * public function defaultScope()
     * {
     * return array('condition' => sprintf('%s.dynamic_id>10', $this->getTableAlias(true, false)));
     * }
     */

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array('customer' => array(
                self::BELONGS_TO,
                'Customer',
                'customer_id'), );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $t = array(
            'dynamic_id' => 'Dynamic ID',
            'interfix_id' => 'Interfix ID',
            'interfix_type' => 'Interfix Type',
            'created' => 'Created',
            'customer_id' => 'Customer ID',
            );
        foreach ($t as $k => $v)
            $t[$k] = Yii::t($this->tableName(), $v);
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

        $criteria = new CDbCriteria;

        $criteria->compare('dynamic_id', $this->dynamic_id);
        $criteria->compare('interfix_id', $this->interfix_id);
        $criteria->compare('interfix_type', $this->interfix_type);
        $criteria->compare('created', $this->created);
        $criteria->compare('customer_id', $this->customer_id, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }

    /**
     *  RICK ADD  2013-8-16  动态保存接口
     */
    public function saveDynamicApi($interfix_id, $interfix_type, $customer_id, $action)
    {

        if (empty($interfix_id) || preg_match("/[^\d]/", $interfix_id)) {

            return - 1;
            exit;
        }


        if (empty($customer_id) || preg_match("/[^\d]/", $customer_id)) {

            return - 3;
            exit;
        }
        //SLEEP(1);

        $dynamic = new Dynamic;

        $dynamic->interfix_id = $interfix_id;
        $dynamic->interfix_type = $interfix_type;
        $dynamic->created = time();
        $dynamic->action = $action;
        $dynamic->customer_id = $customer_id;
        $dynamic->is_active = 1;
        /*
        if ($action == 4 || $action == 5) {

            $dynamic->is_active = 0;

        } else {

            $dynamic->is_active = 1;
        }
      */
        return $dynamic->save(false);
    }
    /**
     *  RICK ADD  2013-8-16  根据条件获取动态列表
     */
    public function getDynamicList($uid = null)
    {

        if ($uid == null) {

            $data = Yii::app()->db->createCommand()->select('*')->from('dynamic')->where('is_active=:s',
                array(':s' => 1))->order('created desc')->queryAll();
        } else {

            $data = Yii::app()->db->createCommand()->select('*')->from('dynamic')->where('customer_id=:id and is_active=:s',
                array(':id' => $uid, ':s' => 1))->order('created desc')->queryAll();
        }

        $page = new CArrayDataProvider($data, array('pagination' => array('pageSize' =>
                    5), ));

        return $page;
    }

    /**
     *  RICK ADD  2013-8-19  动态时间处理
     */
    public function doDynamicTime($time)
    {

        $s = '秒钟';
        $m = '分钟';
        $h = '小时';
        $d = '天';
        $mon = '个月';
        $y = '年';


        $temptime = time() - $time;

        if ($temptime < 60) {

            return $temptime . $s;

        } else
            if ($temptime >= 60 && $temptime < 3600) {

                return intval($temptime / 60) . $m;

            } else
                if ($temptime >= 3600 && intval($temptime / 3600) < 24) {

                    return intval($temptime / 3600) . $h;

                } else
                    if (intval($temptime / 3600) >= 24 && intval($temptime / 3600 / 24) < 30) {

                        return intval($temptime / 3600 / 24) . $d;

                    } else
                        if (intval($temptime / 3600 / 24) >= 30 && intval($temptime / 3600 / 24 / 30) <
                            365) {

                            return intval($temptime / 3600 / 24 / 30) . $mon;
                        } else {

                            return intval($temptime / 3600 / 24 / 30 / 365) . $y;
                        }

    }

    /**
     *  RICK ADD  2013-8-19  获取动态的动作类型
     */
    public function getDynamicAction($action)
    {

        switch ($action) {

            case 1:
                return '发布';
                break;

            case 2:
                return '分享';
                break;

            case 3:
                return '收藏';
                break;

            case 4:
                return '评论';
                break;

            case 5:
                return '回复';
                break;

            case 6:
                return '上传';
                break;

            case 7:
                return '创建';
                break;

            default:
                return '';
                break;

        }

    }


    /**
     *  RICK ADD  2013-8-16  获取住所动态的显示内容  类型=1|2
     */
    public function getGoodsDynamicInfo($interfix_id, $interfix_type)
    {

        $criteria = new CDbCriteria;
        switch ($interfix_type) {
            case 'Product':
                $criteria->alias = 'product';
                $criteria->with = array('goods');
                $criteria->addCondition("goods.is_active = 1");
                $criteria->addCondition("product.product_id = " . $interfix_id);
                $data = Product::model()->findAll($criteria);
                return $data;
                break;

            case 'Property':
                $criteria->alias = 'property';
                $criteria->with = array('goods');
                $criteria->addCondition("goods.is_active = 1");
                $criteria->addCondition("property.property_id = " . $interfix_id);
                $data = Property::model()->findAll($criteria);
                return $data;
                break;

            default:
                break;

        }


    }

    /**
     *  RICK ADD  2013-8-16  获取攻略动态的显示内容
     */
    public function getArticleDynamicInfo($interfix_id)
    {

        $criteria = new CDbCriteria;
        $criteria->alias = 'article';
        $criteria->with = array('addendum');
        $criteria->addCondition("article.is_active = 1");
        $criteria->addCondition("article.article_id = " . $interfix_id);
        $data = Article::model()->findAll($criteria);
        return $data;
    }

    /**
     *  RICK ADD  2013-8-16  获取景点动态的显示内容
     */
    public function getAttractionDynamicInfo($interfix_id)
    {

        $criteria = new CDbCriteria;
        $criteria->alias = 'attraction';
        $criteria->with = array('addendum');
        $criteria->addCondition("attraction.is_active = 1");
        $criteria->addCondition("attraction.attraction_id = " . $interfix_id);
        $data = Attraction::model()->findAll($criteria);
        return $data;
    }

    /**
     *  RICK ADD  2013-8-16  获取美食动态的显示内容
     */
    public function getDelicacyDynamicInfo($interfix_id)
    {

        $criteria = new CDbCriteria;
        $criteria->alias = 'Delicacy';
        $criteria->with = array('addendum');
        $criteria->addCondition("Delicacy.is_active = 1");
        $criteria->addCondition("Delicacy.delicacy_id = " . $interfix_id);
        $data = Delicacy::model()->findAll($criteria);
        return $data;
    }

    /**
     *  RICK ADD  2013-8-16  获取相册图片动态的显示内容
     */
    public function getAlbumImageDynamicInfo($interfix_id)
    {

        $criteria = new CDbCriteria;
        $criteria->alias = 'Album';
        $criteria->with = array('albumImages');
        $criteria->addCondition("albumImages.staus = 0");
        $criteria->addCondition("albumImages.album_image_id = " . $interfix_id);
        $data = Album::model()->findAll($criteria);
        return $data;
    }

    /**
     *  RICK ADD  2013-8-16  获取相册动态的显示内容
     */
    public function getAlbumDynamicInfo($interfix_id, $type = null)
    {

        $criteria = new CDbCriteria;
        $criteria->alias = 'Album';
        $criteria->with = array('albumImages');
        //$criteria->addCondition("albumImages.staus = 0");
        if ($type == null || $type == 3) {

            $criteria->addCondition("Album.album_id = " . $interfix_id);

        } else {
            $criteria->addCondition("albumImages.staus = 0");
            $criteria->addCondition("albumImages.album_image_id = " . $interfix_id);
        }

        $data = Album::model()->findAll($criteria);
        return $data;
    }


    /**
     *  RICK ADD  2013-8-16  获取餐厅动态的显示内容
     */
    public function getRestaurantDynamicInfo($interfix_id)
    {

        $criteria = new CDbCriteria;
        $criteria->alias = 'Restaurant';
        $criteria->with = array('addendum');
        $criteria->addCondition("Restaurant.is_active = 1");
        $criteria->addCondition("Restaurant.restaurant_id = " . $interfix_id);
        $data = Restaurant::model()->findAll($criteria);
        return $data;
    }


    /**
     *  RICK ADD  2013-9-18  获取城市的分享显示内容
     */
    public function getCityDynamicInfo($interfix_id, $interfix_type)
    {
        $data = SiteShare::model()->findAllByAttributes(array('object_id' => $interfix_id,
                'object_type' => $interfix_type));
        // print_r($data);exit;
        return $data;
    }

    /**
     *  RICK ADD  2013-9-18  获取城市的分享显示内容
     */
    public function getFoodDynamicInfo($interfix_id, $interfix_type)
    {
        $data = SiteShare::model()->findAllByAttributes(array('object_id' => $interfix_id,
                'object_type' => $interfix_type));
        // print_r($data);exit;
        return $data;
    }


    /**
     *  RICK ADD  2013-8-16  获取短期行程评论
     */
    public function getProductReviewDynamicInfo($interfix_id)
    {

        $criteria = new CDbCriteria;
        $criteria->alias = 'product';
        $criteria->with = array('productReviewOne', 'addendumOne');
        $criteria->order = 'product_review_id desc';
       // $criteria->addCondition("productReviewOne.is_active = ".Dynamic::IS_ACTIVE);
        $criteria->addCondition("productReviewOne.product_id = " . $interfix_id);
        $data = Product::model()->findAll($criteria);
        return $data;
    }

    /**
     *  RICK ADD  2013-8-16  获取住所评论
     */
    public function getPropertyReviewDynamicInfo($interfix_id)
    {

        $criteria = new CDbCriteria;
        $criteria->alias = 'property';
        $criteria->with = array('propertyRevieOne', 'addendum');
        $criteria->order = 'property_review_id desc';
        $criteria->addCondition("propertyRevieOne.is_active = ".Dynamic::IS_ACTIVE);
        $criteria->addCondition("propertyRevieOne.property_id = " . $interfix_id);
        $data = Property::model()->findAll($criteria);
        return $data;
    }

    /**
     *  RICK ADD  2013-8-16  获取攻略评论
     */
    public function getArticleReviewDynamicInfo($interfix_id)
    {
        $criteria = new CDbCriteria;
        $criteria->alias = 'article';
        $criteria->with = array('reviewOne', 'addendum');
        $criteria->order = 'article_review_id desc';
       // $criteria->addCondition("reviewOne.is_active = ".Dynamic::IS_ACTIVE);
        $criteria->addCondition("reviewOne.article_id = " . $interfix_id);
        $data = Article::model()->findAll($criteria); 
        return $data;
    }

    /**
     *  RICK ADD  2013-8-16  获取美食评论
     */
    public function getDelicacyReviewDynamicInfo($interfix_id)
    {
        $criteria = new CDbCriteria;
        $criteria->alias = 'delicacy';
        $criteria->with = array('reviewOne', 'addendum');
        $criteria->order = 'delicacy_review_id desc';
       // $criteria->addCondition("reviewOne.is_active = ".Dynamic::IS_ACTIVE);
        $criteria->addCondition("reviewOne.delicacy_id = " . $interfix_id);
        $data = Delicacy::model()->findAll($criteria);
        return $data;
    }

    /**
     *  RICK ADD  2013-8-16  获取餐厅评论
     */
    public function getRestaurantReviewDynamicInfo($interfix_id)
    {

        $criteria = new CDbCriteria;
        $criteria->alias = 'restaurant';
        $criteria->with = array('reviewOne', 'addendum');
        $criteria->order = 'restaurant_review_id desc';
       // $criteria->addCondition("reviewOne.is_active = ".Dynamic::IS_ACTIVE);
        $criteria->addCondition("reviewOne.restaurant_id = " . $interfix_id);
        $data = Restaurant::model()->findAll($criteria);
        return $data;
    }

    /**
     *  RICK ADD  2013-8-16  获取景点评论
     */
    public function getAttractionReviewDynamicInfo($interfix_id)
    {

        $criteria = new CDbCriteria;
        $criteria->alias = 'attraction';
        $criteria->with = array('reviewOne', 'addendum');
        $criteria->order = 'attraction_review_id desc';
        //$criteria->addCondition("reviewOne.is_active = ".Dynamic::IS_ACTIVE);
        $criteria->addCondition("reviewOne.attraction_id = " . $interfix_id);
        $data = Attraction::model()->findAll($criteria);

        return $data;
    }

    /**
     *  RICK ADD  2013-8-16  获取相册照片的评论
     */
    public function getAlbumReviewDynamicInfo($interfix_id)
    {
  
        $data = Yii::app()->db->createCommand()->select('a.*,r.*')->from('album_image a')->
            join('album_review r', 'a.album_image_id=r.album_image_id')->where('a.album_image_id=:id',
            array(':id' => $interfix_id))->order('album_review_id desc')->
            limit(1)->queryAll();
        // print_r($data);exit;
        return $data;
    }

    /**
     *  RICK ADD  2013-8-16  获取事物的评论数
     */
    public function getCommentCounts($interfix_type, $interfix_id)
    {

        switch ($interfix_type) {

            case Dynamic::ARTICLE:
                $data = ArticleReview::model()->findAllByAttributes(array('article_id' => $interfix_id));
                return count($data);
                break;
            case Dynamic::ARTICLEREVIEW:
                $data = ArticleReview::model()->findAllByAttributes(array('article_id' => $interfix_id));
                return count($data);
                break;

            case Dynamic::ALBUMIMAGE:
                $data = AlbumReview::model()->findAllByAttributes(array('album_image_id' => $interfix_id));
                return count($data);
                break;
            case Dynamic::ALBUMREVIEW:
                $data = AlbumReview::model()->findAllByAttributes(array('album_image_id' => $interfix_id));
                return count($data);
                break;
            case Dynamic::ALBUM:
                $data = AlbumReview::model()->findAllByAttributes(array('album_image_id' => $interfix_id));
                return count($data);
                break;
            case Dynamic::DELICACY:
                $data = DelicacyReview::model()->findAllByAttributes(array('delicacy_id' => $interfix_id));
                return count($data);
                break;

            case Dynamic::RESTAURANT:
                $data = RestaurantReview::model()->findAllByAttributes(array('restaurant_id' =>
                        $interfix_id));
                return count($data);
                break;

            case Dynamic::ATTRACTION:
                $data = AttractionReview::model()->findAllByAttributes(array('attraction_id' =>
                        $interfix_id));
                return count($data);
                break;


        }


    }

    //区分用户跳转地址
    public static function goUrl($ref_id, $type, $objct_id = null)
    {
       
        if ($type == 'center') {

            if (Yii::app()->user->getCustomer_id() == $ref_id) {

                return Yii::app()->createUrl('center/index');

            } else {

                return Yii::app()->createUrl('people/index', array('u_id' => $ref_id));
            }

        }

        if ($type == Dynamic::ALBUM) {


            $data = Album::model()->findByPk($ref_id);

            if (U_ID == $data->attributes['customer_id']) {

                return Yii::app()->createUrl('album/index');

            } else {

                return Yii::app()->createUrl('peoplealbum/albumsub', array('u_id' => $data->attributes['customer_id'],'a_id'=>$ref_id));
            }

        }

        if ($type == Dynamic::ALBUMIMAGE) {

            $data = Yii::app()->db->createCommand()->select('a.customer_id as id')->from('album a')->
                join('album_image i', 'a.album_id=i.album_id')->where('album_image_id=:id', array(':id' => $ref_id))->
                queryRow();
       
            if (U_ID == $data['id']) {

                return Yii::app()->createUrl('album/index');

            } else {

                return Yii::app()->createUrl('peoplealbum/seepic', array('u_id' => $data['id'],'a_img_id'=>$ref_id));
            }

        }


        if ($type == 'article') {

            if (Yii::app()->user->getCustomer_id() == $ref_id) {

                return Yii::app()->createUrl('myarticle/index');

            } else {

                return Yii::app()->createUrl('people/article', array('u_id' => $objct_id));
            }

        }


    }

}
