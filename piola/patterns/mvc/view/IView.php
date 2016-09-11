<?php

namespace piola\patterns\mvc\view;

interface IView
{
    public function render();
    public function redirect($location);
}