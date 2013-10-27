<?php
class TravelCompanionProfileVideo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TravelCompanionProfileVideo the static model class
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
		return 'travel_companion_profile_video';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, url, customer_id', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('title, url', 'length', 'max'=>255),
			array('customer_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('travel_companion_profile_video_id, title, url, active, customer_id', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'travel_companion_profile_video_id' => 'Travel Companion Profile Video',
			'title' => 'Title',
			'url' => 'Url',
			'active' => 'Active',
			'customer_id' => 'Customer',
		);
	}
	
	public function tepGetAllVideos($profile_user_id,$addon_videos_query1) {
	   $all_videos_query1 = "select url, travel_companion_profile_video_id, active,title from ".TravelCompanionProfileVideo::model()->tableName()." where customer_id = '".$profile_user_id."'".$addon_videos_query1;
	   $get_all_videos1 = Yii::app()->db->createCommand($all_videos_query1)->queryAll();
	     return $get_all_videos1;	
	}
 }