<?php

class DelicacyController extends BaseController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/food_recommend';

    /**
     * add leo 加入缓存
    **/
    public function filters()
    {
        return array(
            array(
                'COutputCache + view,index',
                'duration'=>CACHE_TIME,
                'varyByParam'=>array('cid','id','qpage'),
                'varyBySession'=>true,
                'cacheID'=>'cacheDelicacy'
            ),
        );
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id,$cid)
	{
        $delicacy = $this->loadModel($id);
        $this->params['title'] = $delicacy['title'];
        $this->params['description'] = $delicacy['title'];

        $up_delicacy = Delicacy::model()->find(array(
            'condition' => 'delicacy_id<:delicacyID AND food_id=:foodID',
            'params' => array(':delicacyID' => $id, ':foodID' => $delicacy->food_id),
            'order' => 'delicacy_id DESC',
            ));

        $down_delicacy = Delicacy::model()->find(array(
            'condition' => 'delicacy_id>:delicacyID AND food_id=:foodID',
            'params' => array(':delicacyID' => $id, ':foodID' => $delicacy->food_id),
            ));

        $other_delicacy = Delicacy::model()->findAll(array(
            'condition' => 'food_id=:foodID',
            'params' => array(':foodID' => $delicacy->food_id),
            'order' => 'rand()',
            'limit' => 10,
            ));

        $delicacy->updateCounters(array('visit' => 1),'delicacy_id='.$delicacy['delicacy_id']);

        $this->layout = '//layouts/destination1';
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'up_delicacy' => $up_delicacy,
            'down_delicacy' => $down_delicacy,
            'other_delicacy' => $other_delicacy));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($id,$cid)
	{
	    $food = Food::model()->findByPk($id);
        $this->params['title'] = $food['name'].'-推荐美食列表';
        $this->params['description'] = $food['name'].'-推荐美食列表';
        $dataProvider = Delicacy::model()->getProvider(array('food_id' => $id));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'food'=>$food,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Delicacy::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


    public function actionAddDelicacy()
    {
        $parent_id = Yii::app()->request->getparam('parent_id');
        $delicacy_id = Yii::app()->request->getparam('delicacy_id');
        $content = Yii::app()->request->getparam('content');
        $customer_id = Yii::app()->user->customer_id;
        if(!$customer_id)
        {
            echo CJSON::encode(array('code'=>0,'msg'=>'发表失败，请先登录！'));
            return;
        }
        $delicacy = new DelicacyReview;
        $delicacy->parent_id = $parent_id;
        $delicacy->delicacy_id = $delicacy_id;
        $delicacy->content = strip_tags($content);
        $delicacy->customer_id = $customer_id;
        $delicacy->created = time();
        $delicacy->is_active = 1;
        $is_ok = $delicacy->save();
        echo CJSON::encode(array('code'=>$is_ok?1:0,'msg'=>$is_ok?'发表成功！':'发表失败，请不要为空！'));
    }
}
