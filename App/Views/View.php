<?php


class View {
    public static function exibir($arquivo,$dados=null)
    {
        // Obter o centro (lista de empresas)
        $arquivoCentro = dirname(__FILE__) . '/'.$arquivo;
         if (!file_exists($arquivoCentro)){
            die("arquivo $arquivoCentro não existe!");
        }
        // Carregar o layout + centro (lista de empresas)
        require dirname(__FILE__).'./sidebar/index.php';
       // echo dirname(__FILE__).'\layout.php';
    }
}