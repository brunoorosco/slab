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
	
	
	//CONFIRMA��O DOS RESULTADOS
	if (isset($_POST['btn_atualizaResult'])) {
		
		$codAgend = $_SESSION['SCODAGEND'];
		$obsTec = ($_POST['txt_obs']);
		$dataExec = ($_POST['txt_dataExec']);
		$numCert = ($_POST['txt_numCert']);
		$contador = $_SESSION['CONTADOR_RESULT'];
		
		$dataExec = dataAmericana($dataExec);
		
		//REALIZANDO O CADASTRO DO N�MERO DO CERTIFICADO E DATA DA REALIZA��O
		$sql = "Update regcertificado set ArquivoCert = '', NumCertificado = '$numCert', DataExec = '$dataExec', Obs = '$obsTec' where CodAgendamento = $codAgend";
		
		mysql_query($sql);
		
		//EXTRAINDO OS RESULTADOS
		for($i=0; $i<$contador; $i++) {
				
			$valorResult = ($_POST['txt_resultado'.$i]);
			$erro = ($_POST['txt_erro'.$i]);
			$incerteza = ($_POST['txt_incerteza'.$i]);
			$aprovacao = ($_POST['rdb_apro'.$i]);
			$codResult = ($_POST['txt_codigoResult'.$i]);

			$sql1 = "Update resultado set Valor = $valorResult, Erro = $erro, Incerteza = $incerteza, Aprovado = '$aprovacao' where Codigo = $codResult";
			mysql_query($sql1);
				
		}
		//-----------------------
		
		
		//MUDANDO O STATUS DO RESULTADO PARA RESULTADOS AGUARDANDO CONFIRMA��O DO GESTOR
		
		$sql4 = "Update agendcalibrmanut set Status = 2 where Codigo = $codAgend";
		$sql6 = "Update agendcalibrmanut set DataExec = '$dataExec' where Codigo = $codAgend";
		
		mysql_query($sql4);
		mysql_query($sql6);
		
		header("location:../consulta/index.php");
			
		//------------------------------------------------------------------------------
		
	}
	
	
	//INSER��O DOS RESULTADOS
	if (isset($_POST['btn_finalizarResult'])) {
		
		$codAgend = $_SESSION['SCODAGEND'];
		$obsTec = ($_POST['txt_obs']);
		$dataExec = ($_POST['txt_dataExec']);
		$numCert = ($_POST['txt_numCert']);
		$contador = $_SESSION['CONTADOR_RESULT'];
		
		$dataExec = dataAmericana($dataExec);
		
		//REALIZANDO O CADASTRO DO N�MERO DO CERTIFICADO E DATA DA REALIZA��O
		$sql = "Insert into regcertificado (ArquivoCert, NumCertificado, DataExec, CodAgendamento, Obs, Status)values('', '$numCert', '$dataExec', '$codAgend', '', 0)";
		
		
		mysql_query($sql);
		
		$sqlC = "Select Codigo from regcertificado where CodAgendamento = '$codAgend'";
		
		$selecC = mysql_query($sqlC);
		
		if ($rf3 = mysql_fetch_array($selecC)) {
			
			$codRegCertificado = $rf3['Codigo'];
		}
		
		
		//EXTRAINDO OS RESULTADOS
		for($i=0; $i<$contador; $i++) {
			
			$valorResult = ($_POST['txt_resultado'.$i]);
			$erro = ($_POST['txt_erro'.$i]);
			$incerteza = ($_POST['txt_incerteza'.$i]);
			$intolerancia = ($_POST['txt_intolerancia'.$i]);
			$aprovacao = ($_POST['rdb_apro'.$i]);
			$codPtCalibracao = ($_POST['txt_ptCalibracao'.$i]);
			
			$sql1 = "Insert into resultado (CodPtCalibracao, CodRegCertificado, Valor, Erro, Incerteza, Aprovado, Status)values($codPtCalibracao, $codRegCertificado, $valorResult, $erro, $incerteza, '$aprovacao', 0)";
			mysql_query($sql1);
	
			
		}	
		//-----------------------
		
		
		//MUDANDO O STATUS DO RESULTADO PARA RESULTADOS AGUARDANDO CONFIRMA��O DO GESTOR
		$sql4 = "Update agendcalibrmanut set Status = 4 where Codigo = $codAgend";
		$sql5 = "Update regcertificado set Obs = '$obsTec' where Codigo = $codRegCertificado";
		$sql6 = "Update agendcalibrmanut set DataExec = '$dataExec' where Codigo = '$codAgend'";
		
		mysql_query($sql4);
		mysql_query($sql5);
		mysql_query($sql6);
		
		header("location:../consulta/index.php");
			
		//------------------------------------------------------------------------------
		
	}
	
	//CANCELAR UM AGENDAMENTO
	if (isset($_POST['btn_cancelar'])) {
		
		$codAgend = $_SESSION['SCODAGEND'];
		
		$sql = "Update agendcalibrmanut set Status = 3 where Codigo = $codAgend";
		
		mysql_query($sql);
?>

			<script type="text/javascript">

				alert('AGENDAMENTO CANCELADO!');

			</script>


<?php

		header("location:index.php");

	}

	//VOLTAR A CONSULTA
	if (isset($_POST['btn_voltConsulta'])) {
		
		header("location:../consulta/index.php");		
	}
		
	//EXTRAINDO OS DADOS RECEBIDOS
	if (isset($_GET['codAgend'])) {
		
		$codAgend = ($_GET['codAgend']);
		
		$_SESSION['SCODAGEND'] = $codAgend;
				
		//VERIFICANDO OS RESPONS�VEIS QUE EXECUTARAM O SERVI�O
		$sql1 = "Select CodEmpresa, CodTecnico from agendcalibrmanut where Codigo=$codAgend";

		$select1 = mysql_query($sql1);

		if ($rf1 = mysql_fetch_array($select1)) {

			$codTecnico = $rf1['CodTecnico'];
			$codEmpresa = $rf1['CodEmpresa'];

		}

		//----------------------------------------------------
		
		
		//EXTRAINDO DEMAIS INFORMA��ES A RESPEITO DO AGENDAMENTO REALIZADO
		
		if (($codEmpresa != 0)&&($codTecnico != 0)) {
				
			$sql = "Select agendcalibrmanut.CodAgendamento, servicos.Nome as 'Servico', itemcalibracao.Nome as 'NomeItem', funcionarios.Nome as 'NomeTecnico', certificadores.Nome as 'NomeEmpresa', agendcalibrmanut.DataPrev, agendcalibrmanut.Status, agendcalibrmanut.TipoAgend, equipamentos.Nome, equipamentos.Codigo from certificadores, servicos, funcionarios, equipamentos, agendcalibrmanut, compcalibrserv, itemcalibracao where compcalibrserv.CodServico = servicos.Codigo and agendcalibrmanut.CodTecnico = funcionarios.Codigo and agendcalibrmanut.CodEmpresa = certificadores.Codigo and itemcalibracao.Codigo = compcalibrserv.CodItemCalibracao and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and agendcalibrmanut.Codigo = $codAgend";
				
		}
			
		if (($codEmpresa != 0)&&($codTecnico == 0)) {
			
			$sql = "Select agendcalibrmanut.CodAgendamento, servicos.Nome as 'Servico', itemcalibracao.Nome as 'NomeItem', certificadores.Nome as 'NomeEmpresa', agendcalibrmanut.DataPrev, agendcalibrmanut.Status, agendcalibrmanut.TipoAgend, equipamentos.Nome, equipamentos.Codigo from certificadores, servicos, equipamentos, agendcalibrmanut, compcalibrserv, itemcalibracao where compcalibrserv.CodServico = servicos.Codigo and agendcalibrmanut.CodEmpresa = certificadores.Codigo and itemcalibracao.Codigo = compcalibrserv.CodItemCalibracao and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and agendcalibrmanut.Codigo = $codAgend";
			
		}
			
		if (($codEmpresa == 0)&&($codTecnico != 0)) {
			
			$sql = "Select agendcalibrmanut.CodAgendamento, servicos.Nome as 'Servico', itemcalibracao.Nome as 'NomeItem', funcionarios.Nome as 'NomeTecnico', agendcalibrmanut.DataPrev, agendcalibrmanut.Status, agendcalibrmanut.TipoAgend, equipamentos.Nome, equipamentos.Codigo from servicos, funcionarios, equipamentos, agendcalibrmanut, compcalibrserv, itemcalibracao where compcalibrserv.CodServico = servicos.Codigo and agendcalibrmanut.CodTecnico = funcionarios.Codigo and itemcalibracao.Codigo = compcalibrserv.CodItemCalibracao and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and agendcalibrmanut.Codigo = $codAgend";
			
		}
		
		//----------------------------------------------------------------
		
		$select = mysql_query($sql);
		
		if ($rf = mysql_fetch_array($select)) {
			
			
			$codAgendamento = $rf['CodAgendamento'];
			
			
			if (($codEmpresa != 0)&&($codTecnico != 0)) {
			
				$nomeEmpresa = $rf['NomeEmpresa'];
				$nomeTecnico = $rf['NomeTecnico'];
								
			}
			
			if (($codEmpresa != 0)&&($codTecnico == 0)) {
			
				$nomeEmpresa = $rf['NomeEmpresa'];
				$nomeTecnico = "NENHUM";
				
			}
			
			if (($codEmpresa == 0)&&($codTecnico != 0)) {
			
				$nomeEmpresa = "NENHUM";
				$nomeTecnico = $rf['NomeTecnico'];
				
			}	
						
			$nomeServico = $rf['Servico'];
			$nomeItemEquip = $rf['NomeItem'];
			$nomeEquip = $rf['Nome'];
			$dataPrev = $rf['DataPrev'];
			$statusAgend = $rf['Status'];
			$tipoAgend = $rf['TipoAgend'];
			$codEquipamento = $rf['Codigo'];
			
			//CONVERS�O DE DATA
			$dataPrev = dataBrasileira($dataPrev);
			
			//QUEBRANDO A DATA EM DIA/M�S/ANO
			$dia = substr($dataPrev,0,2);
			$mes = substr($dataPrev,3,2);
			$ano = substr($dataPrev,6,4);
					
			
			//DEFININDO O STATUS DO AGENDAMENTO
			if ($statusAgend == 0) {
			
				$statusAgend = "AGENDAMENTO AGUARDANDO CONFIRMA��O";
			}
			
			if ($statusAgend == 1) {
			
				$statusAgend = "AGENDAMENTO AGUARDANDO EXECU��O";
			}
			
			if ($statusAgend == 2) {
			
				$statusAgend = "AGENDAMENTO EXECUTADO";
			}
			
			if ($statusAgend == 3) {
			
				$statusAgend = "AGENDAMENTO CANCELADO";
			}
			//--------------------------------
			
			
			//VERIFICANDO A CONFIRMA��O DE UM RESULTADO
			if ((isset($_GET['confirma']))||(isset($_GET['ver']))) {
								
				$sql4 = "Select DataExec, NumCertificado, Obs from regcertificado where CodAgendamento = $codAgend";
								
				$select4 = mysql_query($sql4);
								
				if($rf4 = mysql_fetch_array($select4)) {
					
					$obs = $rf4['Obs'];
					$numCert = $rf4['NumCertificado'];
					$dataExec = $rf4['DataExec'];
					
					$dataExec = dataBrasileira($dataExec);
					
				}
				
			}
			
		}
	
	}	
	//-------------------------------------------------------------	
	
		
	//AO CLICAR NO BOTÃƒO PARA PESQUISAR OS AGEDAMENTOS
	
	if(isset($_POST['btn_atualizar'])) {
		
		//RECEBEBENDO OS DADOS
		$ano = ($_POST['cmb_ano']);
		$mes = ($_POST['cmb_mes']);
		$dia = ($_POST['cmb_dia']);
		$codEmpresa = ($_POST['cmb_codEmpresa']);
		$codTec = ($_POST['cmb_codTec']);
		$codServico = ($_POST['cmb_servico']);
		$itemEquip = ($_POST['cmb_itemEquip']);
		$tipoAgend = ($_POST['cmb_tipoAgend']);
		
		$dataPrev = $ano."-".$mes."-".$dia;
		
		$codAgendamento = $_SESSION['SCODAGEND'];
		
		//VERIFICANDO O C�DIGO
		$sql = "Select Codigo from compcalibrserv where CodServico = $codServico and CodItemCalibracao = $itemEquip";
		
		$select = mysql_query($sql);
		
		if ($rf = mysql_fetch_array($select)) {
			
			$codCalibrServ = $rf['Codigo'];
			
		}
		
		
		$sql = "Update agendcalibrmanut set CodCompCalibrServ = $codCalibrServ , DataPrev = '$dataPrev' , CodEmpresa = $codEmpresa , CodTecnico = $codTec , TipoAgend = '$tipoAgend', Status = 1 where Codigo = $codAgendamento";
		
		mysql_query($sql);

?>

		<script type="text/javascript">

			alert('INFORMA��ES DO AGENDAMENTO CONFIRMADAS');

		</script>

<?php

		header("location:index.php");
		
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
			<link rel="stylesheet" type="text/css" href="../../styles/cadEquipamentosResult.css">
			
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
				
				<form name="frm_detalhesAgendamento" action="index.php" method="POST">
				
					<form id="form_cadEmpresas" name="frm_agendamentosCon" action="index.php" method="post">
					
					<span class="subtitulo2" id="ini_tit4"><?php echo(utf8_encode('Resultados dos pontos de calibra��o/verifica��o/manuten��o')); ?></span>
										
					<span id="cadEmpresa_tit16" class="texto"><?php echo(utf8_encode('C�digo do agendamento:')); ?></span>
					
					<span id="cadEmpresa_tit16Cpl" class="texto"><?php echo(utf8_encode($codAgendamento)); ?></span>
										
					<span id="cadEmpresa_tit16cplEsq" class="texto">Tipo do agendamento:</span>
					
					<span id="cadEmpresa_tit17cplEsq" class="texto"><?php if (($tipoAgend == "VERIFICACAO")||$tipoAgend == "VERIFICA��O") { echo(utf8_encode('CHECAGEM INTERMEDI�RIA')); }else{ echo(utf8_encode($tipoAgend)); }; ?></span>
										
					<span id="cadEmpresa_tit17" class="texto"><?php echo(utf8_encode('Nome do equipamento:')); ?></span>
					
					<span id="cadEmpresa_tit17Cpl" class="texto"><?php echo $nomeEquip; ?></span>
					
					<span id="cadEmpresa_tit18" class="texto"><?php echo(utf8_encode('Item do equipamento:')); ?></span>
					
					<span id="cadEmpresa_tit18Cpl" class="texto"><?php echo $nomeItemEquip; ?></span>
					
					<span id="cadEmpresa_tit19" class="texto"><?php echo(utf8_encode('Servi�o para ser executado:')); ?></span>
					
					<span id="cadEmpresa_tit19Cpl" class="texto"><?php echo $nomeServico; ?></span>
					
					<span id="cadEmpresa_tit20" class="texto"><?php echo(utf8_encode('T�cnico respons�vel:')); ?></span>					
					
					<span id="cadEmpresa_tit20Cpl" class="texto"><?php echo $nomeTecnico; ?></span>						
					
					<span id="cadEmpresa_tit21" class="texto"><?php echo(utf8_encode('Empresa respons�vel:')); ?></span>
					
					<span id="cadEmpresa_tit21Cpl" class="texto"><?php echo $nomeEmpresa; ?></span>					
					
					<span id="cadEmpresa_tit22" class="texto"><?php echo(utf8_encode('Data Prevista para execu��o:')); ?></span>				
					
					<span id="cadEmpresa_tit22Cpl" class="texto"><?php echo(utf8_encode($dataPrev)); ?></span>					
														
					<span id="cadEmpresa_tit23" class="texto"><?php echo(utf8_encode('Data da realiza��o:')); ?></span>
					
					<input type="text" name="txt_dataExec" <?php if(isset($_GET['ver'])){ echo "disabled='disabled'"; } ?> value="<?php if(isset($dataExec)){ echo $dataExec; } ?>" class="cx_data" id="cadEmpresa_tit23Cpl">
					
					<span id="cadEmpresa_tit24" class="texto"><?php echo(utf8_encode('N�mero do certificado:')); ?></span>
					
					<input type="text" name="txt_numCert" <?php if(isset($_GET['ver'])){ echo "disabled='disabled'"; } ?> value="<?php if(isset($numCert)){ echo $numCert; } ?>" class="cx_texto1" id="cadEmpresa_tit27Cpl">
															
					<input type="submit" class="subtitulo1" <?php if(!isset($_GET['ver'])){ ?> id="bt_volt" <?php }else{ ?> id="bt_volt1"  <?php } ?> name="btn_voltConsulta" value="Voltar a consulta" />
					
					<?php 
					
						if(!isset($_GET['ver'])){
					
					?>
						
							<input type="submit" onclick="" class="subtitulo2" id="bt_cadastrou" <?php if (isset($_GET['confirma'])) { ?> name="btn_atualizaResult" value="Confirmar" <?php }else{ ?> name="btn_finalizarResult" value="Finalizar" <?php } ?> />
					
					<?php 
					
						}		
					
					?>
										
					<!-- TABELA COM OS RESULTADOS -->
								
									
						<div id="tabelaResultado">
							
							<?php 
														
								$sql2 = "Select grandezas.Nome as 'Grandeza', unidades.Nome as 'Unidade', pontocalibracao.Valor, pontocalibracao.Codigo, pontocalibracao.Tolerancia from unidades, grandezas, pontocalibracao, compcalibrserv, agendcalibrmanut where pontocalibracao.CodCompCalibrServ = compcalibrserv.Codigo and agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and pontocalibracao.CodGrandeza = grandezas.Codigo and unidades.Codigo = pontocalibracao.CodUnidade and agendcalibrmanut.Codigo = $codAgend and pontocalibracao.Status = 0"; 
							
								$select2 = mysql_query($sql2);
								
								$contador = 0;
								
								
								//VERIFICANDO SE OS RESULTADOS SER�O CONFIMADOS/VISUALIZADOS OU INSERIDOS PELA PRIMEIRA VEZ
								if ((isset($_GET['confirma']))||(isset($_GET['ver']))) {
									
									
									while ($rf2 = mysql_fetch_array($select2)) {
										
										$codPtCalibr = $rf2['Codigo'];
										
										//BUSCANDO O PONTO DE CALIBRA��O
										$sql3 = "Select * from resultado where CodPtCalibracao = $codPtCalibr";
										
										$select3 = mysql_query($sql3);
																		
										if ($rf3 = mysql_fetch_array($select3)) {
											
											$codResult = $rf3['Codigo'];
										
							?>
							
											<table id="tabelaResultcnf">
											
												<tr>
													<th class="linha1_result">Grandeza</th>
													<th class="linha1_result">Resultado</th>
													<th class="linha1_result">Unidade</th>
													<th class="linha1_result">Erro</th>
													<th class="linha1_result">Incerteza</th>
													<th class="linha1_result"><?php echo(utf8_encode('Toler�ncia')); ?></th>																
													<th class="linha1_result linha1_resultAlinh">&nbsp;&nbsp;&nbsp;Aprovado?</th>
												</tr>
												
												<tr>
												
													<td class="linha1_result linha1_resultCor"><?php echo $rf2['Grandeza']; ?></td>
													<td class="linha1_result linha1_resultCor"><?php echo $rf2['Valor']; ?></td>
													<td class="linha1_result linha1_resultCor"><?php echo $rf2['Unidade']; ?></td>
													<td class="linha1_result linha1_resultCor"><input type="hidden" name="txt_ptCalibracao<?php echo($contador); ?>" value="<?php echo($rf2['Codigo']); ?>"></td>
													<td class="linha1_result linha1_resultCor"><input type="hidden" name="txt_codigoResult<?php echo($contador); ?>" value="<?php echo $codResult; ?>"></td>
													<td class="linha1_result linha1_resultCor"><?php echo $rf2['Tolerancia']; ?></td>
													<td class="linha1_result linha1_resultAlinh"><input type="radio" <?php if(isset($_GET['ver'])){ echo "disabled='disabled'"; } ?> value="SIM" <?php if($rf3['Aprovado'] == 'SIM'){ echo "checked='checked'"; } ?> name="rdb_apro<?php echo($contador); ?>">SIM</td>
												
												</tr>
												
												<tr>
												
													<td class="linha1_result"></td>
													<td class="linha1_result"><input type="text" <?php if(isset($_GET['ver'])){ echo "disabled='disabled'"; } ?> name="txt_resultado<?php echo($contador); ?>" value="<?php echo $rf3['Valor']; ?>" class="cx_numerosEsp cx_texto2 cx_tabelaResult" id=""></td>
													<td class="linha1_result"></td>
													<td class="linha1_result"><input type="text" <?php if(isset($_GET['ver'])){ echo "disabled='disabled'"; } ?> name="txt_erro<?php echo($contador); ?>" value="<?php echo $rf3['Erro'] ?>" class="cx_numerosEsp cx_texto2 cx_tabelaResult" id=""></td>
													<td class="linha1_result"><input type="text" <?php if(isset($_GET['ver'])){ echo "disabled='disabled'"; } ?> name="txt_incerteza<?php echo($contador); ?>" value="<?php echo $rf3['Incerteza'] ?>" class="cx_numerosEsp cx_texto2 cx_tabelaResult" id=""></td>
													<td class="linha1_result"></td>
													<td class="linha1_result linha1_resultAlinh"><input type="radio" <?php if(isset($_GET['ver'])){ echo "disabled='disabled'"; } ?> <?php if($rf3['Aprovado'] == 'NAO'){ echo "checked='checked'"; } ?> value="NAO" name="rdb_apro<?php echo($contador); ?>"><?php echo(utf8_encode('N�O')); ?></td>
												
												</tr>
											
											</table>
							
							<?php 	
							
										}
										
										$contador++;
										
									}
									
									$_SESSION['CONTADOR_RESULT'] = $contador;
									
								}
								else {
									
									while ($rf2 = mysql_fetch_array($select2)) {
								
							?>					
												
										<table id="tabelaResultcnf">
										
											<tr>
												<th class="linha1_result">Grandeza</th>
												<th class="linha1_result">Resultado</th>
												<th class="linha1_result">Unidade</th>
												<th class="linha1_result">Erro</th>
												<th class="linha1_result">Incerteza</th>
												<th class="linha1_result"><?php echo(utf8_encode('Toler�ncia')); ?></th>																
												<th class="linha1_result linha1_resultAlinh">&nbsp;&nbsp;&nbsp;Aprovado?</th>
											</tr>
											
											<tr>
											
												<td class="linha1_result linha1_resultCor"><?php echo $rf2['Grandeza']; ?></td>
												<td class="linha1_result linha1_resultCor"><?php echo $rf2['Valor']; ?></td>
												<td class="linha1_result linha1_resultCor"><?php echo $rf2['Unidade']; ?></td>
												<td class="linha1_result linha1_resultCor"><input type="hidden" name="txt_ptCalibracao<?php echo($contador); ?>" value="<?php echo($rf2['Codigo']); ?>"></td>
												<td class="linha1_result linha1_resultCor"><input type="hidden" name="txt_codigoResult<?php echo($contador); ?>" value="<?php echo($contador); ?>"></td>
												<td class="linha1_result linha1_resultCor"><?php echo $rf2['Tolerancia']; ?></td>
												<td class="linha1_result linha1_resultAlinh"><input type="radio" value="SIM" name="rdb_apro<?php echo($contador); ?>">SIM</td>
											
											</tr>
											
											<tr>
											
												<td class="linha1_result"></td>
												<td class="linha1_result"><input type="text" name="txt_resultado<?php echo($contador); ?>" class="cx_numerosEsp cx_texto2 cx_tabelaResult" id=""></td>
												<td class="linha1_result"></td>
												<td class="linha1_result"><input type="text" name="txt_erro<?php echo($contador); ?>" class=" cx_numerosEsp cx_texto2 cx_tabelaResult" id=""></td>
												<td class="linha1_result"><input type="text" name="txt_incerteza<?php echo($contador); ?>" class="cx_numerosEsp cx_texto2 cx_tabelaResult" id=""></td>
												<td class="linha1_result"></td>
												<td class="linha1_result linha1_resultAlinh"><input type="radio" value="NAO" name="rdb_apro<?php echo($contador); ?>"><?php echo(utf8_encode('N�O')); ?></td>
											
											</tr>
										
										</table>

							<?php

										$contador++;
							
									}
								
									$_SESSION['CONTADOR_RESULT'] = $contador;
									
								}

							?>
																									
						</div>
						
						<span id="cadEmpresa_tit25" class="texto"><?php echo(utf8_encode('Observa��es:')); ?></span>
						
						<textarea rows="5" cols="10" class="cx_texto2" name="txt_obs" <?php if(isset($_GET['ver'])){ echo "disabled='disabled'"; } ?> id="cx_obsResult"><?php if(isset($obs)){ echo $obs; } ?></textarea>
								
						
					<!-- /////////////////////// -->
				
				</form>
				
				</div>										

		</div>


	</body>


</html>