<?php
/**
 * Тестирование ActiveRecord
 */

//use App\Db;
use App\Models\User;

require_once __DIR__ . '/../../index.php';

/**
 * Тестирование метода insert() в классе Model
 */
$user = new User();
$user->name = 'Андрей';
$user->email = 'a@vasnecov.ru';
echo 'Добавили: ' . $user->insert(). '<br>';
echo 'id новой записи: ' . $user->id;
echo '<hr>';

/**
 * Тестирование метода update() в классе Model
 */
$id = 2;
$user = App\Models\User::findById($id);
$user->name = 'Светлана';
$user->email = 's@sss.ru';
echo 'Изменена ли запись с id=' . $id .': '. $user->update();
echo '<hr>';

/**
 * Тестирование метода save() в классе Model => вызов insert()
 */
$user = new User();
$user->name = 'Агрипина';
$user->email = 'a@aaa.ru';
echo 'Добавили: ' . $user->save(). '<br>';
echo 'id новой записи: ' . $user->id;
echo '<hr>';

/**
 * Тестирование метода save() в классе Model => вызов update()
 */
$id = 3;
$user = App\Models\User::findById($id);
$user->name = 'Валерия';
$user->email = 'v@val.ru';
echo 'Изменена ли запись с id=' . $id .': '. $user->save();
echo '<hr>';

/**
 * Тестирование метода delete() в классе Model
 */
$id = 4;
$user = App\Models\User::findById($id);
echo 'Удалена ли запись с id=' . $id .': '. $user->delete();
echo '<hr>';

/**
 * Тестирование метода save() в классе Model (объект News)
 */
$id = 2;
$news = App\Models\News::findById($id);
$news->title = 'Исправленный заголовок';
$news->content = 'Исправленный контент';
echo 'Изменена ли запись с id=' . $id .': '. $news->save();
echo '<hr>';