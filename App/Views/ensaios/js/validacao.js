function filtrarEnsaios(combo) {
	
	setor = document.frm_cadEnsaios.cb_cadEnsaios.value;
	ensaio = document.frm_cadEnsaios.txt_ensaio.value;
	preco = document.frm_cadEnsaios.txt_preco.value;
	carga = document.frm_cadEnsaios.txt_carga.value;
	
	location.href = "index.php?filtrar="+combo.value+"&setor="+setor+"&ensaio="+ensaio+"&preco="+preco+"&carga="+carga;
	
}

function inserirNorma() {
	
	
}

function pegarRef(refer) {
	
	setor = document.frm_cadEnsaios.cb_cadEnsaios.value;
	ensaio = document.frm_cadEnsaios.txt_ensaio.value;
	preco = document.frm_cadEnsaios.txt_preco.value;
	carga = document.frm_cadEnsaios.txt_carga.value;
	
	location.href = "index.php?retirarRef="+refer+"&setor="+setor+"&ensaio="+ensaio+"&preco="+preco+"&carga="+carga;
	
}

function escolherEnsaio(combo) {
	
	setor = document.frm_cadEnsaios.cb_cadEnsaios.value;
	setor = document.frm_cadEnsaios.cb_cadEnsaios.value;
	ensaio = document.frm_cadEnsaios.txt_ensaio.value;
	preco = document.frm_cadEnsaios.txt_preco.value;
	carga = document.frm_cadEnsaios.txt_carga.value;
	
	location.href = "index.php?escolher="+combo.value+"&setor="+setor+"&ensaio="+ensaio+"&preco="+preco+"&carga="+carga;	
}

function validar() {
	
	
	
	setor = document.frm_cadEnsaios.cb_cadEnsaios.value;
	ensaio = document.frm_cadEnsaios.txt_ensaio.value;
	preco = document.frm_cadEnsaios.txt_preco.value;
	carga = document.frm_cadEnsaios.txt_carga.value;
	
		if (setor == "" || ensaio == "" || preco == "" || carga == "") {
			
			
			alert('POR FAVOR, PREENCHA OS CAMPOS EM DESTAQUE!');

			
			if (setor == "") {
				
				document.frm_cadEnsaios.cb_cadEnsaios.style.backgroundColor = "#68A0D9";
			}
			
			if (ensaio == "") {
				
				document.frm_cadEnsaios.txt_ensaio.style.backgroundColor = "#68A0D9";
			}
			
			if (preco == "") {
				
				document.frm_cadEnsaios.txt_preco.style.backgroundColor = "#68A0D9";
			}
			
			if (carga == "") {
				
				document.frm_cadEnsaios.txt_carga.style.backgroundColor = "#68A0D9";
			}
			
		}
		else
		{
			
			document.frm_cadEnsaios.submit();
			
		}
	
}

function cor(caixa) {
	
	caixa.style.backgroundColor = "#FFFFFF";
	
}
