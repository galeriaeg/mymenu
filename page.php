<?php @$page = $_GET['p']; ?>
<html>
    <head>
		<meta charset="utf-8">
		<title>MyMenu - Cardápio Digital</title>
		<link rel="shortcut icon" href="./img/favicon1616.png" />
		<link rel="shortcut icon" href="./img/favicon3232.png" />
		<link rel="shortcut icon" href="./img/favicon6464.png" />
		<link rel="shortcut icon" href="./img/favicon9696.png" />
		<link rel="shortcut icon" href="./img/favicon128128.png" />
		<link rel="shortcut icon" href="./img/favicon180180.png" />
		<link rel="stylesheet" href="./css/reset.css"/>
		<link rel="stylesheet" href="./css/font.css"/>
		<link rel="stylesheet" href="./css/mymenu.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<!-- Link para redes -->
		<meta property="og:locale" content="pt_BR" />
		<meta property="og:type" content="website">
		<meta property="og:url" content="https://www.mymenu.app.br" />
		<meta property="og:title" content="MyMenu">
		<meta property="og:description" content="O Seu Cardápio Digital">
		<meta property="og:image" itemprop="image" content="https://www.mymenu.app.br/img/logo-id.png">
		<link itemprop="thumbnailUrl" href="https://www.mymenu.app.br/img/logo-id.png">
		<meta property="og:image:type" content="image/jpeg">
		<meta property="og:image:width" content="300">
		<meta property="og:image:height" content="300">
		<meta property="og:updated_time" content="updatedtime">
		<!-- Link para redes -->
		
	</head>
	
    <body class="body_pages">
		
		<header class="box-header col1">
			<?php require_once "src/components/topo.php"; ?>
		</header>
		
		<main class="col1 box-main">
			<?php include_once "router.php"; ?>				
			
			<footer class="col1 box-footer">
				<?php require_once "src/components/footer.php"; ?>
			</footer>
		</main>
		
	</body>
</html>