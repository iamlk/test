<?php
/**
 * @author darren
 * $this->Widget('application.widgets.TravelCompanionWidget')
 */
class TravelCompanionWidget extends CWidget{
    public $city_id;
    public $model;

    public function init(){
        $this->model = TravelCompanion::model()->findAll(array('condition'=>'city_id=:cityID', 'order'=>'travel_companion_id DESC', 'limit'=>6, 'params'=>array(':cityID'=>$this->city_id)));

        if(($count = 6 - count($this->model)) != 0)
        {
            $new_model = TravelCompanion::model()->findAll(array('limit'=>$count, 'order'=>'rand()', 'condition'=>'city_id!=:cityID', 'params'=>array(':cityID'=>$this->city_id)));
            $this->model = array_merge($this->model, $new_model);
        }
    }
    public function run(){
        $this->render('travel_companion', array('model'=>$this->model));
    }
}