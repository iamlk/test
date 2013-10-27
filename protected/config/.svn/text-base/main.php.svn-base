<?php
// config
ini_set('error_reporting', 30709);
ini_set('mbstring.internal_encoding', 'UTF-8');

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
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

    'modules' => array( // uncomment the following to enable the Gii tool
            'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '1',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array(),
            ), ),

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
            'connectionString' => 'mysql:host=192.168.0.11;port=3306;dbname=local_zyx',
            'username' => 'root',
            'password' => 'zyx123',
            'charset' => 'UTF8',
            'enableProfiling' => YII_DEBUG,
            'enableParamLogging' => YII_DEBUG,
            ),
        'cache'=>array(
         'class'=>'system.caching.CFileCache',
         'cachePath'=> './protected/cache_tmp',
          //'cachePath'=> 'E:\\xampp\\htdocs\\newzyx\\branches\\dev\\protected\\cache_tmp',  
         'directoryLevel' => 2,
         'cacheFileSuffix' => 'bin.leo.yan',
         'keyPrefix'=>'go4seas',
                    ),
        
        'errorHandler' => array('errorAction' => 'site/error'),
        // uncomment the following to use a MySQL database
        /*
$body= "我终于发送邮件成功了！呵呵！goodboy gayayang！<br/><a>http://news.qq.com/a/20111115/000792.htm?qq=0&ADUIN=594873950&ADSESSION=1321316731&ADTAG=CLIENT.QQ.3493_.0</a>";
$mailer = Yii::app()->mailer;

$mailer->Host = 'smtp.exmail.qq.com';
$mailer->IsSMTP();
$mailer->SMTPAuth = true;
$mailer->From = 'no-reply@go4seas.com';
$mailer->AddReplyTo('no-reply@go4seas.com');
$mailer->AddAddress('wap@iamlk.cn');
$mailer->FromName = 'myName';
$mailer->Username = 'no-reply@go4seas.com';    //这里输入发件地址的用户名
$mailer->Password = 'zyx123';    //这里输入发件地址的密码
$mailer->SMTPDebug = true;   //设置SMTPDebug为true，就可以打开Debug功能，根据提示去修改配置
$mailer->CharSet = 'UTF-8';
$mailer->Subject = Yii::t('demo', 'Yii rulez!');
$mailer->Body = $body;
$mailer->Send();
return;
        * ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array('class' => 'CProfileLogRoute', ),
                array('class' => 'CWebLogRoute', ),
                ),
            ),
        */



        ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array( // this is used in contact page
        'assets' => 'assets',
        'adminEmail' => 'webmaster@example.com',
        'languages' => array(
            'zh_cn',
            'zh_tw',
            'en_us'),
        'viewPaths' => array(
            '控制器ID名(表达式内容)' => '新的目录(它自动会再加上控制器ID名)',
            'property.*' => 'property',
            ),
        ),
    );
