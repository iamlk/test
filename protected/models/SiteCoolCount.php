<?php

/**
 * This is the model class for table "site_cool_count".
 *
 * The followings are the available columns in table 'site_cool_count':
 * @property int(10) unsigned $_id
 * @property varchar(45) $hash_key
 * @property int(10) unsigned $share
 * @property int(10) unsigned $favorite
 */
class SiteCoolCount extends BaseActiveRecord
{

    const TYPE_SHARE = 'share';
    const TYPE_FAVORITE = 'favorite';
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hash_key', 'required'),
			array('hash_key', 'length', 'max'=>45),
			array('share, favorite', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('_id, hash_key, share, favorite', 'safe', 'on'=>'search'),
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
			'hash_key' => 'Hash Key',
			'share' => 'Share',
			'favorite' => 'Favorite',
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
		$criteria->compare('hash_key',$this->hash_key,true);
		$criteria->compare('share',$this->share,true);
		$criteria->compare('favorite',$this->favorite,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public static function getShare($hash)
    {
        $model = SiteCoolCount::model()->find('hash_key="'.$hash.'"');
        return intval($model->share);
    }
    
    public static function getFavorite($hash)
    {
        $model = SiteCoolCount::model()->find('hash_key="'.$hash.'"');
        return intval($model->favorite);
    }
    
    public static function counter($hash,$type)
    {
        $model = SiteCoolCount::model()->find('hash_key="'.$hash.'"');
        if($model){
            $model->{$type}++;
            return $model->save();
        }else{
            $model = new SiteCoolCount;
            $model->hash_key = $hash;
            $model->share = 0;
            $model->favorite = 0;
            $model->{$type}++;
            return $model->save();
        }
    }
}