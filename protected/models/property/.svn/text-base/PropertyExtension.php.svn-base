<?php
/**
 * This is the model class for table "property_extension".
 *
 * The followings are the available columns in table 'property_extension':
 * @property int(10) unsigned $_id
 * @property int(10) unsigned $property_id
 * @property varchar(30) $type
 * @property varchar(250) $key
 * @property text $value
 *
 * The followings are the available model relations:
 * @property Property $property
 *
 * 扩展属性
 * @property array $types 可选择的"扩展属性类型"列表，详见:{@link PropertyExtension::getTypes()}
 */
class PropertyExtension extends BaseActiveRecord
{

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('property_id, type, key, value', 'required'),
            array(
                'property_id',
                'match',
                'pattern' => '/^[1-9]\d{0,8}$/'),
            array(
                'type',
                'in',
                'range' => $this->getTypes()),
            array(
                'key',
                'length',
                'max' => 250),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                '_id, property_id, type, key, value',
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

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            '_id' => 'ID',
            'property_id' => 'Property ID',
            'type' => 'Type',
            'key' => 'Key',
            'value' => 'Value',
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
        $criteria->compare('type', $this->type, true);
        $criteria->compare('key', $this->key, true);
        $criteria->compare('value', $this->value, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }

    /**
     * 保存指定的扩展数据，先删除本房子的扩展数据，再增加新的数据。
     * @param int $property_id 房子的ID号
     * @param array $extensions 扩展属性和值列表
     */
    public function saveExtensions($property_id, $extensions = array())
    {
        // 删除旧数据
        $this->deleteAllByAttributes(array('property_id' => (int)$property_id));
        // 增加新的数据
        foreach ($extensions as $row)
        {
            if (in_array($row['type'], $this->getTypes()) and $row['key'] != '' and $row['value'] != '')
            {
                $propertyExtension = new PropertyExtension;
                $propertyExtension->attributes = $row;
                $propertyExtension->property_id = $property_id;
                $propertyExtension->save();
            }
        }
        // 始终返回true值
        return true;
    }

    /**
     * 可选择的"扩展属性类型"列表，目前支持自定义(custom)和便利设施(amenity)和文本值(text)，值为:{@link PropertyExtension::types}
     */
    public static function getTypes()
    {
        return array('amenity', 'custom', 'text');
    }

}
