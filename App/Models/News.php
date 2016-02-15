<?php

namespace App\Models;

use App\Model;


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

    /**
     * @param array $arr - $_POST из формы редактирования
     * @return $this|bool
     */
    public function setFromForm($arr)
    {
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
                            return false;
                        }
                    }

                    if (!empty($v) && !is_numeric($v)) {
                        return false;
                    }

                    if (empty($v)) {
                        $this->author_id = null;
                    }

                    break;
                case ('title'):
                case ('content'):
                    $this->$k = !empty($v) ? $v : null;
                    break;
            }
        }
        return $this;
    }
}