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
		
		$dados = array(
				
				'CodEquip',
				'NomeEquip',
				'PeriodManut',
				'PeriodCalibr',
				'PeriodCI',
				'NomeItem',
				'NomeServico',
				'CodCompItServ',
				'Patrimonio'
		);		
		
		$anoBase = ($_POST['cmb_ano']);
		$mesBase = ($_POST['cmb_mes']);
		
		//DEFININDO O MES
		
		if ($mesBase == 'JANEIRO') {
			
			$mesDef = 1;
			
		}
		
		if ($mesBase == 'FEVEREIRO') {
				
			$mesDef = 2;
				
		}
		
		if ($mesBase == 'MAR�O') {
				
			$mesDef = 3;
				
		}
		
		if ($mesBase == 'ABRIL') {
				
			$mesDef = 4;
				
		}
		
		if ($mesBase == 'MAIO') {
				
			$mesDef = 5;
				
		}
		
		if ($mesBase == 'JUNHO') {
				
			$mesDef = 6;
				
		}
		if ($mesBase == 'JULHO') {
				
			$mesDef = 7;
				
		}
		
		if ($mesBase == 'AGOSTO') {
				
			$mesDef = 8;
				
		}
		
		if ($mesBase == 'SETEMBRO') {
				
			$mesDef = 9;
				
		}
		
		if ($mesBase == 'OUTUBRO') {
				
			$mesDef = 10;
				
		}
		
		if ($mesBase == 'NOVEMBRO') {
				
			$mesDef = 11;
				
		}
		
		if ($mesBase == 'DEZEMBRO') {
				
			$mesDef = 12;
				
		}
		
		//---------------
		
		//TRAZENDO TODOS OS EQUIPAMENTOS E GUARDANDO NO ARRAY DE INFORMA��ES
		$sql = "Select equipamentos.Nome, equipamentos.Codigo, equipamentos.PeriodCalibracao, equipamentos.Nequipamento, equipamentos.Patrimonio, equipamentos.PeriodManut, equipamentos.PeriodChecagem from equipamentos where Status = 0";
		
		$select = mysql_query($sql);
		
		
		//VARI�VEIS PARA CONTROLAR O ARRAY. PROCEDIMENTO FOI NECESS�RIO, POIS OS PRIMEIROS INDICES EST�O VAZIOS E PREJUDICAM A ESTRUTURA DA CONSULTA
		$i=8;
		$p=4;
		//------------------------------------------------------------------------------------------------------------------------------------------
		
		while ($rf = mysql_fetch_array($select)) {
			
			$dados[$i][0] = $rf['Codigo'];
			$dados[$i][1] = $rf['Nome'];
			$dados[$i][2] = $rf['PeriodManut'];
			$dados[$i][3] = $rf['PeriodCalibracao'];
			$dados[$i][4] = $rf['PeriodChecagem'];
			$dados[$i][5] = '';
			$dados[$i][6] = '';
			$dados[$i][7] = '';
			$dados[$i][8] = $rf['Patrimonio'];
			$dados[$i][9] = $rf['Nequipamento'];
		
			$codEquip = $dados[$i][0];
			
			//TRAZENDO TODOS OS SERVI�OS E ITENS DO EQUIPAMENTO
			$sql2 = "Select servicos.Nome as 'NomeServico', itemcalibracao.Nome as 'NomeItem', compcalibrserv.Codigo from servicos, itemcalibracao, compcalibrserv, equipamentos where equipamentos.Codigo = itemcalibracao.CodEquip and compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and equipamentos.Codigo = $codEquip and servicos.Status = 0 and itemcalibracao.Status = 0 and compcalibrserv.Status = 0";
			
			$select2 = mysql_query($sql2);
			
			if (mysql_num_rows($select2) != 0) {
				
				while ($rf2 = mysql_fetch_array($select2)) {
						
					$dados[$i][0] = $rf['Codigo'];
					$dados[$i][1] = $rf['Nome'];
					$dados[$i][2] = $rf['PeriodManut'];
					$dados[$i][3] = $rf['PeriodCalibracao'];
					$dados[$i][4] = $rf['PeriodChecagem'];
					$dados[$i][5] = $rf2['NomeItem'];
					$dados[$i][6] = $rf2['NomeServico'];
					$dados[$i][7] = $rf2['Codigo'];
					$dados[$i][8] = $rf['Patrimonio'];
					$dados[$i][9] = $rf['Nequipamento'];
					
					$i++;
					
				}
				
			}
			else {
				
				$dados[$i][0] = $rf['Codigo'];
				$dados[$i][1] = $rf['Nome'];
				$dados[$i][2] = $rf['PeriodManut'];
				$dados[$i][3] = $rf['PeriodCalibracao'];
				$dados[$i][4] = $rf['PeriodChecagem'];
				$dados[$i][5] = 0;
				$dados[$i][6] = 0;
				$dados[$i][7] = 0;
				$dados[$i][8] = $rf['Patrimonio'];
				$dados[$i][9] = $rf['Nequipamento'];
				
				$i++;
					
			}
			
			
			
		}
		
		
		//PESQUISAR EQUIPAMENTOS/ITENS/SERVI�OS QUE AINDA N�O FORAM REALIZADOS
		$quantidade = count($dados);
		
		$agend = array(
				
			'NomeEquip',	
			'NomeItem',
			'NomeServico',
			'CodCompItServ',
			'Patrimonio',
			'Nequipamento'
				
		);
		
		$tipoAgend = array();
				
		$tipoAgend[0] = 'CALIBRACAO';
		$tipoAgend[1] = 'MANUTENCAO';
		$tipoAgend[2] = 'VERIFICACAO';
		
		//VERIFICAR SE O ITEM/SERVI�O FOI AGENDADO. CASO NEGATIVO OU DATA ULTRAPASSADA, GUARDAR NO ARRAY $agend
		for ($i=10;$i<$quantidade;$i++) {

			$codCompItServ = $dados[$i][7];
			
			//VARI�VEL RESPONS�VEL POR CONTAR NA BASE DE DADOS OS SERVI�OS QUE N�O EST�O AGENDADOS
			//CASO O VALOR SEJA = 3 , SIGNIFICA QUE O SERVI�O NUNCA FOI AGENDADO
			$verificador = 0;

			//SELECIONAR SOMENTE OS EQUIPAMENTOS QUE TENHAM ITENS E SERVI�OS RELACIONADOS
			if ($codCompItServ != 0) {
				
				
				//VERIFICANDO O SERVI�O PELO TIPO DO AGENDAMENTO, OU SEJA, NAS CALIBRA��ES/MANUTEN��ES/CHECAGENS INTERMEDI�RIAS
				for ($wo=0;$wo<3;$wo++) {

						$sql3 = "Select agendcalibrmanut.DataPrev, agendcalibrmanut.DataExec from agendcalibrmanut where CodCompCalibrServ = $codCompItServ and TipoAgend = '$tipoAgend[$wo]' and Status <> 3 order by Codigo desc limit 1";
								
						$select3 = mysql_query($sql3);
	
						//CASO J� EXISTA UM AGENDAMENTO PROGRAMADO, VERIFICAR A DATA PREVISTA
						if(mysql_num_rows($select3) != 0) {
							
							
							//VERIFICANDO SE O SERVI�O TEVE EXECU��O
							if ($rf3['DataExec'] == '1111-11-11') {
																					
								//ENCONTRADA A DATA PREVISTA, CALCULAR SE ELA ULTRAPASSA O ANO E MES BASE PARA A PROGRAMA��O DO CRONOGRAMA
								if($rf3 = mysql_fetch_array($select3)) {
									
									//DATA REFERENTE A PESQUISA DO USU�RIO
									$dataAtual = $anoBase."-".$mesBase."-31";
									
									//DATA DO ULTIMO AGENDAMENTO PREVISTO-EXECUTADO
									$dataAgend = $rf3['DataPrev'];
									
									//VERIFICANDO O TIPO DO AGENDAMENTO E SOMANDO DATAS
									
										if ($tipoAgend[$wo] == 'CALIBRACAO') {
												
												//ENCONTRANDO O N�MERO DE DIAS
												$dados[$i][3] = $dados[$i][3] * 30;
												
												//SOMANDO A PERIODICIDADE COM A �LTIMA CALIBRA��O
												$dataAgend = date('Y/m/d', strtotime(+$dados[$i][3].' days', strtotime($dataAgend)));
												
												//COMPARANDO AS DATAS
												if(strtotime($dataAtual) > strtotime($dataAgend)) {
														
													$agend[$p][0] = $dados[$i][1];
													$agend[$p][1] = $dados[$i][5];
													$agend[$p][2] = $dados[$i][6];
													$agend[$p][3] = $dados[$i][7];
													$agend[$p][4] = $dados[$i][8];
													$agend[$p][5] = $dados[$i][9];
												
													$p++;
																									
												}
		
										}
										
										if ($tipoAgend[$wo] == 'MANUTENCAO') {
											
												//ENCONTRANDO O N�MERO DE DIAS
												$dados[$i][2] = $dados[$i][2] * 30;
											
												//SOMANDO A PERIODICIDADE COM A �LTIMA CALIBRA��O
												$dataAgend = date('Y/m/d', strtotime(+$dados[$i][2].' days', strtotime($dataAgend)));
											
												//COMPARANDO AS DATAS
												if(strtotime($dataAtual) > strtotime($dataAgend)) {
											
													$agend[$p][0] = $dados[$i][1];
													$agend[$p][1] = $dados[$i][5];
													$agend[$p][2] = $dados[$i][6];
													$agend[$p][3] = $dados[$i][7];
													$agend[$p][4] = $dados[$i][8];
													$agend[$p][5] = $dados[$i][9];
											
													$p++;
											
												}
											
										}
										
										if ($tipoAgend[$wo] == 'VERIFICACAO') {
											
												//ENCONTRANDO O N�MERO DE DIAS
												$dados[$i][4] = $dados[$i][4] * 30;
													
												//SOMANDO A PERIODICIDADE COM A �LTIMA CALIBRA��O
												$dataAgend = date('Y/m/d', strtotime(+$dados[$i][4].' days', strtotime($dataAgend)));
													
												//COMPARANDO AS DATAS
												if(strtotime($dataAtual) > strtotime($dataAgend)) {
														
													$agend[$p][0] = $dados[$i][1];
													$agend[$p][1] = $dados[$i][5];
													$agend[$p][2] = $dados[$i][6];
													$agend[$p][3] = $dados[$i][7];
													$agend[$p][4] = $dados[$i][8];
													$agend[$p][5] = $dados[$i][9];
														
													$p++;
														
												}
											
										}
										
									//----------------------------------------------
															
									
									
									
								}
								
							}
							else { //CASO O SERVI�O J� FOI EXECUTADO, SOMAR A PR�XIMA PERIODICIDADE A PARTIR DA DATA DE EXECU��O
								
								//ENCONTRADA A DATA PREVISTA, CALCULAR SE ELA ULTRAPASSA O ANO E MES BASE PARA A PROGRAMA��O DO CRONOGRAMA
								if($rf3 = mysql_fetch_array($select3)) {
										
									//DATA REFERENTE A PESQUISA DO USU�RIO
									$dataAtual = $anoBase."-".$mesBase."-31";
										
									//DATA DO ULTIMO AGENDAMENTO PREVISTO-EXECUTADO
									$dataAgend = $rf3['DataPrev'];
										
									//VERIFICANDO O TIPO DO AGENDAMENTO E SOMANDO DATAS
										
									if ($tipoAgend[$wo] == 'CALIBRACAO') {
								
										//ENCONTRANDO O N�MERO DE DIAS
										$dados[$i][3] = $dados[$i][3] * 30;
								
										//SOMANDO A PERIODICIDADE COM A �LTIMA CALIBRA��O
										$dataAgend = date('Y/m/d', strtotime(+$dados[$i][3].' days', strtotime($dataAgend)));
								
										//COMPARANDO AS DATAS
										if(strtotime($dataAtual) > strtotime($dataAgend)) {
								
											$agend[$p][0] = $dados[$i][1];
											$agend[$p][1] = $dados[$i][5];
											$agend[$p][2] = $dados[$i][6];
											$agend[$p][3] = $dados[$i][7];
											$agend[$p][4] = $dados[$i][8];
											$agend[$p][5] = $dados[$i][9];
								
											$p++;
																			
										}
								
									}
								
									if ($tipoAgend[$wo] == 'MANUTENCAO') {
											
										//ENCONTRANDO O N�MERO DE DIAS
										$dados[$i][2] = $dados[$i][2] * 30;
											
										//SOMANDO A PERIODICIDADE COM A �LTIMA CALIBRA��O
										$dataAgend = date('Y/m/d', strtotime(+$dados[$i][2].' days', strtotime($dataAgend)));
											
										//COMPARANDO AS DATAS
										if(strtotime($dataAtual) > strtotime($dataAgend)) {
												
											$agend[$p][0] = $dados[$i][1];
											$agend[$p][1] = $dados[$i][5];
											$agend[$p][2] = $dados[$i][6];
											$agend[$p][3] = $dados[$i][7];
											$agend[$p][4] = $dados[$i][8];
											$agend[$p][5] = $dados[$i][9];
												
											$p++;
												
										}
											
									}
								
									if ($tipoAgend[$wo] == 'VERIFICACAO') {
											
										//ENCONTRANDO O N�MERO DE DIAS
										$dados[$i][4] = $dados[$i][4] * 30;
											
										//SOMANDO A PERIODICIDADE COM A �LTIMA CALIBRA��O
										$dataAgend = date('Y/m/d', strtotime(+$dados[$i][4].' days', strtotime($dataAgend)));
											
										//COMPARANDO AS DATAS
										if(strtotime($dataAtual) > strtotime($dataAgend)) {
								
											$agend[$p][0] = $dados[$i][1];
											$agend[$p][1] = $dados[$i][5];
											$agend[$p][2] = $dados[$i][6];
											$agend[$p][3] = $dados[$i][7];
											$agend[$p][4] = $dados[$i][8];
											$agend[$p][5] = $dados[$i][9];
								
											$p++;
								
										}
											
									}
								
									//----------------------------------------------													
													
								}
								
							}
							
						}
						else {
							
							$verificador++;
							
						}
				
				}
				
				//CASO O SERVI�O NUNCA TENHA UMA PROGRAMA��O ATRIBU�DA, GUARDAR NO ARRAY
				if ($verificador == 3) {
					
					$agend[$p][0] = $dados[$i][1];
					$agend[$p][1] = $dados[$i][5];
					$agend[$p][2] = $dados[$i][6];
					$agend[$p][3] = $dados[$i][7];
					$agend[$p][4] = $dados[$i][8];
					$agend[$p][5] = $dados[$i][9];
						
					$p++;
					
				}
				
				
			}
			//--------------------------------------------------------
			
		}
		//-------------------------------------------------------------------
				
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
			<link rel="stylesheet" type="text/css" href="../../styles/cadEquipamentosCrono.css">
			
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
		
				<a href="#" class="menu_rel"><?php echo('Relatórios');?></a>

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
						
				<span class="lk_confPessoal"><a href="#"><?php echo('Minhas configurações&nbsp;&nbsp; |');?></a></span>
				
				<span class="lk_confPessoal2"><a href="index.php?sair">Sair</a></span>
				
				<!-- ---------------------- -->
			
				<!-- MENU SECUNDÃƒÆ’Ã¯Â¿Â½RIO -->
				
					<div class="submenu_cont">
						
						<span class="subtitulo2" id="ini_tit3">Selecione um item abaixo:</span>
						
						<!-- OPÃƒÆ’Ã¢â‚¬Â¡ÃƒÆ’Ã¢â‚¬Â¢ES PARA RELATÃƒÆ’Ã¢â‚¬Å“RIOS -->
												
						<!-- ---------------------- -->
						
							<ul class="listas" id="ini_lst1" type="square">
								
								<li><a href="../relatorios/index.php" class="lk_lista"><?php echo('Relatórios'); ?></a></li>
								
							</ul>
						
						<!-- OPÃƒÆ’Ã¢â‚¬Â¡ÃƒÆ’Ã¢â‚¬Â¢ES PARA CADASTROS -->
							
							<ul class="listas" id="ini_lst2" type="square">
								
								<li><a href="../index.php" class="lk_lista">Equipamentos</a></li>
								<li><a href="../unidades/" class="lk_lista">Unidades/Grandezas</a></li>
								<li><a href="../agendamento/" class="lk_lista">Agendamentos</a></li>
								<li><a href="../analiseCritica/" class="lk_lista"><?php echo('Fazer análise crítica'); ?></a></li>
								<li><a href="#" class="lk_lista"><?php echo(utf8_encode('Planejar cronograma')); ?></a></li>
								
							</ul>
						
						<!-- --------------------- -->
						
						<!-- OPÃƒÆ’Ã¢â‚¬Â¡ÃƒÆ’Ã¢â‚¬Â¢ES PARA CONSULTAS -->
							
							<ul class="listas" id="ini_lst3" type="square">
								
								<li><a href="../consulta/" class="lk_lista">Consultar agendamento</a></li>
								<li><a href="../alertas/" class="lk_lista">Alertas e avisos</a></li>
								<li><a href="../analiseCritica/consulta.php" class="lk_lista"><?php echo('Histórico de equipamentos'); ?></a></li>
																
							</ul>
						
						<!-- --------------------- -->
						
					</div>
				
				<!-- ----------------- -->
			
				<!-- CADASTRO DE EMPRESAS -->
			
				<div id="cont2">
					
					<form id="form_cadEmpresas" name="frm_agendamentosCon" action="index.php" method="post">
					
					<span class="subtitulo2" id="ini_tit4"><?php echo('Programar cronograma de calibrações/manutenções/checagens intermediárias');?></span>
					
					
					<!-- FILTRO DE AGENDAMENTOS -->
					
					
						<span id="cadEmpresa_tit1" class="texto">Ano base:</span>
						
						
						<select class="cx_texto2" id="cmb_SolicitacaoV" name="cmb_ano">
							
							<?php 
							
								for ($i=2018; $i<2100; $i++) {
							
							?>								
							
									<option <?php if($anoBase == $i) { echo "selected=selected"; } ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
							
							<?php 
							
								}
							
							?>
							
						</select>
						
						
						<span id="cadEmpresa_titep1" class="texto"><?php echo('Mês atual:'); ?></span>
						
						
						<select class="cx_texto2" id="cmb_SolicitacaoVEP" name="cmb_mes">
							
							<?php
							
								$meses = array();
								
								$meses[1] = 'JANEIRO';
								$meses[2] = 'FEVEREIRO';
								$meses[3] = 'MARÇO';
								$meses[4] = 'ABRIL';
								$meses[5] = 'MAIO';
								$meses[6] = 'JUNHO';
								$meses[7] = 'JULHO';
								$meses[8] = 'AGOSTO';
								$meses[9] = 'SETEMBRO';
								$meses[10] = 'OUTUBRO';
								$meses[11] = 'NOVEMBRO';
								$meses[12] = 'DEZEMBRO';
							
								for ($i=1;$i<=12;$i++) {
								
							?>
							
									<option <?php if($mesBase == $i) { echo "selected=selected"; } ?> value="<?php echo $i; ?>"><?php echo($meses[$i]); ?></option>
							
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
				
					
					<!-- ///////////////////// -->
					
					
					
					<!-- TABELA DE AGENDAMENTOS REALIZADOS 
					
					<span id="cadEmpresa_tit27" class="texto"></span>
					
					<span id="cadEmpresa_tit28" class="texto"></span>
					
					-->
					<?php 
					
						if($_SESSION['CONTROLBUSCA'] == "NOTAG"){
					?>	
					
							<span id="cadEmpresa_tit29Aux" class="texto">Equipamento</span>
					
					<?php 
					
						}
						else {
					
					?>
							<span id="cadEmpresa_tit29" class="texto">Equipamento</span>
						
					<?php 
					
						}
					
					?>
					
					<span id="cadEmpresa_tit30" class="texto">Item</span>
					
					<span id="cadEmpresa_tit30SupC" class="texto"><?php echo('Serviço'); ?></span>
					
					<div id="tabelaCadEquipamentos">
							
												
								<table class="texto">
								
								<?php 
								
									$quantAgends = count($agend);
								
									for ($i=6;$i<$quantAgends;$i++) {
								
								?>
								
											<tr>
													
												<td id="linha1_tabelaCadEmpresasTsv"><?php echo $agend[$i][4]; ?></td>
												<td id="linha1_tabelaCadEmpresas"><?php echo ($agend[$i][5]." - ".$agend[$i][0]); ?></td>	
												<td id="linha2_tabelaCadEmpresas"><?php echo $agend[$i][1]; ?></td>
												<td id="linha3_tabelaCadEmpresas"><?php echo $agend[$i][2]; ?></td>
												<td id="linha4_tabelaCadEmpresas"><a target="_blank" href="../agendamento/index.php?agendar=<?php echo $agend[$i][3]; ?>">Programar</a></td>
																	
											</tr>
								
								<?php
								
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