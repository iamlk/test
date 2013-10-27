<?php
class FoodController extends BaseController
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
                'COutputCache + view,index',
                'duration'=>CACHE_TIME,
                'varyByParam'=>array('cid','id'),
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
        $model = Food::model()->findByPk($id);
        $this->params['title'] = $model['name'].'-详细介绍';
        $this->params['description'] = $model['name'].'-详细介绍';

        $model['shareCount'] = SiteShare::model()->count('object_type="Food" AND object_id=:object_id',array(':object_id'=>$id));
        $this->render('view', array('model' => $model));
    }

    /**
     * Lists all models.
     */
    public function actionIndex($cid, $id)
    {
        $dataProvider = Food::model()->findByPk($id);
        $this->params['title'] = $dataProvider['name'];
        $this->params['description'] = $dataProvider['name'];

        //推荐美食和推荐餐厅
        $db = new CDbCriteria;
        $db->addCondition('food_id=:foodID');
        $db->params[':foodID'] = $id;
        $db->order = 't.order DESC';
        $db->limit = 4;
        $restaurant = Restaurant::model()->findAll($db);
        $delicacy = Delicacy::model()->findAll($db);

        //TOP10
        $db->limit = 5;
        $roll_restaurant = Restaurant::model()->findAll($db);
        $roll_delicacy = Delicacy::model()->findAll($db);
        $roll_all = array_merge($roll_restaurant, $roll_delicacy);

        foreach($restaurant as $item)
        {
            $this->longitude[] = $item['longitude'];
            $this->latitude[] = $item['latitude'];
            $this->addressName[] = $item['title'];
        }
        foreach($delicacy as $item)
        {
            $this->longitude[] = $item['longitude'];
            $this->latitude[] = $item['latitude'];
            $this->addressName[] = $item['title'];
        }

        $this->layout = '//layouts/destination4';
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'restaurant' => $restaurant,
            'delicacy' => $delicacy,
            'roll_all' => $roll_all));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Food::model()->findByPk($id);
        if ($model === null) throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
}
