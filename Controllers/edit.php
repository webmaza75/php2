<?php

use App\Models\News;

require_once __DIR__ . '/../autoload.php';

if (!isset($_GET['id'])) {
    $news = new News();
} else {
    $id = (int)$_GET['id'];
    $news = App\Models\News::findById((int)$_GET['id']);
}
include(__DIR__ . '/../App/views/news/edit.php');