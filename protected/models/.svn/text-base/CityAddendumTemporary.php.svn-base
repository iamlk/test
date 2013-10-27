<?php

/**
 * This is the model class for table "city_addendum_temporary".
 *
 * The followings are the available columns in table 'city_addendum_temporary':
 * @property string $city_addendum_temporary_id
 * @property integer $city_id
 * @property integer $city_addendum_id
 * @property string $name
 * @property string $image
 * @property string $description
 * @property string $content
 * @property string $language
 */
class CityAddendumTemporary extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CityAddendumTemporary the static model class
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
		return 'city_addendum_temporary';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('city_id, city_addendum_id, name, image, description, content, language', 'required'),
			array('city_id, city_addendum_id', 'numerical', 'integerOnly'=>true),
			array('name, image', 'length', 'max'=>255),
			array('language', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('city_addendum_temporary_id, city_id, city_addendum_id, name, image, description, content, language', 'safe', 'on'=>'search'),
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
			'city_addendum_temporary_id' => 'City Addendum Temporary',
			'city_id' => 'City',
			'city_addendum_id' => 'City Addendum',
			'name' => 'Name',
			'image' => 'Image',
			'description' => 'Description',
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

		$criteria->compare('city_addendum_temporary_id',$this->city_addendum_temporary_id,true);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('city_addendum_id',$this->city_addendum_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('language',$this->language,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}