<?php

namespace App;

class AdminDataTable
{
    use MagicFunc;

    public function __construct(array $obj, $func)
    {
        $this->data['row'] = $obj;
        $this->data['col'] = $func;
    }

}