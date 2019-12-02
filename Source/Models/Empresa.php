<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Empresa extends DataLayer
{
    public function __construct()
    {
        parent::__construct("tbl_empresas", ["CodigoCliente", "Nome","Endereco","Numero","CNPJ","Contato", 
        "Email", "Telefone", "Ie","CEP","Fax","Ramal","Bairro","Cidade","Estado","Sgset","Status","CPF","Telefone2","Celular"], "Codigo");
    }
    /**Executa pesquisa das ordens de serviço da empresa escolhida */
    public function OsEmpresa()
    {
        return (new Address())->find("CodigoCliente = :uid","uid={$this->id}")->fetch(true);
    }   

}


// `Codigo` INT(10) NOT NULL AUTO_INCREMENT,
// `CodigoCliente` INT(10) NOT NULL,
// `Nome` VARCHAR(200) NOT NULL,
// `Endereco` VARCHAR(300) NOT NULL,
// `Numero` VARCHAR(30) NOT NULL,
// `CNPJ` VARCHAR(100) NOT NULL,
// `Contato` VARCHAR(200) NOT NULL,
// `Telefone` VARCHAR(20) NOT NULL,
// `Email` VARCHAR(200) NOT NULL,
// `Ie` VARCHAR(100) NOT NULL,
// `CEP` VARCHAR(15) NOT NULL,
// `Fax` VARCHAR(50) NOT NULL,
// `Ramal` VARCHAR(50) NOT NULL,
// `Bairro` VARCHAR(100) NOT NULL,
// `Cidade` VARCHAR(100) NOT NULL,
// `Estado` VARCHAR(5) NOT NULL,
// `Sgset` VARCHAR(10) NOT NULL,
// `Status` INT(2) NOT NULL,
// `CPF` VARCHAR(20) NOT NULL,
// `Telefone2` VARCHAR(20) NOT NULL,
// `Celular` VARCHAR(20) NOT NULL,