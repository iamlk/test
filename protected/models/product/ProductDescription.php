<?php
/**
 * This is the model class for table "product_description".
 *
 * The followings are the available columns in table 'product_description':
 * @property int(10) unsigned $product_description_id
 * @property varchar(64) $name
 * @property varchar(64) $description
 * @property varchar(64) $url_path
 * @property int(10) unsigned $product_id
 * @property varchar(20) $language
 *
 * The followings are the available model relations:
 * @property Product $product
 */
class ProductDescription extends BaseActiveRecord
{


    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'product_description';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('name, description, url_path, product_id, language', 'required'),
            array(
                'day',
                'safe'
               ),
            array(
                'name, url_path',
                'length',
                'max' => 64),
            array(
                'description',
                'length',
                'max' => 1000),
            array(
                'product_id',
                'length',
                'max' => 10),
            array(
                'language',
                'length',
                'max' => 20),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'product_description_id, name, description, url_path, product_id, language',
                'safe',
                'on' => 'search'),
            );
    }

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.product_description_id>0', $this->getTableAlias(true, false)));
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array('product' => array(
                self::BELONGS_TO,
                'Product',
                'product_id'), );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'product_description_id' => 'Product Description ID',
            'day' => 'Day',
            'name' => '行程概述',
            'description' => '行程详情',
            'url_path' => '行程图片',
            'product_id' => 'Product ID',
            'language' => '语言',
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

        $criteria = new CDbCriteria;

        $criteria->compare('product_description_id', $this->product_description_id, true);
        $criteria->compare('day', $this->day, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('url_path', $this->url_path, true);
        $criteria->compare('product_id', $this->product_id, true);
        $criteria->compare('language', $this->language, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }
    public function getDescList($product_id)
    { 
        $objs = ProductDescription::model()->findAllByAttributes(array('product_id'=>$product_id));
        if(is_null($objs))
        {
            return false;
        }
        $temp = array();
        foreach($objs as $v)
        {
            $temp[$v->product_description_id]['day'] = $v->day;
            $temp[$v->product_description_id]['name'] = $v->name;
            $temp[$v->product_description_id]['description'] = $v->description;
            $temp[$v->product_description_id]['url_path'] = $v->url_path;
            $temp[$v->product_description_id]['product_id'] = $v->product_id;
            $temp[$v->product_description_id]['language'] = $v->language;
        }
        return $temp;
    }
}
