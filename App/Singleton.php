<?php
/**
 * Реализован трейт (trait) Singleton
 */

namespace App;

/**
 * Class Singleton трейт Singleton
 * @package App
 */
trait Singleton
{
    /**
     * @var object $instance статическое свойство класса,
     * может содержать единственный объект данного класса
     */
    protected static $instance;

    /**
     * Защищенный конструктор
     */
    protected function __construct()
    {
    }

    /**
     * Статический метод возвращает единственный объект
     * @return object
     */
    public static function instance()
    {
        // Если переменная не имеет значения (null), т.е. не существует объект static
        if (is_null(static::$instance)) {
            // Создать объект static
            static::$instance = new static;
        }
        return static::$instance;
    }
}