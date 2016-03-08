<?php

namespace App;

class AdminDataTable
{
    use MagicFunc;

    public function __construct($obj, array $func)
    {
        $this->data['row'] = $obj;
        $this->data['col'] = $func;
    }

    public function render()
    {
        $res = [];
        foreach ($this->data['row'] as $key => $model) {
            foreach ($this->data['col'] as $func) {
                $res[$key][] = $func($model);
            }
        }
        return $res;
    }
}