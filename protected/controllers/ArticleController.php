<?php
class ArticleController extends BaseController
{
    public $page;
    public $operation;

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
                'cacheID'=>'cache'
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $id = intval($id);

        $model = Article::model()->find(array('condition'=>'article_id=:article_id AND is_active=1 AND is_delete=0 AND draft=0','params'=>array(':article_id'=>$id)));
        if(empty($model))
        {
            $this->redirect('site/error');
        }
        $this->params['title'] = $model['title'];
        $this->params['description'] = $model['title'];

        $this->params['description'] = strip_tags($model['content']);
        $this->params['title'] = $model['title'];
        $model->updateCounters(array('visit' => 1));
        $this->render('view', array('article' => $model));
    }

    public function actionReviews($id)
    {
        $id = intval($id);

        $model = Article::model()->findByPk($id);
        $this->renderPartial('reviews', array('model' => $model));
    }

    public function actionAddArticle()
    {
        $parent_id = Yii::app()->request->getparam('parent_id');
        $article_id = Yii::app()->request->getparam('article_id');
        $content = Yii::app()->request->getparam('content');
        $customer_id = Yii::app()->user->customer_id;
        if (!$customer_id) {
            echo CJSON::encode(array('code' => 0, 'msg' => '请先登录！'));
            return;
        }

        $article = new ArticleReview;
        $article->parent_id = $parent_id;
        $article->article_id = $article_id;
        $article->content = strip_tags($content);
        $article->customer_id = $customer_id;
        $article->created = time();
        $article->is_active = 1;
        $is_ok = $article->save();
        echo CJSON::encode(array('code' => $is_ok ? 1 : 0, 'msg' => $is_ok ?'发表成功！' : '发表失败，请不要为空！'));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Article;
        $this->operation = 'create';

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['cid']) && isset($_POST['title']) && isset($_POST['content'])) {
            if (!Yii::app()->user->customer_id) {
                echo CJSON::encode(array('code' => 0, 'msg' => '请先登录!'));
                return;
            }
            if (empty($_POST['cid'])) {
                echo CJSON::encode(array('code' => 0, 'msg' => '请至少为攻略关联一个目的地!'));
                return;
            }
            if (empty($_POST['title'])) {
                echo CJSON::encode(array('code' => 0, 'msg' => '标题不能为空!'));
                return;
            }
            if (empty($_POST['content'])) {
                echo CJSON::encode(array('code' => 0, 'msg' => '内容不能为空!'));
                return;
            }

            $model->customer_id = Yii::app()->user->customer_id;
            $model->created = $model->updated = time();
            $model->order = 0;
            $model->is_active = 0;
            $model->city_id = 0;
            $model->draft = 0;
            //$model->image = Yii::app()->assetManager->makeAssetFileUrl($_FILES['photo']['tmp_name'], time(), 'article/image', '.jpg');
            $model->image = '---';
            $is_ok = $model->save();
            echo CJSON::encode(array('code' => ($is_ok ? 1 : 0), 'msg' => $is_ok ?
                    '谢谢，攻略发布成功，网站相关人员将在24小时内审核！' : '对不起，攻略发布失败，请稍后再试!'));
            return;
        }
        $this->params['title'] = '攻略发布';
        $this->render('create', array('model' => $model));
    }

    /**
     * 保存草稿
     */
    public function actionDraft()
    {
        $model = new Article;

        if (isset($_POST['cid']) && isset($_POST['title']) && isset($_POST['content'])) {
            if (!Yii::app()->user->customer_id) {
                echo CJSON::encode(array('code' => 0, 'msg' => '请先登录!'));
                return;
            }
            if (empty($_POST['cid'])) {
                echo CJSON::encode(array('code' => 0, 'msg' => '请至少为攻略关联一个目的地!'));
                return;
            }
            if (empty($_POST['title'])) {
                echo CJSON::encode(array('code' => 0, 'msg' => '标题不能为空!'));
                return;
            }
            if (empty($_POST['content'])) {
                echo CJSON::encode(array('code' => 0, 'msg' => '内容不能为空!'));
                return;
            }

            $model->customer_id = Yii::app()->user->customer_id;
            $model->created = $model->updated = time();
            $model->order = 0;
            $model->is_active = 1;
            $model->city_id = 0;
            $model->draft = 1;
            //$model->image = Yii::app()->assetManager->makeAssetFileUrl($_FILES['photo']['tmp_name'], time(), 'article/image', '.jpg');
            $model->image = '---';
            $is_ok = $model->save();
            echo CJSON::encode(array('code' => ($is_ok ? 1 : 0), 'msg' => $is_ok ?
                    '谢谢，已经存为草稿！' : '对不起，保存失败，请稍后再试!'));
            return;
        }
    }


    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $id = intval($id);

        $model = $this->loadModel($id);
        $this->operation = 'update';

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['cid']) && isset($_POST['title']) && isset($_POST['content'])) {
            if (!Yii::app()->user->customer_id) {
                echo CJSON::encode(array('code' => 0, 'msg' => '请先登录!'));
                return;
            }
            if (empty($_POST['cid'])) {
                echo CJSON::encode(array('code' => 0, 'msg' => '请至少为攻略关联一个目的地!'));
                return;
            }
            if (empty($_POST['title'])) {
                echo CJSON::encode(array('code' => 0, 'msg' => '标题不能为空!'));
                return;
            }
            if (empty($_POST['content'])) {
                echo CJSON::encode(array('code' => 0, 'msg' => '内容不能为空!'));
                return;
            }
            $model->updated = time();
            $model->draft = 0;
            $is_ok = $model->save();
            echo CJSON::encode(array('code' => ($is_ok ? 1 : 0), 'msg' => $is_ok ?
                    '谢谢，攻略编辑成功，网站相关人员将在24小时内审核！' : '对不起，攻略编辑失败，请稍后再试!'));
            return;
        }
         $this->params['title'] = '攻略修改';
        $this->render('update', array('model' => $model));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $id = intval($id);

        $model = $this->loadModel($id);
        if (U_ID == $model['customer_id']) {
            $model->is_delete = 1;
            $is_ok = $model->save(false);
            echo json_encode(array('state'=>$is_ok?1:0,'reason'=>$is_ok?'删除成功':'你无权删除'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex($cid)
    {
        $cid = intval($cid);

        $city = City::model()->findByPk($cid);

        $this->params['title'] = $city['name'].'-热门攻略列表';
        $this->params['description'] = $city['name'].'-热门攻略列表';

        $provider = ArticleCity::model()->getProvider(array('t.city_id'=>$cid,'article.draft'=>0,'article.is_active'=>1,'article.is_delete'=>0));

        $this->layout = 'article_left';
        $this->render('index', array(
            'provider' => $provider,
            'city_id' => $cid,
            'city' => $city));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $id = intval($id);

        $model = Article::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionAjaxget()
    {
        $respon = array();
        $key = trim($_GET["key"]);
        $respon = City::model()->searchAttraction(array('name' => $key));
        foreach ($respon as &$v) {
            $v['id'] = $v["attraction_id"];
        }

        echo json_encode($respon);
        die;
    }
}
