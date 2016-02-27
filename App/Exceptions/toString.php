<?php

namespace App\Exceptions;

/**
 * Trait toString используется для логирования исключений
 * @package App\Exceptions
 */
trait toString
{
    public function toString()
    {
        return date('d-m-Y H:m:s ')
        . parent::__toString() . ' : '
        . parent::getFile() . ' : '
        . parent::getLine() . ' : '
        . parent::getCode() . '\n';
    }
}