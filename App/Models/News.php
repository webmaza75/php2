<?php

namespace App\Models;

use App\Model;

/**
 * Class News класс новости
 * @package App\Models
 */
class News extends Model
{
    /**
     * @var array $data Array of Properties
     */
    protected $data = [];

    /**
     * Магический метод добавления несуществующего свойства объекта
     * @param mixed $k Property name
     * @param mixed $v Property value
     */
    public function __set($k, $v)
    {
        $this->data[$k] = $v;
    }

    /**
     * Проверка на существование свойства объекта по его имени (ключу)
     * @param mixed $k Property name
     * @return bool
     */
    public function __isset($k)
    {
        return array_key_exists($k, $this->data);
    }

    /**
     * Table name имя таблицы
     */
    const TABLE = 'news';

    /**
     * Метод получения имени автора новости по его id
     * @param integer $authorId Id of the author
     * @return mixed (bool|string|object)
     */
    public function __get($k)
    {
        if ($k == 'author') {
            if (empty($this->author_id) || is_null($this->author_id)) {
                return false;
            }
            return Author::findById($this->author_id);
        }
        else {
            return $this->data[$k];
        }
    }
}