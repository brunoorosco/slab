<?php

//FUNÇÕES MODULARES DO SISTEMA
include("../../php/modular.php");

//CADASTRANDO INFORMAÇÕES NO BANCO DE DADOS

//CAPTURANDO OS CAMPOS PREENCHIDOS
$composicao = ($_POST['txt_composicao']);

// ------------------------------


//VERIFICAR SE É ATUALIZAÇÃO OU CADASTRO DE NOVO REGISTRO
if (isset($_POST['txt_cad'])) {
	//INFORMANDO A TABELA E OS DADOS QUE SERÃO INSERIDOS NO BANCO
	$tabela = "composicoes";
	$campos = "Nome, Status";
	$valores = "'$composicao', 0";
	//-----------------------------------------------------------
		
	//CHAMANDO A FUNÇÃO QUE FAZ O CADASTRO DAS INFORMAÇÕES
	inserir($tabela, $campos, $valores);
?>

	<script type="text/javascript">
		
		alert('ELEMENTO CADASTRADO COM SUCESSO!');
		
		location.href = "../index.php";
		
	</script>


<?php
	
}
else {

	$codigo = $_SESSION['CODUPDCOMP'];

	$sql = "Update composicoes set Nome = '$composicao', Status = 0 where Codigo = $codigo";
	
	mysql_query($sql);
?>

	<script type="text/javascript">
		
		alert('ELEMENTO ATUALIZADO COM SUCESSO!');
		
		location.href = "../index.php";
		
	</script>


<?php
	
}

?>