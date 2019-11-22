<?php

//ARQUIVO DE CONEXÃO COM O BANCO DE DADOS
//include("../php/conexao.php");

//FUNÇÕES MODULARES DO SISTEMA
//include("../php/modular.php");

//FUNÇÕES DE INSERÇÃO DO SISTEMA
//include("php/cadastro.php");

//CHECAR SE FOI REALIZADA A CONEXÃO DO USUÁRIO
//conexaoUsuario();

//NOVO CADASTRO
if (isset($_GET['novo'])) {

	//ZERANDO A VARIÁVEL QUE CONTROLA ATUALIZAÇÃO DO REGISTRO
	unset($_SESSION['CODUPDTENS']);
}

//FINALIZAR CONEXÃO
if (isset($_GET['sair'])) {

	unset($_SESSION['USUARIO']);
	unset($_SESSION['CODUSUARIO']);

	header("location:../index.php");
}

//CADASTRO DO ENSAIO

if (isset($_POST['btn_cadastrar'])) {

	$codEnsaio = ($_POST['cb_cadEnsaios']);


	//CAPTURANDO OS CAMPOS PREENCHIDOS
	$setor = ($_POST['cb_cadEnsaios']);
	$nome = ($_POST['txt_ensaio']);
	$preco = ($_POST['txt_preco']);
	$carga = ($_POST['txt_carga']);


	//VALIDAÇÃO DE CAMPOS
	if ($setor == "" || $codEnsaio == "" || $preco == "" || $carga == "") {

		?>
		<script type="text/javascript" language="JavaScript">
			alert('POR FAVOR, PREENCHA TODOS OS CAMPOS!');
		</script>
		<?php
				if ($setor == "") {
					?>
			<script type="text/javascript" language="JavaScript">
				document.frm_cadEnsaios.cb_cadEnsaios.style.backgroundColor = "#68A0D9";
			</script>
		<?php
				}

				if ($codEnsaio == "") {
					?>
			<script type="text/javascript" language="JavaScript">
				document.frm_cadEnsaios.txt_ensaio.style.backgroundColor = "#68A0D9";
			</script>
		<?php
				}

				if ($preco == "") {
					?>
			<script type="text/javascript" language="JavaScript">
				document.frm_cadEnsaios.txt_preco.style.backgroundColor = "#68A0D9";
			</script>
		<?php
				}

				if ($carga == "") {
					?>
			<script type="text/javascript" language="JavaScript">
				document.frm_cadEnsaios.txt_carga.style.backgroundColor = "#68A0D9";
			</script>
		<?php
				}
			} else {

				//TROCANDO , POR . ANTES DE INSERIR A INFORMAÇÃO NO BANCO
				$carga = str_replace(",", ".", $carga);
				$preco = str_replace(",", ".", $preco);

				// ------------------------------

				//SE O CADASTRO SER DO VESTUÁRIO
				if ($codEnsaio == 2) {

					cadastrarEVest($setor, $nome, $preco, $carga);
				}

				//SE O CADASTRO SER TÊXTIL
				if ($codEnsaio == 1) {

					cadastrarEText($setor, $nome, $preco, $carga);
				}
			}
		}

		//------------------

		//ATUALIZAR O CADASTRO DO ENSAIO

		if (isset($_POST['btn_atualizar'])) {

			$codEnsaio = ($_POST['cb_cadEnsaios']);


			//CAPTURANDO OS CAMPOS PREENCHIDOS
			$setor = ($_POST['cb_cadEnsaios']);
			$nome = ($_POST['txt_ensaio']);
			$preco = ($_POST['txt_preco']);
			$carga = ($_POST['txt_carga']);



			//VALIDAÇÃO DE CAMPOS
			if ($setor == "" || $codEnsaio == "" || $preco == "" || $carga == "") {

				?>
		<script type="text/javascript" language="JavaScript">
			alert('POR FAVOR, PREENCHA TODOS OS CAMPOS!');
		</script>
		<?php
				if ($setor == "") {
					?>
			<script type="text/javascript" language="JavaScript">
				document.frm_cadEnsaios.cb_cadEnsaios.style.backgroundColor = "#68A0D9";
			</script>
		<?php
				}

				if ($codEnsaio == "") {
					?>
			<script type="text/javascript" language="JavaScript">
				document.frm_cadEnsaios.txt_ensaio.style.backgroundColor = "#68A0D9";
			</script>
		<?php
				}

				if ($preco == "") {
					?>
			<script type="text/javascript" language="JavaScript">
				document.frm_cadEnsaios.txt_preco.style.backgroundColor = "#68A0D9";
			</script>
		<?php
				}

				if ($carga == "") {
					?>
			<script type="text/javascript" language="JavaScript">
				document.frm_cadEnsaios.txt_carga.style.backgroundColor = "#68A0D9";
			</script>
		<?php
				}
			} else {

				//TROCANDO , POR . ANTES DE INSERIR A INFORMAÇÃO NO BANCO
				$carga = str_replace(",", ".", $carga);
				$preco = str_replace(",", ".", $preco);

				// ------------------------------

				//SE O CADASTRO SER DO VESTUÁRIO
				if ($codEnsaio == 2) {

					atualizarEVest($setor, $nome, $preco, $carga);
				}

				//SE O CADASTRO SER TÊXTIL
				if ($codEnsaio == 1) {

					atualizaEText($setor, $nome, $preco, $carga);
				}
			}

			unset($_SESSION['CODUPDTENS']);
		}

		//------------------------------

		// ADICIONAR AS NORMAS PARA O ENSAIO - SOMENTE PARA CADASTRO DE ENSAIOS TÊXTEIS

		if (isset($_POST['btn_insNorma'])) {

			//QUEBRANDO A STRING CAPTURADA NO CÓDIGO DA REFERÊNCIA
			$referencia = ($_POST['combo_norma']);

			//DADOS DAS CAIXAS DE TEXTOS - EVITAR QUE OS MESMOS SEJAM PERDIDOS

			$nome = ($_POST['txt_ensaio']);
			$codEnsaio = ($_POST['cb_cadEnsaios']);;
			$carga = ($_POST['txt_carga']);
			$preco = ($_POST['txt_preco']);

			//VERIFICADOR -- UTILIZADO PARA DETERMINAR SE UMA REFERÊNCIA FOI ADICIONADA MAIS DE UMA VEZ
			$verificador = 0;

			$chave = $codEnsaio;

			$refer = explode(";", $referencia);

			//CRIANDO A SESSÃO-ARRAY QUE ARMAZENARÁ AS REFERÊNCIAS ADICIONADAS
			if (!isset($_SESSION['CODNORMA'])) {

				$addReferencia = array();
				$nomeReferencia = array();
				$contador = 0;

				//PEGANDO O NOME E CÓDIGO DA REFERÊNCIA SELECIONADA E ADICIONANDO NA SESSÃO-ARRAY
				$addReferencia[$contador] = $refer[0];
				$nomeReferencia[$contador] = $refer[1];

				//SALVANDO O ARRAY DE REFERÊNCIAS NA VARIÁVEL DE SESSÃO
				$_SESSION['CODNORMA'] = $addReferencia;
				$_SESSION['NOMENORMA'] = $nomeReferencia;
			} else {

				//SE A VARIÁVEL DE SESSÃO EXISTIR E TER CONTEÚDO, PROSSEGUIR ADICIONANDO O CÓDIGO DA NOVA REFERÊNCIA
				$contador = count($_SESSION['CODNORMA']);

				//VERIFICAR SE A REFERÊNCIA JÁ FOI ADICIONADA
				for ($i = 0; $i < $contador; $i++) {

					if ($_SESSION['CODNORMA'][$i] == $refer[0]) {

						$verificador = 1;
					}
				}

				if ($verificador != 1) {

					$_SESSION['CODNORMA'][$contador] = $refer[0];
					$_SESSION['NOMENORMA'][$contador] = $refer[1];
				} else {
					?>

			<script type="text/javascript">
				alert('A REFERÊNCIA SELECIONADA JÁ FOI ADICIONADA, POR FAVOR, SELECIONE OUTRA!');
			</script>

	<?php

			}
		}

		//----------------------------------------------------------------

	}

	// -----------------------------------------------------------------------


	// RETIRAR A REFERÊNCIA QUE FOI ADICIONADA NA RELAÇÃO
	if (isset($_GET['retirarRef'])) {

		$codReferencia = ($_GET['retirarRef']);
		$nome = ($_GET['ensaio']);
		$codEnsaio = ($_GET['setor']);
		$carga = ($_GET['carga']);
		$preco = ($_GET['preco']);

		$chave = $codEnsaio;

		$contador = count($_SESSION['CODNORMA']);


		//PERCORRE O ARRAY COM AS REFERÊNCIAS ADICIONADAS E AO ENCONTRAR O VALOR PARA SER RETIRADO, EXLUI O NOME DA REFERÊNCIA E O CÓDIGO
		for ($i = 0; $i < $contador; $i++) {

			if ($_SESSION['CODNORMA'][$i] == $codReferencia) {

				//EXCLUINDO O ÍNDICE SELECIONADO NO ARRAY
				$_SESSION['CODNORMA'][$i] = 0;
				$_SESSION['NOMENORMA'][$i] = 0;
			}
		}
	}


	// --------------------


	//AO ESCOLHER O TIPO DE ENSAIO A SER CADASTRADO

	if (isset($_GET['escolher'])) {

		$nome = ($_GET['ensaio']);
		$codEnsaio = ($_GET['setor']);
		$carga = ($_GET['carga']);
		$preco = ($_GET['preco']);

		if (isset($_SESSION['CODNORMA'])) {

			unset($_SESSION['CODNORMA']);
			unset($_SESSION['NOMENORMA']);
		}


		//CHAVE QUE DETERMINA SE O ENSAIO CADASTRADO SERÁ TÊXTIL OU VESTUÁRIO
		$chave = $codEnsaio;
	}

	//---------------------------------------------

	//ROTINA QUE REALIZA A PAGINAÇÃO DE REGISTROS DO BANCO DE DADOS
	if (isset($_GET['clickPag'])) {

		//PEGA O NÚMERO DA PÁGINA
		$numeroPagina = ($_GET['clickPag']);
		$numeroMK = $numeroPagina;

		if ($numeroPagina != 1) {

			$numeroPagina -= 1;
			$paginador = (11 * $numeroPagina);
		} else {

			$paginador = 0;
		}
	} else {

		$numeroMK = 1;
		$paginador = 0;
	}
	//-------------------------------------------------------------


	//CONSULTAR O REGISTRO DA TABELA
	if (isset($_GET['editar'])) {


		$codigo = ($_GET['editar']);

		$_SESSION['CODUPDTENS'] = $codigo;

		$sql = "Select Codigo, Nome, CodEnsaio, Carga, Preco from tiposdeensaios where Codigo = $codigo";

		$select = mysqli_query($con, $sql);

		if ($rf = mysqli_fetch_array($select)) {

			$nome = $rf['Nome'];
			$codEnsaio = $rf['CodEnsaio'];
			$carga = str_replace(".", ",", $rf['Carga']);
			$preco = str_replace(".", ",", $rf['Preco']);
		}

		//CHAVE QUE ABRE MODO DE INSERÇÃO DE ENSAIO TÊXTIL OU DO VESTUÁRIO
		$chave = $codEnsaio;

		//CONSULTA NO BANCO DE DADOS AS REFERÊNCIAS RELACIONADAS A INSTRUÇÃO DE TRABALHO

		$sql = "Select normas.Nome, normas.Codigo from ensaiownorma, normas where ensaiownorma.CodNorma = normas.Codigo and ensaiownorma.CodTipEns = $codigo";

		$select = mysqli_query($con, $sql);

		//CONTADOR
		$i = 0;

		//VERIFICAR SE A SESSÃO EXISTE
		if (isset($_SESSION['CODNORMA'])) {

			unset($_SESSION['CODNORMA']);
			unset($_SESSION['NOMENORMA']);
		}

		//CARREGANDO O ARRAY DE REFERÊNCIAS
		while ($rf = mysql_fetch_array($select)) {

			$_SESSION['CODNORMA'][$i] = $rf['Codigo'];
			$_SESSION['NOMENORMA'][$i] = $rf['Nome'];

			$i++;
		}

		//------------------------------------------------------------------------------


	}

	// ------------------------------------



	//EXCLUIR ENSAIO -- NA VERDADE NÃO É EXCLUÍDO 0 PARA ATIVO E 1 PARA DESATIVADO
	if (isset($_GET['excluir'])) {

		$codigo = ($_GET['excluir']);

		$sql = "Update tiposdeensaios set Status = 1 where Codigo = $codigo";

		mysqli_query($con, $sql);

		?>

	<script type="text/javascript">
		alert('Ensaio deletado com sucesso!');
	</script>


<?php

}


