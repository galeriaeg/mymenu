<?php
	include "session.php";
	
	$nome		 = htmlspecialchars($_POST['nome']);
	$idCardapio  = htmlspecialchars($_POST['idCardapio']);
	@$idCategoria = htmlspecialchars($_POST['idCategoria']);
	
	
	require_once "config/conecta.php";
	
	// edita
	if(!empty($idCategoria)){
		
		$sql = "UPDATE t_categoria 
		SET nome='$nome' WHERE id = '$idCategoria' AND idCardapio = '$idCardapio' ";
		$update = mysqli_query($conexao, $sql);
		if($update){
			echo "<div class='alert-sucess'><h6><i class='fa fa-check icon-alert' aria-hidden='true'></i> Cadastro realizado com  sucesso!</h6></div>";
			echo "<img src='./img/barra-progresso.gif' class='barra-progresso' alt='progresso' />";
			echo "<script>setTimeout(function(){location.assign('index.php?m=4');}, 2500);</script>";
			exit();
		}
	}
	
	
	//cadastra
	if(empty($idCardapio)){
		echo "<div class='alert-notification'>
		<h6>
		<i class='fa fa-exclamation-circle icon-alert' aria-hidden='true'></i> 
		Antes de cadastrar categorias você deve <a href='index.php?m=3'>criar seu Cardápio</a>
		</h6>
		</div>";
		exit();
	}
	elseif(empty($nome)){
		echo "<script>location.assign('index.php?m=9');</script>";
		exit();
	}
	else{
		
		$sql="INSERT INTO t_categoria(nome,status,idCardapio)VALUES('$nome',1,'$idCardapio')";
		$conf = $conexao->query($sql)or die ($conexao->error);
		
		if($conf){
			echo "<div class='alert-sucess'><h6><i class='fa fa-check icon-alert' aria-hidden='true'></i> Cadastro realizado com  sucesso!</h6></div>";
			echo "<img src='./img/barra-progresso.gif' class='barra-progresso' alt='progresso' />";
			echo "<script>setTimeout(function(){location.assign('index.php?m=4');}, 2500);</script>";
		}
	}
	
	mysqli_close($conexao);
?>
