<?php include "session.php"; ?>

<div id="qrcode"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
	var qrcodeElement = document.getElementById("qrcode");
	var qrcode = new QRCode(qrcodeElement, {
		text: "https://google.com",
		width: 328,
		height: 328,
	});
</script>




<button onclick="downloadImage()">Baixar Imagem</button>

<script>
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
		link.download = 'imagem-baixada.png'; // Nome do arquivo para download
		
		// Anexar o link ao corpo do documento (invisível)
		document.body.appendChild(link);
		
		// Simular um clique no link
		link.click();
		
		// Remover o link do documento
		document.body.removeChild(link);
	}
</script>