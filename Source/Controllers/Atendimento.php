<?php

namespace Source\Controllers;

use League\Plates\Engine;
use Source\Models\Orcamento;
use PhpOffice\Common;
use Phpoffice\PhpWord;

define("ROTA","../Source/Views/atendimento/"); 

class Atendimento
{
    private $view;

    public function __construct()
    {
        $this->view = Engine::create(__DIR__."/../../theme","php");
    }
    public function atendimento($data):void
    {
    //    $users = (new User())->find()->fetch(true);
        echo $this->view->render(ROTA."planoAtendimento",[
            "title" => "Ordem de Serv | ". SITE,
          //  "users" => $users
        ]);


    }
    public function imprimirPlano($data):void
    {
    //    $users = (new User())->find()->fetch(true);
        echo $this->view->render(ROTA."printPlano",[
            "title" => "Ordem de Serv | ". SITE,
          //  "users" => $users
        ]);


    }
    public function plano($data):void
    {
    //    $users = (new User())->find()->fetch(true);
        echo $this->view->render(ROTA."consultaPlano",[
            "title" => "Ordem de Serv | ". SITE,
          //  "users" => $users
        ]);


    }
    public function etiqueta($data)
    {
      
      //var_dump($data);
        echo $this->view->render(ROTA."printEtiquetas",[
             "title" => "Etiquetas | ". SITE
            
         ]);
    }

    public function buscaEtiqueta($data)
    {
        
      //var_dump($data);
        echo $this->view->render(ROTA."buscaEtiqueta",[
             "title" => "Etiquetas | ". SITE
            
         ]);
    }
    

}