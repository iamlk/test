<?php

/**
 * This is the model class for table "article_city".
 *
 * The followings are the available columns in table 'article_city':
 * @property string $article_city_id
 * @property string $city_id
 * @property string $article_id
 */
class ArticleCity extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ArticleCity the static model class
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
		return 'article_city';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('article_city_id, city_id, article_id', 'required'),
			array('article_city_id, city_id, article_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('article_city_id, city_id, article_id', 'safe', 'on'=>'search'),
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
        'city'=>array(self::BELONGS_TO, 'City', 'city_id'),
        'article'=>array(self::BELONGS_TO, 'Article', 'article_id', 'on'=>'article.draft=0 AND article.is_delete=0'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'article_city_id' => 'Article City',
			'city_id' => 'City',
			'article_id' => 'Article',
		);
	}

    /**
     * @return CActiveDataProvider
     */
    public function getProvider($attributes=array(),$pageSize=10,$order='t.article_id DESC'){
        $condition = '';
        if($attributes){
            $condition = '1=1';
            foreach($attributes as $key=>$value){
                $condition .= ' AND '.$key.' ="'.$value.'"';
            }
        }
    	$dataProvider=new CActiveDataProvider('ArticleCity', array(
    			'criteria'=>array('condition'=>$condition,'order'=>$order,'with'=>array('article')),
                'pagination'=>array('pageSize'=>$pageSize,'pageVar'=>'qpage'),
    	));
    	return $dataProvider;
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

		$criteria->compare('article_city_id',$this->article_city_id,true);
		$criteria->compare('city_id',$this->city_id,true);
		$criteria->compare('article_id',$this->article_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}