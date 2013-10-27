<?php
/**
 * 房子价格表.基本价格表
 * @note 此数据表里定义的价格，为结算时默认的"基本价格"，具体价格会被{@link 覆盖价格表}覆盖；
 * @note 规定：价格值为0时，表示此房子为soldout即不出租状态，可以显示但不能下单，与Property->is_active不同；
 * @note 此数据表为“修改历史记录”表，{@link 价格模型}规定业务操作上不允许“修改”旧记录，只能“增加”新记录；
 * @note 读取数据时，某房子的基本价格只有一条记录，即最新一条(datetime/_id)的记录，旧的记录以备查。
 * @author zyme
 *
 * The followings are the available columns in table 'property_price':
 * @property int(10) unsigned $_id
 * @property int(10) unsigned $property_id
 * @property decimal(10,2) unsigned $day_price
 * @property decimal(10,2) unsigned $weekend_price
 * @property decimal(10,2) unsigned $week_price
 * @property decimal(10,2) unsigned $month_price
 * @property decimal(10,2) unsigned $deposit
 * @property smallint(4) unsigned $extra_guest_threshold
 * @property decimal(10,2) unsigned $extra_guest_price
 * @property decimal(10,2) unsigned $clean_price
 * @property text $note
 * @property int(10) unsigned $currency_id
 * @property datetime $datetime
 *
 * The followings are the available model relations:
 * @property object $property
 */
class PropertyPrice extends BaseActiveRecord
{

    /** 周价格所代表的天数，影响结算金额的计算 **/
    const DAYS_WEEK = 7;

    /** 月价格所代表的天数，影响结算金额的计算 **/
    const DAYS_MONTH = 28;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('property_id, day_price, deposit, extra_guest_threshold, extra_guest_price, clean_price, currency_id, datetime,start_date,end_date', 'required'),
             array(
                'start_date, end_date',
                'date',
                'format' => 'yyyy-MM-dd'),
            array(
                'property_id, currency_id',
                'match',
                'pattern' => '/^[1-9]\d{0,8}$/'),
            array(
                'day_price, weekend_price, week_price, month_price, deposit, extra_guest_price, clean_price',
                'numerical',
                'min' => 0,
                'max' => 9999999.99,
                'numberPattern' => '/^([1-9]\d{1,7}|\d)(\.\d{1,2})?$/'),
            array(
                'extra_guest_threshold',
                'match',
                'pattern' => '/^([1-9]\d{1,2}|\d)$/'),
            array(
            'week_discount,month_discount',
            'in',
            'range'=>array_keys(Property::getDiscount())
            ),    
            array('note', 'safe'),
            array(
                'datetime',
                'date',
                'format' => array('yyyy-MM-dd hh:mm:ss', 'yyyy-MM-dd')),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                '_id, property_id, day_price, weekend_price, week_price, month_price, deposit, extra_guest_threshold, extra_guest_price, clean_price, note, currency_id, datetime',
                'safe',
                'on' => 'search'),
            );
    }

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s._id>10 AND %1$s.property_id>10', $this->getTableAlias(true, false)));
    }

    /**
     * @return array the query criteria.
     */
    public function scopes()
    {
        return array('lastPrice' => array('order' => 'propertyPrice._id DESC', 'limit' => 1), );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'property' => array(
                self::BELONGS_TO,
                'Property',
                'property_id'),
            'currency' => array(
                self::BELONGS_TO,
                'Currency',
                'currency_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'day_price' => '日租价格',
            'weekend_price' => '周末价格',
            'week_price' => '周租价格',
            'month_price' => '月租价格',
            'deposit' => '保证金',
            'extra_guest_threshold' => '超过人数',
            'extra_guest_price' => '每人加收',
            'clean_price' => '清洁费用',
            'currency_id' => '结算币种',
            'datetime' => '修改时间',
            'note' => '说明',
            'week_discount' => '周租价格',
            'month_discount' => '月租价格',
            'start_date' => '起始时间',
            'end_date' => '截止时间',
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

        $criteria = new CDbCriteria;

        $criteria->compare('_id', $this->_id, true);
        $criteria->compare('property_id', $this->property_id, true);
        $criteria->compare('day_price', $this->day_price, true);
        $criteria->compare('weekend_price', $this->weekend_price, true);
        $criteria->compare('week_price', $this->week_price, true);
        $criteria->compare('month_price', $this->month_price, true);
        $criteria->compare('deposit', $this->deposit, true);
        $criteria->compare('extra_guest_threshold', $this->extra_guest_threshold, true);
        $criteria->compare('extra_guest_price', $this->extra_guest_price, true);
        $criteria->compare('clean_price', $this->clean_price, true);
        $criteria->compare('currency_id', $this->currency_id, true);
        $criteria->compare('datetime', $this->datetime, true);
        $criteria->compare('week_discount', $this->week_discount, true);
        $criteria->compare('month_discount', $this->month_discount, true);
        $criteria->compare('start_date', $this->start_date, true);
        $criteria->compare('end_date', $this->end_date, true);
        

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }
    
     /**
     * @author rick  2013-8-12
     * @return return  property  price
     */
     
    public function getPropertyPrice($property_id){
        
        $criteria = new CDbCriteria;
       // $criteria->order = "created desc";
        $criteria->condition = "property_id=" .$property_id ;
        $comment = $this::model()->find($criteria);
        
        return $comment->attributes['day_price'];
    } 
    
    
    
}
