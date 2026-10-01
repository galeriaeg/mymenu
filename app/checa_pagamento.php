<?php	include "session.php"; ?>

<script>
  function dropdownPlanos(v){
    const disp = document.getElementById('dropdown-planos').style.display ;
		if(disp=='none')
				document.getElementById('dropdown-planos').style.display='block' ;
		else
				document.getElementById('dropdown-planos').style.display='none' ;
		}
</script>


<?php
	$idUsuarioLogado = $_SESSION['id'];
	
	// recebe ID do novo plano setado
	@$planoNovo = $_GET['p'];

	include "config/conecta.php";

	if($planoNovo > 0){

		//verifica se novo plano setado é o mesmo já definido no cadastro
		$sql = "SELECT id_plano FROM t_contrato	WHERE id_plano = $planoNovo AND id_usuario = $idUsuarioLogado " ;
		$res = mysqli_query($conexao, $sql);
		$qtdeContrato = mysqli_num_rows($res);

		if($qtdeContrato < 1){

			//Pega dados do plano novo
			$sql = "SELECT * FROM t_mymenu_planos	WHERE id = $planoNovo" ;
			$res = mysqli_query($conexao, $sql);
			$qtde_contrato = mysqli_num_rows($res);
			while ($row = mysqli_fetch_array($res)){
				$id_usuario	=	$row['id_usuario'];
				$preco			=	$row['preco'];
				$stripe_pay	=	$row['stripe_pay'];
				$nome_plano	=	$row['nome'];
			}

		}
		else{

			// Mantem o mesmo plano incial";
			$sql = "SELECT c.*, p.preco AS preco, p.stripe_pay AS stripe, p.nome AS nome
			FROM t_contrato AS c, t_mymenu_planos AS p
			WHERE id_usuario = $idUsuarioLogado 
			AND p.id = c.id_plano" ;
			$res = mysqli_query($conexao, $sql);
			$qtde_contrato = mysqli_num_rows($res);
			while ($row = mysqli_fetch_array($res)){
				$id_contrato	=	$row['id'];
				$data_cadastro	=	$row['data_cadastro'];
				$data_pagamento	=	$row['data_pagamento'];
				$data_expira	=	$row['data_expira'];
				$id_usuario		=	$row['id_usuario'];
				$id_plano		=	$row['id_plano'];
				$status			=	$row['status'];
				$preco			=	$row['preco'];
				$stripe_pay		=	$row['stripe'];
				$nome_plano		=	$row['nome'];
			}

		}


	}
	else{

		//Pega dados do plano
		$sql = "SELECT c.*, p.preco AS preco, p.stripe_pay AS stripe, p.nome AS nome
		FROM t_contrato AS c, t_mymenu_planos AS p
		WHERE id_usuario = $idUsuarioLogado 
		AND p.id = c.id_plano" ;
		$res = mysqli_query($conexao, $sql);
		$qtde_contrato = mysqli_num_rows($res);
		while ($row = mysqli_fetch_array($res)){
			$id_contrato	=	$row['id'];
			$data_cadastro	=	$row['data_cadastro'];
			$data_pagamento	=	$row['data_pagamento'];
			$data_expira	=	$row['data_expira'];
			$id_usuario		=	$row['id_usuario'];
			$id_plano		=	$row['id_plano'];
			$status			=	$row['status'];
			$preco			=	$row['preco'];
			$stripe_pay		=	$row['stripe'];
			$nome_plano		=	$row['nome'];
		}
		
	}

	

	
	if($qtde_contrato > 0){
	
	
			if($status>0)
				$status_label = "Ativo";
			else
				$status_label = "Pendente";
		
		
		// verifica status do plano
		if($status<1){
			
			echo "
			<h3 class='cinza'>Bem-vindo!</h3>
			<h6 class='cinza'>Efetue agora o pagamento do seu plano para começar a usar a plataforma <strong>My Menu</strong>.</h6>
			
			<h6 class='col1 cinza' style='display:block;margin-top:50px;'>
				
				<div class='bloco-img-plano'>
					<img src='img/embalagem.png' alt='embalagem' class='fig-produto' />
				</div>

				<section id='bloco-plano-atual' class='bloco-plano-atual'>
					<strong>Plano Atual:</strong><br/>					
					<span>$nome_plano</span><br/>	
					Pagamento: <span class='vermelho'>$status_label</span><br/>
					<strong>R$ $preco</strong><br/>
					<button onclick='abrirPopup();' class='btn-produto'>PAGAR</button>
				";

				echo "<div id='bloco-mudar-plano' class='bloco-mudar-plano'>
					<span onclick='dropdownPlanos(1);' class='amudar-plano'>Mudar Plano</span>
					<span class='dropdown-planos' id='dropdown-planos' style='display:none;'>";

						$sql = 'SELECT id,nome,periodo FROM t_mymenu_planos';
						$res = mysqli_query($conexao, $sql);
						while ($row = mysqli_fetch_array($res)){
							$id_plano				=	$row['id'];
							$nome_plano			=	$row['nome'];
							$periodo_plano	=	$row['periodo'];

							echo "<a href='index.php?m=7&p=$id_plano'>&#8226; $nome_plano</a>";
							}

				echo "</span>
				</div>
				</section>

			</h6>";
			
			echo "<script>
				function abrirPopup() {
				  window.open('$stripe_pay', 'minhaJanela', 'width=320,height=440,left=0,top=5');
				}</script>";
				exit();
		}
		

	}
	else{
		// Não há contrato na Base
		echo "<script>window.location.href='index.php?m=9';</script>";
		
	}
?>