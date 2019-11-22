<?php


	//IMPORTANTE:
	// NO STATUS DO AGENDAMENTO, SEGUEM A DEFINI��O DOS C�DIGOS:
	//0 - AGENDAMENTO AGUARDANDO CONFIRMA��O
	//1 - AGENDAMENTO AGUARDANDO
	//2 - AGENDAMENTO EXECUTADO
	//3 - AGENDAMENTO CANCELADO
	//4 - RESULTADOS AGUARDANDO CONFIRMA��O DO GESTOR


	//ARQUIVO DE CONEXÃƒÆ’Ã†â€™O COM O BANCO DE DADOS
	include("../../php/conexao.php");
	
	include("../php/funcoes.php");

	
	//CHECAR SE FOI REALIZADA A CONEXÃƒÆ’Ã†â€™O DO USUÃƒÆ’Ã¯Â¿Â½RIO
	conexaoUsuario();
	
	//CANCELAR UM AGENDAMENTO
	if (isset($_GET['excluir'])) {
		
		$codAgend = ($_GET['excluir']);
		
		$sql = "Update agendcalibrmanut set Status = 1 where Codigo = $codAgend";
		
		mysql_query($sql);
?>

			<script type="text/javascript">

				alert('AGENDAMENTO CANCELADO!');

			</script>

<?php
		
	}
	
	//EDITAR INFORMAÃ‡Ã•ES DE UM AGENDAMENTO
	if (isset($_GET['editar'])) {
		
		$codAgend = ($_GET['editar']);
		
		//REDIRECIONANDO PARA A PÃ�GINA DOS AGENDAMENTOS
		header("location:../agendamento/index.php?agend=0&codA=$codAgend");
		
	}
	
	
	//EXISTIRÃ� UMA VARIÃ�VEL DE SESSÃƒO $_SESSION['CONTROLBUSCA'] RESPONSÃ�VEL POR CONTROLAR O TIPO DA BUSCA REALIZADA NO BANCO DE DADOS
	//PARÃ‚METROS: NOTAG - EQUIPAMENTOS SEM AGENDAMENTO ::: SMAG - AGENDAMENTOS PARA O SEMESTRE ::: ANAG - AGENDAMENTOS PARA O ANO ::: MSAG - AGENDAMENTOS PARA O MÃŠS ::: TDAG - TODOS OS AGENDAMENTOS REALIZADOS
	
	
	//ROTINA QUE REALIZA A PAGINAÃƒÆ’Ã¢â‚¬Â¡ÃƒÆ’Ã†â€™O DE REGISTROS DO BANCO DE DADOS
	if (isset($_GET['clickPag'])) {
	
		//PEGA O NÃƒÆ’Ã…Â¡MERO DA PÃƒÆ’Ã¯Â¿Â½GINA
		$numeroPagina = ($_GET['clickPag']);
		$numeroMK = $numeroPagina;
	
		if ($numeroPagina != 1) {
	
			$numeroPagina -= 1;
			$paginador = (11*$numeroPagina);
		}
		else {
	
			$paginador = 0;
	
		}
	}
	else {
	
		$numeroMK = 1;
		$paginador = 0;
	
	}
	//-------------------------------------------------------------
	
		
	//AO CLICAR NO BOTÃƒO PARA PESQUISAR OS AGEDAMENTOS
	
	if(isset($_POST['btn_pesquisar'])) {
		
		$tipCon = ($_POST['cmb_filtro']);
		
		$tipoAg = ($_POST['cmb_equipamento']);
		
		//AJUSTANDO AS VARIÃ�VEIS DE SESSÃƒO DOS COMBOBOX
		$_SESSION['FFILTRO'] = $tipCon;
		$_SESSION['FEQUIPAMENTO'] = $tipoAg;
				
		//PESQUISANDO OS AGENDAMENTOS AGUARDANDO CONFIRMA��O
		if ($tipCon == 0) {
			
			$_SESSION['CONTROLBUSCA'] = 0;
			
			if ($tipoAg != 0) {
			
				$sql1 = "Select agendcalibrmanut.Codigo, agendcalibrmanut.CodAgendamento, itemcalibracao.nome as 'ItemCalibr', servicos.Nome as 'Serv', agendcalibrmanut.DataPrev, agendcalibrmanut.CodTecnico, agendcalibrmanut.CodEmpresa, agendcalibrmanut.DataExec from agendcalibrmanut, itemcalibracao, servicos, compcalibrserv, equipamentos where agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.Status = 0 and itemcalibracao.CodEquip = $tipoAg order by agendcalibrmanut.DataPrev asc";
				
				
				//ARMAZENAR A QUERY SQL PARA POSTERIORMENTE MANIPUL�-LA
				$_SESSION['SQLBUSCA'] = "Select agendcalibrmanut.Codigo, agendcalibrmanut.CodAgendamento, itemcalibracao.nome as 'ItemCalibr', servicos.Nome as 'Serv', agendcalibrmanut.DataPrev, agendcalibrmanut.CodTecnico, agendcalibrmanut.CodEmpresa, agendcalibrmanut.DataExec from agendcalibrmanut, itemcalibracao, servicos, compcalibrserv, equipamentos where agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.Status = 0 and itemcalibracao.CodEquip = $tipoAg";
								
			}
			else { //CASO N�O SEJA ESPECIFICADO O EQUIPAMENTO DURANTE A BUSCA, EXECUTAR A SEGUIR
				
				$sql1 = "Select agendcalibrmanut.Codigo, agendcalibrmanut.CodAgendamento, itemcalibracao.nome as 'ItemCalibr', servicos.Nome as 'Serv', agendcalibrmanut.DataPrev, agendcalibrmanut.CodTecnico, agendcalibrmanut.CodEmpresa, agendcalibrmanut.DataExec from agendcalibrmanut, itemcalibracao, servicos, compcalibrserv, equipamentos where agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.Status = 0 order by agendcalibrmanut.DataPrev asc";
								
				//ARMAZENAR A QUERY SQL PARA POSTERIOMENTE MANIPUL�-LA
				$_SESSION['SQLBUSCA'] = "Select agendcalibrmanut.Codigo, agendcalibrmanut.CodAgendamento, itemcalibracao.nome as 'ItemCalibr', servicos.Nome as 'Serv', agendcalibrmanut.DataPrev, agendcalibrmanut.CodTecnico, agendcalibrmanut.CodEmpresa, agendcalibrmanut.DataExec from agendcalibrmanut, itemcalibracao, servicos, compcalibrserv, equipamentos where agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.Status = 0";
								
			}
			
		}
		
		//PESQUISANDO OS AGENDAMENTOS AGUARDANDO EXECU��O
		if ($tipCon == 1) {
			
			
			$_SESSION['CONTROLBUSCA'] = 1;
			
			if ($tipoAg != 0) {
			
				$sql1 = "Select agendcalibrmanut.Codigo, agendcalibrmanut.CodAgendamento, itemcalibracao.nome as 'ItemCalibr', servicos.Nome as 'Serv', agendcalibrmanut.DataPrev, agendcalibrmanut.CodTecnico, agendcalibrmanut.CodEmpresa, agendcalibrmanut.DataExec from agendcalibrmanut, itemcalibracao, servicos, compcalibrserv, equipamentos where agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.Status = 1 and itemcalibracao.CodEquip = $tipoAg order by agendcalibrmanut.DataPrev asc";
				
				//ARMAZENAR A QUERY SQL PARA POSTERIORMENTE MANIPUL�-LA
				$_SESSION['SQLBUSCA'] = "Select agendcalibrmanut.Codigo, agendcalibrmanut.CodAgendamento, itemcalibracao.nome as 'ItemCalibr', servicos.Nome as 'Serv', agendcalibrmanut.DataPrev, agendcalibrmanut.CodTecnico, agendcalibrmanut.CodEmpresa, agendcalibrmanut.DataExec from agendcalibrmanut, itemcalibracao, servicos, compcalibrserv, equipamentos where agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.Status = 1 and itemcalibracao.CodEquip = $tipoAg";
				
			}
			else { //CASO N�O SEJA ESPECIFICADO O EQUIPAMENTO DURANTE A BUSCA, EXECUTAR A SEGUIR
				
				$sql1 = "Select agendcalibrmanut.Codigo, agendcalibrmanut.CodAgendamento, itemcalibracao.nome as 'ItemCalibr', servicos.Nome as 'Serv', agendcalibrmanut.DataPrev, agendcalibrmanut.CodTecnico, agendcalibrmanut.CodEmpresa, agendcalibrmanut.DataExec from agendcalibrmanut, itemcalibracao, servicos, compcalibrserv, equipamentos where agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.Status = 1 order by agendcalibrmanut.DataPrev asc";
				
				//ARMAZENAR A QUERY SQL PARA POSTERIOMENTE MANIPUL�-LA
				$_SESSION['SQLBUSCA'] = "Select agendcalibrmanut.Codigo, agendcalibrmanut.CodAgendamento, itemcalibracao.nome as 'ItemCalibr', servicos.Nome as 'Serv', agendcalibrmanut.DataPrev, agendcalibrmanut.CodTecnico, agendcalibrmanut.CodEmpresa, agendcalibrmanut.DataExec from agendcalibrmanut, itemcalibracao, servicos, compcalibrserv, equipamentos where agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.Status = 1";
								
			}
			
			
		}
		
		//PESQUISANDO OS AGENDAMENTOS EXECUTADOS
		if ($tipCon == 2) {
				
			
			$_SESSION['CONTROLBUSCA'] = 2;
				
			if ($tipoAg != 0) {
					
				$sql1 = "Select agendcalibrmanut.Codigo, agendcalibrmanut.CodAgendamento, itemcalibracao.nome as 'ItemCalibr', servicos.Nome as 'Serv', agendcalibrmanut.DataPrev, agendcalibrmanut.CodTecnico, agendcalibrmanut.CodEmpresa, agendcalibrmanut.DataExec from agendcalibrmanut, itemcalibracao, servicos, compcalibrserv, equipamentos where agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.Status = 2 and itemcalibracao.CodEquip = $tipoAg";
					
				//ARMAZENAR A QUERY SQL PARA POSTERIORMENTE MANIPUL�-LA
				$_SESSION['SQLBUSCA'] = $sql1;
		
			}
			else { //CASO N�O SEJA ESPECIFICADO O EQUIPAMENTO DURANTE A BUSCA, EXECUTAR A SEGUIR
		
				$sql1 = "Select agendcalibrmanut.Codigo, agendcalibrmanut.CodAgendamento, itemcalibracao.nome as 'ItemCalibr', servicos.Nome as 'Serv', agendcalibrmanut.DataPrev, agendcalibrmanut.CodTecnico, agendcalibrmanut.CodEmpresa, agendcalibrmanut.DataExec from agendcalibrmanut, itemcalibracao, servicos, compcalibrserv, equipamentos where agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.Status = 2";
						
				//ARMAZENAR A QUERY SQL PARA POSTERIOMENTE MANIPUL�-LA
				$_SESSION['SQLBUSCA'] = $sql1;
		
			}
				
				
		}
		
		//PESQUISANDO OS AGENDAMENTOS CANCELADOS
		if ($tipCon == 3) {
		
				
			$_SESSION['CONTROLBUSCA'] = 3;
		
			if ($tipoAg != 0) {
					
				$sql1 = "Select agendcalibrmanut.Codigo, agendcalibrmanut.CodAgendamento, itemcalibracao.nome as 'ItemCalibr', servicos.Nome as 'Serv', agendcalibrmanut.DataPrev, agendcalibrmanut.CodTecnico, agendcalibrmanut.CodEmpresa, agendcalibrmanut.DataExec from agendcalibrmanut, itemcalibracao, servicos, compcalibrserv, equipamentos where agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.Status = 3 and itemcalibracao.CodEquip = $tipoAg";
					
				//ARMAZENAR A QUERY SQL PARA POSTERIORMENTE MANIPUL�-LA
				$_SESSION['SQLBUSCA'] = $sql1;
		
			}
			else { //CASO N�O SEJA ESPECIFICADO O EQUIPAMENTO DURANTE A BUSCA, EXECUTAR A SEGUIR
		
				$sql1 = "Select agendcalibrmanut.Codigo, agendcalibrmanut.CodAgendamento, itemcalibracao.nome as 'ItemCalibr', servicos.Nome as 'Serv', agendcalibrmanut.DataPrev, agendcalibrmanut.CodTecnico, agendcalibrmanut.CodEmpresa, agendcalibrmanut.DataExec from agendcalibrmanut, itemcalibracao, servicos, compcalibrserv, equipamentos where agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.Status = 3";
						
				//ARMAZENAR A QUERY SQL PARA POSTERIOMENTE MANIPUL�-LA
				$_SESSION['SQLBUSCA'] = $sql1;
				
			}
		
		
		}
		
		//PESQUISANDO OS AGENDAMENTOS COM RESULTADOS AGUARDANDO CONFIRMA��O DO GESTOR
		if ($tipCon == 4) {
		
			$_SESSION['CONTROLBUSCA'] = 4;
			
			if ($tipoAg != 0) {
				
				$sql1 = "Select agendcalibrmanut.Codigo, agendcalibrmanut.CodAgendamento, agendcalibrmanut.DataExec, itemcalibracao.nome as 'ItemCalibr', servicos.Nome as 'Serv', agendcalibrmanut.DataPrev, agendcalibrmanut.CodTecnico, agendcalibrmanut.CodEmpresa, agendcalibrmanut.DataExec from agendcalibrmanut, itemcalibracao, servicos, compcalibrserv, equipamentos where agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.Status = 4 and itemcalibracao.CodEquip = $tipoAg";
				
				//ARMAZENAR A QUERY SQL PARA POSTERIORMENTE MANIPUL�-LA
				$_SESSION['SQLBUSCA'] = $sql1;
				
			}
			else { //CASO N�O SEJA ESPECIFICADO O EQUIPAMENTO DURANTE A BUSCA, EXECUTAR A SEGUIR
				
				$sql1 = "Select agendcalibrmanut.Codigo, agendcalibrmanut.CodAgendamento, itemcalibracao.nome as 'ItemCalibr', servicos.Nome as 'Serv', agendcalibrmanut.DataPrev, agendcalibrmanut.CodTecnico, agendcalibrmanut.CodEmpresa, agendcalibrmanut.DataExec from agendcalibrmanut, itemcalibracao, servicos, compcalibrserv, equipamentos where agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.Status = 4";
				
				//ARMAZENAR A QUERY SQL PARA POSTERIOMENTE MANIPUL�-LA
				$_SESSION['SQLBUSCA'] = $sql1;
				
			}
		
		
		}
			
	}
	
	//------------------------------------------------

	//FINALIZAR CONEXÃƒÆ’Ã†â€™O
	if (isset($_GET['sair'])) {
		
		unset($_SESSION['USUARIO']);
		unset($_SESSION['CODUSUARIO']);
		
		header("location:../index.php");
	}
	
