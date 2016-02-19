<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.02.2016
 * Time: 10:03
 */

namespace App\Exceptions;


class MyException extends \Exception
{
    use toString;

    public function getMess()
    {
        return $this->getMessage()
        . '| [file]: ' . $this->getFile() . '; | '
        . '[line]: ' . $this->getLine() . '; | '
        . '[code]: ' . $this->getCode() . ";\n";
    }
}