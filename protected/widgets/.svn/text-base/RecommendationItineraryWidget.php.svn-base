<?php
/**
 * @author Fedora
 * $this->Widget('application.widgets.RecommendationItineraryWidget')
 */
class RecommendationItineraryWidget extends CWidget{
    private $model;

    public function init()
    {
        $this->model = Itinerary::model()->findAll(array('order'=>'itinerary_id DESC','limit'=>3));
    }

    public function run(){
        $this->render('recommendation_itinerary', array('model'=>$this->model));
    }
}