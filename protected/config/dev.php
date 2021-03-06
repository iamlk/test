<?php
//ini_set('error_reporting', 30709);
//ini_set('mbstring.internal_encoding', 'UTF-8');
return array(
    'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name' => 'Go4Seas',
    'charset' => 'UTF-8',
    'timeZone' => 'Asia/Shanghai',
    'sourceLanguage' => 'zh_cn',

    // preloading 'log' component
    'preload' => array('log'),

    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.models.product.*',
        'application.models.property.*',
        'application.models.companion.*',
        'application.components.*',
        'application.finder.*',
        'application.extensions.KindEditor.*',
        'application.extensions.UEditor.*',
        'application.extensions.CJuiDateTimePicker.*',
        'application.extensions.*',
        ),

    // application components
    'components' => array(
        'clientScript'=>array(
            'class' => 'ZyxClientScript',
            'scriptMap' => array(
                'jquery.js' => '/js/jquery.js'
                )
            ),
        'request' => array(
            'enableCsrfValidation' => false,
            'enableCookieValidation' => false,
            'csrfTokenName'=>'_Go4SeaFL',
            ),
        'user' => array(
            'class' => 'BaseWebUser',
            'allowAutoLogin' => true,
            ),
        'assetManager' => array('class' => 'BaseAssetManager', ),
        'messages' => array(
            'class' => 'BaseDbMessageSource',
            // 申明extends关系，定义"类=>父级类"关系，区别大小写
            'extends' => array(
                'base' => 'base',
                'property' => 'base',
                'tour' => 'base',
                'info' => 'base',
                'sns' => 'base',
                'other' => 'other',
                'manage' => 'base',
                ),
            ),
        // uncomment the following to enable URLs in path-format
        'urlManager'=>array(
            'class'=>'ZYXUrlManager',
            'urlFormat'=>'path',
            'caseSensitive'=>true,
            'showScriptName'=>false,
            'rules'=>include('route.php'),
            //'urlSuffix'=>'.html'
        ),

        'mailer' => array(
            'class' => 'application.extensions.mailer.EMailer'
        ),
        'db' => array(
            'class' => 'CDbConnection',
            'emulatePrepare' => true,
            'connectionString' => 'mysql:host=localhost;port=3306;dbname=zhoubian',
            'username' => 'root',
            'password' => 'cPA98pMVKw',
            'charset' => 'UTF8',
            'enableProfiling' => YII_DEBUG,
            'enableParamLogging' => YII_DEBUG,
            ),
        'cache'=>array(
         'class'=>'system.caching.CFileCache',
         'cachePath'=> '\\protected\\cache_tmp', 
         'directoryLevel' => 2,
         'cacheFileSuffix' => 'bin.c_',
         'keyPrefix'=>'zhoubian',
                    ),
        
        'errorHandler' => array('errorAction' => 'site/error'),



        ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array( // this is used in contact page
        'assets' => 'assets',
        'adminEmail' => 'webmaster@example.com',
        'languages' => array(
            'zh_cn'),
        ),
    );
