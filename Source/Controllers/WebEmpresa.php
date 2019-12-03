<?php

namespace Source\Controllers;

use League\Plates\Engine;
use Source\Models\Empresa;
use Source\Models\User;

class WebEmpresa
{
    private $view;

    public function __construct()
    {
        $this->view = Engine::create(__DIR__."/../../theme","php");
    }
    public function empresa($data):void
    {
        $empresas = (new Empresa())->find()->fetch(true);
        echo $this->view->render("empresas/consulta",[
            "title" => "Empresas | ". SITE,
            "empresas" => $empresas
        ]);
    }

    public function adicionar($data):void
    {
       $users = (new Empresa())->find()->fetch(true);
       echo $this->view->render("empresas/add",[
           "title" => "Cad. Empresa | ". SITE
           
       ]);
    }

    public function editar($data):void
    {
       $users = (new User())->find()->fetch(true);
       echo $this->view->render("teste",[
           "title" => "teste | ". SITE,
           "users" => $users
       ]);
    }
  
    public function error($data):void 
    {
        echo $this->view->render("error",[
            "title" => "Erro | {$data["errcode"]}". SITE,
            "error" => $data["errcode"]
        ]);
      
    }

    
}