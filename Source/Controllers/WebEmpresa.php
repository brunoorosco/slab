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
    public function adicionar($data): void
    {
        echo $data["razao_social"];
        $empresa = new Empresa();
        $empresa->Nome = $data["razao_social"];
        $empresa->CNPJ = $data["cnpj"];
        // $empresa->Ie = $data["txt_ie"];
        // $empresa->CEP = $data["txt_cep"];
        $empresa->Endereco = $data["txt_endereco"];
        //$empresa->Numero = $data["txt_numero"];
        // $empresa->Cidade = $data["txt_cidade"];
        // $empresa->Bairro = $data["txt_bairro"];
        // $empresa->Estado = $data["txt_estado"];
        // $empresa->Contato = $data["txt_contato"];
        $empresa->Telefone = $data["txt_telefone"];
        // $empresa->Ramal = $data["txt_ramal"];
        // $empresa->Fax = $data["txt_fax"];
        // $empresa->Telefone2 = $data["txt_telefone2"];
        // $empresa->Celular = $data["txt_celular"];
        // $empresa->CPF = $data["txt_cpf"];
        // $empresa->Sgset = $data["txt_sgset"];
        // $empresa->CodigoCliente = $data["codCliente"];
        // $empresa->Celular = $data["txt_celular"];
        // $empresa->Email = $data["txt_email"];
        
        $empresa->save();

       
        //$users = (new Empresa())->find()->fetch(true);
        echo $this->view->render("empresas/add", [
            "title" => "Cad. Empresa | " . SITE

        ]);
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
