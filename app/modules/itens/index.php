<?php 

	include "session.php"; 
	
	include "checa_pagamento.php";
	
	$idUsuarioLogado = $_SESSION['id'];
	
	require "config/conecta.php";
	
	//Filtros
	@$categoria = $_GET['cat'];
	@$codigo = $_GET['cod'];

	
	if(!empty($categoria)){	
		$sql = "SELECT nome FROM t_categoria WHERE id=$categoria";
		$res = mysqli_query($conexao, $sql);
		while ($row = mysqli_fetch_array($res)){
			$nome_categoria_filtro	=	$row['nome'];
		}
	}

?>


<script>
	// Captura dados para popular formulario
	function pegaDados(p){
		let iditem = p;
		iditem = Number(iditem);
	}
</script>



<!-- POPUP CADASTRO -->
<section id="popup-cadastro" class="popup_cadastro">

	<form action="index.php?m=51" method="POST" enctype="multipart/form-data" id="formItem" name="formItem">
		<h4 class="titulo_popup">Cadastrar Item <span onclick="popupCadastro(0);" class="btn-fechar-popup">&#215;</span></h4>
		
		<div class="container-scroll" id="container-scroll">
			<input type="text" class="campo_g" name="codigo" id="codigo" required placeholder="Código" />
			<input type="text" class="campo_g" name="titulo" id="titulo" required placeholder="Título" />
			<textarea class="campo_g" name="descricao" id="descricao" rows="5" required placeholder="Descrição"></textarea>
			<select class="campo_g" required name="categoria" id="categoria">
				<option value="" selected disabled>Categorias</option>
				<?php
				
					$sql = "SELECT cat.id,cat.nome, card.id AS idCardapio
					FROM t_categoria AS cat, t_cardapio AS card 
					WHERE cat.idCardapio = card.id
					AND card.idUsuario = $idUsuarioLogado";
					$res = mysqli_query($conexao, $sql);
					echo $total = mysqli_num_rows($res);
					while ($row = mysqli_fetch_array($res)){
						$id_categoria	=	$row['id'];
						$nome_categoria	=	$row['nome'];
						echo "<option value='$id_categoria'>$nome_categoria</option>";
					}
					
				?>
			</select>
			<input onkeyup="moeda(value);javascript:somente_numero(this);" maxlength="8" type="text" class="campo_g" id="preco" name="preco" required placeholder="Preço" />
			<label>Imagem:</label>
			<div style="display:flex;align-items:center;">
				<img src="img/icon-img-base.png" class="icone-album" alt="icone album" onclick="popupAlbum(1);" />
				<input type="text" class="campo_g" onkeyup="javascript:somente_numero(this);" style="width:84%;margin:0" placeholder="Código da imagem do banco" id="file-base" name="id_file_base" />
			</div>

			<img src="img/fio-ou-popup.png" alt="fio" class="fio-popup" style="margin:20px 0 20px 0"/>

			<input type="file" onchange="preview(1)" class="campo_g" accept=".jpg,.jpeg,.png" id="arquivo" name="arquivo"/>
			<i style="width:94%;">Tamanho indicado: 700px x 500px (Ratio 14:10) </i>
			<h6 style="font-size:14px;display:none;" class="alert-error" id="alerta-erro-file"></h6>

			<section id="box-preview" class="box-preview" style="display:none">
				<img src="#" id="previsao" alt="preview" width="100" />
				<img src="img/btn-excluir.png" class="btn-excluir-anexo" alt="botao-excluir" id="apagar" onclick="preview(0)"/>
			</section>

			<span class="box-checkbox">
				<div style="display:flex;align-items:center;margin-top:15px;">
					<img src="img/btn-check-off.png" id="checkbox" onclick="definePromocao();" class="input_check" alt="checkbox"/>
					<label style="margin-bottom:0;">Em promoção</label>
				</div>
				<input type="hidden" name="promocao" value="NORMAL" id="promocao-ed" />
			</span>
			<div class="box-submit">
				<input type="submit" class="btn-submit" value="Cadastrar" />
			</div>
			
		</div>
		
		<input type="hidden" name="idItem" id="idItem" />
		<input type="hidden" name="idCardapio" id="idCardapio" />
		<input type="hidden" name="idCategoria" id="idCategoria" />
		<input type="hidden" name="status" id="status" />
	</form>

