<?php
require_once __DIR__ . '/../autoload.php';

if (isset($_GET['act']) && $_GET['act'] == 'del') {

    if(isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $news = App\Models\News::findById($id); // поиск новости по id
        if (false !== $news) {
            $news->delete();
        }
    }
    header('location: /'); // возврат на главную страницу
}