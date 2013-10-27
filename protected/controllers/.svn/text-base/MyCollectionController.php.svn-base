<?php
class MyCollectionController extends BaseController
{
    public $layout = '//layouts/center.mine';
    public $flag = array('selected' => null, 'select' => null);
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
        $this->flag['selected'] = 'mycollection';
        $data = Article::model()->getProvider(array("customer_id" => 11));

        $this->render('index', array('data' => $data));

    }

  
}
?>