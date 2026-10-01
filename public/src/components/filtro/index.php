<div class="header-page">
	<img src="src/img/icon-seta.png" onclick="voltar();" class="icone-seta" /> <span id="categoria"></span>
</div>

<section class="main">

	<?php
		// filtro: lista por categoria

		$id_categoria = $_GET['cat'];
		
		//$cor_preco_paleta = "style=color:red";

		//pega path do usuario
		$sql_path = "SELECT codigo_path FROM t_customiza WHERE idCardapio=$id_cardapio";
		$res_path = mysqli_query($conexao, $sql_path);
		$codigoPath = ''; // Inicializa para evitar erros caso não encontre
		if ($row_path = mysqli_fetch_array($res_path)){
			$codigoPath = $row_path['codigo_path'];
		}


		// Pega itens da categoria e cardápio
		//$sql_items = "SELECT * FROM t_item WHERE idCategoria=$id_categoria AND idCardapio=$id_cardapio AND status=1";
		
		$sql_items = "SELECT i.*, c.cor_preco AS corPreco
		FROM t_item AS i,t_customiza AS c
		WHERE i.idCategoria=$id_categoria 
		AND i.idCardapio=$id_cardapio 
        AND c.idCardapio = i.idCardapio
		AND i.status=1";
		$res_items = mysqli_query($conexao, $sql_items);
		$total = mysqli_num_rows($res_items);

		while ($row_item = mysqli_fetch_array($res_items)){
			$id_item		=	$row_item['id'];
			$cod_item		=	$row_item['cod_item'];
			$titulo_item	=	$row_item['titulo'];
			$descricao_item	=	$row_item['descricao'];
			$preco_item		=	$row_item['preco'];
			$foto_item		=	$row_item['foto'];
			$foto_item_bd	=	$row_item['foto_bd'];
			$tipo_item		=	$row_item['tipo'];
			$status_item	=	$row_item['status'];
			$idCardapio		=	$row_item['idCardapio'];
			$idCategoria	=	$row_item['idCategoria'];
			$corPreco =	$row_item['corPreco'];
			
			$cor_preco_paleta = "style=color:".$corPreco;
			
			$imagem_bd = ''; // Reset $imagem_bd para cada item

			if((empty($foto_item)) && (empty($foto_item_bd))){
				///sem imagem
				$foto = "src/img/sem-img.png";
			}
			else{
				if(!empty($foto_item_bd)){
					//foto do banco de imagem
					$partes = explode('.', $foto_item_bd);
					$categoria_bd = $partes[0];
					$idimg_bd = $partes[1];

					// Pega imagem do banco de dados para ESTE item
					$sql_img_bd = "SELECT imagem FROM t_mymenu_files WHERE categoria='$categoria_bd' AND id='$idimg_bd' ";
					$res_img_bd = mysqli_query($conexao, $sql_img_bd);
					if ($row_img_bd = mysqli_fetch_array($res_img_bd)){
						$imagem_bd = $row_img_bd['imagem'];
					}
					$foto = "../app/files-base/".$imagem_bd;
				}
				else{
					//imagem anexada
					// Verifique se $idUsuario e $idcardapioHash estão definidos antes de usar
					// Assumi que $idUsuario está definido em outro lugar, caso contrário, precisará obtê-lo.
					$foto = "../app/files/".$idUsuario."-".$codigoPath."/".$foto_item;
				}
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
				<h4 $cor_preco_paleta>R$ $preco_item</h4>
				<h3 class='icone_plus'><img src='src/img/icon-plus.png' alt='icone mais' /></h3>
			</div>";
		}

		if(empty($total)) {
			echo "<div class='alert-aviso'>Não há produtos nesta categoria.</div>";
		}
	?>

</section>



<?php
	// Esta parte do código para pegar o nome da categoria pode ficar aqui no final, pois é para o título da página
	$sql_cat_name = "SELECT nome FROM t_categoria WHERE id=$id_categoria AND status=1";
	$res_cat_name = mysqli_query($conexao, $sql_cat_name);
	$nome_categoria = ''; // Inicializa para evitar erros
	if ($row_cat_name = mysqli_fetch_array($res_cat_name)){
		$nome_categoria	=	$row_cat_name['nome'];
	}
?>

<script>
	document.getElementById('categoria').innerHTML="<?php echo $nome_categoria; ?>";
	function voltar(){
		history.back();
	}
</script>