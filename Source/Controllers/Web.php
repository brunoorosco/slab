<?php

namespace Source\Controllers;

use Source\Models\User;
use Source\Models\FuncionarioModel;

class Web extends Controller
{
    /** @var User */
    protected $Usuario;

    public function __construct($router)
    {
        parent::__construct($router);
                
        if (empty($_SESSION["usuario"]) || !$this->Usuario = (new User())->findById($_SESSION["usuario"])) {
            unset($_SESSION["usuario"]);
            var_dump($this->Usuario);
        //     flash("error", "Acesso negado!");
            $this->router->redirect("web.login");
         }
    }

    public function home($email): void
    {

        echo $this->view->render("home", [
                    "title" => "Home | " . SITE['name'],
                    "error" => null //provisorio
     ]);

        // $autenticado = User::validarUsuario();

        // if ($autenticado != 0) {
        //     echo $this->view->render("home", [
        //         "title" => "Home | " . SITE['name'],
        //         "error" => null //provisorio
        //     ]);
        // } else {
        //     echo $this->view->render("home", [
        //         "title" => "Home | " . SITE['name'],
        //         "error" => null //provisorio
        //     ]);
        // }
    }


    public function login($data): void
    {

        $model = new FuncionarioModel();
        $autenticado = User::autenticar($data);
        if ($autenticado != 0) {
            $user = $model->findById($_SESSION['codUsuario']);
            //  var_dump($user);
            echo $this->view->render("../home", [
                "title" => "Home | " . SITE['name'],
                "user" => $user
            ]);
        } else {
            echo $this->view->render("home", [
                "title" => "Login | " . SITE['name'],
                "error" => "Usuário ou senha Incorreto!"
                //   "autentic" => $autenticado
            ]);
        }



        echo $this->view->render("../home", [
            "title" => "Home | " . SITE['name'],
            "user" => "Bruno"
        ]);
    }



    public function logout($data): void
    {

        $inicio = User::sair();
        // $users = (new User())->find()->fetch(true);
        if ($inicio) {
            flash("info","Você saiu com sucesso!");
            $this->router->redirect("web.home");

            // echo $this->view->render("home", [
            //     "title" => "Login | " . SITE['name'],
            //     //   "autentic" => $autenticado
            //     "error" => null
            // ]);
        }
    }



    public function contato($data): void
    {
        echo "<h1>Contato</h1>";
        //var_dump($data);
        $url = SITE['root'];
        require __DIR__ . "../../Views/contato.php";
    }


    public function error($data): void
    {

        echo $this->view->render("error", [
            "title" => "Erro | {$data["errcode"]}" . SITE['name'],
            "error" => $data["errcode"]
        ]);
    }
}
