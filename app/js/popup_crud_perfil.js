function popup(v){
	let acao = v;
	if(acao==1){
		document.getElementById('popup-cadastro').style.display='block';
	}
	else{
		document.getElementById('popup-cadastro').style.display='none';
	}	
}



function exibeOcultaBloco(){
	let fleg = document.getElementById('bloco-oculto').style.display;
	
	if(fleg=="none")
	document.getElementById('bloco-oculto').style.display='block';
	else
	document.getElementById('bloco-oculto').style.display='none';
}