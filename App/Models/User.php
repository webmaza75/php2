<?php


namespace App\Models;

use App\Model;

/**
 * Class User
 * @package App\Models
 * @var string $name User name
 * @var string $email email address
 */

class User extends Model implements HasEmail
{
    /**
     * Имя таблицы в БД
     */
    const TABLE = 'users';

    /**
     * @var string $name Имя пользователя
     */
    public $name;

    /**
     * @var string $email Адрес email
     */
    public $email;

    /**
     * Реализация метода интерфейса HasEmail получение адреса email объекта
     * @return string Email address
     */
    public function getEmail()
    {
        return $this->email;
    }
}