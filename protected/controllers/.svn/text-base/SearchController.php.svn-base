<?php
/**
 * 
 *  @note 搜索控制
 *  @author leo
 */
class SearchController extends BaseController
{

    /** 布局 **/
    public $layout = '//layouts/base';
    
    public $_key = '';// 搜索关键字
    
    public $_act = 'all';//代表全部
    
    public $_data = null;
    
    const _MAX_WORD_LEN = 50;//关键字最大长度
    
    // 其他项分页
    public static $_PAGE_SIZE = 5;
    // 景点项分页
    public static $_PAGE_SIZE_ATTRIACTION = 10;
    // 搜索分页
    public static $_PAGE_SIZE_SEARCH = 5;
    
    
       /** 过滤器 **/
    public function filters()
    {
        return array(
            'accessControl',
            'hasWord + index,ajaxGet',
            
              array(
                    'COutputCache + index,ajaxGet',
                    'duration'      =>  60,
                    'varyByParam'   =>  array('key','page','act'),
                    'varyBySession' => true,
                    'cacheID'=>'cache'
                        ),
            );
    }
    /** 限制操作者 **/
    public function accessRules()
    {
        return array(
            array('allow', 'actions' => array('index','ajaxGet')),
            );
    }
    /** 找商品 **/
    public function filterHasWord($filterChain)
    {
        // 房子.主表 // 必须要指定哪个房子
        $key= Yii::app()->request->getParam('key');
        $key = trim(addslashes(strip_tags($key)));
        if(mb_strlen($key,'utf8')>self::_MAX_WORD_LEN)
        {
            $key = mb_substr($key,0,self::_MAX_WORD_LEN,'utf-8');
        }
        $this->_key = $key;
        
        $act = trim(Yii::app()->request->getParam('act'));
        
        if(in_array($act,Keywords::$_ACT_ARR))
        {
           $this->_act = $act;
        }
        
        $this->_data = Keywords::model()->getTotalData($this->_key,true);
        $filterChain->run();
    }
  
    public function actionIndex()
    {
        
    
        $return = $this->_data;
        $count = $key_ids =  $respon = array();
        foreach($return as $k=>$v)
        {
            $count[$k]= isset($v['count'])?$v['count']:0;
            $key_ids[$k] = isset($v['data'])?array_keys($v['data']):array();
        }
        
        //print_r($return);die;
     
        /** 搜索项 **/  
        if(in_array($this->_act,Keywords::$_ACT_ARR))
        {
            // 进入选项
            $md5_key = md5(json_encode(array($this->_act,$count)));
            $_item = '';
            if(Keywords::_IS_CACHE_DEBUG)
            {
                $_item_json = Yii::app()->cache->get($md5_key);
                if($_item_json)
                {
                   $_item = json_decode($_item_json); 
                }
                
            }
            if(empty($_item))
            {
               $_item = $this->getItem($this->_act,$count);
               Yii::app()->cache->set($md5_key,json_decode($_item),Keywords::_CACHE_OUT_TIME);  
            }
            echo $_item;
            Yii::app()->end(0,true);
        }
       
        /** 算法搜索全部**/
        // 默认
        $now_page = (int)Yii::app()->request->getParam('page');
        $now_page = $now_page ?$now_page:1; 
        $_data_all = $this->convert($count,$return);
        $now_page = $now_page>count($_data_all)?count($_data_all):$now_page;
        if($_data_all[$now_page-1])
        {
           $respon =  $this->getDataModels($_data_all[$now_page-1]);
        }
       $pager = new CPagination(array_sum($count));    
       $pager->pageSize = self::$_PAGE_SIZE_SEARCH; 
       $this->params['title'] = $this->_key.'-全部搜索';
       $this->render('index',array('count'=>$count,'data'=>$respon,'pages'=>$pager));
    }
    
