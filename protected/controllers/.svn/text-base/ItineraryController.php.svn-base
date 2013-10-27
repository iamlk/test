<?php

class ItineraryController extends BaseController
{
    public $layout = '//layouts/destination';

	public function actionIndex($cid)
	{
        
        $this->breadcrumbs->add('首页','/');
        $this->breadcrumbs->add(City::getCityName($_GET['cid']),array('city/index',array('cid'=>$_GET['cid'])));
        $this->breadcrumbs->add('行程单分享');
        $criteria = new CDbCriteria();
        $criteria->addCondition('itinerary_id in (select itinerary_id from '.ItineraryDetail::tableName('ItineraryDetail').' x where x.city_id ='.intval($cid).')');
        $list = Itinerary::model()->getProvider($criteria);
        $this->params['title'] = '行程单分享-'.City::getCityName($_GET['cid']);
		$this->render('index',array('list'=>$list));
	}
    
    public function actionReview($id=0)
    {
        $criteria=new CDbCriteria;
        $criteria->addCondition('itinerary_id='.$id);
        $reviews = ItineraryReview::model()->getProvider($criteria);
        $this->renderPartial('_review',array('reviews'=>$reviews));
    }
    
    public function actionView($id,$cid=0)
    {
        
        $this->breadcrumbs->add('首页','/');
        if($cid){
            $this->breadcrumbs->add(City::getCityName($_GET['cid']),array('city/index',array('cid'=>$cid)));
            $this->breadcrumbs->add('行程单分享',array('itinerary/index',array('cid'=>$cid)));
        }
        
        $this->layout = '//layouts/default';
        $itinerary = Itinerary::model()->findByPk($id);
        $this->breadcrumbs->add($itinerary->title);
        //$itinerary->updateCounters(array('view_count'=>1),'itinerary_id='.$id);
        $itinerary->view_count++;
        $itinerary->save(false);
        $list = ItineraryDetail::model()->buildList($itinerary);
        //回复
        $criteria=new CDbCriteria;
        $criteria->addCondition('itinerary_id='.$itinerary->itinerary_id);
        $reviews = ItineraryReview::model()->getProvider($criteria);
        $this->params['title'] = $itinerary->title;
        $this->render('view',array('it'=>$itinerary,'list'=>$list,'reviews'=>$reviews));
    }
    
    public function actionAddReview()
    {
        if(!$_POST) return;
        $review = new ItineraryReview;
        $review->attributes = $_POST;
        $review->customer_id = Yii::app()->user->customer_id;
        $review->created = time();
        $review->parent_id = $review->parent_id?$review->parent_id:1;
        $is_ok = $review->save();
        echo $review->getFirstError();
        echo CJSON::encode(array('code'=>$is_ok?1:0));
    }
    
 
    
}