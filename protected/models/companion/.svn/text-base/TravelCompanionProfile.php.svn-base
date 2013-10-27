<?php

class TravelCompanionProfile extends CActiveRecord
{
        /**
         * Returns the static model of the specified AR class.
         * @return TravelCompanionProfile the static model class
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
                return 'travel_companion_profile';
        }
		public $customer_language = null;
        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
                // NOTE: you should only define rules for those attributes that
                // will receive user inputs.
                return array(
                        //array('customer_age, customer_gender, customer_ideal_companion, customer_last_viewed, customer_language, customer_location, customer_travel_status_message, home_town, profile_view_counter, photo, places_travelled, places_want_to_travel, biodata, interested, favorite_enterteinment, amazing_experience, quote, i_want_share, traveler_budget, traveler_smoking, traveler_accomodation, traveler_country, user_birth_date, customer_id', 'required'),
                        array('customer_ideal_companion, customer_travel_status_message, photo, places_travelled, places_want_to_travel, biodata, interested, favorite_enterteinment, amazing_experience, quote, i_want_share, user_birth_date', 'required'), //don't remark the rule
                        array('profile_view_counter, profile_completed, profile_available_to_public, allowed_to_see_online, allowed_to_post_on_wall, gender_status, birth_date_status, dont_ask_fmg_post_flag, fmg_companion_flag', 'numerical', 'integerOnly'=>true),
                        array('customer_age', 'length', 'max'=>50),
                        array('customer_gender', 'length', 'max'=>1),
                        //array('customer_ideal_companion, customer_language, customer_travel_status_message, photo, places_travelled, places_want_to_travel, biodata, interested, favorite_enterteinment, amazing_experience, quote, i_want_share, traveler_budget, traveler_smoking, traveler_accomodation, traveler_country, user_birth_date', 'required'),
                        array('customer_location, home_town', 'length', 'max'=>255),
                        array('traveler_budget, traveler_smoking, traveler_accomodation', 'length', 'max'=>20),
                        array('traveler_country', 'length', 'max'=>30),
                        array('customer_id', 'length', 'max'=>10),
                        array('created, last_updated,customer_language', 'safe'),
                        // The following rule is used by search().
                        // Please remove those attributes that should not be searched.
                        array('travel_companion_profile_id, customer_age, customer_gender, customer_ideal_companion, customer_last_viewed, customer_language, customer_location, customer_travel_status_message, home_town, profile_view_counter, photo, places_travelled, places_want_to_travel, biodata, interested, favorite_enterteinment, amazing_experience, quote, i_want_share, traveler_budget, traveler_smoking, traveler_accomodation, traveler_country, profile_completed, profile_available_to_public, allowed_to_see_online, allowed_to_post_on_wall, gender_status, birth_date_status, dont_ask_fmg_post_flag, fmg_companion_flag, user_birth_date, created, last_updated, customer_id', 'safe', 'on'=>'search'),
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
        /*
        * customer profile completion precentage with remaining
        */
        function tcProfileCompletePercentage($cus_id,$with_remaining = false){
        $check_profile_exist_query = self::model()->find(array('condition'=>'customer_id=:x','params'=>array(':x'=>$cus_id)));

        $profile_pic_query = TravelerPhoto::model()->find(array('condition'=>'customer_id=:x and `active` = 1 and main_profile_photo = 1','params'=>array(':x'=>$cus_id)));

        $profile_status = 0;
        $remaining_steps_to_complete_profile = '';

        if(count($check_profile_exist_query)>0){
                if(count($profile_pic_query)>0){
                        $profile_status = $profile_status + 20;
                } else {
                        $remaining_steps_to_complete_profile .= 'Add a Profile Picture<br>';
                }
                if($check_profile_exist_query['customer_age'] != ''){
                        $profile_status = $profile_status + 10;
                } else {
                        $remaining_steps_to_complete_profile .= 'Add Your Age<br>';
                }
                if($check_profile_exist_query['customer_gender'] != ''){
                        $profile_status = $profile_status + 10;
                } else {
                        $remaining_steps_to_complete_profile .= 'Add Your Gender<br>';
                }
                //if($check_profile_exist_query['customer_ideal_companion'] != ''){
                        //$profile_status = $profile_status + 15;
                //}
                if($check_profile_exist_query['customer_location'] != ''){
                        $profile_status = $profile_status + 10;
                } else {
                        $remaining_steps_to_complete_profile .= 'Add Your Location<br>';
                }
                if($check_profile_exist_query['places_travelled'] != ''){
                        $profile_status = $profile_status + 15;
                } else {
                        $remaining_steps_to_complete_profile .= 'Add Places Travelled To<br>';
                }
                if($check_profile_exist_query['places_want_to_travel'] != ''){
                        $profile_status = $profile_status + 20;
                } else {
                        $remaining_steps_to_complete_profile .= 'Add Places I Want To Go<br>';
                }
        }
            if($with_remaining == true) {
                return $profile_status.'--||--'.$remaining_steps_to_complete_profile;
                } else {
                return $profile_status;
                }
        }

