<?php

namespace Source\Controllers;

use Source\Models\CompModel;

//define("ROTA","../Source/Views/composicao/"); 

class CompController extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);
        // $this->view = Engine::create(__DIR__ . "/../../theme", "php");
    }

    public function home($email):void
    {  
       // echo $email;
       //$user = User::login($email,$senha);
       $comps = (new CompModel())->find()->fetch(true);
      // var_dump($comps);
       echo $this->view->render("../composicao/listar",[
           "title" => "Composições | ". SITE,
           "composicoes" => $comps
           
       ]);
    }
    public function adicionar($email):void
    {  
       // echo $email;
       //$user = User::login($email,$senha);
     //$users = (new User())->find()->fetch(true);
       echo $this->view->render("../composicao/add",[
           "title" => "Home | ". SITE
           
       ]);
    }

    public function editar($data):void
    {
      // $users = (new User())->find()->fetch(true);
       echo $this->view->render("login/login",[
           "title" => "Composições | ",
           
       ]);
    }

    public function excluir($data):void
    {
        if (empty($data["id"])) return;

        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $equip = (new CompModel())->findById($id);
        var_dump($equip);
        if ($equip) {
            $equip->destroy();
        }
        $callback = true;
        echo json_encode($callback);
    }

}