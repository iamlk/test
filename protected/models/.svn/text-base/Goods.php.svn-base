<?php

/**
 *
 *
 *  @author Leo 2013
 * This is the model class for table "goods".
 *
 * The followings are the available columns in table 'goods':
 * @property int(10) unsigned $goods_id
 * @property varchar(20) $code
 * @property tinyint(4) $entity_type
 * @property decimal(10,2) $price
 * @property tinyint(4) $is_active
 * @property int(10) unsigned $customer_id
 * @property int(10) unsigned $create_time
 *
 * The followings are the available model relations:
 * @property Customer $customer
 * @property Property[] $properties
 * @property mixed $propertyCount
 */
class Goods extends BaseActiveRecord
{

    public static $goods_type = array(1 => 'product', 2 => 'property');
    public static $entity_name = array(1 => '短期行程', 2 => '度假公寓');
    // 短期行程类型
    const ENTITY_PRODUCT = 1;
    // 租房住房类型
    const ENTITY_PROPERTY = 2;

    const GOODS_CODE_PRRIX = 'PRODCUT_';
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('code, entity_type, price, is_active, customer_id, created', 'required'),
            array(
                'entity_type, is_active',
                'numerical',
                'integerOnly' => true),
            array(
                'code',
                'length',
                'max' => 20),
            array(
                'price',
                'numerical',
                'min' => 0,
                'max' => 999999.99,
                'numberPattern' => '/^([1-9]\d{1,7}|\d)(\.\d{1,2})?$/'),
            array(
                'price, customer_id, created',
                'length',
                'max' => 10),
            array('browse,deal,is_recommend,is_hidden,sort', 'safe'),
           
            array(
                'goods_id, code, entity_type, price, is_active, customer_id, created',
                'safe',
                'on' => 'search'),
            );
    }

    /**
     * @return array the query criteria.
     * public function defaultScope()
     * {
     * return array('condition' => sprintf('%s.goods_id>10', $this->getTableAlias(true, false)));
     * }
     */

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'customer' => array(
                self::BELONGS_TO,
                'Customer',
                'customer_id'),
            'properties' => array(
                self::HAS_MANY,
                'Property',
                'goods_id'),
            'propertyCount' => array(
                self::STAT,
                'Property',
                'goods_id'),
            'property' => array(
                self::HAS_ONE,
                'Property',
                'goods_id'),
            'products' => array(
                self::HAS_MANY,
                'Product',
                'goods_id'),
            'productCount' => array(
                self::STAT,
                'Product',
                'goods_id'),
            'product' => array(
                self::HAS_ONE,
                'Product',
                'goods_id'),
            'goodsOrderDetail' => array( // rick add
                self::HAS_MANY,
                'OrderDetail',
                'goods_id'),

            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $t = array(
            'goods_id' => 'Goods ID',
            'code' => 'Code',
            'entity_type' => 'Entity Type',
            'price' => 'Price',
            'is_active' => 'Is Active',
            'customer_id' => 'Customer ID',
            'created' => 'Created',
            'browse' => 'browse',
            'is_recommend' => 'is_recommend',
            'deal' => 'deal');
        foreach ($t as $k => $v)
            $t[$k] = Yii::t($this->tableName(), $v);
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

        $criteria = new CDbCriteria;

        $criteria->compare('goods_id', $this->goods_id, true);
        $criteria->compare('code', $this->code, true);
        $criteria->compare('entity_type', $this->entity_type);
        $criteria->compare('price', $this->price, true);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('customer_id', $this->customer_id, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('browse', $this->browse, true);
        $criteria->compare('deal', $this->deal, true);
        $criteria->compare('is_recommend', $this->is_recommend, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }


    //获取用户发布的所有住所RICK  add   2013/8/15
    public function getAllHouse($userid, $classly, $page)
    {

        $criteria = new CDbCriteria;
        $criteria->alias = 'property';
        $criteria->order = 'property.property_id desc';
        $criteria->with = array(
            'goods',
            'addendum',
            'propertyType');
        if ($classly != 'all') {
            $criteria->addCondition("goods.is_active = " . $classly);
        }

        $criteria->addCondition("goods.entity_type = 2");
        $criteria->addCondition("goods.customer_id = " . $userid);
        $criteria->addCondition("property.goods_id != 1");
        //$criteria->addCondition("property.goods_id != 1");
        $data = Property::model()->findAll($criteria);
        $dataProvider = new CArrayDataProvider($data, array('pagination' => array('pageSize' =>
                    $page), ));

        return $dataProvider;

    }


    //获取用户发布的所有短期行程RICK  add   2013/8/15
    public function getAllShortRun($userid, $classly, $page)
    {

        $criteria = new CDbCriteria;
        $criteria->alias = 'product';
        $criteria->order = 'product.product_id desc';
        $criteria->with = array('goods');
        if ($classly != 'all') {

            $criteria->addCondition("goods.is_active = " . $classly);
        }

        $criteria->addCondition("goods.entity_type = 1");
        $criteria->addCondition("goods.customer_id = " . $userid);
        $criteria->addCondition("product.goods_id != 1");
        $data = Product::model()->findAll($criteria);
        $dataProvider = new CArrayDataProvider($data, array('pagination' => array('pageSize' =>
                    $page), ));

        return $dataProvider;

    }

    /**
     *  rick add   获取卖家对买家评论的单条回复
     */
    public function getSellerHF($id, $type)
    {
        switch ($type) {

            case Dynamic::PRODUCT:
                $data = Yii::app()->db->createCommand()->select('description')->from('product_review')->
                    where('parent_review_id=:id', array(':id' => $id))->queryRow();break;
            case Dynamic::PROPERTY:
                $data = Yii::app()->db->createCommand()->select('description')->from('property_review')->
                    where('parent_review_id=:id', array(':id' => $id))->queryRow();  break ;     


        }

        return $data['description'];

    }


}
