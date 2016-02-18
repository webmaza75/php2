<?php

namespace App\Models;

use App\Model;
use App\MultiException;

//use App\MultiException;

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
    protected $data = [];

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
                return $this->data[$k];
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

    /**
     * @param array $arr - $_POST из формы редактирования
     * @return $this|bool
     */

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
        $notNullColumn = $this->getNotNullCol();
        $e = new MultiException();

        foreach ($arr as $k => $v) {
            $k = trim($k);
            $v = trim($v);

            switch ($k) {
                case ('id'):
                    $this->$k = (int)$v;
                    break;
                case ('author'):
                    if (!empty($v) && is_numeric($v)) {
                        $auth = \App\Models\Author::findById($v);
                        if ($auth) {
                            $this->author_id = $v;
                        } else {
                            $e[] = new MultiException('Некорректное значение в поле Автор (автор не существует)');
                        }
                    }

                    if (empty($v)) {
                        $this->author_id = null;
                    }

                    break;
                case ('title'):
                    if (in_array($k, $notNullColumn) && empty($v))
                    {
                        $e[] = new MultiException('Поле заголовка не должно быть пустым');
                    }
                    $this->$k = $v;

                break;
                case ('content'):
                    if (in_array($k, $notNullColumn) && empty($v))
                    {
                        $e[] = new MultiException('Поле текста не должно быть пустым');
                    }
                    $this->$k = $v;

                    break;
            }
        }
        if (!empty($e)) {
            throw $e;
        }
        return $this;
    }
    /*
     * select column_name nonnull_column from information_schema.columns where table_schema = 'php2' and  table_name = 'news' and   is_nullable = 'NO'
     * */


/*
    public function fill($data = []) {
        $e = new MultiException();
        if (true) {
            $e[] = new \Exception('Заголовок неверный');
        }
        if (true) {
            $e[] = new \Exception('Текст неверный');
        }
        throw $e;
    }
*/
}