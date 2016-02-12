<?php
/*
 * Файл автозагрузки
 */

function __autoload($class)
{
    $class = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($class)) {
        require_once $class;
        return true;
    }
    return false;
}