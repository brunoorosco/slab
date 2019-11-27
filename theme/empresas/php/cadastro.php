<?php

//FUNÇÕES MODULARES DO SISTEMA
include("../../php/modular.php");

//CADASTRANDO INFORMAÇÕES NO BANCO DE DADOS

//CAPTURANDO OS CAMPOS PREENCHIDOS
$empresa = ($_POST['txt_nome']);
$codCliente = ($_POST['txt_codcliente']);
$cnpj = ($_POST['txt_cnpj']);
$ie = ($_POST['txt_ie']);
$email = ($_POST['txt_email']);
$endereco = ($_POST['txt_endereco']); 
$numero = ($_POST['txt_numero']);
$cidade = ($_POST['txt_cidade']);
$bairro = ($_POST['txt_bairro']);
$estado = ($_POST['txt_estado']);
$cep = ($_POST['txt_cep']);
$telefone = ($_POST['txt_telefone']);
$telefone2 = ($_POST['txt_telefone2']);
$celular = ($_POST['txt_celular']);
$ramal = ($_POST['txt_ramal']);
$fax = ($_POST['txt_fax']);
$contato = ($_POST['txt_contato']);
$sgset = ($_POST['txt_sgset']);
$cpf = ($_POST['txt_cpf']);

//EVITANDO CONFLITO NO BANCO DE DADOS AO INSERIR O CARACTER "'"
$empresa = addslashes($empresa);
$email = addslashes($email);
$endereco = addslashes($endereco);
$cidade = addslashes($cidade);
$bairro = addslashes($bairro);
$contato = addslashes($contato);
//-------------------------------------------------------------


// ------------------------------

if ($ramal == "") {
	
	$ramal = 0;	
}


//VERIFICAR SE É ATUALIZAÇÃO OU CADASTRO DE NOVO REGISTRO
if (isset($_POST['txt_cad'])) {
	//INFORMANDO A TABELA E OS DADOS QUE SERÃO INSERIDOS NO BANCO
	$tabela = "tbl_empresas";
	$campos = "CodigoCliente, Nome, Endereco, Numero, CNPJ, Contato, Telefone, Email, Ie, CEP, Fax, Ramal, Bairro, Cidade, Estado, Sgset, Status, CPF, Telefone2, Celular";
	$valores = "$codCliente, '$empresa', '$endereco', '$numero', '$cnpj', '$contato', '$telefone', '$email', '$ie', '$cep', '$fax', '$ramal', '$bairro', '$cidade', '$estado', '$sgset', 0, '$cpf', '$telefone2', '$celular'";
	//-----------------------------------------------------------
		
	//CHAMANDO A FUNÇÃO QUE FAZ O CADASTRO DAS INFORMAÇÕES
	inserir($tabela, $campos, $valores);
?>

	<script type="text/javascript">
		
		alert('EMPRESA CADASTRADA COM SUCESSO!');
		
		location.href = "../index.php";
		
	</script>


<?php
	
}
else {

	$codigo = $_SESSION['CODUPDT'];

	$sql = "Update tbl_empresas set CodigoCliente = $codCliente , Nome = '$empresa' , Endereco = '$endereco' , Numero = '$numero' , CNPJ = '$cnpj' , Contato = '$contato' , Telefone = '$telefone' , Email = '$email' , Ie = '$ie' , CEP = '$cep' , Fax = '$fax' , Ramal = '$ramal' , Bairro = '$bairro' , Cidade = '$cidade' , Estado = '$estado' , Sgset = '$sgset' , Status = 0 , CPF = '$cpf' , Telefone2 = '$telefone2' , Celular = '$celular' where Codigo = $codigo";
	
	mysqli_query($con,$sql);
?>

	<script type="text/javascript">
		
		alert('DADOS ATUALIZADOS COM SUCESSO!');
		
		location.href = "../index.php";
		
	</script>


<?php
	
}

?>