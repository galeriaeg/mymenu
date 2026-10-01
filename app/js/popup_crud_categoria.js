function popup(a,c,n){
	let acao = a;
	let idcategoria = c;
	let nomecategoria = n;
	
	console.log(acao);
	console.log(idcategoria);
	console.log(nomecategoria);
	
	if(acao==1){
		document.getElementById('popup-cadastro').style.display='block';
		
		if(idcategoria>0){
			document.getElementsByName('nome')[0].value = nomecategoria;
			document.getElementsByName('idCategoria')[0].value = idcategoria;
		}
	}
	else{
		document.getElementById('popup-cadastro').style.display='none';
		
		// limpa form
		document.getElementsByName('nome')[0].value = "";
		document.getElementsByName('idCategoria')[0].value = "";
	}	
}