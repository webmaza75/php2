<?php
/**
 * Подключение файла автозагрузки
 */
require_once __DIR__ . '/autoload.php';


//echo $url = $_SERVER['REQUEST_URI'];
//$arr = ['news', 'admin'];
//$getCtrl = strtolower($_GET['ctrl']);

$ctrl = '\App\Controllers\\';
//$ctrl .= (!empty($_GET['ctrl']) && in_array($_GET['ctrl'], $arr)) ? $_GET['ctrl'] : 'News';
$ctrl .= (!empty($_GET['ctrl'])) ? $_GET['ctrl'] : 'News';

$controller = new $ctrl();
$action = $_GET['act'] ?: 'Index';
$controller->action($action);
