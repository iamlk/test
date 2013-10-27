<?php

/**
 * This is the model class for table "album_image".
 *
 * The followings are the available columns in table 'album_image':
 * @property int(10) unsigned $album_image_id
 * @property varchar(200) $img_path
 * @property varchar(300) $img_depict
 * @property int(10) $created
 * @property int(10) $updated
 * @property int(10) unsigned $album_id
 * @property int(10) unsigned $staus
 * @property varchar(300) $opinion
 *
 * The followings are the available model relations:
 * @property Album $album
 */
class AlbumImage extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('img_path, img_depict, created, updated, album_id, staus, opinion', 'required'),
			array('created, updated', 'numerical', 'integerOnly'=>true),
			array('img_path', 'length', 'max'=>200),
			array('img_depict, opinion', 'length', 'max'=>300),
			array('album_id, staus', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('album_image_id, img_path, img_depict, created, updated, album_id, staus, opinion', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.album_image_id>10', $this->getTableAlias(true, false)));
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
			'album' => array(self::BELONGS_TO, 'Album', 'album_id'),
            'review'=>array(self::HAS_MANY, 'AlbumReview', 'album_image_id'),
            'reviewOne'=>array(self::HAS_ONE, 'AlbumReview', 'album_image_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'album_image_id' => 'Album Image ID',
			'img_path' => 'Img Path',
			'img_depict' => 'Img Depict',
			'created' => 'Created',
			'updated' => 'Updated',
			'album_id' => 'Album ID',
			'staus' => 'Staus',
			'opinion' => 'Opinion',
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

		$criteria->compare('album_image_id',$this->album_image_id,true);
		$criteria->compare('img_path',$this->img_path,true);
		$criteria->compare('img_depict',$this->img_depict,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);
		$criteria->compare('album_id',$this->album_id,true);
		$criteria->compare('staus',$this->staus,true);
		$criteria->compare('opinion',$this->opinion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}