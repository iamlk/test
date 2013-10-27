<?php
/**
 * @author Fedora
 * $this->Widget('application.widgets.PropertyOrder')
 */
class PropertyOrder extends CWidget{
    public $property_model;
    private $order;
    private $dates;

    public function init(){
        $basket = CustomerBasket::model()->getBasket();
        if($basket){
            $this->order = CustomerBasketDetail::model()->find('customer_basket_id = '.$basket->customer_basket_id.' AND goods_id = '.$this->property_model->goods_id);
        }
        $this->dates = Property::model()->getOccupied($this->property_model->goods_id);
    }
    
    public function run(){
        $this->render('property_order', array('property'=>$this->property_model,'order'=>$this->order,'dates'=>$this->dates));
    }
}
?>