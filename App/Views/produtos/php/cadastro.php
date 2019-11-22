<?php

//FUNÇÕES MODULARES DO SISTEMA
include("../../php/modular.php");

//CADASTRANDO INFORMAÇÕES NO BANCO DE DADOS

//CAPTURANDO OS CAMPOS PREENCHIDOS
$produto = ($_POST['txt_produto']);
$preco = ($_POST['txt_preco']);

//TROCANDO , POR . ANTES DE INSERIR A INFORMAÇÃO NO BANCO
$preco = str_replace(",",".", $preco);

// ------------------------------


//VERIFICAR SE É ATUALIZAÇÃO OU CADASTRO DE NOVO REGISTRO
if (isset($_POST['txt_cad'])) {
	//INFORMANDO A TABELA E OS DADOS QUE SERÃO INSERIDOS NO BANCO
	$tabela = "produtos";
	$campos = "Nome, Preco, Status";
	$valores = "'$produto', $preco , 0";
	//-----------------------------------------------------------
		
	//CHAMANDO A FUNÇÃO QUE FAZ O CADASTRO DAS INFORMAÇÕES
	inserir($tabela, $campos, $valores);
?>

	<script type="text/javascript">
		
		alert('PRODUTO CADASTRADO COM SUCESSO!');
		
		location.href = "../index.php";
		
	</script>


<?php
	
}
else {

	$codigo = $_SESSION['CODUPDPROD'];

	$sql = "Update produtos set Nome = '$produto', Preco = $preco, Status = 0 where Codigo = $codigo";
	
	mysql_query($sql);
?>

	<script type="text/javascript">
		
		alert('PRODUTO ATUALIZADO COM SUCESSO!');
		
		location.href = "../index.php";
		
	</script>


<?php
	
}

?>