<?php

namespace App;

abstract class Model
{
    const TABLE = '';

    // Получить все записи из требуемой таблицы
    public static function findAll()
    {
        $db = new Db();
        return $db->query(static::class, 'SELECT * FROM ' . static::TABLE . ';');
    }

    // Получение одной записи из нужной таблицы по ее id
    public static function findById($id)
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE `id`=:id;';
        $args = [':id' => $id];
        $res = $db->query(static::class, $sql, $args);
        if (!$res) {
            return false;
        }
        return $res[0]; // возвращаем сразу объект
    }

    // Получение последних ($limit) записей (сортировка по id)
    public static function getLast($limit)
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' ORDER BY `id` DESC LIMIT ' .$limit. ';';
        $res = $db->query(static::class, $sql);
        if (!$res) {
            return false;
        }
        return $res;
    }
}