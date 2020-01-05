<?php

namespace Source\Controllers;

use Source\Models\Orcamento;
use Source\Models\Empresa;
use Source\Models\PlanoModel;
use Source\Models\FuncionarioModel;
use PhpOffice\Common;
use Phpoffice\PhpWord;
use Source\Models\NormaModel;
use Source\Models\EnsaioModel;

class Atendimento extends Controller
{
  public function __construct($router)
  {
    parent::__construct($router);
    // $this->view = Engine::create(__DIR__ . "/../../theme", "php");
  }

  public function atendimento($data): void
  {
    $tecnico = (new FuncionarioModel())->find("CodFuncao = :cod", "cod=3")->order("Nome ASC")->fetch(true);
    $ensaios = (new EnsaioModel())->find()->order("Nome ASC")->fetch(true);
    $normas = (new NormaModel())->find()->order("Nome ASC")->fetch(true);
    $planos = (new PlanoModel())->find()->fetch(true);

    echo $this->view->render("../atendimento/planoAtendimento", [
      "title" => "Ordem de Serv | " . SITE['name'],
      "tecnicos" => $tecnico,
      "normas" => $normas,
      "ensaios" => $ensaios,

    ]);
  }

  public function imprimirPlano($data): void
  {
    // $users = (new User())->find()->fetch(true);
    echo $this->view->render("../atendimento/printPlano", [
      "title" => "Ordem de Serv | " . SITE['name'],
    //"users" => $users
    ]);
  }

  public function adicionar($data): void
  {
    $criar = $this->update_create($data, "create");

    if ($criar) {
      $callback["message"] = "Plano de Atendimento realizado com sucesso!";
      $callback["action"] = "success";
      echo json_encode($callback);
    } else {
      $callback["message"] = "Não foi possivel cadastrar!";
      $callback["action"] = "error";
      echo json_encode($callback);
    }
  }

  public function atualizar($data)
  {
    $atualizar = $this->update_create($data, "update");
    //if ($empresa->save()) {
    if ($atualizar) {
      $callback["message"] = "Plano de atualizado com sucesso!";
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
    date_default_timezone_set('UTC');

    $tecnico = (new FuncionarioModel())->findById($data['tecnico']);

    if ($func === "update") {
      $ensaio = (new PlanoModel())->findById($data['Codigo']);
    } else {
      $ensaio = new PlanoModel();
    }

    $jobData = filter_var_array($data, FILTER_SANITIZE_STRING);

    $dataInicio = date("Y-m-d", strtotime(str_replace('/', '-', $jobData["dataInicial"])));
    $datafinal = date("Y-m-d", strtotime(str_replace('/', '-', $jobData["dataFinal"])));
    $dataSol = date("Y-m-d", strtotime(str_replace('/', '-', $jobData["dataSolicitacao"])));
    $dataResp = date("Y-m-d", strtotime(str_replace('/', '-', $jobData["dataResposta"])));
    // Exibe alguma coisa como: Monday

    $ensaio->Sequencial = $jobData["nProposta"];
    $ensaio->CodNomeEmpr = $jobData["codEmpresa"];
    $ensaio->DataInicio = $dataInicio;
    $ensaio->DataFim = $datafinal;
    $ensaio->ResponsavelAtendimento = $tecnico->Codigo;
    $ensaio->DataSolicitacao = $dataSol;
    $ensaio->DataResposta = $dataResp;
    $ensaio->DataAnalCritica = $dataResp;
    $ensaio->ResponsavelAnalise = $tecnico->Codigo;
    $ensaio->FormaRecebimento = $jobData["tipoSolicitacao"];
    $ensaio->Usuario = $_SESSION['codUsuario'];

    if ($ensaio->save()) {
      $ensaio->ResponsavelAnalise = $tecnico->Nome;
      $ensaio->ResponsavelAtendimento = $tecnico->Nome;

      $empresa = (new Empresa())->findById($jobData['codEmpresa']);
      (new PlanoModel())->print($ensaio, $empresa);

      return true;
    } else return false;
  }

  public function print($infoPlano)
  {
  }

  public function plano($data): void
  {
    $planos = (new PlanoModel())->find()->fetch(true);
    $empresas = (new Empresa())->find()->fetch(true);
    $norma = (new NormaModel())->find()->fetch(true);

    // var_dump($planos);
    echo $this->view->render("../atendimento/planos", [
      "title" => "Ordem de Serv | " . SITE['name'],
      "planos" => $planos,
      "empresas" => $empresas,
      "normas" => $norma

    ]);
  }
  public function etiqueta($data)
  {

    //var_dump($data);
    echo $this->view->render("../atendimento/printEtiquetas", [
      "title" => "Etiquetas | " . SITE['name']

    ]);
  }

  public function buscaEtiqueta($data)
  {

    //var_dump($data);
    echo $this->view->render("../atendimento/buscaEtiqueta", [
      "title" => "Etiquetas | " . SITE['name']

    ]);
  }

  public function carregaNorma($data)
  {
    ob_clean();
    $codigo = (new EnsaioModel())->findById($data['data']);
    $normas = (new NormaModel())->findById($codigo->codNorma);
    $callback['nome'] = $normas->Nome;
    $callback['Codigo'] = $normas->Codigo;
    $callback['Status'] = $normas->Status;
    $callback['valor'] = $codigo->Preco;
    $callback['ano'] = $normas->ano;


    // var_dump(json_encode($callback));

    echo json_encode($callback);
  }

  public function carregaEnsaio($data)
  {
    ob_clean();
    $callback = array();
    $i = 0;
    $ensaios = (new EnsaioModel())->find()->order("Nome ASC")->fetch(true);
    foreach ($ensaios as $ensaio) {

      $callback[$i]['nome'] = $ensaio->Nome;
      $callback[$i]['Codigo'] = $ensaio->Codigo;
      $callback[$i]['Status'] = $ensaio->Status;
      $callback[$i]['valor'] = $ensaio->Preco;
      $i++;
    }

    echo (json_encode($callback));
  }
}
