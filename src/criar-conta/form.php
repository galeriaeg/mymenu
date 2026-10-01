<div class="box-form">
	
	<h4 class="laranja titulo">Criar conta</h4>
	<h5 class="cinza p">Cadastre-se para criar sua conta no MyMenu.</h5>
	
	<form action="src/criar-conta/grava.php" name="form_cadastro" method="POST">
		
		<input class="campo_g" type="text" placeholder="Nome" name="nome" required />
		<input class="campo_g" type="email" placeholder="Email" name="email" required />
		<input class="campo_g" type="text" placeholder="CPF" onkeyup="javascript:somente_numero(this);" onblur="return verificarCPF(this.value)" maxlength="11" name="cpf" id="cpf" required />
		<input class="campo_g" type="text" id="telefone" maxlength="12" placeholder="XX-XXXXXXXX" name="telefone" required />
		<input class="campo_g" type="password" placeholder="Senha" name="senha" required />
		
		
		<select name="plano" required class="campo_g">
			<option value="" disabled selected>Selecione seu plano</option>
			
			<?php

				$periodoPlano = $_GET['pl'];

				require_once "app/config/conecta.php";
			
				$sql = "SELECT id,nome,periodo,preco FROM t_mymenu_planos";
				$res = mysqli_query($conexao, $sql);
				$total = mysqli_num_rows($res);
				while ($row = mysqli_fetch_array($res)){
					$id	=	$row['id'];
					$nome	=	$row['nome'];
					$periodo	=	$row['periodo'];
					$preco	=	$row['preco'];
					
					$preco = str_replace(".", ",", $preco);
					
					if($periodo==$periodoPlano)
						echo "<option selected value='$id'>$nome - R$ $preco</option>";
					else
						echo "<option value='$id'>$nome - R$ $preco</option>";
				}			
			?>
		</select>
		<input class="btn-submit" name="btnConta" type="submit" value="Cadastrar"/>
		
	</form>


	<span class="col1 box-link">
		<a href="page?p=login" class="link-legend">Fazer login</a>
	</span>
	
	<script src="js/alert.js"></script>
	<script src="js/mask_fone.js"></script>
	<script src="js/cpf.js"></script>
	
	
	<span id='alertacpf' style="display:none" class='box-erro'>&#10006; O CPF é inválido!</span>
	
	
	<?php
		@$param = $_GET['erro'];
		if($param == 403){
			echo "<span id='alerta' class='box-erro'>&#10006; &nbsp;Email ou CPF já cadastrado!</span>";
			echo "<script>ocultaAlerta();</script>";
		}
		else if($param == 400){
			echo "<span id='alerta' class='box-erro'>&#10006; &nbsp;Sua senha deve ter entre 8 e 12 caracteres!</span>";
			echo "<script>ocultaAlerta();</script>";		
		}
		else if($param == 402){
			echo "<span id='alerta' class='box-erro'>&#10006; &nbsp;Informe seu nome completo!</span>";
			echo "<script>ocultaAlerta();</script>";		
		}	
	?>
	
</div>