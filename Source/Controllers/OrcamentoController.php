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
        //mensagem de adicionado
        $callback["message"] = "Registradoooo!";
        $callback["action"] = "success";

        $os = new OrcamentoModel();

        //VERIFICA SE JÁ EXISTE O ITEM E A ORDEM DE SERVIÇO, CASO EXISTA REALIZAR O UPDATE DO ITEM
        $retorno = $os->find("item= :item AND codSequencial=:os", "item={$data['item']} & os={$data['codSequencial']}")->fetch(false);
        if ($retorno != null) {
            $os = $os->findById($retorno->Codigo);
            //mensagem de modificado
            $callback["message"] = "Modificadoooo!";
        }

        //  $os = new OrcamentoModel();
        $os->item = $data["item"];
        $os->codSequencial = $data["codSequencial"];
        $os->codEnsaio = $data["codEnsaio"];
        // $os->Status = $data["status"];
        $os->valorEnsaio = $data["preco"];
        $os->quantidade = $data["amostra"];

        // die();
        //$criar = $this->update_create($data, "create");
        //if ($empresa->save()) {
        //if ($criar)
        if ($os->save()) {

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

    /** RESPONSAVEL POR Excluir item do Orçamento */
    public function excluir($data)
    {
       // var_dump($data);
       $os = new OrcamentoModel();
        if (empty($data["item"])) return;

        $id = filter_var($data["item"], FILTER_VALIDATE_INT);

        $item = $os->find("item= :item AND codSequencial=:os", "item={$data['item']} & os={$data['codSequencial']}")->fetch(false);

        // $item = (new OrcamentoModel())->findById($id);
        // var_dump($item);
        if ($item) {
            $item->destroy();
            $callback["message"] = "Excluídooo!";
            $callback["action"] = "info";
        }
      
        echo json_encode($callback);
    }
}
