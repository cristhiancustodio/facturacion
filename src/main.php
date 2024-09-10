<?php

declare(strict_types=1);

namespace src;

class main
{
    public function __construct(){
    }

    public function index(){
        include __DIR__.'./view/formulario.php';
    }
}
