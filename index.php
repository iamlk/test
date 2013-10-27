<?php
// change the following paths if necessary
$yii=dirname(__FILE__).'/core/framework/yii.php';


$dev=dirname(__FILE__).'/protected/config/dev.php';
$main=dirname(__FILE__).'/protected/config/main.php';
$config=(is_file($dev)?$dev:$main);

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();


exit;

$x = file_get_contents('x.css');
preg_match_all('/\.\.\/\.\.\/\.\.\/(.*?)\?/',$x,$mt);

$mt = array_unique($mt[1]);
//print_r($mt);
foreach($mt as $v){
    $path = explode('/',$v);
    $url = 'http://img.t.sinajs.cn/t4/appstyle/open/';
    $tp = './static/';
    foreach($path as $p){
        $tp .= $p;
        if(strpos($p,'.')){
            save_file($url.$v,$tp);
        }
        elseif(!file_exists($tp)){
            mkdir($tp);
        }
        $tp .= '/';
        chmod($p,0777);
    }
}

function save_file($url,$path){
    echo $url.'|'.$path."\r\n";
    $contents =file_get_contents($url);
    file_put_contents($path,$contents);
}
exit;


?>