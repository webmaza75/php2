<?php

require_once __DIR__ . '/../autoload.php';

if (isset($_POST['edit']) && isset($_POST['title']) && isset($_POST['content'])) {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    if ($title != '' && $content != '') {
        $news = App\Models\News::findById((int)$_POST['id']);
        $news->title = $title;
        $news->content = $content;
        if ($news->save()) {
            header('location: /');
            exit;
        }
    }
}
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $news = App\Models\News::findById($id);
    include(__DIR__ . '/../App/views/news/edit.php');
}