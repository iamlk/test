<?php
/**
 * 房子政策.主表
 * @author zyme
 *
 * The followings are the available columns in table 'property_policy':
 * @property smallint(4) unsigned $property_policy_id
 *
 * The followings are the available model relations:
 * @property array $propertys
 */
class PropertyPolicy extends BaseActiveRecord
{

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.property_policy_id>10', $this->getTableAlias(true, false)));
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
                'property_policy_id'),
            'propertyCount' => array(
                self::STAT,
                'Property',
                'property_policy_id'),
            'propertyPolicyAddendums' => array(
                self::HAS_MANY,
                'PropertyPolicyAddendum',
                'property_policy_id'),
            'propertyPolicyAddendumCount' => array(
                self::STAT,
                'PropertyPolicyAddendum',
                'property_policy_id'),
            );
    }

}
