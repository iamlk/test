<?php
/**
 * This is the model class for table "system_source".
 *
 * The followings are the available columns in table 'system_source':
 * @property int(10) unsigned $system_source_id
 * @property varchar(30) $category
 * @property text $message
 *
 * The followings are the available model relations:
 * @property SystemTranslation[] $systemTranslations
 */
class SystemSource extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SystemSource the static model class
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
        return 'system_source';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category, message', 'required'),
            array(
                'category',
                'length',
                'max' => 30),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'system_source_id, category, message',
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
            'systemTranslations' => array(
                self::HAS_MANY,
                'SystemTranslation',
                'system_source_id'),
            'systemTranslationCount' => array(
                self::STAT,
                'SystemTranslation',
                'system_source_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'system_source_id' => 'System Source ID',
            'category' => 'Category',
            'message' => 'Message',
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

        $criteria->compare('system_source_id', $this->system_source_id, true);
        $criteria->compare('category', $this->category, true);
        $criteria->compare('message', $this->message, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }
}
