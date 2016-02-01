<?php
/**
 * Создание класса Config (Singleton)
 * $config = App\Config::instance();
 * echo $config->data['db']['host'];
 */

namespace App;


class Config
{
    use Singleton;
    public $data = [];

    protected function __construct()
    {
        $this->data = include_once __DIR__ . '/db_config.php';
    }
}