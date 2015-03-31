<?php

namespace piola\web
{
    class SPost
    {
        const AS_EMAIL = FILTER_SANITIZE_EMAIL;
        const AS_URL = FILTER_SANITIZE_ENCODED;
        const AS_URL_RAW = FILTER_SANITIZE_URL;
        const AS_FLOAT = FILTER_SANITIZE_NUMBER_FLOAT;
        const AS_INT = FILTER_SANITIZE_NUMBER_INT;
        const AS_SPECIAL_CHARS = FILTER_SANITIZE_SPECIAL_CHARS;
        const AS_STRING = FILTER_SANITIZE_STRING;
        
        public static function getValue($key, $filter = self::AS_STRING)
        {
            return filter_input(INPUT_POST, $key, $filter);
        }
    }
}

?>