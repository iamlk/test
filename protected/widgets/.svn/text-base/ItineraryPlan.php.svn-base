<?php
/**
 * @author Fedora
 * $this->Widget('application.widgets.ItineraryPlan')
 */
class ItineraryPlan extends CWidget{
    public $customer_id;
    private $week = array('en_us'=>array('SUN','MON','TUE','WED','THU','FRI','SAT'),
                        'zh_cn'=>array("周日","周一","周二","周三","周四","周五","周六"));
    private $basket;
    private $plan;

    public function init(){
        $this->basket = CustomerBasket::model()->getBasket();
        if(!$this->basket) return ;
        if(strtotime($this->basket->start_date) > strtotime($this->basket->end_date)){
            $this->basket = CustomerBasket::model()->updatePlanDate();
        }
        $this->init_plan();
    }

    public function init_plan(){
        $goods = CustomerBasketDetail::model()->findAll('customer_basket_id = '.$this->basket->customer_basket_id);
        $from = $this->basket->start_date;
        $to = $this->basket->end_date;
        $last = G4S::countDays($from,$to);
        //填充日期
        for($i = 0; $i<=$last; $i++){
            $tmp = array();
            $tmp[] = date('n.j',strtotime('+'.$i.' day',strtotime($from)));
            $this->plan[] = $tmp;
        }
        //填充产品
        foreach($goods as $g){
            if($g->goods->entity_type == Goods::ENTITY_PRODUCT){
                //if(strtotime($g->goods_start_date)<1) {$this->plan[$g->day_step][]=$g;continue;}
                $i = G4S::countDays($this->basket->start_date,$g->goods_start_date);
                $this->plan[$i][1]=$g->city_id;
                $this->plan[$i][]=$g;
            }elseif($g->goods->entity_type == Goods::ENTITY_PROPERTY){
                //if(strtotime($g->goods_start_date)<1) {$this->plan[$g->day_step][]=$g;continue;}
                $dates = json_decode($g->goods_dates,true);
                foreach($dates as $date){
                    $i = G4S::countDays($this->basket->start_date,$date);
                    $this->plan[$i][1]=$g->city_id;
                    $this->plan[$i][]=$g;
                }
            }
        }
    }
    public function run(){
        $this->render('itinerary_plan', array('basket'=>$this->basket,'week'=>$this->week,'plan'=>$this->plan));
    }
}
?>