<?php

//CADASTRANDO INFORMAÇÕES NO BANCO DE DADOS

//CADASTRA UM ENSAIO TÊXTIL NO BANCO DE DADOS
function cadastrarEText($setor, $nome, $preco, $carga) {
		
	//INFORMANDO A TABELA E OS DADOS QUE SERÃO INSERIDOS NO BANCO
	$tabela = "tiposdeensaios";
	$campos = "Nome, CodEnsaio, Carga, Preco, Status";
	$valores = "'$nome', $setor , $carga , $preco , 0";
	//-----------------------------------------------------------
		
	//CHAMANDO A FUNÇÃO QUE FAZ O CADASTRO DAS INFORMAÇÕES
	inserir($tabela, $campos, $valores);
	
	//CONSULTAR O CÓDIGO DO REGISTRO QUE ACABARA DE SER INCLUÍDO
	$sql = "Select Codigo from tiposdeensaios where Nome = '$nome'";
	$select = mysql_query($sql);
		
		
	if ($rf = mysql_fetch_array($select)) {
			
		$codigoET = $rf['Codigo'];
	}
	//---------------------------------------------------------
	
	
	//INSERINDO DADOS NA TABELA QUE RELACIONA AS INSTRUÇÕES DE TRABALHO COM AS REFERÊNCIAS ASSOCIADAS
		
	$tabela = "ensaiownorma";
	$campos = "CodTipEns, CodNorma";
	
	//VARIÁVEL QUE REALIZA A VERIFICAÇÃO NO ARRAY DE REFERÊNCIA. CASO AS REFERÊNCIAS ADICIONADAS SEJAM TODAS APAGADAS ANTES DO CADASTRO, O BANCO DEVERÁ ADICIONAR O VALOR 0 NO CAMPO "CODNORMA" DA TABELA "NOMEREF"
	$vazio = 0;
		
	//CONTANDO A QUANTIDADE DE REFERÊNCIAS ADICIONADAS NO ARRAY
	$contador = count($_SESSION['CODNORMA']);
		
		
	for ($i=0;$i<$contador;$i++) {
		
		$codNorma = $_SESSION['CODNORMA'][$i];
		
		if ($codNorma != 0) {
				
			$valores = "$codigoET, $codNorma";
				
			//CHAMANDO A FUNÇÃO QUE FAZ O CADASTRO DAS INFORMAÇÕES
			inserir($tabela, $campos, $valores);
				
			$vazio = 1;
		}
	}
	
	//SE O USUÁRIO APAGAR TODAS AS REFERÊNCIAS DEPOIS DE ADICIONAR OU NÃO ADICIONAR NENHUMA REFERÊNCIA
	if (($vazio == 0) || (!isset($_SESSION['CODNORMA']))) {
			
		$valores = "$codigoET, 0";
			
		inserir($tabela, $campos, $valores);
	}
	
	
?>

	<script type="text/javascript">
		
		alert('ENSAIO CADASTRADO COM SUCESSO!');
		
		location.href = "index.php";
		
	</script>


<?php
	
}


//O PROCESSO DE ATUALIZAÇÃO DAS REFERÊNCIAS SERÁ EXECUTADO EXCLUINDO AS QUE FORAM ADICIONADAS ANTERIORMENTE E ADICIONANDO AS NOVAS
function atualizaEText($setor, $nome, $preco, $carga) {

		$codigoET = $_SESSION['CODUPDTENS'];

		//ATUALIZANDO O ENSAIO TÊXTIL
		$sql = "Update tiposdeensaios set Nome = '$nome', CodEnsaio = $setor, Carga = $carga, Preco = $preco, Status = 0 where Codigo = $codigoET";

		mysql_query($sql);
		
		//RETIRANDO AS REFERÊNCIAS ADICIONADAS ANTERIORMENTE
		$sql = "Select Codigo from ensaiownorma where CodTipEns = $codigoET";
		
		$select = mysql_query($sql);
		
		while ($rf = mysql_fetch_array($select)) {
		
			$codnomeref = $rf['Codigo'];
		
			$sql = "delete from ensaiownorma where Codigo = $codnomeref";
		
			mysql_query($sql);
			
		}
		//------------------------------------
		
		
		//INSERINDO DADOS NA TABELA QUE RELACIONA AS INSTRUÇÕES DE TRABALHO COM AS REFERÊNCIAS ASSOCIADAS
		
		$tabela = "ensaiownorma";
		$campos = "CodTipEns, CodNorma";
		
		//VARIÁVEL QUE REALIZA A VERIFICAÇÃO NO ARRAY DE REFERÊNCIA. CASO AS REFERÊNCIAS ADICIONADAS SEJAM TODAS APAGADAS ANTES DO CADASTRO, O BANCO DEVERÁ ADICIONAR O VALOR 0 NO CAMPO "CODNORMA" DA TABELA "NOMEREF"
		$vazio = 0;
		
		//CONTANDO A QUANTIDADE DE REFERÊNCIAS ADICIONADAS NO ARRAY
		$contador = count($_SESSION['CODNORMA']);
		
		
		for ($i=0;$i<$contador;$i++) {
		
			$codNorma = $_SESSION['CODNORMA'][$i];
		
			if ($codNorma != 0) {
				
				$valores = "$codigoET, $codNorma";
				
				//CHAMANDO A FUNÇÃO QUE FAZ O CADASTRO DAS INFORMAÇÕES
				inserir($tabela, $campos, $valores);
				
				$vazio = 1;
			}
		}
		
		//SE O USUÁRIO APAGAR TODAS AS REFERÊNCIAS DEPOIS DE ADICIONAR OU NÃO ADICIONAR NENHUMA REFERÊNCIA
		if (($vazio == 0) || (!isset($_SESSION['REFERENCIAS']))) {
			
			$valores = "$codigoET, 0";
			
			inserir($tabela, $campos, $valores);
		}
		
?>

		<script type="text/javascript">
			
			alert('ENSAIO ATUALIZADO COM SUCESSO!');
			
			location.href = "index.php";
			
		</script>

<?php
	

}


//VERIFICAR SE É ATUALIZAÇÃO OU CADASTRO DE NOVO REGISTRO
function cadastrarEVest($setor, $nome, $preco, $carga) {
		
	//INFORMANDO A TABELA E OS DADOS QUE SERÃO INSERIDOS NO BANCO
	$tabela = "tiposdeensaios";
	$campos = "Nome, CodEnsaio, Carga, Preco, Status";
	$valores = "'$nome', $setor , $carga , $preco , 0";
	//-----------------------------------------------------------
		
	//CHAMANDO A FUNÇÃO QUE FAZ O CADASTRO DAS INFORMAÇÕES
	inserir($tabela, $campos, $valores);
?>

	<script type="text/javascript">
		
		alert('ENSAIO CADASTRADO COM SUCESSO!');
		
		location.href = "index.php";
		
	</script>


<?php
	
}

function atualizarEVest($setor, $nome, $preco, $carga) {

	$codigo = $_SESSION['CODUPDTENS'];

	$sql = "Update tiposdeensaios set Nome = '$nome', CodEnsaio = $setor, Carga = $carga, Preco = $preco, Status = 0 where Codigo = $codigo";
	
	mysql_query($sql);
?>

	<script type="text/javascript">
		
		alert('DADOS ATUALIZADOS COM SUCESSO!');
		
		location.href = "index.php";
		
	</script>


<?php
	
}

?>