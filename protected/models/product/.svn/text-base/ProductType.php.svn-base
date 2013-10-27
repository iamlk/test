<?php

/**
 * This is the model class for table "product_type".
 *
 * The followings are the available columns in table 'product_type':
 * @property int(10) unsigned $product_type_id
 *
 * The followings are the available model relations:
 * @property ProductOneDay[] $productOneDays
 * @property mixed $productOneDayCount
 * @property Product $productType
 */
class ProductType extends BaseActiveRecord
{

    public static function getTypes($id = null)
    {
        $a = array();
        foreach (ProductType::model()->with('productTypeAddendumLocal')->findAll() as $row)
        {
            if($row->productTypeAddendumLocal->type_name)
            {
                $a[$row->product_type_id] = $row->productTypeAddendumLocal->type_name;
            }

        }
        return $id?$a[$id]:$a;
    }
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('product_type_id', 'safe', 'on'=>'search'),
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
        return array('condition' => sprintf('%s.product_type_id>0', $this->getTableAlias(true, false)));
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'productTypeAddendums' => array(self::HAS_MANY, 'ProductTypeAddendum', 'product_type_id'),
            'productTypeAddendumLocal' => array(self::HAS_ONE, 'ProductTypeAddendum', 'product_type_id',"scopes"=>"local"),
			'productType' => array(self::BELONGS_TO, 'Product', 'product_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'product_type_id' => '类型编号',
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

		$criteria->compare('product_type_id',$this->product_type_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}