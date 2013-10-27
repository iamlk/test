<?php

/**
 * This is the model class for table "system_translation".
 *
 * The followings are the available columns in table 'system_translation':
 * @property int(10) unsigned $system_translation_id
 * @property int(10) unsigned $system_source_id
 * @property varchar(30) $language
 * @property text $message
 *
 * The followings are the available model relations:
 * @property SystemSource $systemSource
 */
class SystemTranslation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SystemTranslation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'system_translation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('system_source_id, language, message', 'required'),
			array('system_source_id', 'length', 'max'=>10),
			array('language', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('system_translation_id, system_source_id, language, message', 'safe', 'on'=>'search'),
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
			'systemSource' => array(self::BELONGS_TO, 'SystemSource', 'system_source_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'system_translation_id' => 'System Translation ID',
			'system_source_id' => 'System Source ID',
			'language' => 'Language',
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

		$criteria=new CDbCriteria;

		$criteria->compare('system_translation_id',$this->system_translation_id,true);
		$criteria->compare('system_source_id',$this->system_source_id,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('message',$this->message,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}