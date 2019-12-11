<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class User extends DataLayer
{
    public function __construct()
    {
        parent::__construct("funcionarios", ["email", "usuario"]);
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
