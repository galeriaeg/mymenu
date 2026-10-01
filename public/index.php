<html>
    <head>
		<meta charset="utf-8">
		<title>MyMenu</title>
		<link rel="shortcut icon" href="src/img/favicon1616.png" />
		<link rel="shortcut icon" href="src/img/favicon3232.png" />
		<link rel="shortcut icon" href="src/img/favicon6464.png" />
		<link rel="shortcut icon" href="src/img/favicon9696.png" />
		<link rel="shortcut icon" href="src/img/favicon128128.png" />
		<link rel="shortcut icon" href="src/img/favicon180180.png" />
		<link rel="stylesheet" href="src/css/cardapio_lista_tab.css"/>
		<link rel="stylesheet" href="src/css/cardapio_lista_mob.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	</head>
    <body>
		
		<?php require_once "src/config/customization.php"; ?>
		
		<?php require_once "../app/config/path.php";?>
		<?php require_once $path."conecta.php"; ?>
		
		<div class="container">
			
			<?php include "src/components/topo/index.php"; ?>
			
			<?php include "src/components/menu/index.php"; ?>
			
			<main>
				<?php 
					// $idcardapio capturado em customization.php
					$sql = "SELECT * FROM t_item WHERE idCardapio=$idcardapio AND tipo='OFERTA'";
					$res = mysqli_query($conexao, $sql);
					$total = mysqli_num_rows($res);
					
					if($total>0)
						include "src/components/promocoes/index.php"; 
				?>
				<?php include "src/components/lista/index.php"; ?>
			</main>
			
			<footer><?php include "src/components/rodape/index.php"; ?></footer>
			
		</div>
	</body>
</html>