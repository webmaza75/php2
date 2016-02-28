<?php

namespace App\Models;

use App\Exceptions\Err404;
use App\Exceptions\MyException;
use App\Model;
use App\MultiException;

/**
 * Модель News для таблицы "news"
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property integer $author_id
 * @property-read Author $author
 */
class News extends Model
{
    /**
     * @var array $data Array of Properties
     */
    public $id;
    public $title;
    public $content;
    public $author_id;

    /**
     * Table name имя таблицы
     */
    const TABLE = 'news';

    /**
     * LAZY LOAD
     *
     * @param $k
     * @return mixed (null|object)
     */
    public function __get($k)
    {
        switch ($k) {
            case 'author':
                return Author::findById($this->author_id);
                break;
            default:
                //return $this->$k;
                return null;
        }
    }

    /**
     * Проверка на существование свойства объекта по его имени (ключу)
     * @param mixed $k Property name
     * @return bool
     */
    public function __isset($k)
    {
        switch ($k) {
            case 'author':
                return !empty($this->author_id);
                break;
            default:
                return false;
        }
    }

    public function __set($k, $v)
    {
        $this->$k = $v;
    }

    /**
     * Получаем из БД столбцы таблицы, на которые наложены ограничение NotNull
     * @return array
     */
    public function getNotNullCol()
    {
        $arrNotNull = \App\Models\News::getNotNull();
        $notNullColumn = [];
        foreach ($arrNotNull as $obj) {
            $notNullColumn[] = $obj->column_name;
        }
        return $notNullColumn;
    }

    public function fill($arr)
    {
        foreach ($arr as $k => $v) {
            $k = trim($k);
            $v = trim($v);

            if ('author' == $k) {
                continue;
            }
            $this->{$k} = $v;
        }
        $this->author_id = (!empty($this->author_id)) ? $this->author_id : null;

        // Достаем из БД массив полей с ограничением NotNull
        $notNullColumn = $this->getNotNullCol();
        $e = new \Lib\MultiException();

        foreach ($this as $k => $v) {
            if (in_array($k, $notNullColumn) && (empty($v) || '' == $v) && 'id' != $k)
            {
                $msg = ('title' == $k) ? 'заголовка' : 'текста новости';
                $e[] = new MyException('Проверка данных: пустое поле ' . $msg . ' ');
            }
        }
        if (!empty($this->author_id)) {
            $auth = \App\Models\Author::findById($this->author_id);
            if (!$auth) {
                $e[] = new Err404 ('Проверка данных: такой автор не существует ');
            }
        }
        if (!is_null($e[0])) {
            throw $e;
        }
        return $this;
    }
}