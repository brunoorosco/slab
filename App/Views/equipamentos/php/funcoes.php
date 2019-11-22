<?php

//FUNÃƒâ€¡Ãƒâ€¢ES MODULARES DO SISTEMA
include("../../php/modular.php");


//FUNÃƒâ€¡ÃƒÆ’O ESPECÃƒï¿½FICA PARA CONTAR A QUANTIDADE DE PÃƒï¿½GINAS PARA O USUÃƒï¿½RIO
//VARIÃƒï¿½VEIS: $codEquipamento - CÃƒâ€œDIGO DO EQUIPAMENTO PARA CONSULTAS DE ITENS DE CALIBRAÃƒâ€¡ÃƒÆ’O ; $tipo - PARA ITENS DE CALIBRAÃƒâ€¡ÃƒÆ’O, CONSULTA SE Ãƒâ€° UM ITEM DE MANUTENÃƒâ€¡ÃƒÆ’O OU CALIBRAÃƒâ€¡ÃƒÆ’O
function contaPaginas($status, $codEquipamento, $tipo) {
			
	
	//CONSULTA DE TODOS OS EQUIPAMENTOS
	if ($status == "equipamentos") {	
		
		//CASO NENHUMA PESQUISA ESPECÃƒÆ’Ã†â€™ÃƒÂ¯Ã‚Â¿Ã‚Â½FICA DE EMPRESA SEJA REALIZADA
		$sql = "Select COUNT(*) from equipamentos where Status = 0";
		
		
		$select = mysql_query($sql);
		
		if ($rf = mysql_fetch_array($select)) {
		
			$quantidadeRegistros = $rf['COUNT(*)'];
		}
		
		$npaginas = ($quantidadeRegistros/6);
		
		//ARREDONDANDO QUANTIDADE DE REGISTROS PARA CIMA PARA GERAR O NÃƒÆ’Ã†â€™Ãƒâ€¦Ã‚Â¡MERO DE PÃƒÆ’Ã†â€™ÃƒÂ¯Ã‚Â¿Ã‚Â½GINAS CORRETO
		$totalPaginasEquip = ceil($npaginas);
		//-------------------------------------------
	
		return $totalPaginasEquip;	
		
	}
	
	
	//CONSULTA DE TODAS OS ITENS DE CALIBRAÃƒâ€¡ÃƒÆ’O 	
	if ($status == "itemAdicional") {
		
		//CASO NENHUMA PESQUISA ESPECÃƒÆ’Ã†â€™ÃƒÂ¯Ã‚Â¿Ã‚Â½FICA DE EMPRESA SEJA REALIZADA
		$sql = "Select COUNT(*) from itemcalibracao where Status = 0 and CodEquipamento = $codEquipamento and Tipo = $tipo";
		
		$select = mysql_query($sql);
		
		if ($rf = mysql_fetch_array($select)) {
		
			$quantidadeRegistros = $rf['COUNT(*)'];
		}
		
		$npaginas = ($quantidadeRegistros/6);
		
		//ARREDONDANDO QUANTIDADE DE REGISTROS PARA CIMA PARA GERAR O NÃƒÆ’Ã†â€™Ãƒâ€¦Ã‚Â¡MERO DE PÃƒÆ’Ã†â€™ÃƒÂ¯Ã‚Â¿Ã‚Â½GINAS CORRETO
		$totalPaginasItens = ceil($npaginas);
		//-------------------------------------------
		
		return $totalPaginasItens;	
		
	}	
	
}


//FUNÃƒâ€¡ÃƒÆ’O ESPECÃƒï¿½FICA DA PÃƒï¿½GINA QUE FOI SELECIONADA PELO USUÃƒï¿½RIO
//VARIÃƒï¿½VEIS
// PAGINACAO : - TRAZ O NÃƒÅ¡MERO DA PÃƒï¿½GINA QUE FOI SELECIONADA PELO USUÃƒï¿½RIO
function fazerPaginacao($paginacao) {
	
	//ROTINA QUE REALIZA A PAGINAÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â¡ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢O DE REGISTROS DO BANCO DE DADOS

		//PEGA O NÃƒÆ’Ã†â€™Ãƒâ€¦Ã‚Â¡MERO DA PÃƒÆ’Ã†â€™ÃƒÂ¯Ã‚Â¿Ã‚Â½GINA
		$numeroPagina = $paginacao;
		$numeroMK = $numeroPagina;
	
		if ($numeroPagina != 1) {
	
			$numeroPagina -= 1;
			$paginador = (6*$numeroPagina);
			
			return $paginador;
			
		}
		else {
	
			return $paginador = 0;
	
		}

	//-------------------------------------------------------------
		
}


