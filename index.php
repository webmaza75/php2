<?php
// Подключение файла автозагрузки
require_once __DIR__ . '/autoload.php';

// Получение трех последних новостей
$news = App\Models\News::getLast(3);
include(__DIR__ . './App/views/news/all.php');

// Альтернативный вариант без использования метода getLast($limit)
/*
$news  = App\Models\News::findAll();
$limit = 3;
// Получить срез массива из 3-х элементов ($limit), начиная с конца (-$limit) эл-та
$news = array_slice($news, -$limit, $limit, true);
include(__DIR__ . './App/views/news/all.php');
*/