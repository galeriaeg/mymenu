<?php 
	include "session.php";
	
	require_once "config/conecta.php";
	
	
	//verifica se há cardapio criado
	$sql = "SELECT id FROM t_cardapio WHERE idUsuario = $idUsuarioLogado" ;
	$res = mysqli_query($conexao, $sql);
	$qtde_cardapio = mysqli_num_rows($res);
	while ($row = mysqli_fetch_array($res)){
		$idCardapio	=	$row['id'];
	}
	
	if($qtde_cardapio){
	
		$classCardapio = "style='color:#02c426'";
		
		
		//Categorias cadastradas
		$sql = "SELECT id FROM t_categoria WHERE idCardapio = $idCardapio" ;
		$res = mysqli_query($conexao, $sql);
		$qtde_categoria = mysqli_num_rows($res);
		
		if($qtde_categoria)
		$classCategoria = "style='color:#02c426'";
		
		
		//Itens cadastrados
		$sql = "SELECT id FROM t_item WHERE idCardapio = $idCardapio" ;
		$res = mysqli_query($conexao, $sql);
		$qtde_item = mysqli_num_rows($res);
		
		if($qtde_item)
		$classItem = "style='color:#02c426'";
		
		
		// layout customiza cores
		$sql = "SELECT id,tipo FROM t_customiza WHERE idUsuario = $idUsuarioLogado AND tipo > 0" ;
		$res = mysqli_query($conexao, $sql);
		$qtde_cores = mysqli_num_rows($res);
		
		if($qtde_cores)
		$classCores = "style='color:#02c426'";
	}
?>


<div class="content-total">
	
	<section class="col3 box-video">
		<video controls poster="video/video-capa.png">
			<source src="video/video_mymenu.mp4" type="video/mp4">
			<source src="video/video_mymenu.ogg" type="video/ogg">
			Your browser does not support the video tag.
		</video> 
	</section>
	
	
	<section class="col3 card-dashboard">
		<div class="box-interno-card">
			<h6 class="titulo-card terra"><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;&nbsp;Configuração</h6>
			<div><i class="fa fa-check-square" <?php echo $classCardapio; ?> aria-hidden="true"></i> Cardápio criado</div>
			<div><i class="fa fa-check-square" <?php echo $classCategoria; ?> aria-hidden="true"></i> Categoria(s) criada(s)</div>
			<div><i class="fa fa-check-square" <?php echo $classItem; ?> aria-hidden="true"></i> Iten(s) criado(s)</div>
			<div><i class="fa fa-check-square" <?php echo $classCores; ?> aria-hidden="true"></i> Layout personalizado</div>
		</div>
	</section>
	
	
	<section class="col3 card-dashboard">
		<div class="box-interno-card">
			<h6 class="titulo-card terra"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;&nbsp;Ajuda</h6>
			<h6 class="cinza">Disponibilizamos para você um manual completo do MyMenu para você tirar suas dúvidas sempre achar necessário.</h6>
			<h6 class="box-botons"><a href="#" class="link-padrao">Abrir</a></h6>
		</div>
	</section>
	
</div>

<?php mysqli_close($conexao); ?>	