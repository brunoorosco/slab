<?php 

require_once dirname(__FILE__) . '/../Views/View.php';


class Controller{
    public static function index()
    {
        // $vagas = VagaModel::obterAtivas();
        View::exibir('home.php');
    }

    public static function empresa()
    {
       // $vagas = VagaModel::obterAtivas();
        View::exibir('./empresas/index.php');
    }
    public static function empresaConsulta()
    {
        $empresas = Empresa::consulta();
        View::exibir('./empresas/index.php');
    }
    public static function ensaio()
    {
       // $vagas = VagaModel::obterAtivas();
        View::exibir('./ensaios/index.php');
    }
    public static function login()
    {
       // $vagas = VagaModel::obterAtivas();
        View::exibir('login.php');
    }
}