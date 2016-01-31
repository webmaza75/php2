<?php
// Подключение файла автозагрузки
require_once __DIR__ . '/autoload.php';

// Получение трех последних новостей
$news = App\Models\News::getLast(3);
include(__DIR__ . './App/views/news/all.php');
