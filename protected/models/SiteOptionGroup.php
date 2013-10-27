<?php

/**
 * This is the model class for table "site_option_group".
 *
 * The followings are the available columns in table 'site_option_group':
 * @property int(10) unsigned $site_option_group_id
 * @property varchar(200) $title
 * @property int(10) unsigned $created
 * @property int(10) unsigned $parent_group_id
 * @property tinyint(3) unsigned $is_active
 *
 * The followings are the available model relations:
 * @property SiteOption[] $siteOptions
 * @property mixed $siteOptionCount
 * @property SiteOptionGroup $parentGroup
 * @property SiteOptionGroup[] $siteOptionGroups
 * @property mixed $siteOptionGroupCount
 */
class SiteOptionGroup extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, created, parent_group_id', 'required'),
			array('is_active', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>200),
			array('created, parent_group_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('site_option_group_id, title, created, parent_group_id, is_active', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.site_option_group_id>10', $this->getTableAlias(true, false)));
    }
     */

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'siteOptions' => array(self::HAS_MANY, 'SiteOption', 'site_option_group_id','condition' =>'siteOptions.is_active=1'),
			'siteOptionCount' => array(self::STAT, 'SiteOption', 'site_option_group_id'),
			'parentGroup' => array(self::BELONGS_TO, 'SiteOptionGroup', 'parent_group_id'),
			'siteOptionGroups' => array(self::HAS_MANY, 'SiteOptionGroup', 'parent_group_id'),
			'siteOptionGroupCount' => array(self::STAT, 'SiteOptionGroup', 'parent_group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'site_option_group_id' => 'Site Option Group ID',
			'title' => 'Title',
			'created' => 'Created',
			'parent_group_id' => 'Parent Group ID',
			'is_active' => 'Is Active',
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

		$criteria->compare('site_option_group_id',$this->site_option_group_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('parent_group_id',$this->parent_group_id,true);
		$criteria->compare('is_active',$this->is_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getTemplate()
    {
        $templete = '{showSiteOptionGroup} {updateSiteOptionGroup} {deleteSiteOptionGroup}';
        return $templete;
    }

    public function beforeDelete()
    {
        SiteOption::model()->deleteAll(array('condition'=>'site_option_group_id=:site_option_group_id','params'=>array(':site_option_group_id'=>$this['site_option_group_id'])));
        $this->deleteAll(array('condition'=>'parent_group_id=:parent_group_id','params'=>array(':parent_group_id'=>$this['site_option_group_id'])));
    }
}