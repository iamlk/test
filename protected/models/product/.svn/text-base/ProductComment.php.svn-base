<?php

/**
 * This is the model class for table "product_comment".
 *
 * The followings are the available columns in table 'product_comment':
 * @property int(10) unsigned $_id
 * @property int(10) $_parent_id
 * @property int(10) unsigned $product_id
 * @property varchar(100) $title
 * @property text $content
 * @property int(10) unsigned $rank
 * @property int(10) $business_id
 * @property varchar(20) $business_name
 * @property tinyint(1) $is_pass
 * @property int(10) $create_time
 * @property tinyint(1) $is_flag
 */
class ProductComment extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, title, content, business_id, business_name, is_pass, create_time', 'required'),
			array('_parent_id, business_id, is_pass, create_time, is_flag', 'numerical', 'integerOnly'=>true),
			array('product_id, rank', 'length', 'max'=>10),
			array('title', 'length', 'max'=>100),
			array('business_name', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('_id, _parent_id, product_id, title, content, rank, business_id, business_name, is_pass, create_time, is_flag', 'safe', 'on'=>'search'),
		);
	}
    /**
     * @return array the query criteria.
     */
    public function scopes()
    {
        return array(

            'replay' => array(
                'condition' => 'is_flag=1',
                'limit' => 5,
                'order' => '_id DESC',
                ),
            );
    }


    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s._id>0', $this->getTableAlias(true, false)));
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(	'post' => array(self::HAS_MANY, 'ProductComment', '_parent_id'),
        	'replays' => array(self::BELONGS_TO, 'ProductComment', '_parent_id',),
        	'replayCount' => array(self::STAT, 'ProductComment', '_parent_id',),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'_id' => 'ID',
			'_parent_id' => 'Parent ID',
			'product_id' => 'Product ID',
			'title' => 'Title',
			'content' => 'Content',
			'rank' => 'Rank',
			'business_id' => 'Business ID',
			'business_name' => 'Business Name',
			'is_pass' => 'Is Pass',
			'create_time' => 'Create Time',
			'is_flag' => 'Is Flag',
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

		$criteria->compare('_id',$this->_id,true);
		$criteria->compare('_parent_id',$this->_parent_id);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('rank',$this->rank,true);
		$criteria->compare('business_id',$this->business_id);
		$criteria->compare('business_name',$this->business_name,true);
		$criteria->compare('is_pass',$this->is_pass);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('is_flag',$this->is_flag);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}