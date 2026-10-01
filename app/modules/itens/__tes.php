<?php
	// Seu vetor PHP
	$vetor = array(2, 5, 'ola');
	
	// Codifica o vetor para uma string JSON
	$vetorJson = json_encode($vetor);
?>

<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Passando Dados PHP para JS</title>
	</head>
	<body>
		
		<h1>Exemplo de Passagem de Dados PHP para JS</h1>
		
		<button onclick="processarVetor(<?php echo htmlspecialchars($vetorJson, ENT_QUOTES, 'UTF-8'); ?>)">Processar Dados do Vetor</button>
		
		<script>
			// A função JavaScript agora espera um parâmetro (o vetor)
			function processarVetor(arrayRecebido) {
				// Desestruturando o array para variáveis individuais
				const [numero1, numero2, texto] = arrayRecebido;
				
				
				alert(numero1);
				// Exibindo os valores no console
				//console.log(`Função processarVetor executada!`);
				console.log(`Número 1: ${numero1}`);
				console.log(`Número 2: ${numero2}`);
				console.log(`Texto: ${texto}`);
			}
		</script>
		
	</body>
</html>