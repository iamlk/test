<?php
class RestaurantController extends BaseController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/destination2';

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
    public function actionView($id,$cid)
    {
        $restaurant = $this->loadModel($id);
        $this->params['title'] = $restaurant['title'];
        $this->params['description'] = $restaurant['title'];

        $up_restaurant = Restaurant::model()->find(array(
            'condition' => 'restaurant_id<:restaurantID AND food_id=:foodID',
            'params' => array(':restaurantID' => $id, ':foodID' => $restaurant->food_id),
            'order' => 'restaurant_id DESC',
            ));

        $down_restaurant = Restaurant::model()->find(array(
            'condition' => 'restaurant_id>:restaurantID AND food_id=:foodID',
            'params' => array(':restaurantID' => $id, ':foodID' => $restaurant->food_id),
            ));

        $other_restaurant = Restaurant::model()->findAll(array(
            'condition' => 'food_id=:foodID',
            'params' => array(':foodID' => $restaurant->food_id),
            'order' => 'rand()',
            'limit' => 10,
            ));

        $restaurant->updateCounters(array('visit' => 1),'restaurant_id='.$restaurant['restaurant_id']);

        $this->layout = '//layouts/destination1';
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'up_restaurant' => $up_restaurant,
            'down_restaurant' => $down_restaurant,
            'other_restaurant' => $other_restaurant));
    }

    /**
     * Lists all models.
     */
    public function actionIndex($id,$cid)
    {
        $food = Food::model()->findByPk($id);
        $this->params['title'] = $food['name'].'-推荐餐厅列表';
        $this->params['description'] = $food['name'].'-推荐餐厅列表';

        $dataProvider = Restaurant::model()->getProvider(array('food_id' => $id));
        $this->render('index', array('dataProvider' => $dataProvider, 'food_id' => $id, 'food'=>$food));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Restaurant::model()->findByPk($id);
        if ($model === null) throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionAddRestaurant()
    {
        $parent_id = Yii::app()->request->getparam('parent_id');
        $restaurant_id = Yii::app()->request->getparam('restaurant_id');
        $content = Yii::app()->request->getparam('content');
        $customer_id = Yii::app()->user->customer_id;
        if(!$customer_id)
        {
            echo CJSON::encode(array('code'=>0,'msg'=>'发表失败，请先登录！'));
            return;
        }
        $restaurant = new RestaurantReview;
        $restaurant->parent_id = $parent_id;
        $restaurant->restaurant_id = $restaurant_id;
        $restaurant->content = strip_tags($content);
        $restaurant->customer_id = $customer_id;
        $restaurant->created = time();
        $restaurant->is_active = 1;
        $is_ok = $restaurant->save();
        echo CJSON::encode(array('code'=>$is_ok?1:0,'msg'=>$is_ok?'发表成功！':'发表失败，请不要为空！'));
    }
}
