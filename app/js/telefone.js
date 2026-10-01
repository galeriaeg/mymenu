function fone(p){
	let valor = p;
	let tam = valor.length;

	if(tam==2){
		document.getElementById("preco").value=valor+'-';
		atual = document.getElementById("preco").value;
		tam = atual.length;
	}
	
}