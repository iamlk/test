<?php
/**
 * @author darren
 * $this->Widget('application.widgets.RecommendationDestinationWidget')
 */
class RecommendationDestinationWidget extends CWidget{
    public $model;

    public function init()
    {
        $model = $model = Country::model()->findAll(array('condition'=>'is_active=1'));
        $data = '<div class="all-city-list undis"><ul class="all-city-details">';
        foreach($model as $country)
        {
            foreach($country->state as $state)
            {
                foreach($state->city as $city)
                {
                    $cityList .= '<a href="'.Yii::app()->createUrl('city/index',array('cid'=>$city['city_id'])).'">'.$city['name'].'</a>';
                }
            }
            if($cityList)
            {
                $data .= '<li><div class="all-city-head">'.$country['name'].'</div><div class="all-city-detail" id="break-all">'.$cityList.'</div></li>';
                unset($cityList);
            }

        }
        $data .= '</ul></div>';
        $this->model = $data;
    }

    public function run(){
        $this->render('recommendation_destination', array('model'=>$this->model));
    }
}