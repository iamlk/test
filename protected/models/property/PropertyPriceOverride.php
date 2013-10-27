<?php
/**
 * 房子价格表.覆盖价格表
 * @note 此数据表里定义的价格，为结算时最终的"实用价格"，覆盖了{@link 基本价格表}里的day_price价格；
 * @note 规定：价格值为0的，表示此房子为soldout即不出租时段，可以显示但不能下单，与Property->is_active不同；
 * @note 此数据表为“修改历史记录”表，{@link 价格模型}规定业务操作上不允许“修改”旧记录，只能“增加”新记录；
 * @note 读取数据时，某房子的覆盖价格，是一组价格的定义，即最新一组(datetime)的记录，旧的记录以备查；
 * @note 最终的价格组中，以"开始日期最近+结束日期最近+定义顺序最后"的规则，来确定当天价格。
 * @author zyme
 *
 * The followings are the available columns in table 'property_price_override':
 * @property int(10) unsigned $_id
 * @property int(10) unsigned $property_id
 * @property decimal(10,2) unsigned $day_price
 * @property date $start_date
 * @property date $end_date
 * @property datetime $datetime
 *
 * The followings are the available model relations:
 * @property object $property
 */
class PropertyPriceOverride extends BaseActiveRecord
{

    /** 最大的定价日期范围，超过此日期的应该修改为此日期 **/
    const MAX_OVERRIDE_DATE = '2020-02-02';

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('property_id, datetime', 'required'),
            array(
                'property_id',
                'match',
                'pattern' => '/^[1-9]\d{0,8}$/'),
            array(
            'day_discount',
            'in',
            'range'=>array_keys(Property::getDiscount())
            ),
             array(
            'rise_float',
            'in',
            'range'=>array_keys(Property::getRisecount())
            ),
            array('is_rise','in','range'=>array(0,1)),    
            array(
                'day_price',
                'numerical',
                'min' => 0,
                'max' => 99999999.99,
                'numberPattern' => '/^([1-9]\d{1,7}|\d)(\.\d{1,2})?$/'),
            array(
                'start_date, end_date',
                'date',
                'format' => 'yyyy-MM-dd'),
            array(
                'datetime',
                'date',
                'format' => array('yyyy-MM-dd hh:mm:ss', 'yyyy-MM-dd')),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                '_id, property_id, day_price, start_date, end_date, datetime',
                'safe',
                'on' => 'search'),
            );
    }

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s._id>10', $this->getTableAlias(true, false)));
    }

    /**
     * @return array the query criteria.
     */
    public function scopes()
    {
        return array(
            'lastPriceOverride' => array('order' => '_id DESC', 'limit' => 1),
            'lastPriceOverrides' => array('order' => '_id ASC'),
            );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array('property' => array(
                self::BELONGS_TO,
                'Property',
                'property_id'), );
    }
    
    public function attributeLabels()
    {
        $a = array(
           
            'start_date' => '起始时间',
            'end_date' => '结束时间',
            'day_price' => '特殊时段价格',
            'day_discount' => '特殊时段折扣',
            'is_rise' => '涨价',
            'rise_float' => '涨价',
          
            );
        foreach ($a as $k => $v)
            $a[$k] = Yii::t($this->tableName(), $v);
        return $a;
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
        $criteria->compare('start_date', $this->start_date, true);
        $criteria->compare('end_date', $this->end_date, true);
        $criteria->compare('datetime', $this->datetime, true);
        $criteria->compare('day_discount', $this->day_discount, true);
        $criteria->compare('is_rise', $this->is_rise, true);
        $criteria->compare('rise_float', $this->rise_float, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }

    /**
     * 某个房子的"覆盖价格"的"日期"记录
     */
    private function _getDatetimes($property_id = null)
    {
        if ($property_id == null) $property_id = $this->property_id;
        return Yii::app()->db->createCommand()->select('datetime')->distinct(true)->from($this->tableName())->where(sprintf("property_id='%u'", $property_id))->order('datetime ASC')->queryColumn();
    }

    /**
     * 返回某个房子的最终"覆盖价格"的定价记录数组
     */
    public function propertyLastOverridePrices($property_id = null)
    {
        if ($property_id == null) $property_id = $this->property_id;
        if ($_a = $this->_getDatetimes($property_id)) $datetime = array_pop($_a);
        else  return array();
        return $this->findAllByAttributes(sprintf("property_id='%u' AND datetime='%s'", $property_id, $datetime));
    }

}
