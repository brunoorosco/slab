<?php

namespace Source\Controllers;

use Source\Models\OrcamentoModel;
use Source\Models\Empresa;
use Source\Models\PlanoModel;
use Source\Models\FuncionarioModel;
use PhpOffice\Common;
use Phpoffice\PhpWord;
use Source\Models\NormaModel;
use Source\Models\EnsaioModel;

class OrcamentoController extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);
        // $this->view = Engine::create(__DIR__ . "/../../theme", "php");
    }

    public function adicionar($data)
    {
        $os = new OrcamentoModel();
        $os->item = $data["item"];
        $os->codSequencial = $data["codSequencial"];
        $os->codEnsaio = $data["codEnsaio"];
        // $os->Status = $data["status"];
        $os->valorEnsaio = $data["preco"];
        $os->quantidade = $data["amostra"];
        $retorno = $os->find("item= :item AND codSequencial=:os", "item={$data['item']} & os={$data['codSequencial']}")->fetch(false);
         var_dump($retorno);
        // die();
        if ($retorno != null) {
            var_dump($retorno->Codigo);
        }
      
        die();
        //$criar = $this->update_create($data, "create");
        //if ($empresa->save()) {
        //if ($criar)
        if ($os->save()) {
            $callback["message"] = "Registradoooo!";
            $callback["action"] = "success";
            echo json_encode($callback);
        } else {
            $callback["message"] = "Não foi possivel registrar!";
            $callback["action"] = "error";
            echo json_encode($callback);
        }
    }

    public function update_create($data, $func): bool
    {
        if ($func === "update") {
            $ensaio = (new NormaModel())->findById($data['Codigo']);
        } 

//    //     $norma = filter_var_array($data, FILTER_SANITIZE_STRING);
//         $ensaio->Nome = $norma["norma"];
//         $ensaio->Status = $norma["statusNorma"];
//         $ensaio->ano = $norma["anoNorma"];

        if ($ensaio->save()) return true;
        else return false;
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
