//BLOCO CADASTRO
function popupCadastro(v) {
  let acao = v; //fleg para exibir e ocultar
  const popupCadastro = document.getElementById("popup-cadastro");
  if (acao == 1) {
    popupCadastro.style.display = "block";
  } else {
    popupCadastro.style.display = "none";
  }
}

//BLOCO EDITA
function popupEdita(v, i) {
  let acao = v; //fleg para exibir e ocultar
  let idItemEd = i; // id do item

  const popup = document.getElementById("popup-edita");
  const formulario = popup.querySelector("form");

  if (acao == 1) {
    popup.style.display = "block";
    if (idItemEd > 0) {
      //document.getElementById("idItemEd").value = idItemEd;
      pegaDados(idItemEd);
      console.log("id do cadastro " + idItemEd);
    }
  } else {
    //limpa form e fecha popup
    formulario.reset();
    popup.style.display = "none";
  }
}

//fecha popup de cadastro e edição
function fechaPopup() {
  const popup = document.getElementById("popup-edita");
  const formulario = popup.querySelector("form");
  formulario.reset();
  popup.style.display = "none";
}

//BLOCO EDIÇÃO
function definePromocao() {
  let fleg = document.getElementById("promocao-ed").value;

  if (fleg == "NORMAL") {
    document.getElementById("checkbox").src = "img/btn-check-on.png";
    document.getElementById("promocao-ed").value = "OFERTA";
  } else {
    document.getElementById("checkbox").src = "img/btn-check-off.png";
    document.getElementById("promocao-ed").value = "NORMAL";
  }
}

// A função JavaScript agora espera um parâmetro (o vetor)
function processarVetor(arrayRecebido) {
  // Desestruturando o array para variáveis individuais
  const [
    id_item,
    cod_item,
    titulo_item,
    descricao_item,
    preco_item,
    foto_item,
    fotobd_item,
    //tipo_item,
    status_item,
    idCardapio,
    idCategoria,
    cod_path,
    idUsuario,
  ] = arrayRecebido;

  console.log(arrayRecebido);

  let fotoItem = "";

  if (foto_item && foto_item.trim() !== "") {
    fotoItem = foto_item;
  } else {
    fotoItem = fotobd_item;
  }

  //fotoItem = "files/" + idUsuario + "-" + cod_path + "/" + fotoItem;
  fotoItem = fotoItem.replaceAll("+", "/");
  console.log("imagem definida: " + fotoItem);

  document.getElementById("codigo-ed").textContent = "Cód.:" + cod_item;
  document.getElementById("titulo-ed").value = titulo_item;
  document.getElementById("descricao-ed").value = descricao_item;
  document.getElementById("preco-ed").value = preco_item;
  document.getElementById("arquivo-ed").src = fotoItem;
  //document.getElementById("file-base-ed").value = fotobd_item;
  document.getElementById("promocao-ed").value = tipo_item;
  document.getElementById("status-ed").value = status_item;
  document.getElementById("idCardapio-ed").value = idCardapio;
  document.getElementById("idCategoria-ed").value = idCategoria;
}

/*
function definePromocao() {
  let fleg = document.getElementById("promocao-ed").value;

  alert(fleg);

  if (fleg == "NORMAL") {
    document.getElementById("checkbox").src = "img/btn-check-on.png";
    document.getElementById("promocao-ed").value = "OFERTA";
  } else {
    document.getElementById("checkbox").src = "img/btn-check-off.png";
    document.getElementById("promocao-ed").value = "NORMAL";
  }
}*/
