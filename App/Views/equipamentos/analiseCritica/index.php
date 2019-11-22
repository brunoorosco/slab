<?php
	
	
	//ARQUIVO DE CONEXÃƒÆ’Ã†â€™O COM O BANCO DE DADOS
	include("../../php/conexao.php");
	
	include("../php/funcoes.php");
	
	
	
	//CHECAR SE FOI REALIZADA A CONEXÃƒÆ’Ã†â€™O DO USUÃƒÆ’Ã¯Â¿Â½RIO
	conexaoUsuario();
	
	
	//CONSULTANDO AS INFORMA��ES DO EQUIPAMENTO
	if (isset($_GET['codAnalCrit'])) {
		
		$mod = ($_GET['mod']);
		$codAnalCrit = ($_GET['codAnalCrit']);
		
		$sql = "Select * from analisequipamento where Codigo = $codAnalCrit";
		
		$select = mysql_query($sql);
		
		//DADOS DA AN�LISE CR�TICA
		if ($rf = mysql_fetch_array($select)) {
			
			$liberado = $rf['Liberado'];
			$analCritica = $rf['AnaliseCritica'];
			$dataAnalCritica = dataBrasileira($rf['DataAnalise']);
			$equipamento = $rf['CodEquipamento'];
			$caminhoCert  = $rf['CaminhoCert'];
			
			//GUARDANDO O ATUAL CAMINHO DO CERTIFICADO PARA MANT�-LO CASO UM NOVO CERTIFICADO N�O SEJA SELECIONADO
			$_SESSION['CAMINHOCERT'] = $caminhoCert;
			
			//GUARDANDO O CODIGO DA AN�LISE CR�TICA
			$_SESSION['CODANALCRITIC'] = $codAnalCrit;		
			
		}
		
		
		//PEGANDO O TIPO DE AGENDAMENTO QUE FOI FEITO E O C�DIGO DOS CERTIFICADOS QUE FORAM GERADOS
		$sqlS1 = "Select agendcalibrmanut.TipoAgend, analisecertificados.CodRegCertificado from analisequipamento, agendcalibrmanut, analisecertificados, regcertificado where analisequipamento.Codigo = analisecertificados.CodAnaliseCritica and analisecertificados.CodRegCertificado = regcertificado.Codigo and regcertificado.CodAgendamento = agendcalibrmanut.Codigo and analisequipamento.Codigo = $codAnalCrit";
		
		$selectS = mysql_query($sqlS1);
		
		$codCertif = array();
		$contador = 0;
		
		while ($rfS = mysql_fetch_array($selectS)) {
			
			
			//ABASTECENDO O ARRAY COM OS C�DIGOS DOS CERTIFICADOS REGISTRADOS NA AN�LISE CR�TICA
			$codCertif[$contador] = $rfS['CodRegCertificado'];
			$tipo = $rfS['TipoAgend'];

			$contador++;
			
			
		}
		
		//GUARDANDO O C�DIGO DO REGISTRO DOS CERTIFICADOS
		$_SESSION['CODREGCERTS'] = $codCertif;
		
	}
	
	
	//REALIZANDO A PESQUISA DAS INFORMA��ES
	if (isset($_POST['btn_pesquisar'])) {
		
		//COLETANDO OS DADOS DO FORMUL�RIO
		$liberado = ($_POST['rdb_liberado']);
		$analCritica = ($_POST['txt_analCritica']);
		$dataAnalCritica = ($_POST['txt_data']);
		$equipamento = ($_POST['cmb_equipamentos']);
		$tipo = ($_POST['cmb_tipo']);		
		
	}	
	
	//NA TABELA REGCERTIFICADO, SEGUE O PADR�O DE STATUS DO N�MERO DE CERITIFICADOS:
	// 0 - CERTIFICADOS AGUARDANDO AN�LISE CR�TICA
	// 1 - CERTIFICADOS ATRIBU�DOS
	// 2 - CERTIFICADOS CANCELADOS
		
	//NA TABELA ANALISEQUIPAMENTO, SEGUE O PADR�O DE STATUS:
	// 0 - EQUIPAMENTO AGUARDANDO CONFIRMA��O DE AN�LISE
	// 1 - EQUIPAMENTO COM AN�LISE REALIZADA (SALVA DATA)
	// 2 - EQUIPAMENTO COM AN�LISE CANCELADA
	
	if ((isset($_POST['btn_registrar']))||(isset($_POST['btn_upd']))) {
		
		
		$liberado = ($_POST['rdb_liberado']);
		$analCritica = ($_POST['txt_analCritica']);
		$dataAnalCritica = dataAmericana($_POST['txt_data']);
		$equipamento = ($_POST['cmb_equipamentos']);
		$tipo = ($_POST['cmb_tipo']);
		$numCertificados = ($_POST['chk_numeroReg']);
		$quantidadeRegCert = count($numCertificados);
		
		//REALIZAR O UPLOAD DO ARQUIVO DO CERTIFICADO
		if ($_FILES['file-original']['name'] != "") {
		
			
			//CADASTRANDO INFORMAÇÕES DO ARQUIVO E SEU CAMINHO NO BANCO DE DADOS
					
			//CAMINHO DA PASTA PARA RECEBER OS ARQUIVOS ENVIADOS
			$_UP['pasta'] = "../arquivos/";
		
			//PEGANDO O NOME DO ARQUIVO A SER SALVO
			$nomeArquivo = $_FILES['file-original']['name'][0];
						
			if ($nomeArquivo != "") {
			
				//PEGANDO A EXTENSÃO DO ARQUIVO
				$extensao = pathinfo($nomeArquivo , PATHINFO_EXTENSION);
			
				//REALIZANDO O UPLOAD DO ARQUIVO
				move_uploaded_file($_FILES['file-original']['tmp_name'][0], $_UP['pasta'].$nomeArquivo);
				
			}
			else {
				
				$nomeArquivo = $_SESSION['CAMINHOCERT'];
				
			}
		
		}
		else {
			
			
			
		}
			
			
		
		//----------------------------		
		
		//VERIFICANDO SE OCORRE UM CADASTRO NOVO OU EST� CONFIRMANDO E ATUALIZANDO UMA AN�LISE DE EQUIPAMENTO
		
		if (isset($_POST['btn_registrar'])) {
		
		
			$sql = "Insert into analisequipamento (CodEquipamento, AnaliseCritica, DataAnalise, CaminhoCert, Liberado, Status) values ($equipamento, '$analCritica', '$dataAnalCritica', '$nomeArquivo', '$liberado', 0)";
			mysql_query($sql);
		
		
			$sql = "Select * from analisequipamento order by Codigo desc limit 1";		
			$select = mysql_query($sql);
		
		
			if ($rf = mysql_fetch_array($select)) {
				
				$codAnalCritica = $rf['Codigo'];
				
			}
		
		
			for($i=0; $i<$quantidadeRegCert; $i++) {
				
				
				$numeroCertificado = $numCertificados[$i];
				$sql = "Insert into analisecertificados (CodRegCertificado, CodAnaliseCritica, Status) values ($numeroCertificado, $codAnalCritica, 0)";
				mysql_query($sql);
				
				//ATUALIZANDO O STATUS DOS CERTIFICADOS VINCULADOS A AN�LISE CR�TICA REALIZADA
				$sql1 = "Update regcertificado set Status = 0 where Codigo = $numeroCertificado";
				mysql_query($sql1);
				
			}
			
			//REDIRECIONANDO PARA A P�GINA DE CONSULTAS
			header("location:consulta.php");
		
		
		}
		else {
						
			$exclCert = $_SESSION['CODREGCERTS'];
			$codAnalCrit = $_SESSION['CODANALCRITIC'];
			
			$equipamento = ($_SESSION['CDEQUIP']);			
			
			$sql = "Update analisequipamento set CodEquipamento = $equipamento, AnaliseCritica = '$analCritica', DataAnalise = '$dataAnalCritica', CaminhoCert = '$nomeArquivo', Liberado = '$liberado', Status = 1 where Codigo = $codAnalCrit";
			
			echo $sql;
			
			mysql_query($sql);
			
			$quant = count($exclCert);
			
			//EXCLUINDO O REGISTROS DOS CERTIFICADOS PARA INSER�-LOS NOVAMENTE
			for ($i=0;$i<$quant;$i++) {
				
				$sql1 = "Delete from analisecertificados where CodRegCertificado = $exclCert[$i]";
				mysql_query($sql1);
								
			}
			
			for($i=0; $i<$quantidadeRegCert; $i++) {
			
			
				$numeroCertificado = $numCertificados[$i];
				
				$sql = "Insert into analisecertificados (CodRegCertificado, CodAnaliseCritica, Status) values ($numeroCertificado, $codAnalCrit, 0)";
				mysql_query($sql);
				
				
			}
?>
				<script type="text/javascript">

					alert('AN�LISE CR�TICA REALIZADA COM SUCESSO!');
	
					window.close();
				
				</script>
				
<?php 
			
		} 
			//REDIRECIONANDO PARA A P�GINA DE CONSULTAS
			//header("location:consulta.php");
		
	}
	
		
