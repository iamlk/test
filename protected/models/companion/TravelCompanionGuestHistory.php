<?php

/**
 * This is the model class for table "travel_companion_guest_history".
 *
 * The followings are the available columns in table 'travel_companion_guest_history':
 * @property string $travel_companion_guest_history_id
 * @property string $guest_customer_id
 * @property string $customer_id
 * @property string $created
 *
 * The followings are the available model relations:
 * @property Customer $guest
 * @property Customer $customer
 */
class TravelCompanionGuestHistory extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return TravelCompanionGuestHistory the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'travel_companion_guest_history';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('guest_customer_id, customer_id', 'required'),
            array('guest_customer_id, customer_id', 'length', 'max' => 10),
            array('created', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('travel_companion_guest_history_id, guest_customer_id, customer_id, created', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'guest' => array(self::BELONGS_TO, 'Customer', 'guest_customer_id'),
            'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'travel_companion_guest_history_id' => 'Travel Companion Guest History',
            'guest_customer_id' => 'Guest',
            'customer_id' => 'Customer',
            'created' => 'Created',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('travel_companion_guest_history_id', $this->travel_companion_guest_history_id, true);
        $criteria->compare('guest_customer_id', $this->guest_customer_id, true);
        $criteria->compare('customer_id', $this->customer_id, true);
        $criteria->compare('created', $this->created, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}
