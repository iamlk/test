<?php

/**
 * This is the model class for table "article_addendum".
 *
 * The followings are the available columns in table 'article_addendum':
 * @property integer $article_addendum_id
 * @property integer $article_id
 * @property string $title
 * @property string $content
 * @property integer $language_id
 */
class ArticleAddendum extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ArticleAddendum the static model class
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
		return 'article_addendum';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('article_id, title, content', 'required'),
			array('article_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>250),
            array('language', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('article_addendum_id, article_id, title, content, language', 'safe', 'on'=>'search'),
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
			'article_addendum_id' => 'Article Addendum',
			'article_id' => 'Article',
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

		$criteria->compare('article_addendum_id',$this->article_addendum_id);
		$criteria->compare('article_id',$this->article_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('language',$this->language);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}