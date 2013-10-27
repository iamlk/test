<?php

/**
 * This is the model class for table "product_attraction".
 *
 * The followings are the available columns in table 'product_attraction':
 * @property int(10) unsigned $_id
 * @property int(10) unsigned $attraction_id
 * @property int(10) unsigned $product_id
 *
 * The followings are the available model relations:
 * @property Product $product
 */
class ProductAttraction extends BaseActiveRecord
{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_attraction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('attraction_id, product_id', 'required'),
			array('attraction_id, product_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('_id, attraction_id, product_id', 'safe', 'on'=>'search'),
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
             'attraction' => array(self::BELONGS_TO, 'Attraction', 'attraction_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$a =  array(
			'_id' => 'ID',
			'attraction_id' => '沿途景点',
			'product_id' => '产品编号',
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
		$criteria->compare('attraction_id',$this->attraction_id,true);
		$criteria->compare('product_id',$this->product_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}