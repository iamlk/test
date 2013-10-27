<?php

/**
 * This is the model class for table "admin_group_page".
 *
 * The followings are the available columns in table 'admin_group_page':
 * @property int(10) unsigned $admin_group_page_id
 * @property varchar(45) $page_name
 * @property varchar(45) $page
 * @property smallint(5) unsigned $menu_id
 *
 * The followings are the available model relations:
 * @property AdminGroupPageCell[] $adminGroupPageCells
 * @property mixed $adminGroupPageCellCount
 * @property AlloGroupPage[] $alloGroupPages
 * @property mixed $alloGroupPageCount
 */
class AdminGroupPage extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('page_name, page', 'required'),
			array('menu_id', 'numerical', 'integerOnly'=>true),
			array('page_name, page', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('admin_group_page_id, page_name, page, menu_id', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.admin_group_page_id>10', $this->getTableAlias(true, false)));
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
			'adminGroupPageCells' => array(self::HAS_MANY, 'AdminGroupPageCell', 'admin_group_page_id'),
			'adminGroupPageCellCount' => array(self::STAT, 'AdminGroupPageCell', 'admin_group_page_id'),
			'alloGroupPages' => array(self::HAS_MANY, 'AlloGroupPage', 'admin_group_page_id'),
			'alloGroupPageCount' => array(self::STAT, 'AlloGroupPage', 'admin_group_page_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'admin_group_page_id' => 'Admin Group Page ID',
			'page_name' => 'Page Name',
			'page' => 'Page',
			'menu_id' => 'Menu ID',
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

		$criteria->compare('admin_group_page_id',$this->admin_group_page_id,true);
		$criteria->compare('page_name',$this->page_name,true);
		$criteria->compare('page',$this->page,true);
		$criteria->compare('menu_id',$this->menu_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    
    public function getPageName($id)
    {
        $model = $this->findByPk($id);
        return $model->page_name;
    }
}