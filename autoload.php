<?php
/*
 * Файл автозагрузки
 */

function my_autoload($class)
{
    $class = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($class)) {
        include_once $class;
        return true;
    }
    return false;
}

spl_autoload_register('my_autoload');
include_once __DIR__ . '/vendor/autoload.php';
