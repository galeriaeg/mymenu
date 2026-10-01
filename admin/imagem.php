<?php include_once "session.php"; ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Admin MyMenu</title>
		<link rel="stylesheet" href="./css/adm.css"/>
		<script src="./js/alerta.js"></script>
		<script src="./js/filtraCategoria.js"></script>
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
			<h4>Cadastrar imagem</h4>
			
			<form action="imagem.php?c=1" enctype="multipart/form-data" method="POST">
				<input name="arquivo" type="file" />
				<select name="categoria">
					<option value='' required>Selecione</option>
					<?php
						require_once "../app/config/conecta.php";
						
						$sql = "SELECT * FROM t_mymenu_categoria";
						$res = mysqli_query($conexao, $sql);
						while ($row = mysqli_fetch_array($res)){
							$id	=	$row['id'];
							$nome	=	$row['nome'];
							
							echo "<option value='$id'>$nome</option>";
						}
					?>
				</select>
				<input type="submit" value="CADASTRAR" />
			</form>
			
			
			<hr/>
			
			
			<select name="filtro_categoria" id="filtroCategoria">
				<option value='' selected disabled required>Filtrar</option>
				<?php
					require_once "../app/config/conecta.php";
					
					$sql = "SELECT * FROM t_mymenu_categoria";
					$res = mysqli_query($conexao, $sql);
					while ($row = mysqli_fetch_array($res)){
						$id	=	$row['id'];
						$nome	=	$row['nome'];
						
						echo "<option value='$id'>$nome</option>";
					}
				?>
			</select>
			<input type="submit" onclick="filtraCategoria();" value="BUSCAR" />
			
			<table border="1">
				<tr>
					<th>ID</th>
					<th>Imagem</th>
					<th>Nome</th>
					<th>Categoria</th>
					<th>Action</th>
				</tr>
				<?php
					@$categoria = $_GET['ctg'];
					
					if(!empty($categoria)){
						//echo "pegou por categoria";
						
						$sql = "SELECT * FROM t_mymenu_files WHERE categoria=$categoria ";
						$res = mysqli_query($conexao, $sql);
						while ($row = mysqli_fetch_array($res)){
							$id	=	$row['id'];
							$imagem	=	$row['imagem'];
							$categoria	=	$row['categoria'];
											
							// forma nome do produto
							$stringOriginal = $imagem;
							$posicaoPrimeiroHifen = strpos($stringOriginal, '-');
							$posicaoUltimoPonto = strrpos($stringOriginal, '.');
							$comprimento = $posicaoUltimoPonto - $posicaoPrimeiroHifen - 1;
							$nome = substr($stringOriginal, $posicaoPrimeiroHifen + 1, $comprimento);
							
							echo "<tr><td>$id</td>";
							echo "<td><a href='../app/files-base/$imagem' target='_blank'><img src='../app/files-base/$imagem' width='80' alt='img-$id'/></a></td>";
							echo "<td>$nome</td>";
							echo "<td>$categoria</td>";
							echo "<td><a href='#'>Excluir</a></td></tr>";
						}
						
						
					}
					else{
						//echo "lista tudo";
						
						$sql = "SELECT * FROM t_mymenu_files";
						$res = mysqli_query($conexao, $sql);
						while ($row = mysqli_fetch_array($res)){
							$id	=	$row['id'];
							$imagem	=	$row['imagem'];
							$categoria	=	$row['categoria'];
							
							// forma nome do produto
							$stringOriginal = $imagem;
							$posicaoPrimeiroHifen = strpos($stringOriginal, '-');
							$posicaoUltimoPonto = strrpos($stringOriginal, '.');
							$comprimento = $posicaoUltimoPonto - $posicaoPrimeiroHifen - 1;
							$nome = substr($stringOriginal, $posicaoPrimeiroHifen + 1, $comprimento);
							
							echo "<tr><td>$id</td>";
							echo "<td><a href='../app/files-base/$imagem' target='_blank'><img src='../app/files-base/$imagem' width='80' alt='img-$id'/></a></td>";
							echo "<td>$nome</td>";
							echo "<td>$categoria</td>";
							echo "<td><a href='#'>Excluir</a></td></tr>";
						}
						
					}
				?>
			</table>
			
			<?php
				
				@$conf = $_GET['c'];
				
				if($conf>0){
					
					$arquivo = basename($_FILES['arquivo']['name']);
					$categoria = $_POST['categoria'];
					$rand = rand(100001,999999);
					$arquivo = $rand.'-'.$arquivo;
					$uploadfile = "../app/files-base/".$arquivo;
					
					if((empty($arquivo)) || (empty($categoria))){
						echo "<script>escondeAlerta();</script>";
						echo "<p class='alerta-erro' id='alertaModal'>Erro! Informe o anexo e a categoria!</p>";
						exit();
					}
					
					//upload
					if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile)) {
						
						$sql="INSERT INTO t_mymenu_files (imagem,categoria)VALUES('$arquivo','$categoria')";
						$res = $conexao->query($sql)or die ($conexao->error);
						
						if($res){
							echo "<script>alert('Sucesso!')</script>";
							echo "<script>window.location.href='imagem.php'</script>";
						}
					}				
					
				}
			?>		
		</main>
		
		
	</body>
</html>
