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
	
	
	//IDENTIFICANDO O USU�RIO E SEU PRIVIL�GIO NO SISTEMA
	
	$codUsuario = ($_SESSION['CODUSUARIO']);
	
	$sql = "Select permissao.Nome from permissao, nivelperm where nivelperm.CodPerm = permissao.Codigo and nivelperm.CodTecnico = $codUsuario";		
	
	$select = mysqli_query($con,$sql);
	
	if ($rf = mysqli_fetch_array($select)) {
		
		$nPerm = $rf['Nome'];
				
	}
	
	//--------------------------------------------------
	
	//PEGANDO A DATA DO SISTEMA
	$data = date('d/m/Y');
	
	//CANCELAR UM AGENDAMENTO
	if (isset($_GET['excluir'])) {
		
		$codAgend = ($_GET['excluir']);
		
		$sql = "Update agendcalibrmanut set Status = 1 where Codigo = $codAgend";
		
		mysqli_query($con,$sql);
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
		
		//IDENTIFICANDO O USU�RIO E SEU PRIVIL�GIO NO SISTEMA
		$codUsuario = ($_SESSION['CODUSUARIO']);
		
		$tipo = ($_POST['cmb_tipo']);
		$dataInicial = date('d/m/Y');
		
		
		//FUN��O PARA SOMAR A DATA ATUAL MAIS 30 DIAS
		$dataFinal = somar_data($dataInicial, 30, 0, 0);
		//-------------------------------------------
		
		
		//CONVERS�O DE DATAS
		$dataInicial = dataAmericana($dataInicial);
		$dataFinal = dataAmericana($dataFinal);
		//------------------
		
		
		//AGENDAMENTOS PREVISTOS
		if ($tipo == 1) {
			
			if (($nPerm != 'TECNICO N1')&&($nPerm != 'TECNICO N3')) {
			
				$sql = "Select agendcalibrmanut.Codigo, equipamentos.Nome as 'NomeEquip', equipamentos.Nequipamento, servicos.Nome as 'NomeServico', itemcalibracao.Nome as 'NomeItemCalibr', agendcalibrmanut.CodCompCalibrServ, agendcalibrmanut.DataPrev from equipamentos, servicos, itemcalibracao, agendcalibrmanut, compcalibrserv where compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and agendcalibrmanut.Status = 0 and ( agendcalibrmanut.DataPrevCalend IS NULL or agendcalibrmanut.DataPrevCalend = '1111-11-11' ) and agendcalibrmanut.DataPrev between ('$dataInicial') AND ('$dataFinal') ORDER BY DataPrev ASC";
			}
			else {
				
				$sql = "Select agendcalibrmanut.Codigo, equipamentos.Nome as 'NomeEquip', equipamentos.Nequipamento, servicos.Nome as 'NomeServico', itemcalibracao.Nome as 'NomeItemCalibr', agendcalibrmanut.CodCompCalibrServ, agendcalibrmanut.DataPrev from equipamentos, servicos, itemcalibracao, agendcalibrmanut, compcalibrserv where compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and agendcalibrmanut.Status = 0 and ( agendcalibrmanut.DataPrevCalend IS NULL or agendcalibrmanut.DataPrevCalend = '1111-11-11' ) and agendcalibrmanut.CodTecnico = $codUsuario and agendcalibrmanut.DataPrev between ('$dataInicial') AND ('$dataFinal') ORDER BY DataPrev ASC";
			}
				
		}
		if ($tipo == 2) { //AGENDAMENTOS MARCADOS
			
			if (($nPerm != 'TECNICO N1')&&($nPerm != 'TECNICO N3')) {
				
				$sql = "Select agendcalibrmanut.Codigo, equipamentos.Nome as 'NomeEquip', equipamentos.Nequipamento, servicos.Nome as 'NomeServico', itemcalibracao.Nome as 'NomeItemCalibr', agendcalibrmanut.CodCompCalibrServ, agendcalibrmanut.DataPrev from equipamentos, servicos, itemcalibracao, agendcalibrmanut, compcalibrserv where compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and agendcalibrmanut.Status = 1 and ( agendcalibrmanut.DataPrevCalend IS NOT NULL or agendcalibrmanut.DataPrevCalend <> '1111-11-11' ) and agendcalibrmanut.DataPrev between ('$dataInicial') AND ('$dataFinal') ORDER BY DataPrev ASC";
			}
			else {
				
				$sql = "Select agendcalibrmanut.Codigo, equipamentos.Nome as 'NomeEquip', equipamentos.Nequipamento, servicos.Nome as 'NomeServico', itemcalibracao.Nome as 'NomeItemCalibr', agendcalibrmanut.CodCompCalibrServ, agendcalibrmanut.DataPrev from equipamentos, servicos, itemcalibracao, agendcalibrmanut, compcalibrserv where compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and agendcalibrmanut.Status = 1 and ( agendcalibrmanut.DataPrevCalend IS NOT NULL or agendcalibrmanut.DataPrevCalend <> '1111-11-11' ) and agendcalibrmanut.CodTecnico = $codUsuario and agendcalibrmanut.DataPrev between ('$dataInicial') AND ('$dataFinal') ORDER BY DataPrev ASC";
			}
			
		}
		//----------------------
		
		
		//AGENDAMENTOS ATRASADOS
		
		//NA PREVISÃO
		if ($tipo == 3) {
		
			if (($nPerm != 'TECNICO N1')&&($nPerm != 'TECNICO N3')) {
			
				$sql = "Select agendcalibrmanut.Codigo, equipamentos.Nome as 'NomeEquip', equipamentos.Nequipamento, servicos.Nome as 'NomeServico', itemcalibracao.Nome as 'NomeItemCalibr', agendcalibrmanut.CodCompCalibrServ, agendcalibrmanut.DataPrev from equipamentos, servicos, itemcalibracao, agendcalibrmanut, compcalibrserv where compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and agendcalibrmanut.Status = 0 and ( agendcalibrmanut.DataPrevCalend IS NULL or agendcalibrmanut.DataPrevCalend = '1111-11-11' ) and agendcalibrmanut.DataPrev <= '$dataInicial' ORDER BY DataPrev ASC";
			}
			else {
				
				$sql = "Select agendcalibrmanut.Codigo, equipamentos.Nome as 'NomeEquip', equipamentos.Nequipamento, servicos.Nome as 'NomeServico', itemcalibracao.Nome as 'NomeItemCalibr', agendcalibrmanut.CodCompCalibrServ, agendcalibrmanut.DataPrev from equipamentos, servicos, itemcalibracao, agendcalibrmanut, compcalibrserv where compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and agendcalibrmanut.Status = 0 and ( agendcalibrmanut.DataPrevCalend IS NULL or agendcalibrmanut.DataPrevCalend = '1111-11-11' ) and agendcalibrmanut.CodTecnico = $codUsuario and agendcalibrmanut.DataPrev <= '$dataInicial' ORDER BY DataPrev ASC";
			}
				
		}
		//NA EXECUÇÃO
		if ($tipo == 4) {
		
			if (($nPerm != 'TECNICO N1')&&($nPerm != 'TECNICO N3')) {
			
				$sql = "Select agendcalibrmanut.Codigo, equipamentos.Nome as 'NomeEquip', equipamentos.Nequipamento, servicos.Nome as 'NomeServico', itemcalibracao.Nome as 'NomeItemCalibr', agendcalibrmanut.CodCompCalibrServ, agendcalibrmanut.DataPrev from equipamentos, servicos, itemcalibracao, agendcalibrmanut, compcalibrserv where compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and agendcalibrmanut.Status = 1 and ( agendcalibrmanut.DataPrevCalend IS NOT NULL or agendcalibrmanut.DataPrevCalend <> '1111-11-11' ) and agendcalibrmanut.DataPrev <= '$dataInicial' ORDER BY DataPrev ASC";
			}
			else {
				
				$sql = "Select agendcalibrmanut.Codigo, equipamentos.Nome as 'NomeEquip', equipamentos.Nequipamento, servicos.Nome as 'NomeServico', itemcalibracao.Nome as 'NomeItemCalibr', agendcalibrmanut.CodCompCalibrServ, agendcalibrmanut.DataPrev from equipamentos, servicos, itemcalibracao, agendcalibrmanut, compcalibrserv where compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and agendcalibrmanut.Status = 1 and ( agendcalibrmanut.DataPrevCalend IS NOT NULL or agendcalibrmanut.DataPrevCalend <> '1111-11-11' ) and agendcalibrmanut.CodTecnico = $codUsuario and agendcalibrmanut.DataPrev <= '$dataInicial' ORDER BY DataPrev ASC";
			}
		}				
		//-----------------------
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
								<li><a href="../cronograma/" class="lk_lista"><?php echo('Planejar cronograma'); ?></a></li>
								
							</ul>
						
						<!-- --------------------- -->
						
						<!-- OPÃƒÆ’Ã¢â‚¬Â¡ÃƒÆ’Ã¢â‚¬Â¢ES PARA CONSULTAS -->
							
							<ul class="listas" id="ini_lst3" type="square">
								
								<li><a href="../consulta/" class="lk_lista">Consultar agendamento</a></li>
								<li><a href="#" class="lk_lista">Alertas e avisos</a></li>
								<li><a href="../analiseCritica/consulta.php" class="lk_lista"><?php echo('Histórico de equipamentos'); ?></a></li>
																
							</ul>
						
						<!-- --------------------- -->
						
					</div>
				
				<!-- ----------------- -->
			
				<!-- CADASTRO DE EMPRESAS -->
			
				<div id="cont2">
					
					<form id="form_cadEmpresas" name="frm_agendamentosCon" action="index.php" method="post">
					
					<span class="subtitulo2" id="ini_tit4"><?php echo('Alerta de previsão e execução');?></span>
					
					
					<!-- FILTRO DE AGENDAMENTOS -->
					
					
						<span id="cadEmpresa_tit1" class="texto">Data atual:</span>
						
						
						<span class="texto3" id="txt_SolicitacaoVAler"><?php echo $data; ?></span>
											
						
						<select class="cx_texto2" id="cmb_SolicitacaoVEPAlert" name="cmb_tipo">
								
							<?php if(($nPerm != 'TECNICO N1')&&($nPerm != 'TECNICO N3')) { ?>				
									<option <?php if($tipo == 1) { echo "selected=selected"; } ?> value="1"><?php echo('AGENDAMENTOS PREVISTOS PARA OS PRÓXIMOS 30 DIAS'); ?></option>
							<?php } ?>
							
							<option <?php if($tipo == 2) { echo "selected=selected"; } ?> value="2"><?php echo('AGENDAMENTOS MARCADOS PARA OS PRÓXIMOS 30 DIAS'); ?></option>
							
							<?php if(($nPerm != 'TECNICO N1')&&($nPerm != 'TECNICO N3')) { ?>
									<option <?php if($tipo == 3) { echo "selected=selected"; } ?> value="3"><?php echo('AGENDAMENTOS COM A PREVISÃO ATRASADA'); ?></option>
							<?php } ?>
							
							<option <?php if($tipo == 4) { echo "selected=selected"; } ?> value="4"><?php echo('AGENDAMENTOS COM A EXECUÇÃO ATRASADA'); ?></option>
							
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
								
								
									$select = mysqli_query($con,$sql);
								
									while ($rf = mysqli_fetch_array($select)) {
										
										$data = dataBrasileira($rf['DataPrev']);
								
								?>
								
											<tr>
													
												<td id="linha1_tabelaCadEmpresasTsv"><?php echo $data; ?></td>
												<td id="linha1_tabelaCadEmpresas"><?php echo($rf['Nequipamento']." - ".$rf['NomeEquip']); ?></td>	
												<td id="linha2_tabelaCadEmpresas"><?php echo($rf['NomeItemCalibr']); ?></td>
												<td id="linha3_tabelaCadEmpresas"><?php echo ($rf['NomeServico']); ?></td>
												<td id="linha4_tabelaCadEmpresas"><a target="_blank" <?php if(($tipo == 1)||($tipo == 3)) { echo "href=../consulta/exibirDetalhes.php?codAgend=".$rf['Codigo']; } else { echo "href=../consulta/exibirDetalhes.php?codAgend=".$rf['Codigo']; } ?> ><?php if(($tipo == 1)||($tipo == 3)){ echo "Confirmar"; }else{ echo "Verificar"; } ?></a></td>
																	
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