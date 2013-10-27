<?php

/**
 * This is the model class for table "customer".
 *
 * The followings are the available columns in table 'customer':
 * @property int(10) unsigned $customer_id
 * @property varchar(60) $first_name
 * @property varchar(60) $last_name
 * @property varchar(200) $full_name
 * @property varchar(80) $real_name
 * @property varchar(100) $nick_name
 * @property varchar(10) $sex
 * @property int(10) $country
 * @property int(10) $province
 * @property int(10) $city
 * @property varchar(70) $address
 * @property varchar(20) $born
 * @property tinyint(2) $disply_born
 * @property varchar(20) $document_num
 * @property varchar(50) $document_type
 * @property varchar(60) $bind_email
 * @property tinyint(1) $display_bind_email
 * @property int(11) $emailyzm
 * @property varchar(120) $email
 * @property varchar(30) $weblogin_pwd
 * @property varchar(120) $domain
 * @property varchar(11) $bind_phone
 * @property tinyint(1) $display_bind_phone
 * @property varchar(120) $avator
 * @property varchar(200) $introduction
 * @property tinyint(3) $gender
 * @property int(3) $passwordpower
 * @property varchar(32) $password
 * @property timestamp $created
 * @property timestamp $updated
 * @property int(11) $tempyzmtime
 * @property int(11) $tempyzm
 * @property timestamp $last_login
 * @property varchar(10) $default_language
 * @property tinyint(3) unsigned $is_certified
 * @property tinyint(3) unsigned $is_active
 * @property varchar(70) $open_id
 * @property varchar(100) $token
 * @property int(10) $expire
 * @property varchar(30) $realpassword
 *
 * The followings are the available model relations:
 * @property Album[] $albums
 * @property mixed $albumCount
 * @property AlbumReview[] $albumReviews
 * @property mixed $albumReviewCount
 * @property Article[] $articles
 * @property mixed $articleCount
 * @property ArticleReview[] $articleReviews
 * @property mixed $articleReviewCount
 * @property AttractionVisitor[] $attractionVisitors
 * @property mixed $attractionVisitorCount
 * @property Authidentity[] $authidentities
 * @property mixed $authidentityCount
 * @property Business[] $businesses
 * @property mixed $businessCount
 * @property CustomerAddressBook[] $customerAddressBooks
 * @property mixed $customerAddressBookCount
 * @property CustomerBasket[] $customerBaskets
 * @property mixed $customerBasketCount
 * @property CustomerBasketDetail[] $customerBasketDetails
 * @property mixed $customerBasketDetailCount
 * @property Dynamic[] $dynamics
 * @property mixed $dynamicCount
 * @property Goods[] $goods
 * @property mixed $goodsCount
 * @property Itinerary[] $itineraries
 * @property mixed $itineraryCount
 * @property ItineraryDetail[] $itineraryDetails
 * @property mixed $itineraryDetailCount
 * @property ItineraryReview[] $itineraryReviews
 * @property mixed $itineraryReviewCount
 * @property Landlord[] $landlords
 * @property mixed $landlordCount
 * @property Order[] $orders
 * @property mixed $orderCount
 * @property OrderDetail[] $orderDetails
 * @property mixed $orderDetailCount
 * @property Restaurant[] $restaurants
 * @property mixed $restaurantCount
 * @property SiteFavorite[] $siteFavorites
 * @property mixed $siteFavoriteCount
 * @property SiteInnerSms[] $siteInnerSms
 * @property mixed $siteInnerSmsCount
 * @property SiteInnerSms[] $siteInnerSms1
 * @property SiteInnerSmsUser[] $siteInnerSmsUsers
 * @property mixed $siteInnerSmsUserCount
 * @property SiteShare[] $siteShares
 * @property mixed $siteShareCount
 * @property Tourguide[] $tourguides
 * @property mixed $tourguideCount
 * @property TravelCompanion[] $travelCompanions
 * @property mixed $travelCompanionCount
 * @property TravelCompanionApplication[] $travelCompanionApplications
 * @property mixed $travelCompanionApplicationCount
 * @property TravelCompanionBlog[] $travelCompanionBlogs
 * @property mixed $travelCompanionBlogCount
 * @property TravelCompanionBlogComment[] $travelCompanionBlogComments
 * @property mixed $travelCompanionBlogCommentCount
 * @property TravelCompanionBuddy[] $travelCompanionBuddies
 * @property mixed $travelCompanionBuddyCount
 * @property TravelCompanionBuddy[] $travelCompanionBuddies1
 * @property TravelCompanionGuestHistory[] $travelCompanionGuestHistories
 * @property mixed $travelCompanionGuestHistoryCount
 * @property TravelCompanionGuestHistory[] $travelCompanionGuestHistories1
 * @property TravelCompanionMessage[] $travelCompanionMessages
 * @property mixed $travelCompanionMessageCount
 * @property TravelCompanionMessage[] $travelCompanionMessages1
 * @property TravelCompanionPrivateMessage[] $travelCompanionPrivateMessages
 * @property mixed $travelCompanionPrivateMessageCount
 * @property TravelCompanionPrivateMessage[] $travelCompanionPrivateMessages1
 * @property TravelCompanionProfile[] $travelCompanionProfiles
 * @property mixed $travelCompanionProfileCount
 * @property TravelCompanionProfileVideo[] $travelCompanionProfileVideos
 * @property mixed $travelCompanionProfileVideoCount
 * @property TravelCompanionProfileWallPost[] $travelCompanionProfileWallPosts
 * @property mixed $travelCompanionProfileWallPostCount
 * @property TravelCompanionProfileWallPost[] $travelCompanionProfileWallPosts1
 * @property TravelCompanionReply[] $travelCompanionReplies
 * @property mixed $travelCompanionReplyCount
 */
