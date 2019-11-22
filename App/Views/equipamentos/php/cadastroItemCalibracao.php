<?php


//FUNÇÕES MODULARES DO SISTEMA
include("../../php/modular.php");


//ARQUIVO ESPECÍFICO PARA CADASTRAR OS ITENS DE CALIBRAÇÃO DO EQUIPAMENTO ATRAVÉS DO MÉTODO POST
//MOTIVO: UM ARRAY SERÁ UTILIZADO COMO PARÂMETRO PARA TRANSFERÊNCIA DOS DADOS

$codServicos = ($_POST['servicos']);

$partes = explode(",", $codServicos);

$itemCalibracao = ($_POST['itemCalibracao']);
$faixaNominal = ($_POST['itemFaixa']);
$quantidadeServicos = count($partes);

$faixaNominal = addslashes($faixaNominal);

//CADASTRANDO O ITEM DE CALIBRAÇÃO

//INFORMANDO A TABELA E OS DADOS QUE SERÃO INSERIDOS NO BANCO
$codEquipamento = ($_SESSION['CODIGOEQUIPAMENTO']); //PEGANDO O CÓDIGO DO EQUIPAMENTO

$tabela = "itemcalibracao";
$campos = "Nome, CodEquip, Status, FaixaNominal";
$valores = "'$itemCalibracao', $codEquipamento, 0, '$faixaNominal'";
//-----------------------------------------------------------

//CHAMANDO A FUNÇÃO QUE FAZ O CADASTRO DAS INFORMAÇÕES
inserir($tabela, $campos, $valores);

//RECUPERANDO O CÓDIGO DO ÚLTIMO ITEM DE CALIBRAÇÃO CADASTRADO
$codItemServ = mysql_insert_id();


//CADASTRANDO OS SERVIÇOS RELACIONADOS AO ITEM DE CALIBRAÇÃO
for ($i=0;$i<$quantidadeServicos;$i++) {
	
	$idServico = $partes[$i];
	
	$tabela = "compcalibrserv";
	$campos = "CodServico, CodItemCalibracao, Status";
	$valores = "$idServico, $codItemServ, 0";
	//-----------------------------------------------------------
	
	//CHAMANDO A FUNÇÃO QUE FAZ O CADASTRO DAS INFORMAÇÕES
	inserir($tabela, $campos, $valores);
	
}



//---------------------------------------------------------------------------------------------


?>