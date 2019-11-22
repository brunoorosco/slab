
//FECHAR ABA DO NAVEGADOR
function fechar() {
	
	window.close();
	
}


//NA INTERFACE DE DETALHES DO AGENDAMENTO, ACRESCENTAR O NOME DA EMPRESA
function addCertificadores() {
	
	//CONSTRUINDO OS ELEMENTOS HTML
	botaoSalvar = '<input type=button name=btn_acrescentarCertf onclick=cadastrar("certificadores","cadastrar",""); id=bt_empresaPlus2>';
	botaoRetornar = '<input type=button name=btn_retornarCertf onclick=consultar("certificadores",0,"-"); id=bt_empresaPlus3>';
	cxCertificadores = '<input type=text name=txt_nomeCertificador class=cx_texto2 id=cadEmpresa_tit21Cpl>';
	
	//ADICIONANDO ELEMENTOS HTML NA DIV
	document.getElementById("addEmpresa").innerHTML = '';
	document.getElementById("addEmpresa").innerHTML = cxCertificadores+botaoSalvar+botaoRetornar;
	
}

//FECHAR TODAS AS INTERFACES

function limpaDiv() {
	
	//LIMPANDO A ÁREA DE PONTOS DE CALIBRAÇÃO
	document.getElementById("servicos_container").style.display = 'none';
		
	//LIMPANDO A ÁREA DE ITENS DE CALIBRAÇÃO
	document.getElementById("itCalibr_container").style.display = 'none';
		
	//LIMPANDO A ÁREA DE SERVIÇOS
	document.getElementById("servicos_containerServ").style.display = 'none';

}

//LOCAL PARA ABRIR AS INTERFACES
function abrirInterface(nomeInterface) {
	
	if (nomeInterface == 'itensCalibracao') {
		
		//OCULTANDO
		document.getElementById("servicos_containerServ").style.display = 'none';
		document.getElementById("servicos_container").style.display = 'none';
		
		
		//MOSTRANDO
		document.getElementById("itCalibr_container").style.display = 'block';
		
		//ABRINDO A INTERFACE DOS ITENS DE CALIBRAÇÃO
		consultar('servicosItemCalibracao', 0, '-');
		consultar('listaItensCalibracao', 0, '-');
	
	}
	
	if (nomeInterface == "pontosCalibracao") {

		//OCULTANDO
		document.getElementById("servicos_containerServ").style.display = 'none';
		document.getElementById("itCalibr_container").style.display = 'none';
		document.getElementById('tabela_pontosCalibr').innerHTML = '';
		document.getElementById("comboServEquipPc").innerHTML = '';

		//MOSTRANDO
		document.getElementById("servicos_container").style.display = 'block';

		//ABRINDO A INTERFACE PARA GERENCIAMENTO DOS PONTOS DE CALIBRAÇÃO
		consultar('itensEquipamentoPc', 0, '-');
		consultar('grandezasPc', 0, '-');
		consultar('unidadesPc', 0, '-');

	}
	
	if (nomeInterface == "servicosEquipamento") {
		
		//OCULTANDO
		document.getElementById("servicos_container").style.display = 'none';
		document.getElementById("itCalibr_container").style.display = 'none';
		
		//MOSTRANDO
		document.getElementById("servicos_containerServ").style.display = 'block';
		
		//ABRINDO A INTERFACE PARA GERENCIAMENTO DOS PONTOS DE CALIBRAÇÃO
		consultar('servicosEquipamentos', 0, '-');
				
	}
	
	
}


//BLOQUEANDO CAIXAS DE TEXTO DA ÁREA DE AGENDAMENTOS
function bloqTxtAgend(status) {
		
	if (status == "nao") { //DESBLOQUEAR CAIXAS DE TEXTO
	
		document.getElementById("cx_Contexto2").disabled = false;
		
		
		
	}
	else { //BLOQUEAR CAIXAS DE TEXTO
		
		document.getElementById("cx_Contexto2").disabled = true;
		
	}
	
}

//VALIDAÇÃO - VERIFICAR SE EXISTE CONTEÚDO NA CAIXA DE TEXTO


//BLOQUEANDO E DESBLOQUEANDO CAIXAS DE TEXTO DO CADASTRO
function bloq(status,test) {
	
	limpar('equipamentos');
	
	if (status == "nao") { //DESBLOQUEAR CAIXAS DE TEXTO
		
		if (test == 'sim') {
		
			novoCadEquip('sim');
		
		}
			
		document.getElementById("cx2_CadEmpresas").disabled = false;
		document.getElementById("cx3_CadEmpresas").disabled = false;
		document.getElementById("cx4_CadEmpresas").disabled = false;
		document.getElementById("cx6_CadEmpresas").disabled = false;
		document.getElementById("cx7_CadEmpresas").disabled = false;
		document.getElementById("cx30_CadEmpresas").disabled = false;
		document.getElementById("cx24_CadEmpresas").disabled = false;
		document.getElementById("cx25_CadEmpresas").disabled = false;
		document.getElementById("cx27_CadEmpresas").disabled = false;
		document.getElementById("cx32_CadEmpresas").disabled = false;
		document.getElementById("cx33_CadEmpresas").disabled = false;
		document.getElementById("cx34_CadEmpresas").disabled = false;
		document.getElementById("cx28_CadEmpresasModul").disabled = false;
		document.getElementById("cx29_CadEmpresasModul").disabled = false;
		document.getElementById("cx30_CadEmpresasModul").disabled = false;
		
		
		//LIMPANDO A ÁREA DE PONTOS DE CALIBRAÇÃO
		document.getElementById("servicos_container").style.display = 'none';
			
		//LIMPANDO A ÁREA DE ITENS DE CALIBRAÇÃO
		document.getElementById("itCalibr_container").style.display = 'none';
			
		//LIMPANDO A ÁREA DE SERVIÇOS
		document.getElementById("servicos_containerServ").style.display = 'none';
		
		
	}
	else { //BLOQUEAR CAIXAS DE TEXTO
		
		document.getElementById("cx2_CadEmpresas").disabled = true;
		document.getElementById("cx3_CadEmpresas").disabled = true;
		document.getElementById("cx4_CadEmpresas").disabled = true;
		document.getElementById("cx6_CadEmpresas").disabled = true;
		document.getElementById("cx7_CadEmpresas").disabled = true;
		document.getElementById("cx30_CadEmpresas").disabled = true;
		document.getElementById("cx24_CadEmpresas").disabled = true;
		document.getElementById("cx25_CadEmpresas").disabled = true;
		document.getElementById("cx27_CadEmpresas").disabled = true;
		document.getElementById("cx32_CadEmpresas").disabled = true;
		document.getElementById("cx33_CadEmpresas").disabled = true;
		document.getElementById("cx34_CadEmpresas").disabled = true;
		document.getElementById("cx28_CadEmpresasModul").disabled = true;
		document.getElementById("cx29_CadEmpresasModul").disabled = true;
		document.getElementById("cx30_CadEmpresasModul").disabled = true;
		
	}
	
	//EXCLUINDO CAIXAS DE TEXTO E ADICIONANDO
	
}

//LIBERAR/BLOQUEAR O COMBOBOX DOS EQUIPAMENTOS - CHAMAR ESSA FUNÇÃO AO CLICAR EM 'NOVO' PARA CADASTRAR UM EQUIPAMENTO E APÓS CONCLUIR O CADASTRO DO EQUIPAMENTO
function novoCadEquip(status) {
	
	//AO CLICAR NO BOTÃO NOVO, DESAPARECER COM COMBO QUE POSSUI OS EQUIPAMENTOS CADASTRADOS
	if (status == 'sim') {
		
		document.getElementById('comboEquipamentos').innerHTML = '';
		
	}
	
}


