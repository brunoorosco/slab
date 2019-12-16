<?php

namespace Source\Controllers;

use League\Plates\Engine;
use Source\Models\EnsaioModel;

define("ROTA", "../Source/Views/ensaio/");

class EnsaioController
{
    private $view;

    public function __construct()
    {
        $this->view = Engine::create(__DIR__ . "/../../theme", "php");
    }

    public function ensaios($ensaio): void
    {
        // echo $email;
        //$user = User::login($email,$senha);
        $ensaios = (new EnsaioModel())->find()->fetch(true);
        // var_dump($comps);
        echo $this->view->render(ROTA . "ensaio", [
            "title" => "Ensaios | " . SITE,
            "ensaios" => $ensaios

        ]);
    }
    public function adicionar($data): void
    {
        $criar = $this->update_create($data, "create");
        //if ($empresa->save()) {
        if ($criar) {
            $callback["message"] = "Ensaio cadastrada com sucesso!";
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
        //if ($empresa->save()) {
            if($atualizar){
            $callback["message"] = "Ensaio atualizado com sucesso!";
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
        if ($func === "update") {
            $ensaio = (new EnsaioModel())->findById($data['Codigo']);
        } else {
            $ensaio = new EnsaioModel();
        }

        $jobData = filter_var_array($data, FILTER_SANITIZE_STRING);
        if (empty($jobData["ensaio"])) {
            $callback["message"] = message("informe o Nome da Ensaio");
            echo json_encode($callback);
            return false;
        }
        $ensaio->Nome = $jobData["ensaio"];
        $ensaio->CodEnsaio = $jobData["codEnsaio"];;
        $ensaio->Carga = $jobData["qtHoras"];
        $ensaio->Preco = $jobData["preco"];
        $ensaio->Status = $jobData["status"];
       // $ensaio->Status = $jobData["status"];
       
        if ($ensaio->save()) return true;
        else return false;
    }

    public function editar($data): void
    {
        $ensaio = (new EnsaioModel())->findById("{$data["id"]}");
        echo $this->view->render(ROTA."edit", [
            "title" => "{$data["id"]} | " . SITE,
            "ensaio" => $ensaio

        ]);
    }

    public function excluir($data)
    {
        if (empty($data["id"])) return;

        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $ensaio = (new EnsaioModel())->findById($id);
        var_dump($ensaio);
        if ($ensaio) {
            $ensaio->destroy();
        }
        $callback = true;
        echo json_encode($callback);
    }
}