//EXCLUIR
//VARIÃƒï¿½VEIS:
if (isset($_GET['excluir'])) {
	
	$tipo = ($_GET['excluir']);
	
	//EXCLUIR UM EQUIPAMENTO
	if ($tipo == "equipamentos") {
		
		$codigoEquipamento = ($_SESSION['CODIGOEQUIPAMENTO']);
		$sql = "update equipamentos set Status = 1 where Codigo = $codigoEquipamento";		
		
	}
	
	//EXCLUIR UMA GRANDEZA
	if ($tipo == "grandezas") {
	
		$cod = ($_GET['codigo']);
		$sql = "update grandezas set Status = 1 where Codigo = $cod";

	}
	
	//EXCLUIR UMA UNIDADE DE MEDIDA
	if ($tipo == "unidades") {
	
		$cod = ($_GET['codigo']);
		$sql = "update unidades set Status = 1 where Codigo = $cod";
	
	}
	
	//EXCLUIR UM PONTO DE CALIBRAÃƒâ€¡ÃƒÆ’O
	if ($tipo == "pontosCalibracao") {
	
		$codPonto = ($_GET['codigo']);
		$codigoEquipamento = ($_SESSION['CODIGOEQUIPAMENTO']);
		$sql = "update pontocalibracao set Status = 1 where Codigo = $codPonto";
	
	}	
	
	//EXCLUIR UM SERVIÃƒâ€¡O DO EQUIPAMENTO
	if ($tipo == "servicosEquipamentos") {
		
		$codServico = ($_GET['codigo']);
		$sql = "update servicos set Status = 1 where Codigo = $codServico";
		
	}
	
	//EXCLUIR UM ITEM DE CALIBRAÃƒâ€¡ÃƒÆ’O DO EQUIPAMENTO
	if ($tipo == "itensCalibracao") {
	
		$codItem = ($_GET['codigo']);
		$sql = "update itemcalibracao set Status = 1 where Codigo = $codItem";
	
	}
	
	mysql_query($sql);
	
}

