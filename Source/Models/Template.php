<?php

namespace Source\Models;

use League\Plates\Engine;

class Template
{
    
    private $view;

    public function __construct()
    {
        $this->view = Engine::create(__DIR__ . "/../../theme", "php");
        
    }
}