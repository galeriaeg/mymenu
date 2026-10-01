<?php include "session.php"; ?>

<?php include "checa_pagamento.php";?>


<link rel="stylesheet" href="./css/qrcode.css" />
<h4 class="titulo-page"><?php echo $titulo ;?></h4>


<div id="box-header">
	<section class="header-modulo" id="headerModulo">
		<button onclick="popup(1,0,0);">+ Novo</button>
	</section>
</div>



<!-- POPUP CRUD -->
<section id="popup-cadastro" class="popup_cadastro">
	
	<form action="index.php?m=31" method="post" enctype="multipart/form-data">
	
		<h4 class="titulo_popup">Cadastrar Estabelecimento<span onclick="popup(0);" class="btn-fechar-popup">&#215;</span></h4>
		<label>Nome do estabelecimento:</label>
		<input type="text" class="campo_g" name="nome" required placeholder="Nome do estabelecimento" />
		
		<label>Logomarca:</label>
		<span id="bloco_input_file">
			<!-- Bloco: input file -->
			<span id="box-inputFile">
				<input name="arquivo" type="file" accept=".jpg,.jpeg,.png" id="arquivo" onchange="preview(1)" class="campo_g"/>
				<i>Tamanho 200px x 200px</i>
			</span>
			<section id="box-preview" class="box-preview" style="display:none">
				<img id="previsao" src="" class="img-preview" style="display:none"/>
				<img src="img/btn-excluir.png" class="btn-excluir-anexo" alt="botao-excluir" id="apagar" onclick="preview(0)" />
			</section>
		</span>
		
		<div id="bloco_remove_anexo" class="box-anexo-form">
			<!-- Bloco: remover anexo -->
			<span id="anexoNome"></span>
			<a href="index.php?m=34" id="anexoLink">
				<img src="img/btn-excluir.png" alt="icone excluir" />
			</a>
		</div>
		
		<div class="box-checkbox-form">
			<!-- Bloco: Checkbox status -->
			<img src="img/btn-check-off.png" id="checkbox" onclick="getStatus();" class="input_check" alt="checkbox">
			<h6 class="cinza" style="display:contents;margin:0;">Ativo</h6>
			<input type="hidden" name="status" required readonly id="status" value="" />
		</div>
		
		<div class="box-submit">
			<!-- Bloco input e botão -->
			<input type="submit" class="btn-submit" value="Cadastrar" />
			<input type="hidden" readonly name="idCardapio" value="" />
			<input type="hidden" readonly name="anexoInput" id="anexoInput" value="" />
		</div>
	</form>
</section>

<script src="./js/popup_crud_cardapio.js"></script>
<script src="./js/popup_qrcode.js"></script>
<script src="./js/preview.js"></script>
<script src="./js/status.js"></script>



