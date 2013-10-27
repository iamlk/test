<?php
/**
 * 房子.副表
 * @author zyme
 *
 * This is the model class for table "property_addendum".
 *
 * The followings are the available columns in table 'property_addendum':
 * @property int(10) unsigned $_id
 * @property int(10) unsigned $property_id
 * @property varchar(20) $language
 * @property varchar(120) $title
 * @property text $description
 * @property varchar(60) $address
 * @property varchar(250) $direction
 * @property text $manual
 *
 * The followings are the available model relations:
 * @property Property $property
 */
class PropertyAddendum extends BaseActiveRecord
{

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('property_id, language, title, description, address', 'required'),
            array(
                'property_id',
                'match',
                'pattern' => '/^[1-9]\d{0,8}$/'),
            array('manual,other','safe'),    
            array(
                'language',
                'in',
                'range' => Yii::app()->params['languages']),
            array(
                'title',
                'length',
                'max' => 120),
            array(
                'address',
                'length',
                'max' => 60),
            array(
                'direction',
                'length',
                'max' => 250),
           /* array(
                'manual,other',
                'length',
                'min' => 50,
                'message'=>'最少50个字符'
                ),*/
                
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                '_id, property_id, language, title, description, address, direction, manual',
                'safe',
                'on' => 'search'),
            );
    }

    /**
     * @return array the query criteria.
     */
    public function scopes()
    {
        return array('local' => array('condition' => sprintf('%s.`language`=:language', $this->getTableAlias(true)), 'params' => array(':language' => Yii::app()->language)), );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array('property' => array(
                self::BELONGS_TO,
                'Property',
                'property_id'), );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $a = array(
            '_id' => 'Property Addendum ID',
            'property_id' => 'Property ID',
            'language' => '语言',
            'title' => '住所标题',
            'description' => '住所描述',
            'address' => '地址',
            'direction' => '路线说明',
            'manual' => '房屋守则',
            'other'=> '其他信息'
           
            );
        foreach ($a as $k => $v) $a[$k] = Yii::t($this->tableName(), $v);
        return $a;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('_id', $this->_id, true);
        $criteria->compare('property_id', $this->property_id, true);
        $criteria->compare('language', $this->language, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('direction', $this->direction, true);
        $criteria->compare('manual', $this->manual, true);
        $criteria->compare('other', $this->other, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }
            /**
     * @author rick
     * @return return  property  title
     */
     
    public function getPropertyTitle($product_id){
        
        $criteria = new CDbCriteria;
       // $criteria->order = "created desc";
        $criteria->condition = "property_id=" .$product_id ;
        $comment = $this::model()->find($criteria);
        
        return $comment->attributes['title'];
    } 
    

    
}
