<?php

class TravelCompanionBlog extends CActiveRecord
{

        public static function model($className=__CLASS__)
        {
                return parent::model($className);
        }

        public function tableName()
        {
                return 'travel_companion_blog';
        }

        public function rules()
        {
                return array(
                        //array('title, content, tags, added_by, created, customer_id, category_id, travelers4fun_category_id', 'required'),
                        array('status, travelers4fun_blog, travelers4fun_featured', 'numerical', 'integerOnly'=>true),
                        array('title, tags', 'length', 'max'=>255),
                        array('added_by', 'length', 'max'=>100),
                        array('customer_id, category_id, travelers4fun_category_id', 'length', 'max'=>10),
                        array('travel_companion_blog_id, title, content, tags, added_by, status, travelers4fun_blog, travelers4fun_featured, created, customer_id, category_id, travelers4fun_category_id', 'safe', 'on'=>'search'),
                );
        }


        public function relations()
        {
                return array(
                        'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
                        'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
                        'travelers4funCategory' => array(self::BELONGS_TO, 'Travelers4funCategory', 'travelers4fun_category_id'),
                        'travelCompanionBlogComments' => array(self::HAS_MANY, 'TravelCompanionBlogComment', 'travel_companion_blog_id'),
                );
        }
        public static function tep_break_string($string, $len, $break_char = '-')
        {
                $l = 0;
                $output = '';
                for ($i=0, $n=strlen($string); $i<$n; $i++) {
                  $char = substr($string, $i, 1);
                  if ($char != ' ') {
                        $l++;
                  } else {
                        $l = 0;
                  }
                  if ($l > $len) {
                        $l = 1;
                        $output .= $break_char;
                  }
                  $output .= $char;
                }

                return $output;
         }
        function getTravelCompanionBlogDetail($limit = null) {
                $criteria = new CDbCriteria;
                $criteria->condition = 't.status = :id AND travelers4fun_blog = :blog_id';
                $criteria->params = array(':id' => '1', ':blog_id' => '2');
                $criteria->limit = ($limit == null)?'3':$limit;
                $criteria->order=' created DESC';
                return TravelCompanionBlog::model()->findAll($criteria);
        }

        //Travel companion Blog
        public function tepCountBlogs($profile_ids=0){

          $total_of_blogs="select count(*) as total_blogs from ".TravelCompanionBlog::model()->tableName()." where travelers4fun_blog = '0'";
                if($profile_ids>0){
                   $total_of_blogs="select count(*) as total_blogs from ".TravelCompanionBlog::model()->tableName()." where customer_id=".(int)$profile_ids." and travelers4fun_blog = '0'";
                }
                $row_total_of_blogs= Yii::app()->db->createCommand($total_of_blogs)->queryAll();
                return $row_total_of_blogs[0]['total_blogs'];
       }
	   
	   public function getTravelCompanionBlog($profile_user_id,$type='', $status = '') {
		   $criteria=new CDbCriteria;
			if($type == 'blog') { // My Tc Profile - blog Section
			   $criteria->select='travel_companion_blog_id, customer_id, title, content, category_id, created, status';
			   if($status !=' ') {
			      $criteria->condition="customer_id=:customer_id AND travelers4fun_blog=:checkstat AND status=:activestatus";
			      $criteria->params=array(':customer_id'=>(int)$profile_user_id, ':checkstat'=>'0',':activestatus'=>$status);
			   } else {
				  $criteria->condition="customer_id=:customer_id AND travelers4fun_blog=:checkstat";
			      $criteria->params=array(':customer_id'=>(int)$profile_user_id, ':checkstat'=>'0'); 
			   }
			   $criteria->order = 'travel_companion_blog_id DESC';
			   $tc_model = TravelCompanionBlog::model()->findAll($criteria);
			 }else{
			   $tc_model = 0;		
			}
		
		return $tc_model;   
	 }
 }
