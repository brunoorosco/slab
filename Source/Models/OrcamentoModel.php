<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class OrcamentoModel extends DataLayer
{
    public function __construct()
    {
        parent::__construct("orcamento", 
        [
            "valorEnsaio", 
            "codSequencial",
            "codEnsaio", 
            "quantidade"
        ], 
        "Codigo",
         true);
    } 
}
