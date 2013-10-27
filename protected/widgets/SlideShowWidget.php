<?php
/**
 * @author darren
 * $this->Widget('application.widgets.SlideShowWidget')
 */
class SlideShowWidget extends CWidget{
    public $model;

    public function init(){
        HomePageImage::model()->automationSet();
        $this->model = HomePageImage::model()->findAll(array('condition'=>'is_active=1 ', 'order'=>'t.order DESC'));
    }
    public function run(){
        $this->render('slide_show', array('model'=>$this->model));
    }
}