//CRIANDO O OBJETO DO TIPO HTTPXML REQUEST - AJAX
function objetoAj() {

	try{

		//FIREFOX - GOOGLE CHROME
		request = new XMLHttpRequest();

	}catch (IEAtual){

		try {

			//INTERNET EXPLORER V8
			request = new ActiveXObject("Msxml2.XMLHTTP");
		
		}catch(IEAntigo){ 
			
			try {  
				
				//INTERNET EXPLORER V6
				request = new ActiveXObject("Microsoft.XMLHTTP");
				
			}catch(falha) { 
				
				request = false;
				
			} 
			
		} 
		
	}
	
	//CONFIRMANDO SE O OBJETO FOI CRIADO, CASO CONTRÁRIO, NAVEGADOR NÃO POSSUI SUPORTE
	if (!request){
		
		alert("SEU NAVEGADOR NÃO POSSUI AJAX, A OPERAÇÃO NÃO PODE SER PROCEDIDA!");
		
	}
	else {

		return request;
		
	}
	
}


//FUNÇÃO RESPONSÁVEL POR COLOCAR OS DADOS NAS CAIXAS DE TEXTO APÓS UMA CONSULTA
//VARIÁVEIS: TIPO - INFORMA SE É NO FORMULÁRIO DE EQUIPAMENTO OU ITEM DO EQUIPAMENTO
function abastecer(tipo) {
	
	
	
	
}

//FUNÇÃO RESPONSÁVEL POR LIMPAR OS DADOS DAS CAIXAS DE TEXTOS
//VARIÁVEIS: TIPO - INFORMA SE É NO FORMULÁRIO DE EQUIPAMENTO OU ITEM DO EQUIPAMENTO
function limpar(tipo) {
	
	//LIMPAR O FORMULÁRIO DE EQUIPAMENTOS
	if (tipo == "equipamentos") {
		
		//ADICIONANDO O BOTÃO PRINCIPAL
		divBotoes = document.getElementById('divBotao');
		
		divBotoes.innerHTML = '';
		divBotoes.innerHTML = "<input type='button' onclick=cadastrar('equipamentos','cadastrar',''); class='subtitulo2' id='bt_cadastrou' name='btn_cadastrar' value='Cadastrar' />";
		
		//LIMPANDO CAIXAS DE TEXTO
		document.frm_equipamentos.txt_nquipamento.value = '';
		document.frm_equipamentos.txt_nomeEquip.value = '';
		document.frm_equipamentos.txt_fabricante.value = '';
		document.frm_equipamentos.txt_descricao.value = '';
		document.frm_equipamentos.txt_local.value = '';
		document.frm_equipamentos.txt_patrimonio.value = '';
		document.frm_equipamentos.txt_faixaNominal.value = '';
		document.frm_equipamentos.txt_tolerancia.value = '';
		document.frm_equipamentos.txt_resolucao.value = '';
		document.frm_equipamentos.data_incorp.value = '';
		document.frm_equipamentos.data_iniUso.value = '';
		document.frm_equipamentos.data_foraUso.value = '';
		document.frm_equipamentos.chk_foraUso.checked = false;
		document.frm_equipamentos.txt_pcalibracao.value = '';
		document.frm_equipamentos.txt_pmanut.value = '';
		document.frm_equipamentos.txt_pchecagem.value = '';
		
		
	}
	
	//LIMPAR O FORMULÁRIO DE SERVIÇOS DO EQUIPAMENTO
	if (tipo == "servicosEquipamentos") {
		
		//LIMPANDO CAIXAS DE TEXTO
		document.frm_equipamentos.txt_valor.value = '';
		
	}	
	
	//LIMPAR O FORMULÁRIO DE ITENS DE CALIBRAÇÃO DOS EQUIPAMENTOS
	if (tipo == "itensCalibracao") {
		
		//LIMPANDO CAIXAS DE TEXTO
		document.frm_equipamentos.txt_itemCalibr.value = '';
		document.frm_equipamentos.txt_itemfaixa.value = '';
		
	}
	
	if (tipo == "pontosCalibracao") {
		
		//LIMPANDO CAIXAS DE TEXTO
		document.frm_equipamentos.txt_valor.value = '';
		
	}
	
}

