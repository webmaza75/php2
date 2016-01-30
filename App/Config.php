<?php
/**
 * Создание класса Config (Singleton)
 * $config = App\Config::instance();
 * echo $config->data['db']['host'];
 */

namespace App;


class Config
{
    public $data = [];
    protected static $instance;

    protected function __construct()
    {
        $this->data = include_once __DIR__ . '/db_config.php';
    }

    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new static;
        }
        return self::$instance;
    }
}