<?php
//config sample by vincent
define('IS_PROD',@@SITE_PROD@@);
define('IS_QA',@@SITE_QA@@);
define('IS_DEV',@@SITE_DEV@@);

return array(

'dbHost'=>'@@DATABASE_HOST@@',
'dbUser'=>'@@DATABASE_USER@@',
'dbPass'=>'@@DATABASE_PASS@@',
'dbName'=>'@@DATABASE_NAME@@',

'uploadDir'=>'@@UPLOAD_DIR@@',
'uploadPath'=>'@@UPLOAD_PATH@@',

'domain'=>'@@DOMAIN@@',
'hostSSL'=>'@@HOST_SSL@@',
'hostCommon'=>'@@HOST_COMMON@@',

'appKey'=>'@@APPKEY@@',

);

?>