    /**
     * 获取单页model数据
    **/
    private function getDataModels($data)
    {
        $_md5_key = md5(json_encode($data));
        //用于存放对象数组
        $respon = array();//
        
        if(Keywords::_IS_CACHE_DEBUG)
        {
            $respon_json = Yii::app()->cache->get($_md5_key);
            if($respon_json)
            {
                $respon = json_decode($respon_json,true);
            }
            
        }
        if(empty($respon))
        {
               foreach($data as $key=>$value)
                {
                   $_tp = explode("_",$key);
                   $id  = intval($value);
                   
                   switch(trim($_tp[0]))
                   {
                      case Keywords::$_ACT_ARR[0]:
                      {
                        // 行程
                        
                        $criteria = new CDbCriteria();
                        $criteria->alias = 'product';
                        $criteria->addCondition("product.product_id = $id");
                        $respon[] = Product::model()->find($criteria);
                      }
                      break;
                      case Keywords::$_ACT_ARR[1]:
                      {
                        // 住房
                        $criteria = new CDbCriteria();
                        $criteria->alias = 'property';
                        $criteria->addCondition("property.property_id = $id");
                        $respon[] = Property::model()->find($criteria);
                      }
                      break;
                      case Keywords::$_ACT_ARR[2]:
                      {
                        // 景点
                        $criteria = new CDbCriteria();
                        $criteria->alias = 'attraction';
                        $criteria->addCondition("attraction.attraction_id = $id");
                        $respon[] = Attraction::model()->find($criteria);
                      }
                      break;
                      case Keywords::$_ACT_ARR[3]:
                      {
                        // 分享行程单   
                        /** 还没做哟**/
                        $criteria = new CDbCriteria();
                        $criteria->alias = 'itinerary';
                        $criteria->addCondition("itinerary_id = $id");
                        $respon[] = Itinerary::model()->find($criteria);
                      }
                      break;
                      case Keywords::$_ACT_ARR[4]:
                      {
                        // 攻略
                        $criteria = new CDbCriteria();
                        $criteria->alias = 'article';
                        $criteria->addCondition("article.article_id = $id");
                        $respon[] = Article::model()->find($criteria);
                      }
                      break;
                      case Keywords::$_ACT_ARR[5]:
                      {
                        // 结伴同游
                        /** 此功能取消了**/
                        
                      }
                      break;
                      case Keywords::$_ACT_ARR[6]:
                      {
                        // 美食
                        $criteria = new CDbCriteria();
                        $criteria->alias = 'food';
                        $criteria->addCondition("food.food_id = $id");
                        $respon[] = Food::model()->find($criteria);
                      }
                      break;
                      case Keywords::$_ACT_ARR[7]:
                      {
                        // 目的地  城市
                        $criteria = new CDbCriteria();
                        $criteria->alias = 'city';
                        $criteria->addCondition("city.city_id = $id");
                        $respon[] = City::model()->find($criteria);
                      }
                      break;
                   } 
                }  
        }
        
        
        if($respon)
        {
            Yii::app()->cache->set($_md5_key,json_encode($respon),Keywords::_CACHE_OUT_TIME);
        }
        
        return $respon;
    }
    
