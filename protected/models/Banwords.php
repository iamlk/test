<?php

/**
 * This is the model class for table "banwords".
 *
 * The followings are the available columns in table 'banwords':
 * @property int(10) unsigned $_id
 * @property char(32) $hash
 * @property tinyint(4) $type
 * @property varchar(50) $word
 * @property int(10) $rank
 * @property int(10) $is_active
 * @property int(10) $visited
 * @property int(10) $created
 */
class Banwords extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('word', 'required'),
			array('type, rank, is_active, visited, created', 'numerical', 'integerOnly'=>true),
			array('hash', 'length', 'max'=>32),
			array('word', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('_id, hash, type, word, rank, is_active, visited, created', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'_id' => 'ID',
			'hash' => 'Hash',
			'type' => '禁词类型',
			'word' => '禁用词',
			'rank' => '权重',
			'is_active' => '是否激活',
			'visited' => 'Visited',
			'created' => 'Created',
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
        $criteria->order = '_id desc';

		$criteria->compare('_id',$this->_id,true);
		$criteria->compare('hash',$this->hash,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('word',$this->word,true);
		$criteria->compare('rank',$this->rank);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('visited',$this->visited);
		$criteria->compare('created',$this->created);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
}