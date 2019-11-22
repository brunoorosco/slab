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

//FUNÇÃO PARA ATIVAR UMA CAIXA DE TEXTO, POSSIBILITANDO A ALTERAÇÃO DO NOME DA AMOSTRA
function ativarTextBox(codigoItem, caixa) {
	
	//IDENTIFICANDO O ELEMENTO HTML QUE FOI SELECIONADO PELA CLASSE
	elementoHTML = caixa.className;
	
	//CRIANDO OBJETO XMLHTTPREQUEST
	var xmlreq = objetoAj();
	
	//CAPTURANDO O NOME DA AMOSTRA SELECIONADA
	nomeAmostra = caixa.childNodes[0].nodeValue;
	
	//ABRINDO CONEXÃO COM O ARQUIVO DE FUNÇÕES INTERNAS
	xmlreq.open("GET", "php/funcoesInternas.php?guardarDados=1&nomeAmostra="+nomeAmostra+"&codAmostra="+codigoItem+"&elementoHTML="+elementoHTML, true);
	
	xmlreq.onreadystatechange = function() {
		
		//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
		if (xmlreq.readyState == 4) {
			
			//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
			if (xmlreq.status == 200) {
				
				//COMUNICAÇÃO COM O ARQUIVO PHP OCORREU COM SUCESSO
				
				
				//RECEBENDO E TRANSFORMANDO OS DADOS RECEBIDOS EM ARRAY
				dados = xmlreq.responseText;
								
				matriz = dados.split(";");
				
				
					//VERIFICANDO SE A CAIXA SELECIONADA É DIFERENTE, EM CASO POSITIVO, APAGAR A ANTERIORMENTE SELECIONADA
					if (elementoHTML != matriz[0]) {
						
						valorClasse = matriz[0];
						
						//PEGANDO O ELEMENTO ANTERIORMENTE SELECIONADO
						elementoSel = document.getElementById(valorClasse);//.getElementsByTagName("'"+matriz[0]+"'");
						celula = elementoSel.cells[1];
						//REMOVENDO TODOS OS ELEMENTOS DA DIV ANTERIORMENTE SELECIONADA
						celula.innerHTML = '';
						caixa.innerHTML = '';
						
						//ADICIONANDO O NOME DA CAIXA QUE FOI SELECIONADA ANTERIORMENTE
						nomeItemAnterior = matriz[2];
						celula.innerHTML = nomeItemAnterior;
						
					}
					else {
						
						//REMOVENDO TODOS OS ELEMENTOS DA DIV
						caixa.innerHTML = '';
					}
				
				
				//DEFININDO O TEXTO QUE SERÁ COLOCADO DENTRO DA CAIXA DE TEXTO
				texto = document.createTextNode(nomeAmostra);
				
				
				//CRIANDO UMA CAIXA DE TEXTO E DEFININDO OS ATRIBUTOS
				cxTexto = document.createElement('input');
				botao = document.createElement('input');
				botaoS = document.createElement('input');
				botao.setAttribute("type","button");
				botao.setAttribute("id","bt_exclCx");
				botao.setAttribute("onclick","desativarTextBox('"+elementoHTML+"','"+nomeAmostra+"');");
				botaoS.setAttribute("type","button");
				botaoS.setAttribute("onclick","salvarDados('"+elementoHTML+"');");
				botaoS.setAttribute("id","bt_salvCx");
				cxTexto.setAttribute("type", "text");
				cxTexto.setAttribute("id", "txt_namostra");
				cxTexto.setAttribute("class", "cx_texto2");
				cxTexto.setAttribute("value", nomeAmostra);
				
				caixa.appendChild(cxTexto);
				caixa.appendChild(botao);
				caixa.appendChild(botaoS);
											
				
			}	
			else {
				
				alert(xmlreq.statusText);
				
			}		
		}		
	};
	
	xmlreq.send(null);	

}

//AO CLICAR NO BOTÃO "X" - EXCLUIR
function desativarTextBox(elementoHTML, nomeAmostra) {
	
	elementoSel = document.getElementById(elementoHTML);
	celula = elementoSel.cells[1];
	celula.innerHTML = '';
	celula.innerHTML = nomeAmostra;
	
}


//AO PRESSIONAR A TECLA ENTER PARA SALVAR A INFORMAÇÃO
function salvarDados(elementoHTML) {
	
	nomeAmostra = document.getElementById("txt_namostra").value;
	
	//CRIANDO OBJETO XMLHTTPREQUEST
	var xmlreq = objetoAj();
	
	//ABRINDO CONEXÃO COM O ARQUIVO DE FUNÇÕES INTERNAS
	xmlreq.open("GET", "php/funcoesInternas.php?salvarDados="+nomeAmostra, true);
	
	xmlreq.onreadystatechange = function() {
		
		//INDICAÇÃO QUE A CONEXÃO FOI FINALIZADA
		if (xmlreq.readyState == 4) {
			
			//RECEBE UMA MENSAGEM DO ARQUIVO PHP REQUISITADO			
			if (xmlreq.status == 200) {
				
				//COMUNICAÇÃO COM O ARQUIVO PHP OCORREU COM SUCESSO							
				elementoSel = document.getElementById(elementoHTML);
				celula = elementoSel.cells[1];
				celula.innerHTML = nomeAmostra.toUpperCase();
				
			}	
			else {
				
				alert(xmlreq.statusText);
				
			}		
		}		
	};
	
	xmlreq.send(null);	
	
}
