	function moeda(p){
		let valor = p;
		let tam = valor.length;
		let atual;
		let dezena,centena,millhar;
		if(tam==1){
			document.getElementById("preco").value=valor+',';
			atual = document.getElementById("preco").value;
			tam = atual.length;
			//console.log(tam);
		}
		if(tam==5){
			atual = document.getElementById("preco").value;
			atual = atual.replace(',','');
			dezena = atual.slice(0,2);
			decimais = atual.slice(2);
			document.getElementById("preco").value=dezena+','+decimais;
		}
		else if(tam==6){
			atual = document.getElementById("preco").value;
			atual = atual.replace(',','');
			centena = atual.slice(0,3);
			decimais = atual.slice(-2);
			document.getElementById("preco").value=centena+','+decimais;
		}
		else if(tam==7 && tam<9){
			atual = document.getElementById("preco").value;
			atual = atual.replace(',','');
			milhar = atual.slice(0,1);
			centena = atual.slice(1,4);
			decimais = atual.slice(-2);
			document.getElementById("preco").value=milhar+'.'+centena+','+decimais;
		}
		
	}	
	
	
	
	function limpaMoeda(){
		document.getElementById("preco").value="";
	}