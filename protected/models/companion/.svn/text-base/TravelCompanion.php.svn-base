<?php

/**
 * This is the model class for table "travel_companion".
 *
 * The followings are the available columns in table 'travel_companion':
 * @property int(10) unsigned $travel_companion_id
 * @property varchar(200) $title
 * @property text $content
 * @property varchar(30) $customer_name
 * @property char(1) $customer_gender
 * @property varchar(16) $customer_age
 * @property varchar(255) $email
 * @property varchar(100) $phone
 * @property int(11) $click_num
 * @property tinyint(1) $companion_email_display
 * @property tinyint(1) $companion_phone_display
 * @property tinyint(1) $companion_age_display
 * @property tinyint(4) $bbs_type
 * @property date $departure_date
 * @property date $departure_date_end
 * @property date $returning_date
 * @property tinyint(4) $stick_num_days
 * @property tinytext $remark
 * @property tinyint(2) $now_people_man
 * @property tinyint(2) $now_people_woman
 * @property tinyint(2) $now_people_child
 * @property tinyint(2) $hope_people_man
 * @property tinyint(2) $hope_people_woman
 * @property tinyint(2) $hope_people_child
 * @property tinyint(1) $who_payment
 * @property varchar(200) $personal_introduction
 * @property tinyint(1) $open_ended
 * @property varchar(100) $recommend_product_id
 * @property enum('0','1') $has_expired
 * @property varchar(100) $trip_type
 * @property varchar(100) $advice_type
 * @property tinyint(1) $show_interest
 * @property tinyint(1) $receive_other_mail
 * @property timestamp $created
 * @property timestamp $updated
 * @property tinyint(1) $active
 * @property int(10) unsigned $customer_id
 * @property int(10) unsigned $product_id
 * @property int(10) unsigned $order_id
 * @property int(10) unsigned $city_id
 *
 * The followings are the available model relations:
 * @property City $city
 * @property Customer $customer
 * @property Product $product
 * @property TravelCompanionApplication[] $travelCompanionApplications
 * @property mixed $travelCompanionApplicationCount
 * @property Category[] $categories
 * @property TravelCompanionReply[] $travelCompanionReplies
 * @property mixed $travelCompanionReplyCount
 */
