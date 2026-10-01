function popup(a,c,t){
	let acao = a;
	let idcardapio = c;
	let tituloestabelecimento = t;

	//alert(idcardapio);
	
	if(acao==1){
		document.getElementById('popup-cadastro').style.display='block';
		
		if(idcardapio>0){
			document.getElementsByName('nome')[0].value = tituloestabelecimento;
			document.getElementsByName('idCardapio')[0].value = idcardapio;
		}
	}
	else{
		document.getElementById('popup-cadastro').style.display='none';
		document.getElementsByName('nome')[0].value = "";
		document.getElementsByName('idCardapio')[0].value = "";
	}	
}