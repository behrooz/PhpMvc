<?php

namespace app\core\form;

use app\core\Model;

class Form
{
    public static function beginForm($action,$method){

        echo sprintf('<form action="%s" method="%s">',$action, $method);
        return new Form();
    }

    public static function end()
    {
        return '</fomr>';
    }

    public function field(Model $model,$attribute)
    {
        return new Field($model,$attribute);
    }
}