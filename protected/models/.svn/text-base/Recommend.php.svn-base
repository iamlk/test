<?php

/**
 * This is the model class for table "recommend".
 *
 * The followings are the available columns in table 'recommend':
 * @property int(10) unsigned $recommend_id
 * @property varchar(300) $name
 * @property int(10) unsigned $parent_id
 * @property tinyint(1) $type
 * @property tinyint(1) $hot
 * @property tinyint(5) $order
 * @property varchar(10) $font_color
 * @property varchar(100) $path
 * @property tinyint(1) $is_active
 * @property int(10) $created
 * @property int(10) unsigned $updated
 */
class Recommend extends BaseActiveRecord
{

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, parent_id, is_active', 'required'),
            array(
                'type, hot, order, is_active, created',
                'numerical',
                'integerOnly' => true),
            array(
                'name',
                'length',
                'max' => 300),
            array(
                'parent_id, font_color, updated',
                'length',
                'max' => 10),
            array(
                'path',
                'length',
                'max' => 100),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'recommend_id, name, parent_id, type, hot, order, font_color, path, is_active, created, updated',
                'safe',
                'on' => 'search'),
            );
    }

    /**
     * @return array the query criteria.
     * public function defaultScope()
     * {
     * return array('condition' => sprintf('%s.recommend_id>10', $this->getTableAlias(true, false)));
     * }
     */

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $t = array(
            'recommend_id' => 'Recommend ID',
            'name' => 'Name',
            'parent_id' => 'Parent ID',
            'type' => 'Type',
            'hot' => 'Hot',
            'order' => 'Order',
            'font_color' => 'Font Color',
            'path' => 'Path',
            'is_active' => 'Is Active',
            'created' => 'Created',
            'updated' => 'Updated',
            );
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

        $criteria->compare('recommend_id', $this->recommend_id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('parent_id', $this->parent_id, true);
        $criteria->compare('type', $this->type);
        $criteria->compare('hot', $this->hot);
        $criteria->compare('order', $this->order);
        $criteria->compare('font_color', $this->font_color, true);
        $criteria->compare('path', $this->path, true);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('created', $this->created);
        $criteria->compare('updated', $this->updated, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }
    //获取name
    public function getName($id)
    {

        $data = Yii::app()->db->createCommand()->select('name')->from('recommend')->
            where('recommend_id=:id', array(':id' => $id))->queryRow();

        return $data['name'];
    }

    //获取parent_id
    public function getId($name)
    {

        $data = Yii::app()->db->createCommand()->select('parent_id')->from('recommend')->
            where('name=:name', array(':name' => $name))->queryRow();

        return $data['parent_id'];
    }

    //组织获取展示数据
    public function getRecomendData()
    {

        $data = Yii::app()->db->createCommand()->select('*')->from('recommend')->where('parent_id=:id and is_active=:aid',
            array(':id' => 0, ':aid' => 1))->order('order asc')->queryAll();


        return $data;
    }

    //组织获取展示数据
    public function getRecomendDataSub()
    {

        $data = Yii::app()->db->createCommand()->select('*')->from('recommend')->where('parent_id>:id and is_active=:aid',
            array(':id' => 0, ':aid' => 1))->order('order asc')->queryAll();

        return $data;
    }
    //获取字段
    public function getFiled($str)
    {

        switch ($str) {

            case 'CountryAddendum':
                return 'country_id';
                break;

            case 'StateAddendum':
                return 'state_id';
                break;

            case 'CityAddendum':
                return 'city_id';
                break;
        }

    }
    //检查同名
    public function checkName($parent_id, $name)
    {

        $data = Yii::app()->db->createCommand()->select('*')->from('recommend')->where('parent_id=:id and name=:name',
            array(':id' => $parent_id, ':name' => $name))->order('order asc')->queryAll();

        return count($data);
    }

    //同级排序是否被占用
    public function checkOrder($parent_id, $order)
    {

        $data = Yii::app()->db->createCommand()->select('*')->from('recommend')->where('parent_id=:id  and `order`=:order',
            array(':id' => $parent_id, ':order' => $order))->order('order asc')->queryAll();

        //var_DUMP($data);EXIT;
        return count($data);
    }
    //获取top_id
    public function getTopId($id)
    {

        $data = Yii::app()->db->createCommand()->select('top_id')->from('recommend')->
            where('recommend_id=:id', array(':id' => $id))->queryRow();

        return $data['top_id'];
    }

    //字段完全清理
    public function nameFilter($name)
    {

        $pattern = "/[<|>|\/|p|strong|span|a]/";
        $name = strip_tags($name);
        $name = preg_replace($pattern, '', $name);

        return trim($name);
    }

    //字段部分清理
    public function namePartFilter($name)
    {
      if(strstr($name,'p')){
        
         $pattern = "/<p>(.*?)<\/p>/";
        preg_match($pattern, $name, $arr);

        return $arr[1];
        
      }else{
        
         return $name;
      }
    }
    //检查NAME字段是否包含A标签
    public function checkNameHaveA($name){
        
        if(strstr($name,'</a>')){
            
            return 1 ;
        }else{
            
            return 0;
        }
    }

      
}
