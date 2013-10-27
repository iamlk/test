<?php

/**
 * This is the model class for table "travel_companion_blog_comment".
 *
 */
class TravelCompanionBlogComment extends CActiveRecord
{
        /**
         * Returns the static model of the specified AR class.
         * @return TravelCompanionBlogComment the static model class
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
                return 'travel_companion_blog_comment';
        }
        public $verifyCode;
        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
                // NOTE: you should only define rules for those attributes that
                // will receive user inputs.
                return array(
                        //array('comment, created, customer_id, travel_companion_blog_id', 'required'),
                        array('active', 'numerical', 'integerOnly'=>true),
                        array('customer_id, travel_companion_blog_id', 'length', 'max'=>10),
                        array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
                        array('verifyCode,comment','required'),
                        // The following rule is used by search().
                        // Please remove those attributes that should not be searched.
                        array('travel_companion_blog_comment_id, comment, created, active, customer_id, travel_companion_blog_id', 'safe', 'on'=>'search'),
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
                        'travelCompanionBlog' => array(self::BELONGS_TO, 'TravelCompanionBlog', 'travel_companion_blog_id'),
                        'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
                );
        }

}
