<?php 

require dirname(__FILE__) . '/../Views/View.php';


class Controller{
    public static function index()
    {
        // $vagas = VagaModel::obterAtivas();
        View::exibir('home.php');
    }

    public static function sobre()
    {
       // $vagas = VagaModel::obterAtivas();
        View::exibir('home.php');
    }
    public static function teste()
    {
       // $vagas = VagaModel::obterAtivas();
        View::exibir('teste.php');
    }
    public static function login()
    {
       // $vagas = VagaModel::obterAtivas();
        View::exibir('login.php');
    }
}