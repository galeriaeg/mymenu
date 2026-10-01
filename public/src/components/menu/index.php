<link rel="stylesheet" href="src/css/menu.css"/>


<nav class="bg-topo-botons" style="background-color:<?php echo $cor_barra_botao; ?>">
	<div class="carousel-container">
		<div class="carousel" id="carousel">
			<?php
				$sql = "SELECT id,nome,idCardapio FROM t_categoria WHERE idCardapio='$idcardapio' AND status=1";
				$res = mysqli_query($conexao, $sql);
				$total = mysqli_num_rows($res);
				while ($row = mysqli_fetch_array($res)){
					$id_categoria	=	$row['id'];
					$nome_categoria	=	$row['nome'];
					$idCardapio	=	$row['idCardapio'];
					echo "<div class='card' style='background-color:$cor_botao;color:$cor_texto_botao;' onclick='clica($id_categoria,\"$idcardapioHash\")'>$nome_categoria</div>";
				}
			?>
		</div>
	</div>
</nav>


<script>
	function clica(c,s){
	let idcat = c;
	let idcard = s;
	window.location.href="filtro?cat="+idcat+"&crd="+idcard;
}
</script>