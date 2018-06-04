<?php
ini_set('error_reporting', E_ALL);

// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

global $msg;
global $errorCode;
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',2);

require_once($yii);
setlocale(LC_TIME, 'en_US.ISO_8859-1');

Yii::createWebApplication($config)->run();
