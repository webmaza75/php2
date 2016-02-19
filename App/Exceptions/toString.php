<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.02.2016
 * Time: 9:12
 */

namespace App\Exceptions;


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