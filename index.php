<?php
/**
 * Подключение файла автозагрузки
 */
require_once __DIR__ . '/autoload.php';

$view = new \App\View();
$view->title = 'Админ-панель';
$view->news = \App\Models\News::findAll();
$view->authors = \App\Models\Author::findAll();
$view->display(__DIR__ . '/App/templates/news.php');