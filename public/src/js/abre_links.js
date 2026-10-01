function abreLinks(){

	let fleg = document.getElementById('btnlinks').title;
	
	if(fleg=="linksoff"){
		document.getElementById('btnlinks').title="linkson";
		document.getElementById('dropdown_links').style.display='block';
	}
	else{
		document.getElementById('btnlinks').title="linksoff";	
		document.getElementById('dropdown_links').style.display='none';
	}
}