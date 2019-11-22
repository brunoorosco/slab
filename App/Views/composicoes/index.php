<?php

	//ARQUIVO DE CONEXÃO COM O BANCO DE DADOS
	include("../php/conexao.php");

	//FUNÇÕES MODULARES DO SISTEMA
	include("../php/modular.php");

	//CHECAR SE FOI REALIZADA A CONEXÃO DO USUÁRIO
	conexaoUsuario();
	
	//FINALIZAR CONEXÃO
	if (isset($_GET['sair'])) {
		
		unset($_SESSION['USUARIO']);
		unset($_SESSION['CODUSUARIO']);
		
		header("location:../index.php");
	}

	//ROTINA QUE REALIZA A PAGINAÇÃO DE REGISTROS DO BANCO DE DADOS
	if (isset($_GET['clickPag'])) {
		
		//PEGA O NÚMERO DA PÁGINA
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
	
	
	//CONSULTAR O REGISTRO DA TABELA
	if (isset($_GET['editar'])) {
		
		
		$codigo = ($_GET['editar']);
		
		$_SESSION['CODUPDCOMP'] = $codigo;
		
		$sql = "Select Codigo, Nome from composicoes where Codigo = $codigo";
		
		$select = mysql_query($sql);
		
		if ($rf = mysql_fetch_array($select)) {
			
			$nome = $rf['Nome'];
			
		}		
		
	}
	
	// ------------------------------------
	
	
	
	//EXCLUIR ENSAIO -- NA VERDADE NÃO É EXCLUÍDO 0 PARA ATIVO E 1 PARA DESATIVADO
	if(isset($_GET['excluir'])) {
		
		$codigo = ($_GET['excluir']);
		
		$sql = "Update composicoes set Status = 1 where Codigo = $codigo";
		
		mysql_query($sql);

?>

<script type="text/javascript">
	
	alert('ELEMENTO DELETADO COM SUCESSO!');
	
</script>


<?php
		
	}


	//ROTINA QUE CONTABILIZA O NÚMERO DE PÁGINAS

	$sql = "Select COUNT(*) from composicoes where Status = 0";
	
	//CONTAR A QUANTIDADE DE REGISTROS NA TABELA
	$select = mysql_query($sql);

	if ($rf = mysql_fetch_array($select)) {
						
		$quantidadeRegistros = $rf['COUNT(*)'];
	}
				
	$npaginas = ($quantidadeRegistros/11);
				
	//ARREDONDANDO QUANTIDADE DE REGISTROS PARA CIMA PARA GERAR O NÚMERO DE PÁGINAS CORRETO
	$totalPaginas = ceil($npaginas);
	//-------------------------------------------

?>

<html>


	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<title>S-LAB :: Cadastro de ensaios</title>

		<!-- ARQUIVOS CSS IMPORTADOS -->
		
			<link rel="stylesheet" type="text/css" href="../styles/modular.css">
			<link rel="stylesheet" type="text/css" href="../styles/cadComposicoes.css">
			
		<!--------------------------->

		<!-- ARQUIVOS JAVASCRIPT -->
					
			<script type="text/javascript" src="../js/jquery.js"></script>		
			<script type="text/javascript" src="../js/mascara.js"></script>
			<script type="text/javascript" src="../js/modular.js"></script>
			<script type="text/javascript" src="js/validacao.js"></script>
		
		<!-- ------------------ -->

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
			
			
			<!-- ESTRUTURA DA PÁGINA INICIAL -->
			

			<span class="paragrafo" id="ini_tit1">Solicitar</span>
			
			
				<!-- CABECALHO -->
				
					<div class="cabecalho"></div>
				
				<!-- --------- -->
				
				<!-- MENSAGEM DE BOAS VINDAS E CONFIGURAÇÕES PESSOAIS-->
				
				<span id="ini_tit11" class="texto">Bem vindo, <?php echo $_SESSION['USUARIO']; ?>!</span>
						
				<span class="lk_confPessoal"><a href="#">Minhas configurações&nbsp;&nbsp; |</a></span>
				
				<span class="lk_confPessoal2"><a href="index.php?sair">Sair</a></span>
				
				<!-- ---------------------- -->
			
				<!-- MENU SECUNDÁRIO -->
				
					<div class="submenu_cont">
						
						
						<span class="subtitulo2" id="ini_tit3">Selecione um item abaixo:</span>
						
						<!-- OPÇÕES PARA RELATÓRIOS -->
						
							<ul class="listas" id="ini_lst1" type="square">
								
								<li><a href="../relatorios/planoAtendimento/" class="lk_lista">Plano de atendimento</a></li>
								<li><a href="../relatorios/etiquetas/" class="lk_lista">Etiquetas para amostras</a></li>
								<li><a href="../relatorios/recebimentoItens/" class="lk_lista">Recebimento de itens para ensaio</a></li>
							
							</ul>
						
						<!-- ---------------------- -->
						
						<!-- OPÇÕES PARA CADASTROS -->
							
							<ul class="listas" id="ini_lst2" type="square">
								
								<li><a href="../empresas/" class="lk_lista">Empresas</a></li>
								<li><a href="../ensaios/" class="lk_lista">Tipos de ensaios</a></li>
								<li><a href="../funcionarios/" class="lk_lista">Funcionários</a></li>
								<li><a href="../tiposTecido/" class="lk_lista">Tipos de tecidos</a></li>
								<li><a href="../normas/" class="lk_lista">Normas</a></li>
								<li><a href="../produtos/" class="lk_lista">Produtos</a></li>
								<li><a href="#" class="lk_lista">Composições</a></li>
								
							</ul>
						
						<!-- --------------------- -->
						
						<!-- OPÇÕES PARA CONSULTAS -->
							
							<ul class="listas" id="ini_lst3" type="square">
								
								<li><a href="../solicitacao/controle/" class="lk_lista">Controle de solicitações de ensaio</a></li>
								<li><a href="../entradaSaida/" class="lk_lista">Controle de entrada e saída de amostras</a></li>
								
							</ul>
						
						<!-- --------------------- -->
						
					</div>
				
				<!-- ----------------- -->
				
			
			
				<!-- ------------------ -->
			
				<!-- CADASTRO DE EMPRESAS -->
			
				<div id="cont2">
					
					<span class="subtitulo2" id="ini_tit4">Cadastramento de Composições</span>
					
					
					<!-- FORMULÁRIO DO CADASTRO -->
					
					<form name="frm_cadComposicoes" action="php/cadastro.php" method="post">
					
						<span class="texto" id="cadComposicoes_tit1">Composição</span>
						
						<input class="cx_texto2" id="cx2_CadComposicoes" name="txt_composicao" onclick="cor(this);" maxlength="150" value="<?php if(isset($nome)) { echo $nome; } ?>" />
											
					<!-- --------------------------------- -->			
					
					
					<!-- COLOCAÇÃO/POSICIONAMENTO DOS BOTÕES VALIDAR OU CADASTRAR -->
					
					<?php
					
						
						if (!isset($_GET['editar'])) {
					
					?>
					
							<input type="button" name="btn_cadastrar" onclick="validar();" id="bt_cadastrou" value="Cadastrar" class="subtitulo2" />
							
							<input type="hidden" name="txt_cad" />
							
					<?php
					
						}else {	
					
					?>
						
							<input type="button" name="btn_atualizar" onclick="validar();" id="bt_cadastrou" value="Atualizar" class="subtitulo2" />
						
							<a href="index.php">
								<div id="bt_ncadastro" class="subtitulo2"><span id="bt_ncadastro_compl">Novo</span></div>
							</a>
					
					<?php
					
					
						}
					
					
					?>
					
					</form>
					
					<!-- ------------------------------------------ -->					
					
					
					<!-- TABELA DE CONSULTA DE ENSAIOS CADASTRADOS -->
					
					<span class="texto" id="cadComposicoes_tit6">Composição</span>					
					
					
					<div id="tabelaCadComposicoes">
					
						<table class="texto3">
						
						<?php						
							
							//CONSULTANDO OS DADOS DA TABELA DE PRODUTOS
							
							$sql = "Select Codigo, Nome from composicoes where status = 0 order by 'Codigo' desc limit $paginador, 11";
						
							$select = mysql_query($sql);
						
						
							while ($rf = mysql_fetch_array($select)) {
						
								$preco = str_replace(".", ",", $rf['Preco'])
						
						?>
						
								<tr>
								
									<td id="linha1_tabelaComposicoes"><?php echo $rf['Nome']; ?></td>
									<td id="linha4_tabelaComposicoes"><a href="index.php?excluir=<?php echo($rf['Codigo']); ?>"><img src="../imagens/png/bt_excluirEditar.png" /></a></td>
									<td id="linha5_tabelaComposicoes"><a href="index.php?editar=<?php echo($rf['Codigo']); ?>"><img src="../imagens/png/bt_Editar.png" /></a></td>
									
								</tr>								
								
						
						<?php
						
							}
													
						?>
						
						</table>						
						
					</div>					
					
					<!-- ------------------------------------------ -->
					
					<!-- BOTÕES DE BUSCA -->
						
					
					
					
					<!-- --------------- -->
									
					
					<!-- --------------- -->
					
					<!-- QUANTIDADE DE PÁGINAS DE REGISTROS -->

					
						<span class="texto" id="cadEnsaio_tit22">Páginas:</span>
					
						<div id="tabelaPaginasEnsaio">
							
							<table class="texto3" id="tabela_paginacao">
								
								<tr>
									<?php
									
										for ($i=1;$i <= $totalPaginas;$i++) {
												
												
											if ($i != $numeroMK) {				
				
									?>
									
												<td><a href="index.php?
												<?php
													if (isset($_GET['filtrar'])) {
														
														$codEnsaio = $_GET['filtrar'];
														
														echo 'clickPag='.$i.'&filtrar='.$codEnsaio;														
													}
													else {
														
														echo 'clickPag='.$i;
													}
												?>	
												"><?php echo($i); ?></a></td>					
									
									<?php
											}
											else {
									?>
											
												<td><a class="lk_tick" href="index.php?
													<?php
														if (isset($_GET['filtrar'])) {
															
															$codEnsaio = $_GET['filtrar'];
															
															echo 'clickPag='.$i.'&filtrar='.$codEnsaio;														
														}
														else {
															
															echo 'clickPag='.$i;
														}
													?>
													"><?php echo($i); ?></a></td>
									
									<?php
											}
									
									
										}
									
									?>									
									
								</tr>
								
								
							</table>
							
						</div>
					
						<!-- BOTÕES DE MOVIMENTAÇÃO -->
						
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