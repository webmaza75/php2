<?php

namespace App;

//use \PDO;

abstract class Model //implements \Countable
{
    const TABLE = '';

    public $id;

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

    public function isNew()
    {
        return empty($this->id);
    }

    public function insert()
    {
        $columns = [];
        $values = [];
        foreach ($this as $k => $v) {
            if ('id' == $k) {
                continue;
            }
            $columns[] = $k;
            $values[':'.$k] = $v;
        }
        $sql = '
            INSERT INTO ' . static::TABLE . '
            (' . implode(',', $columns) . ')
            VALUES
            (' . implode(',', array_keys($values)) . ')
        ';
        $db = Db::instance();
        $res = $db->execute($sql, $values);

        if ($res) {
            // Определяем свойство id объекта
            $this->id = $db->lastInsId();
        }
        return $res;
    }

    public function update()
    {
        $args = [];
        $keys = [];
        $sql = 'UPDATE ' . static::TABLE . ' SET ';
        foreach ($this as $k => $v) {
            if ('id' == $k) { // если это свойство id
                $args[':'.$k] = $v; // берем значение только для подстановки
                continue;
            }
            $keys[] = $k . '=:' . $k;
            $args[':'.$k] = $v;
        }

        $sql .= implode(', ', $keys) . ' WHERE id=:id;';
        $db = Db::instance();
        $res = $db->execute($sql, $args);
        return $res;
    }

    public function save()
    {
        // регистронезависимый поиск слова insert в начале строки запроса
        //$pattern1 = '/^insert\b/i';
        // регистронезависимый поиск слова update в начале строки запроса
        //$pattern2 = '/^update\b/i';

        if ($this->isNew()) {
            $res = $this->insert();
        } else {
            $res = $this->update();
        }
        return $res;
    }

    public function delete()
    {
        $sql = 'DELETE FROM ' . static::TABLE . '  WHERE id=:id;';
        $args[':id'] = $this->id;
        $db = Db::instance();
        $res = $db->execute($sql, $args);
        return $res;
    }
}