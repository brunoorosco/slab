function filtrarEnsaios(combo) {
	
	setor = document.frm_cadEnsaios.cb_cadEnsaios.value;
	ensaio = document.frm_cadEnsaios.txt_ensaio.value;
	preco = document.frm_cadEnsaios.txt_preco.value;
	carga = document.frm_cadEnsaios.txt_carga.value;
	
	location.href = "index.php?filtrar="+combo.value+"&setor="+setor+"&ensaio="+ensaio+"&preco="+preco+"&carga="+carga;
	
}


function validar() {
	
	
	
	produto = document.frm_cadProdutos.txt_produto.value;
	preco = document.frm_cadProdutos.txt_preco.value;
	
		if (produto == "" || preco == "") {
			
			
			alert('POR FAVOR, PREENCHA OS CAMPOS EM DESTAQUE!');

			
			if (produto == "") {
				
				document.frm_cadProdutos.txt_produto.style.backgroundColor = "#68A0D9";
			}
			
			if (preco == "") {
				
				document.frm_cadProdutos.txt_preco.style.backgroundColor = "#68A0D9";
			}
			
		}
		else
		{
			
			document.frm_cadProdutos.submit();
			
		}
	
}

function cor(caixa) {
	
	caixa.style.backgroundColor = "#FFFFFF";
	
}
