<html>
    <head>
		<meta charset="utf-8">
		<title>MyMenu</title>
		<link rel="shortcut icon" href="src/img/favicon3232.png" />
		<link rel="stylesheet" href="src/css/cardapio_lista_tab.css"/>
		<link rel="stylesheet" href="src/css/cardapio_lista_mob.css"/>
		<link rel="stylesheet" href="src/css/item_tab.css"/>
		<link rel="stylesheet" href="src/css/item_mob.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta property="og:image" itemprop="image" content="https://www.zipath.net/zip-img/logo-id.jpg" />
		<link itemprop="thumbnailUrl" href="https://www.zipath.net/zip-img/logo-id.jpg" /> 
	</head>
	<body>
		
		<?php require_once "src/config/customization.php"; ?>
		
		<?php require_once "../app/config/path.php";?>
		<?php require_once $path."conecta.php"; ?>
		
		<div class="container">
			
			<?php include "src/components/topo/index.php"; ?>
			
			<?php include "src/components/menu/index.php"; ?>
			
			<main><?php include "src/components/item/index.php"; ?></main>
			
			<footer><?php include "src/components/rodape/index.php"; ?></footer>
			
		</div>
	</body>
</html>