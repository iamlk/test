<?php
class ShareController extends BaseController
{
    public $layout = '//layouts/center.mine';
    public $flag = array('selected' => null, 'select' => null);
    public $result = array('state' => null, 'reason' => null);
    public $page = 5;

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */

    //分享首页
    public function actionIndex()
    {

        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->flag['selected'] = 'share';
        $this->params['title'] = '全部分享-我的分享-个人中心';
        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => U_ID),
            array('order' => 'created desc'));
        $page = $this->Pages($data);
        $this->render('index', array('data' => $page));

    }

    public function actionIndexPage()
    {

        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => U_ID),
            array('order' => 'created desc'));
        $page = $this->Pages($data);
        $this->renderPartial('index', array('data' => $page));
    }


    public function actionProperty()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->flag['selected'] = 'share';
        $this->params['title'] = '住所-我的分享-个人中心';
        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => U_ID,
                'object_type' => Dynamic::PROPERTY), array('order' => 'created desc'));

        $page = $this->Pages($data);

        $this->render('property', array('data' => $page));

    }
    public function actionPropertyPage()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }

        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => U_ID,
                'object_type' => Dynamic::PROPERTY));

        $page = $this->Pages($data);

        $this->renderPartial('property', array('data' => $page));
    }

    //分页调用
    private function Pages($data)
    {
        $page = new CArrayDataProvider($data, array('pagination' => array('pageSize' =>
                    $this->page), ));

        return $page;

    }

    public function actionProduct()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->flag['selected'] = 'share';
        $this->params['title'] = '行程-我的分享-个人中心';
        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => U_ID,
                'object_type' => Dynamic::PRODUCT), array('order' => 'created desc'));

        $data = $this->Pages($data);

        $this->render('product', array('data' => $data));

    }

    public function actionProductPage()
    {

        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => U_ID,
                'object_type' => Dynamic::PRODUCT));

        $page = $this->Pages($data);

        $this->renderPartial('product', array('data' => $page));
    }

    public function actionArticle()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->params['title'] = '攻略-我的分享-个人中心';

        $this->flag['selected'] = 'share';

        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => U_ID,
                'object_type' => Dynamic::ARTICLE), array('order' => 'created desc'));

        $page = $this->Pages($data);

        $this->render('article', array('data' => $page));

    }
    public function actionArticlePage()
    {

        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => U_ID,
                'object_type' => Dynamic::ARTICLE));

        $page = $this->Pages($data);

        $this->renderPartial('article', array('data' => $page));
    }

    public function actionDelicacy()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->params['title'] = '美食-我的分享-个人中心';
        $this->flag['selected'] = 'share';

        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => U_ID,
                'object_type' => Dynamic::DELICACY), array('order' => 'created desc'));

        $page = $this->Pages($data);

        $this->render('delicacy', array('data' => $page));

    }

    public function actionDelicacyPage()
    {

        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => U_ID,
                'object_type' => Dynamic::DELICACY));

        $page = $this->Pages($data);

        $this->renderPartial('delicacy', array('data' => $page));
    }

    public function actionAlbum()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->flag['selected'] = 'share';
        $this->params['title'] = '图片-我的分享-个人中心';
        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => U_ID,
                'object_type' => Dynamic::ALBUMIMAGE), array('order' => 'created desc'));
        $page = $this->Pages($data);
        $this->render('album', array('data' => $page));
    }

    public function actionalbumPage()
    {

        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => U_ID,
                'object_type' => Dynamic::ALBUMIMAGE));

        $page = $this->Pages($data);

        $this->renderPartial('album', array('data' => $page));
    }

    public function actionTravel()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->params['title'] = '行程单-我的分享-个人中心';
        $this->flag['selected'] = 'share';

        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => U_ID,
                'object_type' => Dynamic::TRAVEL), array('order' => 'created desc'));
        $page = $this->Pages($data);

        $this->render('travel', array('data' => $page));

    }

    public function actionTravelPage()
    {

        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => U_ID,
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
        $this->params['title'] = '城市-我的分享-个人中心';
        $this->flag['selected'] = 'share';

        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => U_ID,
                'object_type' => Dynamic::CITY), array('order' => 'created desc'));
        $page = $this->Pages($data);
        //  print_r($page);exit;
        $this->render('city', array('data' => $page));

    }
    //城市分享分页
    public function actionCityPage()
    {

        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => U_ID,
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
        $this->params['title'] = '餐厅-我的分享-个人中心';
        $this->flag['selected'] = 'share';

        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => U_ID,
                'object_type' => Dynamic::RESTAURANT), array('order' => 'created desc'));
        $page = $this->Pages($data);
        //  print_r($page);exit;
        $this->render('restaurant', array('data' => $page));

    }
    //餐厅分享分页
    public function actionRestaurantPage()
    {

        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => U_ID,
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
        $this->params['title'] = '景点-我的分享-个人中心';
        $this->flag['selected'] = 'share';

        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => U_ID,
                'object_type' => Dynamic::ATTRACTION), array('order' => 'created desc'));
        $page = $this->Pages($data);
        //  print_r($page);exit;
        $this->render('attraction', array('data' => $page));
    }
    //景点分页
    public function actionAttractionPage()
    {

        $data = SiteShare::model()->findAllByAttributes(array("customer_id" => U_ID,
                'object_type' => Dynamic::ATTRACTION), array('order' => 'created desc'));
        $page = $this->Pages($data);
        $this->renderPartial('attraction', array('data' => $page));
    }

    //分享动作
    public function actionIt()
    {
        if ($this->isGuest) {
            $this->result['state'] = '0';
            $this->result['reason'] = '请先登录！';
            exit(json_encode($this->result));
        }
        if (!$_REQUEST['type'] || !$_REQUEST['id']) {
            $this->result['state'] = '0';
            $this->result['reason'] = '分享出错了，参数不完整！';
        }

        $arr = array('object_type' => $_REQUEST['type'], 'object_id' => $_REQUEST['id']);
        $data = SiteShare::model()->addFavorite($arr);

        if ($data == 3) {
            $this->result['state'] = '1';
            $this->result['reason'] = '分享成功！';
        } else {
            $this->result['state'] = '0';
            $this->result['reason'] = '已经分享过了';
        }
        exit(json_encode($this->result));

    }
    //fedora
    public function actionDelete()
    {
        //$this->result['state'] = '1';
        //        $this->result['reason'] = '删除成功！';
        //        echo json_encode($this->result);
        //        return;
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $type = $_REQUEST['type'];
        $id = $_REQUEST['id'];
        $uid = U_ID;
        $this->result['state'] = '0';
        $this->result['reason'] = '参数有误！';

        if (!$type || !$id || !$uid)
            exit(json_encode($this->result));
        $hash = md5($type . $id . $uid);
        SiteShare::model()->deleteAll('hash="' . $hash . '"');
        $this->result['state'] = '1';
        $this->result['reason'] = '删除成功！';
        echo json_encode($this->result);
    }


}
?>