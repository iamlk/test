<?php
/**
 * 房子列表
 * @desc 搜索出来的房子的列表页
 */
class PropertyListController extends BaseController
{

    /** 布局 **/
    public $layout = '//layouts/product.list';

    /** 数据 **/
    public $dataProvider;
    public $queries;
    public $amenitys = array();
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
            $city = 145;// 推荐的  曼谷
            $this->redirect($this->createUrl("propertyList/index",array('city'=>$city)));
       }
        $_t_string = array();
       foreach($_REQUEST as $key => $v)
       {
        $_t_string[] = $key.'='.$v;
       }
       $this->_pre_query_string = implode('&',$_t_string);
        $filterChain->run();

    }

    /**
     * 列表：搜索的结果
     */
    public function actionIndex()
    {
        
        // 取数据
        $propertyFinder = new PropertyFinder;
        //$propertyFinder->queryString = Yii::app()->request->queryString;
        $propertyFinder->queryString = $this->_pre_query_string;
       
        $propertyFinder->execute();
        // set data
        $dataProvider = $propertyFinder->dataProvider;
        $d = $dataProvider->getData();
        //print_r($d);
        $this->queries = $propertyFinder->queries;
        $this->amenitys = $propertyFinder->amenity;
        $this->params['title'] = City::getCityName($this->queries['city']).'-度假公寓';
        if($_POST)
            $this->renderPartial('_new_index',array('dataProvider'=>$dataProvider));
        else
            $this->render('_new_index',array('dataProvider'=>$dataProvider));
        
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
        // 设施,arr
        $amenity = $this->queries['amenity'];
        if ($merge['amenity'])
        {
            if ($amenity)
            {
                array_push($amenity, $merge['amenity']);
                $amenity = array_unique($amenity);
                sort($amenity);
            }
            else  $amenity = array($merge['amenity']);
        }
        $amenity and $params['amenity'] = implode('.', $amenity);
        // 金额min,int
        $price_min = $this->queries['price_min'];
        if (isset($merge['price_min'])) $price_min = (int)$merge['price_min'];
        is_null($price_min) or $params['price_min'] = $price_min;
        // 金额max,int
        $price_max = $this->queries['price_max'];
        if (isset($merge['price_max'])) $price_max = (int)$merge['price_max'];
        is_null($price_max) or $params['price_max'] = $price_max;

        // 卧室房间
        $room = $this->queries['room'][0];
        if (isset($merge['room']))
        {
            $room = (int)$merge['room'];
          
        }
          $room && $params['room'] = $room;
        // 床位
        $bed = $this->queries['bed'][0];
        if (isset($merge['bed']))
        {
            $bed = (int)$merge['bed'];
            
        }
        $bed && $params['bed'] = $bed;
         // 浴室
        $bath = $this->queries['bath'][0];
        if (isset($merge['bath']) && $merge['bath']!='')
        {
            $bath = (int)$merge['bath'];
            
        }
        $bath && $params['bath'] = $bath;
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
        // 设施,arr
        $amenity = $this->queries['amenity'];
        if ($merge['amenity']) $amenity = array_diff($amenity, array($merge['amenity']));
        $amenity and $params['amenity'] = implode('.', $amenity);
        // 金额min,int
        $price_min = $this->queries['price_min'];
        if (isset($merge['price_min'])) $price_min = (int)$merge['price_min'];
        is_null($price_min) or $params['price_min'] = $price_min;
        // 金额max,int
        $price_max = $this->queries['price_max'];
        if (isset($merge['price_max'])) $price_max = (int)$merge['price_max'];
        is_null($price_max) or $params['price_max'] = $price_max;

         // 卧室房间
        $room = $this->queries['room'][0];
        if (isset($merge['room']))$room = array_diff($room, array($merge['room']));
        $room and $params['room'] = $room;

         //床位
        $bed = $this->queries['bed'][0];
        if (isset($merge['bed']))$bed = array_diff($bed, array($merge['bed']));
        $bed and $params['bed'] = $bed;

         // 浴室
        $bath = $this->queries['bath'][0];
        if (isset($merge['bath']))$bath = array_diff($bath, array($merge['bath']));
        $bath and $params['bath'] = $bath;

        // 返回
        return $params;
    }
    

}
