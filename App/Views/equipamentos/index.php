<?php

	//ARQUIVO DE CONEXÃƒÆ’Ã†â€™O COM O BANCO DE DADOS
	include("../php/conexao.php");

	//FUNÃƒÆ’Ã¢â‚¬Â¡ÃƒÆ’Ã¢â‚¬Â¢ES MODULARES DO SISTEMA
	include("../php/modular.php");
	
	include("php/funcoes.php");

	
	//CHECAR SE FOI REALIZADA A CONEXÃƒÆ’Ã†â€™O DO USUÃƒÆ’Ã¯Â¿Â½RIO
	conexaoUsuario();
	
	
	//VARIÃ�VEIS UTILIZADAS PARA ESTABELECER A PAGINAÃ‡ÃƒO INICIAL, OU SEJA, SEM AJAX
	$numeroMK = 1;
	$paginador = 0;
	
	
	if (isset($_POST['btn_buscar_nome'])) {
		
		$numeroEquipamento = ($_POST['txt_buscarNome']);		
		
		if ($numeroEquipamento == "") {
		
			$selectEsp = "pass";
		}
		else{
			
			$sql = "Select Codigo, Nome, Nequipamento from equipamentos where status = 0 and Nequipamento = '$numeroEquipamento'";
			
			$selectEsp = mysqli_query($con,$sql);
			
			if ($rfEsp = mysqli_fetch_array($selectEsp)) {
			
				$nomeBusca = $rfEsp['Nome'];
				$nseqBusca = $rfEsp['Nequipamento'];
				$codBusca = $rfEsp['Codigo'];
				
			}
			
			
		}
		
	}
	
	
	//CONTANDO O NÃšMERO DE PÃ�GINAS DE EQUIPAMENTOS
	$sql = "Select COUNT(*) from equipamentos where Status = 0";
	
	
	$select = mysqli_query($con,$sql);
	
	if ($rf = mysqli_fetch_array($select)) {
	
		$quantidadeRegistros = $rf['COUNT(*)'];
	}
	
	$npaginas = ($quantidadeRegistros/6);
	
	//ARREDONDANDO QUANTIDADE DE REGISTROS PARA CIMA PARA GERAR O NÃƒÆ’Ã…Â¡MERO DE PÃƒÆ’Ã¯Â¿Â½GINAS CORRETO
	$totalPaginasEquip = ceil($npaginas);
	//-------------------------------------------
	
	
	//CONTANDO O NÃšMERO DE PÃ�GINAS DE ITENS DE EQUIPAMENTOS
	$sql = "Select COUNT(*) from itemcalibracao where Status = 0";
	
	
	$select = mysqli_query($con,$sql);
	
	if ($rf = mysqli_fetch_array($select)) {
	
		$quantidadeRegistros = $rf['COUNT(*)'];
	}
	
	$npaginas = ($quantidadeRegistros/7);
	
	//ARREDONDANDO QUANTIDADE DE REGISTROS PARA CIMA PARA GERAR O NÃƒÆ’Ã…Â¡MERO DE PÃƒÆ’Ã¯Â¿Â½GINAS CORRETO
	$totalPaginasItens = ceil($npaginas);
	//-------------------------------------------	
	
	
	//REALIZANDO UMA PESQUISA ESPECÃƒÆ’Ã¯Â¿Â½FICA
	
		
	//---------------------------------	
	
	//FINALIZAR CONEXÃƒÆ’Ã†â€™O
	if (isset($_GET['sair'])) {
		
		unset($_SESSION['USUARIO']);
		unset($_SESSION['CODUSUARIO']);
		
		header("location:../index.php");
	}
	
	
	//CONSULTAR O REGISTRO DA TABELA
	
	if (isset($_GET['editar'])) {
		
		$codigo = ($_GET['editar']);
		
		$sql = "Select * from equipamentos where Codigo = $codigo";
		$select = mysqli_query($con,$sql);
		
		//CAPTURANDO OS DADOS DA CONSULTA DO BANCO DE DADOS
		if ($rf = mysqli_fetch_array($select)) {
			
			$nome = $rf['Nome'];
			$fabricante = $rf['Fabricante'];
			$resolucao = $rf['Resolucao'];
			$faixaNominal = $rf['FaixaNominal'];
			$tolerancia = $rf['Tolerancia'];
			$local = $rf['Local'];
			$pontosMinimos = $rf['PontosMinimos'];
			$descricao = $rf['Descricao'];
		
			
			//ALGORITMO PARA DEFINIR A PERFUMARIA DE CÃƒÆ’Ã¢â‚¬Å“DIGO DE CLIENTE
			if ($codCliente <= 9) {
				
				$codCliente = "000".$codCliente;
			}
			elseif (($codCliente >= 10)&&($codCliente <=99)) {
				
				$codCliente = "00".$codCliente;				
			}
			elseif (($codCliente >= 100)&&($codCliente <= 999)) {
				
				$codCliente = "0".$codCliente;
			}
			// --------------------------------------------------------	
		
		}	
		
		$_SESSION['CODUPDT'] = $rf['Codigo'];
		
	}
	
	// ------------------------------------




	