</section>




<!-- POPUP EDITA ITEM-->
<section id="popup-edita" class="popup_cadastro">

	<form action="index.php?m=51" method="POST" enctype="multipart/form-data" id="formItem" name="formItem">
		<h4 class="titulo_popup">Editar Item <span onclick="popupEdita(0);" class="btn-fechar-popup">&#215;</span></h4>
		
		<div class="container-scroll" id="container-scroll">
			<h6 style="margin-bottom:6px;"><span id="codigo-ed" class="cinza_min"></span></h6>
			<input type="text" class="campo_g" name="titulo" id="titulo-ed" required placeholder="Título" />
			<textarea class="campo_g" name="descricao" id="descricao-ed" rows="5" required placeholder="Descrição"></textarea>
			<select class="campo_g" required name="categoria" id="categoria-ed">
				<option value="" selected disabled>Categorias</option>
				<?php
				
					$sql = "SELECT cat.id,cat.nome, card.id AS idCardapio
					FROM t_categoria AS cat, t_cardapio AS card
					WHERE cat.idCardapio = card.id
					AND card.idUsuario = $idUsuarioLogado";
					$res = mysqli_query($conexao, $sql);
					echo $total = mysqli_num_rows($res);
					while ($row = mysqli_fetch_array($res)){
						$id_categoria	=	$row['id'];
						$nome_categoria	=	$row['nome'];
						echo "<option value='$id_categoria'>$nome_categoria</option>";
					}
					
				?>
			</select>
			<input onkeyup="moeda(value);javascript:somente_numero(this);" maxlength="8" type="text" class="campo_g" id="preco-ed" name="preco" required placeholder="Preço" />
			<label>Imagem: <?php echo $codigo_path ?></label>
			<div style="display:flex;align-items:center;">
				<img src="" alt="imagem-do-produto" style="width:92px" id="arquivo-ed" />
				<img src="img/icon-img-base.png" class="icone-album" alt="icone album" data-anexo='' onclick="popupAlbum(1);enviaCodeAnexo();" />
				<input type="text" class="campo_g" onkeyup="javascript:somente_numero(this);" style="width:54%;margin:0" placeholder="Código da imagem do banco" id="file-base-ed" name="id_file_base" />
			</div>

			<img src="img/fio-ou-popup.png" alt="fio" class="fio-popup" style="margin:20px 0 20px 0"/>
			
			<input type="file" onchange="preview(1)" class="campo_g" accept=".jpg,.jpeg,.png" id="arquivo" name="arquivo" />
			<i style="width:94%;">Tamanho indicado: 700px x 500px (Ratio 14:10) </i>
			<h6 style="font-size:14px;display:none;" class="alert-error" id="alerta-erro-file"></h6>
			
			<section id="box-preview" class="box-preview" style="display:none">
				<img src="" id="previsao" alt="preview" width="100" />
				<img src="img/btn-excluir.png"  class="btn-excluir-anexo" alt="botao-excluir" id="apagar" onclick="preview(0)">
			</section>
			
			<span class="box-checkbox">
				<div style="display:flex;align-items:center;margin-top:15px;">
					<img src="img/btn-check-off.png" id="checkbox" onclick="checaPromocao();" class="input_check" alt="checkbox"/>
					<label style="margin-bottom:0;">Em promoção</label>
				</div>
				<input type="hidden" name="promocao" value="NORMAL" id="promocao" />
			</span>
			<div class="box-submit">
				<input type="submit" class="btn-submit" value="Cadastrar" />
			</div>
			
		</div>
		
		<input type="hidden" name="idItem" id="idItem" />
		<input type="hidden" name="idCardapio" id="idCardapio" />
		<input type="hidden" name="idCategoria" id="idCategoria" />
		<input type="hidden" name="status" id="status" />
	</form>
	