    /**
     * 搜索列表分页算法
    */
    private function convert($count,$return)
    {
        
          asort($count);
          $_key_to_ids_combin = array();
          foreach($count as $key => $v)
          {
            if($v != 0)
            {
                $_t_ids = $return[$key]['id'];
                if($_t_ids)
                {
                    $_key_to_ids_combin[$key]=$_t_ids;
                }
            }
          }
          $_result_key_to_ids = array();
          $i = 0;
          foreach($_key_to_ids_combin as $key=>$v)
          {
            
            foreach($v as $var )
            {
                $_result_key_to_ids[$key.'_'.$i] = $var;
                $i++;
            }
            
          }
          
        return array_chunk($_result_key_to_ids,self::$_PAGE_SIZE_SEARCH,true);
    }
    /**
     * 获取子项列表
    ***/
    private function getItem($act,$count)
    {
        $_data = $this->_data;
        //print_r($_data);die;
    
        if($_data[$act] && $_data[$act]['count']!=0)
        {
            if($act === 'tour')
            {
                $criteria = new CDbCriteria(); 
                $criteria->alias = 'product';   
                $criteria->order = 'product_id desc';        
                $_count = $_data[$act]['count']; 
                
                $pager = new CPagination($_count);    
                $pager->pageSize = self::$_PAGE_SIZE;            
                $pager->applyLimit($criteria);
                $criteria->addInCondition('product_id',$_data[$act]['id']);    
                $artList = Product::model()->findAll($criteria);
                
                $this->params['title'] = $this->_key.'-行程-搜索';
                 
                $this->render('item_list',array('count'=>$count,'act'=>$act,'data'=>$artList,'pages'=>$pager)); 
                return;
            }
            if($act === 'property')
            {
                $criteria = new CDbCriteria();
                $criteria->alias = 'property';       
                $criteria->order = 'property_id desc';        
                $_count = $_data[$act]['count']; 
                
                $pager = new CPagination($_count);    
                $pager->pageSize = self::$_PAGE_SIZE;            
                $pager->applyLimit($criteria);
                $criteria->addInCondition('property_id',$_data[$act]['id']);    
                $artList = Property::model()->findAll($criteria);
                $this->params['title'] = $this->_key.'-住所-搜索'; 
                $this->render('item_list',array('count'=>$count,'act'=>$act,'data'=>$artList,'pages'=>$pager)); 
                return;
            }
            if($act === 'attract')
            {
                $criteria = new CDbCriteria();
                $criteria->alias = 'attraction';        
                $criteria->order = 'attraction_id desc';        
                $_count = $_data[$act]['count']; 
                
                $pager = new CPagination($_count);    
                $pager->pageSize = self::$_PAGE_SIZE_ATTRIACTION;            
                $pager->applyLimit($criteria);
                $criteria->addInCondition('attraction_id',$_data[$act]['id']);    
                $artList = Attraction::model()->findAll($criteria);
                 $this->params['title'] = $this->_key.'-景点-搜索'; 
                $this->render('item_list',array('count'=>$count,'act'=>$act,'data'=>$artList,'pages'=>$pager)); 
                return;
            }
            if($act === 'constract')
            {
                $criteria = new CDbCriteria();
                $criteria->alias = 'article';         
                $criteria->order = 'article_id desc';        
                $_count = $_data[$act]['count']; 
                
                $pager = new CPagination($_count);    
                $pager->pageSize = self::$_PAGE_SIZE;            
                $pager->applyLimit($criteria);
                $criteria->addInCondition('article_id',$_data[$act]['id']);    
                $artList = Article::model()->findAll($criteria);
                $this->params['title'] = $this->_key.'-攻略-搜索'; 
                $this->render('item_list',array('count'=>$count,'act'=>$act,'data'=>$artList,'pages'=>$pager)); 
                return;
            }
            if($act === 'food')
            {
                $criteria = new CDbCriteria();
                $criteria->alias = 'food';    
                $criteria->order = 'food_id desc';        
                $_count = $_data[$act]['count']; 
                
                $pager = new CPagination($_count);    
                $pager->pageSize = self::$_PAGE_SIZE;            
                $pager->applyLimit($criteria);
                $criteria->addInCondition('food_id',$_data[$act]['id']);    
                $artList = Food::model()->findAll($criteria);
                $this->params['title'] = $this->_key.'-美食-搜索';
                $this->render('item_list',array('count'=>$count,'act'=>$act,'data'=>$artList,'pages'=>$pager)); 
                return;
            }
            if($act === 'share')
            {
                $criteria = new CDbCriteria();
                $criteria->alias = 'itinerary';    
                $criteria->order = 'itinerary_id desc';        
                $_count = $_data[$act]['count']; 
                
                $pager = new CPagination($_count);    
                $pager->pageSize = self::$_PAGE_SIZE;            
                $pager->applyLimit($criteria);
                $criteria->addInCondition('itinerary_id',$_data[$act]['id']);    
                $artList = Itinerary::model()->findAll($criteria);
                $this->params['title'] = $this->_key.'-行程单-搜索';
                $this->render('item_list',array('count'=>$count,'act'=>$act,'data'=>$artList,'pages'=>$pager)); 
                return;
            }
            
            if($act === 'city')
            {
                $criteria = new CDbCriteria();
                $criteria->alias = 'city';    
                $criteria->order = 'city_id desc';        
                $_count = $_data[$act]['count']; 
                
                $pager = new CPagination($_count);    
                $pager->pageSize = self::$_PAGE_SIZE;            
                $pager->applyLimit($criteria);
                $criteria->addInCondition('city_id',$_data[$act]['id']);    
                $artList = City::model()->findAll($criteria);
                $this->params['title'] = $this->_key.'-目的地-搜索'; 
                $this->render('item_list',array('count'=>$count,'act'=>$act,'data'=>$artList,'pages'=>$pager)); 
                return;
            }
            
        }
       
         // 没找到     
       $this->render('item_list',array('count'=>$count,'act'=>'no','data'=>array())); 
       
       
    
    }
    
