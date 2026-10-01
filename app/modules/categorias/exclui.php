<?php include "session.php"; ?>

<script src="./js/animate.js"></script>

<?php
	$idCategoria = htmlspecialchars($_GET['idc']);

	
	if(empty($idCategoria)){
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
				<h6 class='alerta-mensagem'>Tem certeza que deseja excluir a categoria selecionada?</h6>
				<h6 class='alerta-btn-grupo'>
					<a href='index.php?m=42&idc=$idCategoria&cnf=true' style='margin-right:30px' class='link-sim'>Sim</a>
					<a href='index.php?m=4' class='link-nao'>Não</a>
				</h6>
			</div>";
			exit();
		}
		else{

			require_once "config/conecta.php";
			
			$sql = "DELETE FROM t_categoria WHERE id='$idCategoria'";
			$res = mysqli_query($conexao,$sql);
			
			if($res){
				echo "<div class='alert-sucess'><h6><i class='fa fa-check icon-alert' aria-hidden='true'></i> Registro excluído com sucesso!</h6></div>";
				echo "<img src='./img/barra-progresso.gif' class='barra-progresso' alt='progresso' />";
				echo "<script>setTimeout(function(){window.location='index.php?m=4'}, 2500);</script>";
			}
			else{
				echo "Algo deu errado, tente novamente!";
			}
	}


	}
	
	mysqli_close($conexao);
?>