<?php

namespace Source\Controllers;

use Source\Models\FuncionarioModel;

class Auth extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);
    }
    public function login($data): void
    {
        $email = filter_var($data["user"], FILTER_DEFAULT);
        $passwd = filter_var($data["passwd"], FILTER_DEFAULT);
     
        if (!$email || !$passwd) {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Informe seu e-mail e senha para logar"
            ]);
            return;
        }

        $user = (new FuncionarioModel())->find("Usuario = :e", "e={$email}")->fetch(false);
        $passwd = md5($passwd);
         //if (!$user || !password_verify($passwd, $user->passwd)) {
        if (!$user ||  $passwd != $user->Senha) {
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "E-mail ou senha não conferem!"
            ]);
            return;
        }

        $_SESSION["user"] = $user->Codigo;
        $_SESSION["userName"] = $user->Nome;
        $_SESSION["userJob"] = $user->Codigo;

        echo $this->ajaxResponse("redirect",["url" => $this->router->route("app.home")]);
    }

    public function register($data)
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        if (in_array("", $data)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Preencha todos os campos para cadastrar-se"
            ]);
            return;
        }

        $user = new FuncionarioModel();
        $user->Nome = $data["first_name"];
        $user->Email = $data["email"];
        $user->Senha = password_hash($data["passwd"], PASSWORD_DEFAULT);

        if (!$user->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $user->fail()->getMessage()
            ]);
            return;
        }

        $_SESSION["user"] = $user->id;
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("app.home")
        ]);
    }
}
