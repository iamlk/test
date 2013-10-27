<?php
/**
 * @author darren
 * $this->Widget('application.widgets.RecommendationPropertyWidget')
 */
class RecommendationPropertyWidget extends CWidget{
    public $model = null;
    public $page_num = 3;
    public $city_id; 

    public function init()
    {
        //先找推荐城市下面的 
        $objs = array();
        $city = intval($this->city_id);
        if($city)
        {
            $criteria = new CDbCriteria;
            $criteria->alias = 'goods';
            $criteria->order = 'goods.goods_id desc';
            $criteria->addCondition('goods.goods_id !=1');
            $criteria->addCondition('goods.is_active =1');
            $criteria->addCondition('goods.entity_type =1');
            $criteria->addCondition('goods.is_recommend =1');
            $criteria->limit = $this->page_num;
            $criteria->order = 'sort desc';
            $criteria->with = array('property');
            $criteria->addCondition('property.city_id='.$city);
            $objs = Goods::model()->findAll($criteria); 
        }
        if(empty($objs))
        {
            $objs = Goods::model()->findAll(array('condition'=>'is_active=1 AND entity_type=2 and is_recommend=1','order'=>'browse DESC','limit'=>$this->page_num));
        }
         if(empty($objs))
        {
            $objs = Goods::model()->findAll(array('condition'=>'is_active=1 AND entity_type=2','order'=>'browse DESC','limit'=>$this->page_num));
        }
        $this->model = $objs;
    }

    public function run(){
        $this->render('recommendation_property', array('model'=>$this->model));
    }
}