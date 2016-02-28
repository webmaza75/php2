<?php

namespace App;

/**
 * Class View класс представления
 * @package App
 * @property array $data массив свойств
 */
class View implements \Countable, \ArrayAccess
{
    protected $data =[];

    /**
     * Формирование контента страницы для вывода в браузере
     * @param string $template путь к шаблону страницы
     * @return string содержимое (контент) страницы для вывода в браузере
     */
    public function render($template)
    {
        $time = \PHP_Timer::resourceUsage();
        ob_start();
        foreach ($this as $prop => $value) {
            $$prop = $value;
        }
        include $template;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    /**
     * Вывод страницы в браузере для пользователя
     * @param string $template путь к шаблону страницы
     */
    public function display($template)
    {
        echo $this->render($template);
    }

    public function renderTwig($layout, $params = [])
    {
        $time = \PHP_Timer::resourceUsage();
        $params['time'] = $time;
        $loader = new \Twig_Loader_Filesystem([
            str_replace('\\', '/', __DIR__ . '/layouts'),
            str_replace('\\', '/', __DIR__ . '/templates')
        ]);
        $twig = new \Twig_Environment($loader, ['cache' => false]);
        $content = $twig->render($layout, $params);
        return $content;
    }

    public function displayTwig($layout, $params = [])
    {
        echo $this->renderTwig($layout, $params);
    }


    /**
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return count($this->data);
    }

    /**
     * Устанавливает заданное смещение (ключ)
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    /**
     * Определяет, существует ли заданное смещение (ключ)
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * Удаляет смещение
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    /**
     * Возвращает заданное смещение (ключ)
     * @param mixed $offset
     * @return null
     */
    public function offsetGet($offset)
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }
}

