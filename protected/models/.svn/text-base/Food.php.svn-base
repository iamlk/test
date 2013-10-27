<?php
/**
 * This is the model class for table "food".
 *
 * The followings are the available columns in table 'food':
 * @property string $food_id
 * @property integer $parent_type
 * @property string $parent_id
 * @property string $longitude
 * @property string $latitude
 * @property string $image
 */
class Food extends CActiveRecord
{
    public $name;
    public $description;
    public $content;
    public $shareCount;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Food the static model class
     */
    public static function model($className = __class__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'food';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('longitude, latitude, image', 'required'),
            array(
                'longitude',
                'length',
                'max' => 10),
            array(
                'latitude',
                'length',
                'max' => 9),
            array(
                'image',
                'length',
                'max' => 250),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'food_id, longitude, latitude, image',
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
            'addendum' => array(
                self::HAS_ONE,
                'FoodAddendum',
                'food_id',
                'condition' => 'language="' . Yii::app()->language . '"'),
            'restaurant' => array(
                self::HAS_MANY,
                'Restaurant',
                'food_id'),
            'delicacy' => array(
                self::HAS_MANY,
                'Delicacy',
                'food_id'),
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
            'food_id' => 'Food',
            'longitude' => 'Longitude',
            'latitude' => 'Latitude',
            'image' => 'Image',
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

        $criteria->compare('food_id', $this->food_id, true);
        $criteria->compare('longitude', $this->longitude, true);
        $criteria->compare('latitude', $this->latitude, true);
        $criteria->compare('image', $this->image, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }

    /**
     *
     *
     */
    public function getDropdownList($obj, &$_a = array('|-TOP'), &$level = 1)
    {
        $type = array(
            '1' => 'continent',
            '2' => 'country',
            '3' => 'state',
            '4' => 'city');
        $index = $type[$level] . '_id';
        $num = $type[$level + 1];

        foreach ($obj as $item) {
            $_a[strval($level . '-' . $item[$index])] = str_repeat('&nbsp;&nbsp;', $level) .
                '|-' . $item->addendum['name'];

            if ($num != null && $item->$num) {
                $this->getDropdownList($item->$type[++$level], $_a, $level);
            }
        }

        --$level;
        return $_a;
    }

    /**
     *
     */
    public function afterFind()
    {
        $this->name = $this->addendum['name'];
        $this->description = $this->addendum['description'];
        $this->content = $this->addendum['content'];
    }

    /**
     *
     */
    public function afterSave()
    {
        $_POST['Food']['content'] = str_replace('/js/ueditor/php/', '', $_POST['Food']['content']);
        $_POST['Food']['content'] = str_replace('../../..', '', $_POST['Food']['content']);
        if ($this->addendum) {
            $this->addendum['attributes'] = $_POST['Food'];
            $this->addendum->save();
        } elseif ($model = new FoodAddendum) {
            $model['attributes'] = array('food_id' => $this['food_id'], 'language' => Yii::
                    app()->language);
            $model['attributes'] = $_POST['Food'];
            $model->save();
        }
    }

    /**
     * This function get all name from table
     */
    public function getAll()
    {
        $language = Yii::app()->language;
        $_a[] = '请选择';
        $sql = 'SELECT name, food_id FROM ' . FoodAddendum::model()->tableName() .
            ' WHERE language="' . $language . '"';
        $data = $this->commandBuilder->createSqlCommand($sql)->queryAll();
        foreach ($data as $item) {
            $_a[$item['food_id']] = $item['name'];
        }
        return $_a;
    }

    /**
     * @return CActiveDataProvider
     */
    public function getProvider($attributes = array(), $pageSize = 10, $order =
        'food_id DESC')
    {
        $criteria = new CDbCriteria;
        if ($attributes) {
            foreach ($attributes as $key => $value) {
                $criteria->addCondition('`t`.`' . $key . '` ="' . $value . '"');
            }
        }
        $criteria->order = $order;
        $dataProvider = new CActiveDataProvider('Food', array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => $pageSize, 'pageVar' => 'qpage'),
            ));
        return $dataProvider;
    }
    /**
     * @return 美食的城市ID   rick add  参数 美食ID
     */
    public function getDelicacyCityId($id)
    {

        $data = Yii::app()->db->createCommand()->select('f.city_id as city_id')->from('food f')->
            join('delicacy d', 'f.food_id=d.food_id')->where('delicacy_id=:id', array(':id' =>
                $id))->queryRow();

        return $data['city_id'];
    }

    /**
     * @return FOOD的城市ID   rick add  参数 美食ID
     */
    public function getFoodCityId($id)
    {
        $data = Yii::app()->db->createCommand()->select('city_id')->from('food')->where('food_id=:id',
            array(':id' => $id))->queryRow();
        
        return $data['city_id'];
    }


}