?>

<html>


	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		
		<title>S-LAB :: Cadastro de equipamentos</title>

		<!-- ARQUIVOS CSS IMPORTADOS -->
		
			<link rel="stylesheet" type="text/css" href="../../styles/modular.css">
			<link rel="stylesheet" type="text/css" href="../../styles/cadEquipamentosAnalCrit.css">
			
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
		
				<a href="#" class="menu_rel"><?php echo('Relatórios'); ?></a>

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
						
				<span class="lk_confPessoal"><a href="#"><?php echo('Minhas configurações&nbsp;&nbsp; |'); ?></a></span>
				
				<span class="lk_confPessoal2"><a href="index.php?sair">Sair</a></span>
				
				<!-- ---------------------- -->
			
				<!-- MENU SECUNDÃƒÆ’Ã¯Â¿Â½RIO -->
				
					<div class="submenu_cont">
						
						
						<span class="subtitulo2" id="ini_tit3">Selecione um item abaixo:</span>
						
						<!-- OPÃƒÆ’Ã¢â‚¬Â¡ÃƒÆ’Ã¢â‚¬Â¢ES PARA RELATÃƒÆ’Ã¢â‚¬Å“RIOS -->
						
							
						
						<!-- ---------------------- -->
						
						<!-- OPÃƒÆ’Ã¢â‚¬Â¡ÃƒÆ’Ã¢â‚¬Â¢ES PARA CADASTROS -->
							
							<ul class="listas" id="ini_lst1" type="square">
								
								<li><a href="../relatorios/index.php" class="lk_lista"><?php echo('Relatórios'); ?></a></li>
								
							</ul>
							
							<ul class="listas" id="ini_lst2" type="square">
								
								<li><a href="../index.php" class="lk_lista">Equipamentos</a></li>
								<li><a href="../unidades/" class="lk_lista">Unidades/Grandezas</a></li>
								<li><a href="../agendamento/" class="lk_lista">Agendamentos</a></li>
								<li><a href="#" class="lk_lista"><?php echo('Fazer análise crítica'); ?></a></li>
								<li><a href="../cronograma/" class="lk_lista"><?php echo('Planejar cronograma'); ?></a></li>
								
							</ul>
						
						<!-- --------------------- -->
						
						<!-- OPÃƒÆ’Ã¢â‚¬Â¡ÃƒÆ’Ã¢â‚¬Â¢ES PARA CONSULTAS -->
							
							<ul class="listas" id="ini_lst3" type="square">
								
								<li><a href="../consulta/" class="lk_lista">Consultar agendamento</a></li>
								<li><a href="../alertas/" class="lk_lista">Alertas e avisos</a></li>
								<li><a href="consulta.php" class="lk_lista"><?php echo('Histórico de equipamentos'); ?></a></li>
								
							</ul>
						
						<!-- --------------------- -->
						
					</div>
				
				<!-- ----------------- -->
			
				<!-- CADASTRO DE EMPRESAS -->
			
				<div id="cont2">
					
					<form id="form_Agend" enctype='multipart/form-data' name="frm_agendamento" action="index.php" method="post">
					
					<span class="subtitulo2" id="ini_tit4"><?php if($mod == "CONFIRMAR") { echo('Confirme a análise crítica realizada para esse equipamento'); } if ($mod == "VER") { echo('Detalhes da análise crítica'); }  if (!isset($codAnalCrit)) { echo('Realizar análise crítica do equipamento'); } ?></span>
					
					
					<!-- FILTRO DE AGENDAMENTOS -->
					
					
						<span id="cadEmpresa_tit16" class="texto">Equipamento:</span>			
						
						<select <?php if(isset($codAnalCrit)) { echo "disabled=disabled"; } ?> class="cx_texto2" id="cmb_SolicitacaoV" name="cmb_equipamentos">
							
							<?php 
							
								$sql = "Select Codigo, Nequipamento, Nome from equipamentos where Status = 0 order by Nequipamento asc";
							
								$select = mysql_query($sql);
															
								while ($rf = mysql_fetch_array($select)) {
							?>
									
									<option <?php if(isset($equipamento)){ if($equipamento == $rf['Codigo']){ echo "selected=selected"; $_SESSION['CDEQUIP'] = $rf['Codigo']; } } ?> value="<?php echo $rf['Codigo']; ?>" <?php if (isset($verificador)) { if ($codEquip == $rf['Codigo']) { echo "selected"; } } ?>><?php echo $rf['Nequipamento']." - ".$rf['Nome']; ?></option>
							
							<?php 
							
								}					
							
							?>						
							
						</select>
						
						
						<span id="cadEmpresa_titep1" class="texto">Tipo do agendamento</span>
						
						
						<select <?php if(isset($codAnalCrit)) { echo "disabled=disabled"; } ?> class="cx_texto2" id="<?php if(isset($codAnalCrit)){ echo "cmb_SolicitacaoVEPEsp"; }else{ echo "cmb_SolicitacaoVEP"; } ?>" name="cmb_tipo">

							<option <?php if(isset($tipo)){ if($tipo == 'MANUTENCAO'){ echo "selected=selected"; } } ?> value="MANUTENCAO" <?php if ($codTp == 2){ echo "selected"; } ?>>MANUTENÇÃO</option>
							
							<option <?php if(isset($tipo)){ if($tipo == 'CALIBRACAO'){ echo "selected=selected"; } } ?> value="CALIBRACAO" <?php if(isset($tpAgend)){ if ($tpAgend == "CALIBRAÇÃO"){ echo "selected"; } }else{ if ($codTp == 1){ echo "selected"; } } ?>>CALIBRAÇÃO</option>
							
							<option <?php if(isset($tipo)){ if($tipo == 'VERIFICACAO'){ echo "selected=selected"; } } ?> value="VERIFICACAO" <?php if(isset($tpAgend)){ if ($tpAgend == "VERIFICAÇÃO"){ echo "selected"; } }else{ if ($codTp == 1){ echo "selected"; } } ?>><?php echo('CHECAGEM INTERMEDIÁRIA'); ?></option>
							
						</select>
										
												
					<!-- --------------------------------- -->
											
					
					<!-- TABELA DE AGENDAMENTOS REALIZADOS -->
					
					<?php 
					
						if(!isset($codAnalCrit)) { 
										
					?>
					
								<input type="submit" id="cadEmpresa_tit27" value="Pesquisar" name="btn_pesquisar">
					
					<?php 
					
						}
					
					?>
										
					<span id="cadEmpresa_tit3" class="texto"><?php echo('Data da análise crítica'); ?></span>
						
					<input <?php if(isset($codAnalCrit)){ if($mod == "VER") { echo "disabled=disabled"; }} ?> type="text" name="txt_data" class="cx_data" id="cx2_CadEmpresas" value="<?php if(isset($dataAnalCritica)){ echo $dataAnalCritica; } ?>" >						
					
						
					<span id="cadEmpresa_tit28" class="texto"><?php echo('Quais resultados a seguir fazem parte dessa análise crítica?'); ?></span>
						
						
					<div id="tabelaCertificado">
					
					
					<?php
					
						$sql = "Select agendcalibrmanut.CodEmpresa, agendcalibrmanut.CodTecnico, regcertificado.NumCertificado, regcertificado.Codigo, regcertificado.DataExec, regcertificado.Obs, itemcalibracao.Nome as 'NItemEquip', servicos.Nome as 'NomeServico', agendcalibrmanut.TipoAgend, compcalibrserv.Codigo as 'CodItEq' from regcertificado, itemcalibracao, servicos, agendcalibrmanut, compcalibrserv, equipamentos where regcertificado.CodAgendamento = agendcalibrmanut.Codigo and agendcalibrmanut.CodCompCalibrServ = compcalibrserv.Codigo and compcalibrserv.CodServico = servicos.Codigo and compcalibrserv.CodItemCalibracao = itemcalibracao.Codigo and itemcalibracao.CodEquip = equipamentos.Codigo and equipamentos.Codigo = $equipamento and agendcalibrmanut.TipoAgend = '$tipo' and regcertificado.Status = 0";
						
						$select = mysql_query($sql);
											
						while ($rf = mysql_fetch_array($select)) {
						
							$dataExec = dataBrasileira($rf['DataExec']);
							
							//VERIFICANDO SE FOI EXECUTADO POR T�CNICO OU EMPRESA
							if (($rf['CodEmpresa'] != 0)&&($rf['CodTecnico'] == 0)) {
								
								$codEmpresa = $rf['CodEmpresa'];
								$sqlAux = "Select Nome from certificadores where Codigo = $codEmpresa";
								
								$selectAux = mysql_query($sqlAux);
								
								if ($rfAux = mysql_fetch_array($selectAux)) {
									
									$nomeEmprTec = $rfAux['Nome'];
									
								}
								
							}
							
							if (($rf['CodEmpresa'] == 0)&&($rf['CodTecnico'] != 0)) {
							
								$codTec = $rf['CodTecnico'];
								$sqlAux = "Select Nome from funcionarios where Codigo = $codTec";
								
								$selectAux = mysql_query($sqlAux);
								
								if ($rfAux = mysql_fetch_array($selectAux)) {
										
									$nomeEmprTec = $rfAux['Nome'];
										
								}
							
							}
							
					?>
					
					
							<table class="texto" border="0">
							
														
								<tr>
								
									<th class="th2certf"><input <?php
									
									if(isset($codCertif)) { 
									
										$quant = count($codCertif); 
										
										for($i=0;$i<$quant;$i++) { 
											
											if (($codCertif[$i]) == ($rf['Codigo'])) { 
												
												echo "checked=checked"; 
											} 
										}
									}
									
									?>
									type="checkbox" name="chk_numeroReg[]" value="<?php echo $rf['Codigo'];
									
									?>"></th>
									<th class="th1certf"><?php echo('Número do certificado'); ?></th>
									<th class="th1certf"><?php echo('Data da execução'); ?></th>
									<th class="th1certfCp"><?php echo('Empresa ou técnico responsável'); ?></th>
								
								</tr>
								
								<tr>
								
									<td class="td1certf"></td>
									<td class="td1certf"><?php echo $rf['NumCertificado']; ?></td>
									<td class="td1certf"><?php echo $dataExec; ?></td>
									<td class="td1certfCp"><?php echo(utf8_encode($nomeEmprTec)); ?></td>
								
								</tr>
							
							
							</table>					
					
					
							<table class="texto" cellspacing="0" border="0">
							
							
								<tr>
								
									<th class="td4certf"></th>
									<th class="th3certf"><?php echo(utf8_encode('Item do equipamento')); ?></th>
									<th class="th3certf"><?php echo('Serviço'); ?></th>
									<th class="th3certf"><?php echo(utf8_encode('Tipo do agendamento')); ?></th>
								
								</tr>
								
								<tr>
								
									<td class="td4certf"></td>
									<td class="td1certf2"><?php echo($rf['NItemEquip']); ?></td>
									<td class="td2certf2"><?php echo($rf['NomeServico']); ?></td>
									<td class="td3certf2"><?php echo($rf['TipoAgend']); ?></td>
								
								</tr>
							
							
							</table>
					
					
					<?php
					
							$codItEq = $rf['CodItEq'];
					
							$sql1 = "Select pontocalibracao.Codigo, pontocalibracao.Valor as 'valorPonto', pontocalibracao.Tolerancia, unidades.Nome as 'nomeUnidade', grandezas.Nome as 'nomeGrandeza' from unidades, grandezas, pontocalibracao where pontocalibracao.CodUnidade = unidades.Codigo and pontocalibracao.CodGrandeza = grandezas.Codigo and pontocalibracao.CodCompCalibrServ = $codItEq";
							
							$select1 = mysql_query($sql1);
					
							while ($rf1 = mysql_fetch_array($select1)) {
					?>	
					
									<table class="texto" cellspacing="0" border="0">
									
									
										<tr>
										
											<th class="td4certf"></th>
											<th class="th5certf"><?php echo(utf8_encode('Grandeza')); ?></th>
											<th class="th5certf"><?php echo(utf8_encode('Valor')); ?></th>
											<th class="th5certf"><?php echo(utf8_encode('Unidade')); ?></th>
											<th class="th5certf"><?php echo('Tolerância'); ?></th>
											<th class="th5certf"><?php echo(utf8_encode('Aprovado?')); ?></th>
										
										</tr>
										
										<tr>
										
											<td class="td6certf"><?php echo('PARÂMETRO:'); ?></td>
											<td class="td1certf3 clNov"><?php echo($rf1['nomeGrandeza']); ?></td>
											<td class="td2certf3 clNov"><?php echo($rf1['valorPonto']); ?></td>
											<td class="td3certf3 clNov"><?php echo($rf1['nomeUnidade']); ?></td>
											<td class="td4certf3 clNov"><?php echo($rf1['Tolerancia']); ?></td>
											<td class="td4certf3 clNov"></td>
										
										</tr>
										
										
					<?php
					
										$codPt = $rf1['Codigo'];
															
										$sql2 = "Select resultado.Valor, resultado.Aprovado from resultado where CodPtCalibracao = $codPt";
																														
										$select2 = mysql_query($sql2);
					
										if ($rf2 = mysql_fetch_array($select2)) {
					
					?>
										
										
												<tr>
												
													<td class="td6certf clNov2"><?php echo(utf8_encode('RESULTADO:')); ?></td>
													<td class="td1certf3"><?php echo($rf1['nomeGrandeza']); ?></td>
													<td class="td2certf3"><?php echo($rf2['Valor']); ?></td>
													<td class="td3certf3"><?php echo($rf1['nomeUnidade']); ?></td>
													<td class="td4certf3"></td>
													<td class="td4certf3"><?php echo($rf2['Aprovado']); ?></td>
												
												</tr>
										
										
					<?php
										
										}
										
					?>
										
									</table>
										
					<?php
										
							}
					
							
					?>					
					
							<table class="texto" cellspacing="0" border="0">
							
							
								<tr>
										
											<th class="td4certf"></th>
											<th class="th5certfNupd"><?php echo('Observação técnica:'); ?></th>
											
											
											<th class="th3certfNupd">
											
											<?php 
											
												$observacao = $rf['Obs'];
											
												
												if (($observacao != '') || ($observacao != ' ')) {
													
													echo $observacao;
													
												}
												else {
													
													echo "NENHUMA OBSERVAÇÃO TÉCNICA FOI REGISTRADA";
													
												}
												
											?>
											
											</th>
											
										
								</tr>
							
							
							</table>					
					
					<?php
							
					
							
					
					
					
					
							
						}				
					
					?>
												
					
					</div>
										
					<span id="cadEmpresa_tit18" class="texto"><?php echo('Análise crítica'); ?></span>			
					
					<textarea <?php if(isset($codAnalCrit)){ if($mod == "VER") { echo "disabled=disabled"; }} ?> rows="8" cols="5" class="cx_texto2" name="txt_analCritica" id="cx3_CadEmpresas"><?php if(isset($analCritica)){ echo $analCritica; } ?></textarea>
					
					<span id="cadEmpresa_tit19" class="texto"><?php echo(utf8_encode('Anexar um arquivo do computador:')); ?></span>
					
					<input <?php if(isset($codAnalCrit)){ if($mod == "VER") { echo "disabled=disabled"; }} ?> name="file-original[]" type="file" class="cx_texto2" onchange="upload();" id="cx4_CadEmpresas" value="<?php if(isset($caminhoCert)){ echo $caminhoCert; } ?>">
					
					<span id="cadEmpresa_tit20" class="texto"><?php echo('Liberar equipamento para utilização?'); ?></span>
					
					<input <?php if(isset($codAnalCrit)){ if($mod == "VER") { echo "disabled=disabled"; }} ?> type="radio" name="rdb_liberado" <?php if(isset($liberado)){ if($liberado == 'SIM'){ echo "checked=checked"; } } ?> value="SIM" id="cx5_CadEmpresas">
					
					<span id="cadEmpresa_tit21" class="texto"><?php echo(utf8_encode('SIM')); ?></span>
					
					<input <?php if(isset($codAnalCrit)){ if($mod == "VER") { echo "disabled=disabled"; }} ?> type="radio" name="rdb_liberado" <?php if(isset($liberado)){ if($liberado == 'NAO'){ echo "checked=checked"; } } ?> value="NAO" id="cx6_CadEmpresas">
					
					<span id="cadEmpresa_tit22" class="texto"><?php echo('NÃO'); ?></span>
					
					<div id ="divBotao">
										
							<?php
								
								if (!isset($_GET['codAnalCrit'])) {
								
							?>
									<input type="submit" class="subtitulo2" id="bt_cadastrou" name="btn_registrar" value="Registrar" />
							<?php
								
								}
								else 
								{
									
									if($mod == "CONFIRMAR") {
							?>
										<input type="submit" class="subtitulo2" id="bt_cadastrou" name="btn_upd" value="Confirmar" />	
							<?php
									}
									else {
										
							?>
							
										<input type="button" onclick="fechar();" class="subtitulo2" id="bt_cadastrou" name="btn_upd" value="Retornar" />
							<?php
									}

								}

							?>
							
							<input type="hidden" name="txt_cad" />
							
							
					</div>
				
				
				
					</form>
				
				</div>										

		</div>


	</body>


</html>