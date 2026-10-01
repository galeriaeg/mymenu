<?php include "session.php"; ?>

<script src="./js/animate.js"></script>

<?php
	
	//item

	include "checa_pagamento.php";
	
	$id_item = $_GET['item'];

	//$nomefile = $_GET["urlimg"];
	//$idUsuarioLogado = $_SESSION['id'];
	//require "config/conecta.php";
	
	if((empty($id_item))&&(empty($nomefile))){
		
		echo "<script>window.location = 'index.php?m=9'</script>";
		exit();
		
	}
	else{

		//Confirma exlusão
		$confirma = $_GET['cnf'];

		if($confirma == 'false'){

			echo "
			<div class='alerta-modal alertaModal'>
				<div><h6>Alerta</h6></div>
				<h6 class='alerta-mensagem'>Tem certeza que deseja excluir o item selecionado?</h6>
				<h6 class='alerta-btn-grupo'>
					<a href='index.php?m=52&item=$id_item&cnf=true' style='margin-right:30px' class='link-sim'>Sim</a>
					<a href='index.php?m=5' class='link-nao'>Não</a>
				</h6>
			</div>";
			exit();
			
		}
		else{

		//unlink("files/$nomefile");
		
		require_once "config/conecta.php";
		
		$sql = "DELETE FROM t_item WHERE id='$id_item'";
		$qry = mysqli_query($conexao, $sql);
		
		if($qry>0){
			echo "<div class='alert-sucess'><h6><i class='fa fa-check icon-alert' aria-hidden='true'></i> Registro excluído com sucesso!</h6></div>";
			echo "<img src='./img/barra-progresso.gif' class='barra-progresso' alt='progresso' />";
			echo "<script>setTimeout(function(){window.location='index.php?m=5';}, 2500);</script>";
			exit();
		}
		
	}	

}
	mysqli_close($conexao);	
	
?>