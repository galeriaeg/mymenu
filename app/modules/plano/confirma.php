<?php include "session.php"; ?>

<style>
	body{
	margin:0 !important;
	padding:0 !important;
	}
	
	.clear{
	margin:0 !important;
	padding:0 !important;
	}
</style>

<link rel="stylesheet" href="./css/confirma-pagamento.css"/>

<?php

	$idUsuarioLogado = $_SESSION['id'];

	$id_produto_stripe = $_GET['cod'];

	$perido_plano = $_GET['perido'];

	date_default_timezone_set('America/Sao_Paulo');
	$hoje =  date("d/m/Y H:i:s");
	
	
	if(!empty($idUsuarioLogado)){

		require_once "config/conecta.php";

		//pega id do plano pago
		$sql = "SELECT id FROM t_mymenu_planos WHERE periodo = $perido_plano";
		$res = mysqli_query($conexao, $sql);
		while ($row = mysqli_fetch_array($res)){
			$id_plano =	$row['id'];
		}

		// atualiza TAB Contrato
		$sql = "UPDATE t_contrato 
		SET data_pagamento='$hoje',
		id_plano ='$id_plano',
		periodo_plano='$perido_plano',
		id_produto_stripe='$id_produto_stripe',
		status='1'
		WHERE id_usuario = '$idUsuarioLogado' ";
		$update = mysqli_query($conexao, $sql);

	}
	else{
		echo "Algo deu errado! Printe essa tela e entre em contato conosco pelo email suporte@mymenu.app.br.";
		exit();
	}
	
?>

<div class="col1 cinza clear">
	<img src="./img/icon-checado.gif" alt="icone checado" style="margin-bottom:15px;" />
	<h4>Pagamento confirmado!</h4>
	<h6 class="p">Seu pagamento foi realizado com sucesso. Você já pode fechar esta tela. Em seguida inicie a configuração do seu cardápio.</h6>
	<button class="btnpopup" onclick="fechaTela();"><strong>FECHAR</strong></button>
</div>


<script>
	document.getElementById('box-header-user').remove();
	document.getElementById('box-header').remove();
	
	function fechaTela() {
		window.opener.location.reload();
		window.close();
	}
</script>