class TravelCompanion extends BaseActiveRecord
{
	public $verifyCode;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content, customer_name, customer_gender, customer_age, email, departure_date, returning_date, remark, updated, customer_id, product_id, order_id', 'required'),
			array('click_num, companion_email_display, companion_phone_display, companion_age_display, bbs_type, stick_num_days, now_people_man, now_people_woman, now_people_child, hope_people_man, hope_people_woman, hope_people_child, who_payment, open_ended, show_interest, receive_other_mail, active', 'numerical', 'integerOnly'=>true),
			array('title, personal_introduction', 'length', 'max'=>200),
			array('customer_name', 'length', 'max'=>30),
			array('customer_gender, has_expired', 'length', 'max'=>1),
			array('customer_age', 'length', 'max'=>16),
			array('email', 'length', 'max'=>255),
			array('phone, recommend_product_id, trip_type, advice_type', 'length', 'max'=>100),
			array('customer_id, product_id, order_id, city_id', 'length', 'max'=>10),
			array('departure_date_end, created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('travel_companion_id, title, content, customer_name, customer_gender, customer_age, email, phone, click_num, companion_email_display, companion_phone_display, companion_age_display, bbs_type, departure_date, departure_date_end, returning_date, stick_num_days, remark, now_people_man, now_people_woman, now_people_child, hope_people_man, hope_people_woman, hope_people_child, who_payment, personal_introduction, open_ended, recommend_product_id, has_expired, trip_type, advice_type, show_interest, receive_other_mail, created, updated, active, customer_id, product_id, order_id, city_id', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.travel_companion_id>10', $this->getTableAlias(true, false)));
    }
     */

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'city' => array(self::BELONGS_TO, 'City', 'city_id'),
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
			'travelCompanionApplications' => array(self::HAS_MANY, 'TravelCompanionApplication', 'travel_companion_id'),
			'travelCompanionApplicationCount' => array(self::STAT, 'TravelCompanionApplication', 'travel_companion_id'),
			'categories' => array(self::MANY_MANY, 'Category', 'travel_companion_category(travel_companion_id, category_id)'),
			'travelCompanionReplies' => array(self::HAS_MANY, 'TravelCompanionReply', 'travel_companion_id'),
			'travelCompanionReplyCount' => array(self::STAT, 'TravelCompanionReply', 'travel_companion_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'travel_companion_id' => 'Travel Companion ID',
			'title' => 'Title',
			'content' => 'Content',
			'customer_name' => 'Customer Name',
			'customer_gender' => 'Customer Gender',
			'customer_age' => 'Customer Age',
			'email' => 'Email',
			'phone' => 'Phone',
			'click_num' => 'Click Num',
			'companion_email_display' => 'Companion Email Display',
			'companion_phone_display' => 'Companion Phone Display',
			'companion_age_display' => 'Companion Age Display',
			'bbs_type' => 'Bbs Type',
			'departure_date' => 'Departure Date',
			'departure_date_end' => 'Departure Date End',
			'returning_date' => 'Returning Date',
			'stick_num_days' => 'Stick Num Days',
			'remark' => 'Remark',
			'now_people_man' => 'Now People Man',
			'now_people_woman' => 'Now People Woman',
			'now_people_child' => 'Now People Child',
			'hope_people_man' => 'Hope People Man',
			'hope_people_woman' => 'Hope People Woman',
			'hope_people_child' => 'Hope People Child',
			'who_payment' => 'Who Payment',
			'personal_introduction' => 'Personal Introduction',
			'open_ended' => 'Open Ended',
			'recommend_product_id' => 'Recommend Product ID',
			'has_expired' => 'Has Expired',
			'trip_type' => 'Trip Type',
			'advice_type' => 'Advice Type',
			'show_interest' => 'Show Interest',
			'receive_other_mail' => 'Receive Other Mail',
			'created' => 'Created',
			'updated' => 'Updated',
			'active' => 'Active',
			'customer_id' => 'Customer ID',
			'product_id' => 'Product ID',
			'order_id' => 'Order ID',
			'city_id' => 'City ID',
			'verifyCode' => 'Verify Code',
		);
        foreach ($t as $k => $v) $t[$k] = Yii::t($this->tableName(), $v);
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

		$criteria=new CDbCriteria;

		$criteria->compare('travel_companion_id',$this->travel_companion_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('customer_name',$this->customer_name,true);
		$criteria->compare('customer_gender',$this->customer_gender,true);
		$criteria->compare('customer_age',$this->customer_age,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('click_num',$this->click_num);
		$criteria->compare('companion_email_display',$this->companion_email_display);
		$criteria->compare('companion_phone_display',$this->companion_phone_display);
		$criteria->compare('companion_age_display',$this->companion_age_display);
		$criteria->compare('bbs_type',$this->bbs_type);
		$criteria->compare('departure_date',$this->departure_date,true);
		$criteria->compare('departure_date_end',$this->departure_date_end,true);
		$criteria->compare('returning_date',$this->returning_date,true);
		$criteria->compare('stick_num_days',$this->stick_num_days);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('now_people_man',$this->now_people_man);
		$criteria->compare('now_people_woman',$this->now_people_woman);
		$criteria->compare('now_people_child',$this->now_people_child);
		$criteria->compare('hope_people_man',$this->hope_people_man);
		$criteria->compare('hope_people_woman',$this->hope_people_woman);
		$criteria->compare('hope_people_child',$this->hope_people_child);
		$criteria->compare('who_payment',$this->who_payment);
		$criteria->compare('personal_introduction',$this->personal_introduction,true);
		$criteria->compare('open_ended',$this->open_ended);
		$criteria->compare('recommend_product_id',$this->recommend_product_id,true);
		$criteria->compare('has_expired',$this->has_expired,true);
		$criteria->compare('trip_type',$this->trip_type,true);
		$criteria->compare('advice_type',$this->advice_type,true);
		$criteria->compare('show_interest',$this->show_interest);
		$criteria->compare('receive_other_mail',$this->receive_other_mail);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('city_id',$this->city_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


    public function getTotall(){
        return $this->hope_people_man + $this->hope_people_woman + $this->hope_people_child;
    }

    public function getHasTotall(){
        $count = 0;
        foreach($this->travelCompanionApplications as $app){
            $count += $app->people_num;
        }
        return $count;
    }

    public function getAgree(){
        $count = 0;
        foreach($this->travelCompanionApplications as $app){
            if($app->verify_status==1) $count++;
        }
        return $count;
    }

	public function checkHopePeopleTotal($attribute, $params) {
		if ($this->hope_people_man + $this->hope_people_woman + $this->hope_people_child < 1) $this->addError('hope_people_total', '请选择期望伴友数。');
	}

	public function checkNowPeopleTotal($attribute, $params) {
		if ($this->now_people_man + $this->now_people_woman + $this->now_people_child < 1) $this->addError('now_people_total', '请选择现有人数。');
	}

    public function getProvider($attributes=array(),$pageSize=10,$order='travel_companion_id DESC'){
        $criteria = new CDbCriteria;
        if($attributes){
            foreach($attributes as $key=>$value){
                $criteria->addCondition('`t`.`'.$key.'` ="'.$value.'"');
            }
        }
        $criteria->order = $order;
    	$dataProvider=new CActiveDataProvider('TravelCompanion', array(
    			'criteria'=>$criteria,
                'pagination'=>array('pageSize'=>$pageSize,'pageVar'=>'qpage'),
    	));
    	return $dataProvider;
    }

}