function mostraSenha(a){
	
	let fleg = a;
	
	if(fleg == "senha_off"){
		document.getElementById('icon-senha').src = "img/icon-senha-on.png";
		document.getElementById('icon-senha').alt = "senha_on";
		document.getElementById('senha').type = "text";
	}
	else{
		document.getElementById('icon-senha').src = "img/icon-senha-off.png";
		document.getElementById('icon-senha').alt = "senha_off";
		document.getElementById('senha').type = "password";
	}

}
