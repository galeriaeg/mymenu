<div class="box-form">
	
	<h4 class="laranja titulo">Login</h4>
	<h5 class="cinza p">Entre com seus dados de acesso.</h5>
	
	<form action="./src/fazer-login/aut.php" method="POST">
		<input class="campo_g" type="email" placeholder="Email" name="email" required />
		<input class="campo_g" type="password" placeholder="Senha" name="senha" id="senha" required />
		<img src="img/icon-senha-off.png" id="icon-senha" onclick="mostraSenha(alt);" class="icon-senha" alt="senha_off" />
		<input class="btn-submit" name="btnLogin" type="submit" value="Entrar"/>
	</form>
	
	<span class="col1 box-link">
		<a href="page?p=recuperar-senha" class="link-legend">Esqueci minha senha</a>
		&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="page?p=criar-conta" class="link-legend">Criar minha conta</a>
	</span>
	
</div>

<script src="js/alert.js"></script>
<script src="js/mostra-senha.js"></script>

<?php
	@$param = $_GET['aut'];
	if($param == "false"){
		echo "<span id='alerta' class='box-erro'>&#10006; &nbsp;Login ou Senha incorretos!</span>";
		echo "<script>ocultaAlerta();</script>";
	}
	
	
	@$param = $_GET['erro'];
	if($param == 401){
		echo "<span id='alerta' class='box-erro'>&#10006; &nbsp;Autenticação falhou! Tente novamente.</span>";
		echo "<script>ocultaAlerta();</script>";
	}
	
	
	@$param = $_GET['act'];
	if($param == 201){
		echo "<span id='alerta' class='box-sucesso'>&#10004; &nbsp;Verifique a mensagem enviada para o seu email.</span>";
		echo "<script>ocultaAlerta();</script>";
	}	
?>