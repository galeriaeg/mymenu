<?php include "session.php"; ?>

<?php include "checa_pagamento.php";?>

<?php $idUsuarioLogado = $_SESSION['id']; ?>

<h4 class="titulo-page"><?php echo $titulo ;?></h4>


<section class="box-registros">
	
	<?php		
		require_once "config/conecta.php";
		
		$sql = "SELECT id,nome,cpf,email,telefone FROM t_usuario WHERE id=$idUsuarioLogado AND status=1";
		$res = mysqli_query($conexao, $sql);
		while ($row = mysqli_fetch_array($res)){
			$id_user	=	$row['id'];
			$nome_user	=	$row['nome'];
			$cpf_user	=	$row['cpf'];
			$email_user	=	$row['email'];
			$telefone_user	=	$row['telefone'];	
		}
		
		
		echo "
		<div class='col1'>
			<div class='card-registro card1'>
				<span>
					<i class='fa fa-user' aria-hidden='true'></i><strong>&nbsp; $nome_user</strong><br />
					<i class='fa fa-envelope' aria-hidden='true'></i>&nbsp; $email_user<br />
					<i class='fa fa-phone' aria-hidden='true'></i>&nbsp; $telefone_user
				</span>
				<div class='box-botons-cardapio'>
					<img src='img/btn-editar.png' class='btn-actions less-right' onclick='popup(1);' alt='botão editar' />
				</div>
			</div>
		</div>";
	?>
	
</section>


<!-- POPUP -->
<section id="popup-cadastro" class="popup_cadastro">
	<form action="index.php?m=21" method="POST">
		<h4 class="titulo_popup">Cadastrar Usuário<span onclick="popup(0);" class="btn-fechar-popup">&#215;</span></h4>
		
		<div class="container-scroll">
			<label>Nome:</label>
			<input type="text" class="campo_g" name="nome" value="<?php echo $nome_user; ?>" required placeholder="Nome" />
			
			<label>CPF:</label>
			<input type="text" class="campo_g" name="" value="<?php echo $cpf_user; ?>" disabled placeholder="Nome" />
			
			<label>Email:</label>
			<input type="text" class="campo_g" name="email" value="<?php echo $email_user; ?>" required placeholder="Email" />
			
			<label>Telefone:</label>
			<input type="text" class="campo_g" onkeyup="javascript:somente_numero(this);fone(value);" maxlength="12" name="telefone" id="preco" value="<?php echo $telefone_user; ?>" required placeholder="Telefone" />
			<input type="hidden" class="campo_g" name="idusuario" value="<?php echo $id_user; ?>" />
			<h6 style="margin-bottom:10px;"><a href="#" onclick="exibeOcultaBloco()">&#8644; Mudar Senha</a></h6>
			<div id="bloco-oculto" style="display:none;">
				<input type="text" class="campo_g" name="senha" placeholder="Nova senha" />
			</div>
			<div class="box-submit">
				<input type="submit" class="btn-submit" value="Cadastrar" />
			</div>
		</div>


	</form>
</section>


<script src="./js/popup_crud_perfil.js"></script>
<script src="./js/numeros.js"></script>
<script src="./js/telefone.js"></script>