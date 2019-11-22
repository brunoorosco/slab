<?php

//FUNÃ‡Ã•ES MODULARES DO SISTEMA
include("../../php/modular.php");



//VERIFICANDO SE Ã‰ UM CADASTRO/ATUALIZAÃ‡ÃƒO DE EQUIPAMENTOS OU ITENS DE CALIBRAÃ‡ÃƒO


if (isset($_GET['equipamento'])) {

	
		//CADASTRANDO INFORMAÃ‡Ã•ES NO BANCO DE DADOS
		
		//CAPTURANDO OS CAMPOS PREENCHIDOS
		$equipamento = ($_GET['nome']);
		$numero = ($_GET['numero']);
		$fabricante = ($_GET['fabricante']);
		$descricao = ($_GET['descricao']);
		$local = ($_GET['local']);
		$modo = ($_GET['modo']);
		$pat = ($_GET['patrimonio']);
		$resolucao = ($_GET['resolucao']);
		$faixaNominal = ($_GET['faixaNominal']);
		$tolerancia = ($_GET['tolerancia']);
		$dataIncorp = ($_GET['dataIcorp']);
		$dataIniuso = ($_GET['dataIniUso']);
		$dataForaUso = ($_GET['dataForaUso']);
		$validaForaUso = ($_GET['chkForaUso']);
		
		$pcablibr = ($_GET['pcalibr']);
		$pmanut = ($_GET['pmanut']);
		$pchecagem = ($_GET['pchecagem']);
		$noescopo = ($_GET['pnoescopo']);
		
		//EVITANDO CONFLITO NO BANCO DE DADOS AO INSERIR O CARACTER "'"
		$equipamento = addslashes($equipamento);
		$fabricante = addslashes($fabricante);
		$descricao = addslashes($descricao);
		$local = addslashes($local);
		
		//-------------------------------------------------------------
		
		
		// ------------------------------
		
		if ($ramal == "") {
			
			$ramal = 0;
		}
		
		//VERIFICANDO SE O EQUIPAMENTO ESTÃ� FORA DE USO
		
		if ($validaForaUso == "") {
			
			$validaForaUso = 0;
		}
		
		if ($validaForaUso == "0") {
			
			$dataForaUso = '1111-11-11';
		}
		else {
			
			$dataForaUso = dataAmericana($dataForaUso);
		}
		//---------------------------------------------
		
		
		
		//TRANFORMANDO PADRÃ•ES DE DATAS
		
		$dataIncorp = dataAmericana($dataIncorp);
		$dataIniuso = dataAmericana($dataIniuso);
		
		//-----------------------------
		
			
		//VERIFICAR SE Ã‰ ATUALIZAÃ‡ÃƒO OU CADASTRO DE NOVO REGISTRO
		if ($modo == "cadastrar") {
			
			//INFORMANDO A TABELA E OS DADOS QUE SERÃƒO INSERIDOS NO BANCO
			$tabela = "equipamentos";
			$campos = "Nome, Nequipamento, Fabricante, Local, Descricao, Patrimonio, Status, FaixaNominal, Resolucao, Tolerancia, DataIncorporacao, DataInicialUso, ForaUso, DataBaixa, Motivo, PeriodCalibracao, PeriodManut, PeriodChecagem, NoEscopo";
			$valores = "'$equipamento', '$numero', '$fabricante', '$local', '$descricao', $pat, 0, '$faixaNominal', '$resolucao', '$tolerancia', '$dataIncorp', '$dataIniuso', $validaForaUso, '$dataForaUso', '', $pcablibr, $pmanut, $pchecagem, '$noescopo'";
			//-----------------------------------------------------------
			
			//CHAMANDO A FUNÃ‡ÃƒO QUE FAZ O CADASTRO DAS INFORMAÃ‡Ã•ES
			inserir($tabela, $campos, $valores);
			
		}	
		else {
		
			$codigo = ($_SESSION['CODIGOEQUIPAMENTO']);
					
			$sql = "Update equipamentos set Nome = '$equipamento' , Nequipamento = '$numero' , Fabricante = '$fabricante' , Local = '$local' , Descricao = '$descricao' , Patrimonio = $pat , Status = 0 , FaixaNominal = '$faixaNominal', Resolucao = '$resolucao', Tolerancia = '$tolerancia', DataIncorporacao = '$dataIncorp', DataInicialUso = '$dataIniuso', ForaUso = $validaForaUso, DataBaixa = '$dataForaUso', PeriodCalibracao = $pcablibr, PeriodManut = $pmanut, PeriodChecagem = $pchecagem, NoEscopo = '$noescopo' where Codigo = $codigo";
						
			mysql_query($sql);
			
		}

		
}

if (isset($_GET['pontosCalibracao'])) {
	
	$modo = ($_GET['modo']);
	$valor = ($_GET['valor']);
	$codItemEquip = ($_GET['codCompServItem']);
	$codGrandeza = ($_GET['codGrandeza']);
	$tolerancia = ($_GET['tolerancia']);
	$codUnidade = ($_GET['codUnidade']);
	$codServico = ($_GET['codServico']);
	
	$tolerancia = addslashes($tolerancia);
		
	$sql = "Select Codigo from compcalibrserv where CodServico = $codServico and CodItemCalibracao = $codItemEquip";
	
	$select = mysql_query($sql);
	
	if ($rf = mysql_fetch_array($select)) {
		
		$codCompServItem = $rf['Codigo'];
	
	}
	
	
	if ($modo == "cadastrar") {
		
		//INFORMANDO A TABELA E OS DADOS QUE SERÃƒO INSERIDOS NO BANCO
		$tabela = "pontocalibracao";
		$campos = "CodCompCalibrServ, CodGrandeza, Valor, Status, CodUnidade, Tolerancia";
		$valores = "$codCompServItem, $codGrandeza, $valor, 0, $codUnidade, '$tolerancia'";
		//-----------------------------------------------------------
			
		//CHAMANDO A FUNÃ‡ÃƒO QUE FAZ O CADASTRO DAS INFORMAÃ‡Ã•ES
		inserir($tabela, $campos, $valores);
		
	}
	
}


