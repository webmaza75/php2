<?php

use App\Models\News;

require_once __DIR__ . '/../autoload.php';

$view = new \App\View();

if (!isset($_GET['id'])) {
    $view->news = new News();
    $view->title = 'Добавление новости';
} else {
    $view->news = App\Models\News::findById((int)$_GET['id']);
    $view->title = 'Редактирование новости';
}

$view->display(__DIR__ . '/../App/templates/edit.php');