<?php
/**
 * 房子便利设施.主表
 * @note 房子便利设施，可以选择多个。
 * @author zyme
 *
 * The followings are the available columns in table 'property_amenity':
 * @property smallint(4) unsigned $property_amenity_id
 *
 * The followings are the available model relations:
 * @property array $propertyAmenityAddendums
 * @property int $propertyAmenityAddendumCount
 */
class PropertyAmenity extends BaseActiveRecord
{

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.property_amenity_id>10', $this->getTableAlias(true, false)));
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'propertyAmenityAddendums' => array(
                self::HAS_MANY,
                'PropertyAmenityAddendum',
                'property_amenity_id'),
            'propertyAmenityAddendumCount' => array(
                self::STAT,
                'propertyAmenityAddendum',
                'property_amenity_id'),
            );
    }

    /**
     * 返回所有可用的数据数组，优先使用：母语+英语+汉语
     */
    public function getPropertyAmenities()
    {
        // 优选SQL语句，注意本SQL语句，因效率问题，只适用于小数据集
        $arr = array_values(array_unique(array(Yii::app()->language,'en_us','zh_cn')));
        $str = "(CASE `language` WHEN '%s' THEN %s ELSE %s END)";
        foreach ($arr as $k=>$v) $sql_sub = sprintf($str,$v,$k+1,$sql_sub?:999);
        $sql = sprintf(" SELECT * FROM (SELECT *,%s AS _sx FROM %s ORDER BY _sx ASC) AS t GROUP BY t.%s ",$sql_sub,'property_amenity_addendum','property_amenity_id');
        // 查询结果
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

}
