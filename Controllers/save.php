<?php

use App\Models\News;

require_once __DIR__ . '/../autoload.php';

if (isset($_POST['id'])) {
    $news = App\Models\News::findById((int)$_POST['id']);
} else {
    $news = new News();
}

$news->title = $_POST['title'];
$news->content = $_POST['content'];
$news->save();
header('location: /');
exit;