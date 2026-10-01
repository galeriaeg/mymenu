<?php include "session.php"; ?>

<script src="./js/animate.js"></script>

<?php

	$idUsuarioLogado = $_SESSION['id'];
	
	$idCardapio = htmlspecialchars($_GET['c']);
	$tipo = htmlspecialchars($_GET['t']);
	
	
	if ((empty($idCardapio)) || (empty($tipo))){
	
		echo "<script>window.location='index.php?m=9';</script>";
		exit();	
	}
	else{
	
		//Confirma exlusão
		$confirma = $_GET['cnf'];

		if($confirma == 'false'){

			echo "
			<div class='alerta-modal alertaModal'>
				<div><h6>Alerta</h6></div>
				<h6 class='alerta-mensagem'>Tem certeza que deseja excluir o link selecionado?</h6>
				<h6 class='alerta-btn-grupo'>
					<a href='index.php?m=72&t=$tipo&c=$idCardapio&cnf=true' style='margin-right:30px' class='link-sim'>Sim</a>
					<a href='index.php?m=7' class='link-nao'>Não</a>
				</h6>
			</div>";
			exit();

		}
		else{
			//Exclui link;

			require_once "config/conecta.php";
			
			if($tipo=="site"){
				$sql = "UPDATE t_links_externos SET site='NULL' WHERE id_cardapio = '$idCardapio' ";
				$update = mysqli_query($conexao, $sql);
			}
			else if($tipo=="instagram"){
				$sql = "UPDATE t_links_externos SET instagram='NULL' WHERE id_cardapio = '$idCardapio' ";
				$update = mysqli_query($conexao, $sql);		
			}
			else if($tipo=="facebook"){
				$sql = "UPDATE t_links_externos SET facebook='NULL' WHERE id_cardapio = '$idCardapio' ";
				$update = mysqli_query($conexao, $sql);		
			}
			else if($tipo=="blog"){
				$sql = "UPDATE t_links_externos SET blog='NULL' WHERE id_cardapio = '$idCardapio' ";
				$update = mysqli_query($conexao, $sql);		
			}

			if($update>0){
				echo "<div class='alert-sucess'><h6><i class='fa fa-check icon-alert' aria-hidden='true'></i> Cadastro removido com sucesso!</h6></div>";
				echo "<img src='./img/barra-progresso.gif' class='barra-progresso' alt='progresso' />";
				echo "<script>setTimeout(function(){location.assign('index.php?m=7');}, 2500);</script>";
				exit();
			}

			
	}


}

	mysqli_close($conexao);
?>