if ($_GET['Cadgrandezas']) {
	
	$nomeGrandeza = ($_GET['grandeza']);
	
	echo $nomeGrandeza;
	
	//INFORMANDO A TABELA E OS DADOS QUE SERÃƒO INSERIDOS NO BANCO
	$tabela = "grandezas";
	$campos = "Nome, Unidade, Status";
	$valores = "'$nomeGrandeza', '', 0";
	//-----------------------------------------------------------
		
	//CHAMANDO A FUNÃ‡ÃƒO QUE FAZ O CADASTRO DAS INFORMAÃ‡Ã•ES
	inserir($tabela, $campos, $valores);
		
	
}


if ($_GET['unidades']) {

	$nomeUnidade = ($_GET['unidade']);

	//INFORMANDO A TABELA E OS DADOS QUE SERÃƒO INSERIDOS NO BANCO
	$tabela = "unidades";
	$campos = "Nome, Status";
	$valores = "'$nomeUnidade', 0";
	//-----------------------------------------------------------

	//CHAMANDO A FUNÃ‡ÃƒO QUE FAZ O CADASTRO DAS INFORMAÃ‡Ã•ES
	inserir($tabela, $campos, $valores);

}


//CADASTRANDO AS EMPRESAS CERTIFICADORAS
if ($_GET['certificadores']) {

	$nomeCertificador = ($_GET['certificador']);

	//INFORMANDO A TABELA E OS DADOS QUE SERÃƒO INSERIDOS NO BANCO
	$tabela = "certificadores";
	$campos = "Nome, Status";
	$valores = "'$nomeCertificador', 0";
	//-----------------------------------------------------------

	//CHAMANDO A FUNÃ‡ÃƒO QUE FAZ O CADASTRO DAS INFORMAÃ‡Ã•ES
	inserir($tabela, $campos, $valores);

}

if ($_GET['itensEquipamento']) {
	
		//CADASTRANDO INFORMAÃ‡Ã•ES NO BANCO DE DADOS
		
		//CAPTURANDO OS CAMPOS PREENCHIDOS
		$grandeza = ($_GET['grandeza']);
		$servico = ($_GET['servico']);
		$faixaNominal = ($_GET['faixaNominal']);
		$tolerancia = ($_GET['tolerancia']);
		$tipoEntrada = ($_GET['tipoEntrada']);
		$codEquipamento = ($_GET['codEquipamento']);
		$pCalibracao = ($_GET['pCalibracao']);
		$resoluc = ($_GET['resolu']);
		$modo = ($_GET['modo']);
	
		
		//EVITANDO CONFLITO NO BANCO DE DADOS AO INSERIR O CARACTER "'"
		$grandeza = addslashes($grandeza);
		$servico = addslashes($servico);
		$tolerancia = addslashes($tolerancia);
		$faixaNominal = addslashes($faixaNominal);
		$pCalibracao = addslashes($pCalibracao);
		$resoluc = addslashes($resoluc);
		
		//-------------------------------------------------------------

		// ------------------------------
		
		//VERIFICAR SE Ã‰ ATUALIZAÃ‡ÃƒO OU CADASTRO DE NOVO REGISTRO
		if ($modo == "cadastrar") {
				
			//INFORMANDO A TABELA E OS DADOS QUE SERÃƒO INSERIDOS NO BANCO
			$tabela = "itemcalibracao";
			$campos = "Nome, CodEquipamento, FaixaNominal, Tolerancia, Servico, Tipo, PontosCalibracao, Resolucao, Status";
			$valores = "'$grandeza', $codEquipamento, '$faixaNominal', '$tolerancia', '$servico', '$tipoEntrada', '$pCalibracao', '$resoluc', 0";
			
			//-----------------------------------------------------------
		
			//CHAMANDO A FUNÃ‡ÃƒO QUE FAZ O CADASTRO DAS INFORMAÃ‡Ã•ES
			inserir($tabela, $campos, $valores);
		
		}
		else {
		
			$codigo = ($_GET['codigo']);
		
			$sql = "Update itemcalibracao set Nome = '$grandeza' , CodEquipamento = $codEquipamento , FaixaNominal = '$faixaNominal' , Tolerancia = '$tolerancia' , Servico = '$servico' , Tipo = '$tipoEntrada' , PontosCalibracao = '$pCalibracao' , Resolucao = '$resoluc' ,  Status = 0 where Codigo = $codigo";
				
			mysql_query($sql);
		
		}
		
}


//VERIFICANDO SE Ã‰ O CADASTRO DE UM SERVIÃ‡O DO EQUIPAMENTO

if (isset($_GET['servicoEquip'])) {
		
	//CAPTURANDO OS CAMPOS PREENCHIDOS
	$modo = ($_GET['modo']);
	$temPontos = ($_GET['temPontos']);
	$nomeServico = ($_GET['nome']);
	$codEquipamento = ($_SESSION['CODIGOEQUIPAMENTO']);
	
	if ($modo == "cadastrar") {
		
		$tabela = "servicos";
		$campos = "Nome, CodEquipamento, TemPontos, Status";
		$valores = "'$nomeServico', $codEquipamento, '$temPontos', 0";
		
		//CHAMANDO A FUNÃ‡ÃƒO QUE FAZ O CADASTRO DAS INFORMAÃ‡Ã•ES
		inserir($tabela, $campos, $valores);
		
	}
	
	
}

?>