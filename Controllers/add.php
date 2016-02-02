<?php

use App\Models\News;

require_once __DIR__ . '/../autoload.php';

if (isset($_GET['act']) && $_GET['act'] == 'add') {
    include(__DIR__ . './../App/views/news/add.php');
} else {
    header('location: /'); // На главную, если неизвестный $_GET['act']
}

if (isset($_POST['add']) && isset($_POST['title']) && isset($_POST['content'])) {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if ($title != '' && $content != '') {
        $news = new News();
        $news->title = $title;
        $news->content = $content;
        $news->save();
        header('location: /'); // возврат на главную страницу
    }
}