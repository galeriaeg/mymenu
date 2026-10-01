<section class="box-topo">
	<div style="display:flex;align-items:center;">
		<h2><img src="img/logo-mymenu.png"></h2>
		<ul>
			<li><a href="index.php" class="amenu">Categorias</a></li>
			<li><a href="imagem.php" class="amenu">Imagens</a></li>
			<li><a href="logout.php" class="amenu">Sair</a></li>
		</ul>
	</div>
	<span><?php echo $idUsuarioLogado = $_SESSION['email_user']; ?></span>
</section>