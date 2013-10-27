<?php

/**
 * This is the model class for table "attraction_addendum".
 *
 * The followings are the available columns in table 'attraction_addendum':
 * @property string $attraction_addendum_id
 * @property string $attraction_id
 * @property string $image
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $language
 */
class AttractionAddendum extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AttractionAddendum the static model class
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
		return 'attraction_addendum';
	}
      //È±Ê¡·¶Î§
    //Ãû×Ö¿Õ¼ä
    /**
     * @return array the query criteria.
     */
    public function scopes()
    {
        return array('local' => array('condition' => sprintf('%s.`language`=:language', $this->getTableAlias(true)), 'params' => array(':language' => Yii::app()->language)), );
    }


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('attraction_id, name, description, content, language', 'required'),
			array('attraction_id', 'length', 'max'=>10),
			array('name', 'length', 'max'=>250),
			array('language', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('attraction_addendum_id, attraction_id, name, description, content, language', 'safe', 'on'=>'search'),
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
        'attraction' => array(self::BELONGS_TO,'Attraction','attraction_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'attraction_addendum_id' => 'Attraction Addendum',
			'attraction_id' => 'Attraction',
			'name' => 'Name',
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

		$criteria->compare('attraction_addendum_id',$this->attraction_addendum_id,true);
		$criteria->compare('attraction_id',$this->attraction_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('language',$this->language,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}