<?php

/**
 * This is the model class for table "admin_group_page_cell".
 *
 * The followings are the available columns in table 'admin_group_page_cell':
 * @property int(10) unsigned $_id
 * @property varchar(45) $class_name
 * @property varchar(45) $class
 * @property int(10) unsigned $admin_group_page_id
 *
 * The followings are the available model relations:
 * @property AdminGroupPage $adminGroupPage
 * @property AlloPageCell[] $alloPageCells
 * @property mixed $alloPageCellCount
 */
class AdminGroupPageCell extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('class_name, class, admin_group_page_id', 'required'),
			array('class_name, class', 'length', 'max'=>45),
			array('admin_group_page_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('_id, class_name, class, admin_group_page_id', 'safe', 'on'=>'search'),
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
			'alloPageCells' => array(self::HAS_MANY, 'AlloPageCell', 'admin_group_page_cell_id'),
			'alloPageCellCount' => array(self::STAT, 'AlloPageCell', 'admin_group_page_cell_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'_id' => 'ID',
			'class_name' => 'Cell Name',
			'class' => 'Class',
			'admin_group_page_id' => 'Admin Group Page ID',
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
		$criteria->compare('class_name',$this->class_name,true);
		$criteria->compare('class',$this->class,true);
		$criteria->compare('admin_group_page_id',$this->admin_group_page_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}