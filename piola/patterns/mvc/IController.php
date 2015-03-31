<?php

namespace piola\mvc
{
    interface IController
    {
        public function onAfterAction(\Closure $function = null);
        public function onBeforeAction(\Closure $function = null);
        public function index();
    }
}

?>