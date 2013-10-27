<?php

/**
 * This is the model class for table "delicacy_addendum".
 *
 * The followings are the available columns in table 'delicacy_addendum':
 * @property string $delicacy_addendum_id
 * @property string $delicacy_id
 * @property string $title
 * @property string $content
 * @property string $language
 */
class DelicacyAddendum extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DelicacyAddendum the static model class
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
		return 'delicacy_addendum';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('delicacy_id, title, content, language', 'required'),
			array('delicacy_id', 'length', 'max'=>10),
			array('title', 'length', 'max'=>255),
			array('language', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('delicacy_addendum_id, delicacy_id, title, content, language', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'delicacy_addendum_id' => 'Delicacy Addendum',
			'delicacy_id' => 'Delicacy',
			'title' => 'Title',
			'content' => 'Content',
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

		$criteria=new CDbCriteria;

		$criteria->compare('delicacy_addendum_id',$this->delicacy_addendum_id,true);
		$criteria->compare('delicacy_id',$this->delicacy_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('language',$this->language,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}