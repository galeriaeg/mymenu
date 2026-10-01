function preview(v) {
  const previewImg = document.getElementById("preview");
  const previsaoImg = document.getElementById("previsao");
  const boxPreview = document.getElementById("box-preview");
  const arquivoInput = document.getElementById("arquivo");

  if (v == 0) {
    // Esconder a pré-visualização
    previsaoImg.style.display = "none";
    previsaoImg.src = ""; // Limpa a URL da imagem
    arquivoInput.value = ""; // Limpa o campo de arquivo
    boxPreview.style.display = "none";
  } else {
    // Exibir a pré-visualização
    const file = arquivoInput.files[0];
    if (file) {
      previsaoImg.src = URL.createObjectURL(file);
      previsaoImg.style.display = "block";
      boxPreview.style.display = "flex";
      // O elemento com ID "preview" não é usado aqui,
      // ele é redundante no seu HTML.
    }
  }
}
