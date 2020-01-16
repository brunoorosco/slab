<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use Exception;
use Source\Models\FuncionarioModel;


class User extends DataLayer
{
    protected function validaEmail(): bool
    {
        if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->fail = new Exception("Informe um e-mail válido");
            return false;
        }

        $userByEmail = null;

        if (!$this->id) {
            $userByEmail = $this->find("Email = :email", "email={$this->email}")->count();
        } else {
            $userByEmail = $this->find("Email = :email AND Codigo != :id", "email={$this->email} & id={$this->id}")->count();
        }

        if ($userByEmail) {
            $this->fail = new Exception("O e-mail informado já esta em uso");
        }
        return true;
    }

    public static function validarUsuario()
    {
        if (($_SESSION['codUsuario'] != '')) {
            return $_SESSION['codUsuario'];
        } else {
            return false;
            //   autenticar(); 
            //header("location:app/login/login.php");
            $_SESSION['msg_login'] = "<div id='message' class='alert alert-warning' role='alert'><strong>É necessário estar logado ao sistema!!!</strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            // header("Location:" .$URLBASE);
        }
    }

}
