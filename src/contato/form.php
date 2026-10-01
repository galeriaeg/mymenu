<link rel="stylesheet" href="./src/contato/captcha/captcha.css"/>


<script src="./src/contato/captcha/captcha.js"></script>


<div class="box-form">
	
	<h4 class="laranja titulo">Contato</h4>
	<h5 class="cinza p">Fale conosco, logo respoderemos a sua mensagem.</h5>
	
	<form action="src/contato/email_envia.php" name="form_contato" method="POST">
		
		<input class="campo_g" type="text" placeholder="Nome" name="nome" required />
		<input class="campo_g" type="email" placeholder="Email" name="email" required />
		<textarea class="campo_g" rows="6" name="mensagem" required></textarea>	
		
		
		<select name="tipo-usuario" required class="campo_g">
			<option value="Não sou cliente" selected>Não sou cliente</option>
			<option value="Sou cliente">Sou cliente</option>
		</select>
		
		<section class="boxCaptcha">
			<i id="viewCaptcha" class="viewCaptcha"></i>
			<img src="./src/contato/captcha/bnt-reload.png" onclick="captcha()" title="Gerar novo código" class="icon-reload" /><br />
			<input type="hidden" name="randCaptcha" id="randCaptcha" />
			<input type="text" class="campo_g" placeholder="Repita o código" required onkeyup="javascript:somente_numero(this);" name="meuCaptcha" onblur="validaCaptcha()" onclick="limpa();" maxlength="4" id="meuCaptcha" />
		</section>		
		
		<input class="btn-submit" name="btnConta" type="submit" value="Enviar"/>
		
	</form>
	
	
	
	<span class="col1 box-link">
		<a href="page?p=login" class="link-legend">Fazer login</a>
	</span>
	
	<script>captcha();</script>
	<script src="./js/alert.js"></script>

	
	
	
	<span id='alertacpf' style="display:none" class='box-erro'>&#10006; O CPF é inválido!</span>
	
	
	<?php
		@$param = $_GET['send'];
		
		if($param == 'true'){
			echo "<span id='alerta' class='box-sucesso'>&#10006; &nbsp;Mensagem enviada com sucesso!</span>";
			echo "<script>ocultaAlerta();</script>";		
		}
		else if($param == 'false'){
			echo "<span id='alerta' class='box-erro'>&#10006; &nbsp;Preencha todos os campos!</span>";
			echo "<script>ocultaAlerta();</script>";			
			
		}
		
	?>
	
</div>