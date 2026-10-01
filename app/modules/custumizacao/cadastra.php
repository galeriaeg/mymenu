<?php
	include "session.php";
	
	$idUsuarioLogado = $_SESSION['id'];
	
	$id_cardapio = htmlspecialchars($_POST['id_cardapio']);
	$id_customiza = htmlspecialchars($_POST['idCustomiza']);
	$fleg_cor = htmlspecialchars($_POST['flegCor']);
	$corpaleta = htmlspecialchars($_POST['cor']);
	$corhexa = htmlspecialchars($_POST['corhexa']);
	
	


	if(($id_cardapio<1) || ($id_customiza<1) || ($fleg_cor<1)){
		echo "<script>location.assign('index.php?m=9');</script>";
		exit();	
	}
	else{
		
		if((!empty($corpaleta)) && (!empty($corhexa)))
			$cor = $corhexa; // prioriza hexa
		else
			$cor = $corpaleta;
		
		
		require_once "config/conecta.php";
		
		if($fleg_cor==1){
			$sql = "UPDATE t_customiza SET cor_topo ='$cor' WHERE id = '$id_customiza' ";
			$update = mysqli_query($conexao, $sql);			
		}
		elseif($fleg_cor==2){
			$sql = "UPDATE t_customiza SET cor_texto_topo ='$cor' WHERE id = '$id_customiza' ";
			$update = mysqli_query($conexao, $sql);	
		}
		elseif($fleg_cor==3){
			$sql = "UPDATE t_customiza SET cor_barra_botao ='$cor' WHERE id = '$id_customiza' ";
			$update = mysqli_query($conexao, $sql);		
		}	
		elseif($fleg_cor==4){
			$sql = "UPDATE t_customiza SET cor_botao ='$cor' WHERE id = '$id_customiza' ";
			$update = mysqli_query($conexao, $sql);			
		}		
		elseif($fleg_cor==5){
			$sql = "UPDATE t_customiza SET cor_texto_botao ='$cor' WHERE id = '$id_customiza' ";
			$update = mysqli_query($conexao, $sql);			
		}
		else{
			$sql = "UPDATE t_customiza SET cor_preco ='$cor' WHERE id = '$id_customiza' ";
			$update = mysqli_query($conexao, $sql);			
		}	
		
		if($update>0){
			echo "<div class='alert-sucess'><h6><i class='fa fa-check icon-alert' aria-hidden='true'></i> Registro alterado com sucesso!</h6></div>";
			echo "<img src='./img/barra-progresso.gif' class='barra-progresso' alt='progresso' />";
			echo "<script>setTimeout(function(){window.location='index.php?m=6'}, 2500);</script>";
			exit();
		}
		
	}
	mysqli_close($conexao);
?>
