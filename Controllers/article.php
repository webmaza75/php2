<?php
require_once __DIR__ . '/../autoload.php';
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);
    $news = App\Models\News::findById($id);
    if (false === $news) { // для несуществующей новости
        header('location: /'); // возврат на главную страницу
    } else {
        // Подключение шаблона для одной новости
        include(__DIR__ . '/../App/views/news/edit.php');
    }
} else {
    // возврат на главную страницуб при отсутствии $_GET['id']
    header('location: /');
}



