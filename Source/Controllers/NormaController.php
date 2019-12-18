<?php

namespace Source\Controllers;

use League\Plates\Engine;
use Source\Models\NormaModel;

define("ROTA","../Source/Views/normas/"); 

class NormaController
{
    private $view;

    public function __construct()
    {
        $this->view = Engine::create(__DIR__."/../../theme","php");
    }

    /** RESPONSAVEL POR CRIAR TABELA COM OS DADOS DO BANCO */
    public function normas($norma):void
    {  
       // echo $email;
       //$user = User::login($email,$senha);
       $normas = (new NormaModel())->find()->fetch(true);
      // var_dump($comps);
       echo $this->view->render(ROTA."normas",[
           "title" => "Normas | ". SITE,
           "normas" => $normas
           
       ]);
    }
    /** RESPONSAVEL POR ADICIONAR NORMA */
    public function adicionar($email):void
    {  
       // echo $email;
       //$user = User::login($email,$senha);
     //$users = (new User())->find()->fetch(true);
       echo $this->view->render(ROTA."novo",[
           "title" => "Normas | ". SITE
           
       ]);
    }

    /** RESPONSAVEL POR EDITAR NORMAS */
    public function editar($data):void
    {
        $normas = (new NormaModel())->findById("{$data["id"]}");
       echo $this->view->render(ROTA."editNorma",[
           "title" => "Normas  | ".SITE,
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