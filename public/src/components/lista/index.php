<div class="header-page">
	<img src="src/img/icon-blocos.png" class="icone-seta" style="cursor:none;" /> <span>Produtos em destaque</span>
</div>


<section class="main">
	
	<?php
		
		// lista Produtos em destaque
		
		// Consulta principal para obter os itens "NORMAL" em destaque
		$sql_destaque = "SELECT i.*, c.codigo_path AS codigopath, ca.idUsuario AS id_usuario
		FROM t_item AS i
		INNER JOIN t_cardapio AS ca ON i.idCardapio = ca.id
		INNER JOIN t_customiza AS c ON c.idCardapio = i.idCardapio
		WHERE i.idCardapio = $id_cardapio
		AND i.status = 1
		AND i.tipo = 'NORMAL'";
		$res_destaque = mysqli_query($conexao, $sql_destaque);
		
		// Verifica se há resultados antes de entrar no loop
		if (mysqli_num_rows($res_destaque) > 0) {
			while ($row_destaque = mysqli_fetch_array($res_destaque)){
				$id_item        =    $row_destaque['id'];
				$cod_item        =    $row_destaque['cod_item'];
				$titulo_item    =    $row_destaque['titulo'];
				$descricao_item    =    $row_destaque['descricao'];
				$preco_item        =    $row_destaque['preco'];
				$foto_item        =    $row_destaque['foto'];
				$foto_item_bd    =    $row_destaque['foto_bd'];
				$status_item    =    $row_destaque['status'];
				$idCardapio        =    $row_destaque['idCardapio'];
				$codigoPath        =    $row_destaque['codigopath'];
				$idUsuario        =    $row_destaque['id_usuario'];
				
				$foto = ''; // **Inicializa a variável $foto para cada item**
				$imagem_bd = ''; // **Inicializa a variável $imagem_bd para cada item**
				
				// Lógica para determinar qual imagem usar
				if (!empty($foto_item_bd)) {
					// Foto do banco de imagem (t_mymenu_files)
					$partes = explode('.', $foto_item_bd);
					$categoria_bd = $partes[0];
					$idimg_bd = $partes[1];
					
					// Pega a imagem do banco para **ESTE** item
					$sql_img_bd = "SELECT imagem FROM t_mymenu_files WHERE categoria='$categoria_bd' AND id='$idimg_bd' ";
					$res_img_bd = mysqli_query($conexao, $sql_img_bd);
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
				
				echo "
				<div class='item-box' onclick='window.location.href=\"item?itm=$id_item&crd=$idcardapioHash\"'>
				<div style='background-image:url($foto);'></div>
				<span>Código:$cod_item</span>
				<h5>$titulo_item</h5>
				<h4>R$ $preco_item</h4>
				<h3 class='icone_plus'><img src='src/img/icon-plus.png' alt='icone mais' /></h3>
				</div>";
			}
			} else {
			echo "<div class='alert-aviso'>Não há produtos em destaque nesta categoria.</div>";
		}
	?>
	
</section>