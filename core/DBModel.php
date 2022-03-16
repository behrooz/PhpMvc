<?php

namespace app\core;

abstract class DBModel extends Model
{
    abstract public function tableName():string;

    public function save()
    {
        $tableName = $this->tableName();

    }
}