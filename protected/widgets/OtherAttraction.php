<?php
/**
 * @author darren
 * $this->Widget('application.widgets.ArticleList')
 */
class OtherAttraction extends CWidget{
    public $model;

    public function init(){
        $this->model = Attraction::model()->findAll(array('order'=>'rand()', 'limit'=>4));
    }
    public function run(){
        $this->render('other_attraction', array('model'=>$this->model));
    }
}