<?php
	
	//IMPORTANTE:
	//::::DEFINIÃƒâ€¡ÃƒÆ’O DO STATUS DOS ITENS DO SEQUÃƒÅ NCIAL:::::
	//0 - AMOSTRA EM ESPERA
	//1 - AMOSTRA DELETADA
	//2 - AMOSTRA RECEBIDA
	//3 - AMOSTRA RETIRADA PELO CLIENTE
	
	//ARQUIVO DE CONEXÃƒÆ’O COM O BANCO DE DADOS
	include("../php/conexao.php");
	
	//FUNÃƒâ€¡Ãƒâ€¢ES MODULARES DO SISTEMA
	include("../php/modular.php");
	
	//CHECAR SE FOI REALIZADA A CONEXÃƒÆ’O DO USUÃƒï¿½RIO
	conexaoUsuario();
	
	//FINALIZAR CONEXÃƒÆ’O
	if (isset($_GET['sair'])) {
		
		unset($_SESSION['USUARIO']);
		unset($_SESSION['CODUSUARIO']);
		
		header("location:../index.php");
	}

	//CRIANDO SESSÃƒâ€¢ES APÃƒâ€œS UM TIPO DE BUSCA SER REALIZADO E CLICAR NO BOTÃƒÆ’O BUSCAR
	if (isset($_POST['btn_buscar'])) {
		
		//EXTRAINDO OS VALORES BUSCADOS
		$_SESSION['TIPOBUSCAIE'] = ($_POST['cmb_busca']);
		$_SESSION['VALORBUSCADOIE'] = ($_POST['txt_busca']);
		$_SESSION['VALORBUSCADOIE'] = addslashes($_SESSION['VALORBUSCADOIE']);
		
	}
	
	//=============================================================
	//ROTINA QUE REALIZA A PAGINAÃƒâ€¡ÃƒÆ’O DE REGISTROS DO BANCO DE DADOS
	if (isset($_GET['clickPag'])) {
		
		//PEGA O NÃƒÅ¡MERO DA PÃƒï¿½GINA
		$numeroPagina = ($_GET['clickPag']);
		$numeroMK = $numeroPagina;
		
		if ($numeroPagina != 1) {
			
			$numeroPagina -= 1;
			$paginador = (13*$numeroPagina);
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
	
	
	//ROTINA QUE CONTABILIZA O NÃƒÅ¡MERO DE PÃƒï¿½GINAS
	
	//CONTAR A QUANTIDADE DE REGISTROS NA TABELA
	$sql = "Select COUNT(*) from itemensaio where Status = 0 ";
	$select = mysqli_query($con,$sql);
			
	if ($rf = mysqli_fetch_array($select)) {
				
		$quantidadeRegistros = $rf['COUNT(*)'];
	}

	$npaginas = ($quantidadeRegistros/13);
		
	//ARREDONDANDO QUANTIDADE DE REGISTROS PARA CIMA PARA GERAR O NÃƒÅ¡MERO DE PÃƒï¿½GINAS CORRETO
	$totalPaginas = ceil($npaginas);
	//-------------------------------------------
	
	//REALIZANDO OS FILTROS	
	if (isset($_SESSION['TIPOBUSCAIE'])) {
	
			//BUSCA AS AMOSTRAS EM ESPERA
			if ($_SESSION['TIPOBUSCAIE'] == "amEspera") {
				
				$sql = "Select itemensaio.Codigo, itemensaio.Status, pedidoensaios.Sequencial, itemensaio.NomeArtigo from pedidoensaios, itemensaio where itemensaio.CodPedEns = pedidoensaios.Codigo and itemensaio.status = 0 order by 'Codigo' desc limit $paginador, 13";
				
				if (isset($_SESSION['TIPOBUSCAIE'])) {
					
					unset($_SESSION['TIPOBUSCAIE']);
				}
				
				
			}
			
			//BUSCA AS AMOSTRAS EM ESTOQUE/DISPONÃƒï¿½VEL
			if ($_SESSION['TIPOBUSCAIE'] == "amDisponivel") {
				
				$sql = "Select itemensaio.Codigo, itemensaio.Status, pedidoensaios.Sequencial, itemensaio.NomeArtigo from pedidoensaios, itemensaio where itemensaio.CodPedEns = pedidoensaios.Codigo and itemensaio.status = 2 order by 'Codigo' desc limit $paginador, 13";
				
				if (isset($_SESSION['TIPOBUSCAIE'])) {
					
					unset($_SESSION['TIPOBUSCAIE']);
				}

				
			}
			
			//BUSCA AS AMOSTRAS RETIRADAS PELO CLIENTE
			if ($_SESSION['TIPOBUSCAIE'] == "amRetirada") {
				
				$sql = "Select itemensaio.Codigo, itemensaio.Status, pedidoensaios.Sequencial, itemensaio.NomeArtigo from pedidoensaios, itemensaio where itemensaio.CodPedEns = pedidoensaios.Codigo and itemensaio.status = 3 order by 'Codigo' desc limit $paginador, 13";
				
				if (isset($_SESSION['TIPOBUSCAIE'])) {
					
					unset($_SESSION['TIPOBUSCAIE']);
				}
				
				
			}
	
			//BUSCA TODOS AS AMOSTRAS
			if ($_SESSION['TIPOBUSCAIE'] == "Todos") {
				
				$sql = "Select itemensaio.Codigo, itemensaio.Status, pedidoensaios.Sequencial, itemensaio.NomeArtigo from pedidoensaios, itemensaio where itemensaio.CodPedEns = pedidoensaios.Codigo order by 'Codigo' desc limit $paginador, 13";
			
				if (isset($_SESSION['VALORBUSCADOIE'])) {
					
					unset($_SESSION['VALORBUSCADOIE']);
				}
				
			}
	
			
			//BUSCAR PELO SEQUÃƒÅ NCIAL DAS AMOSTRAS
			if ($_SESSION['TIPOBUSCAIE'] == "amSequencial") {
				
				$valor = $_SESSION['VALORBUSCADOIE'];
				
				$sql = "Select itemensaio.Codigo, itemensaio.Status, pedidoensaios.Sequencial, itemensaio.NomeArtigo from pedidoensaios, itemensaio where itemensaio.CodPedEns = pedidoensaios.Codigo and pedidoensaios.Sequencial = '$valor' and itemensaio.Status <> 1 order by 'Codigo' desc limit $paginador, 13";

			}
			
			//BUSCAR PELO NOME DA AMOSTRA
			if ($_SESSION['TIPOBUSCAIE'] == "amNome") {
				
				//BUSCAR PELO SEQUÃƒÅ NCIAL DA SOLICITAÃƒâ€¡ÃƒÆ’O
				$valor = $_SESSION['VALORBUSCADOIE'];
				
				$sql = "Select itemensaio.Codigo, itemensaio.Status, pedidoensaios.Sequencial, itemensaio.NomeArtigo from pedidoensaios, itemensaio where itemensaio.CodPedEns = pedidoensaios.Codigo and itemensaio.Status <> 1 and itemensaio.NomeArtigo like '%$valor%' order by 'Codigo' desc limit $paginador, 13";
		
			}
			
	}
	else {
			
		$sql = "Select itemensaio.Codigo, itemensaio.Status, pedidoensaios.Sequencial, itemensaio.NomeArtigo from pedidoensaios, itemensaio where itemensaio.CodPedEns = pedidoensaios.Codigo and itemensaio.status = 0 order by 'Codigo' desc limit $paginador, 13";
	
	
	}

?>


<html>


	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<title>S-LAB :: Cadastro de empresas</title>

		<!-- ARQUIVOS CSS IMPORTADOS -->
		
			<link rel="stylesheet" type="text/css" href="../styles/modular.css">
			<link rel="stylesheet" type="text/css" href="../styles/controleEntradaSaida.css">
			
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
				
				<a href="../index.php" class="bt_solicitar"></a>

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
						
							<ul class="listas" id="ini_lst1" type="square">
								
								<li><a href="../relatorios/planoAtendimento/" class="lk_lista">Plano de atendimento</a></li>
								<li><a href="../relatorios/etiquetas/" class="lk_lista">Etiquetas para amostras</a></li>
								<li><a href="../relatorios/recebimentoItens/" class="lk_lista">Recebimento de itens para ensaio</a></li>
							
							</ul>
						
						<!-- ---------------------- -->
						
						<!-- OPÃƒâ€¡Ãƒâ€¢ES PARA CADASTROS -->
							
							<ul class="listas" id="ini_lst2" type="square">
								
								<li><a href="../empresas/" class="lk_lista">Empresas</a></li>
								<li><a href="../ensaios/" class="lk_lista">Tipos de ensaios</a></li>
								<li><a href="../funcionarios" class="lk_lista">Funcionários</a></li>
								<li><a href="../tiposTecido/" class="lk_lista">Tipos de tecidos</a></li>
								<li><a href="../normas/" class="lk_lista">Normas</a></li>
								<li><a href="../produtos/" class="lk_lista">Produtos</a></li>
								<li><a href="../composicoes/" class="lk_lista">Composições</a></li>
								
							</ul>
						
						<!-- --------------------- -->
						
						<!-- OPÃƒâ€¡Ãƒâ€¢ES PARA CONSULTAS -->
							
							<ul class="listas" id="ini_lst3" type="square">
								
								<li><a href="../solicitacao/controle/" class="lk_lista">Controle de solicitações de ensaio</a></li>
								<li><a href="#" class="lk_lista">Controle de entrada e saída de amostras</a></li>
								
							</ul>
						
						<!-- --------------------- -->
						
					</div>
				
				<!-- ----------------- -->
			
			
				<div id="cont2">
				
				<form method="post" action="index.php">	
					
					<span class="subtitulo2" id="cadSolicitacao_princ">Controle de entrada e saída de amostras</span>
					
					
					<!-- CAMPO PARA BUSCAR SOLICITAÃƒâ€¡Ãƒâ€¢ES DE ENSAIOS -->
					
						<span class="subtitulo2" id="cadSolicitacao_tit1">Buscar:</span>
					
					
						<select class="cx_texto2" name="cmb_busca" id="cmb_Solicitacao1">
							
							<option value="amEspera">AMOSTRAS EM ESPERA</option>
							<option value="amDisponivel">AMOSTRAS DISPONÍVEIS</option>
							<option value="amRetirada">AMOSTRAS RETIRADAS</option>
							<option value="amSequencial">SEQUÊNCIAL</option>
							<option value="amNome">NOME DO ARTIGO</option>
							
						</select>
					
						<input type="text" name="txt_busca" class="cx_texto2" id="cx1_CadSolicitacao" />
					
						<input type="submit" name="btn_buscar" id="bt_buscar" value="" />
					
						<!-- FILTRAR O TIPO DO PRODUTO 
						
							<select id="cmb_Solicitacao2" class="cx_texto2">
								
								<option>CAMISETA POLO</option>
								
							</select>							
						
						<!-- ------------------------------------------- -->
						
						
						<!-- MENUS PARA A TABELA -->
						
						<span id="cadSolicitacao_tit4" class="texto">Sequêncial</span>
						
						<span id="cadSolicitacao_tit5" class="texto">Nome do artigo</span>
						
						<!-- ------------------- -->
						
						
						<!-- TABELA COM A CONSULTA DE DADOS -->
						
						<div id="contForm">
							
							<table class="texto3" id="tabela">
							
							<?php
							
							
								//FILTRANDO OS RESULTADOS DA BUSCAS
								
								$select = mysqli_query($con,$sql);
							
								//NUMERADOR PARA DIFERENCIAR AS LINHAS
								$numerador = 0;
								
								while ($rf = mysqli_fetch_array($select)) {
							
							?>							
							
									<tr id="<?php echo $numerador; ?>">
										
										<td id="linha1_tabelaControle"><a href="#"><?php echo $rf['Sequencial']; ?></a></td>
										<td id="linha3_tabelaControle" class="<?php echo $numerador; ?>" ondblclick="ativarTextBox('<?php echo $rf['Codigo']; ?>',this);"><?php echo $rf['NomeArtigo']; ?></td>
										<td id="linha4_tabelaControle"><a href="amostraEntrou/index.php?item=<?php echo $rf['Codigo']; ?>" target="_blank"><img title="Definir data de recebimento" alt="Definir data de recebimento" src="../imagens/png/bt_controleEntrada.png" /></a></td>
										<td id="linha5_tabelaControle"><a href="amostraSaiu/index.php?item=<?php echo $rf['Codigo']; ?>" target="_blank"><img title="Definir data de retirada" alt="Definir data de retirada" src="../imagens/png/bt_controleSaida.png" /></a></td>
										<td id="linha6_tabelaControle">
											
										<?php
										
											//DEFININDO O STATUS DAS AMOSTRAS CONFORME O FILTRO REALIZADO										
											if ($rf['Status'] == 3) {
												
												echo "<img title='Amostra retirada pelo cliente' alt='Definir OrÃƒÂ§amento' src='../imagens/png/bt_controleRetirada.png' />";
												
											}
											
											if ($rf['Status'] == 0) {
												
												echo "<img title='Amostra em espera' alt='Definir OrÃƒÂ§amento' src='../imagens/png/bt_controleEspera.png' />";
												
											}
											
											if ($rf['Status'] == 2) {
												
												echo "<img title='Amostra disponÃƒÂ­vel' alt='Definir OrÃƒÂ§amento' src='../imagens/png/bt_controleDisponivel.png' />";
												
											}
											
										?>
											
										</td>								
								
									</tr>
							
							<?php
									$numerador++;
							
								}
							
							?>
								
							</table>
							
						</div>
												
						<!-- ----------------------------- -->
						
					
					<!-- ----------------------------------------- -->
					
					
					<!-- QUANTIDADE DE PÃƒï¿½GINAS DE REGISTROS -->
						
						
						<span class="texto" id="cadSolicitacao_tit22">Páginas:</span>
						
						<div id="tabelaPaginasSolicitacao">
							
							<table class="texto3" id="tabela_paginacao">
								
								<tr>
									<?php
									
										for ($i=1;$i <= $totalPaginas;$i++) {
												
												
											if ($i != $numeroMK) {				
				
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
					
						<!-- BOTÃƒâ€¢ES DE MOVIMENTAÃƒâ€¡ÃƒÆ’O -->
						
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
				</form>	
				</div>
					
				<!-- ------------------ -->


		</div>


	</body>


</html>