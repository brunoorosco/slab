<?php

namespace Source\Controllers;

use Source\Models\CompModel;
use Source\Models\FuncionarioModel;

class CompController extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);
        if (empty($_SESSION["user"]) || !$this->user = (new FuncionarioModel())->findById($_SESSION["user"])) {
            unset($_SESSION["user"]);
           
            flash("error", "Acesso negado!");
            $this->router->redirect("web.login");
        }
    }

    public function home($email):void
    {  
       // echo $email;
       //$user = User::login($email,$senha);
       $comps = (new CompModel())->find()->fetch(true);
      // var_dump($comps);
       echo $this->view->render("../composicao/listar",[
           "title" => "Composições | ". SITE['name'],
           "composicoes" => $comps
           
       ]);
    }
    public function adicionar($email):void
    {  
       // echo $email;
       //$user = User::login($email,$senha);
     //$users = (new User())->find()->fetch(true);
       echo $this->view->render("../composicao/add",[
           "title" => "Home | ". SITE['name']
           
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