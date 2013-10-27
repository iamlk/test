<?php

/**
 * This is the model class for table "allo_group_menu".
 *
 * The followings are the available columns in table 'allo_group_menu':
 * @property int(10) unsigned $_id
 * @property smallint(5) unsigned $menu_id
 * @property varchar(45) $menu2_id
 * @property int(10) unsigned $admin_group_id
 *
 * The followings are the available model relations:
 * @property AdminGroup $adminGroup
 */
class AlloGroupMenu extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menu_id, admin_group_id', 'required'),
			array('menu_id', 'numerical', 'integerOnly'=>true),
			array('menu2_id', 'length', 'max'=>45),
			array('admin_group_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('_id, menu_id, menu2_id, admin_group_id', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
    public function defaultScope()
    {
        return array('condition' => sprintf('%s._id>10', $this->getTableAlias(true, false)));
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
			'adminGroup' => array(self::BELONGS_TO, 'AdminGroup', 'admin_group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'_id' => 'ID',
			'menu_id' => 'Menu ID',
			'menu2_id' => 'Menu2 ID',
			'admin_group_id' => 'Admin Group ID',
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
		$criteria->compare('menu_id',$this->menu_id);
		$criteria->compare('menu2_id',$this->menu2_id,true);
		$criteria->compare('admin_group_id',$this->admin_group_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}