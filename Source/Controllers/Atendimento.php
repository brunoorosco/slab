<?php

namespace Source\Controllers;

use League\Plates\Engine;
use Source\Models\Orcamento;
use PhpOffice\Common;
use Phpoffice\PhpWord;


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
        echo $this->view->render("atendimento/planoAtendimento",[
            "title" => "Ordem de Serv | ". SITE,
          //  "users" => $users
        ]);


    }
    public function imprimirPlano($data):void
    {
    //    $users = (new User())->find()->fetch(true);
        echo $this->view->render("atendimento/printPlano",[
            "title" => "Ordem de Serv | ". SITE,
          //  "users" => $users
        ]);


    }
    public function plano($data):void
    {
    //    $users = (new User())->find()->fetch(true);
        echo $this->view->render("atendimento/consultaPlano",[
            "title" => "Ordem de Serv | ". SITE,
          //  "users" => $users
        ]);


    }

}