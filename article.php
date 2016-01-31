<?php

use \App\Models\News;

require_once __DIR__ . '/autoload.php';

$action = isset($_GET['act']) ? $_GET['act'] : false; // Проверка перехода по ссылке
if ($action && !in_array($action, ['add', 'edit', 'del'])) {
    header('location: /'); // На главную, если неизвестный $_GET['act']
}
if ($action == 'add') { // Если надо добавить новую статью
    include(__DIR__ . './App/views/news/add.php');
}

// Если существует $_GET['id']
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $news = App\Models\News::findById($id); // поиск новости по id
    if (false === $news) { // для несуществующей новости
        header('location: /'); // возврат на главную страницу
    } else {
        if(isset($_POST['edit'])) {
            $news->id = $id;
            $news->title = $_POST['title'];
            $news->content = $_POST['content'];
            $news->save();
            header('location: /'); // возврат на главную страницу
        }

        if ($action == 'del') {
            $news->delete();
            header('location: /'); // возврат на главную страницу
        } elseif ($action == 'edit') { // Редактирование новости
            include(__DIR__ . './App/views/news/edit.php');
        }

    }
} else {
    if (isset($_POST['add'])) {
        $news = new News();
        $news->title = $_POST['title'];
        $news->content = $_POST['content'];
        $news->save();
        header('location: /'); // возврат на главную страницу
    }
}






