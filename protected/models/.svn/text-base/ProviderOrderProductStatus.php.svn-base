<?php

/**
 * This is the model class for table "provider_order_product_status".
 *
 * The followings are the available columns in table 'provider_order_product_status':
 * @property int(10) unsigned $provider_order_product_status_id
 * @property varchar(100) $name
 * @property tinyint(1) $for
 * @property tinyint(1) $active
 * @property int(11) $sort_order
 *
 * The followings are the available model relations:
 * @property ProviderOrderProductStatusHistory[] $providerOrderProductStatusHistories
 * @property mixed $ProviderOrderProductStatusHistoryCount
 */
class ProviderOrderProductStatus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProviderOrderProductStatus the static model class
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
		return 'provider_order_product_status';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('for, active, sort_order', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('provider_order_product_status_id, name, for, active, sort_order', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.provider_order_product_status_id>10', $this->getTableAlias(true, false)));
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'providerOrderProductStatusHistories' => array(self::HAS_MANY, 'ProviderOrderProductStatusHistory', 'provider_order_product_status_id'),
			'ProviderOrderProductStatusHistoryCount' => array(self::STAT, 'ProviderOrderProductStatusHistory', 'provider_order_product_status_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'provider_order_product_status_id' => 'Provider Order Product Status ID',
			'name' => 'Name',
			'for' => 'For',
			'active' => 'Active',
			'sort_order' => 'Sort Order',
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

		$criteria->compare('provider_order_product_status_id',$this->provider_order_product_status_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('for',$this->for);
		$criteria->compare('active',$this->active);
		$criteria->compare('sort_order',$this->sort_order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}