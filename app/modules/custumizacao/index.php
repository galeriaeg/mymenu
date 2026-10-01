<?php include "session.php"; ?>

<?php include "checa_pagamento.php";?>

<h4 class="titulo-page"><?php echo $titulo ;?></h4>


<?php
	// pega ID do cardapio
	$sql = "SELECT id FROM t_cardapio WHERE idUsuario=$idUsuarioLogado";
	$res = mysqli_query($conexao, $sql);
	$total_cardapio = mysqli_num_rows($res);
	while ($row = mysqli_fetch_array($res)){
		$id_cardapio	=	$row['id'];
	}
	
	if($total_cardapio < 1){
		echo "
		<h6 class='alert-notification'>
		<i class='fa fa-exclamation-circle icon-alert' aria-hidden='true'></i>
		&nbsp; Não há registros! Primeiramente <a href='index.php?m=3'>&nbsp;crie seu cardápio</a>.
		</h6>";
		exit();
	}
?>


<section class="header-modulo">
	<h6 class="cinza">Defina as cores dos compontes do seu cardápio clicando nos links abaixo.</h6>
</section>



<section class="box-registros" id="listcores">
	
	<?php
		
		$idUsuarioLogado = $_SESSION['id'];
		
		
		require_once "config/conecta.php";
		
		
		$sql = "SELECT id FROM t_cardapio WHERE idUsuario=$idUsuarioLogado";
		$res = mysqli_query($conexao, $sql);
		$totalCardapio = mysqli_num_rows($res);
		while ($row = mysqli_fetch_array($res)){
			$id_cardapio		=	$row['id'];
		}
		
		
		if($totalCardapio<1){
			echo "<h6 class='alert-notification'>
			<i class='fa fa-exclamation-circle icon-alert' aria-hidden='true'></i>
			&nbsp; Não há registros! Primeiramente <a href='index.php?m=3'>&nbsp;crie seu cardápio</a>.
			<h6>";
		}
		else{
    		$sql = "SELECT * FROM t_customiza WHERE idCardapio = $id_cardapio";
    		$res = mysqli_query($conexao, $sql);
    		$total = mysqli_num_rows($res);
    		while ($row = mysqli_fetch_array($res)){
    			$id_customizacao	=	$row['id'];
    			$cor_botao			=	$row['cor_botao'];
    			$cor_texto_botao	=	$row['cor_texto_botao'];
    			$cor_barra_botao	=	$row['cor_barra_botao'];
    			$cor_topo			=	$row['cor_topo'];
    			$cor_texto_topo		=	$row['cor_texto_topo'];
    			$cor_preco			=	$row['cor_preco'];
			}
		}
		
	?>
	
	
	
	<div class="col4">
		
		<input type="hidden" name="id_customizacao" id="id_customizacao" readonly value="<?php echo $id_customizacao; ?>">
		
		<ul class='card-registro card4'>
			<li class='box-cores' title='<?php echo $cor_topo; ?>' style='background:<?php echo $cor_topo; ?>'>
				<span>Topo principal</span>
			</li>
			<a href="#" onclick="popup(1,1,'<?php echo $cor_topo; ?>');">Editar</a>
		</ul>
	</div>
	
	<div class="col4">
		<ul class='card-registro card4'>
			<li class='box-cores' title='<?php echo $cor_texto_topo; ?>' style='background:<?php echo $cor_texto_topo; ?>'>
				<span>Texto do topo</span>
			</li>
			<a href="#" onclick="popup(1,2,'<?php echo $cor_texto_topo; ?>');">Editar</a>
		</ul>
	</div>
	
	<div class="col4">
		<ul class='card-registro card4'>
			<li class='box-cores' title='<?php echo $cor_barra_botao; ?>' style='background:<?php echo $cor_barra_botao; ?>'>
				<span>Topo dos botões</span>
			</li>
			<a href="#" onclick="popup(1,3,'<?php echo $cor_barra_botao; ?>');">Editar</a>
		</ul>
	</div>
	
	<div class="col4">
		<ul class='card-registro card4'>
			<li class='box-cores' title='<?php echo $cor_botao; ?>' style='background:<?php echo $cor_botao; ?>'>
				<span>Botão</span>
			</li>
			<a href="#" onclick="popup(1,4,'<?php echo $cor_botao; ?>');">Editar</a>
		</ul>
	</div>	
	
	<div class="col4">
		<ul class='card-registro card4'>
			<li class='box-cores' title='<?php echo $cor_texto_botao; ?>' style='background:<?php echo $cor_texto_botao; ?>'>
				<span>Texto do botão</span>
			</li>
			<a href="#" onclick="popup(1,5,'<?php echo $cor_texto_botao; ?>');">Editar</a>
		</ul>
	</div>
	
	<div class="col4">
		<ul class='card-registro card4'>
			<li class='box-cores' title='<?php echo $cor_preco; ?>' style='background:<?php echo $cor_preco; ?>'>
				<span>Preço do item</span>
			</li>
			<a href="#" onclick="popup(1,6,'<?php echo $cor_preco; ?>');">Editar</a>
		</ul>
	</div>
	
	
	
</section>

<?php 
	if($total<1){
        //remove preview do anexo
		echo "<script>document.getElementById('listcores').style.display='none';</script>";
	}
?>

<!-- POPUP CRUD -->
<section id="popup-cadastro" class="popup_cadastro">
	<form action="index.php?m=61" method="POST">
		<h4 class="titulo_popup">Cadastrar Personalização<span onclick="popup(0,'NULL');" class="btn-fechar-popup">&#215;</span></h4>
		
		<div class="boxPaletaCores">
			<label for="cor" id="labelcor"></label>
			<input type="color" id="inputcor" name="cor" value="">
		</div>
		
		<div class="boxPaletaCores" style="margin-bottom:0;">
			<label for="cor">Hexadecinal:</label>
			<input type="text" class="campo_g" placeholder="#000000" maxlength="7" name="corhexa" style="margin-bottom:0;" value="">
		</div>		
		
		<div class="box-submit">
			<input type="submit" class="btn-submit" value="Cadastrar" />
			<input type="hidden" readonly name="id_cardapio" value="<?php echo $id_cardapio; ?>" />
			<input type="hidden" readonly name="idCustomiza" id="idCustomiza"  value="" />
			<input type="hidden" readonly name="flegCor" id="flegCor"  value="" />
		</div>
	</form>
</section>



<script src="./js/popup_crud_customizacao.js"></script>






