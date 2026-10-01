function menuMob(f) {
  let fleg = f;
  if (fleg == "botao-abre-menu") {
    document.getElementById("box-menu").style.display = "block";
    document.getElementById("menuMob").src = "img/btn-close.png";
    document.getElementById("menuMob").alt = "botao-fecha-menu";
  } else {
    document.getElementById("box-menu").style.display = "none";
    document.getElementById("menuMob").src = "img/btn-bars.png";
    document.getElementById("menuMob").alt = "botao-abre-menu";
  }
}
