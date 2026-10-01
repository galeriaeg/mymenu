<a name="planos"></a>
<div class="links">
	<span>
		<img src="img/icon-planos.png" alt="icone-coin"> <h5 class="laranja"><strong>Nossos Planos</strong></h5>
	</span>
</div>

<h5 class="cinza p">Confira nossos planos, um deles é ideal para sua necessidade.</h5>

<div class="bloco-cards">
	<?php
		require_once "app/config/conecta.php";
		
		$sql = "SELECT * FROM t_mymenu_planos";
		$res = mysqli_query($conexao, $sql);
		$total = mysqli_num_rows($res);
		while ($row = mysqli_fetch_array($res)){
			$id	=	$row['id'];
			$nome	=	$row['nome'];
			$periodo	=	$row['periodo'];
			$preco	=	$row['preco'];
			
			
			$preco = str_replace(".", ",", $preco);
			
			if($periodo==6)
				$desconto = "<i>-5%</i>";
			else if($periodo==12)
				$desconto = "<i>-10%</i>";
			else
				$desconto = "";
			
			echo "<div class='card-planos col3' onclick='setarPlano($periodo);'>
			<span>$nome</span>
			<strong>R$ $preco<i>$desconto</i></strong>
			</div>";
		}
	?>
</div>

<script>
	function setarPlano(per){
		window.location.href="page?p=criar-conta&pl="+per;
	}
</script>