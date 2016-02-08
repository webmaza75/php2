<?php

namespace App\Models;

use App\Model;
use App\MagicFunc;

/**
 * Class Author класс автора
 * @package App\Models
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