//CONSULTA DE DADOS
//PARÂMETROS: TIPO - DEFINE SE É UMA CONSULTA DE ITENS OU EQUIPAMENTOS ; PAG - DEFINE O NÚMERO DA PÁGINA CORRESPONDENTE NA CONSULTA ; METODO - DEFINE SE É UMA CONSULTA UNICA
function consultar(tipo, pag, metodo) {
		
	var xmlreq = objetoAj();
	
	//REALIZAR A CONTAGEM TOTAL DE PÁGINAS E RETORNAR A CONSULTA
	
	if (tipo == "equipamentos") {
		
					//GERANDO UM NÚMERO ALEATÓRIO PARA COMPLEMENTAR A URL E EVITAR QUE OCORRA O CACHE DA PÁGINA, APÓS O REGISTRO NO BANCO DE DADOS
			        n = Math.floor((Math.random() * 100) + 1);
			      			        
			        //VERIFICAR SE É UMA CONSULTA GERAL OU ESPECÍFICA
			        if (metodo != "unico") {
								        				        	
			        	xmlreq.open("GET", "php/funcoes.php?n="+n+"&consultar=equipamentos&param=2&metodo=" , true);			
			        
			        }
			        else {
			        
			        	//CAPTURANDO O VALOR SELECIONADO PELO COMBOBOX
			        	valorCombo = document.frm_equipamentos.cmb_equipamento.value;
			        	
			        	xmlreq.open("GET", "php/funcoes.php?n="+n+"&consultar=equipamentos&param="+valorCombo+"&metodo=unico" , true);	
			        
			        }
					
					xmlreq.onreadystatechange = function() {
						
						
						//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
						if (xmlreq.readyState == 4) {
							
							
							//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
							if (xmlreq.status == 200) {
								
								//COMUNICAÇÃO COM O ARQUIVO PHP OCORREU COM SUCESSO
								
								//VERIFICAR SE ESTÁ CONSULTANDO UM REGISTRO ÚNICO OU GERAL
								if (metodo != "unico") {
																
									//EXTRAINDO OS DADOS DE RETORNO
									retorno = xmlreq.responseText;
									dados = retorno.split("**");
									
									
									//FILTRANDO A MATRIZ DE DADOS
									matrizDados = dados[0].split("^^");
									//---------------------------
									
									/*
									
									//COLOCANDO OS DADOS NAS CAIXAS DE TEXTO
									
									document.frm_equipamentos.txt_nquipamento.value = matrizDados[1];
									document.frm_equipamentos.txt_nomeEquip.value = matrizDados[0];
									document.frm_equipamentos.txt_fabricante.value = matrizDados[2];
									document.frm_equipamentos.txt_descricao.value = matrizDados[4];
									document.frm_equipamentos.txt_local.value = matrizDados[3];
									document.frm_equipamentos.txt_patrimonio.value = matrizDados[5];
									document.frm_equipamentos.txt_faixaNominal.value = matrizDados[6];
									document.frm_equipamentos.txt_tolerancia.value = matrizDados[7];
									document.frm_equipamentos.txt_resolucao.value = matrizDados[8];
									
									//--------------------------------------
									
									*/
									
									//MONTANDO O COMBO COM AS INFORMAÇÕES
									
									dadosCombo = dados[1];
									divCombo = document.getElementById('comboEquipamentos');
									divCombo.innerHTML = '';
									divCombo.innerHTML = dadosCombo;
									
									//--------------------------------------
									
									//BLOQUEANDO CAIXAS DE TEXTO
									bloq('sim');
									
								}
								
								if (metodo == "unico") {
									
									//EXTRAINDO OS DADOS DE RETORNO
									retorno = xmlreq.responseText;
																		
									dados = retorno.split("**");
									
									//FILTRANDO A MATRIZ DE DADOS
									matrizDados = dados[0].split("^^");
									//---------------------------
									
									//FILTRANDO BOTÃO ATUALIZAR E EXCLUIR
									botoes = dados[1];
									
									//---------------------------
									
									//BLOQUEANDO CAIXAS DE TEXTO
									bloq('nao');
									
									//COLOCANDO OS DADOS NAS CAIXAS DE TEXTO
									
									document.frm_equipamentos.txt_nquipamento.value = matrizDados[1];
									document.frm_equipamentos.txt_nomeEquip.value = matrizDados[0];
									document.frm_equipamentos.txt_fabricante.value = matrizDados[2];
									document.frm_equipamentos.txt_descricao.value = matrizDados[4];
									document.frm_equipamentos.txt_local.value = matrizDados[3];
									document.frm_equipamentos.txt_patrimonio.value = matrizDados[5];
									document.frm_equipamentos.txt_faixaNominal.value = matrizDados[6];
									document.frm_equipamentos.txt_tolerancia.value = matrizDados[8];
									document.frm_equipamentos.txt_resolucao.value = matrizDados[7];
									document.frm_equipamentos.data_incorp.value = matrizDados[11];
									document.frm_equipamentos.data_iniUso.value = matrizDados[9];
									document.frm_equipamentos.data_foraUso.value = matrizDados[10];
									
									document.frm_equipamentos.txt_pcalibracao.value = matrizDados[13];
									document.frm_equipamentos.txt_pmanut.value = matrizDados[14];
									document.frm_equipamentos.txt_pchecagem.value = matrizDados[15];
									
									chekEscopo = matrizDados[16];
									
									if (chekEscopo == 'SIM') {
										
										document.getElementById('cx31_CadEmpresasModul').checked = true;
									}
									
									if ((chekEscopo == 'NAO')||(chekEscopo == '')||(chekEscopo == 0)) {
										
										document.getElementById('cx32_CadEmpresasModul').checked = true;
									}
									
									//APLICAR O CHECKBOX
									
									chek = matrizDados[12];
																	
									if (chek != 0) {
									
										document.getElementById('cadEmpresa_tit43').checked = true;
									}
									else {
										
										document.getElementById('cadEmpresa_tit43').checked = false;
									}
									
									
									//-----------------
									
									
									//--------------------------------------
									
									//COLOCANDO OS BOTÕES ATUALIZAR E EXCLUIR
									
									divBotoes = document.getElementById('divBotao');
									
									divBotoes.innerHTML = '';
									divBotoes.innerHTML = botoes;
									
									//--------------------------------------
									
								}
								
							}
							else {
								
								alert(xmlreq.statusText);
								
							}
						}
						
						
					};
					
					xmlreq.send(null);

		
	}
	
	
	//CONSULTANDO TODOS AS EMPRESAS CERTIFICADORAS CADASTRADAS NA PÁGINA DE CONFIMAÇÃO DOS AGENDAMENTOS
	if (tipo == "certificadores") {
		
		//GERANDO UM NÚMERO ALEATÓRIO PARA COMPLEMENTAR A URL E EVITAR QUE OCORRA O CACHE DA PÁGINA, APÓS O REGISTRO NO BANCO DE DADOS
        m = Math.floor((Math.random() * 100) + 1);
    
        //VERIFICAR SE É UMA CONSULTA GERAL OU ESPECÍFICA
        if (metodo != "unico") {        
		
        	xmlreq.open("GET", "../php/funcoes.php?n="+m+"&consultar=certificadores" , true);		
        
        }
		
		xmlreq.onreadystatechange = function() {
			
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
					
					//EXTRAINDO OS DADOS DE RETORNO
					retorno = xmlreq.responseText;
				
					divTabela = document.getElementById('addEmpresa');
				
					divTabela.innerHTML = '';
				
					divTabela.innerHTML = retorno;
				
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}
			
			
		};
		
		xmlreq.send(null);
		
		
	}
	
	
	if (tipo == "unidadesPc") {
		
		
		//GERANDO UM NÚMERO ALEATÓRIO PARA COMPLEMENTAR A URL E EVITAR QUE OCORRA O CACHE DA PÁGINA, APÓS O REGISTRO NO BANCO DE DADOS
        m = Math.floor((Math.random() * 100) + 1);
    
        //VERIFICAR SE É UMA CONSULTA GERAL OU ESPECÍFICA
        if (metodo != "unico") {        
		
        	xmlreq.open("GET", "php/funcoes.php?n="+m+"&consultar=unidadesPc" , true);		
        
        }
		
		xmlreq.onreadystatechange = function() {
			
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
					
					//EXTRAINDO OS DADOS DE RETORNO
					retorno = xmlreq.responseText;
				
					divTabela = document.getElementById('comboUnidadesPc');
				
					divTabela.innerHTML = '';
				
					divTabela.innerHTML = retorno;
				
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}
			
			
		};
		
		xmlreq.send(null);
		
		
	}
	
	//CONSULTANDO AS ANÁLISES CRÍTICAS FILTRADAS PELA DATA
	if (tipo == "analCritica") {
		
		//PEGANDO O VALOR DA DATA
		codItemEquip = document.frm_agendamentosCon.cmb_tipoAgendamento.value;
				
		//GERANDO UM NÚMERO ALEATÓRIO PARA COMPLEMENTAR A URL E EVITAR QUE OCORRA O CACHE DA PÁGINA, APÓS O REGISTRO NO BANCO DE DADOS
        m = Math.floor((Math.random() * 100) + 1);
        
        //VERIFICAR SE É UMA CONSULTA GERAL OU ESPECÍFICA
        if (metodo != "unico") {        
		
        	xmlreq.open("GET", "../php/funcoes.php?n="+m+"&consultar=analiseCritica&data="+codItemEquip , true);		
        
        }
		
		xmlreq.onreadystatechange = function() {
			
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
								
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
					
					//EXTRAINDO OS DADOS DE RETORNO
					retorno = xmlreq.responseText;
				
					divTabela = document.getElementById('tabelaCadEquipamentos');
					
					divTabela.innerHTML = '';
					
					divTabela.innerHTML = retorno;
					
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}
			
			
		};
		
		xmlreq.send(null);
		
	}
	
	//CONSULTANDO OS SERVIÇOS DE UM EQUIPAMENTO NA PÁGINA DOS DETALHES DO AGENDAMENTO
	if (tipo == "listaServicosDetAgend") {
				
		//VALOR DO EQUIPAMENTO E SEU ITEM
		codItemEquip = document.frm_detalhesAgendamento.cmb_itemEquip.value;
		
		//GERANDO UM NÚMERO ALEATÓRIO PARA COMPLEMENTAR A URL E EVITAR QUE OCORRA O CACHE DA PÁGINA, APÓS O REGISTRO NO BANCO DE DADOS
        m = Math.floor((Math.random() * 100) + 1);
        
        //VERIFICAR SE É UMA CONSULTA GERAL OU ESPECÍFICA
        if (metodo != "unico") {
		
        	xmlreq.open("GET", "../php/funcoes.php?n="+m+"&consultar=listaServicosDetAgend&codItem="+codItemEquip , true);		
        
        }
		
		xmlreq.onreadystatechange = function() {
						
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
					
					//EXTRAINDO OS DADOS DE RETORNO
					retorno = xmlreq.responseText;
										
					divTabela = document.getElementById('combo_serv');
					
					divTabela.innerHTML = '';
					
					divTabela.innerHTML = retorno;
					
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}
			
			
		};
		
		xmlreq.send(null);
		
	}
	
	
	//CONSULTANDO OS SERVIÇOS DE UM EQUIPAMENTO NA PÁGINA DE AGENDAMENTOS
	if (tipo == "listaServicosAgend") {
	
		//VALOR DO EQUIPAMENTO E SEU ITEM
		codItemEquip = document.frm_agendamento.rd_itemEquip.value;
		codEquip = document.frm_agendamento.cmb_equipamentos.value;
		
		//GERANDO UM NÚMERO ALEATÓRIO PARA COMPLEMENTAR A URL E EVITAR QUE OCORRA O CACHE DA PÁGINA, APÓS O REGISTRO NO BANCO DE DADOS
        m = Math.floor((Math.random() * 100) + 1);
        
        //VERIFICAR SE É UMA CONSULTA GERAL OU ESPECÍFICA
        if (metodo == "unico") {        
		
        	xmlreq.open("GET", "../php/funcoes.php?n="+m+"&consultar=listaServicosAgend&codItem="+codItemEquip+"&codEquip="+codEquip , true);		
        
        }
		
		xmlreq.onreadystatechange = function() {
						
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
					
					//EXTRAINDO OS DADOS DE RETORNO
					retorno = xmlreq.responseText;
				
					divTabela = document.getElementById('tabelaServicos');
					
					divTabela.innerHTML = '';
					
					divTabela.innerHTML = retorno;
					
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}
			
			
		};
		
		xmlreq.send(null);		
		
	}
		
	//CONSULTANDO ITENS DO EQUIPAMENTO NA PÁIGNA DE AGENDAMENTOS
	if (tipo == "itensEquipAgend") {
		
		//VALOR DO COMBO DE EQUIPAMENTOS
		codEquip = document.frm_agendamento.cmb_equipamentos.value;	
		
		//GERANDO UM NÚMERO ALEATÓRIO PARA COMPLEMENTAR A URL E EVITAR QUE OCORRA O CACHE DA PÁGINA, APÓS O REGISTRO NO BANCO DE DADOS
        m = Math.floor((Math.random() * 100) + 1);
        
        //VERIFICAR SE É UMA CONSULTA GERAL OU ESPECÍFICA
        if (metodo == "unico") {        
		
        	xmlreq.open("GET", "../php/funcoes.php?n="+m+"&consultar=itensEquipAgend&cod="+codEquip , true);		
        
        }
		
		xmlreq.onreadystatechange = function() {
			
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
					
					//EXTRAINDO OS DADOS DE RETORNO
					retorno = xmlreq.responseText;
					
					divTabela = document.getElementById('tabelaItensEquip');
					
					divTabela.innerHTML = '';
					
					divTabela.innerHTML = retorno;
					
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}
			
			
		};
		
		xmlreq.send(null);
		
	}
	
	
	//CONSULTANDO GRANDEZAS
	if (tipo == "grandezas") {
				
		//GERANDO UM NÚMERO ALEATÓRIO PARA COMPLEMENTAR A URL E EVITAR QUE OCORRA O CACHE DA PÁGINA, APÓS O REGISTRO NO BANCO DE DADOS
        m = Math.floor((Math.random() * 100) + 1);
        
        //VERIFICAR SE É UMA CONSULTA GERAL OU ESPECÍFICA
        if (metodo != "unico") {        
		
        	xmlreq.open("GET", "../php/funcoes.php?n="+m+"&consultar=grandezas" , true);		
        
        }
		
		xmlreq.onreadystatechange = function() {
			
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
					
					//EXTRAINDO OS DADOS DE RETORNO
					retorno = xmlreq.responseText;
				
					divTabela = document.getElementById('tabelaGrandezas');
					
					divTabela.innerHTML = '';
					
					divTabela.innerHTML = retorno;
					
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}
			
			
		};
		
		xmlreq.send(null);
		
		
	}
	
	//CONSULTANDO UNIDADES
	if (tipo == "unidades") {
		
		
		//GERANDO UM NÚMERO ALEATÓRIO PARA COMPLEMENTAR A URL E EVITAR QUE OCORRA O CACHE DA PÁGINA, APÓS O REGISTRO NO BANCO DE DADOS
        m = Math.floor((Math.random() * 100) + 1);
        
        //VERIFICAR SE É UMA CONSULTA GERAL OU ESPECÍFICA
        if (metodo != "unico") {        
		
        	xmlreq.open("GET", "../php/funcoes.php?n="+m+"&consultar=unidades" , true);		
        
        }
		
		xmlreq.onreadystatechange = function() {
			
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
					
					//EXTRAINDO OS DADOS DE RETORNO
					retorno = xmlreq.responseText;
				
					divTabela = document.getElementById('tabelaUnidades');
					
					divTabela.innerHTML = '';
					
					divTabela.innerHTML = retorno;
					
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}
			
			
		};
		
		xmlreq.send(null);
		
		
	}
	
	
	//CONSULTANDO DATAS DO AGENDAMENTO
	if (tipo == "agenDatas") {
		
		
		//GERANDO UM NÚMERO ALEATÓRIO PARA COMPLEMENTAR A URL E EVITAR QUE OCORRA O CACHE DA PÁGINA, APÓS O REGISTRO NO BANCO DE DADOS
        m = Math.floor((Math.random() * 100) + 1);
        
        
        //PEGANDO OS PARÂMETROS PARA A CONSULTA
        dataDe = document.frm_agendamentosCon.txt_dataDe.value;
        dataPara = document.frm_agendamentosCon.txt_dataPara.value;
        tipoAg = document.frm_agendamentosCon.cmb_tipoAgendamento.value;
                
        //VERIFICAR SE É UMA CONSULTA GERAL OU ESPECÍFICA
        if (metodo != "unico") {        
		
        	//VERIFICANDO SE A BUSCA TERÁ INTERVALO DE DATAS OU NÃO
        	
        	if (dataPara.length == 10) {//COM DATA
        	
        		xmlreq.open("GET", "../php/funcoes.php?n="+m+"&consultar=agendDatas&dataDe="+dataDe+"&dataPara="+dataPara+"&tipoAg="+tipoAg , true);		
        	
        	}
        	else {//SEM DATA
        		
        		xmlreq.open("GET", "../php/funcoes.php?n="+m+"&consultar=agendTipoAg&dataDe="+dataDe+"&dataPara="+dataPara+"&tipoAg="+tipoAg , true);
        		
        	}
        
        }
		
		xmlreq.onreadystatechange = function() {
			
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
					
					//EXTRAINDO OS DADOS DE RETORNO
					retorno = xmlreq.responseText;
										
					divTabela = document.getElementById('tabelaCadEquipamentos');
					
					divTabela.innerHTML = '';
					
					divTabela.innerHTML = retorno;
					
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}
			
			
		};
		
		xmlreq.send(null);
		
	}
	
	
	if (tipo == "servicosEquipamentos") {
		
		//GERANDO UM NÚMERO ALEATÓRIO PARA COMPLEMENTAR A URL E EVITAR QUE OCORRA O CACHE DA PÁGINA, APÓS O REGISTRO NO BANCO DE DADOS
        m = Math.floor((Math.random() * 100) + 1);
        
        //VERIFICAR SE É UMA CONSULTA GERAL OU ESPECÍFICA
        if (metodo != "unico") {        
		
        	xmlreq.open("GET", "php/funcoes.php?n="+m+"&consultar=servicosEquipamentos&param="+pag+"&metodo='" , true);		
        
        }
		
		xmlreq.onreadystatechange = function() {
			
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
					
					//EXTRAINDO OS DADOS DE RETORNO
					retorno = xmlreq.responseText;
				
					divTabela = document.getElementById('tabela_servicos');
					
					divTabela.innerHTML = '';
					
					divTabela.innerHTML = retorno;
					
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}
			
			
		};
		
		xmlreq.send(null);
		
		
	}
	
	if (tipo == "servicosItemCalibracao") {
		
		//GERANDO UM NÚMERO ALEATÓRIO PARA COMPLEMENTAR A URL E EVITAR QUE OCORRA O CACHE DA PÁGINA, APÓS O REGISTRO NO BANCO DE DADOS
        m = Math.floor((Math.random() * 100) + 1);
        
        if (metodo != "unico") {
        
        	xmlreq.open("GET", "php/funcoes.php?n="+m+"&consultar=servicosItemCalibracao" , true);		
        
        }
        else {
        	
        	
        	
        }
		        
		xmlreq.onreadystatechange = function() {
			
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
					
					//COMUNICAÇÃO COM O ARQUIVO PHP OCORREU COM SUCESSO
					retorno = xmlreq.responseText;
					
					
					divTabela = document.getElementById('servicos_containerSelect');
					
					divTabela.innerHTML = '';
					
					divTabela.innerHTML = retorno;
					
					//VERIFICAR SE ESTÁ CONSULTANDO UM REGISTRO ÚNICO OU GERAL
												
												
						
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}
			
			
		};
		
		xmlreq.send(null);
		
		
	}
	
	
	if (tipo == "listaItensCalibracao") {
		
		//GERANDO UM NÚMERO ALEATÓRIO PARA COMPLEMENTAR A URL E EVITAR QUE OCORRA O CACHE DA PÁGINA, APÓS O REGISTRO NO BANCO DE DADOS
        m = Math.floor((Math.random() * 100) + 1);
        
        if (metodo != "unico") {
        
        	xmlreq.open("GET", "php/funcoes.php?n="+m+"&consultar=listaItensCalibracao" , true);		
        
        }
        else {
        	
        	xmlreq.open("GET", "php/funcoes.php?n="+m+"&consultar=listaItensCalibracao&param="+pag+"&metodo=unico" , true);
       
        }
		        
		xmlreq.onreadystatechange = function() {
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
					
					//COMUNICAÇÃO COM O ARQUIVO PHP OCORREU COM SUCESSO
					retorno = xmlreq.responseText;
					
					
					if (metodo != "unico") {
					
						divTabela = document.getElementById('tabela_itCalibr');
						
						divTabela.innerHTML = '';
						
						divTabela.innerHTML = retorno;
						
						//VERIFICAR SE ESTÁ CONSULTANDO UM REGISTRO ÚNICO OU GERAL
					}
					else {
											
						dados = retorno.split("**");
					
						//COLOCANDO A TABELA DE SERVIÇOS
						
						divTabelaServicos = document.getElementById('servicos_containerSelect');
						
						divTabelaServicos.innerHTML = '';
						
						divTabelaServicos.innerHTML = dados[0];
						
						//COLOCANDO O ITEM DE CALIBRAÇÃO NA CAIXA DE TEXTO
						document.frm_equipamentos.txt_itemCalibr.value = dados[1];
						document.frm_equipamentos.txt_itemfaixa.value = dados[2];
						
						
						//BLOQUEANDO A CAIXA DE TEXTO
						document.getElementById("cx28_CadEmpresasSup").disabled = true;
						document.getElementById("cx28_CadEmpresasSupSupSup").disabled = true;
										
						
						//ACRESCENTANDO BOTÃO PARA VOLTAR
						divAreaBotao = document.getElementById('areaBotao');
						
						divAreaBotao.innerHTML = '';
						
						divAreaBotao.innerHTML = '<input type=button value=Novo id=btn_insItCalibr onclick=voltar("itensCalibracao");>';
						
					}		
						
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}
			
			
		};
		
		xmlreq.send(null);
		
		
	}
	
	if (tipo == "itensEquipamentoPc") {
				
		//GERANDO UM NÚMERO ALEATÓRIO PARA COMPLEMENTAR A URL E EVITAR QUE OCORRA O CACHE DA PÁGINA, APÓS O REGISTRO NO BANCO DE DADOS
        m = Math.floor((Math.random() * 100) + 1);
        
        if (metodo != "unico") {
        
        	xmlreq.open("GET", "php/funcoes.php?n="+m+"&consultar=itensEquipamentoPc", true);		
        
        }
        
        
		xmlreq.onreadystatechange = function() {
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
					
					//COMUNICAÇÃO COM O ARQUIVO PHP OCORREU COM SUCESSO
					retorno = xmlreq.responseText;
										
					if (metodo != "unico") {
					
						divTabela = document.getElementById('comboServEquipEquipPc');
						
						divTabela.innerHTML = '';
						
						divTabela.innerHTML = retorno;
						
						//VERIFICAR SE ESTÁ CONSULTANDO UM REGISTRO ÚNICO OU GERAL
						
					}
					
						
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}
			
			
		};
		
		xmlreq.send(null);
		
	}
	
	
	if (tipo == "servicosEquipamentosPc") {
		
		
		valorItemEquip = document.frm_equipamentos.cmb_itemEquip.value;
		
		//GERANDO UM NÚMERO ALEATÓRIO PARA COMPLEMENTAR A URL E EVITAR QUE OCORRA O CACHE DA PÁGINA, APÓS O REGISTRO NO BANCO DE DADOS
        m = Math.floor((Math.random() * 100) + 1);
                
        if (metodo != "unico") {
        
        	xmlreq.open("GET", "php/funcoes.php?n="+m+"&consultar=servicosEquipamentosPc&itemEquip="+valorItemEquip, true);		
        
        }
        
        
		xmlreq.onreadystatechange = function() {
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
					
					//COMUNICAÇÃO COM O ARQUIVO PHP OCORREU COM SUCESSO
					retorno = xmlreq.responseText;
					
					
					if (metodo != "unico") {
											
						divTabela = document.getElementById('comboServEquipPc');
						
						divTabela.innerHTML = '';
						
						divTabela.innerHTML = retorno;
						
						//VERIFICAR SE ESTÁ CONSULTANDO UM REGISTRO ÚNICO OU GERAL
						consultar('pontoCalibracao',0,'');
						
					}
					
						
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}
			
			
		};
		
		xmlreq.send(null);
		
	}
	
	if (tipo == "grandezasPc") {
		
		
		//GERANDO UM NÚMERO ALEATÓRIO PARA COMPLEMENTAR A URL E EVITAR QUE OCORRA O CACHE DA PÁGINA, APÓS O REGISTRO NO BANCO DE DADOS
        m = Math.floor((Math.random() * 100) + 1);
        
        if (metodo != "unico") {
        
        	xmlreq.open("GET", "php/funcoes.php?n="+m+"&consultar=grandezasPc", true);		
        
        }
        
        
		xmlreq.onreadystatechange = function() {
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
					
					//COMUNICAÇÃO COM O ARQUIVO PHP OCORREU COM SUCESSO
					retorno = xmlreq.responseText;
										
					if (metodo != "unico") {
					
						divTabela = document.getElementById('comboGrandezasPc');
						
						divTabela.innerHTML = '';
						
						divTabela.innerHTML = retorno;
						
						//VERIFICAR SE ESTÁ CONSULTANDO UM REGISTRO ÚNICO OU GERAL
						
					}
					
						
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}
			
			
		};
		
		xmlreq.send(null);
		
		
	}
	
	if (tipo == "pontoCalibracao") {
		
		//GERANDO UM NÚMERO ALEATÓRIO PARA COMPLEMENTAR A URL E EVITAR QUE OCORRA O CACHE DA PÁGINA, APÓS O REGISTRO NO BANCO DE DADOS
        m = Math.floor((Math.random() * 100) + 1);
        
        //PEGANDO O CÓDIGO DO ITEM DO EQUIPAMENTO E SERVIÇO
        codItemManut = document.frm_equipamentos.cmb_itemEquip.value;
        codServico = document.frm_equipamentos.cmb_servicos.value;
        
        alert('CONSULTANDO PONTOS DE CALIBRAÇÃO, AGUARDE...');
        
        if (metodo != "unico") {
        
        	xmlreq.open("GET", "php/funcoes.php?n="+m+"&consultar=pontoCalibracao&codItemManut="+codItemManut+"&codServico="+codServico+"&metodo=nothing" , true);		
        
        }
        else {
        	
        	//CONSULTAR PONTO DE CALIBRAÇÃO PARA EDIÇÃO
        	xmlreq.open("GET", "php/funcoes.php?n="+m+"&consultar=pontoCalibracao&codItemManut="+codItemManut+"&codServico="+codServico+"&param="+pag+"&metodo=unico" , true);
        	
        }
        
		xmlreq.onreadystatechange = function() {
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
					
					//COMUNICAÇÃO COM O ARQUIVO PHP OCORREU COM SUCESSO
					retorno = xmlreq.responseText;
					
					if (metodo != "unico") {
												
						divTabela = document.getElementById('tabela_pontosCalibr');
						
						divTabela.innerHTML = '';
						
						divTabela.innerHTML = retorno;
						
						
						//VERIFICAR SE ESTÁ CONSULTANDO UM REGISTRO ÚNICO OU GERAL
						
					}
					else {
						
						
						//COLOCANDO VALORES NAS TEXTBOX PARA EDITAR O PONTO DE CALIBRAÇÃO
						
						
						//PEGANDO OS RESPECTIVOS ELEMENTOS PARA ATRIBUIR VALORES VIA DOM/XML
						
						
						
						//------------------------------------------------------------------
						
					}
						
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
				
				
			}
			
			
		};
		
		xmlreq.send(null);
		
	}		
	
}

