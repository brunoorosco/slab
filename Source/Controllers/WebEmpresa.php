<?php

namespace Source\Controllers;

use Source\Models\Empresa;
use Source\Models\FuncionarioModel;


class WebEmpresa extends Controller
{
     /** @var FuncionarioModal   */
     protected $user;

     public function __construct($router)
     {
         parent::__construct($router);
         if (empty($_SESSION["user"]) || !$this->user = (new FuncionarioModel())->findById($_SESSION["user"])) {
             unset($_SESSION["user"]);
            
             flash("error", "Acesso negado!");
             $this->router->redirect("web.login");
         }
     }

    public function empresa($data): void
    {
        $empresas = (new Empresa())->find()->order("Codigo DESC")->fetch(true);
        echo $this->view->render("empresas/listar", [
            "title" => "Empresas | " . SITE['name'],
            "empresas" => $empresas
        ]);
    }

    public function incluir($data): void
    {
        echo $this->view->render("empresas/add", [
            "title" => "Cad. Empresa | " . SITE['name']

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
    public function atualizar($data){
        $atualizar = $this->update_create($data,"update");
        //if ($empresa->save()) {
            if($atualizar){
            $callback["message"] = "Empresa Atualizada com sucesso!";
            $callback["action"] = "success";
            echo json_encode($callback);
        } else {
            $callback["message"] = "Não foi possivel Atualizar!";
            $callback["action"] = "error";
            echo json_encode($callback);
        }
    }


    public function adicionar($data): void
    {
        // $jobData = filter_var_array($data, FILTER_SANITIZE_STRING);
        // if (empty($jobData["razao_social"])) {
        //     $callback["message"] = message("informe o Nome da Empresa");
        //     echo json_encode($callback);
        //     return;
        // }
        //$cnpj = str_replace(array('.', ',', '-', '/'), '', $jobData["cnpj"]);

        //echo $data["razao_social"];
        // $empresa = new Empresa();
        // $empresa->Nome = $jobData["razao_social"];
        // $empresa->CNPJ = $cnpj;
        // $empresa->Ie = $jobData["txt_ie"];
        // $empresa->CEP = $jobData["txt_cep"];
        // $empresa->Endereco = $jobData["txt_endereco"];
        // $empresa->Numero = $jobData["txt_numero"];
        // $empresa->Cidade = $jobData["txt_cidade"];
        // $empresa->Bairro = $jobData["txt_bairro"];
        // $empresa->Estado = $jobData["txt_estado"];
        // $empresa->Contato = $jobData["txt_contato"];
        // $empresa->Telefone = $jobData["txt_telefone"];
        // $empresa->Ramal = $jobData["txt_ramal"];
        // $empresa->Fax = $jobData["txt_fax"];
        // $empresa->Telefone2 = $jobData["txt_telefone2"];
        // $empresa->Celular = $jobData["txt_celular"];
        // $empresa->CPF = $jobData["txt_cpf"];
        // $empresa->Sgset = $jobData["txt_sgset"];
        // $empresa->CodigoCliente = $jobData["codCliente"];
        // $empresa->Celular = $jobData["txt_celular"];
        // $empresa->Email = $jobData["txt_email"];
        $criar = $this->update_create($data,"create");
        //if ($empresa->save()) {
            if($criar){
            $callback["message"] = "Empresa cadastrada com sucesso!";
            $callback["action"] = "success";
            echo json_encode($callback);
        } else {
            $callback["message"] = "Não foi possivel cadastrar!";
            $callback["action"] = "error";
            echo json_encode($callback);
        }
    }

    public function update_create($data, $func):bool
    {
        if($func === "update")
        {
            $empresa = (new Empresa())->findById($data['codCliente']);
        }else{
            $empresa = new Empresa();
        }

        $jobData = filter_var_array($data, FILTER_SANITIZE_STRING);
        if (empty($jobData["razao_social"])) {
            $callback["message"] = message("informe o Nome da Empresa");
            echo json_encode($callback);
            return false;
        }
        $cnpj = str_replace(array('.', ',', '-', '/'), '', $jobData["cnpj"]);
        
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
        if($empresa->save())return true;
        else return false;


    }

    public function editar($data): void
    {
        $empresa = (new Empresa())->findById("{$data["id"]}");
        echo $this->view->render("empresas/edit", [
            "title" => "{$data["id"]} | " . SITE['name'],
            "empresa" => $empresa

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

    public function CNPJ()
    {
        $cnpj = $this->input->post('cnpj');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://receitaws.com.br/v1/cnpj/{$cnpj}");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
    }
}
