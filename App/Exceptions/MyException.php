<?php

namespace App\Exceptions;

use App\MagicFunc;

/**
 * Class MyException
 * @package App\Exceptions
 * @property array $data
 */
class MyException extends \Exception
{
    use MagicFunc;

    public function getMess()
    {
        $this->data['file'] = $this->getFile();
        $this->data['line'] = $this->getLine();
        $this->data['code'] = $this->getCode();
        return $this->data;
    }

    public function setExtParams($arr = [])
    {
        if (!empty($arr)) {
            foreach ($arr as $k => $v) {
                $this->data[$k] = $v;
            }
        }
    }
}