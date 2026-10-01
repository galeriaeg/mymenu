function popup_qrcode(v){
	let acao = v;
	if(acao==1){
		document.getElementById('popup-qrcode').style.display='block';
	}
	else{
		document.getElementById('popup-qrcode').style.display='none';
		document.querySelector("form").reset();
	}	
}