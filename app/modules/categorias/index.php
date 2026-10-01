<?php include "session.php"; ?>

<?php include "checa_pagamento.php";?>

<h4 class="titulo-page"><?php echo $titulo ;?></h4>

<section class="header-modulo">
	<div class="box-filtro">
		<input type="chave" id="chave" placeholder="Nome da categoria" />
		<button onclick="buscar();">Buscar</button>		
	</div>
	<button class="buttonleft" onclick="popup(1);">+ Novo</button>
</section>


<script>
	function buscar(){
		let chave = document.getElementById('chave').value;
		location.assign('index.php?m=4&chave='+chave);
	}
</script>


<section class="box-registros">
	
	<?php
		
		@$chave = $_GET['chave'];
		
		$idUsuarioLogado = $_SESSION['id'];
		
		require_once "config/conecta.php";
		
		
		if(!empty($chave)){
			
			
			$sql = "SELECT cat.id,cat.nome, card.id AS idCardapio
			FROM t_categoria AS cat, t_cardapio AS card 
			WHERE cat.nome LIKE '%$chave%'
			AND cat.idCardapio=card.id
			AND card.idUsuario = $idUsuarioLogado";
			$res = mysqli_query($conexao, $sql);
			$total = mysqli_num_rows($res);
			while ($row = mysqli_fetch_array($res)){
				$id_categoria	=	$row['id'];
				$nome_categoria	=	$row['nome'];
				$idCardapio	=	$row['idCardapio'];
				
				echo "
				<div class='col4'>
					<div class='card-registro card4'>
					<span>$nome_categoria</span>
					<div class='box-botons-cardapio'>
					<img src='img/btn-editar.png' onclick='popup(1,$id_categoria,\"$nome_categoria\");' class='btn-actions' alt='botão excluir' />
					<img src='img/btn-excluir.png' onclick='window.location=\"index.php?m=42&idc=$id_categoria\" ' class='btn-actions less-right' alt='botão excluir' />
					</div>
					</div>
				</div>	
				";
			}
			if($total<1)
			echo "<h6 class='alert-notification'><i class='fa fa-exclamation-circle icon-alert' aria-hidden='true'></i>&nbsp; Categoria '$chave' não localizada.<h6>";
		}
		else{
			
			$sql = "SELECT cat.id,cat.nome, card.id AS idCardapio
			FROM t_categoria AS cat, t_cardapio AS card 
			WHERE cat.idCardapio=card.id
			AND card.idUsuario = $idUsuarioLogado;";
			$res = mysqli_query($conexao, $sql);
			$total = mysqli_num_rows($res);
			while ($row = mysqli_fetch_array($res)){
				$id_categoria	=	$row['id'];
				$nome_categoria	=	$row['nome'];
				$idCardapio	=	$row['idCardapio'];
				
				echo "
				<div class='col4'>
					<div class='card-registro card4'>
					<span>$nome_categoria</span>
					<div class='box-botons-cardapio'>
						<img src='img/btn-editar.png' onclick='popup(1,$id_categoria,\"$nome_categoria\");' class='btn-actions' alt='botão excluir' />
						<img src='img/btn-excluir.png' onclick='window.location=\"index.php?m=42&idc=$id_categoria&cnf=false\" ' class='btn-actions less-right' alt='botão excluir' />
					</div>
					</div>
				</div>
				";
			}
			if($total<1){
				echo "<h6 class='alert-notification'><i class='fa fa-exclamation-circle icon-alert' aria-hidden='true'></i>&nbsp; Não há registros<h6>";
			}			
			
		}
		
		
	?>
	
</section>


<?php
	$sql = "SELECT id FROM t_cardapio WHERE idUsuario = $idUsuarioLogado;";
	$res = mysqli_query($conexao, $sql);
	$total = mysqli_num_rows($res);
	while ($row = mysqli_fetch_array($res)){
		$idCardapio	=	$row['id'];
	}
?>




<section id="popup-cadastro" class="popup_cadastro">
	
	<form action="index.php?m=41" name="formPopup" method="POST">
		<h4 class="titulo_popup">Cadastrar Categoria <span onclick="popup(0);" class="btn-fechar-popup">&#215;</span></h4>
		<input type="text" value="" class="campo_g" name="nome" required placeholder="Nome da categoria" />
		<input type="hidden" readonly value="<?php echo $idCardapio;?>" name="idCardapio" />
		<input type="hidden" readonly value="" name="idCategoria" />
		<div class="box-submit">
			<input type="submit" class="btn-submit" value="Cadastrar" />
		</div>
	</form>
	
</section>

<script src="./js/popup_crud_categoria.js"></script>




