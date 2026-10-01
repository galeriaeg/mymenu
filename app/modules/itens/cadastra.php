<?php
	include "session.php";
	
	$idUsuarioLogado = $_SESSION['id'];
	
	$codigo = htmlspecialchars($_POST['codigo']);
	$titulo = htmlspecialchars($_POST['titulo']);
	$descricao = htmlspecialchars($_POST['descricao']);
	$categoria = htmlspecialchars($_POST['categoria']);
	$preco = htmlspecialchars($_POST['preco']);
	$arquivo = basename($_FILES['arquivo']['name']);
	$promocao = htmlspecialchars($_POST['promocao']);
	
	
	if($promocao==1)
		$tipo_label = 'OFERTA';
	else
		$tipo_label = 'NORMAL';
	
	
	if(
	(empty($codigo))||
	(empty($titulo))||
	(empty($descricao))||
	(empty($categoria))||
	(empty($preco))
	){
		
		echo "<script>location.assign('index.php?m=9');</script>";
		exit();
		
	}
	else{
	
		
		if (empty($arquivo)){
			$id_arquivo_bd = htmlspecialchars($_POST['id_file_base']);
			if(empty($id_arquivo_bd)){
				echo "<script>alert('É necessário anexar uma imagem.');</script>";
				echo "<script>history.back();</script>";
				exit();
			}
		}
		
		require_once "config/conecta.php";
		
		//pega codigo_path
		$sql = "SELECT idCardapio,codigo_path FROM t_customiza WHERE idUsuario = '$idUsuarioLogado' ";
		$res = mysqli_query($conexao, $sql);
		$totalPath = mysqli_num_rows($res);
		while ($row = mysqli_fetch_array($res)){
			$idCardapio	=	$row['idCardapio'];
			$codigo_path	=	$row['codigo_path'];
		}
		
		
		// Verifica se Código já exite na base
		$sql = "SELECT id FROM t_item WHERE cod_item = '$codigo' AND idCardapio='$idCardapio' ";
		$res = mysqli_query($conexao, $sql);
		$totalItem = mysqli_num_rows($res);
		if($totalItem>0){
			echo "<script>alert('Erro! O código informado já exite.');</script>";
			echo "<script>location.assign('index.php?m=5');</script>";
			exit();		
		}

		
		
		if (!empty($arquivo)){
			
			// define novo nome do arquivo
			$rand_file = rand(100001,999999);
			$arquivo = $rand_file."-".$arquivo;
			
			// define caminho do upload
			$name_path = $idUsuarioLogado."-".$codigo_path;
			$uploaddir = 'files/'.$name_path."/";
			$uploadfile = $uploaddir.$arquivo;	
			
			if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile)){
				$sql="INSERT INTO t_item(cod_item,titulo,descricao,preco,foto,foto_bd,tipo,status,idCardapio,idCategoria)
				VALUES('$codigo','$titulo','$descricao','$preco','$arquivo','','$tipo_label',1,'$idCardapio','$categoria')";
				$conf1 = $conexao->query($sql)or die ($conexao->error);
				//$ultimoIdCardapio = $conexao->insert_id;
			}
		
		}
		else{
				$sql="INSERT INTO t_item(cod_item,titulo,descricao,preco,foto,foto_bd,tipo,status,idCardapio,idCategoria)
				VALUES('$codigo','$titulo','$descricao','$preco','','$id_arquivo_bd','$tipo_label',1,'$idCardapio','$categoria')";
				$conf2 = $conexao->query($sql)or die ($conexao->error);
		}
		
		
		if(($conf1>0)||( $conf2>0)){
			echo "<div class='alert-sucess'><h6><i class='fa fa-check icon-alert' aria-hidden='true'></i> Cadastro realizado com sucesso!</h6></div>";
			echo "<img src='./img/barra-progresso.gif' class='barra-progresso' alt='progresso' />";
			echo "<script>setTimeout(function(){window.location='index.php?m=5';}, 2500);</script>";
			exit();
		}
		else{
			echo "Ops! Algo deu errado. Informe ao adminitrador do sistema";
		}
	
		
		
		
		
	}
	
	
?>