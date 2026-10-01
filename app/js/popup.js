/*function popup(v){
	let acao = v;
	if(acao==1){
		document.getElementById('popup-cadastro').style.display='block';
	}
	else{
		document.getElementById('popup-cadastro').style.display='none';
	}	
}*


/*
function limparFormulario() {
	const formulario = document.getElementById('formItem');
	formulario.reset();

}*/


/*
function checaPromocao(){
	let fleg = document.getElementById('promocao').value;
	
	if(fleg < 1){
		document.getElementById('checkbox').src="img/btn-check-on.png";
		document.getElementById('promocao').value=1;	
	}
	else{
		document.getElementById('checkbox').src="img/btn-check-off.png";
		document.getElementById('promocao').value=0;
	}
	
}*/


function exibeOcultaBloco(){
	let fleg = document.getElementById('bloco-oculto').style.display;
	
	if(fleg=="none")
	document.getElementById('bloco-oculto').style.display='block';
	else
	document.getElementById('bloco-oculto').style.display='none';
}