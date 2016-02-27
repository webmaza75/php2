<?php
/**
 * Подключение файла автозагрузки
 */
require_once __DIR__ . '/autoload.php';

$control = 'news';
$action = 'index';

// любой URI (не корень сайта)
try {
    if ($_SERVER['REQUEST_URI'] != '/') {
        // ?param=value
        $url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Разбиение URL на массив по символу "/"
        $uri_parts = explode('/', trim($url_path, ' /'));

        $control = array_shift($uri_parts); // alias контроллера
        if (count($uri_parts) >=1) {
            $action = (array_shift($uri_parts)); // alias action
        }
    }
    $ctrl = '\App\Controllers\\' . $control;

    if (!class_exists($ctrl)) {
        $e =  new \App\Exceptions\Err404('Неверный адрес ');
        $e->setExtParams(['uri' => $_SERVER['REQUEST_URI'], 'ctrl' => $ctrl]);
        throw $e;
    }

    $controller = new $ctrl();

    if (!method_exists($controller, 'action' . $action)) {
        $e = new \App\Exceptions\Err404 ('Несуществующий адрес ');
        $e->setExtParams(['uri' => $_SERVER['REQUEST_URI'], 'ctrl' => $ctrl, 'act' => $action]);
        throw $e;
    }
    $controller->action($action);

} catch (\App\Exceptions\DB $e) {
    $err = new \App\Controllers\Error();
    $err->actionDbError($e->getMessage());
    $logger = new \App\LogUseLib;
    $logger->emergency($e->getMessage(), $e->getMess());
} catch (\App\Exceptions\Err404 $e) {
    $err = new \App\Controllers\Error();
    $err->action404($e->getMessage());
    $logger = new \App\LogUseLib;
    $logger->alert($e->getMessage(), $e->getMess());
}


