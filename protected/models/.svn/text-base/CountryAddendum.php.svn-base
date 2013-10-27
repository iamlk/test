<?php
/**
 * 国家.副表
 */
class CountryAddendum extends BaseActiveRecord
{

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('country_id, name, language', 'required'),
            array(
                'country_id',
                'length',
                'max' => 10),
            array(
                'name',
                'length',
                'max' => 60),
            array(
                'language',
                'length',
                'max' => 20),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                '_id, country_id, name, language',
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
        return array('local' => array('condition' => sprintf('%s.`language`=:language', $this->getTableAlias(true)), 'params' => array(':language' => Yii::app()->language)), );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            '_id' => 'ID',
            'country_id' => 'Country',
            'name' => 'Name',
            'language' => 'Language',
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
        $criteria->compare('country_id', $this->country_id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('language', $this->language, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }

}
