<?php

namespace Source\Controllers;

use League\Plates\Engine;
use Source\Models\EquipModel;

define("ROTA","../Source/Views/equipamento/"); 

class EquipController
{
    private $view;

    public function __construct()
    {
        $this->view = Engine::create(__DIR__."/../../theme","php");
    }

    public function todos($email):void
    {  
       // echo $email;
       //$user = User::login($email,$senha);
       $equipamentos = (new EquipModel())->find()->fetch(true);
      // var_dump($comps);
       echo $this->view->render(ROTA."todos",[
           "title" => "Equipamentos | ". SITE,
           "equips" => $equipamentos
           
       ]);
    }
    public function adicionar($email):void
    {  
       // echo $email;
       //$user = User::login($email,$senha);
     //$users = (new User())->find()->fetch(true);
       echo $this->view->render(ROTA."novo",[
           "title" => "Home | ". SITE
           
       ]);
    }

    public function editar($data):void
    {
      // $users = (new User())->find()->fetch(true);
       echo $this->view->render("login/login",[
           "title" => "Login | ",
           
       ]);
    }

    public function excluir($data):void
    {
       $users = (new EquipModel())->find()->fetch(true);
       echo $this->view->render("login/login",[
           "title" => "Autenticacao | ". SITE,
           
       ]);
    }

}