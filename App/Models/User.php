<?php

// require __DIR__."/../../vendor/autoload.php";
namespace App\Models;

use CoffeCode\Datalayer\Datalayer;

class User extends Datalayer
{
    public function __construct()
    {
        parent::__construct("membros",[],"idmembros", true);
        
    }
}
 