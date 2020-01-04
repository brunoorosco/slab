function validar() {
	
	
	
	codigoCliente = document.frm_cadEmpresas.txt_codcliente.value;
	empresa = document.frm_cadEmpresas.txt_nome.value;
	email = document.frm_cadEmpresas.txt_email.value;
	cnpj = document.frm_cadEmpresas.txt_cnpj.value;
	telefone = document.frm_cadEmpresas.txt_telefone.value;
	telefone2 = document.frm_cadEmpresas.txt_telefone2.value;
	celular = document.frm_cadEmpresas.txt_celular.value;
	cpf = document.frm_cadEmpresas.txt_cpf.value;
	
		if ((telefone == "" && telefone2 == "" && celular == "")||(cnpj == "" && cpf == "")||codigoCliente == "" || empresa == "" || email == "" || telefone == "") {
			
			
			alert('POR FAVOR, PREENCHA OS CAMPOS EM DESTAQUE!');
			
			if (telefone == "" && telefone2 == "" && celular == "") {
				
				alert('INFORME NO MÍNIMO UM TELEFONE PARA CONTATO');
				
				document.frm_cadEmpresas.txt_telefone.style.backgroundColor = "#68A0D9";
				document.frm_cadEmpresas.txt_telefone2.style.backgroundColor = "#68A0D9";
				document.frm_cadEmpresas.txt_celular.style.backgroundColor = "#68A0D9";
				
			}
			
			if (cnpj == "" && cpf == "") {
				
				alert('INFORME UM CPF OU CNPJ');
				
				document.frm_cadEmpresas.txt_cnpj.style.backgroundColor = "#68A0D9";
				document.frm_cadEmpresas.txt_cpf.style.backgroundColor = "#68A0D9";
			}
			
			if (codigoCliente == "") {
				
				document.frm_cadEmpresas.txt_codcliente.style.backgroundColor = "#68A0D9";
			}
			
			if (empresa == "") {
				
				document.frm_cadEmpresas.txt_nome.style.backgroundColor = "#68A0D9";
			}
			
			if (email == "") {
				
				document.frm_cadEmpresas.txt_email.style.backgroundColor = "#68A0D9";
			}
			
			if (cnpj == "") {
				
				document.frm_cadEmpresas.txt_cnpj.style.backgroundColor = "#68A0D9";
			}
			
		}
		else
		{
			
			document.frm_cadEmpresas.submit();
			
		}
	
}

function cor(caixa) {
	
	caixa.style.backgroundColor = "#FFFFFF";
	
}
