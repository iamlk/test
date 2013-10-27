<?php

/**
 * This is the model class for table "allo_group_page".
 *
 * The followings are the available columns in table 'allo_group_page':
 * @property int(10) unsigned $_id
 * @property int(10) unsigned $admin_group_id
 * @property int(10) unsigned $admin_group_page_id
 * @property varchar(45) $admin_group_page_cell
 *
 * The followings are the available model relations:
 * @property AdminGroupPage $adminGroupPage
 * @property AdminGroup $adminGroup
 */
class AlloGroupPage extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('admin_group_id, admin_group_page_id', 'required'),
			array('admin_group_id, admin_group_page_id', 'length', 'max'=>10),
			array('admin_group_page_cell', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('_id, admin_group_id, admin_group_page_id, admin_group_page_cell', 'safe', 'on'=>'search'),
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
			'adminGroupPage' => array(self::BELONGS_TO, 'AdminGroupPage', 'admin_group_page_id'),
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
			'admin_group_id' => 'Admin Group ID',
			'admin_group_page_id' => 'Admin Group Page ID',
			'admin_group_page_cell' => 'Admin Group Page Cell',
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
		$criteria->compare('admin_group_id',$this->admin_group_id,true);
		$criteria->compare('admin_group_page_id',$this->admin_group_page_id,true);
		$criteria->compare('admin_group_page_cell',$this->admin_group_page_cell,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}