<?php

namespace piola
{
    final class OutputBuffer
    {
        public static function start(callable $outputCallback = null, $chunkSize = 0)
        {
            if (!ob_start($outputCallback, $chunkSize, false))
            {
                throw new \Exception("Hubo algun error en activar el búfer de salida.");
            }
        }

        public static function currentContent()
        {
            if (!ob_get_contents())
            {
                throw new Exception("No esta activado el búfer de salida.");
            }
        }

        public static function lenght()
        {
            $value = ob_get_length();
            if ($value === false)
            {
                throw new \Exception("No esta activado el búfer de salida.");
            }

            return $value;
        }

        /**
         * 
         * @return int
         */
        public static function currentLevel()
        {
            return ob_get_level();
        }
        
        /**
         * 
         * @param bool $fullStatus
         * @return array
         */
        public static function getStatus($fullStatus = false)
        {
            $statusArray = ob_get_status($fullStatus);
            $statusObject = null;
            
            if ($fullStatus)
            {
                throw new \Exception("Funcion no implementada.");
            }
            else
            {
                $statusObject = OutputBufferStatus::Create(
                        $statusArray["level"], 
                        $statusArray["type"], 
                        $statusArray["status"], 
                        $statusArray["name"], 
                        $statusArray["del"]);
            }        
                    
            return $statusObject;
        }
        
        public static function flush()
        {
            ob_flush();
        }

        public static function clean()
        {
            ob_clean();
        }

        public static function end()
        {
            if (!ob_end_clean())
            {
                //throw new \Exception("No esta activado el búfer de salida o no hay ningun contenido el mismo.");
            }
        }
    }
}

?>