<?php
	include "session.php";
	
	$idUsuarioLogado = $_SESSION['id'];
	
	$idCardapio = htmlspecialchars($_POST['idCardapio']);
	$url = htmlspecialchars($_POST['url']);
	$tipo = htmlspecialchars($_POST['tipo']);
	

	if ((empty($idCardapio)) || (empty($url)) || (empty($tipo))){
	
		echo "<script>location.assign('index.php?m=9');</script>";
		exit();	
	}
	else{
		
			require_once "config/conecta.php";
			
			if($tipo=="Site"){
				$sql = "UPDATE t_links_externos SET site='$url' WHERE id_cardapio = '$idCardapio' ";
				$update = mysqli_query($conexao, $sql);
			}
			else if($tipo=="Instagram"){
				$sql = "UPDATE t_links_externos SET instagram='$url' WHERE id_cardapio = '$idCardapio' ";
				$update = mysqli_query($conexao, $sql);		
			}
			else if($tipo=="Facebook"){
				$sql = "UPDATE t_links_externos SET facebook='$url' WHERE id_cardapio = '$idCardapio' ";
				$update = mysqli_query($conexao, $sql);		
			}
			else if($tipo=="Blog"){
				$sql = "UPDATE t_links_externos SET blog='$url' WHERE id_cardapio = '$idCardapio' ";
				$update = mysqli_query($conexao, $sql);		
			}

			if($update>0){
				echo "<div class='alert-sucess'><h6><i class='fa fa-check icon-alert' aria-hidden='true'></i> Cadastro realizado com sucesso!</h6></div>";
				echo "<img src='./img/barra-progresso.gif' class='barra-progresso' alt='progresso' />";
				echo "<script>setTimeout(function(){location.assign('index.php?m=7');}, 2500);</script>";
				exit();
			}

			
	}

	mysqli_close($conexao);
?>
