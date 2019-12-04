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
        $email = filter_var($email,FILTER_VALIDATE_EMAIL);
        $senha = filter_var($senha,FILTER_SANITIZE_STRING);
        //$candidato = CandidatoModel::obterPorEmail($email);
        $candidato = User::obterPorEmail($email);
        $retorno = array();
        if ($candidato!=false){
            if ($candidato->password==md5($senha)) {
                // Autentica-lo
                $retorno['sucesso'] = true;
                $retorno['nome'] = $candidato->nome;
                $_SESSION['id_candidato'] = $candidato->id;
                //            "autenticado: true";
                //            var_dump($candidato);
            } else {
                $retorno['sucesso']=false;
                $retorno['mensagem']="Senha incorreta!";
            }
        } else {
            // Retornar erro
            $retorno['sucesso']=false;
            $retorno['mensagem']="Usuário inexistente!";
        }
        echo json_encode($retorno);
    }

    public static function obterPorEmail($email)
    {
        $sql = "select *
                from candidatos
                where email = '$email'";
        //$result = Db::query($sql);
        $result = "";
        if (count($result)==0){
            return false;
        } else if (count($result)==1){
            return $result[0];
        } else {
            return false;
        }
    }

}