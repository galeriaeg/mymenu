<?php
	include "../app/config/path.php";
	
	include $path."conecta.php";
	
	@$idcardapioHash = $_GET['crd'];
	// $idHash; usado nos links internos
	//exit();
	
	@$idcardapio = base64_decode($idcardapioHash);
	// $idcardapio; Variável que identifica o Id do cardapio
	
	
	if(is_numeric($idcardapio)){
		
		//verifica se existe o cardapio requisitado
		$sql = "SELECT id FROM t_cardapio WHERE id = $idcardapio AND status=1";
		$res = mysqli_query($conexao, $sql);
		$total = mysqli_num_rows($res);
		while ($row = mysqli_fetch_array($res)){
			$id_cardapio		=	$row['id'];
		}
		if(empty($total)){
			echo "<span class='text'>Cardápio não localizado ou desativado.
			<img src='src/img/logo-footer.png' alt='logo' border='0' style='display:block;margin:0 auto;margin-top:30px;'/></span>"; 
			exit();
		}
		
	}else{
		echo "<script>window.location.href='../index.php';</script>";
	}
	
	
	$sql = "SELECT * FROM t_customiza WHERE idCardapio=$id_cardapio LIMIT 1";
	$res = mysqli_query($conexao, $sql);
	while ($row = mysqli_fetch_array($res)){
		$cor_botao		=	$row['cor_botao'];
		$cor_texto_botao=	$row['cor_texto_botao'];
		$cor_barra_botao=	$row['cor_barra_botao'];
		$cor_topo		=	$row['cor_topo'];
		$cor_texto_topo	=	$row['cor_texto_topo'];
		$cor_preco		=	$row['cor_preco'];
	}
?>