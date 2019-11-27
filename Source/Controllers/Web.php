<?php

namespace Source\Controllers;

use League\Plates\Engine;
use Source\Models\User;

class Web
{
    private $view;

    public function __construct()
    {
        $this->view = Engine::create(__DIR__."/../../theme","php");
    }
    public function home($data):void
    {
       $users = (new User())->find()->fetch(true);
       echo $this->view->render("home",[
           "title" => "Home | ". SITE,
           "users" => $users
       ]);
    }

    public function login($data):void
    {
       $users = (new User())->find()->fetch(true);
       echo $this->view->render("login/login",[
           "title" => "Autenticacao | ". SITE,
           
       ]);
    }

    public function autenticar($data):void
    {
       $users = (new User())->find()->fetch(true);
       echo $this->view->render("login/login",[
           "title" => "Autenticacao | ". SITE,
           
       ]);
    }

    public function layout($data):void
    {
       $users = (new User())->find()->fetch(true);
       echo $this->view->render("teste",[
           "title" => "teste | ". SITE,
           "users" => $users
       ]);
    }
    public function contato($data):void
    {
        echo "<h1>Contato</h1>";
        //var_dump($data);
        $url = URL_BASE;
        require __DIR__."../../Views/contato.php";
    }

    public function orcamento($data):void
    {
        //var_dump($data);
        echo $this->view->render("atendimento/orcamento",[
            "title" => "Orçamento | ". SITE
            
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