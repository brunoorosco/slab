<?php

	//ARQUIVO DE CONEXÃƒÆ’Ã†â€™O COM O BANCO DE DADOS
	include("../../php/conexao.php");
	
	include("../php/funcoes.php");

	
	//CHECAR SE FOI REALIZADA A CONEXÃƒÆ’Ã†â€™O DO USUÃƒÆ’Ã¯Â¿Â½RIO
	conexaoUsuario();

	
	//DEFININDO UM NOVO AGENDAMENTO

	if (isset($_GET['novoAgend'])) {

		unset($_SESSION['CODUPDAGENDEQUIP']);

	}

	//-----------------------------
	
	
	//GERANDO UM NÃšMERO AUTOMÃ�TICO QUE DEFINE O CÃ“DIGO DO AGENDAMENTO
	
	if (!isset($_SESSION['CODAGENDAMENTO'])) {
		
		$mes = date('m');
		$ano = date('y');
		$naleatorio = rand(50,5000); //GERANDO UMA NUMERAÃ‡ÃƒO ALEATÃ“RIA
		
		$_SESSION['CODAGENDAMENTO'] = $naleatorio.$mes.$ano;
		
	}
	
	//---------------------------------------------------------------
	
	
	//VERIFICANDO SE ESTÃ� ACONTECENDO UM NOVO CADASTRO OU ATUALIZAÃ‡ÃƒO
	//VARIÃ�VEL - $verificador ; PARAMS - 1 PARA CADASTRAR 2 PARA EDITAR
	
	
	//INSERINDO DADOS PARA FAZER O AGENDAMENTO A PARTIR DO CRONOGRAMA
	if (isset($_GET['agendar'])) {
		
		unset($_SESSION['CODUPDAGENDEQUIP']);
		
		$codCompCalibr = ($_GET['agendar']);
		
		$sql = "Select equipamentos.Codigo as 'CodEquip', equipamentos.Nome as 'NomeEquipamento', servicos.Codigo as 'CodServico', servicos.Nome as 'NomeServico', itemcalibracao.Codigo as 'CodItem', itemcalibracao.Nome as 'NomeItem' from equipamentos, compcalibrserv, servicos, itemcalibracao where compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and compcalibrserv.Codigo = $codCompCalibr";
		
		$select = mysql_query($sql);
		
		$verificador = "sim";
		
		if($rf = mysql_fetch_array($select)) {
			
			$codEquip = $rf['CodEquip'];
			$codItem = $rf['CodItem'];
			$nomeItem = $rf['NomeItem'];
			$codServico = $codCompCalibr;
			$nomeServico = $rf['NomeServico'];	
			
		}
		
	}
	//----------------------------------

	
	//REALIZANDO O AGENDAMENTO PARA O EQUIPAMENTO
	
	//IMPORTANTE::::: SOBRE O STATUS DOS AGENDAMENTOS
	// 0 - AGENDADO  1 - CANCELADO  2 - REALIZADO
	if ((isset($_POST['btn_agendar']))||(isset($_POST['btn_upd']))) {
		
		//CAPTURANDO OS DADOS INSERIDOS PELO USUÃ�RIO
		$codEquipamento = ($_POST['cmb_equipamentos']);
		$codTipo = ($_POST['cmb_tipo']);
		$ano = ($_POST['cmb_ano']);
		$mes = ($_POST['cmb_mes']);
		$dia = ($_POST['cmb_dia']);
		$empresaResp = ($_POST['cmb_emprResp']);
		$tecnicoResp = ($_POST['cmb_tecResp']);
		$itemEquip = ($_POST['rd_itemEquip']);
		$codCalibrServ = ($_POST['rd_servEquip']);

		
		if (($itemEquip != "")||($servEquip != "")) {
		
				if (isset($_SESSION['CODUPDAGENDEQUIP'])) {
					$codAgend = $_SESSION['IDAGEND'];
				}
				else {
					$codAgend = $_SESSION['CODAGENDAMENTO'];
				}
		
				$dataPr = $ano."-".$mes."-".$dia;
				
				if ($codTipo == 1) {
					
					$cdtp = 2;
					$tipoAgenda = "MANUTENCAO";
					
				}
		
				if ($codTipo == 2) {
					
					$cdtp = 1;
					$tipoAgenda = "CALIBRACAO";
				}
		
		
				if ($codTipo == 3) {
					
					$cdtp = 1;
					$tipoAgenda = "VERIFICACAO";
				}
				
		
				//-----------------------------------------
				
				//REALIZANDO O CADASTRO NO BANCO DE DADOS
				if (!isset($_SESSION['CODUPDAGENDEQUIP'])) {					
					
					//INFORMANDO A TABELA E OS DADOS QUE SERÃƒO INSERIDOS NO BANCO
					$tabela = "agendcalibrmanut";
					$campos = "CodAgendamento, CodCompCalibrServ, DataPrev, DataExec, CodEmpresa, CodTecnico, NomeEmprTecGambi, Local, AnalCritica, TipoAgend, Status, DataPrevCalend";
					$valores = "$codAgend, $codCalibrServ, '$dataPr', '1111-11-11', $empresaResp, $tecnicoResp, '', '', '', '$tipoAgenda',0, '1111-11-11'";
						
					//-----------------------------------------------------------
					
					//CHAMANDO A FUNÃ‡ÃƒO QUE FAZ O CADASTRO DAS INFORMAÃ‡Ã•ES
					inserir($tabela, $campos, $valores);
					
					
				} //ATUALIZAR O REGISTRO NO BANCO DE DADOS
				else {
				
					$codMarc = ($_SESSION['CODUPDAGENDEQUIP']);
		
					$sql = "Update agendcalibrmanut set CodAgendamento=$codAgend, CodItem=$codItem, DataPrev='$dataPr', DataExec='1111-11-11', CodEmpresa=0, CodTecnico=0, NomeEmprTecGambi='$responsavel', Local='', Resultado='', TipoAgend='$tipoAgenda', Status=0 where Codigo = $codMarc";
		
					mysql_query($sql);
					
					unset($_SESSION['CODUPDAGENDEQUIP']);
					
				}
	
			//EXIBINDO MENSAGEM DE REGISTRO AO USUÃ�RIO
?>

					<script type="text/javascript">
			
						alert('AGENDAMENTO REALIZADO COM SUCESSO!');
			
					</script>

<?php
		
		
				//QUEBRANDO A VARIÃ�VEL DE SESSÃƒO COM O CÃ“DIGO DO AGENDAMENTO
				unset($_SESSION['CODAGENDAMENTO']);
				unset($_SESSION['IDAGEND']);
				
				
				//REDIRECIONANDO PARA A TELA DAS CONSULTAS DOS AGENDAMENTOS
				header("location:../consulta");
				
		}
		else{
?>
			
			<script type="text/javascript">
			
				alert('SELECIONE UMA GRANDEZA PARA O EQUIPAMENTO!');
			
			</script>
			
	
<?php 		
		}
		
	}

	//RECEBENDO DADOS PARA REALIZAR UM AGENDAMENTO
	//CONDIÃ‡ÃƒO PARA CASOS QUE SERÃ� FEITO UM AGENDAMENTO NOVO DE UM ITEM SELECIONADO OU EDITAR ALGUM REGISTRO FEITO
	if (isset($_GET['agend'])) {

		$codAgend = ($_GET['agend']); 
		$codItemCalibracao = ($_GET['cod']);
		
		//REALIZAR AGENDAMENTO DE ITEM SELECIONADO
		if ($codAgend == 1) {

			if (isset($_SESSION['CODUPDAGENDEQUIP'])) {

				unset($_SESSION['CODUPDAGENDEQUIP']);
			}
			
 			$sql = "Select itemcalibracao.Tipo, itemcalibracao.Nome as 'nCalibracao', itemcalibracao.CodEquipamento from itemcalibracao where itemcalibracao.Codigo = $codItemCalibracao";		
		
			$select = mysql_query($sql);
		
			if ($rf = mysql_fetch_array($select)) {
	
				$codEquip = $rf['CodEquipamento'];
				$nomeItem = $rf['nCalibracao'];
				$codTp = $rf['Tipo'];
	
			}

		}

		//EDITAR UM AGENDAMENTO REALIZADO
		if ($codAgend == 0) {

			$codAg = ($_GET['codA']);

			$sql = "Select agendcalibrmanut.CodItem, agendcalibrmanut.TipoAgend, agendcalibrmanut.DataPrev, agendcalibrmanut.NomeEmprTecGambi, agendcalibrmanut.CodAgendamento, itemcalibracao.Tipo, itemcalibracao.Nome as 'nCalibracao', itemcalibracao.CodEquipamento  from itemcalibracao, agendcalibrmanut where agendcalibrmanut.CodItem = itemcalibracao.Codigo and agendcalibrmanut.Codigo = $codAg";
			
			$select = mysql_query($sql);

			$_SESSION['CODUPDAGENDEQUIP'] = $codAg;

			if ($rf = mysql_fetch_array($select)) {

				$codItemCalibracao = $rf['CodItem'];
				$codEquip = $rf['CodEquipamento'];
				$nomeItem = $rf['nCalibracao'];
				$codTp = $rf['Tipo'];
				$tpAgend = $rf['TipoAgend'];
				$nomeEmpr = $rf['NomeEmprTecGambi'];
				$idAgend = $rf['CodAgendamento'];
				$dat = $rf['DataPrev'];
				
				$_SESSION['IDAGEND'] = $idAgend;

			}
			
			//CORTANDO A STRING COM A DATA
			$dia = substr($dat,8,2);
			$mes = substr($dat,5,2);
			$ano = substr($dat,0,4);

		}

		$verificador = "mod";

	}
	else {

		if (isset($_SESSION['CODUPDAGENDEQUIP'])) {

			unset($_SESSION['CODUPDAGENDEQUIP']);
			unset($_SESSION['IDAGEND']);
		}

	}
	
