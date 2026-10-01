<?php 
	include "session.php";
	include "router.php"; 
?>
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
			<link rel="stylesheet" href="./css/font.css"/>
			<link rel="stylesheet" href="./css/desk.css"/>
			<link rel="stylesheet" href="./css/mob.css"/>
			<link rel="stylesheet" href="./css/animate.css"/>
			<meta name="viewport" content="width=device-width, initial-scale=1.0" />
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.css" integrity="sha512-72McA95q/YhjwmWFMGe8RI3aZIMCTJWPBbV8iQY3jy1z9+bi6+jHnERuNrDPo/WGYEzzNs4WdHNyyEr/yXJ9pA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		</head>
		
  	<body>	
	
		
		<header>
			<?php include_once "i_topo.php"; ?>
		</header>
		
		<main>
			<!-- checa pagamento na index de cada modulos -->
			<?php echo cont();?>
		</main>
		
		
		<footer>
			<!-- MyMenu - 2025
			Todos os direitos reservados -->
		</footer>
	</body>
</html>