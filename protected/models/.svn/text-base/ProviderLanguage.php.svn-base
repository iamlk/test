<?php

/**
 * This is the model class for table "provider_language".
 *
 * The followings are the available columns in table 'provider_language':
 * @property int(10) unsigned $provider_language_id
 * @property varchar(255) $name
 * @property int(11) $sort_order
 *
 * The followings are the available model relations:
 * @property Provider[] $providers
 * @property mixed $ProviderCount
 */
class ProviderLanguage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProviderLanguage the static model class
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
		return 'provider_language';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('sort_order', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('provider_language_id, name, sort_order', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.provider_language_id>10', $this->getTableAlias(true, false)));
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'providers' => array(self::HAS_MANY, 'Provider', 'provider_language_id'),
			'ProviderCount' => array(self::STAT, 'Provider', 'provider_language_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'provider_language_id' => 'Provider Language ID',
			'name' => 'Name',
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

		$criteria->compare('provider_language_id',$this->provider_language_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sort_order',$this->sort_order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getProviderLanguageList() {
           $model = ProviderLanguage::model()->findAll();
           $res_agency_operate_lang_id = $model;
                        foreach($res_agency_operate_lang_id as $row_agency_operate_lang_id){
                                $arr_agency_operate_lang_id[$row_agency_operate_lang_id['provider_language_id']] = $row_agency_operate_lang_id['name'];
                        }
           return $arr_agency_operate_lang_id;
   }

   public function getProviderLanguage($provider_language_id) {
           $model = ProviderLanguage::model()->find('provider_language_id=:provider_language_id', array(':provider_language_id'=>$provider_language_id));
           return $model['name'];
   }
}