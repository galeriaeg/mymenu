<div class="header-page">
	<img src="src/img/icon-seta.png" class="icone-seta" onclick="voltar();" /> <span>Produto</span>
</div>

<section class="main">
	
	<?php
		// detalhe do item
		
		$id_item = $_GET['itm'];
		$id_cardapio = $_GET['crd'];
		

		$sql = "SELECT i.*, c.nome AS nomeCategoria, ca.idUsuario AS idusuario, cus.codigo_path AS codigopath, cus.cor_preco AS corPreco 
		FROM t_item AS i, t_categoria AS c,  t_cardapio AS ca, t_customiza AS cus
		WHERE i.id=$id_item 
		AND i.status=1
		AND cus.idCardapio = ca.id
		AND cus.idCardapio = i.idCardapio
		AND i.idCategoria=c.id";
		$res = mysqli_query($conexao, $sql);
		$total = mysqli_num_rows($res);
		while ($row = mysqli_fetch_array($res)){
			$id_item		=	$row['id'];
			$cod_item		=	$row['cod_item'];
			$titulo_item	=	$row['titulo'];
			$descricao_item	=	$row['descricao'];
			$preco_item		=	$row['preco'];
			$foto_item		=	$row['foto'];
			$fotobd_item	=	$row['foto_bd'];
			$tipo_item		=	$row['tipo'];
			$status_item	=	$row['status'];
			$idCardapio		=	$row['idCardapio'];
			$idCategoria	=	$row['idCategoria'];
			$nomeCategoria	=	$row['nomeCategoria'];
			$idUsuario		=	$row['idusuario'];
			$codigoPath		=	$row['codigopath'];
			$corPreco 		=	$row['corPreco'];
			
			$cor_preco_paleta = "style=color:".$corPreco;

			
			if((empty($foto_item))&&(empty($fotobd_item))){
				$foto = "src/img/sem-img.png";// sem imagem
			}
			else{
			
				if(!empty($fotobd_item)){
					//echo "pega do banco";
					
					$param = explode(".", $fotobd_item);
					$categoria_bd = $param[0];
					$img_bd = $param[1];
					
					$sql = "SELECT imagem FROM t_mymenu_files WHERE id='$img_bd' AND categoria='$categoria_bd'";
					$res = mysqli_query($conexao, $sql);
					while ($row = mysqli_fetch_array($res)){
						$foto = $row['imagem'];
					}
					$foto = "../app/files-base/".$foto;
				}
				else{
					//echo "pega anexo";
					$foto = "../app/files/".$idUsuario."-".$codigoPath."/".$foto_item;
				}
				
				
			}
				
		
		
			if($tipo_item=='OFERTA'){
				$tag_oferta = "<img src='src/img/tag-desconto.png' alt='tag oferta' class='tag-oferta' />";
			}
			else{
				$tag_oferta = "";
			}
				
		}
		
		
		if($total<1){
			$idCardapioHash = base64_encode($idCardapio);
			echo "<script>window.location.href='home?crd=$idCardapioHash';</script>";
			exit();
		}
		
		
		//pega quantidade de views
		$sql = "SELECT qtde FROM t_acesso WHERE idItem=$id_item";
		$res = mysqli_query($conexao, $sql);
		$total = mysqli_num_rows($res);
		while ($row = mysqli_fetch_array($res)){
			$qtde = $row['qtde'];
		}
		//incrementa a quantidade
		if($total==0){
			$sql="INSERT INTO t_acesso (idCardapio, idItem,qtde) VALUES ('$idCardapio','$id_item', 1)";
			$conf = $conexao->query($sql)or die ($conexao->error);	
		}
		else{
			$qtde = $qtde + 1;
			$sql = "UPDATE t_acesso SET qtde='$qtde' WHERE idItem='$id_item' " ;
			$update = mysqli_query($conexao, $sql);	
		}		
	?>
	
	<?php
		$sql = "SELECT qtde FROM t_acesso WHERE idItem=$id_item";
		$res = mysqli_query($conexao, $sql);
		while ($row = mysqli_fetch_array($res)){
			$qtde =	$row['qtde'];
		}
		
		if(empty($qtde))
		$qtde = 0;
	?>
	
	
	<div class="item-box-page">
		<img src="src/img/icon-compartilha.png" class="icone-compartilha" onclick="compartilharWhatsApp()" />
		<?php echo $tag_oferta;?>
		<p class='box-views tag-categoria'><?php echo $nomeCategoria; ?></p>
		<img src="<?php echo $foto; ?>" alt="<?php echo $titulo_item; ?>" />
		<span>Código: <?php echo $cod_item; ?></span>
		<h4><?php echo $titulo_item; ?></h4>
		<h5><?php echo $descricao_item; ?></h5>
		<h4 <?php echo $cor_preco_paleta ?>>R$ <?php echo $preco_item; ?></h4>
		<div class='grupo-view'>
			<p class='box-views'><img src='src/img/icon-views.png' alt='icone view' class='icon-views' /><?php echo $qtde; ?></p>
			
		</div>
	</div>
	
</section>


<script>
    function compartilharWhatsApp() {
        // Pega a URL da página atual
        var urlPagina = window.location.href;
        
        // Pega o título da página atual
        var tituloPagina = document.title;
        
        // Cria a mensagem que será compartilhada. 
        // Codifica os componentes para que o link funcione corretamente.
        var textoCompartilhado = "Ei! Venha também aproveitar esta oportunidade: " + tituloPagina + " - " + urlPagina;
        
        // Cria o link completo para o WhatsApp
        var linkWhatsApp = "whatsapp://send?text=" + encodeURIComponent(textoCompartilhado);
        
        // Redireciona para o link do WhatsApp
        window.location.href = linkWhatsApp;
    }
    </script>


<script>	
	function voltar(){
		history.back();
	}
</script>