<?php

/**
 * This is the model class for table "product_note".
 *
 * The followings are the available columns in table 'product_note':
 * @property int(10) unsigned $_id
 * @property int(10) unsigned $product_id
 * @property text $remark
 * @property int(10) $max_per_day_num_for_adults
 * @property int(10) $max_per_day_num_for_kids
 * @property int(10) $min_age_for_kids
 * @property int(10) $max_hotle_booking
 * @property int(10) $max_room_for_adults
 * @property int(10) $max_room_for_kids
 * @property text $attention_rules
 *
 * The followings are the available model relations:
 * @property Product $product
 */
class ProductNote extends BaseActiveRecord
{


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_note';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, max_per_day_num_for_adults, max_per_day_num_for_kids, min_age_for_kids, max_hotle_booking, max_room_for_adults, max_room_for_kids,max_room_bed', 'required'),
			array('max_per_day_num_for_adults, max_per_day_num_for_kids, min_age_for_kids, max_hotle_booking, max_room_for_adults, max_room_for_kids,max_room_bed', 'numerical', 'integerOnly'=>true),
			array('product_id', 'length', 'max'=>10),
            array("remark,attention_rules",'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('_id, product_id, remark, max_per_day_num_for_adults, max_per_day_num_for_kids, min_age_for_kids, max_hotle_booking, max_room_for_adults, max_room_for_kids, attention_rules', 'safe', 'on'=>'search'),
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
		return array(
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'_id' => 'ID',
			'product_id' => 'Product ID',
			'remark' => '补充说明',
			'max_per_day_num_for_adults' => '每天参团成人上限',
			'max_per_day_num_for_kids' => '每天参团儿童上限',
			'min_age_for_kids' => '最小儿童年龄',
			'max_hotle_booking' => '酒店房间预订上限',
			'max_room_for_adults' => '每间入住人数上限',
			'max_room_for_kids' => '每间入住儿童上限',
			'attention_rules' => '注意事项',
            'max_room_bed'=>'每间房床位数'
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
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('max_per_day_num_for_adults',$this->max_per_day_num_for_adults);
		$criteria->compare('max_per_day_num_for_kids',$this->max_per_day_num_for_kids);
		$criteria->compare('min_age_for_kids',$this->min_age_for_kids);
		$criteria->compare('max_hotle_booking',$this->max_hotle_booking);
		$criteria->compare('max_room_for_adults',$this->max_room_for_adults);
		$criteria->compare('max_room_for_kids',$this->max_room_for_kids);
		$criteria->compare('attention_rules',$this->attention_rules,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}