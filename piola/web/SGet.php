<?php

namespace piola\web
{
    class SGet
    {
        public static function getValue($key, $filter = FILTER_DEFAULT)
        {
            return filter_input(INPUT_GET, $key, $filter);
        }
    }    
}

?>
