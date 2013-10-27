<?php
/**
 * BaseController is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class BaseController extends CController
{
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/default',
     * meaning using a single column layout. See 'protected/views/layouts/default.php'.
     */
    public $layout = '//layouts/default';
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs;
    /**
     * 在模板文件里面可以使用$this->params['abc']....
     */
    public $params = array();
    public $isGuest = true;

    /**
     * @desc 设置全局语言，依次按照“选择->cookie->浏览器->默认”为序指定
     * @author zyme
     */
    public function init()
    {
        // get
        define('U_ID',(int)(Yii::app()->user->customer_id));
		define('CACHE_TIME',60);
        /** / var
        if ($languages = Yii::app()->params['languages'] and is_array($languages)) ;
        else  $languages = array(Yii::app()->sourceLanguage) and Yii::app()->setParams(array('languages' => $languages));
        if (in_array($language = Yii::app()->request->getParam('language'), $languages))
        {
            $cookie = new CHttpCookie('language', $language);
            $cookie->expire = strtotime('+10 years');
            Yii::app()->request->cookies['language'] = $cookie;
        }
        elseif ($cookie = Yii::app()->request->cookies['language'] and in_array($language = $cookie->value, $languages)) ;
        elseif (in_array($language = Yii::app()->request->preferredLanguage, $languages)) ;
        else  $language = Yii::app()->sourceLanguage;
        */
        // set
        Yii::app()->setLanguage('zh_cn');//$language);
        $this->setPageTitle('-四海网');
        $this->breadcrumbs = new Breadcrumbs;
    }
}
