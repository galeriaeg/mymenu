
function captcha(){
	var numero = Math.random();
	numero = numero.toString();
	res = numero.substring(2);
	res = res.substring(4, -5);
	document.getElementById('viewCaptcha').innerHTML=res;
	document.getElementById('randCaptcha').value=res;
}

function validaCaptcha(){
	var mc = document.getElementById('meuCaptcha').value;
	var rc = document.getElementById('randCaptcha').value;
	
	if((mc != "")&&(mc != rc)){
		//alert("Erro! Captcha incorreto!");
		
		document.getElementById('meuCaptcha').style.border="1px solid red";
		document.getElementById('meuCaptcha').value="";
		formCaptcha.meuCaptcha.focus();
		return (false); 
	}
}

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