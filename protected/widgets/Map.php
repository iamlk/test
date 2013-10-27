<?php
/**
 * @author darren
 * $this->Widget('application.widgets.Map')
 */
class Map extends CWidget{
    private $model;
    public $longitude;
    public $latitude;
    public $addressName;

    public function init()
    {
        $this->model = Attraction::model()->findAllByPk(Yii::app()->request->getParam('id'));
    }
    public function run(){
        $this->render('map', array('model'=>$this->model,
                                   'longitude'=>$this->longitude,
                                   'latitude'=>$this->latitude,
                                   'addressName'=>$this->addressName));
    }
}