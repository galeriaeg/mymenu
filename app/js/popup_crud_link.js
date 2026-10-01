function popup(a, f, u) {
  let acao = a,
    fleg = f,
    url = u,
    url_label;

  if (fleg == 1) {
    url_label = "Site";
  } else if (fleg == 2) {
    url_label = "Instagram";
  } else if (fleg == 3) {
    url_label = "Facebook";
  } else {
    url_label = "Blog";
  }

  if (url == "NULL") {
    url = "";
  }

  if (acao == 1) {
    document.getElementById("urlLabel").innerHTML = url_label;
    document.getElementById("tipo").value = url_label;
    document.getElementById("url").value = url;
    document.getElementById("popup-cadastro").style.display = "block";
  } else {
    document.getElementById("popup-cadastro").style.display = "none";
  }
}

function send(f, c) {
  let fleg = f,
    cardapio = c,
    url_label;

  if (fleg == 1) {
    url_label = "site";
  } else if (fleg == 2) {
    url_label = "instagram";
  } else if (fleg == 3) {
    url_label = "facebook";
  } else {
    url_label = "blog";
  }

  window.location.href =
    "index.php?m=72&t=" + url_label + "&c=" + cardapio + "&cnf=false";
}

function addProtocol() {
  let dados = document.getElementById("url").value;
  if (dados.length < 8) {
    document.getElementById("url").value = "https://";
  }
}
