<?php


	//ARQUIVO DE CONEXÃƒO COM O BANCO DE DADOS
	include("../php/conexao.php");

	//FUNÃ‡Ã•ES MODULARES DO SISTEMA
	include("../php/modular.php");

	//CHECAR SE FOI REALIZADA A CONEXÃƒO DO USUÃ�RIO
	conexaoUsuario();
	
	//CADASTRAR A SOLICITAÃ‡ÃƒO
	if (isset($_POST['btn_registrar'])) {
		
		//RECEBENDO OS VALORES DA CONSULTA
		$codEmpresa = ($_POST['rdb_empresa']);
		$respAtendimento = ($_POST['cmb_respAtendimento']);
		$dataSolicitacao = ($_POST['txt_dataSolicitacao']);
		$dataInicial = ($_POST['txt_dataInicial']);	
		$dataFinal = ($_POST['txt_dataFinal']);
		$responsavelAnalise = ($_POST['cmb_respAnalise']);
		$dataAnalise = ($_POST['txt_dataAnalise']);
		$dataResposta = ($_POST['txt_dataRespostaCliente']);
		$formaSolicitacao = ($_POST['cmb_formaSolicitacao']);
		$codSequencial = ($_POST['txt_numeroSequencial']);
		//---------------------------------------------------
		
		//PEGANDO A DATA E A HORA DO CADASTRO
		
		$dataCadastro = date('Y-m-d');
		$horaAtual = date("H:i:s");
		
		//-----------------------------------
		
		//CONVERTENDO AS DATAS
		$dataSolicitacao = dataAmericana($dataSolicitacao);
		$dataInicial = dataAmericana($dataInicial);
		$dataFinal = dataAmericana($dataFinal);
		$dataAnalise = dataAmericana($dataAnalise);
		$dataResposta = dataAmericana($dataResposta);		
		//-----------------------------------------
		
		/*
		 * 
		 * DESABILITANDO TEMPORÃ�RIAMENTE A FUNÃ‡ÃƒO DE CADASTRO AUTOMATIZADO DO SEQUÃŠNCIAL
		 * 
		
				//VERIFICANDO SE ALGUÃ‰M PASSOU NA FRENTE NA FILA DE CADASRAR UMA SOLICITAÃ‡ÃƒO
				//EM CASO POSITIVO, MUDAR O SEQUÃŠNCIAL ATUAL
				
				$verificador = 0;
				
				
				//FORMATANDO O SEQUÃŠNCIAL
				
				//FILTRANDO O NÃšMERO DO SEQUÃŠNCIAL
				$posicao = strpos($codSequencial, "/");
				$nsequencial = substr($codSequencial, 0,$posicao);				
				//--------------------------------
				
				//DETERMINAÃ‡ÃƒO DO ANO
				$ano = date("Y");
				$ano = substr($ano, 2,2);
				//-------------------	
				
				//CAPTURANDO O NÃšMERO COMPLEMENTADOR DO SEQUÃŠNCIAL		
				$posicao2 = strpos($codSequencial, "-");
				$complementador = substr($codSequencial, $posicao2);
				//-----------------------
				
				//ESTRUTURA QUE COLOCA O SEQUÃŠNCIAL NA SEQUÃŠNCIA CORRETA, CASO OUTRAS PESSOAS TENHAM REGISTRADO NA FRENTE
				do {
					
					$sql = "Select Sequencial from pedidoensaios where Sequencial = '$codSequencial'";
		
					$select = mysql_query($sql);
					
					$checar = mysql_num_rows($select);
					
					//SE ALGUÃ‰M PASSOU NA FRENTE			
					if ($checar != 0) {
						
						$nsequencial = $nsequencial + 1;
						
						//AJUSTANDO O VALOR DO SEQUÃŠNCIAL SOMADO NO FORMATO IDEALIZADO PELO LABORATÃ“RIO
						if (($nsequencial >= 0) && ($nsequencial <= 9)) {
							
							$codSequencial = "00".$nsequencial."/".$ano."-".$complementador;
						}
						
						if (($nsequencial >= 10) && ($nsequencial <= 99)) {
							
							$codSequencial = "0".$nsequencial."/".$ano."-".$complementador;
						}
						
						if (($nsequencial >= 100) && ($nsequencial <= 999)) {
							
							$codSequencial = "0".$nsequencial."/".$ano."-".$complementador;
						}
						//-----------------------------------------------------------------------------
						
										
					}
					else { //SE NINGUÃ‰M PASSOU NA FRENTE
						
						$verificador = 1;
					}
					
					
				} while ($verificador != 1);
				
				//--------------------------------------------------------------------------------------
		
		
		*/
		
	
		//VERIFICANDO SE O SEQUÊNCIAL ESTÁ INSERIDO NO SISTEMA
		
		
		$sql = "Select Codigo from pedidoensaios where Sequencial = '$codSequencial'";
		
		$select = mysql_query($sql);
		
		//CASO O SEQUÊNCIAL INSERIDO, AINDA NÃO EXISTA NO SISTEMA, PROSSEGUIR COM O CADASTRO DAS INFORMAÇÕES
		
		if (mysql_num_rows($select) == 0) {

					//CADASTRANDO AS INFORMAÃ‡Ã•ES BÃ�SICAS DA SOLICITAÃ‡ÃƒO
					
					$tabela = "pedidoensaios";
					
					$campos = "Sequencial, CodNomeEmpr, DataInicio, DataFim, ResponsavelAtendimento, DataSolicitacao, DataAnalCritica, ResponsavelAnalise, DataResposta, FormaRecebimento, DataAprovacao, Obs, DataCadastro, HoraCadastro, Usuario, Status";
					
					$codigoUsuario = $_SESSION['CODUSUARIO'];
					
					$valores = "'$codSequencial', $codEmpresa, '$dataInicial', '$dataFinal', $respAtendimento, '$dataSolicitacao', '$dataAnalise', $responsavelAnalise, '$dataResposta', '$formaSolicitacao', '0000-00-00', '', '$dataCadastro', '$horaAtual', $codigoUsuario, 0";
					
					//CHAMANDO A FUNÃ‡ÃƒO QUE FAZ O CADASTRO DAS INFORMAÃ‡Ã•ES
					inserir($tabela, $campos, $valores);
					
					//-------------------------------------------------
					
					//CADASTRANDO OS ENSAIOS APÃ“S GERAR O SEQUÃŠNCIAL
					
						//PESQUISANDO O CÃ“DIGO DO ÃšLTIMO SEQUÃŠNCIAL INSERIDO
						
							$sql = "Select Codigo from pedidoensaios where Sequencial = '$codSequencial'";
						
							$select = mysql_query($sql);
							
							if ($rf = mysql_fetch_array($select)) {
								
								$codSolicitacao = $rf['Codigo'];					
							}
						
						//--------------------------------------------------
					
						//REGISTRANDO OS ENSAIOS NO BANCO DE DADOS
						
							$quantidade = count($_SESSION['REFENSAIO']);
						
							$tabela = "ensaiossolicit";
							
							$campos = "Codpedens, Codtipens, Codconffunc, Dataexec, Datafin, CodNorm";
						
							for ($i = 0;$i < $quantidade;$i++) {
								
								$codEnsaio = $_SESSION['REFENSAIO'][$i];	
								$codNorma = $_SESSION['REFENSNORMA'][$i];
								
								if ($_SESSION['REFENSAIO'][$i] != 0) {
								
									$valores = "$codSolicitacao, $codEnsaio, 0, '0000-00-00', '0000-00-00', $codNorma";
									
									inserir($tabela, $campos, $valores);
								}
								
								
							}
							
							//VERIFICANDO SE O ENSAIO DE INSPEÃ‡ÃƒO FOI INSERIDO
							if (isset($_SESSION['ENSINSPECAO'])) {
								
								$valores = "$codSolicitacao, 0, 0, '0000-00-00', '0000-00-00', 0";
								
								inserir($tabela, $campos, $valores);
								
							}
						
						//----------------------------------------------------
						
						//LIMPANDO AS VARIÃ�VEIS DE SESSÃƒO APÃ“S TER CADASTRADO A SOLICITAÃ‡ÃƒO
						
							unset($_SESSION['REFENSAIO']);
							unset($_SESSION['ENSINSPECAO']);
							unset($_SESSION['REFENSNORMANOME']);
							unset($_SESSION['REFENSNORMA']);
							unset($_SESSION['REFENSAIONOME']);
							//unset($_SESSION['NSEQUENCIAL']);
							unset($_SESSION['NUMEROSEQREGISTRAR']);
						
						//-----------------------------------------------------------------
					
					//----------------------------------------------
		
?>
						<script type="text/javascript" language="JavaScript">
							
							//MENSAGEM INFORMANDO QUE A SOLICITAÃ‡ÃƒO FOI CRIADA
							alert("VOCÃŠ ACABOU DE GERAR UMA SOLICITAÃ‡ÃƒO COM O SEQUÃŠNCIAL "+'<?php echo $codSequencial; ?>');
							alert("VOCÃŠ SERÃ� REDIRECIONADO PARA A PÃ�GINA DE CONTROLE DE SOLICITAÃ‡Ã•ES");
							location.href = "controle/index.php";
							
						</script>
		
<?php
		}
		else {
			
?>

						<script type="text/javascript" language="JavaScript">
							
							//MENSAGEM INFORMANDO QUE A SOLICITAÃ‡ÃƒO FOI CRIADA
							alert("O CÓDIGO SEQUÊNCIAL ESPECIFICADO, JÁ EXISTE. POR FAVOR, ESCOLHER OUTRO VALOR!");
							location.href = "index.php";
							
						</script>

<?php

			
		}
	}
	//-----------------------
	
	//FINALIZAR CONEXÃƒO
	if (isset($_GET['sair'])) {
		
		unset($_SESSION['USUARIO']);
		unset($_SESSION['CODUSUARIO']);
		
		header("location:../index.php");
	}
	
	//DETERMINAÃ‡ÃƒO DO ANO
	$ano = date("Y");
	$ano = substr($ano, 2,2);
	
	//-------------------
	
	/*FUNÃ‡ÃƒO QUE GERA O NÃšMERO DO SEQUÃŠNCIAL SERÃ� TEMPORÃ�RIAMENTE DESATIVADA
	
	//DETERMINAÃ‡ÃƒO DO NÃšMERO DE SEQUÃŠNCIAL
	if (!isset($_SESSION['NSEQUENCIAL'])) {
		
		$sql = "Select Sequencial from pedidoensaios order by Codigo desc limit 1";
		$select = mysql_query($sql);
		
		//FORMANDO UM COMPLEMENTADOR PARA O SEQUÃŠNCIAL
		$complementador = "S";
		
		//CASO SEJA O PRIMEIRO SEQUÃŠNCIAL NO BANCO DE DADOS		
		if (mysql_num_rows($select) == 0) {
			
			$_SESSION['NSEQUENCIAL'] = "000/".$ano."-".$complementador;
		}
		else { //CASO CONTRÃ�RIO
			
			if ($rf = mysql_fetch_array($select)) {
			
				//FILTRANDO O NÃšMERO DO SEQUÃŠNCIAL
				$posicao = strpos($rf['Sequencial'], "/");
				$nsequencial = substr($rf['Sequencial'], 0,$posicao);				
				//--------------------------------
				
				//SOMANDO O SEQUÃŠNCIAL PARA INSERIR O NOVO REGISTRO
				$somaSequencial = $nsequencial + 1;
				//-------------------------------------------------
								
				//AJUSTANDO O VALOR DO SEQUÃŠNCIAL SOMADO NO FORMATO IDEALIZADO PELO LABORATÃ“RIO
				if (($somaSequencial >= 0) && ($somaSequencial <= 9)) {
					
					$_SESSION['NSEQUENCIAL'] = "00".$somaSequencial."/".$ano."-".$complementador;
				}
				
				if (($somaSequencial >= 10) && ($somaSequencial <= 99)) {
					
					$_SESSION['NSEQUENCIAL'] = "0".$somaSequencial."/".$ano."-".$complementador;
				}
				
				if (($somaSequencial >= 100) && ($somaSequencial <= 999)) {
					
					$_SESSION['NSEQUENCIAL'] = "0".$somaSequencial."/".$ano."-".$complementador;
				}
				//-----------------------------------------------------------------------------
			
			}	
			
		}
	}

	//-----------------------------------------------------------------------------------------	*/

	
	//BUSCAR PELO NOME DA EMPRESA
	if (isset($_POST['btn_buscarEmpr'])) {
		
		$nomeBuscaEmpresa = ($_POST['txt_buscaEmpr']);
		$nomeBuscaEmpresa = addslashes($nomeBuscaEmpresa);
		
		//SESSÃƒO QUE BUSCA OS VALORES FILTRADOS
		$_SESSION['SELEMP'] = "ATIVADO";
		//-----------------------------------------
	}	
	//---------------------------
	
	//ROTINA QUE REALIZA A PAGINAÃ‡ÃƒO DE REGISTROS DO BANCO DE DADOS
	if (isset($_GET['clickPag']) || isset($_SESSION['$numeroMK'])) {
		
		//PEGA O NÃšMERO DA PÃ�GINA
		if (isset($_GET['clickPag'])) {
			
			$numeroPagina = ($_GET['clickPag']);
			$_SESSION['$numeroMK'] = $numeroPagina;
			
			//DESTRUINDO SESSION COM DADOS DE BUSCA DE EMPRESAS		
			unset($_SESSION['SELEMP']);		
			
		}
		else {
			
			$numeroPagina = $_SESSION['$numeroMK'];

		}
		
		if ($numeroPagina != 1) {
			
			$numeroPagina -= 1;				
			$paginador = (5*$numeroPagina);
			$_SESSION['PAGINADOR'] = $paginador;
		}
		else {
			
			$paginador = 0;
			$_SESSION['PAGINADOR'] = $paginador;						
		}
	}
	else {
		
		if (!isset($_SESSION['$numeroMK'])) {
		
			$_SESSION['$numeroMK'] = 1;
		
		}
		
		$paginador = 0;
		$_SESSION['PAGINADOR'] = $paginador;
	}
	//-------------------------------------------------------------	
	
	//ROTINA QUE CONTABILIZA O NÃšMERO DE PÃ�GINAS
	
	//CONTAR A QUANTIDADE DE REGISTROS NA TABELA
	$sql = "Select COUNT(*) from tbl_empresas where Status = 0";
	$select = mysql_query($sql);
			
	if ($rf = mysql_fetch_array($select)) {
				
		$quantidadeRegistros = $rf['COUNT(*)'];
	}
		
	$npaginas = ($quantidadeRegistros/5);
		
	//ARREDONDANDO QUANTIDADE DE REGISTROS PARA CIMA PARA GERAR O NÃšMERO DE PÃ�GINAS CORRETO
	$totalPaginas = ceil($npaginas);
	//-------------------------------------------
	
