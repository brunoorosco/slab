<?php

	//ARQUIVO DE CONEXÃO COM O BANCO DE DADOS
	include("../../php/conexao.php");

	//FUNÇÕES MODULARES DO SISTEMA
	include("../../php/modular.php");

	//CHECAR SE FOI REALIZADA A CONEXÃO DO USUÁRIO
	conexaoUsuario();
	
	//FINALIZAR CONEXÃO
	if (isset($_GET['sair'])) {
		
		unset($_SESSION['USUARIO']);
		unset($_SESSION['CODUSUARIO']);
		
		header("location:../index.php");
	}
	
	//REGISTRANDO A DATA DE RECEBIMENTO DA AMOSTRA
	if (isset($_POST['btn_enviarDr'])) {
		
		$codigoItem = $_SESSION['ITEMINFORM'];
		
		//CAPUTANDO AS INFORMAÇÕES DOS CAMPOS
		$dataReceb = ($_POST['txt_dataReceb']);
		$obs = ($_POST['txt_obs']);
		
		//TRATAMENTO PARA AS CAIXAS DE TEXTO
		$obs = addslashes($obs);
		$dataReceb = dataAmericana($dataReceb);
		
		//ATUALIZANDO INFORMAÇÕES NO BANCO DE DADOS
		$sql = "Update itemensaio set Status = 2, DataChegada = '$dataReceb', Obs = '$obs' where Codigo = $codigoItem";
		mysql_query($sql);
		
		//LIMPANDO A VARIÁVEL DE SESSÃO APÓS A ATUALIZAÇÃO DA INFORMAÇÃO
		unset($_SESSION['ITEMINFORM']);
		
?>
	
		<script type="text/javascript">
			
			alert('INFORMAÇÃO REGISTRADA COM SUCESSO!');
			
			window.close();
			
		</script>

<?php
		
	}
	
	//FILTRANDO AS INFORMAÇÕES DO ITEM DO ENSAIO
	if (isset($_GET['item']) || (isset($_SESSION['ITEMINFORM']))) {
		
		if (!isset($_SESSION['ITEMINFORM'])) {

			$_SESSION['ITEMINFORM'] = ($_GET['item']);

			$codigoItem = $_SESSION['ITEMINFORM'];

		}
		else {

			if (!isset($_GET['item'])) {

				$codigoItem = $_SESSION['ITEMINFORM'];
			}
			else {

				$codigoItem = ($_GET['item']);
			}
		}
		
		$sql = "Select itemensaio.Codigo, itemensaio.DataChegada, itemensaio.Obs, pedidoensaios.Sequencial, tbl_empresas.Nome, itemensaio.NomeArtigo, itemensaio.Quantidade, produtos.Nome as NomeProd from produtos, tbl_empresas, pedidoensaios, itemensaio where itemensaio.CodPedEns = pedidoensaios.Codigo and itemensaio.CodProd = produtos.Codigo and pedidoensaios.CodNomeEmpr = tbl_empresas.Codigo and itemensaio.Codigo = $codigoItem";
		
		$select = mysqli_query($con,$sql);
		
		//CAPTURANDO AS INFORMAÇÕES DO SELECT
		if ($rf = mysqli_fetch_array($select)) {
			
			$sequencial = $rf['Sequencial'];
			$empresa = $rf['Nome'];
			$nomeArtigo = $rf['NomeArtigo'];
			$dataRecebimento = $rf['DataChegada'];
			$obsFinal = $rf['Obs'];
			$quantidade = $rf['Quantidade'];
			$tipoProduto = $rf['NomeProd'];
			
			//CONVERTENDO A DATA
			$dataRecebimento = dataBrasileira($dataRecebimento);

		}
		
		//VERIFICANDO SE O CAMPO DE DATA OU OBSERVAÇÃO FORAM PREENCHIDOS
		
	}

?>


