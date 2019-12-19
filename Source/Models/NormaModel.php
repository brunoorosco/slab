<?php


namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class NormaModel extends DataLayer
{
    public function __construct()
    {
        parent::__construct("normas", ["Nome", "Status", "ano"], "Codigo",false);
    }
   
   
}