<?php

/**
 * This is the model class for table "travel_companion_buddy".
 *
 * The followings are the available columns in table 'travel_companion_buddy':
 * @property string $travel_companion_buddy_id
 * @property integer $confirmed
 * @property string $customer_id
 * @property string $buddy_id
 *
 * The followings are the available model relations:
 * @property Customer $customer
 * @property Customer $buddy
 */
class TravelCompanionBuddy extends CActiveRecord
{
        /**
         * Returns the static model of the specified AR class.
         * @return TravelCompanionBuddy the static model class
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
                return 'travel_companion_buddy';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
                // NOTE: you should only define rules for those attributes that
                // will receive user inputs.
                return array(
                        array('customer_id, buddy_id', 'required'),
                        array('confirmed', 'numerical', 'integerOnly'=>true),
                        array('customer_id, buddy_id', 'length', 'max'=>10),
                        // The following rule is used by search().
                        // Please remove those attributes that should not be searched.
                        array('travel_companion_buddy_id, confirmed, customer_id, buddy_id', 'safe', 'on'=>'search'),
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
                        'buddy' => array(self::BELONGS_TO, 'Customer', 'buddy_id'),
                );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels()
        {
                return array(
                        'travel_companion_buddy_id' => 'Travel Companion Buddy',
                        'confirmed' => 'Confirmed',
                        'customer_id' => 'Customer',
                        'buddy_id' => 'Buddy',
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

                $criteria->compare('travel_companion_buddy_id',$this->travel_companion_buddy_id,true);
                $criteria->compare('confirmed',$this->confirmed);
                $criteria->compare('customer_id',$this->customer_id,true);
                $criteria->compare('buddy_id',$this->buddy_id,true);

                return new CActiveDataProvider($this, array(
                        'criteria'=>$criteria,
                ));
        }

        public function getTravelBuddyInfo($customer_id,$is_profile_id = false) {

                if($is_profile_id == false) {
                  $get_buddies_requests = "select buddy_id from ".TravelCompanionBuddy::model()->tableName()." where buddy_id = '".(int)$customer_id."' and confirmed = '0'";
              $row_data = Yii::app()->db->createCommand($get_buddies_requests)->queryAll();
                } else {
                  $get_travel_buddies = "select customer_id, buddy_id from ".TravelCompanionBuddy::model()->tableName()." where (buddy_id = '".(int)$customer_id."' or customer_id = '".(int)$customer_id."') and confirmed = '1' order by rand() limit 3";
                  $row_data = Yii::app()->db->createCommand($get_travel_buddies)->queryAll();
                }

                return $row_data;
          }
}
