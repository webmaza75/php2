<?php
/**
 * Реализован трейт (trait) Singleton
 */

namespace App;


trait Singleton
{
    protected static $instance;

    protected function __construct()
    {
    }

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