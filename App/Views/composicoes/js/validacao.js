
function validar() {
	
	
	
	composicao = document.frm_cadComposicoes.txt_composicao.value;

		if (composicao == "") {
			
			
			alert('POR FAVOR, PREENCHA OS CAMPOS EM DESTAQUE!');

				
			document.frm_cadComposicoes.txt_composicao.style.backgroundColor = "#68A0D9";
		
		}
		else
		{
			
			document.frm_cadComposicoes.submit();
			
		}
	
}

function cor(caixa) {
	
	caixa.style.backgroundColor = "#FFFFFF";
	
}