<html>


	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<title>S-LAB :: Cadastro de empresas</title>

		<!-- ARQUIVOS CSS IMPORTADOS -->
		
			<link rel="stylesheet" type="text/css" href="../../styles/modular.css">
			<link rel="stylesheet" type="text/css" href="../../styles/controleDataEntrada.css">
			
		<!--------------------------->

		<!-- ARQUIVOS JAVASCRIPT -->
					
			<script type="text/javascript" src="../../js/jquery.js"></script>		
			<script type="text/javascript" src="../../js/mascara.js"></script>
			<script type="text/javascript" src="../../js/modular.js"></script>
			<script type="text/javascript" src="../js/validacao.js"></script>
		
		<!-- ------------------ -->

		
	</head>


	<body>

		

		<div class="principal">

			<a href="../../inicial/index.php" class="cm_home"></a>
			
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
				
				<span class="lk_confPessoal2"><a href="index.php?sair">Sair</a></span>
				
				<!-- ---------------------- -->
			
				<!-- MENU SECUNDÁRIO -->
				
					<div class="submenu_cont">
						
						
						<span class="subtitulo2" id="ini_tit3">Selecione um item abaixo:</span>
						
						<!-- OPÇÕES PARA RELATÓRIOS -->
						
							<ul class="listas" id="ini_lst1" type="square">
								
								<li><a href="../../relatorios/planoAtendimento/" class="lk_lista">Plano de atendimento</a></li>
								<li><a href="../../relatorios/etiquetas/" class="lk_lista">Etiquetas para amostras</a></li>
								<li><a href="../../relatorios/recebimentoItens/" class="lk_lista">Recebimento de itens para ensaio</a></li>
							
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
								
								<li><a href="../../solicitacao/controle/" class="lk_lista">Controle de solicitações de ensaio</a></li>
								<li><a href="../index.php" class="lk_lista">Controle de entrada e saída de amostras</a></li>
								
							</ul>
						
						<!-- --------------------- -->
						
					</div>
				
				<!-- ----------------- -->
			
			
				<div id="cont2">
					
					<form method="post" action="index.php">				
					
						<span class="subtitulo2" id="cadSolicitacao_princ">Definir a data de recebimento da amostra</span>
				
				
						<!-- INFORMAÇÕES SOBRE O SEQUÊNCIAL -->
						
						<span id="cadSolicitacao_tit1" class="texto">Informações sobre a solicitação e amostra</span>
						
						<span id="cadSolicitacao_tit2_especEA" class="texto">Número do Sequêncial:</span>
						
						<span id="cadSolicitacao_tit4" class="texto3"><?php echo $sequencial; ?></span>
						
						<span id="cadSolicitacao_tit3_especEA" class="texto">Empresa:</span>
						
						<span id="cadSolicitacao_tit5" class="texto3"><?php echo $empresa; ?></span>
						
						<span id="cadSolicitacao_tit6" class="texto">Nome do artigo:</span>
						
						<span id="cadSolicitacao_tit9" class="texto3"><?php echo $nomeArtigo; ?></span>
						
						<span id="cadSolicitacao_tit7" class="texto">Quantidade:</span>
						
						<span id="cadSolicitacao_tit10" class="texto3"><?php echo $quantidade; ?></span>
						
						<span id="cadSolicitacao_tit8" class="texto">Tipo do produto:</span>
						
						<span id="cadSolicitacao_tit11" class="texto3"><?php echo $tipoProduto; ?></span>
						
						<!-- ------------------------------ -->
						
						<!-- DATA DA ENTRADA DA AMOSTRA -->
						
						<span id="cadSolicitacao_tit12" class="texto">Data de recebimento:</span>
						
						<input type="text" class="cx_data" name="txt_dataReceb" id="cx1_CadSolicitacao" value="<?php if($dataRecebimento != "00/00/0000"){ echo $dataRecebimento; } ?>" />
						
						<span id="cadSolicitacao_tit13" class="texto">Observações:</span>
						
						<textarea name="txt_obs" id="cx2_CadSolicitacao_especEA" class="texto" cols="10" rows="10"><?php if ($obsFinal != "") { echo $obsFinal; } ?></textarea>
						
						<input type="submit" name="btn_enviarDr" value="      Registrar" id="bt_ncadastro" class="subtitulo2" />
						
						<!-- -------------------------- -->
					
					</form>
					
				</div>
					
				<!-- ------------------ -->


		</div>


	</body>


</html>