//FUNÇÃO PARA RETORNAR UMA CONSULTA
//PARÂMETROS: TIPO - DEFINE QUAL INTERFACE RELACIONADA
function voltar(tipo) {
	
	
	if (tipo == "itensCalibracao") {
		
		//ACRESCENTANDO BOTÃO INSERIR NOVOS ITENS DE CALIBRAÇÃO
		
		divAreaBotao = document.getElementById('areaBotao');
		
		divAreaBotao.innerHTML = '';
		
		divAreaBotao.innerHTML = '<input type=button value=Inserir id=btn_insItCalibr onclick=cadastrar("itensCalibracao","cadastrar","");>';
		
		//HABILITANDO EDIÇÃO DE CAIXA DE TEXTO
		document.getElementById("cx28_CadEmpresasSup").disabled = false;
		document.getElementById("cx28_CadEmpresasSupSupSup").disabled = false;
		
		//LIMPANDO VALORES DA CAIXA DE TEXTO
		document.frm_equipamentos.txt_itemCalibr.value = '';
		document.frm_equipamentos.txt_itemfaixa.value = '';
		
		consultar('servicosItemCalibracao', 0, '-');

	}
	
	
}


//EXCLUIR EQUIPAMENTOS OU ITENS
//PARÂMETROS: TIPO - DEFINE SE VAI EXCLUIR UM EQUIPAMENTO OU ITEM QUE PERTENCE ; CODIGO - CÓDIGO DO REGISTRO
function excluirReg(tipo, codigo) {
	
var xmlreq = objetoAj();
	
	//EXCLUIR UM EQUIPAMENTO
	if (tipo == "equipamentos") {
		
				
		xmlreq.open("GET", "php/funcoes.php?&excluir=equipamentos&codigo="+codigo , true);
			
		
		xmlreq.onreadystatechange = function() {
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
									
					//COMUNICAÇÃO COM O ARQUIVO PHP OCORREU COM SUCESSO
					
					//EXCLUÍDO COM SUCESSO
					alert('REGISTRO EXCLUÍDO DO SISTEMA');
	
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}		
		};
		
		xmlreq.send(null);
		
		
		//APÓS O CADASTRO, REALIZAR UMA CONSULTA DO ARQUIVO	
		consultar('equipamentos',0, '-');
		
	}
	
	
	// EXCLUIR GRANDEZAS
	if (tipo == "grandezas") {
	
		xmlreq.open("GET", "../php/funcoes.php?&excluir=grandezas&codigo="+codigo , true);
		
		xmlreq.onreadystatechange = function() {
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
									
					//COMUNICAÇÃO COM O ARQUIVO PHP OCORREU COM SUCESSO			
					
					//EXCLUÍDO COM SUCESSO
					alert('REGISTRO EXCLUÍDO DO SISTEMA');
	
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}		
		};
		
		xmlreq.send(null);
		
		
		//APÓS O CADASTRO, REALIZAR UMA CONSULTA DO ARQUIVO	
		consultar('grandezas',0, '-');
		
	}
	
	
	// EXCLUIR UNIDADES DE MEDIDA
	if (tipo == "unidades") {
		
				
		xmlreq.open("GET", "../php/funcoes.php?&excluir=unidades&codigo="+codigo , true);
			
		
		xmlreq.onreadystatechange = function() {
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
									
					//COMUNICAÇÃO COM O ARQUIVO PHP OCORREU COM SUCESSO
					
					//EXCLUÍDO COM SUCESSO
					alert('REGISTRO EXCLUÍDO DO SISTEMA');
	
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}		
		};
		
		xmlreq.send(null);
		
		
		//APÓS O CADASTRO, REALIZAR UMA CONSULTA DO ARQUIVO	
		consultar('unidades',0, '-');
		
	}
	
	
	//EXCLUIR O SERVIÇO DE UM EQUIPAMENTO
	if (tipo == "servicosEquipamentos") {
		
		xmlreq.open("GET", "php/funcoes.php?&excluir=servicosEquipamentos&codigo="+codigo , true);
			
		xmlreq.onreadystatechange = function() {
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO
				if (xmlreq.status == 200) {

					//COMUNICAÇÃO COM O ARQUIVO PHP OCORREU COM SUCESSO
					
					//EXCLUÍDO COM SUCESSO
					alert('REGISTRO EXCLUÍDO DO SISTEMA');
	
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}		
		};
		
		xmlreq.send(null);
		
		//APÓS O CADASTRO, REALIZAR UMA CONSULTA DO ARQUIVO	
		consultar('servicosEquipamentos',0, '-');
		
		
	}
	
	
	//EXCLUIR O ITEM DE CALIBRAÇÃO DE UM EQUIPAMENTO
	if (tipo == "itensCalibracao") {
		
		xmlreq.open("GET", "php/funcoes.php?&excluir=itensCalibracao&codigo="+codigo , true);
		
		xmlreq.onreadystatechange = function() {
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO
				if (xmlreq.status == 200) {

					//COMUNICAÇÃO COM O ARQUIVO PHP OCORREU COM SUCESSO
					
					//EXCLUÍDO COM SUCESSO
					alert('REGISTRO EXCLUÍDO DO SISTEMA');
	
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}		
		};
		
		xmlreq.send(null);
		
		
		consultar('servicosItemCalibracao', 0, '-');
		consultar('listaItensCalibracao', 0, '-');
		limpar("itensCalibracao");
		
		
	}
	
	//EXCLUIR UM PONTO DE CALIBRAÇÃO
	if (tipo == "pontosCalibracao") {
		
		xmlreq.open("GET", "php/funcoes.php?&excluir=pontosCalibracao&codigo="+codigo , true);
		
		xmlreq.onreadystatechange = function() {
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO
				if (xmlreq.status == 200) {

					//COMUNICAÇÃO COM O ARQUIVO PHP OCORREU COM SUCESSO
					
					//EXCLUÍDO COM SUCESSO
					alert('REGISTRO EXCLUÍDO DO SISTEMA');
	
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}		
		};
		
		xmlreq.send(null);
		
		
		limpar('servicosEquipamentos');
		consultar('pontoCalibracao',0, '-');
		
	}
	
	
	
}

