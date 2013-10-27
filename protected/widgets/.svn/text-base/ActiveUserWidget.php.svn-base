<?php
/**
 * @author darren
 * $this->Widget('application.widgets.ActiveUsersWidget')
 */
class ActiveUserWidget extends CWidget{
    public $model;

    public function init(){
        $this->model = Customer::model()->findAll(array('order'=>'last_login desc', 'limit'=>6));
    }
    public function run(){
        $this->render('active_user', array('model'=>$this->model));
    }
}