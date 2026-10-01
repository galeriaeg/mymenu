<?php include "session.php"; ?>

<script src="./js/animate.js"></script>

<?php
	
	$cod_cardapio = htmlspecialchars($_GET['c']);
	$codigo_path = htmlspecialchars($_GET['pth']);
	
	$idUsuarioLogado = $_SESSION['id'];
	
	if((empty($cod_cardapio))||(empty($codigo_path))){

		echo "<script>window.location=index.php?m=9';</script>";
		exit();

	}
	else{

		//verifica se cardapio existe
		require_once "config/conecta.php";
		$sql = "SELECT id,logo FROM t_cardapio WHERE id = $cod_cardapio LIMIT 1";
		$res = mysqli_query($conexao, $sql);
		$total = mysqli_num_rows($res);
		while ($row = mysqli_fetch_array($res)){
			$id		=	$row['id'];
			$logo	=	$row['logo'];
		}

	}


	
	if($total<1){
		echo "<script>window.location=index.php?m=9';</script>";
		exit();
	}
	else{
			
		$confirma = htmlspecialchars($_GET['cnf']);

		if($confirma == 'false'){

			//Confirma exlusão
			echo "
			<div class='alerta-modal alertaModal'>
				<div><h6>Alerta</h6></div>
				<h6 class='alerta-mensagem'>Esta ação irá <strong>excluir todas as informações</strong> relacionadas ao seu cardápio, como: categorias, itens, links e etc... Deseja continuar?</h6>
				<h6 class='alerta-btn-grupo'>
					<a href='index.php?m=33&c=$cod_cardapio&pth=$codigo_path&cnf=true' style='margin-right:30px' class='link-sim'>Sim</a>
					<a href='index.php?m=3' class='link-nao'>Não</a>
				</h6>
			</div>";
			exit();
			
		}
		else{

			//Este bloco exclui o cardapio

			$uploadpath = 'files/'.$idUsuarioLogado."-".$codigo_path;
			
			$sql = "DELETE FROM t_links_externos WHERE id_cardapio = '$cod_cardapio' ";
			$qry1 = mysqli_query($conexao, $sql);
			
			if($qry1>0){
				$sql = "DELETE FROM t_item WHERE idCardapio='$cod_cardapio' ";
				$qry2 = mysqli_query($conexao, $sql);	
				unlink($uploadpath."/$logo"); // exclui arquivo
				rmdir("files/".$idUsuarioLogado."-".$codigo_path); //exclui diretorio
				
				if($qry2>0){
					$sql = "DELETE FROM t_categoria WHERE idCardapio='$cod_cardapio' ";
					$qry3 = mysqli_query($conexao, $sql);
				}
				
				if($qry3>0){
					$sql = "DELETE FROM t_customiza WHERE idCardapio='$cod_cardapio' ";
					$qry4 = mysqli_query($conexao, $sql);
				}
				
				if($qry4>0){
					$sql = "DELETE FROM t_links_externos WHERE id_cardapio='$cod_cardapio' ";
					$qry5 = mysqli_query($conexao, $sql);
				}
				
				if($qry5>0){
					$sql = "DELETE FROM t_cardapio WHERE id = '$cod_cardapio' ";
					$qry6 = mysqli_query($conexao, $sql);
				}
				
				if($qry6>0){
					echo "<div class='alert-sucess'><h6><i class='fa fa-check icon-alert' aria-hidden='true'></i> Cadastro excluído com  sucesso!</h6></div>";
					echo "<img src='./img/barra-progresso.gif' class='barra-progresso' alt='progresso' />";
					echo "<script>setTimeout(function(){window.location='index.php?m=3';}, 2500);</script>";
				}
			}
			
			
		}
		
		
		
	}
	mysqli_close($conexao);
?>