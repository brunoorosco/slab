<?php

namespace Source\Controllers;

use Source\Models\NormaModel;
use Source\Models\FuncionarioModel;

class NormaController extends Controller
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

    /** RESPONSAVEL POR CRIAR TABELA COM OS DADOS DO BANCO */
    public function normas($norma):void
    {  
       // echo $email;
       //$user = User::login($email,$senha);
       $normas = (new NormaModel())->find()->fetch(true);
      // var_dump($comps);
       echo $this->view->render("normas/normas",[
           "title" => "Normas | ". SITE['name'],
           "normas" => $normas
           
       ]);
    }

  /** RESPONSAVEL POR ADICIONAR NORMA */
    public function adicionar($data): void
    {
        $criar = $this->update_create($data, "create");
      
        //if ($empresa->save()) {
        if ($criar) {
            $callback["message"] = "Norma cadastrada com sucesso!";
            $callback["action"] = "success";
            echo json_encode($callback);
        } else {
            $callback["message"] = "Não foi possivel cadastrar!";
            $callback["action"] = "error";
            echo json_encode($callback);
        }
    }

    public function atualizar($data){
        $atualizar = $this->update_create($data,"update");
       // var_dump($data);
        //if ($empresa->save()) {
            if($atualizar){
            $callback["message"] = "Norma atualizado com sucesso!";
            $callback["action"] = "success";
            echo json_encode($callback);
        } else {
            $callback["message"] = "Não foi possivel Atualizar!";
            $callback["action"] = "error";
            echo json_encode($callback);
        }
    }

    public function update_create($data, $func): bool
    {   

        // $norma = (new NormaModel())->find("Nome = :name", "name={$data['nomeNorma']}")->fetch(false);
        // if(!$norma)return false;
        if ($func === "update") {
            $ensaio = (new NormaModel())->findById($data['Codigo']);
           
        } else {
            $ensaio = new NormaModel();
        }
      
        $norma = filter_var_array($data, FILTER_SANITIZE_STRING);

        $ensaio->Nome = $norma["norma"];
        $ensaio->Status = $norma["statusNorma"];
        $ensaio->ano = $norma["anoNorma"];
      
        if ($ensaio->save()) return true;
        else return false;
    }

    /** RESPONSAVEL POR EDITAR NORMAS */
    public function editar($data):void
    {
        $normas = (new NormaModel())->findById("{$data["id"]}");
       echo $this->view->render("normas/editNorma",[
           "title" => "Normas  | ".SITE['name'],
           "norma" => $normas
       ]);
    }

     /** RESPONSAVEL POR Excluir NORMAS */
    public function excluir($data)
    {
        if (empty($data["id"])) return;

        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $norma = (new NormaModel())->findById($id);
        var_dump($norma);
        if ($norma) {
            $norma->destroy();
        }
        $callback = true;
        echo json_encode($callback);
    }

}