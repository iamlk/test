<?php

/**
 * This is the model class for table "admin_provider".
 *
 * The followings are the available columns in table 'admin_provider':
 * @property int(10) unsigned $admin_id
 * @property int(10) unsigned $provider_id
 */
class AdminProvider extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdminProvider the static model class
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
		return 'admin_provider';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('admin_id, provider_id', 'required'),
			array('admin_id, provider_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('admin_id, provider_id', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.Array>10', $this->getTableAlias(true, false)));
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
			'admin_id' => 'Admin ID',
			'provider_id' => 'Provider ID',
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

		$criteria->compare('admin_id',$this->admin_id,true);
		$criteria->compare('provider_id',$this->provider_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}