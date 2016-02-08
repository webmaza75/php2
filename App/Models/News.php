<?php

namespace App\Models;

use App\MagicFunc;
use App\Model;
use App\Db;

/**
 * Class News класс новости
 * @package App\Models
 */
class News extends Model
{
    /**
     * Используется трейт с магическими функциями
     */
    use MagicFunc;
    /**
     * Table name имя таблицы
     */
    const TABLE = 'news';

    /**
     * Метод получения имени автора новости по его id
     * @param integer $authorId Id of the author
     * @return mixed (bool|string)
     */
    public function getAuthor($authorId)
    {
        if (empty($authorId)) {
            return false;
        }
        $id = (int)$authorId;
        $db = Db::instance();
        $args = [':id' => $id];
        $sql = 'SELECT * FROM ' . \App\Models\Author::TABLE . ' WHERE `id`=:id;';
        $res = $db->query(\App\Models\Author::class, $sql, $args);
        if (!$res) {
            return false;
        }
        return $res[0]->name;
    }
}