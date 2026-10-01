<?php include "session.php"; ?>

<?php include "checa_pagamento.php";?>


<?php
	// card sobre plano contratado
	echo "<h6 class='col1 cinza_min card-plano'>";
	echo "<a href='index.php?m=8'>$nome_plano</a>";
	echo "<div>Status: <strong>$status_label</strong></div>";
	echo "</h6>";	
?>

<div class="card-incio">
	<?php
		
		$idUsuarioLogado = $_SESSION['id'];
		$nomeUsuarioLogado = $_SESSION['nome'];
		
		
		require_once "config/conecta.php";
		
		$sql = "SELECT id,titulo,status FROM t_cardapio WHERE idUsuario = $idUsuarioLogado";
		$res = mysqli_query($conexao, $sql);
		while ($row = mysqli_fetch_array($res)){
			$id_cardapio		=	$row['id'];
			$titulo_cardapio	=	$row['titulo'];
			$status_cardapio	=	$row['status'];
		}
		
		
		
		if($status_cardapio==1){
			echo "<img src='img/fig.png' alt='icone cardápio' />
			<span>
			Nome do estabelecimento: <strong>$titulo_cardapio</strong><br />
			Status do Cardápio: <div class='tag_status_on'>ATIVO</div>
			</span>
			<button onclick='envia()'>EDITAR CARDÁPIO <span class='arrow-btn'></span></button>";
		}
		else{
			echo "<img src='img/fig.png' alt='icone cardápio' />
			<span>Bem-vindo <strong>$nomeUsuarioLogado!</strong><br />
			Crie o seu cardápio clicando no botão 'CRIAR CARDÁPIO'.</span>
			<button onclick='envia()'>CRIAR CARDÁPIO <span class='arrow-btn'></span></button>";		
		}
	?>
</div>

<script>
	function envia(){
		window.location.href='index.php?m=3';
	}
</script>

<?php include "cards.php"; ?>


