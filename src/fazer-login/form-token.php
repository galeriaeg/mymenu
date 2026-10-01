<?php
	$email = htmlspecialchars($_POST['email']);
	
	if(empty($email)){
		echo "<script>window.location.href='./home'</script>";
		exit();
	}
?>

<div class="box-form">
	
	<h4 class="laranja">Autenticação </h4>
	<h5 class="cinza p">Um código de autenticação foi enviado para o seu email. Insira o código para continuar.</h5>
	
	<form action="src/fazer-login/autentica-token.php" method="POST">
		<input class="campo_g" onkeyup="javascript:somente_numero(this);" type="text" maxlength="6" placeholder="Código" name="codigo" required />
		<input type="hidden" name="email" required readonly value="<?php echo $email; ?>">
		<input class="btn-submit" name="btnLogin" type="submit" value="Enviar"/>
	</form>
	
	<span class="col1 box-link">
		<a href="home" class="link-legend">Fazer login</a>
	</span>
	
</div>

<script src="js/alert.js"></script>
<script src="js/numeros.js"></script>

<?php
	@$action = $_GET['act'];
	
	if($action == 201){
		echo "<span id='alerta' class='box-notifica'>&#9888; &nbsp;Para continuar, informe o código de autenticação!</span>";
		echo "<script>ocultaAlerta();</script>";
	}
?>