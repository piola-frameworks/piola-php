<?php

namespace piola\web\session
{
    class SessionManager
    {
        const DEFUALT_NAME = "PHPSESSID";
        
        public static function start()
        {
            $id = session_id();
            $name = session_name(self::DEFUALT_NAME);
            
            if (!session_start())
            {
                throw new Exception("No se puede iniciar una sesion.");
            }
            
            return new SessionObject($id, $name);
        }
        
        /**
         * 
         * @return int
         */
        public static function status()
        {
            $sessionStatusValue = 0;
            
            if (php_sapi_name() !== "cli")
            {
                if (version_compare(phpversion(), '5.4.0', '>='))
                {
                    $sessionStatusValue = session_status();
                }
                else
                {
                    $sessionStatusValue = session_id() === '' ? 2 : 1;
                }
            }
            
            return $sessionStatusValue;
        }

        public static function clean()
        {
            session_unset();
        }

        public static function destroy()
        {
            session_destroy();
        }
    }
}

?>