<?php
/**
 * 省/洲
 * This is the model class for table "state".
 *
 * The followings are the available columns in table 'state':
 * @property string $state_id
 * @property string $country_id
 */
class State extends BaseActiveRecord
{
    public $name;

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.state_id>10', $this->getTableAlias(true, false)));
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('country_id, name', 'required'),
            array(
                'country_id',
                'length',
                'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('code','safe'),
            array(
                'state_id, country_id',
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
            'stateAddendumLocal' => array(
                self::HAS_ONE,
                'StateAddendum',
                'state_id',
                'scopes' => 'local'), // by zyme
            'stateAddendums' => array(
                self::HAS_MANY,
                'StateAddendum',
                'state_id'), // by zyme
            'addendum' => array(
                self::HAS_ONE,
                'StateAddendum',
                'state_id',
                'condition' => 'addendum.language="'.Yii::app()->language.'"'),
            'city' => array(
                self::HAS_MANY,
                'City',
                'state_id'),
            'attraction' => array(
                self::HAS_MANY,
                'Attraction',
                'parent_id',
                'condition' => 'attraction.parent_type=2'
                ),
            'country' => array(
                self::BELONGS_TO,
                'Country',
                'country_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'state_id' => 'State',
            'country_id' => 'Country',
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

        $criteria->compare('state_id', $this->state_id, true);
        $criteria->compare('country_id', $this->country_id, true);
         $criteria->compare('code', $this->code, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }

    public function afterFind()
    {
        $this->name = $this->addendum['name'];
    }

    public function afterSave()
    {
        if ($this->addendum)
        {
            $this->addendum['attributes'] = $_POST['State'];
            $this->addendum->save();
        }
        elseif ($model = new StateAddendum)
        {
            $model['attributes'] = array('state_id' => $this['state_id'], 'language' => Yii::app()->language);
            $model['attributes'] = $_POST['State'];
            $model->save();
        }
    }

    public function afterDelete()
    {
        StateAddendum::model()->deleteByPk($this->addendum['_id']);
    }

    /**
     * 返回省/地区/州信息
     */
    public function searchState($params = array('local' => true))
    {
        // f
        $criteria = new CDbCriteria;
        $criteria->alias = 'state';
        $criteria->with = array('stateAddendums' => ((isset($params['local']) and !$params['local'])?array():array('scopes' => 'local')));
        if ($params['country_id']) $criteria->addCondition(sprintf("`state`.country_id='%u'", $params['country_id']));
        if ($params['state_id']) $criteria->addInCondition('`state`.state_id', explode(',', $params['state_id']));
        if ($params['name']) $criteria->addSearchCondition('`stateAddendums`.name', $params['name']);
        $model = State::model()->findAll($criteria);
        // r
        $arr = array();
        foreach ($model as $state)
        {
            foreach ($state->stateAddendums as $stateAddendum)
            {
                $arr[] = array_merge($state->getAttributes(array('state_id', 'country_id')), $stateAddendum->getAttributes(array('name')));
            }
        }
        return $arr;
    }

    /**
     *
     */
    public function getDropdownList($obj, &$_a = array('|-TOP'), &$level = 1)
    {
        $type = array(
            '1' => 'continent',
            '2' => 'country',
            '3' => 'state');
        $index = $type[$level].'_id';
        $num = $type[$level + 1];

        foreach ($obj as $item)
        {
            $_a[strval($level.'-'.$item[$index])] = str_repeat('&nbsp;&nbsp;', $level).'|-'.$item->addendum['name'];

            if ($num != NULL && $item->$num)
            {
                $this->getDropdownList($item->$type[++$level], $_a, $level);
            }
        }

        --$level;
        return $_a;
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
            $sql = 'SELECT name, state_id FROM '.StateAddendum::model()->tableName().' WHERE language="'.Yii::app()->language.'"';
            $data = $this->commandBuilder->createSqlCommand($sql)->queryAll();
        }else{
            $data = State::model()->findAll('country_id=:countryID', array(':countryID'=>$id));
        }
        foreach ($data as $item)
        {
            $_a[$item['state_id']] = $item['name'];
        }
        return $_a;
    }
}