?>

<html>


	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		
		<title>S-LAB :: Cadastro de equipamentos</title>

		<!-- ARQUIVOS CSS IMPORTADOS -->
		
			<link rel="stylesheet" type="text/css" href="../../styles/modular.css">
			<link rel="stylesheet" type="text/css" href="../../styles/cadEquipamentosAgend.css">
			
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


	<body>

		

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
					
					<form id="form_Agend" name="frm_agendamento" action="index.php" method="post">
					
					<span class="subtitulo2" id="ini_tit4">Agendamento de calibrações/verificações/manutenções de equipamentos</span>
					
					
					<!-- FILTRO DE AGENDAMENTOS -->
					
					
						<span id="cadEmpresa_tit16" class="texto">Código do agendamento:</span>
						
						<span id="cadEmpresa_tit17" class="texto"><?php if(isset($_SESSION['CODUPDAGENDEQUIP'])){ echo $_SESSION['IDAGEND']; }else{ echo $_SESSION['CODAGENDAMENTO']; } ?></span>
						
												
					
						<span id="cadEmpresa_tit1" class="texto">Nome do equipamento</span>
						
						
						<select class="cx_texto2" id="cmb_SolicitacaoV" name="cmb_equipamentos" onchange="consultar('itensEquipAgend',0,'unico');">
							
							<?php 
							
								$sql = "Select Codigo, Nequipamento, Nome from equipamentos where Status = 0 order by Nequipamento asc";
							
								$select = mysql_query($sql);
															
								while ($rf = mysql_fetch_array($select)) {
							?>
									
									<option <?php if(isset($verificador)){ if($codEquip == $rf['Codigo']) { echo "selected=selected"; }  } ?> value="<?php echo $rf['Codigo']; ?>" <?php if (isset($verificador)) { if ($codEquip == $rf['Codigo']) { echo "selected"; } } ?>><?php echo $rf['Nequipamento']." - ".$rf['Nome']; ?></option>
							
							<?php 
							
								}					
							
							?>						
							
						</select>
						
						
						<span id="cadEmpresa_titep1" class="texto">Tipo do agendamento</span>
						
						
						<select class="cx_texto2" id="cmb_SolicitacaoVEP" name="cmb_tipo" onchange="consultar('itensEquipamentoAgend', 0, '');">

							<option value="1" <?php if ($codTp == 2){ echo "selected"; } ?>>MANUTENÇÃO</option>
							
							<option value="2" <?php if(isset($tpAgend)){ if ($tpAgend == "CALIBRAÇÃO"){ echo "selected"; } }else{ if ($codTp == 1){ echo "selected"; } } ?>>CALIBRAÇÃO</option>
							
							<option value="3" <?php if(isset($tpAgend)){ if ($tpAgend == "VERIFICAÇÃO"){ echo "selected"; } }else{ if ($codTp == 1){ echo "selected"; } } ?>><?php echo(utf8_encode('CHECAGEM INTERMEDI�RIA')); ?></option>
							
						</select>
										
												
					<!-- --------------------------------- -->
											
					
					<!-- TABELA DE AGENDAMENTOS REALIZADOS -->
					
					<span id="cadEmpresa_tit27" class="texto">Item do equipamento</span>
										
					<div id="tabelaItensEquip">
						
						<?php

							if (isset($verificador)) {

						?>
								<table class='texto3' id='tabelaEquipamentos'>
	
									<tr>
			
										<td id='linha1_tabelaItensEquip'><input type='radio' name='rd_itemEquip' value="<?php echo $codItem; ?>" checked="checked"></td>									
										<td id='linha2_tabelaItensEquip'><?php echo $nomeItem; ?></td>
	
									</tr>
	
								</table>

						<?php 

							}

						?>
						
					</div>
					
					<span id="cadEmpresa_tit27_sup" class="texto">Serviços a realizar no equipamento</span>					
					
					<div id="tabelaServicos">
					
						<?php

							if (isset($verificador)) {

						?>
								<table class='texto3' id='tabelaServicosEquip'>
	
									<tr>
			
										<td id='linha1_tabelaItensEquip'><input type='radio' name='rd_servEquip' value="<?php echo $codServico; ?>" checked="checked"></td>									
										<td id='linha2_tabelaItensEquip'><?php echo $nomeServico; ?></td>
	
									</tr>
	
								</table>

						<?php 

							}

						?>
						
					</div>
					
					<!-- ------------------------------------------ -->
					
					<span id="cadEmpresa_tit3" class="texto">Data prevista</span>
						
						
					<select class="cx_texto2" id="cmb_SolicitacaoVEP1" name="cmb_dia">
					
					<?php 
					
						for ($i=1;$i<32;$i++) {
					
							
					?>
						
							<option value="<?php if($i < 10){ echo "0".$i; }else{ echo $i; } ?>" <?php if (isset($verificador)) { if ($dia == $i) { echo "selected"; } } ?> ><?php if($i < 10){ echo "0".$i; }else{ echo $i; } ?></option>													
							
					<?php 
					
						}
													
					
					?>
					
						
						
					</select>
											
						
					<select class="cx_texto2" id="cmb_SolicitacaoVEP2" name="cmb_mes">
							
					<?php 
					
						$meses = array("JANEIRO","FEVEREIRO","MARÇO","ABRIL","MAIO","JUNHO","JULHO","AGOSTO","SETEMBRO","OUTUBRO","NOVEMBRO","DEZEMBRO");
											
						for ($i=1;$i<=12;$i++) {
					
					?>	
					
							<option value="<?php if($i < 10){ echo "0".$i; }else{ echo $i; } ?>" <?php if (isset($verificador)) { if ($mes == $i) { echo "selected"; } } ?> ><?php echo $meses[$i-1]; ?></option>													
					
					
					<?php 
					
						}
						
					?>
							
					</select>
					
					
					<select class="cx_texto2" id="cmb_SolicitacaoVEP3" name="cmb_ano">
								
					<?php 
					
						for($i=2017;$i<=2050;$i++) {
					
					?>
					
					
							<option value="<?php echo $i; ?>" <?php if (isset($verificador)) { if ($ano == $i) { echo "selected"; } } ?> ><?php echo $i; ?></option>													
					
					
					<?php 
					
						}
					
					?>
												
					</select>
					
										
					<span id="cadEmpresa_tit4" class="texto">Técnico responsável</span>
					
					<select id="cx1_CadEmpresas" class="cx_texto2" name="cmb_tecResp">
					
						<option value="0">NENHUM</option>
					
					<?php 
					
						$sql = "Select Codigo, Nome from funcionarios where Status = 0";
					
						$select = mysql_query($sql);
						
						while ($rf = mysql_fetch_array($select)) {
					
					?>
					
							<option value="<?php echo $rf['Codigo']; ?>"><?php echo $rf['Nome']; ?></option>					
					
					<?php 
					
						}					
					
					?>
										
					</select>
					
					<span id="cadEmpresa_tit4_sup" class="texto">Empresa responsável</span>
				
					<select id="cx1_CadEmpresas_sup" class="cx_texto2" name="cmb_emprResp">
					
						<option value="0">NENHUM</option>
					
					<?php 
					
						$sql = "Select Codigo, Nome from certificadores where Status = 0";
					
						$select = mysql_query($sql);
						
						while ($rf = mysql_fetch_array($select)) {
						
					?>
					
							<option value="<?php echo $rf['Codigo']; ?>"><?php echo $rf['Nome']; ?></option>
					
					<?php

						}

					?>

					</select>
				
					<div id ="divBotao">
							<?php
								
								if (!isset($_SESSION['CODUPDAGENDEQUIP'])) {
								
							?>
									<input type="submit" class="subtitulo2" id="bt_cadastrou" name="btn_agendar" value="Agendar" />
							<?php
								
								}
								else 
								{
							?>

									<input type="submit" class="subtitulo2" id="bt_cadastrou" name="btn_upd" value="Atualizar" />
									
									

							<?php

								}

							?>
							<input type="hidden" name="txt_cad" />
							
					</div>
					
				
				
					</form>
				
				</div>										

		</div>


	</body>


</html>