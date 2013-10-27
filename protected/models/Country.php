<?php
/**
 * 国家.主表
 */
class Country extends BaseActiveRecord
{
    public $name;
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('continent_id, is_active', 'required'),
            array(
                'continent_id, is_active',
                'numerical',
                'integerOnly' => true),
            array('code','safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'country_id, continent_id, is_active',
                'safe',
                'on' => 'search'),
            );
    }

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.country_id>10', $this->getTableAlias(true, false)));
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'countryAddendums' => array(
                self::HAS_MANY,
                'CountryAddendum',
                'country_id'),
            'countryAddendum' => array(
                self::HAS_ONE,
                'CountryAddendum',
                'country_id'),
            'countryAddendumLocal' => array(
                self::HAS_ONE,
                'CountryAddendum',
                'country_id',
                'scopes' => 'local'), // by zyme
            'addendum' => array(
                self::HAS_ONE,
                'CountryAddendum',
                'country_id',
                'condition' => 'language="'.Yii::app()->language.'"'),
            'state' => array(
                self::HAS_MANY,
                'State',
                'country_id'),
            'attraction' => array(
                self::HAS_MANY,
                'Attraction',
                'parent_id',
                'condition' => 'parent_type=1'),
            'continent' => array(
                self::BELONGS_TO,
                'Continent',
                'continent_id'),
            'propertys' => array(
                self::HAS_MANY,
                'Property',
                'country_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'country_id' => 'Country',
            'continent_id' => 'Continent',
            'is_active' => 'Is active',
            'code' => 'Code',
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

        $criteria->compare('country_id', $this->country_id, true);
        $criteria->compare('continent_id', $this->continent_id);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('code', $this->code);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }

    /**
     * 返回国家信息
     */
    public function searchCountry($params = array('local' => true))
    {
        // f
        $criteria = new CDbCriteria;
        $criteria->alias = 'country';
        $criteria->addCondition('country.is_active = 1');
        $criteria->with = array('countryAddendums' => ((isset($params['local']) and !$params['local'])?array():array('scopes' => 'local')));
        if ($params['continent_id']) $criteria->addCondition(sprintf("`country`.continent_id='%u'", $params['continent_id']));
        if ($params['country_id']) $criteria->addInCondition('`country`.country_id', explode(',', $params['country_id']));
        if ($params['name']) $criteria->addSearchCondition('`countryAddendums`.name', $params['name']);
        $model = Country::model()->findAll($criteria);
        // r
        $arr = array();
        foreach ($model as $country)
        {
            foreach ($country->countryAddendums as $countryAddendum)
            {
                $arr[] = array_merge($country->getAttributes(array('country_id', 'continent_id')), $countryAddendum->getAttributes(array('name')));
            }
        }
        return $arr;
    }


    public function afterFind()
    {
        $this->name = $this->addendum['name'];
    }

    public function afterSave()
    {
        if ($this->addendum)
        {
            $this->addendum['attributes'] = $_POST['Country'];
            $this->addendum->save();
        }
        elseif ($model = new CountryAddendum)
        {
            $model['attributes'] = array('country_id' => $this['country_id'], 'language' => Yii::app()->language);
            $model['attributes'] = $_POST['Country'];
            $model->save();
        }
    }

    public function afterDelete()
    {
        CountryAddendum::model()->deleteByPk($this->addendum['_id']);
    }

    /**
     * This function get all name from table
     */
    public function getAll($id, $is_null=false)
    {
        $_a[] = '请选择';

        if($is_null)return $_a;

        if(!$id)
        {
            $sql = 'SELECT name, country_id FROM '.CountryAddendum::model()->tableName().' WHERE language="'.Yii::app()->language.'"';
            $data = $this->commandBuilder->createSqlCommand($sql)->queryAll();
        }else{
            $data = Country::model()->findAll('continent_id=:continentID', array(':continentID'=>$id));
        }
        foreach ($data as $item)
        {
            $_a[$item['country_id']] = $item['name'];
        }
        return $_a;
    }

    //Fedora
    public static function getCountryName($country_id)
    {
        $data = CountryAddendum::model()->find('country_id='.intval($country_id).' AND language="'.Yii::app()->language.'"');
        return $data->name;
    }

    public function getPopWindow()
    {
        $countries = Country::model()->findAll(array('select'=>'country_id','condition'=>'is_active=1'));
        $data = array();
        foreach($countries as $c)
        {
            $tmp = array();
            $tmp['id'] = $c->country_id;
            $tmp['name'] = $c->countryAddendumLocal->name;
            $temp_list = array();
            foreach($c->state as $sate)
            {
                //if(!$state->is_active) continue;
                foreach($sate->city as $city)
                {
                    if(!$city->is_active) continue;
                    $temp_list[$city->city_id] = $city->cityAddendumLocal->name;
                }
            }
            $tmp['list'] = $temp_list;
            $data[] = $tmp;
        }
        return $data;
    }
    
    
}
