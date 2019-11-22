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
		
		<!-- ------------------ -->

		
	</head>


	<body>

		

		<div class="principal">

			
			<!-- MENUS PRINCIPAIS DO SISTEMA -->

				<a href="#" class="menu_rel">Relatórios</a>

				<a href="#" class="menu_con">Consultas</a>

				<a href="#" class="menu_cad">Cadastros</a>
				
				<a href="../index.php" class="bt_solicitar"></a>

			<!-- /////////////////////////// -->
			
			
			<!-- ESTRUTURA DA PÁGINA INICIAL -->
			

			<span class="paragrafo" id="ini_tit1">Solicitar</span>
			
			
				<!-- CABECALHO -->
				
					<div class="cabecalho"></div>
				
				<!-- --------- -->
				
				<!-- MENSAGEM DE BOAS VINDAS E CONFIGURAÇÕES PESSOAIS-->
				
				<span id="ini_tit11" class="texto">Bem vindo, <?php echo $_SESSION['USUARIO']; ?>!</span>
						
				<span class="lk_confPessoal"><a href="#">Minhas configurações&nbsp;&nbsp; |</a></span>
				
				<span class="lk_confPessoal2"><a href="#">Sair</a></span>
				
				<!-- ---------------------- -->
			
				<!-- MENU SECUNDÁRIO -->
				
					<div class="submenu_cont">
						
						
						<span class="subtitulo2" id="ini_tit3">Selecione um item abaixo:</span>
						
						<!-- OPÇÕES PARA RELATÓRIOS -->
						
							<ul class="listas" id="ini_lst1" type="square">
								
								<li><a href="#" class="lk_lista">Plano de atendimento</a></li>
								<li><a href="#" class="lk_lista">Recebimento e preparação de itens de ensaio</a></li>
								<li><a href="#" class="lk_lista">Etiquetas para amostras</a></li>
							
							</ul>
						
						<!-- ---------------------- -->
						
						<!-- OPÇÕES PARA CADASTROS -->
							
							<ul class="listas" id="ini_lst2" type="square">
								
								<li><a href="../../empresas/" class="lk_lista">Empresas</a></li>
								<li><a href="../../ensaios/" class="lk_lista">Tipos de ensaios</a></li>
								<li><a href="../../funcionarios" class="lk_lista">Funcionários</a></li>
								<li><a href="../../tiposTecido/" class="lk_lista">Tipos de tecidos</a></li>
								<li><a href="../../normas/" class="lk_lista">Normas</a></li>
								<li><a href="../../produtos/" class="lk_lista">Produtos</a></li>
								<li><a href="../../composicoes/" class="lk_lista">Composições</a></li>
								
							</ul>
						
						<!-- --------------------- -->
						
						<!-- OPÇÕES PARA CONSULTAS -->
							
							<ul class="listas" id="ini_lst3" type="square">
								
								<li><a href="#" class="lk_lista">Controle de solicitações de ensaio</a></li>
								<li><a href="#" class="lk_lista">Controle de entrada e saída de amostras</a></li>
								
							</ul>
						
						<!-- --------------------- -->
						
					</div>
				
				<!-- ----------------- -->
			
			
				<div id="cont2">
					
					
					<span class="subtitulo2" id="cadSolicitacao_princ">Controle de entrada e saída de amostras</span>
					
					
					<!-- CAMPO PARA BUSCAR SOLICITAÇÕES DE ENSAIOS -->
					
						<span class="subtitulo2" id="cadSolicitacao_tit1">Buscar:</span>
					
					
						<select class="cx_texto2" id="cmb_Solicitacao1">
							
							<option>SEQUÊNCIAL</option>
							<option>NOME DO ARTIGO</option>
							<option>TIPO DO PRODUTO</option>
							<option>AMOSTRAS DISPONÍVEIS</option>
							<option>AMOSTRAS RETIRADAS</option>
							<option>AMOSTRAS EM ESPERA</option>
							
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
							
							<table class="texto3"> 
								
								<tr>
									
									<td id="linha1_tabelaControle"><a href="#">05454/2014</a></td>
									<td id="linha3_tabelaControle">CALCINHA 04048-7788</td>
									<td id="linha4_tabelaControle"><a href="../ensaios" target="_blank"><img title="Definir data de recebimento" alt="Definir data de recebimento" src="../imagens/png/bt_controleEntrada.png" /></a></td>
									<td id="linha5_tabelaControle"><a href="../amostras" target="_blank"><img title="Definir data de retirada" alt="Definir data de retirada" src="../imagens/png/bt_controleSaida.png" /></a></td>
									<td id="linha6_tabelaControle"><img title="Amostra retirada pelo cliente" alt="Definir Orçamento" src="../imagens/png/bt_controleRetirada.png" /></td>								
									
	
								</tr>
								
							</table>
							
						</div>
												
						<!-- ----------------------------- -->
						
					
					<!-- ----------------------------------------- -->
					
					
					<!-- QUANTIDADE DE PÁGINAS DE REGISTROS -->
						
						
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