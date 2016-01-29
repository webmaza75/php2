<?php
require_once __DIR__ . '/../../index.php';

use App\Db;

$db = new Db();
$table = App\Models\User::TABLE;
$classUser = 'App\Models\User';

$sql = 'SELECT * FROM `' . $table . '` WHERE `name`=:name AND `email`=:email;';
$sql_2 = 'SELECT * FROM `' . $table . '` WHERE `name`=:name;';
$sql_3 = 'SELECT * FROM `' . $table . '`;';
$sql_4 = 'SELECT * FROM `' . $table . '` WHERE `name` like :name;';

$args = [':name' => 'Иванов Сергей', ':email' => 'test@tmp.ru'];
$args_2 = [':name' => 'Иванов Сергей'];
$args_3 = [':name' => '%Иванов %'];
$args_4 = include __DIR__ . './user_params.php';

echo 'Поиск пользователя по Имени и Email (есть ли такой)<br>';
$res = $db->execute($sql, $args);
echo '<pre>';
var_dump($res);
echo '</pre><hr>';

echo 'Выборка данных пользователя по Имени и Email<br>';
$result = $db->query($classUser, $sql, $args);
echo '<pre>';
var_dump($result);
echo '</pre><hr>';

echo 'Выборка данных пользователя по Имени<br>';
$result = $db->query($classUser, $sql_2, $args_2);
echo '<pre>';
var_dump($result);
echo '</pre><hr>';

echo 'Выборка данных по всем пользователям (параметры по умолчанию - пустой массив)<br>';
$result = $db->query($classUser, $sql_3);
echo '<pre>';
var_dump($result);
echo '</pre><hr>';

echo 'Выборка данных пользователей по Имени с использованием like<br>';
$result = $db->query($classUser, $sql_4, $args_3);
echo '<pre>';
var_dump($result);
echo '</pre><hr>';

echo 'Выборка данных по критериям, находящимся в стороннем файле (include)<br>';
$result = $db->query($classUser, $sql_2, $args_4);
echo '<pre>';
var_dump($result);
echo '</pre><hr>';

echo 'Попытка получить данные пользователей (параметров в запросе больше, чем передаваемых аргументов)<br>';
$result = $db->query($classUser, $sql, $args_2);
echo '<pre>';
var_dump($result);
echo '</pre><hr>'; // Предупреждение: Invalid parameter number


echo 'Попытка получить данные пользователей (параметров в запросе меньше, чем передаваемых аргументов)<br>';
$result = $db->query($classUser, $sql_2, $args);
echo '<pre>';
var_dump($result);
echo '</pre><hr>'; // Предупреждение: Invalid parameter number