        public function checkCustomerId($customer_id) {
                $criteria=new CDbCriteria;
                $criteria->select='customer_id,travel_companion_profile_id,profile_completed';
                $criteria->condition='customer_id=:customer_id';
                $criteria->params=array(':customer_id'=>(int)$customer_id);
                $profileinfo=TravelCompanionProfile::model()->find($criteria);
            return $profileinfo;
        }
        /*
        *  Count point based on customer id .
        * Customer have updated profile
        */
        public function tcProfileStatusPercentage($cust_id){
                $tc=new CDbCriteria();
                $tc->condition = "customer_id = :cid ";
                $tc->params =  array(':cid' => $cust_id);
                $info = TravelCompanionProfile::model()->find($tc);
                $profile_status = 0;
                $remaining_steps_to_complete_profile = '';

                if(count($info)>0){
                if($info['photo'] != ''){
                        $profile_status = $profile_status + 20;
                }else{
                        $remaining_steps_to_complete_profile .= 'Add a Profile Picture<br>';
                }
                if($info['customer_age'] != ''){
                        $profile_status = $profile_status + 10;
                }else{
                        $remaining_steps_to_complete_profile .= 'Add Your Age<br>';
                }
                if($info['customer_gender']){
                        $profile_status = $profile_status + 10;
                }else{
                        $remaining_steps_to_complete_profile .= 'Add Your Gender<br>';
                }

                if($info['customer_location']){
                        $profile_status = $profile_status + 10;
                }else{
                        $remaining_steps_to_complete_profile .= 'Add Your Location<br>';
                }
                if($info['places_travelled']){
                        $profile_status = $profile_status + 15;
                }else{
                        $remaining_steps_to_complete_profile .= 'Add Places Travelled To<br>';
                }
                if($info['places_want_to_travel']){
                        $profile_status = $profile_status + 20;
                }else{
                        $remaining_steps_to_complete_profile .= 'Add Places I Want To Go<br>';
                }
        }
        return $profile_status.'--||--'.$remaining_steps_to_complete_profile;
        }

        public function tepGetProfileViewCounter($customer_id) {
             $sql_counts_all_time ="select profile_view_counter from ".TravelCompanionProfile::model()->tableName()." where customer_id=".(int)$customer_id." group by customer_id";
                 $row_of_alltime_hits = Yii::app()->db->createCommand($sql_counts_all_time)->queryAll();

                 return $row_of_alltime_hits[0];
        }
		
	  /*
	   * Check TC Profile Completed Stutus : give Rewards Points
	   * @ return string
	   */	
	   public function checkTcProfileCompletedAndGiveRewards($customer_id){
		   $row_profile_info = Yii::app()->db->createCommand("select customer_id, customer_age, customer_gender, customer_ideal_companion, customer_location, places_travelled, places_want_to_travel, profile_completed, photo  from ".self::model()->tableName()." where customer_id ='".(int)$customer_id."'")->queryRow();
		   $profile_pic = TravelerPhoto::GetProfileMainPhoto($customer_id);
			
			if(count($row_profile_info)>0 && (count($profile_pic)>0 || $row_profile_info['photo'] !='' ) && tep_not_null($row_profile_info['customer_age']) && tep_not_null($row_profile_info['customer_gender']) && tep_not_null($row_profile_info['customer_location']) && tep_not_null($row_profile_info['places_travelled']) && tep_not_null($row_profile_info['places_want_to_travel']) && $row_profile_info['profile_completed']=='0'){
				$give_rewards = 1; //give reward points
			}else{
				$give_rewards = 0;
			}
			return $give_rewards;
       }
	   public function getCustomerLocation($customers_id,$default_set=0){
		/*
		0 set as customer location without country
		1 set as customer location with country
		*/
		$sql_get_locations="SELECT customer_location from ".TravelCompanionProfile::tableName()." where customer_id =".(int)$customers_id."";
		$row_locations=Yii::app()->db->createCommand($sql_get_locations)->queryRow();
		$city_location='';
		$city_location=$row_locations['customer_location'];
			if($default_set==0){
				$city_location=explode(',',$row_locations['customer_location']);
				$city_location=$city_location[0];
			}
		return $city_location;
		}
	
}
