<?php

/**
 * This is the model class for table "admin_group".
 *
 * The followings are the available columns in table 'admin_group':
 * @property int(10) unsigned $admin_group_id
 * @property varchar(45) $group_name
 * @property tinyint(3) unsigned $is_active
 * @property varchar(45) $kid_group
 *
 * The followings are the available model relations:
 * @property AlloAdminGroup[] $alloAdminGroups
 * @property mixed $alloAdminGroupCount
 * @property AlloGroupPage[] $alloGroupPages
 * @property mixed $alloGroupPageCount
 */
class AdminGroup extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('group_name', 'required'),
			array('is_active', 'numerical', 'integerOnly'=>true),
			array('group_name, kid_group', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('admin_group_id, group_name, is_active, kid_group', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.admin_group_id>10', $this->getTableAlias(true, false)));
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
			'alloAdminGroups' => array(self::HAS_MANY, 'AlloAdminGroup', 'admin_group_id'),
			'alloAdminGroupCount' => array(self::STAT, 'AlloAdminGroup', 'admin_group_id'),
			'alloGroupPages' => array(self::HAS_MANY, 'AlloGroupPage', 'admin_group_id'),
			'alloGroupPageCount' => array(self::STAT, 'AlloGroupPage', 'admin_group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'admin_group_id' => 'Admin Group ID',
			'group_name' => 'Group Name',
			'is_active' => 'Is Active',
			'kid_group' => 'Kid Group',
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

		$criteria->compare('admin_group_id',$this->admin_group_id,true);
		$criteria->compare('group_name',$this->group_name,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('kid_group',$this->kid_group,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public static function getKidGroup($str_group)
    {
        $group = array();
        $role = explode(',',$str_group);
        foreach($role as $id){
            if(!$id) continue;
            $model = AdminGroup::model()->findByPk($id);
            if($model) $group[] = $model->group_name;
        }
        return $group;
    }
}