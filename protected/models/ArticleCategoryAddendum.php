<?php

/**
 * This is the model class for table "article_category_addendum".
 *
 * The followings are the available columns in table 'article_category_addendum':
 * @property integer $article_category_addendum_id
 * @property integer $article_category_id
 * @property string $category_name
 * @property integer $language_id
 */
class ArticleCategoryAddendum extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ArticleCategoryAddendum the static model class
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
		return 'article_category_addendum';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('article_category_id, category_name, language_id', 'required'),
			array('article_category_id, language_id', 'numerical', 'integerOnly'=>true),
			array('category_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('article_category_addendum_id, article_category_id, category_name, language_id', 'safe', 'on'=>'search'),
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
			'article_category_addendum_id' => 'Article Category Addendum',
			'article_category_id' => 'Article Category',
			'category_name' => 'Category Name',
			'language_id' => 'Language',
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

		$criteria->compare('article_category_addendum_id',$this->article_category_addendum_id);
		$criteria->compare('article_category_id',$this->article_category_id);
		$criteria->compare('category_name',$this->category_name,true);
		$criteria->compare('language_id',$this->language_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    public function getDropdownList()
    {
        $sql = "SELECT * FROM ".$this->tableName();
        $category = $this->commandBuilder->createSqlCommand($sql)->queryAll();
        foreach ($category as $item)
        {
            $data[$item['article_category_id']] = $item['category_name'];
        }
        return $data;
    }
}