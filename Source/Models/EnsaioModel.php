<?php


namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class EnsaioModel extends DataLayer
{
    public function __construct()
    {
        parent::__construct(
            "tiposdeensaios",
            [
                "Nome", //nome do Ensaio 
                "CodEnsaio", //referente se vestuario ou textil
                "Carga", //tempo médio para cada tipo de ensaio
                "Preco" //custo para cada ensaio
            ],
            "Codigo",
            false
        );
    }
       
    public function ensaioNorma()
    {
      return (new NormaModel())->find("Codigo = :uid","uid={$this->codNorma}")->fetch(true);
      
    }
    // public function ensaioNorma($data)
    // {
    //    // $norma = (new NormaModel())->find("Codigo = :uid","uid={$this->codNorma}")->fetch(true);
    //    if($data->codNorma)
    //    {
    //     $norma = (new NormaModel())->findbyId($data->codNorma);
    //      return $norma;
    //     }
    //     return false;
    // }

}
