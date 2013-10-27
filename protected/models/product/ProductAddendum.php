<?php

/**
 * This is the model class for table "product_addendum".
 *
 * The followings are the available columns in table 'product_addendum':
 * @property int(10) unsigned $_id
 * @property int(10) unsigned $product_id
 * @property varchar(125) $product_name
 * @property varchar(10) $language
 *
 * The followings are the available model relations:
 * @property Product $product
 */
class ProductAddendum extends BaseActiveRecord
{


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_addendum';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id,title,description,language', 'required'),
			array('product_id,language', 'length', 'max'=>10),
			array('title', 'length', 'max'=>125),
             array(
                'language',
                'in',
                'range' => Yii::app()->params['languages']),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('_id, product_id, title, language', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s._id>0', $this->getTableAlias(true, false)));
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		 $a =  array(
			'_id' => 'ID',
			'product_id' => '产品编号',
			'title' => '产品名字',
			'language' => '语言',
            'description' => '产品概述',
		);

        foreach ($a as $k => $v) $a[$k] = Yii::t($this->tableName(), $v);
        return $a;
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

		$criteria->compare('_id',$this->_id,true);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('title',$this->title,true);
 	    $criteria->compare('description',$this->description,true);
		$criteria->compare('language',$this->language,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
         /**
     * @author rick
     * @return return  product  title
     */
     
    public function getProductTitle($product_id){
        
        $criteria = new CDbCriteria;
       // $criteria->order = "created desc";
        $criteria->condition = "product_id=" .$product_id ;
        $comment = $this::model()->find($criteria);
        
        return $comment->attributes['title'];
    } 
    
}