<?php

namespace DavidNineRoc\EasyExtends\Database;


class Table
{
    protected $tableName;
    protected $data;


    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }

    public function insert($value)
    {
        $this->data[] = $value;
    }

    public function select()
    {
        var_dump($this->data);
    }
}