<?php
class PeopleshareController extends BaseController
{
    public $layout = '//layouts/people';
    public $flag = array('selected' => null, 'select' => null);
    public $result = array('state' => null, 'reason' => null);
    public $uid = null;
    public $page = 5;

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
   //分享首页
    public function actionIndex()
    {

     
       $this->flag['selected'] = 'peopleshare';
        $this->uid = $_REQUEST['u_id'];
        $this->params['title'] = '全部分享-他的分享-好友中心';
        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => intval($this->uid)),
            array('order' => 'created desc'));
        $page = $this->Pages($data);
        $this->render('index', array('data' => $page));

    }

    public function actionIndexPage()
    {
        $this->uid = $_REQUEST['u_id'];
        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => intval($this->uid)),
            array('order' => 'created desc'));
        $page = $this->Pages($data);
        $this->renderPartial('index', array('data' => $page));
    }
    //分页调用
    private function Pages($data)
    {
        $page = new CArrayDataProvider($data, array('pagination' => array('pageSize' =>
                    $this->page), ));

        return $page;

    }

    public function actionProperty()
    {
        $this->flag['selected'] = 'peopleshare';
        $this->uid = $_REQUEST['u_id'];
        $this->params['title'] = '住所-他的分享-好友中心';
        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => intval($this->uid),
                'object_type' => Dynamic::PROPERTY),array('order'=>'created desc'));

        $page = $this->Pages($data);

        $this->render('property', array('data' => $page));

    }

    public function actionPropertyPage()
    {
       $this->uid = $_REQUEST['u_id'];
        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => intval($this->uid),
                'object_type' => Dynamic::PROPERTY));

        $page = $this->Pages($data);
        
        $this->renderPartial('property', array('data' => $page));
    }

    public function actionProduct()
    {
        $this->params['title'] = '行程-他的分享-好友中心';
        $this->flag['selected'] = 'peopleshare';
        $this->uid = $_REQUEST['u_id'];
        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => intval($this->uid),
                'object_type' => Dynamic::PRODUCT),array('order'=>'created desc'));

        $data = $this->Pages($data);

        $this->render('product', array('data' => $data));


    }
    public function actionProductPage()
    {
         $this->uid = $_REQUEST['u_id'];
        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => intval($this->uid),
                'object_type' => Dynamic::PRODUCT));

        $page = $this->Pages($data);
        
        $this->renderPartial('product', array('data' => $page));
    }


    public function actionArticle()
    {
        $this->params['title'] = '攻略-他的分享-好友中心';
        $this->flag['selected'] = 'peopleshare';
        $this->uid = $_REQUEST['u_id'];
        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => intval($this->uid),
                'object_type' => Dynamic::ARTICLE),array('order'=>'created desc'));

        $page = $this->Pages($data);

        $this->render('article', array('data' => $page));

    }

    public function actionArticlePage()
    {
        $this->uid = $_REQUEST['u_id'];
        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => intval($this->uid),
                'object_type' => Dynamic::ARTICLE));

        $page = $this->Pages($data);
        
        $this->renderPartial('article', array('data' => $page));
    }

    public function actionDelicacy()
    {
        $this->params['title'] = '美食-他的分享-好友中心';
        $this->flag['selected'] = 'peopleshare';
        $this->uid = $_REQUEST['u_id'];
        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => intval($this->uid),
                'object_type' => Dynamic::DELICACY),array('order'=>'created desc'));

        $page = $this->Pages($data);

        $this->render('delicacy', array('data' => $page));

    }
    public function actionDelicacyPage()
    {
        $this->uid = $_REQUEST['u_id'];
        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => intval($this->uid),
                'object_type' => Dynamic::DELICACY));

        $page = $this->Pages($data);
        
        $this->renderPartial('delicacy', array('data' => $page));
    }

    public function actionAlbum()
    {
        $this->params['title'] = '图片-他的分享-好友中心';
        $this->flag['selected'] = 'peopleshare';
        $this->uid = $_REQUEST['u_id'];
        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => intval($this->uid),
                'object_type' => Dynamic::ALBUMIMAGE),array('order'=>'created desc'));

        $page = $this->Pages($data);

        $this->render('album', array('data' => $page));

    }
    public function actionalbumPage()
    {
        $this->uid = $_REQUEST['u_id'];
        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => intval($this->uid),
                'object_type' => Dynamic::ALBUMIMAGE));

        $page = $this->Pages($data);
       
        $this->renderPartial('album', array('data' => $page));
    }

    public function actionTravel()
    {
        $this->params['title'] = '行程单-他的分享-好友中心';
        $this->flag['selected'] = 'peopleshare';
        $this->uid = $_REQUEST['u_id'];
        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => intval($this->uid),
                'object_type' => Dynamic::TRAVEL),array('order'=>'created desc'));

        $page = $this->Pages($data);

        $this->render('travel', array('data' => $page));

    }
    public function actionTravelPage()
    {
        $this->uid = $_REQUEST['u_id'];
        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => intval($this->uid),
                'object_type' => Dynamic::TRAVEL));

        $page = $this->Pages($data);
       
        $this->renderPartial('travel', array('data' => $page));
    }
    
    
        //城市分享
    public function actionCity()
    {


        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->params['title'] = '城市-他的分享-个人中心';
         $this->flag['selected'] = 'peopleshare';
        $this->uid = $_REQUEST['u_id'];

        $data = SiteShare::model()->findAllByAttributes(array("customer_id" =>  intval($this->uid),
                'object_type' => Dynamic::CITY), array('order' => 'created desc'));
        $page = $this->Pages($data);
        //  print_r($page);exit;
        $this->render('city', array('data' => $page));

    }
    //城市分享分页
    public function actionCityPage()
    {
         $this->uid = $_REQUEST['u_id'];
        $data = SiteShare::model()->findAllByAttributes(array("customer_id" =>  intval($this->uid),
                'object_type' => Dynamic::CITY), array('order' => 'created desc'));
        $page = $this->Pages($data);
        $this->renderPartial('city', array('data' => $page));
    }


    //餐厅分享
    public function actionRestaurant()
    {

        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->params['title'] = '餐厅-他的分享-个人中心';
         $this->flag['selected'] = 'peopleshare';
        $this->uid = $_REQUEST['u_id'];

        $data = SiteShare::model()->findAllByAttributes(array("customer_id" =>  intval($this->uid),
                'object_type' => Dynamic::RESTAURANT), array('order' => 'created desc'));
        $page = $this->Pages($data);
        //  print_r($page);exit;
        $this->render('restaurant', array('data' => $page));

    }
    //餐厅分享分页
    public function actionRestaurantPage()
    {
         $this->uid = $_REQUEST['u_id'];
        $data = SiteShare::model()->findAllByAttributes(array("customer_id" =>  intval($this->uid),
                'object_type' => Dynamic::RESTAURANT), array('order' => 'created desc'));
        $page = $this->Pages($data);
        $this->renderPartial('restaurant', array('data' => $page));

    }

    //景点分享
    public function actionAttraction()
    {

        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->params['title'] = '景点-他的分享-个人中心';
         $this->flag['selected'] = 'peopleshare';
        $this->uid = $_REQUEST['u_id'];

        $data = SiteShare::model()->findAllByAttributes(array("customer_id" =>  intval($this->uid),
                'object_type' => Dynamic::ATTRACTION), array('order' => 'created desc'));
        $page = $this->Pages($data);
        //  print_r($page);exit;
        $this->render('attraction', array('data' => $page));
    }
    //景点分页
    public function actionAttractionPage()
    {
         $this->uid = $_REQUEST['u_id'];
        $data = SiteShare::model()->findAllByAttributes(array("customer_id" =>  intval($this->uid),
                'object_type' => Dynamic::ATTRACTION), array('order' => 'created desc'));
        $page = $this->Pages($data);
        $this->renderPartial('attraction', array('data' => $page));
    }


}
?>