<?php

namespace Source\Controllers;

use League\Plates\Engine;
use Source\Models\Empresa;
use Source\Models\User;

class WebEmpresa
{
    private $view;

    public function __construct()
    {
        $this->view = Engine::create(__DIR__ . "/../../theme", "php");
    }
    public function empresa($data): void
    {
        $empresas = (new Empresa())->find()->fetch(true);
        echo $this->view->render("empresas/listar", [
            "title" => "Empresas | " . SITE,
            "empresas" => $empresas
        ]);
    }

    public function incluir($data): void
    {
        echo $this->view->render("empresas/add", [
            "title" => "Cad. Empresa | " . SITE

        ]);
    }

    public function buscar($data)
    {
        $empresa = Empresa::buscarEmpresa($data);

        // Decodifica o formato JSON e retorna um Objeto
        //  $json = json_decode($empresa);
        echo ($empresa);
        // Loop para percorrer o Objeto
        // die();
        //echo $empresa;
    }


    public function adicionar($data): void
    {
        $jobData = filter_var_array($data, FILTER_SANITIZE_STRING);
        if (empty($jobData["razao_social"])) {
            $callback["message"] = message("informe o Nome da Empresa");
            echo json_encode($callback);
            return;
        }
        $cnpj = str_replace(array('.', ',', '-', '/'), '', $jobData["cnpj"]);

        //echo $data["razao_social"];
        $empresa = new Empresa();
        $empresa->Nome = $jobData["razao_social"];
        $empresa->CNPJ = $cnpj;
        $empresa->Ie = $jobData["txt_ie"];
        $empresa->CEP = $jobData["txt_cep"];
        $empresa->Endereco = $jobData["txt_endereco"];
        $empresa->Numero = $jobData["txt_numero"];
        $empresa->Cidade = $jobData["txt_cidade"];
        $empresa->Bairro = $jobData["txt_bairro"];
        $empresa->Estado = $jobData["txt_estado"];
        $empresa->Contato = $jobData["txt_contato"];
        $empresa->Telefone = $jobData["txt_telefone"];
        $empresa->Ramal = $jobData["txt_ramal"];
        $empresa->Fax = $jobData["txt_fax"];
        $empresa->Telefone2 = $jobData["txt_telefone2"];
        $empresa->Celular = $jobData["txt_celular"];
        $empresa->CPF = $jobData["txt_cpf"];
        $empresa->Sgset = $jobData["txt_sgset"];
        $empresa->CodigoCliente = $jobData["codCliente"];
        $empresa->Celular = $jobData["txt_celular"];
        $empresa->Email = $jobData["txt_email"];

        if ($empresa->save()) {
            $callback["message"] = "Empresa cadastrada com sucesso!";
            $callback["action"] = "success";
            echo json_encode($callback);
        } else {
            $callback["message"] = "Não foi possivel cadastrar!";
            $callback["action"] = "error";
            echo json_encode($callback);
        }
    }

    public function editar($data): void
    {
        // $users = (new User())->find()->fetch(true);
        echo $this->view->render("teste", [
            "title" => "{$data["id"]} | " . SITE,

        ]);
    }
    public function excluir($data)
    {
        if (empty($data["id"])) return;

        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $empresa = (new Empresa())->findById($id);

        if ($empresa) {
            $empresa->destroy();
        }
        $callback = true;
        echo json_encode($callback);
    }

    public function error($data): void
    {
        echo $this->view->render("error", [
            "title" => "Erro | {$data["errcode"]}" . SITE,
            "error" => $data["errcode"]
        ]);
    }
    public function CNPJ()
    {
        $cnpj = $this->input->post('cnpj');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://receitaws.com.br/v1/cnpj/{$cnpj}");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
    }
}
