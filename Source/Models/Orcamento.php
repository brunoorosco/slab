<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Empresa extends DataLayer
{
    public function __construct()
    {
        parent::__construct("orcamento", ["valorFinal","CargaFinal","NomeEns","CodpedEns", "Quantidade","CodEnsaio", "ServicoOper","InfTecnologia","DataReg", "HoraReg", "Usuario", "Status"], "Codigo");
    }
    
    
    
}
