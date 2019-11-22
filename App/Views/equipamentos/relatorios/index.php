<?php




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
	
		
	//GERAR O CRONOGRAMA DOS AGENDAMENTOS
	if(isset($_POST['btn_pdfF2'])) {
				
		$filtro1 = ($_POST['cmb_filtro2']);		
		$ano = ($_POST['cmb_ano']);
		$setor = ($_POST['cmb_setor']);
						
		header("location:calendario.php?filtro=$filtro1&ano=$ano&setor=$setor");
		
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
			<link rel="stylesheet" type="text/css" href="../../styles/cadEquipamentosRel.css">
			
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
								
								<li><a href="index.php" class="lk_lista"><?php echo(utf8_encode('Relat�rios')); ?></a></li>
								
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
					
					
						<span class="subtitulo2" id="ini_tit4"><?php echo(utf8_encode('	Emiss�o de relat�rios de controle'));?></span>
						
						
						<!-- FILTRO DE AGENDAMENTOS -->
						
						
						<span id="cadEmpresa_tit1" class="texto">Filtrar:</span>
						
						
						<select class="cx_texto2" id="cmb_SolicitacaoV" name="cmb_filtro">
							
							<option value="0" <?php if ($_SESSION['FFILTRO'] == 0){ echo "selected"; } ?>><?php echo(utf8_encode('CALEND�RIO DE CALIBRA��ES, MANUTEN��ES E CHECAGENS INTERMEDI�RIAS')); ?></option>
																					
							<!--  <option value="1" </option>-->									
							
						</select>
						
						<!-- 
						
						<div id="formRelatoriosF1">
						

								
								<span id="cadEmpresa_titep1" class="texto">Equipamento:</span>
						
						
								<select class="cx_texto2" id="cmb_SolicitacaoVEP" name="cmb_equipamento">
										
									<option value="0" <?php //if ($_SESSION['FEQUIPAMENTO'] == 0){ echo "selected"; } ?>>TODOS</option>
									
									<?php
									
										/*$sql = "Select Codigo, Nome, Nequipamento from equipamentos where Status = 0 order by Nequipamento asc";
									
										$select = mysql_query($sql);
									
										while ($rf = mysql_fetch_array($select)) {
									
											$codEquip = $rf['Codigo'];
									?>
									
											<option value="<?php echo $rf['Codigo']; ?>" <?php if ($_SESSION['FEQUIPAMENTO'] == $codEquip){ echo "selected"; } ?> ><?php echo $rf['Nequipamento']." - ".$rf['Nome']; ?></option>
									
									<?php
									
										}
										*/
									?>
									
								</select>
														
								<!-- --------------------------------- -->
									
							<!-- 
								<span id="cadEmpresa_titep3" class="texto">Analisar:</span>
								
								<select class="cx_texto2" id="cmb_SolicitacaoV2" name="cmb_filtro2">
									
									<option value="0" <?php //if ($_SESSION['FFILTRO2'] == 0){ echo "selected"; } ?>><?php //echo(utf8_encode('RESULTADOS REGISTRADOS')); ?></option>
																							
									<option value="1" <?php //if ($_SESSION['FFILTRO2'] == 1){ echo "selected"; } ?>><?php //echo(utf8_encode('AGENDAMENTOS REALIZADOS')); ?></option>									
									
								</select>
								
								<span id="cadEmpresa_titep4" class="texto">De:</span>
								
								<input id="cx_Contexto1" class="cx_data" name="txt_de">
								
								<span id="cadEmpresa_titep5" class="texto">Para:</span>
								
								<input id="cx_Contexto3" class="cx_data" name="txt_para">
								
								
								
								
								<div id ="divBotao">
								
									<input type="submit" class="subtitulo2" id="bt_cadastrou" name="btn_pdfF1" value="Gerar PDF" />
									
									<input type="hidden" name="txt_cad" />
								
								</div>
												
						
						
						</div>
						
						 -->
						
						<div id="formRelatoriosF2">
						

								
								<span id="cadEmpresa_titep1" class="texto">Analisar:</span>
						
														
								<select class="cx_texto2" id="cmb_SolicitacaoVEP" name="cmb_filtro2">
									
									<option value="0" <?php if ($_SESSION['FFILTRO2'] == 0){ echo "selected"; } ?>><?php echo(utf8_encode('CRONOGRAMA PLANEJADO')); ?></option>
																							
									<option value="1" <?php if ($_SESSION['FFILTRO2'] == 1){ echo "selected"; } ?>><?php echo(utf8_encode('CRONOGRAMA PLANEJADO E REALIZADO')); ?></option>									
									
								</select>
														
								<!-- --------------------------------- -->
									
							
								<span id="cadEmpresa_titep3" class="texto">Ano:</span>
								
								<select class="cx_texto2" id="cmb_SolicitacaoV2" name="cmb_ano">
									
									<?php 
										
										$quantidade = 2080;
									
										for ($i=2015;$i<=$quantidade;$i++) {
									
									?>
						
											<option value="<?php echo($i); ?>"><?php echo($i); ?></option>
							
									<?php 
									
										}
									
									?>
									
								</select>
								
								
								<span id="cadEmpresa_titep3Supl" class="texto">Setor:</span>
								
								<select class="cx_texto2" id="cmb_SolicitacaoV2Supl" name="cmb_setor">
									
									
											<option value="0"><?php echo(utf8_encode('TODOS')); ?></option>
											<option value="FISICO"><?php echo(utf8_encode('LABORAT�RIO F�SICO')); ?></option>
											<option value="COSTURA"><?php echo (utf8_encode('LABORAT�RIO DE COSTURA')); ?></option>
											<option value="QUIMICO"><?php echo (utf8_encode('LABORAT�RIO QU�MICO')); ?></option>
											<option value="FLAMABILIDADE"><?php echo (utf8_encode('LABORAT�RIO DE FLAMABILIDADE')); ?></option>
											<option value="TOXICIDADE"><?php echo (utf8_encode('LABORAT�RIO DE TOXICIDADE')); ?></option>
											<option value="LAVANDERIA"><?php echo (utf8_encode('LAVANDERIA')); ?></option>
							
									
									
								</select>						
								
								
								
								<div id ="divBotao">
								
									<input type="submit" class="subtitulo2" id="bt_cadastrou" name="btn_pdfF2" value="Gerar PDF" />
									
									<input type="hidden" name="txt_cad" />
								
								</div>
												
						
						
						</div>
						
										
					</form>
				
				</div>										

		</div>


	</body>


</html>