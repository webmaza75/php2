<?php

namespace App;

/**
 * Class MagicFunc (trait)
 * @package App
 */
trait MagicFunc
{
    /**
     * @var array $data Array of Properties
     */
    protected $data = [];

    /**
     * Магический метод добавления несуществующего свойства объекта
     * @param mixed $k Property name
     * @param mixed $v Property value
     */
    public function __set($k, $v)
    {
        $this->data[$k] = $v;
    }

    /**
     * Магический метод возвращения значения свойства объекта по его имени (ключу)
     * @param mixed $k Property name
     * @return mixed
     */
    public function __get($k)
    {
        return $this->data[$k];
    }

    /**
     * Проверка на существование свойства объекта по его имени (ключу)
     * @param mixed $k Property name
     * @return bool
     */
    public function __isset($k)
    {
        return array_key_exists($k, $this->data);
    }
}