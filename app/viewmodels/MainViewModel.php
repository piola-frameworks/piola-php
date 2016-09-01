<?php

namespace app\viewmodels;

use piola\patterns as patterns;

class MainViewModel extends patterns\AViewModel
{
    public function getIdUsuario()
    {
        return 1;
    }

    public function getNombreUsuario()
    {
        return "UnUsuario";
    }
}