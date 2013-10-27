<?php
/**
 * 房子类型.主表
 * @note 房子类型，只能选择一个。
 * @author zyme
 *
 * The followings are the available columns in table 'property_type':
 * @property smallint(4) unsigned $property_type_id
 *
 * The followings are the available model relations:
 * @property array $propertys
 */
class PropertyType extends BaseActiveRecord
{

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.property_type_id>10', $this->getTableAlias(true, false)));
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'propertys' => array(
                self::HAS_MANY,
                'Property',
                'property_type_id'),
            'propertyCount' => array(
                self::STAT,
                'Property',
                'property_type_id'),
            'propertyTypeAddendums' => array(
                self::HAS_MANY,
                'PropertyTypeAddendum',
                'property_type_id'),
            'propertyTypeAddendum' => array(
                self::HAS_ONE,
                'PropertyTypeAddendum',
                'property_type_id'),
            'propertyTypeAddendumLocal' => array(
                self::HAS_ONE,
                'PropertyTypeAddendum',
                'property_type_id',
                'scopes' => 'local'),
            'propertyTypeAddendumCount' => array(
                self::STAT,
                'PropertyTypeAddendum',
                'property_type_id'),
            );
    }

    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('property_type_id', $this->property_type_id, false);
        $criteria->compare('_id', $this->_id, true);
        $criteria->compare('language', $this->language, true);
        $criteria->compare('type', $this->type, true);
        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }

    /** 返回type的"键值对"一维数组 **/
    public function getPropertyTypes()
    {
        $arr = array();
        foreach (PropertyType::model()->with('propertyTypeAddendumLocal')->findAll() as $row) $arr[$row->property_type_id] = $row->propertyTypeAddendumLocal->type;
        return $arr;
    }

    /** 返回type的某id的值 **/
    public function getPropertyType($property_type_id)
    {
        $arr = $this->getPropertyTypes();
        return $arr[$property_type_id];
    }

}
