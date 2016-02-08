<?php


namespace App;


/**
 * Внешний итератор
 * Class MyIterator
 * @package App
 */
class MyIterator implements \Iterator
{
    private $data=[];

    /**
     * При создании объекта-итератера, ему передается массива
     * @param array $arr
     */
    public function __construct($arr)
    {
        $this->data = $arr;
    }

    /**
     * Возвращает итератор на первый элемент
     * @return mixed
     */
    function rewind()
    {
        return reset($this->data);
    }

    /**
     * Возвращает текущий элемент
     * @return mixed
     */
    function current()
    {
        return current($this->data);
    }

    /**
     * Возвращает ключ текущего элемента
     * @return mixed
     */
    function key()
    {
        return key($this->data);
    }

    /**
     * Переходит к следующему элементу
     * @return mixed
     */
    function next()
    {
        return next($this->data);
    }

    /**
     * Проверка корректности позиции
     * @return bool
     */
    function valid()
    {
        return key($this->data) !== null;
    }
}