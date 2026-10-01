<div class="header-page">
	<!-- img src="src/img/icon-blocos.png" style="cursor:none;" class="icone-seta" /> <span><strong>Promoções</strong></span-->
	<img src="src/img/tag-promocoes.png" class="tag-promo" alt="tag-promo">
</div>


<section class="main">
	
	<?php
		
		// lista PROMOÇÕES
		
		// A consulta principal agora traz todos os dados necessários
		$sql_promocoes = "SELECT i.*, c.codigo_path AS codigopath, ca.idUsuario AS id_usuario
		FROM t_item AS i
		INNER JOIN t_cardapio AS ca ON i.idCardapio = ca.id
		INNER JOIN t_customiza AS c ON c.idCardapio = i.idCardapio
		WHERE i.idCardapio = $id_cardapio
		AND i.status = 1
		AND i.tipo = 'OFERTA'";
		$res_promocoes = mysqli_query($conexao, $sql_promocoes);
		
		// Verifica se há resultados antes de entrar no loop
		if (mysqli_num_rows($res_promocoes) > 0) {
			while ($row_promo = mysqli_fetch_array($res_promocoes)){
				$id_item        =    $row_promo['id'];
				$cod_item        =    $row_promo['cod_item'];
				$titulo_item    =    $row_promo['titulo'];
				$descricao_item    =    $row_promo['descricao'];
				$preco_item        =    $row_promo['preco'];
				$foto_item        =    $row_promo['foto'];
				$foto_item_bd    =    $row_promo['foto_bd'];
				$tipo_item        =    $row_promo['tipo'];
				$status_item    =    $row_promo['status'];
				$idCardapio        =    $row_promo['idCardapio'];
				$codigoPath        =    $row_promo['codigopath'];
				$idUsuario        =    $row_promo['id_usuario'];
				
				$foto = ''; // Inicializa a variável $foto para cada item
				
				// Lógica para determinar qual imagem usar
				if (!empty($foto_item_bd)) {
					// Foto do banco de imagem (t_mymenu_files)
					$partes = explode('.', $foto_item_bd);
					$categoria_bd = $partes[0];
					$idimg_bd = $partes[1];
					
					// Pega a imagem do banco para ESTE item
					$sql_img_bd = "SELECT imagem FROM t_mymenu_files WHERE categoria='$categoria_bd' AND id='$idimg_bd' ";
					$res_img_bd = mysqli_query($conexao, $sql_img_bd);
					$imagem_bd = ''; // Inicializa para garantir que está vazia se não encontrar
					if ($row_img_bd = mysqli_fetch_array($res_img_bd)){
						$imagem_bd = $row_img_bd['imagem'];
					}
					$foto = "../app/files-base/".$imagem_bd;
					} elseif (!empty($foto_item)) {
					// Imagem anexada (do sistema de arquivos)
					$foto = "../app/files/".$idUsuario."-".$codigoPath."/".$foto_item;
					} else {
					// Sem imagem
					$foto = "src/img/sem-img.png";
				}
				
				
				if($tipo_item == "NORMAL") {
					$tag_oferta = "";
					} else {
					$tag_oferta = "<img src='src/img/tag-desconto.png' class='tag-desconto' alt='tag'/>";
				}
				
				echo "
				<div class='item-box' onclick='window.location.href=\"item?itm=$id_item&crd=$idcardapioHash\"'>
				$tag_oferta
				<div style='background-image:url($foto);'></div>
				<span>Código:$cod_item</span>
				<h5>$titulo_item</h5>
				<h4>R$ $preco_item</h4>
				<h3 class='icone_plus'><img src='src/img/icon-plus.png' alt='icone mais' /></h3>
				</div>";
			}
			} else {
			echo "<div class='alert-aviso'>Não há promoções disponíveis.</div>";
		}
	?>
	
</section>