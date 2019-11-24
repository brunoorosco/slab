<?php

namespace App\Models;


use CoffeeCode\DataLayer\Connect;
use CoffeeCode\DataLayer\DataLayer;

class Members extends DataLayer{
    public function __construct()
    {
        parent::__construct("membros",["nome","supervisao"]);
    }
    public function curso(){
        return (new Curso())->find()->fetch(true);
    }
}