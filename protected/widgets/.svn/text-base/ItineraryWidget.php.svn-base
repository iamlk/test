<?php
/**
 * @author Fedora
 * $this->Widget('application.widgets.ItineraryWidget')
 */
class ItineraryWidget extends CWidget{
    public $cid;
    public $limit = 2;
    private $data;

    public function init(){
        $criteria = new CDbCriteria();
        $criteria->addCondition('itinerary_id in (select itinerary_id from '.ItineraryDetail::model()->tableName().' x where x.city_id ='.intval($this->cid).')');
        $criteria->limit = $this->limit;
        $this->data = Itinerary::model()->getProvider($criteria);
    }

    public function run(){
        if(!$this->data->getData())return;
        $this->render('itinerary', array('list'=>$this->data));
    }
}
?>