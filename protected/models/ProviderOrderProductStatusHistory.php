<?php

/**
 * This is the model class for table "provider_order_product_status_history".
 *
 * The followings are the available columns in table 'provider_order_product_status_history':
 * @property int(10) unsigned $provider_order_product_status_history_id
 * @property text $comment
 * @property timestamp $last_updated
 * @property tinyint(1) $for
 * @property varchar(50) $updated_by
 * @property tinyint(1) $notify_tours4fun
 * @property int(10) unsigned $provider_order_product_status_id
 * @property int(10) unsigned $order_product_id
 *
 * The followings are the available model relations:
 * @property ProviderOrderProductStatus $providerOrderProductStatus
 */
class ProviderOrderProductStatusHistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProviderOrderProductStatusHistory the static model class
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
		return 'provider_order_product_status_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comment, last_updated, updated_by, provider_order_product_status_id, order_product_id', 'required'),
			array('for, notify_tours4fun', 'numerical', 'integerOnly'=>true),
			array('updated_by', 'length', 'max'=>50),
			array('provider_order_product_status_id, order_product_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('provider_order_product_status_history_id, comment, last_updated, for, updated_by, notify_tours4fun, provider_order_product_status_id, order_product_id', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.provider_order_product_status_history_id>10', $this->getTableAlias(true, false)));
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'providerOrderProductStatus' => array(self::BELONGS_TO, 'ProviderOrderProductStatus', 'provider_order_product_status_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'provider_order_product_status_history_id' => 'Provider Order Product Status History ID',
			'comment' => 'Comment',
			'last_updated' => 'Last Updated',
			'for' => 'For',
			'updated_by' => 'Updated By',
			'notify_tours4fun' => 'Notify Tours4fun',
			'provider_order_product_status_id' => 'Provider Order Product Status ID',
			'order_product_id' => 'Order Product ID',
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

		$criteria->compare('provider_order_product_status_history_id',$this->provider_order_product_status_history_id,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('last_updated',$this->last_updated,true);
		$criteria->compare('for',$this->for);
		$criteria->compare('updated_by',$this->updated_by,true);
		$criteria->compare('notify_tours4fun',$this->notify_tours4fun);
		$criteria->compare('provider_order_product_status_id',$this->provider_order_product_status_id,true);
		$criteria->compare('order_product_id',$this->order_product_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}