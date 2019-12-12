<?php


namespace Source\Models;

use Db;
use CoffeeCode\DataLayer\DataLayer;

class Composicao extends DataLayer
{
    public function __construct()
    {
        //parent::__construct("tbl_empresas", ["CodigoCliente", "Nome","Endereco","Numero","CNPJ","Contato", 
        // "Email", "Telefone", "Ie","CEP","Fax","Ramal","Bairro","Cidade","Estado","Sgset","Status","CPF","Telefone2","Celular"], "Codigo");
        parent::__construct("composicoes", ["Nome", "Status"], "Codigo",false);
    }
    // /**Executa pesquisa das ordens de serviço da empresa escolhida */
    // public function OsEmpresa()
    // {
    //     return (new Address())->find("CodigoCliente = :uid", "uid={$this->id}")->fetch(true);
    // }
    
    // public function buscarEmpresa($nome)
    // {
    //      $sql = "select * from tbl_empresas where CNPJ={$nome['cnpj']}";
    //      $result = Db::query($sql);
    //      $empresa = $result[0];
    //      return json_encode($empresa);
    //     //return (new Empresa())->find("CNPJ = :nome","nome={$nome}")->fetch(false);
    // }
   
}