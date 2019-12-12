<?php

namespace Source\Controllers;

use League\Plates\Engine;
use Source\Models\Composicao;

define("ROTA","../Source/Views/composicao/"); 

class CompController
{
    private $view;

    public function __construct()
    {
        $this->view = Engine::create(__DIR__."/../../theme","php");
    }

    public function home($email):void
    {  
       // echo $email;
       //$user = User::login($email,$senha);
       $comps = (new Composicao())->find()->fetch(true);
      // var_dump($comps);
       echo $this->view->render(ROTA."listar",[
           "title" => "Composições | ". SITE,
           "composicoes" => $comps
           
       ]);
    }
    public function adicionar($email):void
    {  
       // echo $email;
       //$user = User::login($email,$senha);
     //$users = (new User())->find()->fetch(true);
       echo $this->view->render(ROTA."add",[
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
       $users = (new Composicao())->find()->fetch(true);
       echo $this->view->render("login/login",[
           "title" => "Autenticacao | ". SITE,
           
       ]);
    }

}