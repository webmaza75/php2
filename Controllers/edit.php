<?php

require_once __DIR__ . '/../autoload.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $news = App\Models\News::findById($id);
}

if (isset($_GET['act']) && $_GET['act'] == 'edit') {
    include(__DIR__ . './../App/views/news/edit.php');
} else {
    header('location: /'); // На главную, если неизвестный $_GET['act']
}

if (isset($_POST['edit']) && isset($_POST['title']) && isset($_POST['content'])) {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if ($title != '' && $content != '') {
        $news->title = $title;
        $news->content = $content;
        $news->save();
        header('location: /'); // возврат на главную страницу
    }
}