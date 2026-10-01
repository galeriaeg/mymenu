function validarAspectRatio() {
    const inputImagem = document.getElementById("arquivo");
    const arquivo = inputImagem.files[0];

    if (arquivo) {
        const reader = new FileReader();

        reader.onload = function(e) {
            const img = new Image();
            img.onload = function() {
                const largura = img.width;
                const altura = img.height;
                const aspect_ratio = largura / altura;

                if (aspect_ratio === 1.4) { // Exemplo: 14:10
                    //alert("Aspect Ratio correto! Pode enviar.");
                } else {
                    //alert("Imagem com tamanho inválido! Selecione uma imagem com a proporção correta.");
					document.getElementById("alerta-erro-file").style.display='block';
					document.getElementById('alerta-erro-file').innerHTML="Imagem com proporção inválida! Selecione uma imagem com 700 x 500px."; 
					
					//limpa o preview 
					document.getElementById('previsao').style.display="none";
					document.getElementById('previsao').src="";
					document.getElementById('arquivo').value="";
					document.getElementById('box-preview').style.display="none";
					formItem.arquivo.focus();
                }
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(arquivo);
    } else {
        alert("Por favor, selecione uma imagem.");
    }
}