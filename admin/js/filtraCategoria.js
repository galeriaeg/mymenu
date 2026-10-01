function filtraCategoria(){
	let categoria = document.getElementById('filtroCategoria').value;
	window.location.href='imagem.php?ctg='+categoria;
}