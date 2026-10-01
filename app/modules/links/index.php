<?php include "session.php"; ?>

<?php include "checa_pagamento.php";?>

<h4 class="titulo-page"><?php echo $titulo ;?></h4>

<section class="header-modulo">
	<h6 class="cinza">Adicione links externos no seu cardápio.</h6>
</section>


<section class="box-registros">
	
	
	<?php
		$idUsuarioLogado = $_SESSION['id'];
		
		require_once "config/conecta.php";
		
		// pega ID do cardapio
		$sql = "SELECT id FROM t_cardapio WHERE idUsuario=$idUsuarioLogado";
		$res = mysqli_query($conexao, $sql);
		$total_cardapio = mysqli_num_rows($res);
		while ($row = mysqli_fetch_array($res)){
			$id_cardapio	=	$row['id'];
		}
		
		if($total_cardapio < 1){
		echo "
			<h6 class='alert-notification'>
			<i class='fa fa-exclamation-circle icon-alert' aria-hidden='true'></i>
			&nbsp; Não há registros! Primeiramente <a href='index.php?m=3'>&nbsp;crie seu cardápio</a>.
			</h6>";
			exit();
		}
		

		
		//pega os links
		$sql = "SELECT * FROM t_links_externos WHERE id_cardapio=$id_cardapio";
		$res = mysqli_query($conexao, $sql);
		$total = mysqli_num_rows($res);
		while ($row = mysqli_fetch_array($res)){
			$id_link		=	$row['id'];
			$site_link		=	$row['site'];
			$instagram_link	=	$row['instagram'];
			$facebook_link	=	$row['facebook'];
			$blog_link		=	$row['blog'];
		}
		
		
		
		if(!empty($site_link)){
			
		
			strlen($site_link);
			if($tam>40)
				$urlmin = substr($site_link, 0, 35).'...';
			else 
				$urlmin = $site_link;
			
			echo "
			<div class='col3'>
			<div class='card-registro card3'>
			<span>
			<div class='ico-links' style='background-image:url(img/icon-site.png);'></div>
			$urlmin
			</span>
			<div class='box-botons-cardapio'>
			<img src='img/btn-editar.png' class='btn-actions' onclick='popup(1,1,\"$site_link\");' alt='botão editar' />
			<img src='img/btn-excluir.png' id='btn-excluir-site' class='btn-actions less-right' onclick='send(1,\"$id_cardapio\");' alt='botão excluir' />
			</div>
			</div>
			</div>";
			
			if($site_link=='NULL'){
				echo "<script>document.getElementById('btn-excluir-site').remove();</script>";
			}
		}
		
		if(!empty($instagram_link)){
		
			$tam = strlen($instagram_link);
			
			if($tam>40)
				$urlmin = substr($instagram_link, 0, 35).'...';
			else
				$urlmin = $instagram_link;		
		
			echo "
			<div class='col3'>
			<div class='card-registro card3'>
			<span>
			<div class='ico-links' style='background-image:url(img/icon-instagram.png);'></div>
			$urlmin
			</span>
			<div class='box-botons-cardapio'>
			<img src='img/btn-editar.png' class='btn-actions' onclick='popup(1,2,\"$instagram_link\");' alt='botão editar' />
			<img src='img/btn-excluir.png' id='btn-excluir-insta' class='btn-actions less-right' onclick='send(2,\"$id_cardapio\");' alt='botão excluir' />
			</div>
			</div>
			</div>";
			
			if($instagram_link=='NULL'){
				echo "<script>document.getElementById('btn-excluir-insta').remove();</script>";
			}
		}
		
		if(!empty($facebook_link)){
		
			$tam = strlen($facebook_link);
			
			if($tam>40)
				$urlmin = substr($facebook_link, 0, 35).'...';
			else
				$urlmin = $facebook_link;
		
			echo "
			<div class='col3'>
			<div class='card-registro card_reg3'>
			<span>
			<div class='ico-links' style='background-image:url(img/icon-facebook.png);'></div>
			$urlmin
			</span>
			<div class='box-botons-cardapio'>
			<img src='img/btn-editar.png' class='btn-actions' onclick='popup(1,3,\"$facebook_link\");' alt='botão editar' />
			<img src='img/btn-excluir.png' id='btn-excluir-face' class='btn-actions less-right' onclick='send(3,\"$id_cardapio\");' alt='botão excluir' />
			</div>
			</div>
			</div>";

			if($facebook_link=='NULL'){
				echo "<script>document.getElementById('btn-excluir-face').remove();</script>";
			}
			
		}			
		
		if(!empty($blog_link)){
		
			$tam = strlen($blog_link);
			
			if($tam>40)
				$urlmin = substr($blog_link, 0, 35).'...';
			else
				$urlmin = $blog_link;		
		
			echo "
			<div class='col3'>
			<div class='card-registro card_reg3'>
			<span>
			<div class='ico-links' style='background-image:url(img/icon-blog.png);'></div>
			$urlmin
			</span>
			<div class='box-botons-cardapio'>
			<img src='img/btn-editar.png' class='btn-actions' onclick='popup(1,4,\"$blog_link\");' alt='botão editar' />
			<img src='img/btn-excluir.png' id='btn-excluir-blog' class='btn-actions less-right' onclick='send(4,\"$id_cardapio\");' alt='botão excluir' />
			</div>
			</div>
			</div>";

			if($blog_link == 'NULL'){
				echo "<script>document.getElementById('btn-excluir-blog').remove();</script>";
			}
			
		}
		
		
		
		if($total<1){
			echo "<h5 class='alert-notification'>
			<i class='fa fa-exclamation-circle' aria-hidden='true'></i>
			&nbsp; Não há registros
			<h5>";
		}
	?>
</section>


<!-- POPUP CRUD -->
<section id="popup-cadastro" class="popup_cadastro">
	<form action="index.php?m=71" id="form" method="POST">
		<h4 class="titulo_popup">Cadastrar link <span onclick="popup(0);" class="btn-fechar-popup">&#215;</span></h4>
		
		<input type="text" class="campo_g" name="url" onclick="addProtocol()" required id="url" value="" />
		
		<div id="bloco-label" class="box-checkbox-form" style='margin-top:6px;'>
			<img src="img/btn-check-on.png" class="input_check" alt="checkbox" style='cursor:none;'>
			<h6 class="cinza" id="urlLabel" style="display:contents;margin:0;"></h6>
		</div>
	
		
		<div class="box-submit">
			<input type="submit" class="btn-submit" value="Cadastrar" />
			<input type="hidden" name="idCardapio" readonly id="idCardapio" value="<?php echo $id_cardapio; ?>" />
			<input type="hidden" name="tipo" readonly id="tipo" value="" />
		</div>
		
	</form>
</section>

<script src="./js/popup_crud_link.js"></script>



