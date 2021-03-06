<?php
/**
 * 房子类型.副表
 * @note 房子类型，只能选择一个。
 * @author zyme
 *
 * The followings are the available columns in table 'property_type_addendum':
 * @property int(10) unsigned $_id
 * @property smallint(4) unsigned $property_type_id
 * @property varchar(20) $language
 * @property varchar(30) $type
 *
 * The followings are the available model relations:
 * @property object $propertyType
 */
class PropertyTypeAddendum extends BaseActiveRecord
{

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('property_type_id, language, type', 'required'),
            array(
                'property_type_id',
                'match',
                'pattern' => '/^[1-9]\d{0,2}$/'),
            array(
                'language',
                'in',
                'range' => Yii::app()->params['languages']),
            array(
                'type',
                'length',
                'max' => 30),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                '_id, property_type_id, language, type',
                'safe',
                'on' => 'search'),
            );
    }

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s._id>10 AND %1$s.property_type_id>10', $this->getTableAlias(true, false)));
    }

    /**
     * @return array the query criteria.
     */
    public function scopes()
    {
        return array('local' => array('condition' => sprintf('%s.`language`=:language', $this->getTableAlias(true)), 'params' => array(':language' => Yii::app()->language)), );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array('propertyType' => array(
                self::BELONGS_TO,
                'PropertyType',
                'property_type_id'), );
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
        $criteria->compare('property_type_id', $this->property_type_id);
        $criteria->compare('language', $this->language, true);
        $criteria->compare('type', $this->type, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }
}