</section>




<!-- POPUP BANCO DE IMAGENS -->
<section id="popup-album" class="popup_cadastro" style="background:#e3e3e3;z-index:100;height:350px">
	<h4 class="titulo_popup">Banco de imagens <span onclick="popupAlbum(0);" class="btn-fechar-popup">&#215;</span></h4>
	<iframe id="meuIframe" name="banco" src="modules/itens/banco_categoria.php" class="iframe_file"></iframe>
	<span><img src="" class="img-anexo-banco" alt="imgem anexo" id="img_anexo_bd" width="100"></span>
	<script src="./js/popup_enviaCodeAnexo.js"></script>
	<script>
		let valorDoAnexo = enviaCodeAnexo();
		//alert(valorDoAnexo);
	</script>
</section>


<script>
	//carrega preview do anexo
	document.addEventListener('click', function(event) {
		let img = document.getElementById("arquivo").value;
		if( (img.length>0) && (!event.target.closest('#arquivo')) ){
			document.getElementById("alerta-erro-file").style.display='none';
			validarAspectRatio();
			return false;
		}
	});
</script>

<script src="./js/popup_crud_item.js"></script>
<script src="./js/popup-album.js"></script>
<script src="./js/ratio.js"></script>
<script src="./js/preview.js"></script>
<script src="./js/numeros.js"></script>
<script src="./js/moeda.js"></script>



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
	<select id="categoria" onchange="filtraCategoria(this)">
		<option selected disabled>Categorias</option>
		<?php
			
			$sql = "SELECT cat.id,cat.nome, card.id AS idCardapio
			FROM t_categoria AS cat, t_cardapio AS card 
			WHERE cat.idCardapio = card.id
			AND card.idUsuario = $idUsuarioLogado";
			$res = mysqli_query($conexao, $sql);
			$total = mysqli_num_rows($res);
			while ($row = mysqli_fetch_array($res)){
				$id_categoria	=	$row['id'];
				$nome_categoria	=	$row['nome'];
				$idCardapio	=	$row['idCardapio'];
				echo "<option value='$id_categoria'>$nome_categoria</option>";
			}
		?>
	</select>
	<div class="box-filtro">
		<input type="name" id="cod" value="" placeholder="Código ou Título" />
		<button onclick="filtraCodigo()">Buscar</button>
	</div>
	<button onclick="popupCadastro(1);">+ Novo</button>

<div>
	<?php
	if(!empty($categoria)){
		echo "<a href='index.php?m=5'><span class='tagFiltro'>$nome_categoria_filtro &nbsp;<i class='fa fa-times' aria-hidden='true'></i></span></a>";
	}
	if(!empty($codigo)){
			echo "<a href='index.php?m=5'><span class='tagFiltro'>Cod.: $codigo &nbsp;<i class='fa fa-times' aria-hidden='true'></i></span></a>";
	}
	?>
</div>
</section>



