<?php
/**
 * 商品详情页面展示  
 * @author  leo
*/
class GoodsController extends BaseController
{
    /** 布局 **/
    public $layout = '//layouts/base';
    
    public $_goods = null;
    
    public $_product = null;
    
    public $_property = null;
    
    //static $_entity_type = array(1=>'product',2=>'property');
    
    
        /** 过滤器 **/
    public function filters()
    {
        return array(
            'accessControl',
            'hasGoods + index',
            //'ajaxOnly + showPrice',
            );
    }
    /** 限制操作者 **/
    public function accessRules()
    {
        return array(
            array('allow', 'actions' => array('index')),
            );
    }
    /** 找商品 **/
    public function filterHasGoods($filterChain)
    {
        // 房子.主表 // 必须要指定哪个房子
        $this->_goods = Goods::model()->findByPk((int)Yii::app()->request->getParam('id'));
        
        if ($this->_goods == null || $this->_goods->is_active != 1)
        {
             $this->redirect(array('/'));
        }
        $this->_goods->browse = $this_goods->browse+1;
        $this->_goods->save(false);
        $filterChain->run();
    }
    
	public function actionIndex()
	{
	    $data = array(); 
        $time_arr = array();
        $city_id = 0;
       
	    
        $this->breadcrumbs->add('首页','/');
        
        if($this->_goods->entity_type == 1)
        {
            $this->_product = $product = $this->_goods->product;
            $city_id = $product->productStartCity->city_id;
            $city_name = City::getCityName($city_id);
            $this->breadcrumbs->add($city_name,$this->createUrl('city/index',array('cid'=>$city_id)));
            $this->breadcrumbs->add('推荐短期行程',$this->createUrl('productList/index',array('city'=>$city_id)));
            $this->breadcrumbs->add($product->productAddendum->title);
            $this->params['title'] = $city_name.'-'.$product->productAddendum->title.'-推荐短期行程';
            $_data =  Product::model()->caclTime($model->entity_type,$model->product_id);
           
            if(empty($_data['over']) || strtotime($_data['over'])<time())
            {
                $time_arr['end'] = date("Y-m-d",strtotime("-1 day"));
            }
            if(empty($_data['start']))
            {
                 $time_arr['start'] = '2012-12-12';
            }
           
          
            if($_data['list'])
            {
                $time_only = array();
                foreach($_data['list'] as $v)
                {
                   if( $v['sel'] == 1)
                   {
                    $time_only[] = $v;
                   }
                }
                $spec_only = array();
                if($_data['spec']['list'])
                {
                    foreach($_data['spec']['list'] as $v)
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
        }
        elseif($this->_goods->entity_type == 2)
        {
            $this->_property = $property = $this->_goods->property;
            $city_id = $property->city_id;
            $city_name = City::getCityName($city_id);
            $this->breadcrumbs->add($city_name,$this->createUrl('city/index',array('cid'=>$city_id)));
            $this->breadcrumbs->add('推荐度假公寓',$this->createUrl('propertyList/index',array('city'=>$city_id)));
            $this->breadcrumbs->add($property->propertyAddendum->title);
            $this->params['title'] = $city_name.'-'.$property->propertyAddendum->title.'-推荐度假公寓';
        }
        else
        {
            $this->_product = $this->_property= null;
        }
        
        $data['city_id'] = $city_id;
        $data['data_time'] = $time_arr;
        
		$this->render('index',array('data'=>$data));
	}
    
    public function actionGetPrice()
    {
        $json = array();
        $json['status']=1;
        $goods = Goods::model()->findByPk(intval($_POST['goods_id']));
        $product = $goods->{Goods::$goods_type[$goods->entity_type]};
        if(!$goods){
            $json['price']='￥0.00';
            $json['price_rmb']='0.00';
        }else{
            if($goods->entity_type==Goods::ENTITY_PRODUCT){//短期行程
                if($product->entity_type==2){//多日游
                    $type = explode(',',$_POST['roomtype']);
                    $room = explode(',',$_POST['rooms']);
                    $rooms = array();
                    foreach($type as $i => $t){
                        $rooms[$t]=intval($room[$i]);
                    }
                    $json['price']=Product::model()->countMultiDaysPrice($_POST['start_date'],$_POST['adult'],$_POST['child'],$rooms,$product->product_id);
                }else{
                    $json['price']=Product::model()->countOneDayPrice($_POST['start_date'],$_POST['adult'],$_POST['child'],$product->product_id);
                }
            }else{
                $json['price']=Property::model()->countTotalPrice($_POST['start_date'],$_POST['end_date'],$product->property_id);
            }
            //$json['price_rmb']=$json['price']*SiteOption::getValueByKey('USD_TO_RMB',true);
        }
        $json['price'] = '￥'.G4S::format($json['price']);
        //$json['price_rmb'] = '￥'.G4S::format($json['price_rmb']);
        echo json_encode($json);
    }
    
    public function actionProductPrice()
    {
        $json = array();
        if(!$_POST['start_date'] || !$_POST['product_id'])
        {
            $json['state'] = 0;
            $json['reason'] = '参数错误！';
            exit(json_encode($json));
        }
        $product = Product::model()->findByPk(intval($_POST['product_id']));
        if(!$product)
        {
            $json['state'] = 0;
            $json['reason'] = '没有找到该产品！';
            exit(json_encode($json));
        }
        $model = $product->getExplodePrice($_POST['start_date']);
        if(!$model)
        {
            $json['state'] = 0;
            $json['reason'] = '请重新选择日期！';
            exit(json_encode($json));
        }
        $count = ProductNote::model()->find('product_id='.intval($_POST['product_id']));
        //查询订单
        $has_count = $product->getOccupied($product->goods_id);
        if($count->max_per_day_num_for_adults==0) $json['count'] = 999;
        else $json['count'] = $count->max_per_day_num_for_adults-$has_count;
        $json['state'] = 1;    
        $json['adult'] = $model->price_adult;
        $json['child'] = $model->price_kids;
        $json['reason'] = 'OK';
        /**
        $json['room1'] = intval($model->price_single);
        $json['room2'] = intval($model->price_double);
        $json['room3'] = intval($model->price_triple);
        $json['room4'] = intval($model->price_quad);
        */
        exit(json_encode($json));
    }
    

}