<?php 
namespace helper;

use Source\Controllers\Web;

class Seguranca extends Web
{
    public function __construct(){

        if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])){
            header('location:' . url());
        }
    }
}