//----------------------------

//EDITAR EQUIPAMENTOS OU ITENS

//EDITAR EQUIPAMENTOS OU ITENS
//PARÂMETROS: TIPO - DEFINE SE VAI ATUALIZAR DADOS DE UM EQUIPAMENTO OU ITEM QUE PERTENCE ; CODIGO - CÓDIGO DO REGISTRO




//----------------------------

//CADASTRAR EQUIPAMENTOS
//PARÂMETROS: TIPO - DEFINE SE É CADASTRO DE EQUIPAMENTO OU DE ITENS ; MODO - DEFINE SE É UMA ATUALIZAÇÃO OU INSERÇÃO DE NOVO REGISTRO ; CODIGO - CODIGO DO REGISTRO
function cadastrar(tipo, modo, codigo) {


	var xmlreq = objetoAj();
	
	//CADASTRA OS EQUIPAMENTOS
	if (tipo == "equipamentos") {
		
		//CAPTURANDO CAMPOS
		nome = document.frm_equipamentos.txt_nomeEquip.value;
		numero = document.frm_equipamentos.txt_nquipamento.value;
		fabricante = document.frm_equipamentos.txt_fabricante.value;
		descricao = document.frm_equipamentos.txt_descricao.value;
		local = document.frm_equipamentos.txt_local.value;
		patrimonio = document.frm_equipamentos.txt_patrimonio.value;
		faixaNominal = document.frm_equipamentos.txt_faixaNominal.value;
		tolerancia = document.frm_equipamentos.txt_tolerancia.value;
		resolucao = document.frm_equipamentos.txt_resolucao.value;
		dataIncorp = document.frm_equipamentos.data_incorp.value;
		dataIniUso = document.frm_equipamentos.data_iniUso.value;
		dataForaUso = document.frm_equipamentos.data_foraUso.value;
		dentroEscopo = document.frm_equipamentos.chk_escopo.value;
		pcalibr = document.frm_equipamentos.txt_pcalibracao.value;
		pmanut = document.frm_equipamentos.txt_pmanut.value;
		pchkinterm = document.frm_equipamentos.txt_pchecagem.value;
		
		chkB = document.getElementById('cadEmpresa_tit43');
		
		if (chkB.checked == true) {
			
			pergForaUso = 1;
			
		}
		else {
			
			pergForaUso = 0;
		}
				
		//VERIFICA SE É UM NOVO CADASTRO OU ATUALIZAÇÃO
		
		if (modo == "cadastrar") {
						
			xmlreq.open("GET", "php/cadastro.php?equipamento=1&modo="+modo+"&nome="+nome+"&numero="+numero+"&fabricante="+fabricante+"&descricao="+descricao+"&local="+local+"&patrimonio="+patrimonio+"&tolerancia="+tolerancia+"&faixaNominal="+faixaNominal+"&resolucao="+resolucao+"&dataIcorp="+dataIncorp+"&dataIniUso="+dataIniUso+"&chkForaUso="+pergForaUso+"&dataForaUso="+dataForaUso+"&pcalibr="+pcalibr+"&pmanut="+pmanut+"&pchecagem="+pchkinterm+"&pnoescopo="+dentroEscopo, true);
			
		}
		else {
			
			xmlreq.open("GET", "php/cadastro.php?equipamento=1&modo="+modo+"&nome="+nome+"&numero="+numero+"&fabricante="+fabricante+"&descricao="+descricao+"&local="+local+"&patrimonio="+patrimonio+"&tolerancia="+tolerancia+"&faixaNominal="+faixaNominal+"&resolucao="+resolucao+"&codigo="+codigo+"&dataIcorp="+dataIncorp+"&dataIniUso="+dataIniUso+"&chkForaUso="+pergForaUso+"&dataForaUso="+dataForaUso+"&pcalibr="+pcalibr+"&pmanut="+pmanut+"&pchecagem="+pchkinterm+"&pnoescopo="+dentroEscopo, true);			
		}
		
		//---------------------------------------------
		
		xmlreq.onreadystatechange = function() {
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
					
					//COMUNICAÇÃO COM O ARQUIVO PHP OCORREU COM SUCESSO
					
					alert('REGISTRADO NO SISTEMA');
					//REGISTRO CADASTRADO NO SISTEMA
			
					
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}		
		};
		
		xmlreq.send(null);
		
		//APÓS O CADASTRO, REALIZAR UMA CONSULTA DO ARQUIVO	
		
		if (modo == 'atualizar') {
						
			consultar('equipamentos',0, 'atualiza');
		}
		else {
						
			consultar('equipamentos',0, '-');
		}
		
	}
	
	//CADASTRA OS SERVIÇOS DO EQUIPAMENTO
	if (tipo == "servicosEquipamentos") {
		
		//CAPTURANDO CAMPOS
		nomeServico = document.frm_equipamentos.txt_nomeServico.value;
		temPontos = document.frm_equipamentos.chk_temPontos.value;
		
		//VERIFICA SE É UM NOVO CADASTRO OU ATUALIZAÇÃO
		
		if (modo == "cadastrar") {
			
			xmlreq.open("GET", "php/cadastro.php?servicoEquip=1&modo="+modo+"&nome="+nomeServico+"&temPontos="+temPontos , true);
		
		}
		
		//---------------------------------------------
		
		xmlreq.onreadystatechange = function() {
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
					
					
					//COMUNICAÇÃO COM O ARQUIVO PHP OCORREU COM SUCESSO
					
					//REGISTRO CADASTRADO NO SISTEMA
					
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}
			
		};
		
		xmlreq.send(null);
		
		alert('REGISTRADO NO SISTEMA');
		//APÓS O CADASTRO, REALIZAR UMA CONSULTA DO ARQUIVO	
		
		limpar('servicosEquipamentos');
		
		consultar('servicosEquipamentos',0, '-');
		
	}
	
	
	//CADASTRA OS ITENS DE CALIBRAÇÃO DO EQUIPAMENTO
	if (tipo == "itensCalibracao") {
					
		//RECOLHER OS VALORES DOS CHECKBOXES E ARMAZENAR EM UM ARRAYs
		
		var aChk = document.getElementsByName("chk_servicos");
		
		var servicos = [];
		
		for (i=0;i<aChk.length;i++){
			 
		     if (aChk[i].checked == true){
		    	//DEPOSITANDO O VALOR NO ARRAY
		        servicos.push(aChk[i].value);
		     }
		     
		}
		
		itemCalibracao = document.frm_equipamentos.txt_itemCalibr.value;
		
		faixaNominal = document.frm_equipamentos.txt_itemfaixa.value;
		
		//----------------------------------------------------------
		
		//PASSANDO OS DADOS ATRAVÉS DO MÉTODO POST, DEVIDO AO ARRAY COM OS SERVIÇOS SELECIONADOS

		xmlreq.open("POST", "php/cadastroItemCalibracao.php", true);
		xmlreq.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
		xmlreq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		xmlreq.onreadystatechange = function() {

			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {

				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO
				if (xmlreq.status == 200) {

					//COMUNICAÇÃO COM O ARQUIVO PHP OCORREU COM SUCESSO
										
					//REGISTRO CADASTRADO NO SISTEMA
					alert("ITEM DE CALIBRAÇÃO CADASTRADO COM SUCESSO!");

				}
				else {

					alert(xmlreq.statusText);

				}
			}
			
		};
		
		//ENVIANDO DADOS ATRAVÉS DO MÉTODO POST
		//MOTIVO: O MÉTODO POST ALÉM DE GARANTIR SEGURANÇA DOS DADOS, TAMBÉM SUPORTA UM CONJUNTO MAIOR DE VARIÁVEIS NA REQUISIÇÃO
		xmlreq.send("servicos="+servicos+"&itemCalibracao="+itemCalibracao+"&itemFaixa="+faixaNominal);
		
		consultar('servicosItemCalibracao', 0, '-');
		consultar('listaItensCalibracao', 0, '-');
		
		limpar("itensCalibracao");
		
	}
	
	//---------------------------------------------
	
	//CADASTRANDO OS PONTOS DE CALIBRAÇÃO
	if (tipo == "pontosCalibracao") {
		
		comboServico = document.frm_equipamentos.cmb_servicos.value;
		comboCompServItem = document.frm_equipamentos.cmb_itemEquip.value;
		comboGrandeza = document.frm_equipamentos.cmb_grandezas.value;
		comboUnidade = document.frm_equipamentos.cmb_unidade.value;
		valorUnidade = document.frm_equipamentos.txt_valor.value;
		tolerancia = document.frm_equipamentos.txt_toleranciaPc.value;
		
		tolerancia = encodeURIComponent(tolerancia);
		
		alert(tolerancia);
		
		if (modo == "cadastrar") {
		
			xmlreq.open("GET", "php/cadastro.php?pontosCalibracao=1&modo="+modo+"&valor="+valorUnidade+"&codCompServItem="+comboCompServItem+"&codGrandeza="+comboGrandeza+"&codUnidade="+comboUnidade+"&tolerancia="+tolerancia+"&codServico="+comboServico , true);
		
		}
		else {
			
			xmlreq.open("GET", "php/cadastro.php?pontosCalibracao="+valor+"&modo="+modo+"&valor="+valorUnidade+"&codCompServItem="+comboCompServItem+"&codGrandeza="+comboGrandeza+"&codUnidade="+comboUnidade+"&tolerancia="+tolerancia+"&codServico="+comboServico , true);			
		}
		
		//---------------------------------------------
		
		xmlreq.onreadystatechange = function() {
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
					
					//COMUNICAÇÃO COM O ARQUIVO PHP OCORREU COM SUCESSO
					
					//REGISTRO CADASTRADO NO SISTEMA
					
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}
			
		};
		
		xmlreq.send(null);
		
		alert('REGISTRADO NO SISTEMA');
		//APÓS O CADASTRO, REALIZAR UMA CONSULTA DO ARQUIVO	
		
		limpar('servicosEquipamentos');
		
		consultar('pontoCalibracao',0, '-');
		
	}
	
	//---------------------------------------------
	
	
	//CADASTRANDO AS GRANDEZAS
	
	if (tipo == "grandezas") {
		
		grandeza = document.frm_agendamentosCon.txt_grandeza.value;
				
		if (modo == "cadastrar") {
						
			xmlreq.open("GET", "../php/cadastro.php?Cadgrandezas=1&modo="+modo+"&grandeza="+grandeza, true);
		
		}
		
		//---------------------------------------------
		
		xmlreq.onreadystatechange = function() {
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
								
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
					
					//COMUNICAÇÃO COM O ARQUIVO PHP OCORREU COM SUCESSO
			
					//REGISTRO CADASTRADO NO SISTEMA
					
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}
			
		};
		
		xmlreq.send(null);
		
		alert('REGISTRADO NO SISTEMA');
		//APÓS O CADASTRO, REALIZAR UMA CONSULTA DO ARQUIVO	
				
		consultar('grandezas',0, '-');
		
	}
		
	//------------------------
	
	
	//CADASTRANDO AS UNIDADES
	
	if (tipo == "unidades") {
		
		unidade = document.frm_agendamentosCon.txt_unidades.value;
				
		if (modo == "cadastrar") {
			
			xmlreq.open("GET", "../php/cadastro.php?unidades=1&modo="+modo+"&unidade="+unidade, true);
		
		}
		
		//---------------------------------------------
		
		xmlreq.onreadystatechange = function() {
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
					
					//COMUNICAÇÃO COM O ARQUIVO PHP OCORREU COM SUCESSO
					
					//REGISTRO CADASTRADO NO SISTEMA
					
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}
			
		};
		
		xmlreq.send(null);
		
		alert('REGISTRADO NO SISTEMA');
		//APÓS O CADASTRO, REALIZAR UMA CONSULTA DO ARQUIVO	
		
		//limpar('grandezas');
		
		consultar('unidades',0, '-');
		
		
	}
		
	//------------------------
	
	
	//CADASTRANDO AS EMPRESAS CERTIFICADORAS
	
	if (tipo == "certificadores") {
		
		certificador = document.frm_detalhesAgendamento.txt_nomeCertificador.value;
				
		if (modo == "cadastrar") {
			
			xmlreq.open("GET", "../php/cadastro.php?certificadores=1&modo="+modo+"&certificador="+certificador, true);
		
		}
		
		//---------------------------------------------
		
		xmlreq.onreadystatechange = function() {
			
			//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
			if (xmlreq.readyState == 4) {
				
				//RECEBE A FUNÇÃO E DEPURAR OS MÉTODOS INI E .EXE DO CÓDIGO
				
				//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
				if (xmlreq.status == 200) {
					
					//COMUNICAÇÃO COM O ARQUIVO PHP OCORREU COM SUCESSO
					
					//REGISTRO CADASTRADO NO SISTEMA
					
				}
				else {
					
					alert(xmlreq.statusText);
					
				}
			}
			
		};
		
		xmlreq.send(null);
		
		alert('REGISTRADO NO SISTEMA');
		//APÓS O CADASTRO, REALIZAR UMA CONSULTA DO ARQUIVO	
		
		//limpar('grandezas');
		
		consultar('certificadores',0, '-');
		
		
	}
	
	//--------------------------------------
	
	
}