//CONSULTAS
//VARIÃƒï¿½VEIS
// PAGINACAO : - 0 :: QUANDO NÃƒÆ’O EXISTIR NENHUMA PAGINA ESPECÃƒï¿½FICA ; 3 :: QUANDO OCORRER UMA CONSULTA INDIVIDUAL
// TIPO: - TIPO DE CONSULTA, SE Ãƒâ€° EQUIPAMENTO OU ITEM DO EQUIPAMENTO
if (isset($_GET['consultar'])) {
	
	$tipo = ($_GET['consultar']);
	$paginacao = ($_GET['param']);
	$metodo = ($_GET['metodo']);
	
	//CONSULTANDO EQUIPAMENTOS
	if ($tipo == "equipamentos") {
		
		
		if ($metodo != 'unico') {
			
			$sql = "Select Codigo, Nome, Nequipamento from equipamentos where status = 0 order by Nequipamento asc";
			$sql1 = "Select Codigo, Nequipamento, Nome, Fabricante, Local, Descricao, Patrimonio, FaixaNominal, Resolucao, Tolerancia, DataIncorporacao, DataInicialUso, ForaUso, DataBaixa, PeriodCalibracao, PeriodManut, PeriodChecagem, NoEscopo from equipamentos where status = 0 order by Codigo desc limit 1";	
		
			$select = mysql_query($sql);
			$select1 = mysql_query($sql1);
			
			//CONSTRUINDO OS ELEMENTOS HTML
			$combo = criardorElementos('equipamentos',$select,'comboBox');
			$matriz = criardorElementos('equipamentos',$select1, 'matrizDados');			
			
			//RETORNANDO A TABELA E COMBOBOX QUE FOI CRIADOS ANTERIORMENTE
			echo $matriz."**".$combo;
			// ----------------------------------
			
			
		}
		else {

			//VARIÃƒï¿½VEL DE SESSÃƒÆ’O RESPONSÃƒï¿½VEL POR ARMAZENAR O CÃƒâ€œDIGO DO EQUIPAMENTO
			$_SESSION['CODIGOEQUIPAMENTO'] = $paginacao;
			//--------------------------------------------------------------------			
			
			$sql = "Select Nequipamento, Nome, Fabricante, Local, Descricao, Patrimonio, FaixaNominal, Resolucao, Tolerancia, DataIncorporacao, DataInicialUso, ForaUso, DataBaixa, PeriodCalibracao, PeriodManut, PeriodChecagem, NoEscopo from equipamentos where Codigo = $paginacao";
			
			$select = mysql_query($sql);
						
			//CONSTRUINDO OS ELEMENTOS HTML
			$matriz = criardorElementos('equipamentos',$select, 'matrizDados');
			
			//CONSTRUINDO OS BOTÃƒâ€¢ES EXCLUIR E ATUALIZAR
			$botoes = criardorElementos('equipamentos',$select, 'botoes');
			
			//RETORNANDO A TABELA E COMBOBOX QUE FOI CRIADOS ANTERIORMENTE
			echo $matriz."**".$botoes;
			// ----------------------------------			
			
		}
		
	}
	
	//CONSULTANDO AS GRANDEZAS NA INTERFACE DE PONTOS DE CALIBRAÃƒâ€¡ÃƒÆ’O
	if ($tipo == "grandezasPc") {
		
		$sql = "Select * from grandezas where Status = 0";
		
		$select = mysql_query($sql);
		
		$combo = criardorElementos('pontosCalibracao',$select, 'comboCalibracao');
		
		echo $combo;
		
	}
	
	//CONSULTANDO OS ITENS DO EQUIPAMENTO NA PÃ�GINA DE AGENDAMENTOS
	if ($tipo == "itensEquipAgend") {
		
		$codEquip = ($_GET['cod']);
		
		$sql = "Select * from itemcalibracao where Status = 0 and CodEquip = $codEquip";
		
		$select = mysql_query($sql);
		
		$combo = criardorElementos('agendamentos',$select, 'tabelaItensEquip');
		
		echo $combo;		
		
	}
	
	//CONSULTANDO OS SERVIÃ‡OS DO EQUIPAMENTO NA PÃ�GINA DE AGENDAMENTOS
	if ($tipo == "listaServicosAgend") {
		
		$codItemEquip = ($_GET['codItem']);
		
		$sql = "Select compcalibrserv.Codigo, servicos.Nome from servicos, compcalibrserv where compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.Status = 0 and compcalibrserv.CodItemCalibracao = $codItemEquip";
		
		$select = mysql_query($sql);
		
		$combo = criardorElementos('agendamentos',$select, 'tabelaServicosEquip');
		
		echo $combo;
		
	}
	
	//CONSULTANDO AS GRANDEZAS NA INTERFACE DAS GRANDEZAS
	if ($tipo == "grandezas") {
		
		
		$sql = "Select * from grandezas where Status = 0";
		
		$select = mysql_query($sql);
		
		$tabela = criardorElementos('grandezas',$select, 'tabela');
		
		echo $tabela;
		
	}
	
	//CONSULTANDO AN�LISES CR�TICAS PELA DATA
	if ($tipo == "analiseCritica") {
	
		$data = ($_GET['data']);
	
		//CONVERSÃO DE FORMATO DE DATAS
		$data = dataAmericana($data);
	
		$sql = $_SESSION['SQLBUSCA']." and DataAnalise = '$data'";
	
		$select = mysql_query($sql);
	
		$tabela = criardorElementos('analiseCritica',$select, 'tabela');
			
		echo $tabela;
		
	}
	
	
	//CONSULTANDO AGENDAMENTOS COM INTERVALO DE DATAS E TIPO DE AGENDAMENTO
	if ($tipo == "agendDatas") {
				
		$dataDe = ($_GET['dataDe']);
		$dataPara = ($_GET['dataPara']);
		$tipoAg = ($_GET['tipoAg']);
		
		//CONVERSÃO DE FORMATO DE DATAS
		$dataDe = dataAmericana($dataDe);
		$dataPara = dataAmericana($dataPara);
		
		$sql = $_SESSION['SQLBUSCA']." and agendcalibrmanut.TipoAgend = '$tipoAg' and agendcalibrmanut.DataPrev between '$dataDe' and '$dataPara'";
		
		$select = mysql_query($sql);
		
		$tabela = criardorElementos('agendamentosMarc',$select, 'tabela');
		
		echo $tabela;
		
	}
	
	
	//CONSULTANDO AGENDAMENTOS SOMENTE PELO TIPO DE AGENDAMENTO
	if ($tipo == "agendTipoAg") {
				
		$tipoAg = ($_GET['tipoAg']);
			
		
		//AGENDAMENTOS PREVISTOS OU AGUARDANDO EXECU��O, COM ORDENA��O DE DATA
		if (($tipoAg == 0)||($tipoAg == 1)) {
		
			$sql = $_SESSION['SQLBUSCA']." and agendcalibrmanut.TipoAgend = '$tipoAg' order by agendcalibrmanut.DataPrev asc";
		
		}
					
		$select = mysql_query($sql);
		
		$tabela = criardorElementos('agendamentosMarc',$select, 'tabela');
		
		echo $tabela;

	}
	
	//CONSULTANDO OS SERVI�OS DO ITEM DO EQUIPAMENTO NA P�GINA DE DETALHES DO AGENDAMENTO
	if ($tipo == "listaServicosDetAgend") {
		
		$codItem = ($_GET['codItem']);
		
		$sql = "Select servicos.Codigo, servicos.Nome from servicos, compcalibrserv where servicos.Codigo = compcalibrserv.CodServico and compcalibrserv.CodItemCalibracao = $codItem";
		
		$select = mysql_query($sql);
		
		$combo = criardorElementos('agendamentos',$select, 'comboServicos');
		
		echo $combo;
		
	}
		
	//CONSULTANDO AS GRANDEZAS NA INTERFACE DAS GRANDEZAS
	if ($tipo == "unidades") {
		
		$sql = "Select * from unidades where Status = 0";
	
		$select = mysql_query($sql);
	
		$tabela = criardorElementos('unidades',$select, 'tabela');
	
		echo $tabela;
	
	}
	
	//CONSULTANDO AS UNIDADES NA INTERFACE DOS PONTOS DE CALIBRAÃƒâ€¡ÃƒÆ’O
	if ($tipo == "unidadesPc") {
	
		$sql = "Select * from unidades where Status = 0";
	
		$select = mysql_query($sql);
	
		$combo = criardorElementos('pontosCalibracao',$select, 'comboUnidades');
	
		echo $combo;
	
	}
	
	//CONSULTANDO AS EMPRESAS CERIFICADORAS NA INTERFACE DE CONFIRMA��O DOS AGENDAMENTOS
	if ($tipo == "certificadores") {
		
		$sql = "Select * from certificadores where Status = 0";
		
		$select = mysql_query($sql);
	
		$combo = criardorElementos('certificadores',$select, 'comboCertificadores');
	
		$botaoAcr = "<input type=button onclick=addCertificadores(); name=btn_acrescentarEmpresa id=bt_empresaPlus>";
		
		echo $combo.$botaoAcr;
				
	}
	
	//CONSULTANDO OS PONTOS DE CALIBRAÃƒâ€¡ÃƒÆ’O DO EQUIPAMENTO
	if ($tipo == "pontoCalibracao") {
		
		$codItemEquip = ($_GET['codItemManut']);
		$codServico = ($_GET['codServico']);
		$metodo = ($_GET['metodo']);
		
		if ($metodo != "unico") {
		
			
			$sql1 = "Select Codigo from compcalibrserv where CodServico = $codServico and CodItemCalibracao = $codItemEquip";
			
			$select1 = mysql_query($sql1);
			
			if ($rf1 = mysql_fetch_array($select1)) {
			
				$codCompServItem = $rf1['Codigo'];
			
			}
			
					
			$sql = "Select pontocalibracao.Codigo, grandezas.Nome as 'Grandeza', unidades.Nome as 'Unidade', pontocalibracao.Tolerancia, pontocalibracao.Valor from grandezas, pontocalibracao, unidades where pontocalibracao.CodGrandeza = grandezas.Codigo and pontocalibracao.CodUnidade = unidades.Codigo and pontocalibracao.CodCompCalibrServ = $codCompServItem and pontocalibracao.Status = 0";
			
			$select = mysql_query($sql);
			
			if (mysql_num_rows($select)) {
				
				$tabela = criardorElementos('pontosCalibracao',$select, 'tabela');
				
			}
			else
			{
				
				$tabela = "<span class='texto3'><br><br><br>VocÃƒÂª precisa cadastrar pontos de calibraÃƒÂ§ÃƒÂ£o para esse serviÃƒÂ§o!</span>";
				
			}
			
			echo $tabela;
			
			
		}
		else {
			
			
			//CAPTURANDO O C�DIGO DO CALIBRA��O
			
			//--------------------------------------------------------------------
				
			$sql = "Select Nequipamento, Nome, Fabricante, Local, Descricao, Patrimonio, FaixaNominal, Resolucao, Tolerancia, DataIncorporacao, DataInicialUso, ForaUso, DataBaixa, PeriodCalibracao, PeriodManut, PeriodChecagem, NoEscopo from equipamentos where Codigo = $paginacao";
				
			$select = mysql_query($sql);
			
			//CONSTRUINDO OS ELEMENTOS HTML
			$matriz = criardorElementos('equipamentos',$select, 'matrizDados');
				
			//CONSTRUINDO OS BOTÃƒâ€¢ES EXCLUIR E ATUALIZAR
			$botoes = criardorElementos('equipamentos',$select, 'botoes');
				
			//RETORNANDO A TABELA E COMBOBOX QUE FOI CRIADOS ANTERIORMENTE
			echo $matriz."**".$botoes;
			// ----------------------------------
			
			
			
		}
		
	}
	
	
	//CONSULTANDO OS SERVIÃƒâ€¡OS NA INTERFACE DOS PONTOS DE CALIBRAÃƒâ€¡ÃƒÆ’O
	if ($tipo == "servicosEquipamentosPc") {

		$codItemEquip = ($_GET['itemEquip']);

		$sql = "Select servicos.Codigo, servicos.Nome from servicos, compcalibrserv where compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.Status = 0 and CodItemCalibracao = $codItemEquip";

		$select = mysql_query($sql);

		//CONSTRUINDO OS ELEMENTOS HTML
		$tabela = criardorElementos('servicosEquipamentos',$select,'combo');
		//------------------------------------------------------------------

		//RETORNANDO A TABELA E COMBOBOX QUE FOI CRIADOS ANTERIORMENTE
		echo $tabela;
		// -----------------------------------------------------------------

	}
	
	//CONSULTANDO OS ITENS DO EQUIPAMENTO NA INTERFACE DOS PONTOS DE CALIBRAÃƒâ€¡ÃƒÆ’O
	if ($tipo == "itensEquipamentoPc") {
	
		$codEquip = ($_SESSION['CODIGOEQUIPAMENTO']);
		
		$sql = "Select Codigo, Nome from itemcalibracao where Status = 0 and CodEquip = $codEquip";
	
		$select = mysql_query($sql);
	
		//CONSTRUINDO OS ELEMENTOS HTML
		$tabela = criardorElementos('servicosItemCalibracao',$select,'combo');
		//------------------------------------------------------------------
	
		//RETORNANDO A TABELA E COMBOBOX QUE FOI CRIADOS ANTERIORMENTE
		echo $tabela;
		// -----------------------------------------------------------------
	
	}
	
	//CONSULTANDO OS SERVIÃƒâ€¡OS
	if ($tipo == "servicosEquipamentos") {
		
			$codEquip = ($_SESSION['CODIGOEQUIPAMENTO']);

			$sql = "Select Codigo, Nome from servicos where Status = 0 and CodEquipamento = $codEquip";
									
			$select = mysql_query($sql);
						
			//CONSTRUINDO OS ELEMENTOS HTML
			$tabela = criardorElementos('servicosEquipamentos',$select,'tabela');
						
			//RETORNANDO A TABELA E COMBOBOX QUE FOI CRIADOS ANTERIORMENTE
			echo $tabela;
			// ----------------------------------	
		
	}
	
	
	//CONSULTANDO OS SERVIÃƒâ€¡OS NA PÃƒï¿½GINA DOS ITENS DE CALIBRAÃƒâ€¡ÃƒÆ’O
	if ($tipo == "servicosItemCalibracao") {
	
			$codEquip = ($_SESSION['CODIGOEQUIPAMENTO']);
		
			$sql = "Select * from servicos where CodEquipamento = $codEquip and Status = 0";
			
			$select = mysql_query($sql);
			
			//CONSTRUINDO OS ELEMENTOS HTML
			if (mysql_num_rows($select)) {
			
				$tabela = criardorElementos('servicosItemCalibracao',$select,'checksLimpos');
				
			}
			else {
				
				$tabela = "<span class='texto3'><br><br><br>VocÃƒÂª precisa cadastrar os serviÃƒÂ§os deste equipamento!</span>";
			}
			
			//RETORNANDO A TABELA E COMBOBOX QUE FOI CRIADOS ANTERIORMENTE
			echo $tabela;
			// ----------------------------------
			
	}
	
	//CONSULTANDO OS ITENS DE CALIBRAÃƒâ€¡ÃƒÆ’O DO EQUIPAMENTO	
	if ($tipo == "listaItensCalibracao") {
	
		$codEquip = ($_SESSION['CODIGOEQUIPAMENTO']);
	
		
		//VERIFICANDO SE Ãƒâ€° A CONSULTA GERAL
		
		if ($metodo != "unico") {
		
			$sql = "Select * from itemcalibracao where CodEquip = $codEquip and Status = 0";
		
			$select = mysql_query($sql);
				
			//CONSTRUINDO OS ELEMENTOS HTML
			if (mysql_num_rows($select)) {

				$tabela = criardorElementos('servicosItemCalibracao',$select,'tabela');

			}
			else {

				$tabela = "<span class='texto3'><br><br><br>Ãƒâ€° necessÃƒÂ¡rio cadastrar os itens de calibraÃƒÂ§ÃƒÂ£o para o equipamento!</span>";

			}

			//RETORNANDO A TABELA E COMBOBOX QUE FOI CRIADOS ANTERIORMENTE
			echo $tabela;

		}
		else {
		
			//VERIFICANDO SE Ãƒâ€° A CONSULTA DE UM ÃƒÅ¡NICO REGISTRO
			
			$sql = "Select servicos.Nome, itemcalibracao.Nome as 'NomeItem'  from servicos, compcalibrserv, itemcalibracao where compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and compcalibrserv.CodServico = servicos.Codigo and itemcalibracao.Codigo = $paginacao";
			$sql1 = "Select servicos.Nome, itemcalibracao.Nome as 'NomeItem', itemcalibracao.FaixaNominal  from servicos, compcalibrserv, itemcalibracao where compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and compcalibrserv.CodServico = servicos.Codigo and itemcalibracao.Codigo = $paginacao";
			
			$select = mysql_query($sql);
			$select1 = mysql_query($sql1);
			
			$tabela = criardorElementos('servicosItemCalibracao',$select,'tabelaReg');
			
			if ($rf1 = mysql_fetch_array($select1)) {
				
				$itemCalibracao = $rf1['NomeItem'];
				$faixaNominal = $rf1['FaixaNominal'];
				
			}
			
			echo $tabela."**".$itemCalibracao."**".$faixaNominal;

		}

		// ----------------------------------
		
	}
	
	
}



?>