    /** this is a test for leo in search **/
    public function actionTest()
    {
        echo "G4S::getBanwords(xx,xx)<br/>";
        print_r(G4S::getBanwords(5));
         echo "G4S::getKeywords(xx,xx)<br/>";
         print_r(G4S::getKeywords(0));
    }
    public function actionAutocomplete()
    {
        echo "<pre>";
        //$data = $this->getTourData('洛杉矶');
        $data = Keywords::model()->getAttractData('yyyyyyyyyyyyyyy');
          print_r($data);die;
        // $data = $this->getPropertyData('洛杉矶');
       // print_r($data);
        //$data = $this->getAttractData('剧院');
        //print_r($data);
       // $data = $this->getConstractData('威尼斯');
       // print_r($data);
         //$data = $this->getFoodData('美食');
        // print_r($data);
          $data = $this->getTogetherData('ss');
         print_r($data);
          $data = $this->getYouAskMeToAnswerData($word);
         print_r($data);
        die;
        $tem = array(1,2,3,4,5,6);
        rsort($tem);
        print_r(array_chunk($tem,5));
        $tem = array(1,2,3,4,5);
        rsort($tem);
        print_r(array_chunk($tem,5));
        $tem = array(1,2,3,4);
        rsort($tem);
        print_r(array_chunk($tem,5));
        die;
        
        Yii::app()->cache->set('ssss','vvvvv1',5000);
        Yii::app()->cache->set('ss','vvvvv2',5000);
        Yii::app()->cache->set('swss','vvvvv3',5000);
        Yii::app()->cache->set('sdfsss','vvvvv4',5000);
        Yii::app()->cache->set('wewqwqss','vvvvv5',5000);
        Yii::app()->cache->set('ss5434s','vvvvv6',5000);
        //Yii::app()->cache->flush();
        var_dump(Yii::app()->cache->hasProperty('ssss'));
        if(Yii::app()->cache->hasProperty('ssss'))
        {
            echo "yes<br>";
        }
       print_r(Yii::app()->cache->mget(array('s','ss','sdfsd')))  ;
      
        die;
         $data = $this->getTotalData();
         
         echo "<pre>";
         print_r($data);
        
    }
    
    /**
     * sensor 列表  快速
    */
    public function actionAjaxGet()
    {
    
        $key = $this->_key;
        
        //print_r(Yii::app()->request->isAjaxRequest);die('ddddddddddddddddd');
          //$data = Keywords::model()->getTotalData($key);
           //echo json_encode($data);exit;
          //print_r($data);die;
          //$_data = $this->_data;
         //print_r($_data);exit;
        if(Yii::app()->request->isAjaxRequest)
        {
          $data = array();
          if(empty($key))
          {
            //默认推荐
              //$data = $this->getTotalData($key);
              $data = Keywords::model()->getTotalData($key);
              
          }
          else
          {
              //$data = $this->getTotalData($key);
              $data = Keywords::model()->getTotalData($key);
          }
            // print_r($data);
            
          foreach($data as &$val)
          {
            unset($val['id']);
          }
          echo json_encode($data);exit;
        }
        else
        {
            $this->redirect($this->createUrl("search/index",array('key'=>$key)));
        }
        
    }
    
   
    
    

}
