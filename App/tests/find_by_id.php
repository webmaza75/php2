<?php

require_once __DIR__ . '/../../index.php';

use App\Db;

$db = new Db();
$table = App\Models\User::TABLE;
$classUser = 'App\Models\User';

echo 'Выборка данных по id пользователя<br>';
$byId = App\Models\User::findById(2);
echo '<pre>';
var_dump($byId);
echo '</pre><hr>';

echo 'Выборка несуществующего пользователя<br>';
$byId = App\Models\User::findById(6);
echo '<pre>';
var_dump($byId);
echo '</pre><hr>';