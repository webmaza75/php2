<?php
/**
 * Тестирование реализации интерфейса ArrayAccess,
 * для его корректной работы пришлось отключить
 * закомментировать использование трейта MagicFunc!!!
 */

require_once __DIR__ . '/../../autoload.php';

$view = new \App\View();
$view->title = 'ура';
$view->green = 'зеленый';
$view->news = \App\Models\News::findAll();

foreach ($view as $prop => $value) {
    echo $prop . ' = ' . $value . '<br>';
}

echo '<hr>';