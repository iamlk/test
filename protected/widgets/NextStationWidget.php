<?php
/**
 * @author darren
 * $this->Widget('application.widgets.NextStations')
 */
class NextStationWidget extends CWidget{
    private $model;

    public function init(){
        CityRecommend::model()->automationSet();
        $model = CityRecommend::model()->findAll(array('condition'=>'t.is_active=1 AND t.start_time<:time AND t.end_time>:time AND type in(0,2)','order'=>'t.order DESC','limit'=>4,'params'=>array(':time'=>time())));
//        foreach($model as $value)
//        {
//            $no[] = $value['city_id'];
//        }
//        $no = join(',',$no);
//        $num = 8-count($model);
//        if($num>0)
//        {
//            $add_to = City::model()->findAll(array('condition'=>'t.is_active=1 AND t.city_id NOT IN(:no)','limit'=>$num,'order'=>'rand()','params'=>array(':no'=>$no)));
//            $model = array_merge($model,$add_to);
//        }
        $this->model = $model;
    }
    public function run(){
        if(!$this->model)return;
        $this->render('next_station', array('model'=>$this->model));
    }
}