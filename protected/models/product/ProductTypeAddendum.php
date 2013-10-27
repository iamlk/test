<?php

/**
 * This is the model class for table "product_type_addendum".
 *
 * The followings are the available columns in table 'product_type_addendum':
 * @property int(10) unsigned $_id
 * @property int(10) unsigned $product_type_id
 * @property varchar(60) $type_name
 * @property varchar(20) $language
 */
class ProductTypeAddendum extends BaseActiveRecord
{



	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_type_id, type_name, language', 'required'),
			array('product_type_id', 'length', 'max'=>10),
			array('type_name', 'length', 'max'=>60),
			array('language', 'length', 'max'=>20),
            array(
                'product_type_id',
                'match',
                'pattern' => '/^[1-9]\d{0,8}$/'),
            array(
                'language',
                'in',
                'range' => Yii::app()->params['languages']),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('_id, product_type_id, type_name, language', 'safe', 'on'=>'search'),
		);
	}

     /**
     * @return array the query criteria.
     */
    public function scopes()
    {
        return array('local' => array('condition' => sprintf('%s.`language`=:language', $this->getTableAlias(true)), 'params' => array(':language' => Yii::app()->language)), );
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'_id' => 'ID',
			'product_type_id' => 'Product Type ID',
			'type_name' => '类型',
			'language' => '语言',
		);
        foreach ($t as $k => $v) $t[$k] = Yii::t($this->tableName(), $v);
        return $t;
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
		$criteria->compare('product_type_id',$this->product_type_id,true);
		$criteria->compare('type_name',$this->type_name,true);
		$criteria->compare('language',$this->language,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}