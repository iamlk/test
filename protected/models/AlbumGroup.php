<?php

/**
 * This is the model class for table "album_group".
 *
 * The followings are the available columns in table 'album_group':
 * @property int(10) unsigned $album_group_id
 * @property varchar(250) $title
 * @property timestamp $updated
 * @property timestamp $created
 * @property int(10) unsigned $customer_id
 * @property tinyint(3) unsigned $is_display
 * @property varchar(250) $cover
 *
 * The followings are the available model relations:
 * @property Album[] $albums
 * @property mixed $albumCount
 * @property Customer $customer
 */
class AlbumGroup extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, updated, customer_id', 'required'),
			array('is_display', 'numerical', 'integerOnly'=>true),
			array('title, cover', 'length', 'max'=>250),
			array('customer_id', 'length', 'max'=>10),
			array('created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('album_group_id, title, updated, created, customer_id, is_display, cover', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.album_group_id>10', $this->getTableAlias(true, false)));
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'albums' => array(self::HAS_MANY, 'Album', 'album_group_id'),
			'albumCount' => array(self::STAT, 'Album', 'album_group_id'),
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'album_group_id' => 'Album Group ID',
			'title' => 'Title',
			'updated' => 'Updated',
			'created' => 'Created',
			'customer_id' => 'Customer ID',
			'is_display' => 'Is Display',
			'cover' => 'Cover',
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

		$criteria->compare('album_group_id',$this->album_group_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('is_display',$this->is_display);
		$criteria->compare('cover',$this->cover,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}