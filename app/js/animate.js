// Espera a página ser totalmente carregada
window.onload = function () {
  // Encontra a div com a classe minhacaixa
  const minhaCaixa = document.querySelector(".alertaModal");

  // Adiciona a classe 'aparecer' para iniciar a animação
  setTimeout(() => {
    minhaCaixa.classList.add("aparecer");
  }, 80); // Pequeno atraso para garantir que a página renderizou corretamente
};
