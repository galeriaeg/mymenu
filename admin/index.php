<?php include_once "session.php"; ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Admin MyMenu</title>
		<link rel="stylesheet" href="./css/adm.css"/>
		<script src="./js/alerta.js"></script>
		<link rel="shortcut icon" href="./img/favicon1616.png" />
		<link rel="shortcut icon" href="./img/favicon3232.png" />
		<link rel="shortcut icon" href="./img/favicon6464.png" />
		<link rel="shortcut icon" href="./img/favicon9696.png" />
		<link rel="shortcut icon" href="./img/favicon128128.png" />
		<link rel="shortcut icon" href="./img/favicon180180.png" />		
	</head>
	
	<body>
		
		<header><?php include_once "src/components/topo.php"; ?></header>
		
		
		<main>
			
			<h3>Gerenciador de banco de imagens</h3>
			<h4>Cadastrar categoria</h4>
			
			<form action="index.php?c=1" method="POST">
				<input name="categoria" type="text" />
				<input type="submit" value="CADASTRAR" />
			</form>
			
			<hr/>
			
			<table border="1">
				<tr>
					<th>ID</th>
					<th>Categoria</th>
					<th>Action</th>
				</tr>
				<?php
					require_once "../app/config/conecta.php";
					
					$sql = "SELECT * FROM t_mymenu_categoria";
					$res = mysqli_query($conexao, $sql);
					while ($row = mysqli_fetch_array($res)){
						$id_categoria		=	$row['id'];
						$nome_categoria	=	$row['nome'];
						
						echo "<tr><td>$id_categoria</td>";
						echo "<td>$nome_categoria</td>";
						echo "<td><a href='#'>Excluir</a></td></tr>";
					}
				?>
			</table>
			
			
			<?php
				
				@$confirma = $_GET['c'];
				
				if($confirma>0){
					
					$categoria = $_POST['categoria'];
					
					if(empty($categoria)){
						echo "<script>escondeAlerta();</script>";
						echo "<p class='alerta-erro' id='alertaModal'>Erro! Informe o nome da categoria</p>";
						exit();
					}
					else{
						$sql="INSERT INTO t_mymenu_categoria(nome)VALUES('$categoria')";
						$conf = $conexao->query($sql)or die ($conexao->error);
						if($conf){
							echo "<script>alert('Sucesso!')</script>";
							echo "<script>window.location.href='index.php'</script>";
						}
					}
				}
			?>
			
			
		</main>
		
		
	</body>
</html>
