<?php

	//ARQUIVO DE CONEXÃO COM O BANCO DE DADOS
	//include("../php/conexao.php");

	//FUNÇÕES MODULARES DO SISTEMA
	//include("../php/modular.php");

	//CHECAR SE FOI REALIZADA A CONEXÃO DO USUÁRIO
//	conexaoUsuario();
	
	//REALIZANDO UMA PESQUISA ESPECÍFICA
	
	if (isset($_POST['btn_buscar_nome'])) {

		if (!isset($_SESSION['CONSULTAPERSON'])) {
	
			$_SESSION['CONSULTAPERSON'] = "ATIVADO";
		}

		$nomeEmpresaBusca = ($_POST['txt_buscarNome']);

		$_SESSION['NOMEEMPRESABUSCA'] = $nomeEmpresaBusca;

	}
		
	//---------------------------------	
	
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
			$paginador = (7*$numeroPagina);
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
		
		$sql = "Select * from tbl_empresas where Codigo = $codigo";
		$select = mysqli_query($con,$sql);
		
		//CAPTURANDO OS DADOS DA CONSULTA DO BANCO DE DADOS
		if ($rf = mysqli_fetch_array($select)) {
			
			$empresa = $rf['Nome'];
			$codCliente = $rf['CodigoCliente'];
			$cnpj = $rf['CNPJ'];
			$ie = $rf['Ie'];
			$email = $rf['Email'];
			$endereco = $rf['Endereco']; 
			$numero = $rf['Numero'];
			$cidade = $rf['Cidade'];
			$bairro = $rf['Bairro'];
			$estado = $rf['Estado'];
			$cep = $rf['CEP'];
			$telefone = $rf['Telefone'];
			$telefone2 = $rf['Telefone2'];
			$celular = $rf['Celular'];
			$ramal = $rf['Ramal'];
			$fax = $rf['Fax'];
			$contato = $rf['Contato'];
			$sgset = $rf['Sgset'];
			$cpf = $rf['CPF'];
		
			
			//ALGORITMO PARA DEFINIR A PERFUMARIA DE CÓDIGO DE CLIENTE
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



	//EXCLUIR EMPRESA -- NA VERDADE NÃO É EXCLUÍDO
	if(isset($_GET['excluir'])) {

		$codigo = ($_GET['excluir']);

		$sql = "update tbl_empresas set Status = 1 where Codigo = $codigo";

		mysqli_query($con,$sql);

?>

<script type="text/javascript">

	alert('Cliente deletado com sucesso!');

</script>


<?php
		
	}


	//ROTINA QUE CONTABILIZA O NÚMERO DE PÁGINAS
	
	//CONTAR A QUANTIDADE DE REGISTROS NA TABELA
	if (( (!isset($_SESSION['CONSULTAPERSON'])) && (!isset($_SESSION['NOMEEMPRESABUSCA']) )) || ($_SESSION['NOMEEMPRESABUSCA'] == "")) {
	
		//CASO NENHUMA PESQUISA ESPECÍFICA DE EMPRESA SEJA REALIZADA
		$sql = "Select COUNT(*) from tbl_empresas where Status = 0";
	}
	else {
				
		//CASO OCORRA UMA PESQUISA DE EMPRESA PERSONALIZADA
		$sql = "Select COUNT(*) from tbl_empresas where tbl_empresas.Nome like '%$nomeEmpresaBusca%' and Status = 0";
	}
	
	$select = mysqli_query($con,$sql);
			
	if ($rf = mysqli_fetch_array($select)) {
				
		$quantidadeRegistros = $rf['COUNT(*)'];
	}
		
	$npaginas = ($quantidadeRegistros/7);
		
	//ARREDONDANDO QUANTIDADE DE REGISTROS PARA CIMA PARA GERAR O NÚMERO DE PÁGINAS CORRETO
	$totalPaginas = ceil($npaginas);
	//-------------------------------------------

?>

<html>


	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<title>S-LAB :: Cadastro de empresas</title>

		<!-- ARQUIVOS CSS IMPORTADOS -->
		
			<link rel="stylesheet" type="text/css" href="">
			<link rel="stylesheet" type="text/css" href="">
			
		<!--------------------------->

		<!-- ARQUIVOS JAVASCRIPT -->
					
			<script type="text/javascript" src="../js/jquery.js"></script>		
			<script type="text/javascript" src="../js/mascara.js"></script>
			<script type="text/javascript" src="../js/modular.js"></script>
			<script type="text/javascript" src="js/validacao.js"></script>
		
		<!-- ------------------ -->

		<!-- VALIDAÇÃO DO FORMULÁRIO -->

		
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
								
								<li><a href="#" class="lk_lista">Empresas</a></li>
								<li><a href="../ensaios/" class="lk_lista">Tipos de ensaios</a></li>
								<li><a href="../funcionarios/" class="lk_lista">Funcionários</a></li>
								<li><a href="../tiposTecido/" class="lk_lista">Tipos de tecidos</a></li>
								<li><a href="../normas/" class="lk_lista">Normas</a></li>
								<li><a href="../produtos/" class="lk_lista">Produtos</a></li>
								<li><a href="../composicoes/" class="lk_lista">Composições</a></li>
								
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
			
				<!-- CADASTRO DE EMPRESAS -->
			
				<div id="cont2">
					
					<form id="form_cadEmpresas" name="frm_cadEmpresas" action="php/cadastro.php" method="post">
					
					<span class="subtitulo2" id="ini_tit4">Cadastramento de empresas</span>
					
					<!-- FORMULÁRIO DE CADASTRO DE EMPRESA -->
					
						<span id="cadEmpresa_tit1" class="texto">Código do cliente</span>
						
						<input type="text" name="txt_codcliente" onclick="cor(this);" class="cx_numeros" maxlength="10" id="cx1_CadEmpresas" value="<?php if(isset($codCliente)) { echo $codCliente; } ?>" />
												
						<span id="cadEmpresa_tit2" class="texto">Empresa</span>
					
						<input type="text" name="txt_nome" onclick="cor(this);" maxlength="100" class="cx_texto2" id="cx2_CadEmpresas" value="<?php if(isset($empresa)) { echo $empresa; } ?>" />
					
						<span id="cadEmpresa_tit3" class="texto">CNPJ</span>
					
						<input type="text" name="txt_cnpj" onclick="cor(this);" maxlength="18" class="cx_cnpj" id="cx3_CadEmpresas" value="<?php if(isset($cnpj)) { echo $cnpj; } ?>" />
					
						<span id="cadEmpresa_tit4" class="texto">Inscrição Estadual</span>
						
						<input type="text" name="txt_ie" onclick="cor(this);" class="cx_texto2" id="cx4_CadEmpresas" value="<?php if(isset($ie)) { echo $ie; } ?>" />
					
						<span id="cadEmpresa_tit5" class="texto">E-mail</span>
					
						<input type="text" name="txt_email" onclick="cor(this);" maxlength="200" class="cx_texto2" id="cx5_CadEmpresas" value="<?php if(isset($email)) { echo $email; } ?>" />
					
						<!-- ----------------------------------------------------------------------- -->
					
						<span id="cadEmpresa_tit6" class="texto">Endereço</span>
					
						<input type="text" name="txt_endereco" onclick="cor(this);" maxlength="100" class="cx_texto2" id="cx6_CadEmpresas" value="<?php if(isset($endereco)) { echo $endereco; } ?>" />
					
						<span id="cadEmpresa_tit7" class="texto">Número</span>
					
						<input type="text" name="txt_numero" onclick="cor(this);" maxlength="10" class="cx_numeros" id="cx7_CadEmpresas" value="<?php if(isset($numero)) { echo $numero; } ?>" />
					
						<span id="cadEmpresa_tit8" class="texto">Cidade</span>
					
						<input type="text" name="txt_cidade" onclick="cor(this);" maxlength="50" class="cx_texto2" id="cx8_CadEmpresas" value="<?php if(isset($cidade)) { echo $cidade; } ?>" />
						
						<span id="cadEmpresa_tit9" class="texto">Bairro</span>
					
						<input type="text" name="txt_bairro" onclick="cor(this);" maxlength="50" class="cx_texto2" id="cx9_CadEmpresas" value="<?php if(isset($bairro)) { echo $bairro; } ?>" />
					
						<span id="cadEmpresa_tit10" class="texto">Estado</span>
					
						<input type="text" name="txt_estado" onclick="cor(this);" class="cx_texto2" id="cx10_CadEmpresas" maxlength="2" value="<?php if(isset($estado)) { echo $estado; } ?>" />
					
						<!-- ------------------------------------------------------------------------- -->
						
						<span id="cadEmpresa_tit11" class="texto">CEP</span>
					
						<input type="text" name="txt_cep" onclick="cor(this);" maxlength="9" class="cx_cep" id="cx11_CadEmpresas" value="<?php if(isset($cep)) { echo $cep; } ?>" />
					
						<span id="cadEmpresa_tit12" class="texto">Telefone 1</span>
					
						<input type="text" name="txt_telefone" onclick="cor(this);" maxlength="14" class="cx_telefone" id="cx12_CadEmpresas" value="<?php if(isset($telefone)) { echo $telefone; } ?>" />
					
						<span id="cadEmpresa_tit13" class="texto">Ramal</span>
						
						<input type="text" name="txt_ramal" onclick="cor(this);" maxlength="10" class="cx_numeros" id="cx13_CadEmpresas" value="<?php if(isset($ramal)) { echo $ramal; } ?>" />
						
						<span id="cadEmpresa_tit14" class="texto">FAX</span>
					
						<input type="text" name="txt_fax" onclick="cor(this);" class="cx_texto2" id="cx14_CadEmpresas" value="<?php if(isset($fax)) { echo $fax; } ?>" />
					
						<span id="cadEmpresa_tit15" class="texto">Contato</span>
					
						<input type="text" name="txt_contato" onclick="cor(this);" maxlength="200" class="cx_texto2" id="cx15_CadEmpresas" value="<?php if(isset($contato)) { echo $contato; } ?>" />
					
						<span id="cadEmpresa_tit16" class="texto">Código SGSET</span>
					
						<input type="text" name="txt_sgset" onclick="cor(this);" maxlength="10" class="cx_numeros" id="cx16_CadEmpresas" value="<?php if(isset($sgset)) { echo $sgset; } ?>" />
					
						<span id="cadEmpresa_tit25" class="texto">Telefone 2</span>
					
						<input type="text" name="txt_telefone2" onclick="cor(this);" maxlength="14" class="cx_telefone" id="cx20_CadEmpresas" value="<?php if(isset($telefone2)) { echo $telefone2; } ?>" />
					
						<span id="cadEmpresa_tit26" class="texto">Celular</span>
					
						<input type="text" name="txt_celular" onclick="cor(this);" maxlength="15" class="cx_celular" id="cx21_CadEmpresas" value="<?php if(isset($celular)) { echo $celular; } ?>" />
					
						<span id="cadEmpresa_tit24" class="texto">CPF / RG</span>
						
						<input type="text" name="txt_cpf" onclick="cor(this);" maxlength="14" class="cx_texto2" id="cx19_CadEmpresas" value="<?php if(isset($cpf)) { echo $cpf; } ?>" />
					
					<!-- --------------------------------- -->			
					
					<?php
					
					
						if (!isset($_GET['editar'])) {
					
					?>
							<input type="button" onclick="validar();" class="subtitulo2" id="bt_cadastrou" name="btn_cadastrar" value="Cadastrar" />
							<!--<input type="button" onclick="validar();" class="subtitulo2" id="bt_cadastrar" name="btn_cadastrar" value="Cadastrar" />-->
							<input type="hidden" name="txt_cad" />
					
					<?php
					
						}else {	
					
					?>
					
							<input type="button" onclick="validar();" class="subtitulo2" id="bt_cadastrou" name="btn_atualizar" value="Atualizar" />
					
							
							<a href="index.php">
								<div id="bt_ncadastro" class="subtitulo2"><span id="bt_ncadastro_compl">Novo</span></div>
							</a>
							
					
					
					<?php
					
					
						}
					
					
					?>
					
					</form>
					
					
					<!-- TABELA DE CONSULTA DE CLIENTES CADASTRADOS -->
					
					<span id="cadEmpresa_tit17" class="texto">Empresa</span>
					
					<span id="cadEmpresa_tit18" class="texto">CNPJ/CPF</span>
					
					<span id="cadEmpresa_tit19" class="texto">Código</span>
					
					<div id="tabelaCadEmpresas">
						
						<table class="texto3">
						
						<?php						
							
							//CONSULTANDO DADOS NO BANCO REFERENTES A TABELA DE EMPRESAS
							if (( (!isset($_SESSION['CONSULTAPERSON'])) && (!isset($_SESSION['NOMEEMPRESABUSCA']) )) || ($_SESSION['NOMEEMPRESABUSCA'] == "")) {							
								$sql = "Select Codigo, Nome, CNPJ, CPF, CodigoCliente from tbl_empresas where status = 0 order by CodigoCliente asc limit $paginador, 7";
							}
							else {
								$nomeEmpresaBusca = $_SESSION['NOMEEMPRESABUSCA'];
								$sql = "Select Codigo, Nome, CNPJ, CPF, CodigoCliente from tbl_empresas where tbl_empresas.Nome like '%$nomeEmpresaBusca%' and status = 0 order by CodigoCliente asc limit $paginador, 7";								
							}
							
							$select = mysqli_query($con,$sql);
							
							while ($rf = mysqli_fetch_array($select)) {
										
									
								$codigoCliente = $rf['CodigoCliente'];
								
								//ALGORITMO PARA DEFINIR A PERFUMARIA DE CÓDIGO DE CLIENTE
								if ($codigoCliente <= 9) {
					
									$codigoCliente = "000"."$codigoCliente";
								}
								elseif (($codigoCliente >= 10)&&($codigoCliente <=99)) {
									
									$codigoCliente = "00".$codigoCliente;				
								}
								elseif (($codigoCliente >= 100)&&($codigoCliente <= 999)) {
									
									$codigoCliente = "0".$codigoCliente;
								}
								//--------------------------------------------------------
						
						?>
						
								<tr>
								
									<td id="linha1_tabelaCadEmpresas"><?php echo($rf['Nome']); ?></td>	
									<td id="linha2_tabelaCadEmpresas">
									<?php 
									
									if ($rf['CNPJ'] == "" || $rf['CNPJ'] == " " || $rf['CNPJ'] == "__.___.___/____-__"){
										echo($rf['CPF']);
									}else {
										echo($rf['CNPJ']);	
									}
										
									?></td>
									<td id="linha3_tabelaCadEmpresas"><?php echo $codigoCliente; ?></td>
									<td id="linha4_tabelaCadEmpresas"><a href="index.php?excluir=<?php echo($rf['Codigo']); ?>"><img src="../imagens/png/bt_excluirEditar.png" /></a></td>
									<td id="linha5_tabelaCadEmpresas"><a href="index.php?editar=<?php echo($rf['Codigo']); ?>"><img src="../imagens/png/bt_Editar.png" /></a></td>
									
								</tr>
						
						<?php
						
						
							}
														
						?>
						
						</table>						
						
					</div>					
					
					<!-- ------------------------------------------ -->
					
					<!-- BOTÕES DE BUSCA -->
					<form action="index.php" method="post">
						
						<span id="cadEmpresa_tit20" class="texto">Empresa:</span>
						
						<input type="text" name="txt_buscarNome" class="cx_texto1" id="cx17_CadEmpresas" />
					
						<input type="submit" name="btn_buscar_nome" id="bt_buscar_nome" value="" />
					
					</form>
					
						<!-- CAMPO DE BUSCA CNPJ OCULTADO PROVISÓRIAMENTE
					
							<span id="cadEmpresa_tit21" class="texto">CNPJ:</span>
						
							<input type="text" name="txt_buscarCNPJ" class="cx_texto1" id="cx18_CadEmpresas" />
							
							<input type="submit" name="btn_buscarCNPJ" id="bt_buscar_cnpj" value="" />
					
						<!-- ------------------------- -->				
					
					<!-- --------------- -->
					
					<!-- QUANTIDADE DE PÁGINAS DE REGISTROS -->
					
					
						<span class="texto" id="cadEmpresa_tit22">Páginas:</span>
					
						<div id="tabelaPaginasEmpresa">
							
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