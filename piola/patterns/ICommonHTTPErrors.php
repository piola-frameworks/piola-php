<?php

namespace piola\patterns
{
    interface ICommonHTTPErrors
    {
        public function error400();
        public function error401();
        public function error403();
        public function error404();
        public function error500();
    }
}

?>