<section class="box-registros">
	<?php
		
		if(($codigo>0)&&(empty($categoria))){
			//echo "por codigo";
			
			$sql = "SELECT ti.*, tc.codigo_path AS codpath
			FROM t_item AS ti, t_customiza AS tc
			WHERE ti.idCardapio=$idCardapio 
			AND ti.cod_item=$codigo
			AND tc.idCardapio=ti.idCardapio";
			$res = mysqli_query($conexao, $sql);
			$total = mysqli_num_rows($res);
			
			while ($row = mysqli_fetch_array($res)) {
				$id_item       = $row['id'];
				$cod_item      = $row['cod_item'];
				$nome_item     = $row['titulo'];
				$descricao_item = $row['descricao'];
				$preco_item    = $row['preco'];
				$foto_item     = $row['foto'];
				$fotobd_item   = $row['foto_bd'];
				$tipo_item     = $row['tipo'];
				$statuso_item  = $row['status'];
				$idCardapio    = $row['idCardapio'];
				$idCategoria   = $row['idCategoria'];
				$codigo_path   = $row['codpath'];
				
				$nome_item = substr($nome_item, 0, 22);

				// Se existir imagem do banco
				if($fotobd_item){
					
				}
				
				// Cria o array PHP
				$vetor = array(
					$id_item,
					$cod_item,
					$nome_item,
					$descricao_item,
					$preco_item,
					$foto_item,
					$fotobd_item,
					$tipo_item,
					$statuso_item,
					$idCardapio,
					$idCategoria,
					$codigo_path
				);
				
				// Converte o array PHP para uma string JSON
				$vetor_json = json_encode($vetor);
				$vetorJson = htmlspecialchars($vetor_json, ENT_QUOTES, 'UTF-8');
				
				echo "
				<div class='col4'>
				<div class='card-registro card4'>
				<span>$cod_item - $nome_item</span>
				<div style='display:flex;'>
				<img src='img/btn-editar.png' onclick='popupEdita(1, $id_item); processarVetor($vetorJson)' class='btn-actions' alt='botão editar' />
				<a href='index.php?m=52&item=$id_item&cnf=false'><img src='img/btn-excluir.png' class='btn-actions less-right' alt='botão excluir' /></a>
				</div>
				</div>
				</div>
				";
			}
			if($total<1){
				echo "<h5 class='alert-notification'><i class='fa fa-exclamation-circle icon-alert' aria-hidden='true'></i>&nbsp; Não há resultado para sua busca.<h5>";
			}
			
		}
		else if(($categoria>0)&&($codigo<1)){
			//echo "por categoria";
			
			$sql = "SELECT ti.*, tc.codigo_path AS codpath
			FROM t_item AS ti, t_customiza AS tc
			WHERE tc.idCardapio=$idCardapio 
			AND ti.idCategoria=$categoria
			AND tc.idCardapio=ti.idCardapio";
			$res = mysqli_query($conexao, $sql);
			$total = mysqli_num_rows($res);
			while ($row = mysqli_fetch_array($res)) {
				$id_item       = $row['id'];
				$cod_item      = $row['cod_item'];
				$nome_item     = $row['titulo'];
				$descricao_item = $row['descricao'];
				$preco_item    = $row['preco'];
				$foto_item     = $row['foto'];
				$fotobd_item   = $row['foto_bd'];
				$tipo_item     = $row['tipo'];
				$statuso_item  = $row['status'];
				$idCardapio    = $row['idCardapio'];
				$idCategoria   = $row['idCategoria'];
				$codigo_path   = $row['codpath'];
				
				$nome_item = substr($nome_item, 0, 22);
				
				// Cria o array PHP
				$vetor = array(
				$id_item,
				$cod_item,
				$nome_item,
				$descricao_item,
				$preco_item,
				$foto_item,
				$fotobd_item,
				$tipo_item,
				$statuso_item,
				$idCardapio,
				$idCategoria,
				$codigo_path
				);
				
				// Converte o array PHP para uma string JSON
				$vetor_json = json_encode($vetor);
				$vetorJson = htmlspecialchars($vetor_json, ENT_QUOTES, 'UTF-8');
				
				echo "
				<div class='col4'>
				<div class='card-registro card4'>
				<span>$cod_item - $nome_item</span>
				<div style='display:flex;'>
				<img src='img/btn-editar.png' onclick='popupEdita(1, $id_item); processarVetor($vetorJson)' class='btn-actions' alt='botão editar' />
				<a href='index.php?m=52&item=$id_item&cnf=false'><img src='img/btn-excluir.png' class='btn-actions less-right' alt='botão excluir' /></a>
				</div>
				</div>
				</div>
				";
			}	
			if($total<1){
				echo "<h5 class='alert-notification'><i class='fa fa-exclamation-circle icon-alert' aria-hidden='true'></i>&nbsp; Não há resultados para sua busca.<h5>";
			}		
			
		}
		else{
			//echo "padrao";
			
			$sql = "SELECT ti.*, tc.codigo_path AS codpath, tc.idUsuario AS idusuario
			FROM t_item AS ti, t_customiza AS tc
			WHERE ti.idCardapio = $idCardapio
			AND tc.idCardapio = ti.idCardapio";
			$res = mysqli_query($conexao, $sql);
			$total = mysqli_num_rows($res);
			
			while ($row = mysqli_fetch_array($res)) {
				$id_item       = $row['id'];
				$cod_item      = $row['cod_item'];
				$nome_item     = $row['titulo'];
				$descricao_item = $row['descricao'];
				$preco_item    = $row['preco'];
				$foto_item     = $row['foto'];
				$fotobd_item   = $row['foto_bd'];
				$tipo_item     = $row['tipo'];
				$statuso_item  = $row['status'];
				$idCardapio    = $row['idCardapio'];
				$idCategoria   = $row['idCategoria'];
				$codigo_path   = $row['codpath'];
				$idUsuario   	 = $row['idusuario'];

				$nome_item = substr($nome_item, 0, 22);

				 if(!empty($fotobd_item)){
				 	[$idcategoria, $iditem] = explode('.', $fotobd_item);

					$cons = "SELECT imagem FROM t_mymenu_files WHERE id = $iditem AND categoria = $idcategoria";
					$resp = mysqli_query($conexao, $cons);
					while ($row = mysqli_fetch_array($resp)) {
						$imagemBd = $row['imagem'];
					}
					$imagem_item =  "files-base+".$imagemBd;
					
				}
				else{
					$imagem_item = "files+".$idUsuario."-".$codigo_path."+".$foto_item;
				}
				
				// Cria o array PHP
				$vetor = array(
					$id_item,
					$cod_item,
					$nome_item,
					$descricao_item,
					$preco_item,
					$imagem_item,
					$tipo_item,
					$statuso_item,
					$idCardapio,
					$idCategoria,
					$codigo_path,
					$idUsuario
				);
				
				// Converte o array PHP para uma string JSON
				$vetor_json = json_encode($vetor);
				$vetorJson = htmlspecialchars($vetor_json, ENT_QUOTES, 'UTF-8');
				
				echo "
				<div class='col4'>
				<div class='card-registro card4'>
				<span>$cod_item - $nome_item</span>
				<div style='display:flex;'>
				<img src='img/btn-editar.png' onclick='popupEdita(1, $id_item); processarVetor($vetorJson)' class='btn-actions' alt='botão editar' />
				<a href='index.php?m=52&item=$id_item&cnf=false'><img src='img/btn-excluir.png' class='btn-actions less-right' alt='botão excluir' /></a>
				</div>
				</div>
				</div>
				";
			}
			if($total<1){
				echo "<h5 class='alert-notification'><i class='fa fa-exclamation-circle icon-alert' aria-hidden='true'></i>&nbsp; Não há registros<h5>";
			}
			
		}
		
	?>
</section>



<script>
	// Add imagem do banco
	window.addEventListener('message', function(event) {
		
		const idRecebidoDoIframe = event.data;
		
		if (idRecebidoDoIframe) {
			//document.getElementById('idRecebido').innerText = idRecebidoDoIframe;
			document.getElementById('file-base').value = idRecebidoDoIframe;
			document.getElementById('popup-album').style.display = 'none';
		}
	});

	function filtraCategoria(el){
		let categoria = el.value;
		window.location='index.php?m=5&cat='+categoria; 
	}
	
	function filtraCodigo(){
		let codigo = document.getElementById('cod').value;
		window.location='index.php?m=5&cod='+codigo; 
	}	
	
</script>