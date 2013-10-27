<?php

/**
 * This is the model class for table "site_option".
 *
 * The followings are the available columns in table 'site_option':
 * @property string $site_option_id
 * @property string $option_key
 * @property string $option_value
 * @property string $title
 * @property string $site_option_group_id
 * @property integer $is_active
 */
class SiteOption extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SiteOption the static model class
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
		return 'site_option';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('option_key, option_value, title, site_option_group_id', 'required'),
			array('is_active', 'numerical', 'integerOnly'=>true),
			array('option_key', 'length', 'max'=>45),
			array('title', 'length', 'max'=>250),
			array('site_option_group_id', 'length', 'max'=>10),
            array('is_code,php_code','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('site_option_id, option_key, option_value, title, site_option_group_id, is_active', 'safe', 'on'=>'search'),
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
			'optionGroup' => array(self::BELONGS_TO, 'SiteOptionGroup', 'site_option_group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'site_option_id' => 'Site Option',
			'option_key' => 'Option Key',
			'option_value' => 'Option Value',
			'title' => 'Title',
			'site_option_group_id' => 'Site Option Group',
			'is_active' => 'Is Active',
            'is_code'=>'is_code',
            'php_code'=>'php_code'
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

		$criteria->compare('site_option_id',$this->site_option_id,true);
		$criteria->compare('option_key',$this->option_key,true);
		$criteria->compare('option_value',$this->option_value,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('site_option_group_id',$this->site_option_group_id,true);
		$criteria->compare('is_active',$this->is_active);
        $criteria->compare('is_code',$this->is_code);
       	$criteria->compare('php_code',$this->php_code);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getTemplate()
    {
        return '{updateSiteOption} {deleteSiteOption}';
    }
    
    //Fedora
    public static function getValueByKey($key='',$ignore_active=false)
    {
        $value = SiteOption::model()->find('option_key="'.$key.'"');
        if($ignore_active) return $value->option_value;
        elseif($value->is_active) return $value->option_value;
        else return '';
    }
}