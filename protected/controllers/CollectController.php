<?php
class CollectController extends BaseController
{
    public $layout = '//layouts/center.mine';
    public $flag = array('selected' => null, 'select' => null);
    public $result = array('state' => null, 'reason' => null);
    public $page = 9;
    public function actionindex()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->params['title'] = '全部-我的收藏-个人中心';
        $this->flag['selected'] = 'collection';

        $data = SiteFavorite::model()->findAllByAttributes(array("customer_id" => U_ID),
            array('order' => 'created desc'));

        $data = $this->Pages($data);

        $this->render('index', array('data' => $data));

    }
    public function actionIndexPage()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }

        $data = SiteFavorite::model()->findAllByAttributes(array("customer_id" => U_ID),
            array('order' => 'created desc'));

        $data = $this->Pages($data);

        $this->renderPartial('index', array('data' => $data));
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
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }

        $this->params['title'] = '住所-我的收藏-个人中心';
        $this->flag['selected'] = 'collection';

        $data = SiteFavorite::model()->findAllByAttributes(array("customer_id" => U_ID,
                'object_type' => Dynamic::PROPERTY), array('order' => 'created desc'));

        $this->render('property', array('data' => $data));

    }

    public function actionProduct()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->params['title'] = '行程-我的收藏-个人中心';
        $this->flag['selected'] = 'collection';

        $data = SiteFavorite::model()->findAllByAttributes(array("customer_id" => U_ID,
                'object_type' => Dynamic::PRODUCT), array('order' => 'created desc'));

        $this->render('product', array('data' => $data));

    }

    public function actionArticle()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->flag['selected'] = 'collection';
        $this->params['title'] = '攻略-我的收藏-个人中心';
        $data = SiteFavorite::model()->findAllByAttributes(array("customer_id" => U_ID,
                'object_type' => Dynamic::ARTICLE), array('order' => 'created desc'));

        $this->render('article', array('data' => $data));

    }

    public function actionDelicacy()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->flag['selected'] = 'collection';
        $this->params['title'] = '美食-我的收藏-个人中心';
        $data = SiteFavorite::model()->findAllByAttributes(array("customer_id" => U_ID,
                'object_type' => Dynamic::DELICACY), array('order' => 'created desc'));

        $this->render('delicacy', array('data' => $data));

    }

    public function actionAlbum()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->flag['selected'] = 'collection';
        $this->params['title'] = '相册-我的收藏-个人中心';
        $data = SiteFavorite::model()->findAllByAttributes(array("customer_id" => U_ID,
                'object_type' => Dynamic::ALBUM), array('order' => 'created desc'));

        $this->render('album', array('data' => $data));

    }

    public function actionTravel()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->params['title'] = '行程单-我的收藏-个人中心';
        $this->flag['selected'] = 'collection';
        $data = SiteFavorite::model()->findAllByAttributes(array("customer_id" => U_ID,
                'object_type' => Dynamic::TRAVEL), array('order' => 'created desc'));

        $this->render('travel', array('data' => $data));

    }

    public function actionRestaurant()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->params['title'] = '餐厅-我的收藏-个人中心';
        $this->flag['selected'] = 'collection';
        $data = SiteFavorite::model()->findAllByAttributes(array("customer_id" => U_ID,
                'object_type' => Dynamic::RESTAURANT), array('order' => 'created desc'));

        $this->render('restaurant', array('data' => $data));

    }

    /**
     * @note 未加判断哦 
     * *
     */
    public function actionIt()
    {
        if ($this->isGuest) {
            $this->result['state'] = '0';
            $this->result['reason'] = '请先登录！';
            exit(json_encode($this->result));
        }
        if (!$_REQUEST['type'] || !$_REQUEST['id']) {
            $this->result['state'] = '0';
            $this->result['reason'] = '收藏出错了，参数不完整！';
        }

        $arr = array('object_type' => $_REQUEST['type'], 'object_id' => $_REQUEST['id']);

        $data = SiteFavorite::model()->addFavorite($arr);
        if ($data == 3) {
            $this->result['state'] = '1';
            $this->result['reason'] = '收藏成功！';
        } else {
            $this->result['state'] = '0';
            $this->result['reason'] = '已经收藏过了';
        }
        exit(json_encode($this->result));

    }

    //fedora
    public function actionDelete()
    {
        //    $this->result['state'] = '1';
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
        SiteFavorite::model()->deleteAll('hash="' . $hash . '"');
        $this->result['state'] = '1';
        $this->result['reason'] = '删除成功！';
        echo json_encode($this->result);
    }

    //fedora
    public function actionDeleteAll()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $type = $_REQUEST['type'];
        $ids = $_REQUEST['id'];
        $uid = U_ID;
        $this->result['state'] = '0';
        $this->result['reason'] = '参数有误！';

        if (!$type || !$ids || !$uid)
            exit(json_encode($this->result));
        $fav = new SiteFavorite;
        foreach ($ids as $id) {
            $hash = md5($type . $id . $uid);
            $fav->deleteAll('hash="' . $hash . '"');
        }
        $this->result['state'] = '1';
        $this->result['reason'] = '删除成功！';
        echo json_encode($this->result);
    }


}
?>