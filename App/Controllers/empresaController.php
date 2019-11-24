<?php 

require_once dirname(__FILE__) . '/../Views/View.php';

class empresaController{

 public function adicionar()
    {
        View::exibir('./empresas/index.php');
    }
    
    public function consultar()
    {
        View::exibir('./empresas/consulta.php');
    }

    public function editar()
    {
        
    }

    public function deletar()
    {

    }
}