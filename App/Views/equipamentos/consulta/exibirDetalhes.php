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
		
		header("location:index.php");		
	}
	
	//ENCAMINHANDO INSER��O DOS RESULTADOS
	if (isset($_POST['btn_resultados'])) {
		
		$codAgend = $_SESSION['SCODAGEND'];
		
		header("location:../resultado/index.php?codAgend=$codAgend");
		
	}
	
	
	//EXTRAINDO OS DADOS RECEBIDOS
	if (isset($_GET['codAgend'])) {
		
		$codAgend = ($_GET['codAgend']);
		
		$_SESSION['SCODAGEND'] = $codAgend;
		
		$sql = "Select agendcalibrmanut.CodAgendamento, compcalibrserv.CodServico, compcalibrserv.CodItemCalibracao, agendcalibrmanut.CodTecnico, agendcalibrmanut.CodEmpresa, agendcalibrmanut.DataPrev, agendcalibrmanut.Status, agendcalibrmanut.TipoAgend, equipamentos.Nome, equipamentos.Nequipamento, equipamentos.Codigo from equipamentos, agendcalibrmanut, compcalibrserv, itemcalibracao where itemcalibracao.Codigo = compcalibrserv.CodItemCalibracao and itemcalibracao.CodEquip = equipamentos.Codigo and agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and agendcalibrmanut.Codigo = $codAgend";
		
		$select = mysql_query($sql);
		
		if ($rf = mysql_fetch_array($select)) {
			
			$codAgendamento = $rf['CodAgendamento'];
			$nequipamento = $rf['Nequipamento'];
			$codServico = $rf['CodServico'];
			$codEquip = $rf['CodItemCalibracao'];
			$nomeEquip = $rf['Nome'];
			$codEmpresa = $rf['CodEmpresa'];
			$codTecnico = $rf['CodTecnico'];
			$dataPrev = $rf['DataPrev'];
			
			//GUARDAR A DATA DA PREVIS�O
			$_SESSION['DATAPRV'] = $dataPrev;
			
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
		$dtDprv = ($_SESSION['DATAPRV']);
		
		$dataPrev = $ano."-".$mes."-".$dia;
		
		$codAgendamento = $_SESSION['SCODAGEND'];
		
		
		//VERIFICANDO O C�DIGO
		$sql = "Select Codigo from compcalibrserv where CodServico = $codServico and CodItemCalibracao = $itemEquip";
		
		$select = mysql_query($sql);
		
		
		if ($rf = mysql_fetch_array($select)) {
			
			$codCalibrServ = $rf['Codigo'];
			
		}
		
		
		$sql = "Update agendcalibrmanut set CodCompCalibrServ = $codCalibrServ , DataPrev = '$dataPrev' , DataPrevCalend = '$dtDprv', CodEmpresa = $codEmpresa , CodTecnico = $codTec , TipoAgend = '$tipoAgend', Status = 1 where Codigo = $codAgendamento";
		
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
			<link rel="stylesheet" type="text/css" href="../../styles/cadEquipamentosDet.css">
			
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
		
				<a href="#" class="menu_rel"><?php echo(utf8_encode('Relat�rios')); ?></a>

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
						
				<span class="lk_confPessoal"><a href="#"><?php echo(utf8_encode('Minhas configura��es&nbsp;&nbsp; |')); ?></a></span>
				
				<span class="lk_confPessoal2"><a href="index.php?sair">Sair</a></span>
				
				<!-- ---------------------- -->
			
				<!-- MENU SECUNDÃƒÆ’Ã¯Â¿Â½RIO -->
				
					<div class="submenu_cont">
						
						<span class="subtitulo2" id="ini_tit3">Selecione um item abaixo:</span>
						
						<!-- OPÃƒÆ’Ã¢â‚¬Â¡ÃƒÆ’Ã¢â‚¬Â¢ES PARA RELATÃƒÆ’Ã¢â‚¬Å“RIOS -->
												
						<!-- ---------------------- -->
						
						<!-- OPÃƒÆ’Ã¢â‚¬Â¡ÃƒÆ’Ã¢â‚¬Â¢ES PARA CADASTROS -->
							
							<ul class="listas" id="ini_lst1" type="square">
								
								<li><a href="../relatorios/index.php" class="lk_lista"><?php echo(utf8_encode('Relat�rios')); ?></a></li>
								
							</ul>
						
							
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
				
				<form name="frm_detalhesAgendamento" action="exibirDetalhes.php" method="POST">
				
					<form id="form_cadEmpresas" name="frm_agendamentosCon" action="index.php" method="post">
					
					<span class="subtitulo2" id="ini_tit4">Detalhes do agendamento</span>
										
					<span id="cadEmpresa_tit16" class="texto"><?php echo(utf8_encode('C�digo do agendamento:')); ?></span>
					
					<span id="cadEmpresa_tit16Cpl" class="texto"><?php if(isset($codAgendamento)){ echo(utf8_encode($codAgendamento)); }else{} ?></span>
					
					<span id="cadEmpresa_tit17" class="texto"><?php echo(utf8_encode('Nome do equipamento:')); ?></span>
				
					<span id="cadEmpresa_tit17Cpl" class="texto"><?php if(isset($nomeEquip)){ echo($nequipamento." - ".$nomeEquip); }else{} ?></span>
				
					<span id="cadEmpresa_tit18" class="texto"><?php echo(utf8_encode('Item do equipamento:')); ?></span>
					
					<select <?php if($statusAgend != 'AGENDAMENTO AGUARDANDO CONFIRMA��O'){ echo 'disabled="disabled"'; } ?> id="cadEmpresa_tit18Cpl" class="cx_texto2" name="cmb_itemEquip" onchange="consultar('listaServicosDetAgend', '<?php echo $codEquipamento; ?>', '');">
					
					<?php
										
						$sql = "Select itemcalibracao.Codigo, itemcalibracao.Nome from itemcalibracao where itemcalibracao.CodEquip = $codEquipamento and itemcalibracao.Status = 0";
					
						$select = mysql_query($sql);
						
						while ($rf = mysql_fetch_array($select)) {
						
					?>

							<option value="<?php echo($rf['Codigo']); ?>" <?php if($codEquip == $rf['Codigo']){ $gdItem = $rf['Codigo']; echo "selected='selected'"; } ?>><?php echo($rf['Nome']); ?></option>

					<?php
					
						}										
					
					?>
					
					</select>
					
					<span id="cadEmpresa_tit19" class="texto"><?php echo(utf8_encode('Servi�o para ser executado:')); ?></span>
					
					<div id="combo_serv">
						
						<select <?php if($statusAgend != 'AGENDAMENTO AGUARDANDO CONFIRMA��O'){ echo 'disabled="disabled"'; } ?> id="cadEmpresa_tit19Cpl" class="cx_texto2" name="cmb_servico">
						
						<?php 
						
							$sql1 = "Select servicos.Codigo, servicos.Nome from servicos, compcalibrserv where servicos.Codigo = compcalibrserv.CodServico and compcalibrserv.CodItemCalibracao = $gdItem";
							
							$select1 = mysql_query($sql1);
						
							while ($rf1 = mysql_fetch_array($select1)) {
						
						?>
						
								<option <?php if($rf1['Codigo'] == $codServico){ echo "selected='selected'"; } ?> value="<?php echo($rf1['Codigo']); ?>"><?php echo($rf1['Nome']); ?></option>
						
						<?php 
						
							}					
						
						?>
						
						</select>
					
					</div>
					
					<span id="cadEmpresa_tit20" class="texto"><?php echo(utf8_encode('T�cnico respons�vel:')); ?></span>					
				
				
					<select <?php if($statusAgend != 'AGENDAMENTO AGUARDANDO CONFIRMA��O'){ echo 'disabled="disabled"'; } ?> id="cadEmpresa_tit20Cpl" class="cx_texto2" name="cmb_codTec">
					
					<?php 
					
						$sql = "Select * from funcionarios where Status = 0";
						
						$select = mysql_query($sql);
					
						if ($codTecnico != 0) {
					
					?>
					
									<option value="0">NENHUM</option>
					
					<?php
							
							while ($rf = mysql_fetch_array($select)) {
							
							
					?>
									
									<option value="<?php echo $rf['Codigo']; ?>" <?php if($codTecnico == $rf['Codigo']){ echo "selected='selected'"; }  ?> ><?php echo($rf['Nome']); ?></option>
									
					<?php 
							
							}
						
						}
						else {
					?>		
				
									<option value="0" selected="selected">NENHUM</option>			
						
					<?php 
							while ($rf = mysql_fetch_array($select)) {
							
					?>
					
									<option value="<?php echo $rf['Codigo']; ?>" <?php if($codTecnico == $rf['Codigo']){ echo "selected='selected'"; }  ?> ><?php echo($rf['Nome']); ?></option>
					
					<?php 
								
							}
				
						}
						
					
					?>
					
					</select>
				
				
					<span id="cadEmpresa_tit21" class="texto"><?php echo(utf8_encode('Empresa respons�vel:')); ?></span>
				
				
					<div id="addEmpresa">
				
							<select <?php if($statusAgend != 'AGENDAMENTO AGUARDANDO CONFIRMA��O'){ echo 'disabled="disabled"'; } ?> id="cadEmpresa_tit21Cpl" class="cx_texto2" name="cmb_codEmpresa">
							
							<?php 
							
								$sql = "Select * from certificadores where Status = 0";
								
								$select = mysql_query($sql);
								
								if ($codEmpresa != 0) {
								
								
							?>
							
											<option value="0">NENHUM</option>
							
							<?php 
							
									while ($rf = mysql_fetch_array($select)) {
								
									
							?>
							
											<option value="<?php echo $rf['Codigo']; ?>" <?php if($codEmpresa == $rf['Codigo']){ echo "selected='selected'"; }  ?> ><?php echo(utf8_encode($rf['Nome'])); ?></option>
							
							<?php 
									}
								
								
								}
								else {
							?>		
						
											<option value="0" selected="selected">NENHUM</option>			
								
							<?php 
									while ($rf = mysql_fetch_array($select)) {
									
							?>
							
											<option value="<?php echo $rf['Codigo']; ?>" <?php if($codEmpresa == $rf['Codigo']){ echo "selected='selected'"; }  ?> ><?php echo(utf8_encode($rf['Nome'])); ?></option>
							
							<?php 
										
									}
						
								}
								
							
							?>
							
							</select>
														
														
							<input type="button" onclick="addCertificadores();" name="btn_acrescentarEmpresa" value="" id="bt_empresaPlus">
													
							
							<!-- 				
							
								CASO DESEJAR CADASTRAR UM NOVO CERTIFICADOR
							
								<input type="text" name="txt_nomeCertificador" class="cx_texto2" id="cadEmpresa_tit21Cpl">
											
								<input type="button" name="btn_acrescentarCertf" onclick="cadastrar('certificadores','cadastrar','');" value="" id="bt_empresaPlus2">
							
								<input type="button" name="btn_retornarCertf" onclick="consultar('certificadores',0,'-');" value="" id="bt_empresaPlus3">
								
							 -->				
					</div>					
					
					<span id="cadEmpresa_tit22" class="texto"><?php echo(utf8_encode('Data Prevista para execu��o:')); ?></span>				
										
					<select <?php if($statusAgend != 'AGENDAMENTO AGUARDANDO CONFIRMA��O'){ echo 'disabled="disabled"'; } ?> class="cx_texto2" id="cadEmpresa_tit22Cpl" name="cmb_dia">
					
					<?php 
					
						for ($i=1;$i<32;$i++) {
					
							
					?>
						
							<option value="<?php if($i < 10){ echo "0".$i; }else{ echo $i; } ?>" <?php if (isset($dia)) { if ($dia == $i) { echo "selected"; } } ?> ><?php if($i < 10){ echo "0".$i; }else{ echo $i; } ?></option>													
							
					<?php 
					
						}
													
					
					?>						
						
					</select>
					
					
					<select <?php if($statusAgend != 'AGENDAMENTO AGUARDANDO CONFIRMA��O'){ echo 'disabled="disabled"'; } ?> class="cx_texto2" id="cadEmpresa_tit23Cpl" name="cmb_mes">
							
					<?php

						$meses = array("JANEIRO","FEVEREIRO","MAR�O","ABRIL","MAIO","JUNHO","JULHO","AGOSTO","SETEMBRO","OUTUBRO","NOVEMBRO","DEZEMBRO");

						for ($i=1;$i<=12;$i++) {

					?>
					
							<option value="<?php if($i < 10){ echo "0".$i; }else{ echo $i; } ?>" <?php if (isset($mes)) { if ($mes == $i) { echo "selected"; } } ?> ><?php echo $meses[$i-1]; ?></option>													
					
					
					<?php 

						}
						
					?>
							
					</select>
					
					
					<select <?php if($statusAgend != 'AGENDAMENTO AGUARDANDO CONFIRMA��O'){ echo 'disabled="disabled"'; } ?> class="cx_texto2" id="cadEmpresa_tit24Cpl" name="cmb_ano">
								
					<?php 
					
						for($i=2017;$i<=2050;$i++) {
					
					?>
										
							<option value="<?php echo $i; ?>"<?php if (isset($ano)) { if ($ano == $i) { echo "selected"; } } ?> ><?php echo $i; ?></option>													
										
					<?php 
					
						}
					
					?>
				
					</select>
				
					<span id="cadEmpresa_tit23" class="texto"><?php echo(utf8_encode('Status do agendamento:')); ?></span>
					
					<span id="cadEmpresa_tit26Cpl" class="texto"><?php echo(utf8_encode($statusAgend)); ?></span>
					
					<span id="cadEmpresa_tit24" class="texto"><?php echo(utf8_encode('Tipo do agendamento:')); ?></span>
					
					<select <?php if($statusAgend != 'AGENDAMENTO AGUARDANDO CONFIRMA��O'){ echo 'disabled="disabled"'; } ?> name="cmb_tipoAgend" id="cadEmpresa_tit27Cpl" class="cx_texto2">
					
						<option value="MANUTENCAO" <?php if($tipoAgend == "MANUTENCAO"){ echo "selected='selected'"; } ?> ><?php echo(utf8_encode('CALIBRAC�O')); ?></option>
						
						<option value="VERIFICACAO" <?php if($tipoAgend == "VERIFICACAO"){ echo "selected='selected'"; } ?> ><?php echo(utf8_encode('CHECAGEM INTERMEDI�RIA')); ?></option>
						
						<option value="CALIBRACAO" <?php if($tipoAgend == "CALIBRACAO"){ echo "selected='selected'"; } ?> ><?php echo(utf8_encode('CALIBRA��O')); ?></option>
					
					</select>
					
					<?php 
					
						if ($statusAgend == 'AGENDAMENTO AGUARDANDO CONFIRMA��O') {
					
					?>					
							<input type="submit" class="subtitulo2" id="bt_cadastrou" name="btn_atualizar" value="Confirmar" />
					
					<?php 
					
						}
						else {
					
					?>
							<input type="submit" class="subtitulo2" id="bt_cadastrou" name="btn_resultados" value="Resultados" />
					
					<?php 
					
						}
					
					?>
					
					<input type="submit" class="subtitulo1" id="bt_excluou" name="btn_cancelar" value="Cancelar Agendamento" />
					
					<input type="submit" class="subtitulo1" id="bt_volt" name="btn_voltConsulta" value="Voltar a consulta" />
				
				</form>
				
				</div>										

		</div>


	</body>


</html>