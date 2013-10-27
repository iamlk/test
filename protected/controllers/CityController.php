<?php
class CityController extends BaseController
{


    public $layout = '//layouts/destination1';
    private $_city = null;


    /**
     * add leo 加入缓存
    **/
    public function filters()
    {
        return array(
            'accessControl',
            'hasCity + view,index',
            array(
                'COutputCache + view,index',
                'duration'=>CACHE_TIME,
                'varyByParam'=>array('cid'),
                'varyBySession'=>false,
                'cacheID'=>'cache',
                //'varyByExpression'=>'$user->isGuest',
               /* 'dependency'=>array(
                        'class'=>'system.caching.dependencies.CGlobalStateCacheDependency',
                        'stateName'=>'customer_id'
                ),*/
            ),
        );
    }

    /** 限制操作者 **/
    public function accessRules()
    {
        return array(
                array('allow', 'users' => array('*')),
            );
    }
    /** 是否存在 **/
    public function filterHasCity($filterChain)
    {
       //echo Yii::app()->request->getParam('cid');die;
        $this->_city = City::model()->findByPk((int)Yii::app()->request->getParam('cid'));
        if ($this->_city == null)
        {
             $this->redirect('/');
        }
        $filterChain->run();

    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($cid)
    {
        //$cid = intval($cid);
        //$city = City::model()->findByPk($cid);
        $city = $this->_city;
        $this->params['title'] = $city['name'].'-详细介绍';
        $this->params['description'] = $city['name'].'-详细介绍';

        $city['shareCount'] = SiteShare::model()->count('object_type="City" AND object_id=:object_id',array(':object_id'=>$cid));
        $this->render('view', array('model' => $city));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        //$cid = intval($cid);
        //$city = City::model()->findByPk($cid);
        $city = $this->_city;
        $cid = $city->city_id;
        $this->params['title'] = $city['name'];
        $this->params['description'] = $city['name'];

        //度假公寓
        $propertys = null;
        $criteria = new CDbCriteria;
        $criteria->addCondition('t.city_id=:city_id');
        $criteria->addCondition('goods.is_active=1');
        $criteria->addCondition('t.goods_id>1');
        $criteria->params[':city_id'] = $cid;
        $criteria->order = 'goods.goods_id DESC';
        $criteria->limit = 4;
        $propertys = Property::model()->with('goods')->findAll($criteria);

        $products = null;
        $criteria = new CDbCriteria;
        $criteria->alias='product';
        $criteria->with = array('goods','productStartCity');
        $criteria->addCondition('goods.is_active=1');
        $criteria->addCondition('productStartCity.city_id='.$cid);
        $criteria->order = 'goods.goods_id desc';
        $criteria->limit = 4;
        $products = Product::model()->findAll($criteria);

        $this->layout = '//layouts/destination2';
        $this->render('index', array('city' => $city, 'products'=>$products, 'propertys'=>$propertys));

    }

}
