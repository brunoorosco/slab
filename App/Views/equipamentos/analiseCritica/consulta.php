<?php


	//IMPORTANTE:
	//NA TABELA ANALISEQUIPAMENTO, SEGUE O PADR�O DE STATUS:
	// 0 - EQUIPAMENTO AGUARDANDO CONFIRMA��O DE AN�LISE
	// 1 - EQUIPAMENTO COM AN�LISE REALIZADA (SALVA DATA)
	// 2 - EQUIPAMENTO COM AN�LISE CANCELADA


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
				
		//EQUIPAMENTOS AGUARDANDO CONFIRMA��O DE AN�LISE
		if ($tipCon == 0) {
			
			$_SESSION['CONTROLBUSCA'] = 0;
			
			if ($tipoAg != 0) {
			
				$sql1 = "Select Codigo, DataAnalise, CaminhoCert, Liberado from analisequipamento where CodEquipamento = $tipoAg and Status = 0";
				
				//ARMAZENAR A QUERY SQL PARA POSTERIORMENTE MANIPUL�-LA
				$_SESSION['SQLBUSCA'] = $sql1;
				
			}
			else { //CASO N�O SEJA ESPECIFICADO O EQUIPAMENTO DURANTE A BUSCA, EXECUTAR A SEGUIR
				
				$sql1 = "Select Codigo, DataAnalise, CaminhoCert, Liberado from analisequipamento where Status = 0";
				//ARMAZENAR A QUERY SQL PARA POSTERIOMENTE MANIPUL�-LA
				$_SESSION['SQLBUSCA'] = $sql1;
				
			}
			
		}
		
		//EQUIPAMENTOS COM AN�LISE REALIZADA
		if ($tipCon == 1) {
						
			$_SESSION['CONTROLBUSCA'] = 1;
			
			if ($tipoAg != 0) {
			
				$sql1 = "Select Codigo, DataAnalise, CaminhoCert, Liberado from analisequipamento where CodEquipamento = $tipoAg and Status = 1";
				
				//ARMAZENAR A QUERY SQL PARA POSTERIORMENTE MANIPUL�-LA
				$_SESSION['SQLBUSCA'] = $sql1;
				
			}
			else { //CASO N�O SEJA ESPECIFICADO O EQUIPAMENTO DURANTE A BUSCA, EXECUTAR A SEGUIR
				
				$sql1 = "Select Codigo, DataAnalise, CaminhoCert, Liberado from analisequipamento where Status = 1";
				
				//ARMAZENAR A QUERY SQL PARA POSTERIOMENTE MANIPUL�-LA
				$_SESSION['SQLBUSCA'] = $sql1;
								
			}
						
		}
		
		//EQUIPAMENTOS COM AN�LISE CANCELADA
		if ($tipCon == 2) {
		
			$_SESSION['CONTROLBUSCA'] = 2;

			if ($tipoAg != 0) {
			
				$sql1 = "Select Codigo, DataAnalise, CaminhoCert, Liberado from analisequipamento where CodEquipamento = $tipoAg and Status = 2";
				
				//ARMAZENAR A QUERY SQL PARA POSTERIORMENTE MANIPUL�-LA
				$_SESSION['SQLBUSCA'] = $sql1;
		
			}
			else { //CASO N�O SEJA ESPECIFICADO O EQUIPAMENTO DURANTE A BUSCA, EXECUTAR A SEGUIR
		
				$sql1 = "Select Codigo, DataAnalise, CaminhoCert, Liberado from analisequipamento where Status = 2";
						
				//ARMAZENAR A QUERY SQL PARA POSTERIOMENTE MANIPUL�-LA
				$_SESSION['SQLBUSCA'] = $sql1;
		
			}		
				
		}
		
		//GUARDANDO O TIPO DA CONSULTA EM VARI�VEL DE SESS�O PARA USAR POSTERIORMENTE POR AJAX
		$_SESSION['TIPANALCRIT'] = $tipCon;
		
			
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
			<link rel="stylesheet" type="text/css" href="../../styles/cadEquipamentosAnalCritCon.css">
			
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
								<li><a href="index.php" class="lk_lista"><?php echo(utf8_encode('Fazer an�lise cr�tica')); ?></a></li>
								<li><a href="../cronograma/" class="lk_lista"><?php echo(utf8_encode('Planejar cronograma')); ?></a></li>
								
							</ul>
						
						<!-- --------------------- -->
						
						<!-- OPÃƒÆ’Ã¢â‚¬Â¡ÃƒÆ’Ã¢â‚¬Â¢ES PARA CONSULTAS -->
							
							<ul class="listas" id="ini_lst3" type="square">
								
								<li><a href="../consulta/" class="lk_lista">Consultar agendamento</a></li>
								<li><a href="../alertas/" class="lk_lista">Alertas e avisos</a></li>
								<li><a href="#" class="lk_lista"><?php echo(utf8_encode('Hist�rico de equipamentos')); ?></a></li>
																
							</ul>
						
						<!-- --------------------- -->
						
					</div>
				
				<!-- ----------------- -->
			
				<!-- CADASTRO DE EMPRESAS -->
			
				<div id="cont2">
					
					<form id="form_cadEmpresas" name="frm_agendamentosCon" action="consulta.php" method="post">
					
					<span class="subtitulo2" id="ini_tit4"><?php echo(utf8_encode('Consultar hist�rico dos equipamentos'));?></span>
					
					
					<!-- FILTRO DE AGENDAMENTOS -->
					
					
						<span id="cadEmpresa_tit1" class="texto">Equipamento:</span>
						
						
						<select class="cx_texto2" id="cmb_SolicitacaoV" name="cmb_filtro">
							
							<option value="0" <?php if ($_SESSION['FFILTRO'] == 0){ echo "selected"; } ?>><?php echo(utf8_encode('COM CONFIRMA��O DE AN�LISE PENDENTE')); ?></option>
							
							<option value="1" <?php if ($_SESSION['FFILTRO'] == 1){ echo "selected"; } ?>><?php echo(utf8_encode('COM AN�LISES CR�TICAS REALIZADAS')); ?></option>
							
							
						</select>
												
						<span id="cadEmpresa_titep1" class="texto">Filtrar:</span>
						
						
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
										
					<span id="cadEmpresa_titep3" class="texto"><?php echo(utf8_encode('Data da an�lise:')); ?></span>
					
					<select id="cmb_tipoAgend" class="cx_texto2" name="cmb_tipoAgendamento" onchange="consultar('analCritica', 0, '');">
					
						<option value="0">TODAS AS DATAS</option>
					
						<?php 
						
							$sqlC = $_SESSION['SQLBUSCA'];
						
							$select1 = mysql_query($sqlC);
						
							while ($rf1 = mysql_fetch_array($select1)) {
							
								$data = dataBrasileira($rf1['DataAnalise']);
							
						?>
					
								<option value="<?php echo $data; ?>"><?php echo $data; ?></option>
						<?php
							
							}
						
						?>
					
					</select>
					
					<!-- ///////////////////// -->
					
					
					
					<!-- TABELA DE AGENDAMENTOS REALIZADOS 
					
					<span id="cadEmpresa_tit27" class="texto"></span>
					
					<span id="cadEmpresa_tit28" class="texto"></span>
					
					-->
					
					<div id="tabelaCadEquipamentos">
							
												
								<table class="texto">
								
								<?php 
								
								
									$select2 = mysql_query($sqlC); 
								
									while ($rf2 = mysql_fetch_array($select2)) {
										
										$data = dataBrasileira($rf2['DataAnalise']);
								?>
								
																			
											<tr>
													
												<td id="linha1_tabelaCadEmpresas"><?php echo $data; ?></td>	
												<td id="linha2_tabelaCadEmpresas"><a target="_blank" href="../arquivos/<?php echo($rf2['CaminhoCert']); ?>"><img alt="Baixar certificado" src="../../imagens/png/pdf.png"></a></td>
												<td id="linha3_tabelaCadEmpresas"><a target="_blank" <?php if($tipCon == 0) { ?> href="index.php?codAnalCrit=<?php echo($rf2['Codigo']); ?>&mod=CONFIRMAR" <?php } ?> <?php if($tipCon == 1) { ?> href="index.php?codAnalCrit=<?php echo($rf2['Codigo']); ?>&mod=VER" <?php } ?>>Ver Detalhes</a></td>
												<td id="linha5_tabelaCadEmpresas"><?php if($rf2['Liberado'] == 'SIM'){ echo(utf8_encode("Equipamento liberado")); }else{ echo(utf8_encode("Equipamento n�o liberado")); } ?></td>
																	
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