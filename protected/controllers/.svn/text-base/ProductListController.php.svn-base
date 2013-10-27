<?php
/**
 * 产品列表
 * @desc 搜索出来的产品的列表页
 */
class ProductListController extends BaseController
{
    public $layout = '//layouts/product.list';
    /**
     * Lists all models.
     */
    public $queries;
    
    private $_pre_query_string;
    
    
     /** 过滤器 **/
    public function filters()
    {
        return array(
            'accessControl',
            'hasCity + index',
            //'ajaxOnly + showPrice',
            );
    }
    /** 限制操作者 **/
    public function accessRules()
    {
        return array(
            array('allow', 'actions' => array('index')),
            array('deny'),
            );
    }
     /** 需要指定城市 **/
    public function filterHasCity($filterChain)
    {
       $city = (int)Yii::app()->request->getParam('city');
       if(!$city)
       {
            $city = 136;// 推荐的
            $this->redirect($this->createUrl("productList/index",array('city'=>$city)));
       }
       $_t_string = array();
       foreach($_REQUEST as $key => $v)
       {
        $_t_string[] = $key.'='.$v;
       }
       $this->_pre_query_string = implode('&',$_t_string);
        $filterChain->run();
    }
    
    
    public function actionIndex()
    {
        // 新对象
        $productFinder = new ProductFinder;
        // 设置
        
        //print_r($_REQUEST);
        //$productFinder->queryString = Yii::app()->request->queryString;
        $productFinder->queryString = $this->_pre_query_string;
        //echo $this->_pre_query_string;
        //echo Yii::app()->request->queryString;die;
        //$productFinder->_queries['ddd'] = 'ssssss';
        // 执行
        $productFinder->execute();
        
        // 获取数据
        $this->queries = $productFinder->queries;
        
        //print_r($this->queries);
       
        $filterData = $productFinder->filterData;

        $dataProvider = $productFinder->dataProvider;
        
        $this->params['title'] = City::getCityName(intval($this->queries['city'])).'-我能做的';
        if($_POST)
            $this->renderPartial('index', array('dataProvider' => $dataProvider,'filterData'=>$filterData));
        else
            $this->render('index', array('dataProvider' => $dataProvider,'filterData'=>$filterData));
    }

     /**
     * 合并参数
     */
    public function mergeParams($merge = array())
    {
        $params = array();

        // 城市
        $city = $this->queries['city'];
        if($city)
        {
            $params['city']=$city;
        }

        // 类型,arr
        $type = $this->queries['type'];
        if ($merge['type'])
        {
            if ($type)
            {
                array_push($type, $merge['type']);
                $type = array_unique($type);
                sort($type);
            }
            else  $type = array($merge['type']);
        }
        $type and $params['type'] = implode('.', $type);
        // 景点
        $amenity = $this->queries['attraction'];
        if ($merge['attraction'])
        {
            if ($amenity)
            {
                array_push($amenity, $merge['attraction']);
                $amenity = array_unique($amenity);
                sort($amenity);
            }
            else  $amenity = array($merge['attraction']);
        }
        $amenity and $params['attraction'] = implode('.', $amenity);
        // 持续时间
        $delayTime = $this->queries['day'];
        if ($merge['day'])
        {
            if ($delayTime)
            {
                array_push($delayTime, $merge['day']);
                $amenity = array_unique($delayTime);
                sort($delayTime);
            }
            else  $delayTime = array($merge['day']);
        }
        $delayTime and $params['day'] = implode('.', $delayTime);

        // 返回
        return $params;
    }

    /**
     * 去掉参数
     */
    public function shiftParams($merge = array())
    {
        $params = array();
        // 城市
        $city = $this->queries['city'];
        if($city)
        {
            $params['city']=$city;
        }
        // 类型,arr
        $type = $this->queries['type'];
        if ($merge['type']) $type = array_diff($type, array($merge['type']));
        $type and $params['type'] = implode('.', $type);
        // 景点
        $amenity = $this->queries['attraction'];
        if ($merge['attraction']) $amenity = array_diff($amenity, array($merge['attraction']));
        $amenity and $params['attraction'] = implode('.', $amenity);
        // 持续时间
        $dayTime = $this->queries['day'];
        if ($merge['day']) $dayTime = array_diff($dayTime, array($merge['day']));
        $dayTime and $params['day'] = implode('.', $dayTime);

        // 返回
        return $params;
    }

    /**
     *
     *
     */
    public function actionAjaxPostReview()
    {
        $product_id = (int)Yii::app()->request->getParam('product_id');
        $review_title = Yii::app()->request->getParam('review_title');
        $review_content = Yii::app()->request->getParam('review_content');
        $customer_id = Yii::app()->user->id;
        //double_submit => deny
        $criteria = new CDbCriteria();
        $criteria->addCondition('product_id=:product_id');
        $criteria->params[':product_id'] = $product_id;
        $criteria->addCondition('name=:review_title OR description=:review_content');
        $criteria->params[':review_title'] = $review_title;
        $criteria->params[':review_content'] = $review_content;
        $criteria->addCondition('customer_id=:customer_id');
        $criteria->params[':customer_id'] = $customer_id;
        $has = ProductReview::model()->count($criteria);
        if ($has)
        {
            echo CJSON::encode(array('code' => 0, 'msg' => '对不起，请不要重复评论！'));
            Yii::app()->end();
        }
        //rating  rules by vincent
        $fit_the_description = min(5, max(1, (int)Yii::app()->request->getParam('fit_the_description'))) * 20;
        $communication = min(5, max(1, (int)Yii::app()->request->getParam('communication'))) * 20;
        $on_time_travel = min(5, max(1, (int)Yii::app()->request->getParam('on_time_travel'))) * 20;
        $cost_performance = min(5, max(1, (int)Yii::app()->request->getParam('cost_performance'))) * 20;

        $rating_total = min(100, ((int)($fit_the_description + $communication + $on_time_travel + $cost_performance) / 4));

        $rating_0 = $rating_1 = (int)($rating_total * 0.2);
        $rating_2 = $rating_3 = $rating_4 = (int)($rating_total * 0.15);
        $rating_5 = $rating_total - ($rating_0 + $rating_1 + $rating_2 + $rating_3 + $rating_4);
        //insert to review  use Review API
        $_r = new ProductReview;
        $_r->is_active = 0;
        $_r->product_id = $product_id;
        $_r->customer_id = $customer_id;
        $_r->rating_1 = $fit_the_description;
        $_r->rating_2 = $communication;
        $_r->rating_3 = $on_time_travel;
        $_r->rating_4 = $cost_performance;
        $isok = $_r->saveReviewInfo($review_title, $review_content);
        echo CJSON::encode(array('code' => ($isok?1:0), 'msg' => $isok?'谢谢，评论成功！':'对不起，评论失败！'.__LINE__));
        Yii::app()->end();
    }
}