<!-- LISTAGEM -->
<section class="box-registros">
	
	<?php
		
		$idUsuarioLogado = $_SESSION['id'];
		
		require_once "config/conecta.php";
		
		//pega codigo_path: gerado quando o cardapio é criado
		$sql = "SELECT codigo_path FROM t_customiza WHERE idUsuario = $idUsuarioLogado";
		$res = mysqli_query($conexao, $sql);
		$totalPath = mysqli_num_rows($res);
		while ($row = mysqli_fetch_array($res)){
			$codigo_path	=	$row['codigo_path'];
		}
		
		
		if($totalPath<1){
			//Entra quando não há cardapio criado nem codigo_path
			
			echo "<h6 class='alert-notification'>
			<i class='fa fa-exclamation-circle icon-alert' aria-hidden='true'></i>
			&nbsp; Não há registros!<h6>";
			
			//remove preview do anexo
			echo "<script>document.getElementById('bloco_remove_anexo').remove();</script>";
			
			exit();
		}
		else{
			
			//remover DIV: botao +Novo
			echo "<script>document.getElementById('headerModulo').remove();</script>";
			
			//diretorio personalizado do usuario
			$codigoPath = $idUsuarioLogado.'-'.$codigo_path;		
			
			$sql = "SELECT * FROM t_cardapio WHERE idUsuario = $idUsuarioLogado LIMIT 1";
			$res = mysqli_query($conexao, $sql);
			$total_cardapio = mysqli_num_rows($res);
			while ($row = mysqli_fetch_array($res)){
				$id_cardapio		=	$row['id'];
				$titulo_cardapio	=	$row['titulo'];
				$logo_cardapio		=	$row['logo'];
				$link_cardapio		=	$row['link'];
				$status_cardapio	=	$row['status'];
				$idusuario_cardapio	=	$row['idUsuario'];
			}
			
			
			// verifica se tem anexo
			if(empty($logo_cardapio)){
			
				$logocardapio = "img/sem-img.png";
				
				//remove preview do anexo
				echo "<script>document.getElementById('bloco_remove_anexo').style.display='none';</script>";
			}
			else{
			
				$logocardapio = "files/$codigoPath/$logo_cardapio";
				
				//remove bloco input file
				echo "<script>
				const removeBlocoInput = document.getElementById('bloco_input_file');
				removeBlocoInput.remove();
				</script>";
				
				echo "<script>document.getElementById('anexoNome').innerHTML=\"<img src='$logocardapio' class='logo-cardapio' alt='logo'>\";</script>";
				echo "<script>document.getElementById('anexoLink').href='index.php?m=34&c=$id_cardapio&f=$logo_cardapio';</script>"; 
				echo "<script>document.getElementById('anexoInput').value='$logo_cardapio';</script>"; 
			}
			
			
			
			
			
			//Define status
			if($status_cardapio==1){
				$status = "Ativo";
				$cor = "#02c426";
				echo "<script>document.getElementById('checkbox').src='img/btn-check-on.png';</script>"; 
			}
			else{
				$status = "Inativo";
				$cor = "#ff0000";
				echo "<script>document.getElementById('checkbox').src='img/btn-check-off.png';</script>";
			}
			
			echo "<script>document.getElementById('status').value='$status_cardapio';</script>"; 
			
			//$link_absolute = "https://www.mymenu.app.br/public/".$link_cardapio; 
			$link_absolute = "http://localhost/mymenu/public/".$link_cardapio;
			
			echo "
			<div class='col1'>
			
				<div class='card-registro card1'>
					<span>
						<img src='$logocardapio' class='logo-cardapio' alt='logo' />
						<strong>Status:</strong> <div class='tag_status_on' style='background:$cor'>$status</div><br />
						<strong>Estabelecimento: </strong>$titulo_cardapio<br />
						<strong>Link publico: </strong><a href='$link_absolute' target='_blank'>$link_absolute</a>						
					</span>
					<div class='box-botons-cardapio left-forcing'>
						<img src='img/btn-qr-code.png' onclick='popup_qrcode(1)' class='btn-actions' alt='botão QR Code' />
						<img src='img/btn-editar.png' class='btn-actions' onclick='popup(1,$id_cardapio,\"$titulo_cardapio\");' alt='botão editar' />
						<a href='index.php?m=33&c=$id_cardapio&pth=$codigo_path&cnf=false'><img src='img/btn-excluir.png' class='less-right btn-actions' alt='botão excluir' /></a>
					</div>
				</div>
			
			</div>";
		}
	?>
	
</section>




<!-- popup QRCode -->
<section id="popup-qrcode" style="height:445px;" class="popup_cadastro">
	<h4 class="titulo_popup" >QR Code do seu cardápio<span onclick="popup_qrcode(0);" class="btn-fechar-popup">&#215;</span></h4>
	<div id="qrcode"></div>
	<div class="box-submit">
		<input type="submit" onclick="downloadImage()" class="btn-submit" value="Download" />
	</div>
</section>

<script src="js/qr_code_generator.js"></script>
<script src="js/qrcode.min.js"></script>
<script>
	var qrcodeElement = document.getElementById("qrcode");
	var qrcode = new QRCode(qrcodeElement, {
		text: "<?php echo $link_absolute; ?>",
		width: 325,
		height: 325,
	});
</script>


<?php mysqli_close($conexao); ?>
