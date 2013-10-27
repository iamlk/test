<?php

/**
 * This is the model class for table "itinerary".
 *
 * The followings are the available columns in table 'itinerary':
 * @property int(10) unsigned $itinerary_id
 * @property varchar(250) $title
 * @property date $start_date
 * @property date $end_date
 * @property smallint(6) $total_people
 * @property text $json
 * @property decimal(10,2) unsigned $cpp
 * @property int(10) unsigned $created
 * @property int(10) unsigned $share_count
 * @property int(10) unsigned $order_id
 * @property int(10) unsigned $customer_id
 *
 * The followings are the available model relations:
 * @property Customer $customer
 * @property Order $order
 * @property ItineraryDetail[] $itineraryDetails
 * @property mixed $itineraryDetailCount
 */
class Itinerary extends BaseActiveRecord
{

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, start_date, end_date, cpp, created', 'required'),
            array(
                'total_people',
                'numerical',
                'integerOnly' => true),
            array(
                'title',
                'length',
                'max' => 250),
            array(
                'cpp, created, share_count, order_id, customer_id, view_count',
                'length',
                'max' => 10),
            array('json', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'itinerary_id, title, start_date, end_date, total_people, json, cpp, created, share_count, order_id, customer_id, view_count',
                'safe',
                'on' => 'search'),
            );
    }

    /**
     * @return array the query criteria.
     * public function defaultScope()
     * {
     * return array('condition' => sprintf('%s.itinerary_id>10', $this->getTableAlias(true, false)));
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
            'customer' => array(
                self::BELONGS_TO,
                'Customer',
                'customer_id'),
            'order' => array(
                self::BELONGS_TO,
                'Order',
                'order_id'),
            'itineraryDetails' => array(
                self::HAS_MANY,
                'ItineraryDetail',
                'itinerary_id'),
            'itineraryDetailCount' => array(
                self::STAT,
                'ItineraryDetail',
                'itinerary_id'),
            'reviews' => array(
                self::HAS_MANY,
                'ItineraryReview',
                'itinerary_id'),
            'reviewCount' => array(
                self::STAT,
                'ItineraryReview',
                'itinerary_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $t = array(
            'itinerary_id' => 'Itinerary ID',
            'title' => 'Title',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'total_people' => 'Total People',
            'json' => 'Json',
            'cpp' => 'Cpp',
            'created' => 'Created',
            'share_count' => 'Share Count',
            'order_id' => 'Order ID',
            'view_count' => 'View Count',
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

        $criteria->compare('itinerary_id', $this->itinerary_id, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('start_date', $this->start_date, true);
        $criteria->compare('end_date', $this->end_date, true);
        $criteria->compare('total_people', $this->total_people);
        $criteria->compare('view_count', $this->view_count);
        $criteria->compare('json', $this->json, true);
        $criteria->compare('cpp', $this->cpp, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('share_count', $this->share_count, true);
        $criteria->compare('order_id', $this->order_id, true);
        $criteria->compare('customer_id', $this->customer_id, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }

    public function getProvider($criteria = null, $pageSize = 10)
    {
        $criteria = $criteria ? $criteria : new CDbCriteria;
        $criteria->order = $criteria->order ? $criteria->order : 'itinerary_id DESC';
        $dataProvider = new CActiveDataProvider('Itinerary', array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => $pageSize, 'pageVar' => 'qpage'),
            ));
        return $dataProvider;
    }

    public function create($order_id, $title)
    {
        $order = Order::model()->findByPk($order_id);
        if (Yii::app()->user->customer_id != $order->customer_id)
            exit('forbidden!!!');
        if ($order->order_status == Order::ITINERARY_STATUS)
            return false;
        $this->title = $title;
        $this->start_date = $order->start_date;
        $this->end_date = $order->end_date;
        $this->json = $order->json;
        $this->created = time();
        $this->order_id = $order->order_id;
        $this->customer_id = $order->customer_id;
        $this->total_people = OrderDetail::model()->getTotalPeople($order_id);
        $this->cpp = $order->payment_total / $this->total_people;
        $this->isNewRecord = true;
        if ($this->save()) {
            ItineraryDetail::model()->create($order_id, $this->itinerary_id);
            $order->order_status = Order::ITINERARY_STATUS;
            return $order->save();
        } else {
            return false;
        }
    }
    /**
     *  RICK  ADD 行程单验证
     */

    public function checkTravel($order_id)
    {

        $data = Yii::app()->db->createCommand()->select('*')->from('itinerary')
            ->where('order_id=:id', array(':id' => $order_id))->queryAll();
            
            return count($data);

    }
}
