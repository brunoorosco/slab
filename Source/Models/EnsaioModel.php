<?php


namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class EnsaioModel extends DataLayer
{
    public function __construct()
    {
        parent::__construct("tiposdeensaios", ["Nome", "CodEnsaio","Carga","Preco"], "Codigo",false);
    }
   
}