?>

<html>


	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		
		<title>S-LAB :: Cadastro de equipamentos</title>

		<!-- ARQUIVOS CSS IMPORTADOS -->
		
			<link rel="stylesheet" type="text/css" href="../../styles/modular.css">
			<link rel="stylesheet" type="text/css" href="../../styles/cadEquipamentosCon.css">
			
		<!--------------------------->

		<!-- ARQUIVOS JAVASCRIPT -->
					
			<script type="text/javascript" src="../../js/jquery.js"></script>		
			<script type="text/javascript" src="../../js/mascara.js"></script>
			<script type="text/javascript" src="../../js/modular.js"></script>
			<script type="text/javascript" src="../js/validacao.js"></script>
			<script type="text/javascript" src="../js/funcoes.js"></script>
		
		<!-- ------------------ -->

		<!-- VALIDAÃƒÆ’Ã¢â‚¬Â¡ÃƒÆ’Ã†â€™O DO FORMULÃƒÆ’Ã¯Â¿Â½RIO -->

		
		<script type="text/javascript">
			


				    

			
		</script>


		<!-- ---------------------- -->

	</head>


	<body onload="bloqTxtAgend('sim');">

		

		<div class="principal">

			<a href="../inicial/index.php" class="cm_home"></a>
			
			<!-- MENUS PRINCIPAIS DO SISTEMA -->
		
				<a href="#" class="menu_rel"><?php echo(utf8_encode('Relat�rios'));?></a>

				<a href="#" class="menu_con">Consultas</a>

				<a href="#" class="menu_cad">Cadastros</a>
				
				<a href="../solicitacao/" class="bt_solicitar"></a>

			<!-- /////////////////////////// -->
			
			
			<!-- ESTRUTURA DA PÃƒÆ’Ã¯Â¿Â½GINA INICIAL -->
			

			<span class="paragrafo" id="ini_tit1">Solicitar</span>
			
			
				<!-- CABECALHO -->
				
					<div class="cabecalho"></div>
				
				<!-- --------- -->
				
				<!-- MENSAGEM DE BOAS VINDAS E CONFIGURAÃƒÆ’Ã¢â‚¬Â¡ÃƒÆ’Ã¢â‚¬Â¢ES PESSOAIS-->
				
				<span id="ini_tit11" class="texto">Bem vindo, <?php echo $_SESSION['USUARIO']; ?>!</span>
						
				<span class="lk_confPessoal"><a href="#"><?php echo(utf8_encode('Minhas configura��es&nbsp;&nbsp; |'));?></a></span>
				
				<span class="lk_confPessoal2"><a href="index.php?sair">Sair</a></span>
				
				<!-- ---------------------- -->
			
				<!-- MENU SECUNDÃƒÆ’Ã¯Â¿Â½RIO -->
				
					<div class="submenu_cont">
						
						<span class="subtitulo2" id="ini_tit3">Selecione um item abaixo:</span>
						
						<!-- OPÃƒÆ’Ã¢â‚¬Â¡ÃƒÆ’Ã¢â‚¬Â¢ES PARA RELATÃƒÆ’Ã¢â‚¬Å“RIOS -->
												
						<!-- ---------------------- -->
						
							<ul class="listas" id="ini_lst1" type="square">
								
								<li><a href="../relatorios/index.php" class="lk_lista"><?php echo(utf8_encode('Relat�rios')); ?></a></li>
								
							</ul>
						
						<!-- OPÃƒÆ’Ã¢â‚¬Â¡ÃƒÆ’Ã¢â‚¬Â¢ES PARA CADASTROS -->
							
							<ul class="listas" id="ini_lst2" type="square">
								
								<li><a href="../index.php" class="lk_lista">Equipamentos</a></li>
								<li><a href="../unidades/" class="lk_lista">Unidades/Grandezas</a></li>
								<li><a href="../agendamento/" class="lk_lista">Agendamentos</a></li>
								<li><a href="../analiseCritica/" class="lk_lista"><?php echo(utf8_encode('Fazer an�lise cr�tica')); ?></a></li>
								<li><a href="../cronograma/" class="lk_lista"><?php echo(utf8_encode('Planejar cronograma')); ?></a></li>
								
							</ul>
						
						<!-- --------------------- -->
						
						<!-- OPÃƒÆ’Ã¢â‚¬Â¡ÃƒÆ’Ã¢â‚¬Â¢ES PARA CONSULTAS -->
							
							<ul class="listas" id="ini_lst3" type="square">
								
								<li><a href="../consulta/" class="lk_lista">Consultar agendamento</a></li>
								<li><a href="../alertas/" class="lk_lista">Alertas e avisos</a></li>
								<li><a href="../analiseCritica/consulta.php" class="lk_lista"><?php echo(utf8_encode('Hist�rico de equipamentos')); ?></a></li>
																
							</ul>
						
						<!-- --------------------- -->
						
					</div>
				
				<!-- ----------------- -->
			
				<!-- CADASTRO DE EMPRESAS -->
			
				<div id="cont2">
					
					<form id="form_cadEmpresas" name="frm_agendamentosCon" action="index.php" method="post">
					
					<span class="subtitulo2" id="ini_tit4"><?php echo(utf8_encode('Programa��o de calibra��o/verifica��o/manuten��o de equipamentos'));?></span>
					
					
					<!-- FILTRO DE AGENDAMENTOS -->
					
					
						<span id="cadEmpresa_tit1" class="texto">Filtrar:</span>
						
						
						<select class="cx_texto2" id="cmb_SolicitacaoV" name="cmb_filtro">
							
							<option value="0" <?php if ($_SESSION['FFILTRO'] == 0){ echo "selected"; } ?>><?php echo(utf8_encode('AGENDAMENTOS COM CONFIRMA��O PENDENTE')); ?></option>
																					
							<option value="1" <?php if ($_SESSION['FFILTRO'] == 1){ echo "selected"; } ?>><?php echo(utf8_encode('AGENDAMENTOS CONFIRMADOS E AGUARDANDO O RESULTADO')); ?></option>
							
							<option value="4" <?php if ($_SESSION['FFILTRO'] == 4){ echo "selected"; } ?>><?php echo(utf8_encode('AGENDAMENTOS CONFIRMADOS E COM RESULTADO AGUARDANDO APROVA��O DO GESTOR')); ?></option>
							
							<option value="2" <?php if ($_SESSION['FFILTRO'] == 2){ echo "selected"; } ?>>AGENDAMENTOS COM RESULTADO EMITIDO</option>
							
							<option value="3" <?php if ($_SESSION['FFILTRO'] == 3){ echo "selected"; } ?>>AGENDAMENTOS CANCELADOS</option>									
							
						</select>
						
						
						<span id="cadEmpresa_titep1" class="texto">Equipamento:</span>
						
						
						<select class="cx_texto2" id="cmb_SolicitacaoVEP" name="cmb_equipamento">
								
							<option value="0" <?php if ($_SESSION['FEQUIPAMENTO'] == 0){ echo "selected"; } ?>>TODOS</option>
							
							<?php
							
								$sql = "Select Codigo, Nome, Nequipamento from equipamentos where Status = 0 order by Nequipamento asc";
							
								$select = mysql_query($sql);
							
								while ($rf = mysql_fetch_array($select)) {
							
									$codEquip = $rf['Codigo'];
							?>
							
									<option value="<?php echo $rf['Codigo']; ?>" <?php if ($_SESSION['FEQUIPAMENTO'] == $codEquip){ echo "selected"; } ?> ><?php echo $rf['Nequipamento']." - ".$rf['Nome']; ?></option>
							
							<?php
							
								}
							
							?>
							
						</select>
										
												
					<!-- --------------------------------- -->			
					
						<div id ="divBotao">
						
							<input type="submit" class="subtitulo2" id="bt_cadastrou" name="btn_pesquisar" value="Pesquisar" />
							
							<input type="hidden" name="txt_cad" />
							
						</div>
											
					
					
					<!-- MAIS FILTROS DE PESQUISA -->
					
					
					<span id="cadEmpresa_titep3" class="texto">De:</span>
					
					<input type="text" id="cx_Contexto1" name="txt_dataDe" class="cx_data" onblur="bloqTxtAgend('nao');">
					
					<span id="cadEmpresa_titep4" class="texto">Até:</span>
					
					<input type="text" id="cx_Contexto2" name="txt_dataPara" class="cx_data" onblur="consultar('agenDatas', '1', <?php echo($tipCon); ?>);">
					
					<select id="cmb_tipoAgend" class="cx_texto2" name="cmb_tipoAgendamento" onchange="consultar('agenDatas', '1', <?php echo($tipCon); ?>);">
					
						<option value=""><?php echo utf8_encode('ESCOLHA UMA OP��O'); ?></option>
					
						<option value="CALIBRACAO"><?php echo utf8_encode('CALIBRA��ES'); ?></option>
						<option value="MANUTENCAO"><?php echo utf8_encode('MANUTEN��ES'); ?></option>
						<option value="VERIFICACAO"><?php echo utf8_encode('CHECAGENS INTERMEDI�RIAS'); ?></option>
					
					</select>
					
					<!-- ///////////////////// -->
					
					
					
					<!-- TABELA DE AGENDAMENTOS REALIZADOS 
					
					<span id="cadEmpresa_tit27" class="texto"></span>
					
					<span id="cadEmpresa_tit28" class="texto"></span>
					
					-->
					<?php 
					
						if($_SESSION['CONTROLBUSCA'] == "NOTAG"){
					?>	
					
							<span id="cadEmpresa_tit29Aux" class="texto">Item</span>
					
					<?php 
					
						}
						else {
					
					?>
							<span id="cadEmpresa_tit29" class="texto">Item</span>
						
					<?php 
					
						}
					
					?>
					
					<span id="cadEmpresa_tit30" class="texto">Serviço</span>
					
					<span id="cadEmpresa_tit31" class="texto">Previsto</span>
					
					<span id="cadEmpresa_tit32" class="texto">Executado</span>
					
					<div id="tabelaCadEquipamentos">
							
												
								<table class="texto">
								
								<?php 
																
									if (isset($sql1)) {
																		
										$select1 = mysql_query($sql1);
										
										while ($rf = mysql_fetch_array($select1)) {
								
											$dataPrev = $rf['DataPrev'];
											$dataExec = $rf['DataExec'];
											
											//CONVERS�O DE DATAS
											$dataPrev = dataBrasileira($dataPrev);
											$dataExec = dataBrasileira($dataExec);		
								?>
								
											<tr>
													
												<td id="linha1_tabelaCadEmpresas"><a <?php if(($_SESSION['CONTROLBUSCA'] != 2)&&($_SESSION['CONTROLBUSCA'] != 4)) { ?> href="exibirDetalhes.php?codAgend=<?php echo $rf['Codigo']; ?>" <?php } if($_SESSION['CONTROLBUSCA'] == 4){ ?> href="../resultado/index.php?codAgend=<?php echo $rf['Codigo']; ?>&confirma" <?php } if($_SESSION['CONTROLBUSCA'] == 2) { ?> href="../resultado/index.php?codAgend=<?php echo $rf['Codigo']; ?>&ver" <?php } ?>><?php echo $rf['CodAgendamento']; ?></a></td>	
												<td id="linha2_tabelaCadEmpresas"><?php echo $rf['ItemCalibr']; ?></td>
												<td id="linha3_tabelaCadEmpresas"><?php echo $rf['Serv']; ?></td>
												<td id="linha4_tabelaCadEmpresas"><?php echo $dataPrev; ?></td>
												<td id="linha5_tabelaCadEmpresas"><?php if($dataExec != '11/11/1111'){ echo $dataExec; }else{ echo utf8_encode("N�O"); } ?></td>
																	
											</tr>
								
								<?php 
										}
										
									}
								
								?>
															
								</table>
								
							
					</div>					
					
					<!-- ------------------------------------------ -->
					
					
					
				
					</form>
				
				</div>										

		</div>


	</body>


</html>