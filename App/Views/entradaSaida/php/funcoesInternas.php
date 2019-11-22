<?php 

//ARQUIVO DE CONEXรฦ’O COM O BANCO DE DADOS
include("../../php/conexao.php");

//FUNรโ€กรโ€ขES MODULARES DO SISTEMA
include("../../php/modular.php");


// FUNวรO PARA GUARDAR OS DADOS DO NOME DA AMOSTRA E O CำDIGO CORRESPONDENTE NO BANCO DE DADOS

if (isset($_GET['guardarDados'])) {
	
		
	
		//VERIFICANDO SE O MESMO ELEMENTO FOI SELECIONADO
		
		if (isset($_SESSION['CAIXAELEMENTHTML'])) {
		
			//VERIFICANDO SE O ELEMENTO SELECIONADO ษ DIFERENTE, EM CASO POSITIVO, MANTER O VALOR DA SESSION, SEM MODIFICAR
			if (($_GET['elementoHTML']) != ($_SESSION['CAIXAELEMENTHTML'])) {
				
				//ARMAZENANDO OS DADOS NAS VARIมVEIS DE SESSรO
				$_SESSION['NOMEAMOSTRAANT'] = $_SESSION['NOMEAMOSTRAENT'];
				$_SESSION['NOMEAMOSTRAENT'] = ($_GET['nomeAmostra']);
				$_SESSION['CODAMOSTRAENT'] = ($_GET['codAmostra']);
								
				echo $_SESSION['CAIXAELEMENTHTML'].";".$_SESSION['NOMEAMOSTRAENT'].";".$_SESSION['NOMEAMOSTRAANT'];
				
				$_SESSION['CAIXAELEMENTHTML'] = ($_GET['elementoHTML']);
				
			}
			else {
				
				
				//ARMAZENANDO OS DADOS NAS VARIมVEIS DE SESSรO
				$_SESSION['NOMEAMOSTRAENT'] = ($_GET['nomeAmostra']);
				$_SESSION['CODAMOSTRAENT'] = ($_GET['codAmostra']);
				
				echo $_SESSION['CAIXAELEMENTHTML'].";".$_SESSION['NOMEAMOSTRAENT'];
				
			}
			
		}
		else{
			
			$_SESSION['CAIXAELEMENTHTML'] = ($_GET['elementoHTML']);
			
			//ARMAZENANDO OS DADOS NAS VARIมVEIS DE SESSรO
			$_SESSION['NOMEAMOSTRAENT'] = ($_GET['nomeAmostra']);
			$_SESSION['CODAMOSTRAENT'] = ($_GET['codAmostra']);
		
			echo $_SESSION['CAIXAELEMENTHTML'].";".$_SESSION['NOMEAMOSTRAENT'];
			
		}
	
}

//--------------------------------------------------------------------------------------


//FUNวรO PARA SALVAR OS DADOS

if (isset($_GET['salvarDados'])) {
	
	//ARMAZENANDO O CำDIGO DA VARIมVEL
	$codigo = $_SESSION['CODAMOSTRAENT'];
	
	$nomeAmostra = ($_GET['salvarDados']);
	
	//DEIXANDO AS LETRAS EM MAอUSCULO
	$nomeAmostra = strtoupper($nomeAmostra);
	
	$_SESSION['NOMEAMOSTRAENT'] = $nomeAmostra;
	
	//ATUALIZANDO O NOME DA AMOSTRA NO BANCO DE DADOS
	$sql = "Update itemensaio set itemensaio.NomeArtigo = '$nomeAmostra' where Codigo = $codigo";
	mysql_query($sql);
	
}

//--------------------------------------------------------------------------------------

?>