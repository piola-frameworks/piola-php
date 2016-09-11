<?php

namespace piola\web\http\method;

class CHttpGetMethod extends AHttpMethod
{
    public static function getValue($key, $filter = FILTER_DEFAULT)
    {
        return filter_input(INPUT_GET, $key, $filter);
    }
}    

?>
