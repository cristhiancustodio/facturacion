<?php

declare(strict_types=1);

namespace src\View;

class main
{
    public function __construct(){
    }

    public function index(){
        include __DIR__.'/formulario.php';
    }
}
