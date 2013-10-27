<?php
class AttractionController extends BaseController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/destination1';
    public $longitude;
    public $latitude;
    public $addressName;

    /**
     * add leo 加入缓存
    **/
    public function filters()
    {
        return array(
            array(
                'COutputCache + view,index,list',
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
    public function actionView($id,$cid)
    {
        $id = intval($id);
        $cid = intval($cid);

        $model = $this->loadModel($id);
        $this->params['title'] = $model['name'].'-详细介绍';
        $this->params['description'] = $model['name'].'-详细介绍';

        $relations = $this->getRelations($model);
        $model['shareCount'] = SiteShare::model()->count('object_type="Attraction" AND object_id=:object_id',array(':object_id'=>$id));
        $this->render('view', array('model' => $model, 'relations'=>$relations));
    }

    /**
     * Lists all models.
     */
    public function actionIndex($id, $cid)
    {
        $id = intval($id);
        $cid = intval($cid);

        $dataProvider = Attraction::model()->findByPk($id);
        $this->params['title'] = $dataProvider['name'];
        $this->params['description'] = $dataProvider['name'];

        $attraction = $this->getAllAttraction($dataProvider);
        extract($attraction);
        rsort($allAttractions);


        $db = new CDbCriteria;
        $db->addCondition('attraction_id=:attractionID');
        $db->params[':attractionID'] = $id;
        $db->limit = 6;
        $others['customer'] = AttractionVisitor::model()->findAll($db);
        $db->limit;
        $others['sum'] = AttractionVisitor::model()->count($db);
        $others['parentName'] = $parentName;
        $others['allAttractions'] = count($allAttractions);
        $others['currentOrder'] = array_search($dataProvider->visitors, $allAttractions)+1;
        $model = Attraction::model()->findByPk($id);

        $relations = $this->getRelations($dataProvider);

        $this->longitude = array($dataProvider['longitude']);
        $this->latitude = array($dataProvider['latitude']);
        $this->addressName = array($dataProvider['name']);

        //度假公寓
        $criteria = new CDbCriteria;
        $criteria->addCondition('t.city_id=:city_id');
        $criteria->addCondition('goods.is_active=1');
        $criteria->addCondition('t.goods_id>1');
        $criteria->params[':city_id'] = $cid;
        $criteria->order = 't.property_id DESC';
        $criteria->limit = 4;
        $propertys = Property::model()->with('goods')->findAll($criteria);

        //短期行程
        $first = "(SELECT product_id FROM ".ProductStartCity::model()->tableName()." WHERE city_id=".$cid.")";
        $second = "(SELECT c1.product_id, p.goods_id FROM product AS p INNER JOIN ".$first." AS c1 ON c1.product_id = p.product_id WHERE p.goods_id>1)";
        $thirth = "(SELECT c2.product_id, c2.goods_id, g.price FROM goods AS g INNER JOIN ".$second." AS c2 ON g.goods_id = c2.goods_id WHERE g.is_active=1)";
        $fourth = "(SELECT c3.product_id, c3.goods_id, c3.price, pd.title FROM product_addendum AS pd INNER JOIN ".$thirth." AS c3 ON c3.product_id = pd.product_id)";
        $products = Yii::app()->db->createCommand()
                                  ->select('c4.product_id, c4.price, c4.title, t.path, c4.goods_id')
                                  ->from(ProductImage::tableName().' t')
                                  ->join($fourth." AS c4 ON c4.product_id = t.product_id")
                                  ->group('c4.product_id')
                                  ->order('c4.product_id DESC')
                                  ->limit(4)
                                  ->queryAll();

        $this->layout = '/layouts/destination3';
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'others' => $others,
            'relations' => $relations,
            'model' => $model,
            'propertys' => $propertys,
            'products' => $products));
    }

    public function actionList($cid)
    {
        $cid = intval($cid);

        $dataProvider = Attraction::model()->getProvider(array('parent_type' => 3, 'parent_id'=> $cid, 'is_active'=> 1));
        $this->params['title'] = City::model()->getCityName($cid).'-景点列表';
        $this->params['description'] = City::model()->getCityName($cid).'-景点列表';

        $this->layout = '//layouts/food_recommend';
        $this->render('list', array('dataProvider' => $dataProvider));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $id = intval($id);

        $model = Attraction::model()->findByPk($id);
        if ($model === null) throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionAddAttraction()
    {
        $parent_id = Yii::app()->request->getparam('parent_id');
        $attraction_id = Yii::app()->request->getparam('attraction_id');
        $content = Yii::app()->request->getparam('content');
        $customer_id = Yii::app()->user->customer_id;
        if(!$customer_id)
        {
            echo CJSON::encode(array('code'=>0,'msg'=>'发表失败，请先登录！'));
            return;
        }
        $attraction = new AttractionReview;
        $attraction->parent_id = $parent_id;
        $attraction->attraction_id = $attraction_id;
        $attraction->content = strip_tags($content);
        $attraction->customer_id = $customer_id;
        $attraction->created = time();
        $attraction->is_active = 1;
        $is_ok = $attraction->save();
        echo CJSON::encode(array('code'=>$is_ok?1:0,'msg'=>$is_ok?'发表成功！':'发表失败，请不要为空！'));
    }

    private function getAllAttraction($model)
    {
        switch ($model['parent_type'])
        {
            case 1:$model = Country::model()->findByPk($model['parent_id']);$level = 2;break;
            case 2:$model = State::model()->findByPk($model['parent_id']);$level = 3;break;
            case 3:$model = City::model()->findByPk($model['parent_id']);$level = 4;break;
        }
        return array('allAttractions'=>$this->_getAllAttraction($model, $level), 'parentName'=>$model['name']);

    }

    private function _getAllAttraction($model, &$level = 1, &$_a = array())
    {
        $type = array(
            '1' => 'country',
            '2' => 'state',
            '3' => 'city',
            '4' => 'attraction');

        $next = $type[$level + 1];
        $obj = $model->$type[$level];

        foreach ($model->attraction as $attraction)
        {
            $_a[] = $attraction['visitors'];
        }

        foreach ($obj as $item)
        {
            if (isset($item->$next))
            {
                $this->_getAllAttraction($item, ++$level, $_a);
            }
        }
        --$level;
        return $_a;
    }

    private function getRelations($model)
    {
        Switch($model['parent_type'])
        {
            case 1:return Country::model()->findByPk($model['parent_id']);
            case 2:return State::model()->findByPk($model['parent_id']);
            case 3:return City::model()->findByPk($model['parent_id']);
        }
    }

    public function actionReviewPages()
    {
        $id = Yii::app()->request->getParam('id');
        $model = Attraction::model()->findByPk($id);
        $this->renderPartial('attraction_review_list',array('model'=>$model));
    }

    public function actionArrivedAttraction()
    {
        $_a['attraction_id'] = Yii::app()->request->getParam('id');
        $_a['customer_id'] = Yii::app()->user->customer_id;

        $model = new AttractionVisitor();
        $model->attributes = $_a;
        if($model->save())
        {
            $customer = Customer::model()->findByPk($model['customer_id']);
            echo CJSON::encode(array('status'=>'success','msg'=>'<a href="'.Dynamic::goUrl($customer['customer_id'],'center').'"><img src="'.Yii::app()->assetManager->baseUrl.'/'.$customer['avator'].'" alt="'.$customer['nick_name'].'" /></a>'));
        }else{
            echo CJSON::encode(array('status'=>'fail'));
        }
    }
}
