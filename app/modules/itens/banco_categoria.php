<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>MyMenu</title>
		<link rel="stylesheet" href="../../css/font.css"/>
		<link rel="stylesheet" href="./css/mymenu_banco_imagens.css"/>
	</head>
	
	<body>
		<h6>Buscar imagem:</h6>
		<?php

			include "../../checa_pagamento.php";
			
			$idUsuarioLogado = $_SESSION['id'];
			
			if(empty($idUsuarioLogado)){
				
				echo "<script>location.assign('index.php?m=9');</script>";
				exit();
				
			}
			else{
				@$categoria = $_GET['cat'];
				
				
				echo "<script>function selectItem(){
				document.getElementById('formCategoria').submit();
				}</script>";
				
				
				echo "<form action='banco_itens.php' method='POST' id='formCategoria' name='formCategoria'>
				<select name='categoria' onchange='selectItem()' style='padding:8px;width:310px'>
				<option selected disabled>Selecione uma categoria</option>";
				
				require "../../config/conecta.php";
				$sql = "SELECT * FROM t_mymenu_categoria";
				$res = mysqli_query($conexao, $sql);
				while ($row = mysqli_fetch_array($res)){
					$id_categoria	=	$row['id'];
					$nome_categoria	=	$row['nome'];
					echo "<option value='$id_categoria'>$nome_categoria</option>";
				}				
				echo "</select></form>";		
				
			}
			
			
		?>	


	</body>
</html>






