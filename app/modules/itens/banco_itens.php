<?php
	include "../../checa_pagamento.php";
	$idUsuarioLogado = $_SESSION['id'];
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>MyMenu</title>
		<link rel="stylesheet" href="../../css/font.css"/>
		<link rel="stylesheet" href="./css/mymenu_banco_imagens.css"/>
		<script src="./js/mymenu_add_imagem.js"></script>
	</head>
	
	<body>
		
		<!-- div class="container-scroll" -->	
		
		<?php
			if(empty($idUsuarioLogado)){
				
				echo "<script>location.assign('index.php?m=9');</script>";
				exit();
				
			}
			else{
				
				@$categoria = $_POST['categoria'];
				
				if(!empty($categoria)){
					
					$sql = "SELECT * FROM t_mymenu_categoria WHERE id = '$categoria' ";
					$res = mysqli_query($conexao, $sql);
					while ($row = mysqli_fetch_array($res)){
						$id_categoria	=	$row['id'];
						$nome_categoria	=	$row['nome'];
					}
					
					echo "<img src='../../img/icon-seta.png' onclick='window.location.href=\"banco_categoria.php\";' class='icon-seta-voltar' alt='seta' /><h6>$nome_categoria</h6>";
					
					require "../../config/conecta.php";
					
					$sql = "SELECT * FROM t_mymenu_files WHERE categoria = '$categoria' ";
					$res = mysqli_query($conexao, $sql);
					while ($row = mysqli_fetch_array($res)){
						$id_file		=	$row['id'];
						$img_file		=	$row['imagem'];
						$categoria_file	=	$row['categoria'];
						
						
						// forma nome do produto
						$stringOriginal = $img_file;
						$posicaoPrimeiroHifen = strpos($stringOriginal, '-');
						$posicaoUltimoPonto = strrpos($stringOriginal, '.');
						$comprimento = $posicaoUltimoPonto - $posicaoPrimeiroHifen - 1;
						$nome_file = substr($stringOriginal, $posicaoPrimeiroHifen + 1, $comprimento);
						
						
						$itemid ='item'.$id_file;
						
						echo "
						<div class='card-imagem-base'>
						<img src='../../files-base/$img_file' alt='imagem' />
						<span>Cód: <span id='$itemid'>$id_file</span>
						<br />$nome_file<br />
						<img src='../../img/btn-add.png' alt='botao add foto' onclick='enviarID($categoria_file,$id_file);' />
						</span>
						</div>";
					}
				}
				else{
					echo "Erro 404";
					exit();
				}
				
				
			}
		?>
		
		<!-- /div-->
		
		<script>
			function enviarID(c,p) {
				//let id_prod = p;
				let dadosParaEnviar = c+'.'+p;
				window.parent.postMessage(dadosParaEnviar, '*');
				//alert(dadosParaEnviar);
			}
		</script>		
		
	</body>
</html>
