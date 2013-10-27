<?php
/**
 * This is the model class for table "city_recommend".
 *
 * The followings are the available columns in table 'city_recommend':
 * @property string $city_recommend_id
 * @property string $city_id
 * @property integer $start_time
 * @property integer $end_time
 * @property integer $property_count
 * @property integer $product_count
 * @property integer $click_count
 * @property integer $order
 * @property integer $is_active
 */
class CityRecommend extends CActiveRecord
{
    public $name;
    public $image;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return CityRecommend the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'city_recommend';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('city_id, start_time, end_time, property_count, product_count, click_count, order, is_active, type', 'required'),
            array(
                'start_time, end_time, property_count, product_count, click_count, order, is_active, type',
                'numerical',
                'integerOnly' => true),
            array(
                'city_id',
                'length',
                'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'city_recommend_id, city_id, start_time, end_time, property_count, product_count, click_count, order, is_active, type',
                'safe',
                'on' => 'search'),
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
            'city' => array(
                self::BELONGS_TO,
                'City',
                'city_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'city_recommend_id' => 'City Recommend',
            'city_id' => 'City',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'property_count' => 'Property Count',
            'product_count' => 'Product Count',
            'click_count' => 'Click Count',
            'order' => 'Order',
            'is_active' => 'is_active',
            'type' => 'type',
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

        $criteria->compare('city_recommend_id', $this->city_recommend_id, true);
        $criteria->compare('city_id', $this->city_id, true);
        $criteria->compare('start_time', $this->start_time);
        $criteria->compare('end_time', $this->end_time);
        $criteria->compare('property_count', $this->property_count);
        $criteria->compare('product_count', $this->product_count);
        $criteria->compare('click_count', $this->click_count);
        $criteria->compare('order', $this->order);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('type', $this->type);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }

    public function afterFind()
    {
        $this->name = $this->city['name'];
        $this->image = $this->city['image'];
    }

    /**
     * 自动动态调整
     */
    public function automationSet()
    {
        $model = new CityRecommend;
        $model->updateAll(array('is_active'=>1),'start_time < :current_time AND end_time > :current_time',array(':current_time'=>time()));
        $model->updateAll(array('is_active'=>0),'start_time > :current_time or end_time < :current_time',array(':current_time'=>time()));
    }
}
