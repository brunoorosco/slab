<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use Exception;
use Source\Models\FuncionarioModel;


class User extends DataLayer
{
    public function __construct()
    {
        $_SESSION['codUsuario'];
    }

    function autenticar($data)
    {
        $senhaCriptografada = md5($data['senha']);
        $usuario = ($data['user']);

        $model = new FuncionarioModel();
        var_dump($model);

        $user = $model->find(
            "Senha = :s AND Usuario = :u",
            "s={$senhaCriptografada} & u={$usuario}"
        )->fetch();


        // return $user;
        if ($user != null) {
            $codigoUsuario = $user->Codigo;
            $_SESSION['usuario'] = $user->Usuario;
            $_SESSION['codUsuario'] = $codigoUsuario;
            $_SESSION['userName'] = $user->Nome;

            return true;
        } else {
            $codigoUsuario = 0;
            $callback["message"] = "Usuario ou Senha incorretos!";
            $callback["action"] = "error";
            return false;
        }
    }

    protected function validaEmail(): bool
    {
        if(empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $this->fail = new Exception("Informe um e-mail válido");
            return false;
        }
        
        $userByEmail = null;

        if(!$this->id){
            $userByEmail = $this->find("Email = :email","email={$this->email}")->count();
        }else{
            $userByEmail = $this->find("Email = :email AND Codigo != :id", "email={$this->email} & id={$this->id}")->count();
        }

        if($userByEmail){
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

    public static function sair()
    {
        unset($_SESSION['CodUsuario']);
        unset($_SESSION['Usuario']);
        $_SESSION = array();
        return true;
    }

    public static function login($email, $senha)
    {
        // Sanitizar
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $senha = filter_var($senha, FILTER_SANITIZE_STRING);
        //$usuario = CandidatoModel::obterPorEmail($email);

        // $user = $model->find("usuario = :email", "senha= :senha")->fetch();
        // echo $user->first_name;


        $usuario = User::obterPorEmail($email);
        $retorno = array();
        if ($usuario != false) {
            if ($usuario->password == md5($senha)) {
                // Autentica-lo
                $retorno['sucesso'] = true;
                $retorno['nome'] = $usuario->nome;
                $_SESSION['id_candidato'] = $usuario->id;
                //            "autenticado: true";
                //            var_dump($usuario);
            } else {
                $retorno['sucesso'] = false;
                $retorno['mensagem'] = "Senha incorreta!";
            }
        } else {
            // Retornar erro
            $retorno['sucesso'] = false;
            $retorno['mensagem'] = "Usuário inexistente!";
        }
        echo json_encode($retorno);
    }

    public static function obterPorEmail($email)
    {
        $sql = "select *
                from funcionarios
                where email = '$email'";
        //$result = Db::query($sql);
        $result = "";
        if (count($result) == 0) {
            return false;
        } else if (count($result) == 1) {
            return $result[0];
        } else {
            return false;
        }
    }


    //   if(!isset($_SESSION))session_start(); //verifica se a sessão aberta

    //   function autenticar($login, $senha) {
    //         $pdo = Banco::conectar();
    //         $sql = "SELECT username, password, id, nivel_acesso FROM acessonew where username = '$login' AND password = '$senha'";
    //         //echo $sql;
    //         $exec =  $pdo->query($sql);
    //         $rows = $exec->fetchAll(PDO::FETCH_ASSOC);
    //         $total = count($rows);

    //         if ($total > 0){
    //             $codigoUsuario = $rows[0]['id'];
    //             $_SESSION['usuario'] = $rows[0]['username'];
    //             $_SESSION['nivel'] = $rows[0]['nivel_acesso'];
    //             $_SESSION['COD_USUARIO'] = $codigoUsuario;

    //             return $codigoUsuario;
    //         }
    //         else{
    //           $codigoUsuario = 0;
    //           return $codigoUsuario;
    //         }
    //   }

}
