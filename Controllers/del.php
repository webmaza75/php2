<?php
require_once __DIR__ . '/../autoload.php';

if(isset($_GET['id'])) {
    $news = App\Models\News::findById((int)$_GET['id']); // поиск новости по id
    if (false !== $news) {
        $news->delete();
    }
}
header('location: /'); // возврат на главную страницу
exit;
