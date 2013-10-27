<?php
/**
 * @author 刚  and  leo
 * @date 2013-09-5
**/
class ContentController extends BaseController
{
    public $layout = '//layouts/base';
    static $_help_id = 26;

    /**
     * add leo 加入缓存
    **/
    public function filters()
    {
        return array(
                array(
                    'COutputCache + index,item,list,attration,aitem',
                    'duration'=>CACHE_TIME,
                    'varyByParam'=>array('id','qpage'),
                    'varyBySession'=>true,
                    'cacheID'=>'cache',
            ),
        );
    }

    public function actionIndex($id)
    {
        $other = SiteOptionGroup::model()->findAllByAttributes(array('parent_group_id'=>11,'is_active'=>1));
        $model = SiteOption::model()->findByPk($id);


        $this->breadcrumbs->add('首页','/');
        $this->breadcrumbs->add('帮助中心',$this->createUrl('content/index',array('id'=>self::$_help_id)));
        $this->breadcrumbs->add($model->title);
        $this->params['title'] = $model->title.'-帮助中心';

        $this->render('index',array('model'=>$model,'other'=>$other));

    }

    /**
     *  add by leo   目的地指南
    **/
    public function actionItem()
    {


        $this->breadcrumbs->add('首页','/');
        $this->breadcrumbs->add('帮助中心',$this->createUrl('content/index',array('id'=>self::$_help_id)));
        $this->breadcrumbs->add('目的地指南');
        $this->params['title'] = '目的地指南-出行相关';
        $country_city = Country::model()->getPopWindow();

        foreach($country_city as &$val)
        {
            $_city_list = isset($val['list'])? array_keys($val['list']):array();
            if($_city_list)
            {
                 //获取对应城市目的地
                $val['data'] = City::getItemList($_city_list);
            }
        }

        //print_r($country_city);die;

        $this->render('item',array('country_city'=>$country_city));

    }

    /**
     *  add by leo
     * @id 国家id
     * 目的在详情列表
    **/
    public function actionList($id)
    {

        $this->breadcrumbs->add('首页','/');
        $this->breadcrumbs->add('帮助中心',$this->createUrl('content/index',array('id'=>self::$_help_id)));
        $this->breadcrumbs->add('目的地指南',$this->createUrl('content/item'));

         //获取对应城市目的地
        $data= City::getItemListDetail($id);
        $this->breadcrumbs->add($data['name']);
        $this->params['title'] = $data['name'].'-更多出行相关';

        $this->render('list',array('dataProvider'=>$data['data']));

    }

    /**
     *  add by leo  景点指南
    **/
    public function actionAttration()
    {

        $this->breadcrumbs->add('首页','/');
      $this->breadcrumbs->add('帮助中心',$this->createUrl('content/index',array('id'=>self::$_help_id)));
        $this->breadcrumbs->add('所有景点');
        $this->params['title'] = '所有景点-出行相关';
        $country_city = Country::model()->getPopWindow();
        $_city_list = array();
        foreach($country_city as $val)
        {
           if($val['list'])
           {
                foreach($val['list'] as $key=>$val)
                {
                    $_city_list[] = array('id'=>$key,'name'=>$val);
                }
           }
        }

        foreach($_city_list as  &$value)
        {

            $value['data'] = $value['id'] ? Attraction::getItemList($value['id']) : array();
            $_list = array();
            if( $value['data'])
            {
                foreach( $value['data'] as $_val)
                {
                    $_list[] = array($_val['attraction_id']=>$_val['attraction_name']);
                }
            }

            $value['list'] = $_list;


        }

        //print_r($_city_list);die;

        $this->render('attration',array('city_list'=>$_city_list));

    }

    /**
     *  add by leo
     * @id 城市 id
     * 景点城市在详情列表
    **/
    public function actionAitem($id)
    {

         //获取对应城市目的地
        $dataProvider= Attraction::getItemListDetail($id);

        $this->breadcrumbs->add('首页','/');
       $this->breadcrumbs->add('帮助中心',$this->createUrl('content/index',array('id'=>self::$_help_id)));
        $this->breadcrumbs->add('所有景点',$this->createUrl('content/attration'));
        $city_name = City::getCityName($id);
         //获取对应城市目的地
        $this->breadcrumbs->add($city_name);
        $this->params['title'] = $city_name.'-更多所有景点';

        $this->render('aitem',array('dataProvider'=>$dataProvider));

    }







}
?>