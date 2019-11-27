<?php $v->layout("layout");?>
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

