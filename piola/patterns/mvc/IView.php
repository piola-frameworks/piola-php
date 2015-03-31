<?php

namespace piola\mvc
{
    interface IView
    {
        public function render();
        public function redirect($location);
    }
}

?>