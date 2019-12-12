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

    public function home($email):void
    {  
       $autenticado = User::validarUsuario();

       echo $this->view->render("home",[
           "title" => "Home | ". SITE,
           "autentic" => $autenticado
           
       ]);
    }

    public function login($data):void
    {
        $autenticado = User::autenticar($data); 
      // $users = (new User())->find()->fetch(true);
       echo $this->view->render("home",[
           "title" => "Login | ",
           "autentic" => $autenticado
       ]);
    }

    public function contato($data):void
    {
        echo "<h1>Contato</h1>";
        //var_dump($data);
        $url = ROOT;
        require __DIR__."../../Views/contato.php";
    }

      
    public function error($data):void 
    {
        echo $this->view->render("error",[
            "title" => "Erro | {$data["errcode"]}". SITE,
            "error" => $data["errcode"]
        ]);
      
    }
}