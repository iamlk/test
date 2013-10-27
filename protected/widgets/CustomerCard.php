<?php
/**
 * @author Fedora
 * $this->Widget('application.widgets.CustomerCard')
 */
class CustomerCard extends CWidget{
    public $customer_id;
    public $name = 'default';
    private $model;

    public function init(){
        $this->model = Customer::model()->findByPk($this->customer_id);
    }
    public function run(){
        $this->render('customer_card_'.$this->name, array('model'=>$this->model));
    }
}
?>