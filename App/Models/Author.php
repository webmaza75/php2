<?php

namespace App\Models;

use App\Model;
use App\MagicFunc;

/**
 * Модель Author для таблицы "authors"
 * @package App\Models
 *
 * @property integer $id
 * @property string $name
 */
class Author extends Model
{
    /**
     * Используется трейт с магическими функциями
     */
    use MagicFunc;

    /**
     * Название таблицы
     */
    const TABLE = 'authors';
}