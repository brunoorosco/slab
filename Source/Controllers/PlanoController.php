<?php

namespace Source\Controllers;

use Source\Models\PlanoModel;
use Source\Models\FuncionarioModel;
use Source\Models\OrcamentoModel;

class PlanoController extends Controller
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

    public function view($data)
    {
       var_dump($data);
       echo json_encode($data);
    }
    

    public function excluir($data)
    {
        var_dump($data);
        if (empty($data["id"])) return;
  
        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $plano = (new PlanoModel())->findById($id);
        $orcamento = (new OrcamentoModel())->findById($id);
  
        if ($plano) {
            $plano->destroy();
        }
        $callback = true;
        echo json_encode($callback);
    }
}
