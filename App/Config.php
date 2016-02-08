<?php
/**
 * Создание класса Config (Singleton)
 * $config = App\Config::instance();
 * echo $config->data['db']['host'];
 */

namespace App;

/**
 * Class Config
 * @package App
 */
class Config
{
    /**
     * Использование трейта Singleton
     */
    use Singleton;

    /**
     * @var array|mixed
     */
    public $data = [];

    /**
     * Подключение файла конфигурации (параметров соединения с БД)
     */
    protected function __construct()
    {
        $this->data = include_once __DIR__ . '/db_config.php';
    }
}