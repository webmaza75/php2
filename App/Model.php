<?php

namespace App;

/**
 * Class Model abstract class
 * @package App
 */
abstract class Model
{
    /**
     * Имя таблицы (переопределяется в классах-наследниках)
     */
    const TABLE = '';

    /**
     * @var integer $id id записи
     */
    public $id;

    /**
     * Получить все записи из требуемой таблицы
     * @return mixed
     */
    public static function findAll()
    {
        $db = new Db();
        return $db->query(static::class, 'SELECT * FROM ' . static::TABLE . ';');
    }

    /**
     * Получение одной записи из нужной таблицы по ее id
     * @param integer $id id записи
     * @return mixed (bool|object)
     */
    public static function findById($id)
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE `id`=:id;';
        $args = [':id' => (int)$id];
        $res = $db->query(static::class, $sql, $args);
        if (!$res) {
            return false;
        }
        return $res[0]; // возвращаем сразу объект
    }

    /**
     * Получение последних ($limit) записей (сортировка по id)
     * @param integer $limit необходимое количество записей
     * @return mixed (bool|array)
     */
    public static function getLast($limit)
    {
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE . ' ORDER BY `id` DESC LIMIT ' . (int)$limit . ';';
        $res = $db->query(static::class, $sql);
        if (!$res) {
            return false;
        }
        return $res;
    }

    /**
     * Проверка, новый ли объект (есть ли соответствующая запись в БД)
     * @return bool
     */
    public function isNew()
    {
        return empty($this->id);
    }

    /**
     * Метод вставки новой записи об объекте в БД
     * @return bool
     */
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

    /**
     * Обновление записи в БД об объекте
     * @return bool
     */
    public function update()
    {
        $args = [];
        $keys = [];
        $sql = 'UPDATE ' . static::TABLE . ' SET ';
        foreach ($this as $k => $v) {
            $args[':'.$k] = $v; // берем значение только для подстановки
            if ('id' == $k) { // если это свойство id
                continue;
            }
            $keys[] = $k . '=:' . $k;
        }

        $sql .= implode(', ', $keys) . ' WHERE id=:id;';
        $db = Db::instance();
        $res = $db->execute($sql, $args);
        return $res;
    }

    /**
     * Выбор режима добавления или редактирования записи об объекте в БД
     * @return bool
     */
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

    /**
     * Удаление записи об объекте из БД
     * @return bool
     */
    public function delete()
    {
        $sql = 'DELETE FROM ' . static::TABLE . '  WHERE id=:id;';
        $args[':id'] = $this->id;
        $db = Db::instance();
        $res = $db->execute($sql, $args);
        return $res;
    }
}