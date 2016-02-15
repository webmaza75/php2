<?php
/**
 * Подключение файла автозагрузки
 */
require_once __DIR__ . '/autoload.php';

// контроллер и action по умолчанию
$ctrl = 'app\controllers\news';

// короткий вариант
//$control = 'news';
$action = 'index';

// для админ-панели $control = 'admin'; $action = 'index';

// любой URI (не корень сайта)
if ($_SERVER['REQUEST_URI'] != '/') {
    // ?param=value
    $url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // Разбиение URL на массив по символу "/"
    $uri_parts = explode('/', trim($url_path, ' /'));

/* для варианта чпу без пространства имен (короткое имя контроллера)
    if (count($uri_parts) % 2) { // =1 (true), т.е. нечетное число
        $control = 'news';
        $action = '404';
    } else {
        $control = array_shift($uri_parts); // имя контроллера
        $action = array_shift($uri_parts); // имя action

    }
*/
    /* для неограниченной длины пространства имен контроллера */
    $action = array_pop($uri_parts); // имя action (последний элемент массива)

    $ctrl = '\\' . implode('\\', $uri_parts);
}

// для короткого варианта именования контроллера (admin, news)
//$ctrl = '\App\Controllers\\' . $control;
$controller = new $ctrl();
$controller->action($action);

