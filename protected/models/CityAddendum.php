<?php

/**
 * This is the model class for table "city_addendum".
 *
 * The followings are the available columns in table 'city_addendum':
 * @property integer $city_addendum_id
 * @property integer $city_id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $language
 */
class CityAddendum extends BaseActiveRecord
{
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('city_id, name, description, content, language', 'required'),
			array('city_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>250),
			array('language', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('city_addendum_id, city_id, name, description, content, language', 'safe', 'on'=>'search'),
		);
	}

    //缺省范围
    //名字空间
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
		return array(
          'city'=> array(self::BELONGS_TO, 'City', 'city_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'city_addendum_id' => 'City Addendum',
			'city_id' => 'City',
			'name' => 'Name',
            'status' => 'Status',
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

		$criteria->compare('city_addendum_id',$this->city_addendum_id);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('language',$this->language,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}