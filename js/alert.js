function ocultaAlerta(){
	setTimeout(() => {
		document.getElementById('alerta').style.opacity=0;
		fechaAlerta();
	}, 5000);
}
function fechaAlerta(){
	setTimeout(() => {
		document.getElementById('alerta').style.display='none';
	}, 3000);
}



function ocultaAlertaCpf(){
	document.getElementById('alertacpf').style.display='block';
	setTimeout(() => {
		document.getElementById('alertacpf').style.display='none';
		//document.getElementById('alertacpf').style.opacity=0;
		//document.getElementById('alertacpf').style.opacity=1;
	}, 5000);
}