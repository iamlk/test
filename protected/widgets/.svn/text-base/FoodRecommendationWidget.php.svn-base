<?php
/**
 * @author darren
 * $this->Widget('application.widgets.RecommendFoodsWidget')
 */
class FoodRecommendationWidget extends CWidget{
    public $city;
    private $restaurant;
    private $delicacy;
    private $model;
    public $food;

    public function init(){
        $this->city = City::model()->findByPk(Yii::app()->request->getParam('cid'));
        $this->food = $this->city->food;
        $this->restaurant = Restaurant::model()->findAll(array('condition'=>'food_id=:foodID', 'order'=>'t.order DESC, updated DESC', 'limit'=>6, 'params'=>array(':foodID'=>$this->city->food['food_id'])));
        $this->delicacy = Delicacy::model()->findAll(array('condition'=>'food_id=:foodID', 'order'=>'t.order DESC', 'limit'=>6, 'params'=>array(':foodID'=>$this->city->food['food_id'])));
        $this->model = array_merge($this->restaurant, $this->delicacy);
    }
    public function run(){
        if(!$this->model)return;
        $this->render('food_recommendation', array('model'=>$this->model));
    }
}