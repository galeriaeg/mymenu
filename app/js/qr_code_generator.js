function downloadImage() {
	// Obter a imagem dentro da div
	const div = document.getElementById('qrcode');
	const imagem = div.querySelector('img');
	
	if (!imagem) {
		alert('Nenhuma imagem encontrada na div!');
		return;
	}
	
	// Pegar o URL da imagem
	const url = imagem.src;
	
	// Criar um link temporário para o download
	const link = document.createElement('a');
	
	// Definir atributos do link
	link.href = url;
	link.download = 'qrcode-baixado.png'; // Nome do arquivo para download
	
	// Anexar o link ao corpo do documento (invisível)
	document.body.appendChild(link);
	
	// Simular um clique no link
	link.click();
	
	// Remover o link do documento
	document.body.removeChild(link);
}