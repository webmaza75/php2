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
        $db = Db::instance();
        $res = $db->query(static::class, 'SELECT * FROM ' . static::TABLE . ';');
        if (!$res) {
            throw new \App\Exceptions\Err404('Записи не найдены');
        }
        return $res;
    }

    /**
     * Получение одной записи из нужной таблицы по ее id
     * @param integer $id id записи
     * @return mixed (bool|object)
     */
    public static function findById($id)
    {
        $db = Db::instance();
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
            if ('id' == $k || 'data' == $k) {
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
        else {
            throw new \App\Exceptions\Db('Новая запись не сохранена, неверный запрос');
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

            if ('id' == $k) { // если это свойство id
                $args[':'.$k] = $v; // берем значение только для подстановки
                continue;
            }
            if ('data' == $k) {
                continue;
            }
            $keys[] = $k . '=:' . $k;
            $args[':'.$k] = $v; // берем значение только для подстановки
        }

        $sql .= implode(', ', $keys) . ' WHERE id=:id;';
        $db = Db::instance();
        $res = $db->execute($sql, $args);

        if (!$res) {
            throw new \App\Exceptions\DB('Запись не обновлена, неверный запрос');
        }

        return $res;
    }

    /**
     * Выбор режима добавления или редактирования записи об объекте в БД
     * @return bool
     */
    public function save()
    {
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
        if (!$res) {
            throw new \App\Exceptions\Db('Запись не удалена, неверный запрос');
        }
        return $res;
    }

    /**
     * Получение полей таблицы, которые по умолчанию NOT NULL
     * @return array
     */
    public static function getNotNull()
    {
        $db = Db::instance();
        $sql = 'select column_name from information_schema.columns where table_schema = \''. $db->getDbName() .'\' and  table_name = \''
            . static::TABLE . '\' and is_nullable=:is_nullable;';
        $args[':is_nullable'] = 'NO';
        $res = $db->query(static::class, $sql, $args);
        return $res;
    }
}