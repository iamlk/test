<?php
/**
 * This is the model class for table "continent".
 *
 * The followings are the available columns in table 'continent':
 * @property integer $continent_id
 */
class Continent extends CActiveRecord
{
    public $name;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Continent the static model class
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
        return 'continent';
    }

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.continent_id>10', $this->getTableAlias(true, false)));
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array( // The following rule is used by search().
                // Please remove those attributes that should not be searched.
            array('name', 'required'),
            array(
                'continent_id',
                'safe',
                'on' => 'search'), );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'contirentAddendums' => array(
                self::HAS_MANY,
                'contirentAddendum',
                'contirent_id'),
            'addendum' => array(
                self::HAS_ONE,
                'ContinentAddendum',
                'continent_id',
                'condition' => 'addendum.language="'.Yii::app()->language.'"'),
            'country' => array(
                self::HAS_MANY,
                'Country',
                'continent_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array('continent_id' => 'Continent', );
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

        $criteria->compare('continent_id', $this->continent_id);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }

    public function afterFind()
    {
        $this->name = $this->addendum['name'];
    }

    public function afterSave()
    {
        if($this->addendum){
            $this->addendum['attributes'] = $_POST['Continent'];
            $this->addendum->save();
        }
        elseif ($model = new ContinentAddendum)
        {
            $model['attributes'] = array('continent_id'=> $this['continent_id'], 'language' => Yii::app()->language);
            $model['attributes'] = $_POST['Continent'];
            $model->save();
        }
    }

    public function afterDelete()
    {
        ContinentAddendum::model()->deleteByPk($this->addendum['_id']);
    }

    /**
     * This function get all name from table
     */
    public function getAll()
    {
        $language = Yii::app()->language;
        $_a[] = '请选择';
        $sql = 'SELECT name, continent_id FROM '.ContinentAddendum::model()->tableName().' WHERE language="'.$language.'"';
        $data = $this->commandBuilder->createSqlCommand($sql)->queryAll();
        foreach ($data as $item)
        {
            $_a[$item['continent_id']] = $item['name'];
        }
        return $_a;
    }
}
