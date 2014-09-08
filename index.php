<?php
    if($_SERVER['HTTP_HOST']=='host8') 
    {   
        $yii=dirname(__FILE__).'/../framework/yii.php';
        $config=dirname(__FILE__).'/protected/config/development.php';
        defined('YII_DEBUG') or define('YII_DEBUG',true);
        defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
    } else
    {
        $yii=dirname(__FILE__).'/framework/yii.php';
        $config=dirname(__FILE__).'/protected/config/production.php';
    }

require_once($yii);
Yii::createWebApplication($config)->run();
