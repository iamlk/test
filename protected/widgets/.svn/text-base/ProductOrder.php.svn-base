<?php
/**
 * @author Fedora
 * $this->Widget('application.widgets.ProductOrder')
 */
class ProductOrder extends CWidget{
    public $product_model;
    private $order;
    private $date;

    public function init(){
        $basket = CustomerBasket::model()->getBasket();
        if($basket){
            $this->order = CustomerBasketDetail::model()->find('customer_basket_id = '.$basket->customer_basket_id.' AND goods_id = '.$this->product_model->goods_id);
        }
        $this->init_date();
    }
    
    private function init_date(){
        
        $data =  Product::model()->caclTime($this->product_model->entity_type,$this->product_model->product_id);
        $time_arr = array();
        $time_arr['start'] = $data['start'];
        $time_arr['end'] = $data['over'];
        if($data['list'])
        {
            $time_only = array();
            foreach($data['list'] as $v)
            {
               if( $v['sel'] == 1)
               {
                $time_only[] = $v;
               }
            }
            $spec_only = array();
            if($data['spec']['list'])
            {
                foreach($data['spec']['list'] as $v)
                {
                   if( $v['sel'] == 1)
                   {
                    $spec_only[] = $v;
                   }
                }
            } 
           $time_arr['time'] = $time_only;
           $time_arr['only'] = $spec_only;  
        }
        $this->date = $time_arr;
    }
    
    public function run(){
        $this->render('product_order', array('product'=>$this->product_model,'order'=>$this->order,'data'=>$this->date));
    }
}
?>