?>


<html>


	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<title>S-LAB :: Cadastro de empresas</title>

		<!-- ARQUIVOS CSS IMPORTADOS -->
		
			<link rel="stylesheet" type="text/css" href="../styles/modular.css">
			<link rel="stylesheet" type="text/css" href="../styles/cadSolicitacoes.css">
			
		<!--------------------------->

		<!-- ARQUIVOS JAVASCRIPT -->
					
			<script type="text/javascript" src="../js/jquery.js"></script>		
			<script type="text/javascript" src="../js/mascara.js"></script>
			<script type="text/javascript" src="../js/modular.js"></script>
			<script type="text/javascript" src="js/validacao.js"></script>
			<script type="text/javascript" src="js/funcoes.js"></script>
		
		<!-- ------------------ -->

		
	</head>


	<body>

		

		<div class="principal">

			<a href="../inicial/index.php" class="cm_home"></a>
			
			<!-- MENUS PRINCIPAIS DO SISTEMA -->

				<a href="#" class="menu_rel">Relatórios</a>

				<a href="#" class="menu_con">Consultas</a>

				<a href="#" class="menu_cad">Cadastros</a>
				
				<a href="#" class="bt_solicitar"></a>

			<!-- /////////////////////////// -->
			
			
			<!-- ESTRUTURA DA PÃ�GINA INICIAL -->
			

			<span class="paragrafo" id="ini_tit1">Solicitar</span>
			
			
				<!-- CABECALHO -->
				
					<div class="cabecalho"></div>
				
				<!-- --------- -->
				
				<!-- MENSAGEM DE BOAS VINDAS E CONFIGURAÃ‡Ã•ES PESSOAIS-->
				
				<span id="ini_tit11" class="texto">Bem vindo, <?php echo $_SESSION['USUARIO']; ?>!</span>
						
				<span class="lk_confPessoal"><a href="#">Minhas configurações&nbsp;&nbsp; |</a></span>
				
				<span class="lk_confPessoal2"><a href="index.php?sair">Sair</a></span>
				
				<!-- ---------------------- -->
			
				<!-- MENU SECUNDÃ�RIO -->
				
					<div class="submenu_cont">
						
						
						<span class="subtitulo2" id="ini_tit3">Selecione um item abaixo:</span>
						
						<!-- OPÃ‡Ã•ES PARA RELATÃ“RIOS -->
						
							<ul class="listas" id="ini_lst1" type="square">
								
								<li><a href="../relatorios/planoAtendimento/" class="lk_lista">Plano de atendimento</a></li>
								<li><a href="../relatorios/etiquetas/" class="lk_lista">Etiquetas para amostras</a></li>
								<li><a href="../relatorios/recebimentoItens/" class="lk_lista">Recebimento de itens para ensaio</a></li>
							
							</ul>
						
						<!-- ---------------------- -->
						
						<!-- OPÃ‡Ã•ES PARA CADASTROS -->
							
							<ul class="listas" id="ini_lst2" type="square">
								
								<li><a href="../empresas/" class="lk_lista">Empresas</a></li>
								<li><a href="../ensaios/" class="lk_lista">Tipos de ensaios</a></li>
								<li><a href="../funcionarios" class="lk_lista">FuncionÃ¡rios</a></li>
								<li><a href="../tiposTecido/" class="lk_lista">Tipos de tecidos</a></li>
								<li><a href="../normas/" class="lk_lista">Normas</a></li>
								<li><a href="../produtos/" class="lk_lista">Produtos</a></li>
								<li><a href="../composicoes/" class="lk_lista">ComposiÃ§Ãµes</a></li>
								
							</ul>
						
						<!-- --------------------- -->
						
						<!-- OPÃ‡Ã•ES PARA CONSULTAS -->
							
							<ul class="listas" id="ini_lst3" type="square">
								
								<li><a href="../solicitacao/controle/" class="lk_lista">Controle de solicitações de ensaio</a></li>
								<li><a href="../entradaSaida/" class="lk_lista">Controle de entrada e saída de amostras</a></li>
								
							</ul>
						
						<!-- --------------------- -->
						
					</div>
				
				<!-- ----------------- -->
			
				<!-- GERAR SOLICITAÃ‡Ã•ES DE ENSAIO -->
			<form name="frm_solicitacao" method="post" action="index.php">
			
				<div id="cont2">
					
					<input type="text" id="cx22_CadSolicitacao" name="txt_numeroSequencial" class="cx_texto2" onblur="marcarSequencial(this);" value="<?php if (isset($_SESSION['NUMEROSEQREGISTRAR'])) { echo($_SESSION['NUMEROSEQREGISTRAR']); } ?>">
					
					<span class="subtitulo2" id="cadSolicitacao_princ">Gerar solicitações de ensaios</span>
					
					<span id="cadSolicitacao_tit1" class="texto">Número do sequêncial:</span>
					<!--
					
					LABEL RESPONSÃ�VEL POR EXIBIR O NÃšMERO DO SEQUÃŠNCIAL SERÃ� TEMPORÃ�RIAMENTE DESABILITADA
					 
					<span id="cadSolicitacao_tit72" class="texto3"><?php echo $_SESSION['NSEQUENCIAL']; ?></span>
					-->
					
					
					
					<span id="cadSolicitacao_tit3" class="texto2"></span>
					
					<span id="cadSolicitacao_tit4" class="texto2">Selecione uma empresa:</span>
					
					<!-- CAIXA DE BUSCA DE EMPRESA -->
					
					<input type="text" id="cxb1_CadSolicitacao" name="txt_buscaEmpr" class="cx_texto2" />
					
					<input type="submit" name="btn_buscarEmpr" id="bt_buscarEmpr" value="" title="Buscar Empresa" />
					
					<!-- ------------------------- -->
					
					<!-- TABELA DE EMPRESAS -->
					
					<div id="tabelaSolicitacoes">
						
						<table class="texto3">
						
						<?php
							
							if (isset($_SESSION['SELEMP'])) {	
								
								$sql = "Select Codigo, Nome from tbl_empresas where status = 0 and Nome like '%$nomeBuscaEmpresa%' limit 0,5";
							}
							else {
								
								$paginador = $_SESSION['PAGINADOR'];								
								$sql = "Select Codigo, Nome from tbl_empresas where status = 0 order by CodigoCliente asc limit $paginador, 5";	
							}
							
							$select = mysql_query($sql);
						
						
							while ($rf = mysql_fetch_array($select)) {
							
						?>
						
								<tr>
									
									<td id="linha1_tabelaSolicitacoes"><input type="radio" name="rdb_empresa" onclick="marcarEmpresa(this);" 
									<?php
										if (isset($_SESSION['CODSOLEMPRESA'])) {
											
											if ($_SESSION['CODSOLEMPRESA'] == $rf['Codigo']) {
												echo "checked='checked'";					
											}
										}
									?> value="<?php echo $rf['Codigo']; ?>" /></td>
									<td id="linha2_tabelaSolicitacoes"><?php echo $rf['Nome']; ?></td>
									
								</tr>
						
						<?php
						
							}
						?>
						
						</table>
						
					</div>					
					
					<!-- ///////////////// -->
					
					
					<!-- CAIXA DE BUSCA DE ENSAIOS -->
					
					<input type="text" id="cxb2_CadSolicitacao" name="txt_buscEns" class="cx_texto2" />
					
					<input type="button" name="btn_buscarEns" id="bt_buscarEns" title="Buscar Ensaio" onclick="buscarEnsaio('cadastroSolicitacao');" value="" />
					
					<!-- ------------------------- -->
					
					<!-- ADICIONAR ENSAIOS AO PEDIDO-SOLICITAÃ‡ÃƒO -->					
					
					<div id="contEnsSolicit">
						
						<span class="texto" id="cadSolicitacao_tit5">Busque o nome do ensaio:</span>
						
						
						<!-- INSERIR ENSAIO VESTUÃ�RIO -->
							
							<span class="texto" id="cadSolicitacao_tit6">Ensaio:</span>
						
												
							<select class="cx_texto2" id="cmb_SolicitacaoV" name="cmb_ensaios" onchange="verificarNorma(this.value,'cadastroSolicitacao');">
								
									<option value="0:NADA ENCONTRADO">PESQUISE O ENSAIO DESEJADO NO CAMPO ACIMA</option>							
							
							</select>
						
							<input type="button" name="btn_insVest" title="Inserir Ensaio" id="bt_insEnsaioVest" onclick="inserirEnsaio();" value="" />
						
						<!-- ----------------------- -->
						
						<!-- MODELO DO COMBO DE NORMAS QUE ADICIONADO NA PÃ�GINA							
						
						<span class="texto" id="cadSolicitacao_tit8">Norma:</span>
									
						<select name="cmb_norma" class="cx_texto2" id="cmb_SolicitacaoN">
											
							<option>Selecione uma norma</option>
									
						</select>

						<!-- --------------------  -->
						
						<!-- ACRESCENTAR OU NÃƒO ENSAIO DE INSPEÃ‡ÃƒO -->
						
							<span id="cadSolicitacao_tit15" class="texto">Acrescentar um ensaio de inspeção?</span>
						
							<input type="radio" name="rdb_inspecao" value="sim" id="radio_cadSolicit1" 
							<?php
							
								if (isset($_SESSION['ENSINSPECAO'])) {
									
									if ($_SESSION['ENSINSPECAO'] == 0) {
										
										echo "checked=checked";
									}
								}
							
							?>
							onclick="addInspecao(this.value);" />
						
							<span id="cadSolicitacao_tit16" class="subtitulo2">SIM</span>
						
							<input type="radio" name="rdb_inspecao" value="nao" id="radio_cadSolicit2" 
							<?php
							
								if (!isset($_SESSION['ENSINSPECAO'])) {
										
									echo "checked=checked";
								}
							
							?>							
							onclick="addInspecao(this.value);" />
						
							<span id="cadSolicitacao_tit17" class="subtitulo2">NÃO</span>
						
						<!-- ------------------------------------- -->
						
						
						<!-- TABELA DE ENSAIOS INSERIDOS -->
						
						
						<div id="tabelaAddEnsaios">
							
							<table id="tabelaEnsaios" class="texto3">
								
								
								<!-- MODELO DE LINHAS QUE SÃƒO INSERIDAS NESSA TABELA POR JAVASCRIPT
								
								<tr id="linha1">
									
									<td id="linha1_tabelaAddEnsaios">DETERMINAÃ‡ÃƒO DA DENSIDADE DE PONTOS POR CENTÃ�METRO</td>
									<td id="linha2_tabelaAddEnsaios">CONFORME O TIPO DO TECIDO</td>
									<td id="linha3_tabelaAddEnsaios"><input type="button" id="bt_retirarEns" /></td>
									
								</tr>
								
								-->
								<?php
								
									//VERIFICANDO SE A VARIÃ�VEL DE SESSÃƒO COM OS ENSAIOS SELECIONADOS EXISTE. EM CASO, POSITIVO, MOSTRAR NA TABELA
									if (isset($_SESSION['REFENSAIO'])) {
												
										$quantidade = count($_SESSION['REFENSAIO']);
										
										for ($i = 0 ; $i < $quantidade ; $i++) {
											
											if ($_SESSION['REFENSAIO'][$i] != 0) {
								?>
								
												<tr>
												
													<td id="linha1_tabelaAddEnsaios"><?php echo($_SESSION['REFENSAIONOME'][$i]); ?></td>
													<td id="linha2_tabelaAddEnsaios"><?php echo($_SESSION['REFENSNORMANOME'][$i]); ?></td>
													<td id="linha3_tabelaAddEnsaios"><input type="button" id="bt_retirarEns" onclick="removerLinha(this,'<?php echo($_SESSION['REFENSAIO'][$i]); ?>','<?php echo($_SESSION['REFENSNORMA'][$i]); ?>');" /></td>
													
												</tr>
								
								
								<?php
											}
										}
								
									}
								
								?>
								
							</table>
							
							
						</div>
												
						
						<!-- --------------------------- -->
						
						
						
					</div>
					
					<!-- --------------------------------------- -->
					
					
					<!-- FORMULÃ�RIO DE INFORMAÃ‡Ã•ES ADICIONAIS -->
					
					<span class="texto" id="cadSolicitacao_tit7">Informações adicionais</span>	
					
					<div id="contForm1">
						
						<span class="texto" id="cadSolicitacao_tit58">Responsável pelo atendimento</span>
						
						<select name="cmb_respAtendimento" class="cx_texto2" id="cmb_Solicitacao1">
							
							<?php
							
								//BUSCANDO A RELAÃ‡ÃƒO DE FUNCIONÃ�RIOS DO LABORATÃ“RIO
							
								$sql = "Select Codigo, Nome from funcionarios where Status = 0";
							
								$select = mysql_query($sql);
							
								while ($rf = mysql_fetch_array($select)) {							
							
							?>
							
									<option value="<?php echo $rf['Codigo']; ?>"><?php echo $rf['Nome']; ?></option>
							
							<?php
							
								}
															
							?>
							
						</select>
						
						<span class="texto" id="cadSolicitacao_tit9">Data da solicitaçãos</span>
						
						<input type="text" class="cx_data" id="cx1_CadSolicitacao" name="txt_dataSolicitacao" />
						
						<span class="texto" id="cadSolicitacao_tit10">Data inicial prevista</span>
						
						<input type="text" class="cx_data" id="cx72_CadSolicitacao" name="txt_dataInicial" />
						
						<span class="texto" id="cadSolicitacao_tit11">Data final prevista</span>
						
						<input type="text" class="cx_data" id="cx73_CadSolicitacao" name="txt_dataFinal" />
						
					</div>
					
					<div id="contForm2">
						
						<span class="texto" id="cadSolicitacao_tit58">Responsável pela análise crítica</span>
						
						<select name="cmb_respAnalise" class="cx_texto2" id="cmb_Solicitacao1">
							
							<?php
							
								//UTILIZANDO A CONSULTA DE FUNCIONÃ�RIOS REALIZADA ANTERIORMENTE E INSERINDO NO CAMPO
								$sql = "Select Codigo, Nome from funcionarios where Status = 0";
							
								$select = mysql_query($sql);
								
								while($rf = mysql_fetch_array($select)) {
									
							?>
							
									<option value="<?php echo $rf['Codigo']; ?>"><?php echo $rf['Nome']; ?></option>
							
							<?php
							
								}							
							?>
							
						</select>
						
						<span class="texto" id="cadSolicitacao_tit9">Data da análise crítica</span>
						
						<input type="text" class="cx_data" id="cx1_CadSolicitacao" name="txt_dataAnalise" />
						
						<span class="texto" id="cadSolicitacao_tit10">Data da resposta ao cliente</span>
						
						<input type="text" class="cx_data" id="cx72_CadSolicitacao" name="txt_dataRespostaCliente" />
						
						<span class="texto" id="cadSolicitacao_tit11">Forma de recebimento</span>
						
						<select class="cx_texto2" id="cmb_Solicitacao2" name="cmb_formaSolicitacao">
							
							<option>FAX</option>
							<option>EMAIL</option>
							<option>FONE</option>
							<option>OUTROS/CORREIO</option>
							
						</select>
						
					</div>
					
					<!-- ------------------------------------ -->
					
					<!-- POSICIONAMENTO DOS BOTÃ•ES -->
					
					<input type="button" name="btn_proximo" id="bt_proximo" value="Próximo" class="subtitulo2" />
					
					<input type="button" name="btn_anterior" id="bt_voltarForm" value="   Anterior" class="subtitulo2" />
					
					<input type="submit" name="btn_registrar" id="bt_cadastrar" value="Registrar" class="subtitulo2" />
					
					<!-- ------------------------- -->
			</form>
					<!-- ------------------------------------ -->
					
					
					<!-- QUANTIDADE DE PÃ�GINAS DE REGISTROS -->
						
						
						<span class="texto" id="cadSolicitacao_tit22">Páginas:</span>
						
						<div id="tabelaPaginasSolicitacao">
							
							<table class="texto3" id="tabela_paginacao">
								
								<tr>
									<?php
									
										for ($i=1;$i <= $totalPaginas;$i++) {
												
												
											if ($i != $_SESSION['$numeroMK']) {				
				
									?>
									
												<td><a href="index.php?clickPag=<?php echo($i); ?>"><?php echo($i); ?></a></td>					
									
									<?php
											}
											else {
									?>
											
												<td><a class="lk_tick" href="index.php?clickPag=<?php echo($i); ?>"><?php echo($i); ?></a></td>
									
									<?php
											}
									
									
										}
									
									?>									
									
								</tr>
								
								
							</table>
							
						</div>
					
						<!-- BOTÃ•ES DE MOVIMENTAÃ‡ÃƒO -->
						
						<?php
						
						
							if ($totalPaginas > 21) {
						
						?>
						
						
								<a href="#" id="lk_movAnt"  onmouseover="moveRight();" onmouseout="stopMove();">-</a>
								<a href="#" id="lk_movProx" onmouseover="moveLeft();" onmouseout="stopMove();">+</a>
					
						<?php
						
							}
										
						?>
					
						<!-- ---------------------- -->
					
					<!-- --------------------------------- -->
					
				</div>
					
				<!-- ------------------ -->


		</div>


	</body>


</html>