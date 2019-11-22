<?php

	//ARQUIVO DE CONEXÃƒÆ’O COM O BANCO DE DADOS
	include("../../php/conexao.php");
	
	include("../php/funcoes.php");

	
	//CHECAR SE FOI REALIZADA A CONEXÃƒÆ’O DO USUÃƒï¿½RIO
	conexaoUsuario();
	
?>

<html>


	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		
		<title>S-LAB :: Cadastro de equipamentos</title>

		<!-- ARQUIVOS CSS IMPORTADOS -->
		
			<link rel="stylesheet" type="text/css" href="../../styles/modular.css">
			<link rel="stylesheet" type="text/css" href="../../styles/cadEquipamentosUn.css">
			
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
						
						<!-- OPÃƒâ€¡Ãƒâ€¢ES PARA CONSULTAS -->
							
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
					
					<form id="form_cadEmpresas" name="frm_agendamentosCon" action="index.php" method="post">
					
					<span class="subtitulo2" id="ini_tit4">Cadastrar grandezas / unidades de medida</span>
					
					
					<!-- FILTRO DE AGENDAMENTOS -->
					
					
						<span id="cadEmpresa_tit1" class="texto">Grandezas</span>
						
						<input type="text" id="cx1_CadEmpresas" name="txt_grandeza" class="cx_texto1">
						
						
						<input type="button" id="bt_insGrand" name="btn_insGrandeza" value="" onclick="cadastrar('grandezas','cadastrar','');">						
						
						
						<span id="cadEmpresa_titep1" class="texto">Unidades de medida</span>
						
						<input type="text" id="cx2_CadEmpresas" name="txt_unidades" class="cx_texto1">
						
						
						<input type="button" id="bt_insUnid" name="btn_insUnid" value="" onclick="cadastrar('unidades','cadastrar','');">
						
						<div id="tabelaGrandezas">
						
							<table>
							
							<?php 
							
								$sql = "Select * from grandezas where Status = 0";
							
								$select = mysql_query($sql);
							
								while ($rf = mysql_fetch_array($select)) {
								
							?>
							
									<tr>
									
										<td id="linha1_TB"><?php echo $rf['Nome']; ?></td>
										<td id="linha2_TB"><input type=button name="btn_excluirGrand" id="bt_excluir" onclick="excluirReg('grandezas','<?php echo $rf['Codigo']; ?>');" /></td>
									
									</tr>
							
							<?php 
							
								}						
							
							?>
							
							
							</table>						
						
						</div>
						
						<div id="tabelaUnidades">
						
							<table>
							
							<?php 
							
								$sql = "Select * from unidades where Status = 0";
							
								$select = mysql_query($sql);
							
								while ($rf = mysql_fetch_array($select)) {
								
							?>
							
									<tr>
									
										<td id="linha1_TB"><?php echo $rf['Nome']; ?></td>
										<td id="linha2_TB"><input type=button name="btn_excluirGrand" id="bt_excluir" onclick="excluirReg('unidades','<?php echo $rf['Codigo']; ?>');" /></td>
									
									</tr>
							
							<?php

								}

							?>
							
							
							</table>
						
						</div>
										
					<!-- --------------------------------- -->
											
					
					
						<!-- ---------------------- -->
					
					<!-- --------------------------------- -->
				
					</form>
				
				</div>										

		</div>


	</body>


</html>