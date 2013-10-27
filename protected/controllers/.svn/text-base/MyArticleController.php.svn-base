<?php
class MyArticleController extends BaseController
{
    public $layout = '//layouts/center.mine';
    public $flag = array('selected' => null, 'select' => null);
    public $page = 3;
    public $result = array(
        'state' => null,
        'reason' => null,
        'email' => null);
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function actionIndex()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->params['title'] = '我的攻略-个人中心';
        $data = Article::model()->findAllByAttributes(array(
            'customer_id' => U_ID,
            'is_active' => 1,
            'is_delete' => 0),array('order'=>'article_id DESC'));
        //print_r($data->attributes);die;

        $dataProvider = new CArrayDataProvider($data, array('pagination' => array('pageSize' =>
                    $this->page), ));

        $this->render('index', array('data' => $dataProvider));

    }

    //我的攻略分页
    public function actionCompanion()
    {

        $data = Article::model()->findAllByAttributes(array(
            'customer_id' => U_ID,
            'is_active' => 1,
            'is_delete' => 0));

        $dataProvider = new CArrayDataProvider($data, array('pagination' => array('pageSize' =>
                    $this->page), ));
        $this->renderPartial('article_list', array('data' => $dataProvider));
    }
/*
    public function actionDelArticle()
    {

        if (isset($_REQUEST['a_id'])) {
            //执行删除操作

           //$article=Article::model()->findByAttributes(array('article_id'=>$_REQUEST['a_id'],'customer_id'=>U_ID));

          // $article->is_delete=1;

           $rs=$article->save(false);

            if ($rs) {

                Yii::app()->user->setFlash('oktips', '攻略删除成功');

                $this->redirect($this->createUrl('myArticle/index'));

            } else {

                Yii::app()->user->setFlash('errortips', '攻略删除失败');

                $this->redirect($this->createUrl('myArticle/index'));
            }

        } else {

            Yii::app()->user->setFlash('errortips', '请求的对象不存在');

            $this->redirect($this->createUrl('myArticle/index'));
        }

    }
    */
    //我的攻略详情页面
    public function actionArticleDetail()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }

        $this->layout = '//layouts/base';
        $userinfo = Customer::model()->findByPk(U_ID);
        $article = Article::model()->findByPk(intval($_REQUEST['a_id']));

        $this->render('article_detail', array('userinfo' => $userinfo->attributes,
                'article' => $article));
    }


}
?>