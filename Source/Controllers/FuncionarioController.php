<?php

namespace Source\Controllers;

use Source\Models\FuncionarioModel;

class FuncionarioController extends Controller
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

    public function todos($email):void
    {  
       // echo $email;
       //$user = User::login($email,$senha);
       $funcionarios = (new FuncionarioModel())->find()->fetch(true);
      // var_dump($comps);
       echo $this->view->render("funcionario/todos",[
           "title" => "Funcionários | ". SITE['name'],
           "funcs" => $funcionarios
           
       ]);
    }
    public function adicionar($email):void
    {  
       // echo $email;
       //$user = User::login($email,$senha);
     //$users = (new User())->find()->fetch(true);
       echo $this->view->render("funcionario/novo",[
           "title" => "Home | ". SITE['name']
           
       ]);
    }
    public function excluir($data):void
    {
        if (empty($data["id"])) return;

        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $func = (new FuncionarioModel())->findById($id);
        var_dump($func);
        if ($func) {
            $func->destroy();
        }
        $callback = true;
        echo json_encode($callback);
    }

    public function conta()
    {
        echo $this->view->render("funcionario/conta",[
            "title" => "Profile | ". SITE['name'],
            
        ]);
    }

}