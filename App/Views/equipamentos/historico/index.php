<?php

	//ARQUIVO DE CONEXÃƒÆ’O COM O BANCO DE DADOS
	include("../../php/conexao.php");
	
	include("../php/funcoes.php");

	
	//CHECAR SE FOI REALIZADA A CONEXÃƒÆ’O DO USUÃƒï¿½RIO
	conexaoUsuario();
	
	
	//VARIÁVEIS UTILIZADAS PARA ESTABELECER A PAGINAÇÃO INICIAL, OU SEJA, SEM AJAX
	$numeroMK = 1;
	$paginador = 0;


	//ROTINA QUE REALIZA A PAGINAÃƒâ€¡ÃƒÆ’O DE REGISTROS DO BANCO DE DADOS
	if (isset($_GET['clickPag'])) {

		//PEGA O NÃƒÅ¡MERO DA PÃƒï¿½GINA
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
	
	
	//AO CLICAR NO BOTÃO PARA PESQUISAR OS AGEDAMENTOS

	if(isset($_POST['btn_pesquisar'])) {

		$equip = ($_POST['cmb_equipamentos']);

		//AJUSTANDO AS VARIÁVEIS DE SESSÃO DOS COMBOBOX
		$_SESSION['HISTEQUIP'] = $equip;
	
		$sql1 = "Select agendcalibrmanut.Codigo, agendcalibrmanut.TipoAgend, agendcalibrmanut.CodAgendamento, agendcalibrmanut.DataPrev, itemcalibracao.Nome as 'nitem', equipamentos.Nome as 'nequipamento', agendcalibrmanut.Status from agendcalibrmanut, equipamentos, itemcalibracao where itemcalibracao.Codigo = agendcalibrmanut.CodItem and equipamentos.Codigo = itemcalibracao.CodEquipamento and equipamentos.Codigo = $equip and agendcalibrmanut.Status = 3 order by itemcalibracao.Codigo asc limit $paginador, 11";	
	
	}
	
	//------------------------------------------------
	
	
	//CONTANDO QUANTIDADE TOTAL DE AGENDAMENTOS PENDENTES
	if (isset($_SESSION['HISTEQUIP'])) {

		$sql = "Select COUNT(*) from equipamentos, itemcalibracao where equipamentos.Codigo = itemcalibracao.CodEquipamento and itemcalibracao.Codigo not in (Select agendcalibrmanut.CodItem from agendcalibrmanut)";

		$select = mysql_query($sql);

		if ($rf = mysql_fetch_array($select)) {

			$quantidadeRegistros = $rf['COUNT(*)'];
		}

		$npaginas = ($quantidadeRegistros/11);

		//ARREDONDANDO QUANTIDADE DE REGISTROS PARA CIMA PARA GERAR O NÃƒÅ¡MERO DE PÃƒï¿½GINAS CORRETO
		$totalPaginas = ceil($npaginas);

		//-------------------------------------------
		
	}
	
	//FINALIZAR CONEXÃƒÆ’O
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
			<link rel="stylesheet" type="text/css" href="../../styles/cadEquipamentosHist.css">
			
		<!--------------------------->

		<!-- ARQUIVOS JAVASCRIPT -->
					
			<script type="text/javascript" src="../../js/jquery.js"></script>		
			<script type="text/javascript" src="../../js/mascara.js"></script>
			<script type="text/javascript" src="../../js/modular.js"></script>
			<script type="text/javascript" src="../js/validacao.js"></script>
			<script type="text/javascript" src="../js/funcoes.js"></script>
		
		<!-- ------------------ -->

		<!-- VALIDAÃƒâ€¡ÃƒÆ’O DO FORMULÃƒï¿½RIO -->

		
		<script type="text/javascript">
			


				    

			
		</script>


		<!-- ---------------------- -->

	</head>


	<body>

		

		<div class="principal">

			<a href="../inicial/index.php" class="cm_home"></a>
			
			<!-- MENUS PRINCIPAIS DO SISTEMA -->
		
				<a href="#" class="menu_rel">Relatórios</a>

				<a href="#" class="menu_con">Consultas</a>

				<a href="#" class="menu_cad">Cadastros</a>
				
				<a href="../solicitacao/" class="bt_solicitar"></a>

			<!-- /////////////////////////// -->
			
			
			<!-- ESTRUTURA DA PÃƒï¿½GINA INICIAL -->
			

			<span class="paragrafo" id="ini_tit1">Solicitar</span>
			
			
				<!-- CABECALHO -->
				
					<div class="cabecalho"></div>
				
				<!-- --------- -->
				
				<!-- MENSAGEM DE BOAS VINDAS E CONFIGURAÃƒâ€¡Ãƒâ€¢ES PESSOAIS-->
				
				<span id="ini_tit11" class="texto">Bem vindo, <?php echo $_SESSION['USUARIO']; ?>!</span>
						
				<span class="lk_confPessoal"><a href="#">Minhas configurações&nbsp;&nbsp; |</a></span>
				
				<span class="lk_confPessoal2"><a href="index.php?sair">Sair</a></span>
				
				<!-- ---------------------- -->
			
				<!-- MENU SECUNDÃƒï¿½RIO -->
				
					<div class="submenu_cont">
						
						
						<span class="subtitulo2" id="ini_tit3">Selecione um item abaixo:</span>
						
						<!-- OPÃƒâ€¡Ãƒâ€¢ES PARA RELATÃƒâ€œRIOS -->
						
							
						
						<!-- ---------------------- -->
						
						<!-- OPÃƒâ€¡Ãƒâ€¢ES PARA CADASTROS -->
							
							<ul class="listas" id="ini_lst2" type="square">
								
								<li><a href="../index.php" class="lk_lista">Equipamentos</a></li>
								
							</ul>
						
						<!-- --------------------- -->
						
						<!-- OPÃƒâ€¡Ãƒâ€¢ES PARA CONSULTAS -->
							
							<ul class="listas" id="ini_lst3" type="square">
								
								<li><a href="../agendamento/" class="lk_lista">Fazer um agendamento</a></li>
								<li><a href="../consulta/" class="lk_lista">Controle de agendamentos</a></li>
								<li><a href="#" class="lk_lista">Histórico de calibrações/manutenções/verificações</a></li>
								
							</ul>
						
						<!-- --------------------- -->
						
					</div>
				
				<!-- ----------------- -->
			
				<!-- CADASTRO DE EMPRESAS -->
			
				<div id="cont2">
					
					<form id="form_cadEmpresas" name="frm_equipamentos" action="index.php" method="post">
					
					<span class="subtitulo2" id="ini_tit4">Histórico de calibrações manutenções</span>
					
				
					<!-- FILTRO DE AGENDAMENTOS -->
					
					
						<span id="cadEmpresa_tit1" class="texto">Equipamento:</span>
						
						
						<select class="cx_texto2" id="cmb_SolicitacaoV" name="cmb_equipamentos">
						
						<?php 
						
							$sql = "Select Codigo, Nome, Nequipamento from equipamentos where status = 0 order by Nequipamento asc";
						
							$select = mysql_query($sql);
						
							while ($rf = mysql_fetch_array($select)) {
						?>
						
								<option value="<?php echo $rf['Codigo']; ?>" <?php if($_SESSION['HISTEQUIP'] == $rf['Codigo']) { echo "selected"; } ?> ><?php echo $rf['Nequipamento']." - ".$rf['Nome']; ?></option>
												
						<?php 
						
							}
						
						?>
													
						</select>
						
						
						
												
					<!-- --------------------------------- -->			
					
						<div id ="divBotao">
						
							<input type="submit" onclick="cadastrar('equipamentos','cadastrar');" class="subtitulo2" id="bt_cadastrou" name="btn_pesquisar" value="Pesquisar" />
							
							<input type="hidden" name="txt_cad" />
							
						</div>
											
					
					<!-- TABELA DE AGENDAMENTOS REALIZADOS -->
					
					<span id="cadEmpresa_tit27" class="texto">Data</span>
					
					<span id="cadEmpresa_tit28" class="texto">Agendamento</span>
					
					<span id="cadEmpresa_tit29" class="texto">Item Calibração/Manutenção</span>
					
					<span id="cadEmpresa_tit30" class="texto">Tipo do agendamento</span>
					
					<div id="tabelaCadEquipamentos">
						
						<?php 
						
						
							if (isset($_SESSION['HISTEQUIP'])) {
						
						?>
						
												
								<table class="texto3" id="tabelaEquipamentos">
								
								<?php						
									
										//CONSULTANDO DADOS NO BANCO REFERENTES A TABELA DE EMPRESAS								
										$select1 = mysql_query($sql1);
										
										while ($rf = mysql_fetch_array($select1)) {
													
												
											$data = dataBrasileira($rf['DataPrev']);
								
								?>
								
												<tr>
												
													<td id="linha1_tabelaCadEmpresas"><?php echo $data; ?></td>	
													<td id="linha2_tabelaCadEmpresas"><?php echo $rf['CodAgendamento']; ?></td>
													<td id="linha3_tabelaCadEmpresas"><?php echo $rf['nitem']; ?></td>
													<td id="linha4_tabelaCadEmpresas"><?php echo $rf['TipoAgend']; ?></td>
													<td id="linha6_tabelaCadEmpresas"><a href="../resultado/index.php?codEdit=<?php echo $rf['Codigo']; ?>&detalhes=1"><img src="../../imagens/png/bt_detalhes.png" width="60" alt="VER DETALHES" /></a></td>
													<td id="linha7_tabelaCadEmpresas"><img src="../../imagens/png/bt_controleDisponivel.png" width="45" alt="REALIZADO" /></td>
												</tr>
								
								<?php
								
									
										}
										
								?>
								
								</table>
						<?php 
						
							}						
						
						?>					
						
					</div>					
					
					<!-- ------------------------------------------ -->
					
					
					<!-- QUANTIDADE DE PÃƒï¿½GINAS DE REGISTROS -->
					
					
						<span class="texto" id="cadEmpresa_tit32">Páginas:</span>
					
						<div id="tabelaPaginasEquipamentos">
							
							<table class="texto3" id="tabela_paginacao">
								
								<tr>
									<?php
									
										for ($i=1;$i <= $totalPaginasEquip;$i++) {
												
												
											if ($i != $numeroMK) {				
				
									?>
									
												<td><a onclick="consultar('equipamentos',<?php echo($i); ?>);"><?php echo($i); ?></a></td>					
									
									<?php
											}
											else {
									?>
											
												<td><a class="lk_tick" onclick="consultar('equipamentos',<?php echo($i); ?>);"><?php echo($i); ?></a></td>
									
									<?php
											}
									
									
										}
									
									?>									
									
								</tr>
								
								
							</table>
							
						</div>
					
						<!-- BOTÃƒâ€¢ES DE MOVIMENTAÃƒâ€¡ÃƒÆ’O -->
						
						<?php
						
						
							if ($totalPaginas > 21) {
						
						?>
						
						
								<a href="#" id="lk_movAnt2"  onmouseover="moveRight();" onmouseout="stopMove();">-</a>
								<a href="#" id="lk_movProx2" onmouseover="moveLeft();" onmouseout="stopMove();">+</a>
					
						<?php
						
							}
										
						?>
					
						<!-- ---------------------- -->
					
					<!-- --------------------------------- -->
				
					</form>
				
				</div>										

		</div>


	</body>


</html>