<?php

namespace piola\mvc
{
    use piola as piola;
    
    class ActionLink
    {
        public static function create($controller, $action = "index", array $params = array())
        {
            $sb = new piola\StringBuilder();
            $sb->Append("?controller=");
            $sb->Append($controller);
            $sb->Append("&action=");
            $sb->Append($action);
            foreach ($params as $key => $value)
            {
                $sb->Append("&");
                $sb->Append($key);
                $sb->Append("=");
                $sb->Append($value);
            }
            
            return (string)$sb;
        }
    }
}

?>