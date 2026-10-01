function popup(a,f,c){
	let acao = a;
	let fleg = f;
	let cor	 = c;
	let flegLabel;
	
	let idCustomiza = document.getElementById('id_customizacao').value;
	
	//flegs:
	//1 = Topo principal
	//2 = Texto do topo
	//3 = Topo dos botões
	//4 = Botão
	//5 = Texto do botão
	//6 = Preço do item
	
	switch (fleg) {
	  case 1:
		flegLabel = "Topo principal:";
		break;
	  case 2:
		flegLabel = "Texto do topo:";
		break;
	  case 3:
		flegLabel = "Topo dos botões:";
		break;
	  case 4:
		flegLabel = "Botão:";
		break;		
	  case 5:
		flegLabel = "Texto do botão:";
		break;
	  case 6:
		flegLabel = "Preço do item:";
		break;			

	  default:
		flegLabel = "";
	}

	
	
	if(acao==1){
		document.getElementById('popup-cadastro').style.display='block';
		document.getElementById('inputcor').value= cor ;
		document.getElementById('labelcor').innerHTML= flegLabel ;
		document.getElementById('idCustomiza').value = idCustomiza ;
		document.getElementById('flegCor').value = fleg ;
	}
	else{
		//limpa o form
		const popup = document.getElementById('popup-cadastro');
		const formulario = popup.querySelector('form');
		formulario.reset();
		
		document.getElementById('popup-cadastro').style.display='none';
		
	}
}