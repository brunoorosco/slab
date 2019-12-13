<?php

namespace Source\Controllers;

use League\Plates\Engine;
use Source\Models\EnsaioModel;

define("ROTA","../Source/Views/ensaio/"); 

class EnsaioController
{
    private $view;

    public function __construct()
    {
        $this->view = Engine::create(__DIR__."/../../theme","php");
    }

    public function ensaios($norma):void
    {  
       // echo $email;
       //$user = User::login($email,$senha);
       $ensaios = (new EnsaioModel())->find()->fetch(true);
      // var_dump($comps);
       echo $this->view->render(ROTA."ensaio",[
           "title" => "Ensaios | ". SITE,
           "ensaios" => $ensaios
           
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

    public function excluir($data)
    {
        if (empty($data["id"])) return;

        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $norma = (new EnsaioModel())->findById($id);
        var_dump($norma);
        if ($norma) {
            $norma->destroy();
        }
        $callback = true;
        echo json_encode($callback);
    }

}