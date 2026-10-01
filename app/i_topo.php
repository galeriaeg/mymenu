<?php
	
	include "session.php";
	
	$nomeUsuario = $_SESSION["nome"];;
	$nomeVetor = str_split($nomeUsuario);
	$primeiroCaractere = $nomeVetor[0];
	
	$nomeInicial = explode(" ", $nomeUsuario );
	
?>

<div class="box-header-user" id="box-header-user">
	<h6 style="display:contents">
		<div style="margin-right:15px" class="circle-user"><h6><?php echo $primeiroCaractere; ?></h6></div>
		<a href="index.php?m=2"><?php echo $nomeInicial[0]; ?></a>
		<div style="color:#aaa;margin:0 15px">|</div>
		<a href="index.php?m=9">Sair</a>
	</h6>
</div>

<div class="box-header" id="box-header">
	<a href="index.php"><img src="img/logo-mymenu.png" border="0" alt="Logo" /></a>

	<img src="img/btn-bars.png" alt="botao-abre-menu" id="menuMob" class="btn-bars" onclick="menuMob(alt);" />

	<div class="box-menu" id="box-menu" style="display:none;">
		<nav>
			<ul>
				<li><a href="index.php?m=1">Home</a></li>
				<li><a href="index.php?m=3">Cardápio</a></li>
				<li><a href="index.php?m=4">Categorias</a></li>
				<li><a href="index.php?m=5">Itens</a></li>
				<li><a href="index.php?m=6">Personalização</a></li>
				<li><a href="index.php?m=7">Links</a></li>
				<li><i onclick="window.location.href='index.php?m=9'" class="fa fa-sign-out icone" aria-hidden="true"></i></li>
			</ul>
		</nav>
	</div>

</div>

<script src="js/menu_mob.js"></script>