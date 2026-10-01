<?php
	include "session.php";
	
	$idUsuarioLogado = $_SESSION['id'];
	
	$nomeCardapio = htmlspecialchars($_POST['nome']);
	$arquivo = basename($_FILES['arquivo']['name']);
	$idCardapio = htmlspecialchars($_POST['idCardapio']);
	$anexoInput = htmlspecialchars($_POST['anexoInput']);
	
	
	if(empty($nomeCardapio)) {
		
		echo "<script>location.assign('index.php?m=9');</script>";
		exit();
		
	}
	else{
		
		require_once "config/conecta.php";
		
		//se update so do Titulo
		if(!empty($anexoInput)){
		
			//echo "update do Titulo";
			
			$sql = "UPDATE t_cardapio SET titulo='$nomeCardapio' WHERE idUsuario = '$idUsuarioLogado' ";
			$update = mysqli_query($conexao, $sql);
			
			if($update>0){
				echo "<div class='alert-sucess'><h6><i class='fa fa-check icon-alert' aria-hidden='true'></i> Cadastro alterado com sucesso!</h6></div>";
				echo "<img src='./img/barra-progresso.gif' class='barra-progresso' alt='progresso' />";
				echo "<script>setTimeout(function(){location.assign('index.php?m=3');}, 2500);</script>";
				exit();
			}
			
		}
		else{
			
			
			if( (empty($arquivo)) && (empty($anexoInput)) ){
				echo "<div class='alert-error'><h6><i class='fa fa-exclamation-triangle icon-alert' aria-hidden='true'></i> Erro! Faça o upload da sua Logomarca.</h6></div>";
				echo "<h6 class='link-back'> <a href='index.php?m=3'><span>&#8249;</span> Voltar</a></h6>";
				exit();
			}
			
			
			
			//testa tamanho da imagem
			$tamanhoArquivo = getimagesize($_FILES['arquivo']['tmp_name']);
			if ($tamanhoArquivo) {
			  $largura	=	$tamanhoArquivo[0];
			  $altura	=	$tamanhoArquivo[1];
			  $tipo	=	$tamanhoArquivo[2];
			  
			  if($largura != $altura){
				echo "<div class='alert-error'><h6><i class='fa fa-exclamation-triangle icon-alert' aria-hidden='true'></i>&nbsp;&nbsp;Erro! A imagem deve ter a proporção 1:1. Use <strong>200px</strong> de largura por <strong>200px</strong> de altura.</h6></div>";
				echo "<h6 class='link-back'> <a href='index.php?m=3'><span>&#8249;</span> Voltar</a></h6>";
				exit();	  
			  }
			}			
			
			
			// valida extensão do arquivo
			$extension = pathinfo($arquivo, PATHINFO_EXTENSION);
			if(($extension<>"jpg")and($extension<>"gif")and($extension<>"png")and($extension<>"jpeg")){
				echo"<script>
				alert('Erro! Permitido somente arquivos dos tipos .JPEG,.JPG,.PNG e .GIF!');
				history.go(-1);
				</script>";
				exit();
			}
			
			
			//pega codigo_path
			$sql = "SELECT codigo_path FROM t_customiza WHERE idUsuario = '$idUsuarioLogado' ";
			$res = mysqli_query($conexao, $sql);
			$totalPath = mysqli_num_rows($res);
			while ($row = mysqli_fetch_array($res)){
				$codigo_path	=	$row['codigo_path'];
			}
			
			// gerar nome do arquivo
			$rand = rand();
			$arquivo = $rand."-".$arquivo;
			$uploaddir = 'files/'.$idUsuarioLogado.'-'.$codigo_path."/";
			$uploadfile = $uploaddir.$arquivo;
			
			
			if(empty($anexoInput)){
				
				
				if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile)) {
					
					//echo " update Titulo e Anexo";
					
					$sql = "UPDATE t_cardapio SET titulo='$nomeCardapio', logo='$arquivo' WHERE idUsuario = '$idUsuarioLogado' ";
					$update = mysqli_query($conexao, $sql);
					if($update>0){
						echo "<div class='alert-sucess'><h6><i class='fa fa-check icon-alert' aria-hidden='true'></i> Registro alterado com sucesso!</h6></div>";
						echo "<img src='./img/barra-progresso.gif' class='barra-progresso' alt='progresso' />";
						echo "<script>setTimeout(function(){location.assign('index.php?m=3');}, 2500);</script>";
						exit();
					}
				}
				
				
			}
			if($idCardapio<1){
			
				
				//Gerar codigo path
				$codigo_path = rand(100001,999999);
				$name_path = $idUsuarioLogado."-".$codigo_path;
				//cria pasta do usuario
				mkdir("files/".$name_path);
				//define diretorio da imagem
				$uploaddir = 'files/'.$name_path."/";
				$uploadfile = $uploaddir.$arquivo;	
				//exit();
				
				if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile)) {
					

					// cria cardapio
					$sql="INSERT INTO t_cardapio(titulo,logo,link,link_hash,status,idUsuario)
					VALUES('$nomeCardapio','$arquivo','$link','$linkHash',1,'$idUsuarioLogado')";
					$conf = $conexao->query($sql)or die ($conexao->error);
					$ultimoIdCardapio = $conexao->insert_id;
					
					// cria links externos
					$sql="INSERT INTO t_links_externos(site,instagram,facebook,blog,id_cardapio)
					VALUES('NULL','NULL','NULL','NULL','$ultimoIdCardapio')";
					$conf = $conexao->query($sql)or die ($conexao->error);
					
					
					if($conf>0){
						
						//define link hash do cardapio
						$linkHash = base64_encode($ultimoIdCardapio);
						$link = "home?crd=".$linkHash;
						
						// adiciona link hash do cardapio
						$sql = "UPDATE t_cardapio SET link='$link', link_hash='$linkHash' WHERE idUsuario = '$idUsuarioLogado' ";
						$update = mysqli_query($conexao, $sql);
						
						// customiza  cardapio
						$sql="INSERT INTO t_customiza(
						idUsuario,
						idCardapio,
						cor_botao,
						cor_texto_botao, 
						cor_barra_botao, 
						cor_topo, 
						cor_texto_topo,
						cor_preco,
						parametro_destaque,
						codigo_path,
						tipo
						)
						VALUES(
						$idUsuarioLogado,
						$ultimoIdCardapio,
						'#E5E7EA',
						'#666666',
						'#d3d7db',
						'#CBD0D5',
						'#333333',
						'#333333',
						0,
						'$codigo_path',
						2
						)";
						$conf = $conexao->query($sql)or die ($conexao->error);
						//$ultimoIdCardapio = $conexao->insert_id;
						
						if($conf>0){
							echo "<div class='alert-sucess'><h6><i class='fa fa-check icon-alert' aria-hidden='true'></i> Cadastro realizado com  sucesso!</h6></div>";
							echo "<img src='./img/barra-progresso.gif' class='barra-progresso' alt='progresso' />";
							echo "<script>setTimeout(function(){location.assign('index.php?m=3');}, 2500);</script>";
						}
					}
					
				}
				
				
			}
			
			
		}
		
		
		
		
		
		
		
		
		
		
		
	}
	
	mysqli_close($conexao);
?>
