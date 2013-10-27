<?php

class BasketController extends BaseController
{
	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionSaveCurrentBasket()
    {
        if(!$_POST) return;
        $basket = CustomerBasket::model()->getBasket();
        if(!$basket) return;
        if($basket->is_favorite==1){//编辑状态
            $basket->is_favorite=2;
        }
        if($basket->is_favorite==0){
            CustomerBasketDetail::model()->deleteAll('customer_basket_id='.$basket->customer_basket_id);
            $basket->start_date = $basket->end_date = date('Y-m-d',strtotime('+1 day'));
            $basket->current_day_step = 0;
        }
        $basket->save();
        echo 'OK';
    }

    public function actionDeleteGoods()
    {
        $basket = CustomerBasket::model()->getBasket();
        $goods = new CustomerBasketDetail;
        if(!$basket) return;
        if($_POST['entity_type']==Goods::ENTITY_PRODUCT){
            $r = $goods->deleteAll('customer_basket_id = '.$basket->customer_basket_id.' AND goods_id = '.intval($_POST['goods_id']));
            if($r){
                //$basket->updatePlanDate();
                echo 'OK';
            }
        }else{
            $step = $_POST['day_step'];
            $detail = $goods->find('customer_basket_id = '.$basket->customer_basket_id.' AND goods_id = '.intval($_POST['goods_id']));
            if(strtotime($detail->goods_end_date)<1 || $step == '200'){//日期没有设置的或者直接删除该产品的
                $r = $goods->deleteAll('customer_basket_id = '.$basket->customer_basket_id.' AND goods_id = '.intval($_POST['goods_id']));
                if($r){
                    $basket->updatePlanDate();
                    echo 'OK';
                }
            }else{
                $count = G4S::countDays($detail->goods_start_date,$detail->goods_end_date);
                $dates = json_decode($detail->goods_dates,true);
                //$dates = get_object_vars($dates);
                $delete_date = strtotime('+'.$step.' day',strtotime($basket->start_date));
                if($delete_date<strtotime($detail->goods_start_date) || strtotime($detail->goods_end_date)<$delete_date ){//没在日期范围内
                    return;
                }else{//在日期范围内
                    //如果只有一天了，就直接删除产品
                    if($detail->goods_start_date == $detail->goods_end_date){
                        $goods->deleteAll('customer_basket_id = '.$basket->customer_basket_id.' AND goods_id = '.intval($_POST['goods_id']));
                        echo 'OK';
                        return;
                    }
                    $delete_date = date('Y-m-d',$delete_date);
                    $k = array_search($delete_date,$dates);
                    if($k !== null) unset($dates[$k]);
                    sort($dates);
                    //在边界值上
                    if($delete_date == $detail->goods_start_date || $delete_date == $detail->goods_end_date){
                        $min = $max = $dates[0];
                        foreach($dates as $date){
                            if($min>$date) $min = $date;
                            if($max<$date) $max = $date;
                        }
                        $detail->goods_start_date = $min;
                        $detail->goods_end_date = $max;
                    }
                    $detail->goods_dates = json_encode((array)$dates);
                    $detail->save(false);
                    //$basket->updatePlanDate();
                    echo 'OK';
                }
            }
            
        }
    }

    public function actionSetCurrentDay()
    {
        if(!$_POST) return;
        $basket = CustomerBasket::model()->getBasket();
        $basket->current_day_step = intval($_POST['current_day_step']);
        $basket->save();
    }

    public function actionPostShopGoods()
    {
        $json = array();
        $_POST['start_date'] = $_POST['start_date']?$_POST['start_date']:$_POST['goods_start_date'];
        $_POST['end_date'] = $_POST['end_date']?$_POST['end_date']:$_POST['goods_end_date'];
        $_POST['current_day_step']=$_POST['day_step'];
        $basketModel = new CustomerBasket;
        if($basketModel->addGoods($_POST))
        {
            $goods = Goods::model()->findByPk($_POST['goods_id']);
            if($goods->entity_type == 1)
            {
                $cid = $goods->product->productStartCity->city_id;
                $url = $this->createUrl('productList/index',array('city'=>$cid));
            }
            else
            {
                $cid = $goods->property->city_id;
                $url = $this->createUrl('propertyList/index',array('city'=>$cid));
            }
            $json['state']  = 1;
            $json['url']    = $url;
            $json['reason'] = 'OK';
        }
        else
        {
            $json['state']  = 0;
            $json['reason'] = '没有操作成功！';
        }
        echo json_encode($json);
    }

    public function actionShopListByDay(){
        if(!$_POST) return;
        $step = intval($_POST['day_step']);
        $basket = CustomerBasket::model()->getBasket();
        if(!$basket) return;
        $detail = CustomerBasketDetail::model()->findAll('customer_basket_id='.$basket->customer_basket_id);
        $day = date('Y-m-d',strtotime('+'.$step.' day',strtotime($basket->start_date)));
        foreach($detail as $i => $d){
            if($d->entity_type == Goods::ENTITY_PROPERTY){
                if(!in_array($day,json_decode($d->goods_dates,true))){
                    unset($detail[$i]);
                }
            }else{
                if($d->goods_start_date != $day){
                    unset($detail[$i]);
                }
            }
        }
        $this->renderPartial('shop_list_by_day',array('detail'=>$detail,'step'=>$step));
    }
}