<?php
class PeopleController extends BaseController
{
    public $layout = '//layouts/people';
    public $flag = array('selected' => null, 'select' => null);
    public $uid = null;
    public $page=6;
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function actionIndex()
    {
        $this->uid = $_REQUEST['u_id'];
        $this->params['title'] = '好友中心';
        $dynamic = Dynamic::model()->getDynamicList(intval($this->uid));
        $this->render('index', array('dynamic' => $dynamic));
      

    }
     public function actionIndexPage()
    {
        $this->uid = $_REQUEST['u_id'];
        $dynamic = Dynamic::model()->getDynamicList(intval($this->uid));

        $this->renderPartial('_dynamic_index', array('dynamic' => $dynamic));


    }

    //卖家首页
    public function actionSellerIndex()
    {
        $this->params['title'] = '他是卖家-好友中心';
        $this->uid = $_REQUEST['u_id'];
        $this->flag['selected'] = 'seller';
        $housecount = $this->getGoodsCount(intval($this->uid),2);
        $shortruncount = $this->getGoodsCount(intval($this->uid),1);
        
         $arr_property = Property::model()->getPropertyReview(intval($this->uid));
        //获取短期行程的评论(买家评价我的商品)
        $arr_product = Product::model()->getProductReview(intval($this->uid));
        //合并住所评论和短期行程评论(买家评价我的商品)
        $RPL_arr = array_merge($arr_property, $arr_product);
        
        $pl['count']=count($RPL_arr);
         
        $this->render('seller_index',array('housecount'=>$housecount,'shortcount'=>$shortruncount,'plcount'=>$pl));
    }
    
    //获取商品数量
    public function getGoodsCount($uid,$type){
        
         $data=Yii::app()->db->createCommand()
        ->select('count(goods_id) as count')
        ->from('goods')
        ->where('customer_id=:id and is_active=:isid and entity_type=:enid', array(':id'=>$uid,':isid'=>1,':enid'=>$type))
        ->queryRow();
        
        return $data;
    }
    

    //卖家住所
    public function actionSellerHouse()
    {
        $this->params['title'] = '他的住所-他是卖家-好友中心';
        $this->uid = $_REQUEST['u_id'];
        $this->flag['selected'] = 'seller';
        $this->flag['select'] = 'sellerhouse';
        //获取卖家发布的住所
        $provider = Goods::model()->getAllHouse(intval($this->uid),1,$this->page);

        $this->render('seller_house', array('data' => $provider));
    }
    //卖家住所分页
    public function actionSellerHousepage()
    {
        $this->uid = $_REQUEST['u_id'];
        $provider = Goods::model()->getAllHouse(intval($this->uid),1,$this->page);
        $this->renderPartial('seller_house', array('data' => $provider));
    }

    //卖家短期行程
    public function actionSellerShortRun()
    {
        $this->params['title'] = '他的短期行程-他是卖家-好友中心';
        $this->uid = $_REQUEST['u_id'];
        $this->flag['selected'] = 'seller';
        $this->flag['select'] = 'sellershortrun';
        
        $provider = Goods::model()->getAllShortRun(intval($this->uid),1,$this->page);
        
        $this->render('seller_shortrun',array('data' => $provider));
    }
    
      //卖家短期行程分页
    public function actionSellerShortRunpage()
    {
        $this->uid = $_REQUEST['u_id'];
        $provider = Goods::model()->getAllShortRun(intval($this->uid),1,$this->page);
        $this->renderPartial('seller_shortrun', array('data' => $provider));
    }

    //买家买到的住所
    public function actionBuyerHouse()
    {
         $this->params['title'] = '住所-他是买家-好友中心';
        $this->uid = $_REQUEST['u_id'];
        $this->flag['selected'] = 'buyer';
        $this->flag['select'] = 'buyerhouse';
        $provider = Order::model()->getUserBuyAllGoods(intval($this->uid),2,$this->page);
        //print_r($provider);exit;
        $this->render('buyer_house', array('data' => $provider));
       
    }
    
    //好友买到的住所分页
    public function actionBuyerHousePage()
    {
        $this->uid = $_REQUEST['u_id'];
        $provider = Order::model()->getUserBuyAllGoods(intval($this->uid),2,$this->page);
        $this->renderPartial('buyer_house', array('data' => $provider));
    }
    
     //买家买到的短期行程
    public function actionBuyerShortRun()
    {
        $this->params['title'] = '短期行程-他是买家-好友中心';
        $this->uid = $_REQUEST['u_id'];
        $this->flag['selected'] = 'buyer';
        $this->flag['select'] = 'buyershortrun';
        $provider = Order::model()->getUserBuyAllGoods(intval($this->uid),1,$this->page);
        $this->render('buyer_shortrun', array('data' => $provider));
    }
      //好友买到的短期行程分页
    public function actionBuyerShortRunPage()
    {
        $this->uid = $_REQUEST['u_id'];
         $provider = Order::model()->getUserBuyAllGoods(intval($this->uid),1,$this->page);
        $this->renderPartial('buyer_shortrun', array('data' => $provider));
    }
   
   
    //好友攻略
    public function actionArticle(){
        $this->params['title'] = '他的攻略-好友中心';
        $this->uid = $_REQUEST['u_id'];
        $this->flag['selected'] = 'article';
       // $data = Article::model()->getProvider(array("customer_id" => $this->uid));
        $data = Article::model()->findAllByAttributes(array('customer_id'=>intval($this->uid),'is_active'=>1));

        $dataProvider = new CArrayDataProvider($data, array(
            'pagination' => array('pageSize' => $this->page),
            ));
    

        $this->render('article', array('data' => $dataProvider));
        
    }
      //攻略分页
    public function actionCompanion()
    {

        $data = Article::model()->findAllByAttributes(array('customer_id'=>intval($this->uid),'is_active'=>1));

        $dataProvider = new CArrayDataProvider($data, array(
            'pagination' => array('pageSize' => $this->page),
            ));
        $this->renderPartial('article_list', array('data' => $dataProvider));
    }
    
   

}
?>