class Customer extends BaseActiveRecord
{
    const GENDER_FEMALE = 0;
    const GENDER_MALE   = 1;
    const GENDER_UNKNOW = 2;
    public static $genderStr = array('女','男','保密');
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nick_name, display_bind_email, email, display_bind_phone, avator, password, updated, default_language, open_id, token, expire',
                    'required'),
            array(
                'country, province, city, disply_born, display_bind_email, emailyzm, display_bind_phone, gender, passwordpower, tempyzmtime, tempyzm, is_certified, is_active, expire',
                'numerical',
                'integerOnly' => true),
            array(
                'first_name, last_name, bind_email',
                'length',
                'max' => 60),
            array(
                'full_name, introduction',
                'length',
                'max' => 200),
            array(
                'real_name',
                'length',
                'max' => 80),
            array(
                'nick_name, token',
                'length',
                'max' => 100),
            array(
                'sex, default_language',
                'length',
                'max' => 10),
            array(
                'address, open_id',
                'length',
                'max' => 70),
            array(
                'born, document_num',
                'length',
                'max' => 20),
            array(
                'document_type',
                'length',
                'max' => 50),
            array(
                'email, domain, avator',
                'length',
                'max' => 120),
            array(
                'weblogin_pwd, realpassword',
                'length',
                'max' => 30),
            array(
                'bind_phone',
                'length',
                'max' => 11),
            array(
                'password',
                'length',
                'max' => 32),
            array('created, last_login', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'customer_id, first_name, last_name, full_name, real_name, nick_name, sex, country, province, city, address, born, disply_born, document_num, document_type, bind_email, display_bind_email, emailyzm, email, weblogin_pwd, domain, bind_phone, display_bind_phone, avator, introduction, gender, passwordpower, password, created, updated, tempyzmtime, tempyzm, last_login, default_language, is_certified, is_active, open_id, token, expire, realpassword',
                'safe',
                'on' => 'search'),
            );
    }

    /**
     * @return array the query criteria.
     * public function defaultScope()
     * {
     * return array('condition' => sprintf('%s.customer_id>10', $this->getTableAlias(true, false)));
     * }
     */

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'albums' => array(
                self::HAS_MANY,
                'Album',
                'customer_id'),
            'albumCount' => array(
                self::STAT,
                'Album',
                'customer_id'),
            'albumReviews' => array(
                self::HAS_MANY,
                'AlbumReview',
                'customer_id'),
            'albumReviewCount' => array(
                self::STAT,
                'AlbumReview',
                'customer_id'),
            'articles' => array(
                self::HAS_MANY,
                'Article',
                'customer_id'),
            'articleCount' => array(
                self::STAT,
                'Article',
                'customer_id'),
            'articleReviews' => array(
                self::HAS_MANY,
                'ArticleReview',
                'customer_id'),
            'articleReviewCount' => array(
                self::STAT,
                'ArticleReview',
                'customer_id'),
            'attractionVisitors' => array(
                self::HAS_MANY,
                'AttractionVisitor',
                'customer_id'),
            'attractionVisitorCount' => array(
                self::STAT,
                'AttractionVisitor',
                'customer_id'),
            'authidentities' => array(
                self::HAS_MANY,
                'Authidentity',
                'customer_id'),
            'authidentityCount' => array(
                self::STAT,
                'Authidentity',
                'customer_id'),
            'business' => array(
                self::HAS_ONE,
                'Business',
                'business_id'),
            'customerAddressBooks' => array(
                self::HAS_MANY,
                'CustomerAddressBook',
                'customer_id'),
            'customerAddressBookCount' => array(
                self::STAT,
                'CustomerAddressBook',
                'customer_id'),
            'customerBaskets' => array(
                self::HAS_MANY,
                'CustomerBasket',
                'customer_id'),
            'customerBasketCount' => array(
                self::STAT,
                'CustomerBasket',
                'customer_id'),
            'customerBasketDetails' => array(
                self::HAS_MANY,
                'CustomerBasketDetail',
                'provider_id'),
            'customerBasketDetailCount' => array(
                self::STAT,
                'CustomerBasketDetail',
                'provider_id'),
            'dynamics' => array(
                self::HAS_MANY,
                'Dynamic',
                'customer_id'),
            'dynamicCount' => array(
                self::STAT,
                'Dynamic',
                'customer_id'),
            'goods' => array(
                self::HAS_MANY,
                'Goods',
                'customer_id'),
            'goodsCount' => array(
                self::STAT,
                'Goods',
                'customer_id'),
            'itineraries' => array(
                self::HAS_MANY,
                'Itinerary',
                'customer_id'),
            'itineraryCount' => array(
                self::STAT,
                'Itinerary',
                'customer_id'),
            'itineraryDetails' => array(
                self::HAS_MANY,
                'ItineraryDetail',
                'provider_id'),
            'itineraryDetailCount' => array(
                self::STAT,
                'ItineraryDetail',
                'provider_id'),
            'itineraryReviews' => array(
                self::HAS_MANY,
                'ItineraryReview',
                'customer_id'),
            'itineraryReviewCount' => array(
                self::STAT,
                'ItineraryReview',
                'customer_id'),
            'landlord' => array(
                self::HAS_ONE,
                'Landlord',
                'landlord_id'),
            'orders' => array(
                self::HAS_MANY,
                'Order',
                'customer_id'),
            'orderCount' => array(
                self::STAT,
                'Order',
                'customer_id'),
            'orderDetails' => array(
                self::HAS_MANY,
                'OrderDetail',
                'provider_id'),
            'orderDetailCount' => array(
                self::STAT,
                'OrderDetail',
                'provider_id'),
            'restaurants' => array(
                self::HAS_MANY,
                'Restaurant',
                'customer_id'),
            'restaurantCount' => array(
                self::STAT,
                'Restaurant',
                'customer_id'),
            'siteFavorites' => array(
                self::HAS_MANY,
                'SiteFavorite',
                'customer_id'),
            'siteFavoriteCount' => array(
                self::STAT,
                'SiteFavorite',
                'customer_id'),
            'siteInnerSms' => array(
                self::HAS_MANY,
                'SiteInnerSms',
                'customer_id'),
            'siteInnerSmsCount' => array(
                self::STAT,
                'SiteInnerSms',
                'to_customer_id'),
            'siteInnerSmsUser' => array(
                self::HAS_ONE,
                'SiteInnerSmsUser',
                'customer_id'),
            'siteShares' => array(
                self::HAS_MANY,
                'SiteShare',
                'customer_id'),
            'siteShareCount' => array(
                self::STAT,
                'SiteShare',
                'customer_id'),
            'tourguide' => array(
                self::HAS_ONE,
                'Tourguide',
                'tourguide_id'),
            'productreviews' => array( //rick  add(短期行程评论) 2013/8/8
                self::HAS_MANY,
                'ProductReview',
                'customer_id'),
            'propertyreviews' => array( //rick  add(住所评论) 2013/8/8
                self::HAS_MANY,
                'propertyReview',
                'customer_id'),
            'authidentity' => array( //rick  add(身份认证) 2013/8/13
                self::HAS_ONE,
                'Authidentity',
                'customer_id'),
            'authidentities' => array( //rick  add(身份认证) 2013/8/13
                self::HAS_MANY,
                'Authidentity',
                'customer_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $t = array(
            'customer_id' => 'Customer ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'full_name' => 'Full Name',
            'real_name' => 'Real Name',
            'nick_name' => 'Nick Name',
            'sex' => 'Sex',
            'country' => 'Country',
            'province' => 'Province',
            'city' => 'City',
            'address' => 'Address',
            'born' => 'Born',
            'disply_born' => 'Disply Born',
            'document_num' => 'Document Num',
            'document_type' => 'Document Type',
            'bind_email' => 'Bind Email',
            'display_bind_email' => 'Display Bind Email',
            'emailyzm' => 'Emailyzm',
            'email' => 'Email',
            'weblogin_pwd' => 'Weblogin Pwd',
            'domain' => 'Domain',
            'bind_phone' => 'Bind Phone',
            'display_bind_phone' => 'Display Bind Phone',
            'avator' => 'Avator',
            'introduction' => 'Introduction',
            'gender' => 'Gender',
            'passwordpower' => 'Passwordpower',
            'password' => 'Password',
            'created' => 'Created',
            'updated' => 'Updated',
            'tempyzmtime' => 'Tempyzmtime',
            'tempyzm' => 'Tempyzm',
            'last_login' => 'Last Login',
            'default_language' => 'Default Language',
            'is_certified' => 'Is Certified',
            'is_active' => 'Is Active',
            'open_id' => 'Open ID',
            'token' => 'Token',
            'expire' => 'Expire',
            'realpassword' => 'Realpassword',
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

        $criteria->compare('customer_id', $this->customer_id, true);
        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('full_name', $this->full_name, true);
        $criteria->compare('real_name', $this->real_name, true);
        $criteria->compare('nick_name', $this->nick_name, true);
        $criteria->compare('sex', $this->sex, true);
        $criteria->compare('country', $this->country);
        $criteria->compare('province', $this->province);
        $criteria->compare('city', $this->city);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('born', $this->born, true);
        $criteria->compare('disply_born', $this->disply_born);
        $criteria->compare('document_num', $this->document_num, true);
        $criteria->compare('document_type', $this->document_type, true);
        $criteria->compare('bind_email', $this->bind_email, true);
        $criteria->compare('display_bind_email', $this->display_bind_email);
        $criteria->compare('emailyzm', $this->emailyzm);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('weblogin_pwd', $this->weblogin_pwd, true);
        $criteria->compare('domain', $this->domain, true);
        $criteria->compare('bind_phone', $this->bind_phone, true);
        $criteria->compare('display_bind_phone', $this->display_bind_phone);
        $criteria->compare('avator', $this->avator, true);
        $criteria->compare('introduction', $this->introduction, true);
        $criteria->compare('gender', $this->gender);
        $criteria->compare('passwordpower', $this->passwordpower);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('updated', $this->updated, true);
        $criteria->compare('tempyzmtime', $this->tempyzmtime);
        $criteria->compare('tempyzm', $this->tempyzm);
        $criteria->compare('last_login', $this->last_login, true);
        $criteria->compare('default_language', $this->default_language, true);
        $criteria->compare('is_certified', $this->is_certified);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('open_id', $this->open_id, true);
        $criteria->compare('token', $this->token, true);
        $criteria->compare('expire', $this->expire);
        $criteria->compare('realpassword', $this->realpassword, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }
    
    //Fedora
    public function getProvider($criteria = null, $pageSize = 10)
    {
        $criteria = $criteria ? $criteria : new CDbCriteria;
        $criteria->order = $criteria->order ? $criteria->order : 'customer_id DESC';
        $dataProvider = new CActiveDataProvider('Customer', array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => $pageSize, 'pageVar' => 'qpage'),
            ));
        return $dataProvider;
    }

    //Fedora
    public function getInfoByIdOrEmail($pk = 'email or customer_id')
    {
        if (is_numeric($pk)) {
            $customer = $this->findByPk($pk);
        } else {
            $customer = $this->findByAttributes(array('email' => $pk));
        }
        return $customer;
    }

    /**
     * 单独获取用户的头像  RICK add 2013/8/12
     */
    public function getUserHeaderImage($customer_id)
    {

        // $data=$this->findByPk($customer_id);

        //  return $data->avator;

        $data = Yii::app()->db->createCommand()->select('avator')->from('customer')->
            where('customer_id=:id', array(':id' => $customer_id))->queryRow();

        return $data['avator'];

    }

    /**
     * 单独获取用户的昵称  RICK add 2013/8/12
     */
    public function getUserNickName($customer_id)
    {

        $data = $this->findByPk($customer_id);

        return $data->nick_name;

    }

    /**
     * 单独获取用户的邮箱  RICK add 2013/8/12
     */
    public function getUserEmail($customer_id)
    {

        $data = $this->findByPk($customer_id);

        return $data->email;

    }

    /**
     * 单独获取用户的地址  RICK add 2013/8/12
     */
    public function getUserAddress($customer_id)
    {

        $data = $this->findByPk($customer_id);

        return $data->address;

    }
    /**
     * 卖家昵称转化为ID  RICK add 2013/8/12
     */
       public function getUserId($nick_name)
    {

        $data = $this->findByAttributes(array('nick_name'=>$nick_name));

        return $data->customer_id;

    }

    /**
     * 密码强度计算  RICK add 2013/8/21
     */
    public function PassWordPower($str)
    {

        $score = 0;
        if (preg_match("/[0-9]+/", $str)) {
            $score++;
        }
        if (preg_match("/[0-9]{3,}/", $str)) {
            $score++;
        }
        if (preg_match("/[a-z]+/", $str)) {
            $score++;
        }
        if (preg_match("/[a-z]{3,}/", $str)) {
            $score++;
        }
        if (preg_match("/[A-Z]+/", $str)) {
            $score++;
        }
        if (preg_match("/[A-Z]{3,}/", $str)) {
            $score++;
        }
        if (preg_match("/[_|\-|+|=|*|!|@|#|$|%|^|&|(|)]+/", $str)) {
            $score += 2;
        }
        if (preg_match("/[_|\-|+|=|*|!|@|#|$|%|^|&|(|)]{3,}/", $str)) {
            $score++;
        }
        if (strlen($str) >= 10) {
            $score++;
        }

        return $score;

    }

    public static function link($customer_id, $html = array('target' => '_blank'))
    {
        $customer = Customer::model()->findByPk($customer_id);
        if (U_ID == $customer_id) {
            return CHtml::link($customer->nick_name, Yii::app()->createUrl('center/index'),
                $html);
        } else {
            return CHtml::link($customer->nick_name, Yii::app()->createUrl('people/index',
                array('u_id' => $customer_id)), $html);
        }
    }

    public function checkEmail($email)
    {
        $result = array();
        if (empty($email)) {
            $result['state'] = '0';
            $result['reason'] = '邮箱不能为空';
            exit(json_encode($result));
        }

        if (!preg_match("/^[0-9a-zA-Z]+(?:[._-][a-z0-9-]+)*@[a-zA-Z0-9]+(?:[-.][a-zA-Z0-9]+)*.[a-zA-Z]+$/i",
            $email)) {
            $result['state'] = '0';
            $result['reason'] = '邮箱格式错误';
            exit(json_encode($result));
        }

        //$user = Yii::app()->db->createCommand()->select('email')->from('customer')->where('email=:email', array(':email' => $email))->queryAll();
        $user = $this->find(array('condition' => 't.email = "' . $email . '"', 'select' =>
                'customer_id'));
        if ($user->customer_id) {
            $result['state'] = '0';
            $result['reason'] = '此邮箱已经被注册了';
            exit(json_encode($result));
        }
    }
    //更新用户登录时间字段 rick add
    public function updateLoginTime($email,$pwd){
        
        $user=Customer::model()->findByAttributes(array('email'=>$email,'password'=>md5($pwd)));
        $user->last_login=date('Y-m-d H:i:s',time());
        $user->save(false);
    }
    //获取用户展示地址
    public function getAddress($id,$type=null){
        $str=null;
        $data=Customer::model()->findByPk($id);
        
        if(!empty($data->country_id)){
            
            $country=CountryAddendum::model()->findByAttributes(array('country_id'=>$data->country_id));
            $str.=$country->name;
        }
        
        if(!empty($data->state_id) && $data->state_id != $data->country_id){
            
            $state=StateAddendum::model()->findByAttributes(array('state_id'=>$data->state_id));
            $str.='-'.$state->name;
        } 
        
        if(!empty($data->city_id) && $data->city_id != $data->state_id){
            
            $city=CityAddendum::model()->findByAttributes(array('city_id'=>$data->city_id));
            $str.='-'.$city->name;
        } 
      
        return    $str; 
    }
    
}
