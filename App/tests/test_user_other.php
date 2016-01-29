<?php

require_once __DIR__ . '/../../index.php';

use App\Db;

$db = new Db();
$table = App\Models\User::TABLE;
$classUser = 'App\Models\User';

$sql = 'INSERT INTO `' . $table . '` (`name`, `email`) VALUES (:name, :email);';
$args = [':name' => 'Авдеева Лидия', ':email' => 'test_5@tmp.ru'];


echo 'Добавление нового пользователя<br>';
$res = $db->execute($sql, $args);
echo '<pre>';
var_dump($res);
echo '</pre><hr>';


$sql_2 = 'INSERT INTO `' . $table . '` (`name`, `email`) VALUES (:name, :email);';
$args_2 = [':name' => 'Авдеева Ксения', ':email' => 'test_6@tmp.ru'];


echo 'Добавление нового пользователя<br>';
$res = $db->execute($sql_2, $args_2);
echo '<pre>';
var_dump($res);
echo '</pre><hr>';


echo 'Проверка добавления пользователя, выборка всех пользователей<br>';
$sql_3 = 'SELECT * FROM `' . $table . '`;';
$res = $db->query($classUser, $sql_3);
echo '<pre>';
var_dump($res);
echo '</pre><hr>';

$sql_4 = 'UPDATE `' . $table . '` SET `name`=:name WHERE id=:id;';
$args_4 = [':name' => 'Борисова Наталья', ':id' => 5];

echo 'Изменение имени пользователя с указанным id<br>';
$res = $db->execute($sql_4, $args_4);
echo '<pre>';
var_dump($res);
echo '</pre><hr>';

echo 'Проверка изменения данных пользователя<br>';
$sql_5 = 'SELECT * FROM `' . $table . '` WHERE id=:id;';
$args_4 = [':id' => 5];
$res = $db->query($classUser, $sql_5, $args_4);
echo '<pre>';
var_dump($res);
echo '</pre><hr>';

$sql_6 = 'DELETE FROM `' . $table . '` WHERE name=:name;';
$args_6 = [':name' => 'Борисова Наталья'];

echo 'Удаление пользователя с определенным Именем<br>';
$res = $db->execute($sql_6, $args_6);
echo '<pre>';
var_dump($res);
echo '</pre><hr>';

echo 'Проверка успешности удаления пользователей из таблицы<br>';
$sql_5 = 'SELECT * FROM `' . $table . '`;';
$res = $db->query($classUser, $sql_5, $args_4);
echo '<pre>';
var_dump($res);
echo '</pre><hr>';