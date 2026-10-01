<div class="box-form">
	
	<h4 class="laranja titulo">Recuperar senha</h4>
	<h5 class="cinza p">Informe seu CPF para recuperar sua senha.</h5>
	
	<form action="src/recuperar-senha/grava.php" name="form_cadastro" method="POST">
		<input class="campo_g" type="text" placeholder="CPF" onkeyup="javascript:somente_numero(this);" onblur="return verificarCPF(this.value)" maxlength="11" name="cpf" id="cpf" required />
		<input class="btn-submit" name="btnLogin" type="submit" value="Enviar"/>
	</form>
	
	<span class="col1 box-link">
		<a href="page?p=login" class="link-legend">Fazer login</a>
	</span>
	
</div>

<span id='alertacpf' style="display:none" class='box-erro'>&#10006; O CPF é inválido!</span>

<script src="js/alert.js"></script>
<script src="js/cpf.js"></script>

<?php
	@$erro = $_GET['erro'];
	
	if($erro == 401){
		echo "<span id='alerta' class='box-erro'>&#10006; O CPF informado não foi localizado!</span>";
		echo "<script>ocultaAlerta();</script>";
	}
?>