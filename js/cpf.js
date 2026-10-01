function somente_numero(campo){  
	var digits="0123456789"  
	var campo_temp   
    for (var i=0;i<campo.value.length;i++){  
        campo_temp=campo.value.substring(i,i+1)   
        if (digits.indexOf(campo_temp)==-1){  
            campo.value = campo.value.substring(0,i);  
		}  
	}  
}  




function verificarCPF(c){
	var i;
	s = c;
	
	if (s==""){
		//alert("vazio");
	}
	else if(s=='00000000000'){
		//alert("CPF Inválido");
		document.getElementById('cpf').value='';
		v = true;
		return false;
	}
	else if(s=='11111111111'){
		//alert("CPF Inválido");
		document.getElementById('cpf').value='';
		v = true;
		return false;
	}
	else if(s=='22222222222'){
		//alert("CPF Inválido");
		document.getElementById('cpf').value='';
		v = true;
		return false;
	}
	else if(s=='33333333333'){
		//alert("CPF Inválido");
		document.getElementById('cpf').value='';
		v = true;
		return false;
	}
	else if(s=='44444444444'){
		//alert("CPF Inválido");
		document.getElementById('cpf').value='';
		v = true;
		return false;
	}
	else if(s=='55555555555'){
		//alert("CPF Inválido");
		document.getElementById('cpf').value='';
		v = true;
		return false;
	}
	else if(s=='66666666666'){
		//alert("CPF Inválido");
		document.getElementById('cpf').value='';
		v = true;
		return false;
	}
	else if(s=='77777777777'){
		//alert("CPF Inválido");
		document.getElementById('cpf').value='';
		v = true;
		return false;
	}
	else if(s=='88888888888'){
		//alert("CPF Inválido");
		document.getElementById('cpf').value='';
		v = true;
		return false;
	}
	else if(s=='99999999999'){
		//alert("CPF Inválido");
		document.getElementById('cpf').value='';
		v = true;
		return false;
	}
	else{
		
		
		var c = s.substr(0,9);
		var dv = s.substr(9,2);
		var d1 = 0;
		var v = false;
		
		for (i = 0; i < 9; i++){
			d1 += c.charAt(i)*(10-i);
		}
		if (d1 == 0){
			//document.getElementById('alertacpf').style.display='block';
			ocultaAlertaCpf();
			//alert("CPF Inválido")
			v = true;
			return false;
		}
		d1 = 11 - (d1 % 11);
		if (d1 > 9) d1 = 0;
		if (dv.charAt(0) != d1){
			//alert("CPF Inválido");
			//document.getElementById('alertacpf').style.display='block';
			ocultaAlertaCpf();
			document.getElementById('cpf').value='';
			form_cadastro.cpf.focus();
			v = true;
			return false;
		}
		
		d1 *= 2;
		for (i = 0; i < 9; i++){
			d1 += c.charAt(i)*(11-i);
		}
		d1 = 11 - (d1 % 11);
		if (d1 > 9) d1 = 0;
		if (dv.charAt(1) != d1){
			//alert("CPF Inválido")
			//document.getElementById('alertacpf').style.display='block';
			ocultaAlertaCpf();
			document.getElementById('cpf').value='';
			form_cadastro.cpf.focus();
			v = true;
			return false;
		}
		if (!v) {
			// alert(c + "CPF válido")
		}
		
	}
	
}