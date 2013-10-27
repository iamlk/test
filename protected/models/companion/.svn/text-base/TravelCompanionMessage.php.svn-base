<?php

/**
 * This is the model class for table "travel_companion_message".
 *
 * The followings are the available columns in table 'travel_companion_message':
 * @property string $travel_companion_message_id
 * @property string $content
 * @property integer $read
 * @property string $created
 * @property string $customer_id
 * @property string $customer_message_id
 *
 * The followings are the available model relations:
 * @property Customer $customer
 * @property Customer $customerMessage
 */
class TravelCompanionMessage extends CActiveRecord
{
        /**
         * Returns the static model of the specified AR class.
         * @return TravelCompanionMessage the static model class
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
                return 'travel_companion_message';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
                // NOTE: you should only define rules for those attributes that
                // will receive user inputs.
                return array(
                        array('content, created, customer_id, customer_message_id', 'required'),
                        array('read', 'numerical', 'integerOnly'=>true),
                        array('customer_id, customer_message_id', 'length', 'max'=>10),
                        // The following rule is used by search().
                        // Please remove those attributes that should not be searched.
                        array('travel_companion_message_id, content, read, created, customer_id, customer_message_id', 'safe', 'on'=>'search'),
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
                        'customerMessage' => array(self::BELONGS_TO, 'Customer', 'customer_message_id'),
                );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels()
        {
                return array(
                        'travel_companion_message_id' => 'Travel Companion Message',
                        'content' => 'Content',
                        'read' => 'Read',
                        'created' => 'Created',
                        'customer_id' => 'Customer',
                        'customer_message_id' => 'Customer Message',
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

                $criteria->compare('travel_companion_message_id',$this->travel_companion_message_id,true);
                $criteria->compare('content',$this->content,true);
                $criteria->compare('read',$this->read);
                $criteria->compare('created',$this->created,true);
                $criteria->compare('customer_id',$this->customer_id,true);
                $criteria->compare('customer_message_id',$this->customer_message_id,true);

                return new CActiveDataProvider($this, array(
                        'criteria'=>$criteria,
                ));
        }
}
