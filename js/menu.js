function menuMob(){
	
	let menu = document.getElementById('menu').style.display;
	
	if(menu=='none'){
		document.getElementById('menu').style.display='grid';
		document.getElementById('imgbars').src='img/btn-close.png';
	}
	else{
		document.getElementById('menu').style.display='none';
		document.getElementById('imgbars').src='img/btn-bars.png';
	}	
}
