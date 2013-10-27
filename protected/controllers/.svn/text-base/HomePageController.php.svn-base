<?php
/**
 * 整理
*/
class HomePageController extends BaseController
{
    private $_type = null;
    static $_Base_Array = array('destinations'=>'destinations','products'=>'products','propertys'=>'propertys');
    static $_CACHE_TIME = 3600;
    
    
       /** 过滤器 **/
    public function filters()
    {
        return array(
            'accessControl',
            'hasType + index',
       );
   }
    /** 限制操作者 **/
    public function accessRules()
    {
        return array(
            array('allow', 'actions' => array('index')),
            );
    }
    /** 找 **/
    public function filterHasType($filterChain)
    {
       
        $type = Yii::app()->request->getParam('type');
        $type = trim(addslashes(strip_tags($type)));
        
        if(in_array($type,self::$_Base_Array))
        {
            $this->_type = $type;
        }
        if($this->_type == null)
        {
            die(json_encode(''));
        }
        $filterChain->run();
    }
    /**
     * 获取城市列表
    private function  getCityList()
    {
        return false;
        $model = Country::model()->findAll(array('select'=>'country_id','condition'=>'is_active=1'));
        $data = array();
        foreach($model as $v)
        {
            $data[$v->country_id]['id'] = $v->country_id;
            $data[$v->country_id]['name'] = $v->countryAddendumLocal->name;
            $temp_list = array();
            foreach($v->state as $sate)
            {
                foreach($sate->city as $city)
                {
                    $temp_list[$city->city_id]['name'] = $city->cityAddendumLocal->name;
                    $temp_list[$city->city_id]['id'] = $city->city_id;
                }
            }
            $data[$v->country_id]['list'][] = $temp_list;
        }
        return $data;
    }
    
    public function actionIndex()
    {
        $type = $this->_type;
        if($this->beginCache($type, array('duration'=>self::$_CACHE_TIME,'varyByParam'=>array('type')))) 
        {
            Switch($type)
            {
                case 'destinations':echo CJSON::encode(G4S::_getDestinationsList());break;
                case 'products':echo CJSON::encode(G4S::_getProductsList());break;
                case 'propertys':echo CJSON::encode(G4S::_getPropertysList());break;
            }
            
            $this->endCache();
        }
    }
    
    */
    

}