//ROTINA QUE CONTABILIZA O NÚMERO DE PÁGINAS

//ATRAVÉS DO FILTRO DE ENSAIOS (TEXTIL OU VESTUÁRIO), DECIDIR QUAL SELECT UTILIZAR.	
if (isset($_GET['filtrar'])) {

	$codfiltro = ($_GET['filtrar']);

	$nome = ($_GET['ensaio']);
	$codEnsaio = ($_GET['setor']);
	$carga = ($_GET['carga']);
	$preco = ($_GET['preco']);

	$chave = $codEnsaio;

	if ($codfiltro == "todos") {

		$sql = "Select COUNT(*) from tiposdeensaios where Status = 0";
	} else {

		$sql = "Select COUNT(*) from tiposdeensaios where Status = 0 and CodEnsaio = $codfiltro";
	}
} else {

	$sql = "Select COUNT(*) from tiposdeensaios where Status = 0";
}

//CONTAR A QUANTIDADE DE REGISTROS NA TABELA
$select = mysqli_query($con, $sql);

if ($rf = mysqli_fetch_array($select)) {

	$quantidadeRegistros = $rf['COUNT(*)'];
}

$npaginas = ($quantidadeRegistros / 11);

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
	<link rel="stylesheet" type="text/css" href="../styles/cadEnsaios.css">

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
				<li><a href="#" class="lk_lista">Tipos de ensaios</a></li>
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



		<!-- ------------------ -->

		<!-- CADASTRO DE EMPRESAS -->

		<div id="cont2">

			<span class="subtitulo2" id="ini_tit4">Cadastramento de ensaios têxteis e do vestuário</span>

			<!-- FILTROS DE ENSAIOS -->

			<span class="subtitulo2" id="cadEnsaio_tit9">Filtrar ensaios:</span>


			<select class="cx_texto2" id="cmb3_cadEnsaios" onchange="filtrarEnsaios(this);">

				<option value="todos">TODOS</option>

				<?php

				$sql = "Select * from ensaios";

				$select = mysql_query($sql);

				while ($rf = mysql_fetch_array($select)) {

					?>
					<option <?php if ($codfiltro == $rf['Codigo']) {
									echo "selected";
								} ?> value="<?php echo ($rf['Codigo']); ?>"><?php echo (utf8_encode($rf['Nome'])); ?></option>

				<?php

				}

				?>

			</select>

			<!-- ----------------- -->


			<!-- FORMULÁRIO DO CADASTRO -->

			<form name="frm_cadEnsaios" action="index.php" method="post">

				<span class="texto" id="cadEnsaio_tit1">Setor</span>

				<select name="cb_cadEnsaios" class="cx_texto2" id="cmb1_cadEnsaios" onchange="escolherEnsaio(this);" onclick="cor(this);">

					<option></option>

					<?php

					$sql = "Select * from ensaios";

					$select = mysql_query($sql);

					while ($rf = mysql_fetch_array($select)) {

						?>
						<option <?php if ($codEnsaio == $rf['Codigo']) {
										echo "selected";
									} ?> value="<?php echo ($rf['Codigo']); ?>"><?php echo (utf8_encode($rf['Nome'])); ?></option>

					<?php

					}

					?>

				</select>


				<span class="texto" id="cadEnsaio_tit2">Ensaio</span>

				<input class="cx_texto2" id="cx1_cadEnsaios" name="txt_ensaio" onclick="cor(this);" maxlength="150" value="<?php if (isset($nome)) {
																																echo $nome;
																															} ?>" />


				<span class="texto" id="cadEnsaio_tit3">Carga Horária (Horas)</span>

				<input type="text" class="cx_precos" id="cx2_CadEnsaios" name="txt_carga" maxlength="10" onclick="cor(this);" value="<?php if (isset($carga)) {
																																			echo $carga;
																																		} ?>" />


				<span class="texto" id="cadEnsaio_tit4">Preço</span>

				<input type="text" class="cx_precos" id="cx3_CadEnsaios" name="txt_preco" onclick="cor(this);" maxlength="10" value="<?php if (isset($preco)) {
																																			echo $preco;
																																		} ?>" />

				<!-- IMAGEM DO MICROSCÓPIO -->

				<?php

				if (($chave == 2) || (!isset($chave)) || ($chave == "")) {

					?>

					<div id="microscopio_cadEnsaios"></div>

				<?php

				}

				?>

				<!-- --------------------- -->


				<!-- CASO O CADASTRO SEJA PARA UM ENSAIO TÊXTIL -->

				<?php


				if ($chave == 1) {


					?>

					<span class="texto" id="cadEnsaio_tit10">Adicione a(s) norma(s) ao ensaio</span>


					<select name="combo_norma" class="cx_texto2" id="cmb4_cadEnsaios">

						<?php

							$sql = "Select Codigo, Nome from normas where Status = 0";

							$select = mysql_query($sql);

							while ($rf = mysql_fetch_array($select)) {

								?>

							<option value="<?php echo $rf['Codigo'] . ";" . $rf['Nome']; ?>"><?php echo $rf['Nome']; ?></option>

						<?php

							}

							?>

					</select>

					<input type="submit" id="bt_insNorma" name="btn_insNorma" value="" />

					<!-- TABELA COM A RELAÇÃO DE NORMAS -->

					<div id="cont_relnormas">


						<table class="texto3">

							<?php


								if (isset($_SESSION['CODNORMA'])) {
									//CONTANDO A QUANTIDADE DE 
									$contador = count($_SESSION['CODNORMA']);

									for ($i = 0; $i < $contador; $i++) {

										//VERIFICA SE A REFERÊNCIA NO ARRAY ENCONTRA-SE EXCLUÍDA - SE VALOR DIFERENTE DE 0 , MOSTRAR A REFERÊNCIA ADICIONADA
										if ($_SESSION['CODNORMA'][$i] != 0) {
											?>

										<tr>
											<td id="linha1_tabelaInsNorma"><?php echo $_SESSION['NOMENORMA'][$i]; ?></td>
											<td id="linha2_tabelaInsNorma"><input type="button" id="bt_retirarRef" name="btn_retirar" onclick="pegarRef('<?php echo $_SESSION['CODNORMA'][$i]; ?>');" value="Retirar" /></td>
										</tr>

							<?php
										}
									}
								}

								?>

						</table>


					</div>


					<!-- ------------------------------ -->
				<?php

				}

				?>

				<!-- ----------------------------------------- -->

				<!-- --------------------------------- -->


				<!-- COLOCAÇÃO/POSICIONAMENTO DOS BOTÕES VALIDAR OU CADASTRAR -->

				<?php


				if (!isset($_SESSION['CODUPDTENS'])) {

					?>

					<input type="submit" name="btn_cadastrar" id="bt_cadastrou" value="Cadastrar" class="subtitulo2" />

					<input type="hidden" name="txt_cad" />

				<?php

				} else {

					?>

					<input type="submit" name="btn_atualizar" id="bt_cadastrou" value="Atualizar" class="subtitulo2" />

					<a href="index.php?novo">
						<div id="bt_ncadastro" class="subtitulo2"><span id="bt_ncadastro_compl">Novo</span></div>
					</a>

				<?php


				}


				?>

			</form>

			<!-- ------------------------------------------ -->


			<!-- TABELA DE CONSULTA DE ENSAIOS CADASTRADOS -->

			<span class="texto" id="cadEnsaio_tit6">Ensaio</span>

			<span class="texto" id="cadEnsaio_tit7">Carga Horária</span>

			<span class="texto" id="cadEnsaio_tit8">Preço</span>



			<div id="tabelaCadEnsaios">

				<table class="texto3">

					<?php

					//CONSULTANDO DADOS NO BANCO REFERENTES A TABELA DE ENSAIOS							

					//--------------------------------------------------------

					if (isset($_GET['filtrar'])) {

						$codEnsaio = ($_GET['filtrar']);

						if ($codEnsaio != "todos") {

							$sql = "Select Codigo, Nome, Carga, Preco from tiposdeensaios where status = 0 and CodEnsaio = $codEnsaio order by 'Codigo' desc limit $paginador, 11";
						} else {

							$sql = "Select Codigo, Nome, Carga, Preco from tiposdeensaios where status = 0 order by 'Codigo' desc limit $paginador, 11";
						}
					} else {

						$sql = "Select Codigo, Nome, Carga, Preco from tiposdeensaios where status = 0 order by 'Codigo' desc limit $paginador, 11";
					}

					$select = mysql_query($sql);


					while ($rf = mysql_fetch_array($select)) {

						$preco = str_replace(".", ",", $rf['Preco'])

						?>

						<tr>

							<td id="linha1_tabelaCadEnsaios"><?php echo ($rf['Nome']); ?></td>
							<td id="linha2_tabelaCadEnsaios"><?php echo ($rf['Carga']); ?>h</td>
							<td id="linha3_tabelaCadEnsaios">R$ <?php echo ($preco); ?></td>
							<td id="linha4_tabelaCadEnsaios"><a href="index.php?excluir=<?php echo ($rf['Codigo']); ?>"><img src="../imagens/png/bt_excluirEditar.png" /></a></td>
							<td id="linha5_tabelaCadEnsaios"><a href="index.php?editar=<?php echo ($rf['Codigo']); ?>"><img src="../imagens/png/bt_Editar.png" /></a></td>

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

						for ($i = 1; $i <= $totalPaginas; $i++) {


							if ($i != $numeroMK) {

								?>

								<td><a href="index.php?
												<?php
														if (isset($_GET['filtrar'])) {

															$codEnsaio = $_GET['filtrar'];

															echo 'clickPag=' . $i . '&filtrar=' . $codEnsaio;
														} else {

															echo 'clickPag=' . $i;
														}
														?>	
												"><?php echo ($i); ?></a></td>

							<?php
								} else {
									?>

								<td><a class="lk_tick" href="index.php?
													<?php
															if (isset($_GET['filtrar'])) {

																$codEnsaio = $_GET['filtrar'];

																echo 'clickPag=' . $i . '&filtrar=' . $codEnsaio;
															} else {

																echo 'clickPag=' . $i;
															}
															?>
													"><?php echo ($i); ?></a></td>

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


				<a href="#" id="lk_movAnt" onmouseover="moveRight();" onmouseout="stopMove();">-</a>
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