<?php

namespace piola
{
    final class CAutoLoader
    {
        private $_dirs = array(
            '/piola/',
            '/piola/db/',
            '/piola/db/mysql/',
            '/piola/exceptions/',
            '/piola/patterns/',
            '/piola/patterns/mvc/',
            '/piola/patterns/repository/',
            '/piola/web/',
            '/piola/web/session/',
            '/app/',
            '/app/models/',
            '/app/models/repository/',
            '/app/controllers/',
            '/app/views/',
            '/app/viewmodels/',
        );
        
        public function __construct()
        {
            spl_autoload_register(array(
                $this,
                'autoload'
            ));
        }
        
        private function autoload($className)
        {
            $arrayParts = explode("\\", $className);
            $classSearch = $arrayParts[count($arrayParts) - 1];

            foreach($this->_dirs as $dir)
            {   
                if(is_readable(ROOT_DIR . $dir . $classSearch . '.php'))
                {
                    require_once(ROOT_DIR . $dir . $classSearch . '.php');
                    break;
                }
            }
        }
    }
}