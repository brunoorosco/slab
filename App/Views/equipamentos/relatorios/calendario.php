<?php


	//ARQUIVO DE CONEXÃƒÆ’Ã†â€™O COM O BANCO DE DADOS
	include("../../php/conexao.php");
	
	include("../php/funcoes.php");

	
	//CHECAR SE FOI REALIZADA A CONEXÃƒÆ’Ã†â€™O DO USUÃƒÆ’Ã¯Â¿Â½RIO
	conexaoUsuario();
	
	//RECEBENDO DADOS PARA GERAR O CALEND�RIO
	if (isset($_GET['filtro'])) {
	
		$tipoFiltro = ($_GET['filtro']); //0 - CRONOGRAMA PLANEJADO ; 1 - CRONOGRAMA PLANEJADO E REALIZADO
		$ano = ($_GET['ano']);
		$setor = ($_GET['setor']);
		
		if ($setor == '0') {
	
			$Nomesetor = "TODOS OS SETORES";
	
		}
		else {
	
			if($setor != "LAVANDERIA") {
	
				$Nomesetor = "LABORAT�RIO DE ".$setor;
	
			}
	
		}		
		
		//-----------------------
	
		//ARRAY PARA FORMAR OS DADOS DA TABELA
		$dados = array(
				
				$codEquip,
				$nomeEquip,
				$nequipamento,
				$patrimonio,
				$nomeItem,
				$nomeServico
				
		);
		
		
		//VERIFICANDO O SETOR QUE FOI SELECIONADO
		if ($setor != '0') {
			
			$sql1 = "Select equipamentos.Nome, equipamentos.Nequipamento, equipamentos.Patrimonio, equipamentos.Codigo from equipamentos where equipamentos.Status = 0 and equipamentos.Local = '$setor' order by equipamentos.Nequipamento asc";
		
		}
		else {
			
			$sql1 = "Select equipamentos.Nome, equipamentos.Nequipamento, equipamentos.Patrimonio, equipamentos.Codigo from equipamentos where equipamentos.Status = 0 order by equipamentos.Nequipamento asc";
		}
				
		$select1 = mysql_query($sql1);
		
		$contador1 = 0;
		
		while ($rf1 = mysql_fetch_array($select1)) {
				
				$codEquip = $rf1['Codigo'];
				
				$sql2 = "Select itemcalibracao.Codigo, itemcalibracao.Nome as 'NomeItem' from itemcalibracao where CodEquip = $codEquip and Status = 0";
					
				$select2 = mysql_query($sql2);
		 		
				//CASO EXISTA REGISTROS
				if (mysql_num_rows($select2) != 0) {
										
					while ($rf2 = mysql_fetch_array($select2)) {
												
						$codItemCalibr = $rf2['Codigo'];
												
						$sql3 = "Select compcalibrserv.Codigo, servicos.Nome as 'NomeServico' from compcalibrserv, servicos where servicos.Codigo = compcalibrserv.CodServico and compcalibrserv.CodItemCalibracao = $codItemCalibr and servicos.Status = 0";
						
						$select3 = mysql_query($sql3);
						
						//CASO EXISTA REGISTROS
						if (mysql_num_rows($select3) != 0) {
							
							
							while ($rf3 = mysql_fetch_array($select3)) {

								$dados[$contador1][0] = $rf3['Codigo'];
								$dados[$contador1][1] = $rf1['Nome'];
								$dados[$contador1][2] = $rf1['Nequipamento'];
								$dados[$contador1][3] = $rf1['Patrimonio'];
								$dados[$contador1][4] = $rf2['NomeItem'];
								$dados[$contador1][5] = $rf3['NomeServico'];
								
								$contador1++;

							}

							
						}
						else {
							
							$dados[$contador1][0] = '';
							$dados[$contador1][1] = $rf1['Nome'];
							$dados[$contador1][2] = $rf1['Nequipamento'];
							$dados[$contador1][3] = $rf1['Patrimonio'];
							$dados[$contador1][4] = $rf2['NomeItem'];
							$dados[$contador1][5] = '';
			
							$contador1++;							
						}
						
						
					}
					
					
				}
				else {
										
					$dados[$contador1][0] = '';
					$dados[$contador1][1] = $rf1['Nome'];
					$dados[$contador1][2] = $rf1['Nequipamento'];
					$dados[$contador1][3] = $rf1['Patrimonio'];
					$dados[$contador1][4] = '';
					$dados[$contador1][5] = '';
					
					$contador1++;
					
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
			<link rel="stylesheet" type="text/css" href="../../styles/cadEquipamentosCalendar.css">
			
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

		
		<div id="cont2">
		
			<div id="calendario">
			
			
				<div id="cabecalho">
				
				
					<!-- CABE�ALHO DO RELAT�RIO -->
					
						<div id="logotipo"></div>
					
						<div id="apresentacao">
						
							<span id="tituloCalendar"><?php echo(utf8_encode('CRONOGRAMA DE CALIBRA��ES/MANUTEN��ES/CHECAGENS INTERMEDI�RIAS - '.$Nomesetor.' - '.$ano)); ?></span>
						
						</div>
					
					<!-- ////////////////////// -->
					
					
					<!-- LEGENDAS DO RELAT�RIO -->
					
						<div id="planejado"></div>
					
						<div id="realizado"></div>
						
						<span id="titulo_planejado">PLANEJADO</span>
						
						<span id="titulo_realizado">REALIZADO</span>
						
						<span id="legenda1_calendar"><?php echo(utf8_encode('C : CALIBRA��O')); ?></span>
						
						<span id="legenda2_calendar"><?php echo(utf8_encode('C : MANUTEN��O')); ?></span>
					
						<span id="legenda3_calendar"><?php echo(utf8_encode('CI : CHECAGEM INTERMEDI�RIA')); ?></span>
					
					<!-- //////////////////// -->
				
					
					<!-- NOMENCLATURA DAS COLUNAS -->
					
						<table id="tabelaNomenc1" cellspacing="0">
						
						
						
								<tr>
								
									<td id="linha1_tabelaNomenc1"><?php echo(utf8_encode('N� LAB')); ?></td>
									<td id="linha2_tabelaNomenc1"><?php echo(utf8_encode('NI')); ?></td>
									<td id="linha3_tabelaNomenc1"><?php echo(utf8_encode('Equipamento')); ?></td>
									<td id="linha4_tabelaNomenc1">Status</td>							
								
								</tr>
												
						
												
						</table>
						
						<table id="tabelaNomenc2" cellspacing="0">
						
							<tr>
							
								<td class="linha1_tabelaNomenc2">Janeiro</td>
								<td class="linha1_tabelaNomenc2">Fevereiro</td>
								<td class="linha1_tabelaNomenc2"><?php echo(utf8_encode('Mar�o')); ?></td>
								<td class="linha1_tabelaNomenc2">Abril</td>
								<td class="linha1_tabelaNomenc2">Maio</td>
								<td class="linha1_tabelaNomenc2">Junho</td>
								<td class="linha1_tabelaNomenc2">Julho</td>
								<td class="linha1_tabelaNomenc2">Agosto</td>
								<td class="linha1_tabelaNomenc2">Setembro</td>
								<td class="linha1_tabelaNomenc2">Outubro</td>
								<td class="linha1_tabelaNomenc2">Novembro</td>
								<td class="linha1_tabelaNomenc2F">Dezembro</td>				
							
							</tr>
						
						</table>
						
						<table id="tabelaNomenc3" cellspacing="0">
						
							<tr>
							
								<td class="linha3_tabelaNomenc2">C</td>
								<td class="linha3_tabelaNomenc2">M</td>
								<td class="linha3_tabelaNomenc2">CI</td>
								
								<td class="linha3_tabelaNomenc2">C</td>
								<td class="linha3_tabelaNomenc2">M</td>
								<td class="linha4_tabelaNomenc2">CI</td>
								
								<td class="linha3_tabelaNomenc2">C</td>
								<td class="linha3_tabelaNomenc2">M</td>
								<td class="linha5_tabelaNomenc2">CI</td>
								
								<td class="linha3_tabelaNomenc2">C</td>
								<td class="linha3_tabelaNomenc2">M</td>
								<td class="linha3_tabelaNomenc2">CI</td>
								
								<td class="linha3_tabelaNomenc2">C</td>
								<td class="linha3_tabelaNomenc2">M</td>
								<td class="linha6_tabelaNomenc2">CI</td>
								
								<td class="linha3_tabelaNomenc2">C</td>
								<td class="linha3_tabelaNomenc2">M</td>
								<td class="linha8_tabelaNomenc2">CI</td>
								
								<td class="linha3_tabelaNomenc2">C</td>
								<td class="linha3_tabelaNomenc2">M</td>
								<td class="linha8_tabelaNomenc2">CI</td>
								
								<td class="linha3_tabelaNomenc2">C</td>
								<td class="linha3_tabelaNomenc2">M</td>
								<td class="linha7_tabelaNomenc2">CI</td>
								
								<td class="linha3_tabelaNomenc2">C</td>
								<td class="linha3_tabelaNomenc2">M</td>
								<td class="linha4_tabelaNomenc2">CI</td>
								
								<td class="linha3_tabelaNomenc2">C</td>
								<td class="linha3_tabelaNomenc2">M</td>
								<td class="linha4_tabelaNomenc2">CI</td>
								
								<td class="linha3_tabelaNomenc2">C</td>
								<td class="linha3_tabelaNomenc2">M</td>
								<td class="linha9_tabelaNomenc2">CI</td>
								
								<td class="linha3_tabelaNomenc2">C</td>
								<td class="linha3_tabelaNomenc2">M</td>
								<td class="linha4_tabelaNomencF">CI</td>								
								
							</tr>
						
						</table>
					
					<!-- /////////////////////// -->
				
					
					<!-- ESTRUTURA DE DADOS DO RELAT�RIO -->
					
					
						<?php 
						
							//PESQUISANDO OS EQUIPAMENTOS
							
							
							
							
							
						?>
					
					
					
						<table id="tabelaNomenc4" cellspacing="0">
						
						<?php 
						
							$quantidade = count($dados);
						
							for($i=0; $i<$quantidade; $i++) {
						
								
						?>
						
									<tr>
										
										<td class="cor1_t" id="linha1_tabelaNomencRef"><?php echo(utf8_encode($dados[$i][2])); ?></td>
										<td id="linha2_tabelaNomencRef"><?php echo(utf8_encode($dados[$i][3])); ?></td>
										
										<td id="linha3_tabelaNomencRef">
										<?php 
										
											//CASO TENHA SERVI�O
											if ($dados[$i][5] != '') {
												
												echo($dados[$i][1]." / ".$dados[$i][4]." / ".$dados[$i][5]);
												
											}
											else {
											
												if ($dados[$i][4] != '') {
												
													echo($dados[$i][1]." / ".$dados[$i][4]);
												
												}
												else {
														
													echo($dados[$i][1]);
												
												}
												
												
											}
											
										
										?>
										</td>							
										
									</tr>
						
						<?php 
						
							}
						
						?>
																		
						</table>
						
						
						<!-- DATAS PREVISTAS -->
						
						<table id="tabelaNomenc5" cellspacing="0">
						
						<?php 
						
							$quantidade = count($dados);
							
							for($i=0; $i<$quantidade; $i++) {
						
								$codCompCalibr = $dados[$i][0];								
								
								if ($codCompCalibr == '') {
									
									$codCompCalibr = 0;
									
								}
																
								$dataInicial = $ano."-01-01";
								$dataFinal = $ano."-12-31";
								
								//SELECIONANDO APENAS OS PREVISTOS
								if ($tipoFiltro == 0) {
								
									$sql4 = "Select agendcalibrmanut.DataPrev, agendcalibrmanut.TipoAgend from agendcalibrmanut where (agendcalibrmanut.Status <> 3 and agendcalibrmanut.Status <> 2) and agendcalibrmanut.CodCompCalibrServ = $codCompCalibr and agendcalibrmanut.DataPrev BETWEEN ('$dataInicial') AND ('$dataFinal')";
								
								}
								else { //SELECIONANDO OS EXECUTADOS
									
									$sql4 = "Select agendcalibrmanut.DataPrev, agendcalibrmanut.DataExec, agendcalibrmanut.TipoAgend from agendcalibrmanut where agendcalibrmanut.Status = 2 and agendcalibrmanut.CodCompCalibrServ = $codCompCalibr and agendcalibrmanut.DataPrev BETWEEN ('$dataInicial') AND ('$dataFinal')";
									$vl = "sim";
									
								}
								
								
								$select4 = mysql_query($sql4);
								
								
								if ($ex = mysql_fetch_array($select4)) {
											
									
									if (isset($vl)) {
										
										$dataPrev = $ex['DataPrev'];
										$dataExec = $ex['DataExec'];
										$tipoAgend = $ex['TipoAgend'];
										
										//CORTANDO STRING DA DATA PREVISTA
										$diaExec = substr($dataExec,8,2);
										$mesExec = substr($dataExec,5,2);
										$anoExec = substr($dataExec,0,4);
										
									}
									else {
									
										$dataPrev = $ex['DataPrev'];
										$tipoAgend = $ex['TipoAgend'];
										
									}							
									
									
								}
								else {
									
									
									if (isset($vl)) {
										
										$dataPrev = '0000-00-00';
										$tipoAgend = 'N';
										$dataExec = '0000-00-00';
										
									}
									else {
									
										$dataPrev = '0000-00-00';
										$tipoAgend = 'N';
										
									}
									
									
								}
								
								//CORTANDO STRING DA DATA PREVISTA
								$diaPrev = substr($dataPrev,8,2);
								$mesPrev = substr($dataPrev,5,2);
								$anoPrev = substr($dataPrev,0,4);
					
									
						?>
						
									<tr>
										
										<td class="linha3_tabelaNomencEsp">Planejado</td>
										
										
										<td class="linha3_tabelaNomenc2" <?php if ($mesPrev == 1) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 1) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaPrev; }} ?></td>
										<td class="linha3_tabelaNomenc2" <?php if ($mesPrev == 1) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 1) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaPrev; }} ?></td>
										<td class="linha3_tabelaNomenc2" <?php if ($mesPrev == 1) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 1) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaPrev; }} ?></td>
										
										<td class="linha3_tabelaNomenc2"<?php if ($mesPrev == 2) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 2) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaPrev; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesPrev == 2) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 2) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaPrev; }} ?></td>
										<td class="linha4_tabelaNomenc2"<?php if ($mesPrev == 2) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 2) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaPrev; }} ?></td>
										
										<td class="linha3_tabelaNomenc2"<?php if ($mesPrev == 3) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 3) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaPrev; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesPrev == 3) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 3) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaPrev; }} ?></td>
										<td class="linha5_tabelaNomenc2"<?php if ($mesPrev == 3) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 3) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaPrev; }} ?></td>
										
										<td class="linha3_tabelaNomenc2"<?php if ($mesPrev == 4) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 4) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaPrev; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesPrev == 4) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 4) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaPrev; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesPrev == 4) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 4) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaPrev; }} ?></td>
										
										<td class="linha3_tabelaNomenc2"<?php if ($mesPrev == 5) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 5) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaPrev; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesPrev == 5) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 5) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaPrev; }} ?></td>
										<td class="linha6_tabelaNomenc2"<?php if ($mesPrev == 5) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 5) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaPrev; }} ?></td>
										
										<td class="linha3_tabelaNomenc2"<?php if ($mesPrev == 6) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 6) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaPrev; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesPrev == 6) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 6) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaPrev; }} ?></td>
										<td class="linha8_tabelaNomenc2"<?php if ($mesPrev == 6) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 6) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaPrev; }} ?></td>
										
										<td class="linha3_tabelaNomenc2"<?php if ($mesPrev == 7) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 7) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaPrev; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesPrev == 7) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 7) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaPrev; }} ?></td>
										<td class="linha8_tabelaNomenc2"<?php if ($mesPrev == 7) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 7) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaPrev; }} ?></td>
										
										<td class="linha3_tabelaNomenc2"<?php if ($mesPrev == 8) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 8) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaPrev; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesPrev == 8) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 8) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaPrev; }} ?></td>
										<td class="linha7_tabelaNomenc2"<?php if ($mesPrev == 8) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 8) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaPrev; }} ?></td>
										
										<td class="linha3_tabelaNomenc2"<?php if ($mesPrev == 9) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 9) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaPrev; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesPrev == 9) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 9) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaPrev; }} ?></td>
										<td class="linha4_tabelaNomenc2"<?php if ($mesPrev == 9) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 9) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaPrev; }} ?></td>
										
										<td class="linha3_tabelaNomenc2"<?php if ($mesPrev == 10) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 10) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaPrev; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesPrev == 10) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 10) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaPrev; }} ?></td>
										<td class="linha4_tabelaNomenc2"<?php if ($mesPrev == 10) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 10) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaPrev; }} ?></td>
										
										<td class="linha3_tabelaNomenc2"<?php if ($mesPrev == 11) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 11) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaPrev; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesPrev == 11) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 11) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaPrev; }} ?></td>
										<td class="linha9_tabelaNomenc2"<?php if ($mesPrev == 11) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 11) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaPrev; }} ?></td>
										
										<td class="linha3_tabelaNomenc2"<?php if ($mesPrev == 12) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 12) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaPrev; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesPrev == 12) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 12) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaPrev; }} ?></td>
										<td class="linha4_tabelaNomencF"<?php if ($mesPrev == 12) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_planejou'"; }} ?>><?php if ($mesPrev == 12) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaPrev; }} ?></td>
																			
									
									</tr>
									
									<tr>
										
										<td class="linha3_tabelaNomencEsp">Realizado</td>
										
										
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 1) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 1) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaExec; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 1) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 1) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaExec; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 1) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 1) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaExec; }} ?></td>
										
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 2) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 2) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaExec; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 2) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 2) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaExec; }} ?></td>
										<td class="linha4_tabelaNomenc2"<?php if ($mesExec == 2) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 2) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaExec; }} ?></td>
										
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 3) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 3) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaExec; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 3) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 3) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaExec; }} ?></td>
										<td class="linha5_tabelaNomenc2"<?php if ($mesExec == 3) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 3) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaExec; }} ?></td>
										
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 4) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 4) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaExec; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 4) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 4) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaExec; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 4) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 4) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaExec; }} ?></td>
										
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 5) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 5) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaExec; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 5) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 5) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaExec; }} ?></td>
										<td class="linha6_tabelaNomenc2"<?php if ($mesExec == 5) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 5) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaExec; }} ?></td>
										
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 6) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 6) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaExec; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 6) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 6) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaExec; }} ?></td>
										<td class="linha8_tabelaNomenc2"<?php if ($mesExec == 6) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 6) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaExec; }} ?></td>
										
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 7) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 7) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaExec; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 7) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 7) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaExec; }} ?></td>
										<td class="linha8_tabelaNomenc2"<?php if ($mesExec == 7) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 7) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaExec; }} ?></td>
										
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 8) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 8) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaExec; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 8) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 8) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaExec; }} ?></td>
										<td class="linha7_tabelaNomenc2"<?php if ($mesExec == 8) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 8) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaExec; }} ?></td>
										
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 9) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 9) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaExec; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 9) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 9) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaExec; }} ?></td>
										<td class="linha4_tabelaNomenc2"<?php if ($mesExec == 9) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 9) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaExec; }} ?></td>
										
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 10) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 10) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaExec; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 10) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 10) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaExec; }} ?></td>
										<td class="linha4_tabelaNomenc2"<?php if ($mesExec == 10) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 10) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaExec; }} ?></td>
										
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 11) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 11) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaExec; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 11) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 11) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaExec; }} ?></td>
										<td class="linha9_tabelaNomenc2"<?php if ($mesExec == 11) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 11) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaExec; }} ?></td>
										
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 12) { if ($tipoAgend == "CALIBRACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 12) { if ($tipoAgend == "CALIBRACAO") { echo "C".$diaExec; }} ?></td>
										<td class="linha3_tabelaNomenc2"<?php if ($mesExec == 12) { if ($tipoAgend == "MANUTENCAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 12) { if ($tipoAgend == "MANUTENCAO") { echo "M".$diaExec; }} ?></td>
										<td class="linha4_tabelaNomencF"<?php if ($mesExec == 12) { if ($tipoAgend == "VERIFICACAO") { echo "id='mk_realizou'"; }} ?>><?php if ($mesExec == 12) { if ($tipoAgend == "VERIFICACAO") { echo "CI".$diaExec; }} ?></td>
																			
									
									</tr>
						
						<?php 
								
								
						
							}
						
						?>							
						
						</table>
				
						<!-- ////////////// -->
						
						
						
				
				
					<!-- ////////////////////////////// -->
				
				</div>
				
				<div id="version">
				
					<span id="tit_version">SLAB - V.1.0.0</span>
				
				</div>
			
			</div>
		
		
		</div>

	</body>


</html>