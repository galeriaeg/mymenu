<?php
	$sql = "SELECT car.*, cus.codigo_path AS codpath 
	FROM t_cardapio AS car,t_customiza AS cus
	WHERE car.id = '$idcardapio' 
	AND  car.id = cus.idCardapio 
	AND car.status=1 LIMIT 1";
	$res = mysqli_query($conexao, $sql);
	while ($row = mysqli_fetch_array($res)){
		$id_cardapio	=	$row['id'];
		$titulo_cardapio=	$row['titulo'];
		$logo_cardapio	=	$row['logo'];
		$link_categoria	=	$row['link'];
		$idUsuario		=	$row['idUsuario'];
		$codPath		=	$row['codpath'];
	}
	
	
	if(empty($logo_cardapio))
		$logo = "../app/img/sem-img.png";
	else
		$logo = "../app/files/".$idUsuario."-".$codPath."/".$logo_cardapio;
?>


<header style="background-color:<?php echo $cor_topo; ?>">
	<div onclick="window.location.href='<?php echo $link_categoria; ?>'" style="cursor:pointer;">
		<img src="<?php echo $logo; ?>" class="logo" />
		<span style="color:<?php echo $cor_texto_topo; ?>"><?php echo $titulo_cardapio; ?></span>
	</div>
	<div class="icone-link-topo" id="btnlinks" title="linksoff" onclick="abreLinks()" style="color:<?php echo $cor_texto_topo; ?>">&#9741;</div>
</header>



<div id="dropdown_links" class="dropdown-link-topo" style="display:none;">
	<?php
		$sql = "SELECT * FROM t_links_externos WHERE id_cardapio='$idcardapio' LIMIT 1";
		$res = mysqli_query($conexao, $sql);
		while ($row = mysqli_fetch_array($res)){
			$id_link		=	$row['id'];
			$site_link		=	$row['site'];
			$instagram_link	=	$row['instagram'];
			$facebook_link	=	$row['facebook'];
			$blog_link		=	$row['blog'];
			$id_cardapio	=	$row['id_cardapio'];
		}
		
		if($site_link != 'NULL'){
			echo "<a href='$site_link' target='_blank'>Site</a>";
		}
		if($instagram_link != 'NULL'){
			echo "<a href='$instagram_link' target='_blank'>Instagram</a>";
		}
		if($facebook_link != 'NULL'){
			echo "<a href='$facebook_link' target='_blank'>Facebook</a>";
		}
		if($blog_link != 'NULL'){
			echo "<a href='$blog_link' target='_blank'>Blog</a>";
		}
	?>
</div>

<script src="src/js/abre_links.js"></script>