?>

<html>


	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		
		<title>S-LAB :: Cadastro de equipamentos</title>

		<!-- ARQUIVOS CSS IMPORTADOS -->
		
			<link rel="stylesheet" type="text/css" href="../styles/modular.css">
			<link rel="stylesheet" type="text/css" href="../styles/cadEquipamentos.css">
			
		<!--------------------------->

		<!-- ARQUIVOS JAVASCRIPT -->
					
			<script type="text/javascript" src="../js/jquery.js"></script>		
			<script type="text/javascript" src="../js/mascara.js"></script>
			<script type="text/javascript" src="../js/modular.js"></script>
			<script type="text/javascript" src="js/validacao.js"></script>
			<script type="text/javascript" src="js/funcoes.js"></script>
		
		<!-- ------------------ -->

		<!-- VALIDAÃƒÆ’Ã¢â‚¬Â¡ÃƒÆ’Ã†â€™O DO FORMULÃƒÆ’Ã¯Â¿Â½RIO -->

		
		<script type="text/javascript">
			


				    

			
		</script>


		<!-- ---------------------- -->

	</head>


	<body onload="limpaDiv();">

		

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
								
								<li><a href="relatorios/index.php" class="lk_lista"><?php echo(utf8_encode('Relat�rios')); ?></a></li>
								
							</ul>
							
							<ul class="listas" id="ini_lst2" type="square">
								
								<li><a href="#" class="lk_lista">Equipamentos</a></li>
								<li><a href="unidades/" class="lk_lista">Unidades/Grandezas</a></li>
								<li><a href="agendamento/" class="lk_lista">Agendamentos</a></li>
								<li><a href="analiseCritica/" class="lk_lista"><?php echo(utf8_encode('Fazer an�lise cr�tica')); ?></a></li>
								<li><a href="cronograma/" class="lk_lista"><?php echo(utf8_encode('Planejar cronograma')); ?></a></li>
								
							</ul>
						
						<!-- --------------------- -->
						
						<!-- OPÃƒÆ’Ã¢â‚¬Â¡ÃƒÆ’Ã¢â‚¬Â¢ES PARA CONSULTAS -->
							
							<ul class="listas" id="ini_lst3" type="square">
								
								<li><a href="consulta/" class="lk_lista">Consultar agendamento</a></li>
								<li><a href="alertas/" class="lk_lista">Alertas e avisos</a></li>
								<li><a href="analiseCritica/consulta.php" class="lk_lista"><?php echo(utf8_encode('Hist�rico de equipamentos')); ?></a></li>
								
							</ul>
						
						<!-- --------------------- -->
						
					</div>
				
				<!-- ----------------- -->
			
				<!-- CADASTRO DE EMPRESAS -->


				<div id="cont2">
					
					<form id="form_cadEmpresas" name="frm_equipamentos" action="index.php" method="post">
					
					<span class="subtitulo2" id="ini_tit4">Cadastramento de equipamentos</span>
					
					<!-- FORMULÃƒÆ’Ã¯Â¿Â½RIO DE CADASTRO DE EQUIPAMENTO -->
					
					<span id="cadEmpresa_tit1" class="texto">Selecione um equipamento ou adicione um novo</span>
												
						<div id="comboEquipamentos">
						
							<select name="cmb_equipamento" class="cx_texto2" id="cx1_CadEmpresas" onchange="consultar('equipamentos',0,'unico');">
							
							<?php
							
								$sql = "Select Codigo, Nome, Nequipamento from equipamentos where status = 0 order by Nequipamento asc";
								
								$select = mysqli_query($con,$sql);
								
								while ($rf = mysqli_fetch_array($select)) {
							
							?>
							
									<option value="<?php echo $rf['Codigo']; ?>"><?php echo ($rf['Nequipamento']." - ".$rf['Nome']); ?></option>
							
							<?php
							
								}
							
							?>
							
							</select>
						
						</div>
						
						<input type="button" name="btn_novo" id="btn_inserir" value="Novo" onclick="bloq('nao','sim');">
																		
						<span id="cadEmpresa_tit2" class="texto"><?php echo(utf8_encode('N�mero do equipamento')); ?></span>
					
						<input type="text" name="txt_nquipamento" onclick="cor(this);" maxlength="100" disabled="disabled" class="cx_texto2" id="cx2_CadEmpresas" value="<?php if(isset($fabricante)) { echo $fabricante; } ?>" />
					
						<span id="cadEmpresa_tit3" class="texto">Nome do equipamento</span>
					
						<input type="text" name="txt_nomeEquip" onclick="cor(this);" maxlength="500" disabled="disabled" class="cx_texto2" id="cx3_CadEmpresas" value="<?php if(isset($descricao)) { echo $descricao; } ?>" />
					
						<span id="cadEmpresa_tit4" class="texto">Fabricante</span>
						
						<input type="text" name="txt_fabricante" onclick="cor(this);" class="cx_texto2" disabled="disabled" id="cx4_CadEmpresas" value="<?php if(isset($resolucao)) { echo $resolucao; } ?>" />
					
						<span id="cadEmpresa_tit6" class="texto"><?php echo(utf8_encode('Descri��o')); ?></span>
					
						<input type="text" name="txt_descricao" onclick="cor(this);" maxlength="100" disabled="disabled" class="cx_texto2" id="cx6_CadEmpresas" value="<?php if(isset($faixaNominal)) { echo $faixaNominal; } ?>" />
						
						<span id="cadEmpresa_tit7" class="texto">Local</span>
					
						<select name="txt_local" disabled="disabled" class="cx_texto2" id="cx7_CadEmpresas">
						
							<option value="FISICO"><?php echo(utf8_encode('LABORAT�RIO F�SICO')); ?></option>
							<option value="COSTURA"><?php echo (utf8_encode('LABORAT�RIO DE COSTURA')); ?></option>
							<option value="QUIMICO"><?php echo (utf8_encode('LABORAT�RIO QU�MICO')); ?></option>
							<option value="FLAMABILIDADE"><?php echo (utf8_encode('LABORAT�RIO DE FLAMABILIDADE')); ?></option>
							<option value="TOXICIDADE"><?php echo (utf8_encode('LABORAT�RIO DE TOXICIDADE')); ?></option>
							<option value="LAVANDERIA"><?php echo (utf8_encode('LAVANDERIA')); ?></option>
						
						</select>
					
						
						<span class="texto" id="cadEmpresa_tit40"><?php echo(utf8_encode('Patrim�nio')); ?></span>
					
						<input type="text" id="cx30_CadEmpresas" name="txt_patrimonio" disabled="disabled" class="cx_numeros">
						
						<span class="texto" id="cadEmpresa_tit35">Faixa nominal do equipamento</span>
					
						<span class="texto" id="cadEmpresa_tit36"><?php echo(utf8_encode('Toler�ncia do equipamento')); ?></span>
						
						<span class="texto" id="cadEmpresa_tit38"><?php echo(utf8_encode('Resolu��o do equipamento')); ?></span>
						
						<span class="texto" id="cadEmpresa_tit39"><?php echo(utf8_encode('Data de incorpora��o')); ?></span>
						
						<span class="texto" id="cadEmpresa_tit41">Data inicial do uso</span>
						
						<span class="texto" id="cadEmpresa_tit42">Fora de uso?</span>
						
						<span class="texto" id="cadEmpresa_tit48">Dentro do escopo?</span>
						
						<span class="texto" id="cadEmpresa_tit49">Sim</span>
						
						<span class="texto" id="cadEmpresa_tit50"><?php echo(utf8_encode('N�o')); ?></span>
						
						
						<input type="radio" id="cx31_CadEmpresasModul" value="SIM" name="chk_escopo">
						
						<input type="radio" id="cx32_CadEmpresasModul" value="NAO" name="chk_escopo">
						
												
						<span class="texto" id="cadEmpresa_tit45"><?php echo(utf8_encode('Periodicidade de calibra��o (Em meses)')); ?></span>
						
						<span class="texto" id="cadEmpresa_tit46"><?php echo(utf8_encode('Periodicidade de manuten��o (Em meses)')) ?></span>
						
						<span class="texto" id="cadEmpresa_tit47"><?php echo(utf8_encode('Periodicidade de checagem intermedi�ria (Em meses)')) ?></span>
						
						<input type="checkbox" name="chk_foraUso" id="cadEmpresa_tit43" value="1">				
												
						<input type="text" name="data_incorp" id="cx32_CadEmpresas" disabled="disabled" class="cx_data">						
						
						<input type="text" name="data_iniUso" id="cx33_CadEmpresas" disabled="disabled" class="cx_data">
						
						<input type="text" name="data_foraUso" id="cx34_CadEmpresas" disabled="disabled" class="cx_data">			
						
						<input type="text" id="cx24_CadEmpresas" name="txt_faixaNominal" disabled="disabled" class="cx_texto1">
						
						<input type="text" id="cx25_CadEmpresas" name="txt_tolerancia" disabled="disabled" class="cx_texto1">
						
						<input type="text" id="cx27_CadEmpresas" name="txt_resolucao" disabled="disabled" class="cx_texto1">
						
						
						<input type="text" id="cx28_CadEmpresasModul" name="txt_pcalibracao" disabled="disabled" class="cx_numeros">
						
						<input type="text" id="cx29_CadEmpresasModul" name="txt_pmanut" disabled="disabled" class="cx_numeros">
						
						<input type="text" id="cx30_CadEmpresasModul" name="txt_pchecagem" disabled="disabled" class="cx_numeros">
					
					
					
						
					
					
					<!-- --------------------------------- -->			
					
					
						<div id ="divBotao">
						
						
						
					<?php
					
						
						if (!isset($_GET['editar'])) {
					
							
					?>
							
							<input type="button" onclick="cadastrar('equipamentos','cadastrar','');" class="subtitulo2" id="bt_cadastrou" name="btn_cadastrar" value="Cadastrar" />
							<!--<input type="button" onclick="validar();" class="subtitulo2" id="bt_cadastrar" name="btn_cadastrar" value="Cadastrar" /> -->
							<input type="hidden" name="txt_cad" />
					<?php
					
						}else {	
					
					?>
					
							<input type="button" onclick="cadastrar('equipamentos', 'atualizar', '');" class="subtitulo2" id="bt_cadastrou" name="btn_atualizar" value="Atualizar" />
					
							
							<a href="index.php">
								<div id="bt_ncadastro" class="subtitulo2"><span id="bt_ncadastro_compl">Novo</span></div>
							</a>
							
					
					
					<?php
					
					
						}
					
					
					?>
					
						</div>
					
					
					<!-- ////////////////////////////////////////////////////////////// -->
					
					
					
					
					<!-- ABAS COMPLEMENTARES DO CADASTRO DE EQUIPAMENTOS -->
					
					
					<input type="button" id="btn_itensCalibr" value="Itens do equipamento" onclick="abrirInterface('itensCalibracao');">
					
					<input type="button" id="btn_pontosCalibr" value="<?php echo(utf8_encode('Inserir pontos de calibra��o')); ?>" onclick="abrirInterface('pontosCalibracao');">
					
					<input type="button" id="btn_servicos" value="<?php echo(utf8_encode('Servi�os a realizar no equipamento')); ?>" onclick="abrirInterface('servicosEquipamento');">
					
					
					<!-- ////////////////////////////////////////////// -->
				
					<!-- AREA DE CADASTROS COMPLEMENTARES -->
					
					
					<div id="serv_compl">
					
				
						<!-- AREA DOS PONTOS DE CALIBRAÃ‡ÃƒO -->
					
							<div id="servicos_container">
							
								<span id="cadEmpresa_tit31" class="texto"><?php echo(utf8_encode('Selecione o equipamento que deseja adicionar pontos de calibra��o')); ?></span>
								
								<div id="comboServEquipPc">
												
									<select id="cx28_CadEmpresas" name="cmb_servicos" class="cx_texto2">
									
										<option><?php echo(utf8_encode('ESCOLHA UM ITEM DE EQUIPAMENTO NA OP��O ACIMA')); ?></option>
									
									</select>
								
								</div>
								
								<span id="cadEmpresa_tit32" class="texto"><?php echo(utf8_encode('Insira os pontos de calibra��o')); ?></span>
							
								<span id="cadEmpresa_tit33" class="texto">Valor</span>
								
								<span id="cadEmpresa_tit34" class="texto">Grandeza</span>
								
								<span id="cadEmpresa_tit34_sup" class="texto">Unidade</span>
								
								<span id="cadEmpresa_tit34_supSup" class="texto"><?php echo(utf8_encode('Toler�ncia')); ?></span>
								
								<input type="text" id="cx29_CadEmpresas" class="cx_texto1" name="txt_valor">
								
								<input type="text" id="cx29_CadEmpresas_sup" class="cx_texto1" name="txt_toleranciaPc">
							
								<div id="comboGrandezasPc">
															
									<select id="cx31_CadEmpresas" class="cx_texto1" name="cmb_grandezas">
									
										<option>NOME DA UNIDADE - REPRESENTAÃ‡ÃƒO</option>
									
									</select>
									
								</div>
								
								<div id="comboUnidadesPc">
															
									<select id="cx31_CadEmpresas_sup" class="cx_texto1" name="cmb_unidade">
									
										<option>NOME DA UNIDADE - REPRESENTAÃ‡ÃƒO</option>
									
									</select>
									
								</div>			
								
								<span id="cadEmpresa_tit31_sup" class="texto"><?php echo(utf8_encode('Selecione um tipo de servi�o:')); ?></span>
								
								<div id="comboServEquipEquipPc">
								
									<select id="cx28_CadEmpresas_sup" name="cmb_itemEquip" class="cx_texto2">
									
										<option><?php echo(utf8_encode('ESCOLHA O SERVI�O DO EQUIPAMENTO')); ?></option>
									
									</select>
								
								</div>
								
								
								<input type="button" value="Inserir" id="btn_insPontos" onclick="cadastrar('pontosCalibracao','cadastrar','');">
								
								
								<div id="tabela_pontosCalibr">
																		
									<table>
									
										<!--  
										<tr>
										
											<td id="linha1_pontosCalibr">VALOR</td>
											<td id="linha2_pontosCalibr">UNIDADE</td>
											<td id="linha4_pontosCalibr">GRANDEZA</td>
											<td id="linha5_pontosCalibr">TOLERÃ‚NCIA</td>
											<td id="linha3_pontosCalibr"><img alt="" src="../imagens/png/bt_excluirAms.png"></td>
										
										</tr>	
										-->
										
									</table>
												
								</div>
								
							
							</div>
					
						<!-- //////////////// -->


			
						<!-- AREA DE ITENS DE CALIBRAÃ‡ÃƒO -->

						
							<div id="itCalibr_container">
								
								<span id="cadEmpresa_tit31" class="texto">Item do equipamento</span>
								
								<input type="text" id="cx28_CadEmpresasSup" name="txt_itemCalibr" class="cx_texto2">
								
								<span id="cadEmpresa_tit31_supSup" class="texto">Faixa nominal do item</span>
								
								<input type="text" id="cx28_CadEmpresasSupSupSup" name="txt_itemfaixa" class="cx_texto1">
								
								<span id="cadEmpresa_tit33Sup" class="texto"><?php echo(utf8_encode('Servi�os relacionados')); ?></span>
								
								<div id="servicos_containerSelect">
								
								
									<table>
								
										<tr>
										
											<td><input type="checkbox" name="chk_servicos" value="1"></td>
											
											<td id="linha2_pontosItCalibr"><?php echo(utf8_encode('NOME DO SERVI�O')); ?></td>
										
										</tr>
									
									</table>
								
								
								</div>
								
								<div id="areaBotao">
								
									<input type="button" value="Inserir" id="btn_insItCalibr" onclick="cadastrar('itensCalibracao','cadastrar','');">
								
								</div>
																
								<div id="tabela_itCalibr">
								
									<table>
									
										<tr>
										
											<td id="linha3_pontosItCalibr"><a onclick="consultar('servicosItemCalibracao', '1', 'unico');">VALOR</a></td>
											<td id="linha4_pontosItCalibr"><input type="button" name="btn_excluirServ" onclick="" id="bt_excluirServicos" value="1"></td>
										
										</tr>	
									
									</table>							
								
								</div>
																
							</div>
							
						<!-- ////////////////////////// -->



						<!-- AREA DOS SERVIÃ‡OS -->
	
							<div id="servicos_containerServ">
							
				
									<span id="cadEmpresa_tit31" class="texto"><?php echo(utf8_encode('Nome do servi�o')); ?></span>
		
									<input type="text" id="cx28_CadEmpresasSupSup" name="txt_nomeServico" class="cx_texto2">
				
									<input type="button" value="Inserir" id="btn_insServicos" onclick="cadastrar('servicosEquipamentos','cadastrar','');">
				
									<input type="checkbox" name="chk_temPontos" id="check_temPontos" value="1">
									
									<span id="cadEmpresa_tit50" class="texto"><?php echo(utf8_encode('Esse servi�o possui pontos de calibra��o?')); ?></span>
				
									<div id="tabela_servicos">
										
										
										<table>
										
											<tr>
												
												<td id="linha2_servicos"><?php echo(utf8_encode('NOME DO SERVI�O')); ?></td>
												<td id="linha3_servicos"><input type="button" name="btn_excluirServ" onclick="" id="bt_excluirServicos" value="1"></td>
											
											</tr>
										
										</table>
										
										
									</div>
							
							</div>
	

						<!-- //////////////////////////// -->



					</div>


					<!-- /////////////////////////////// -->

				</div>

				<!-- ------------------ -->
				</form>

		</div>


	</body>


</html>