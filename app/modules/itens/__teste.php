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

    <button onclick="processarVetor()">Processar Dados do Vetor</button>

    <script>
        // Captura a string JSON do PHP e a armazena em uma variável JavaScript
        // O `<?php echo $vetorJson; ?>` irá imprimir a string JSON diretamente aqui.
        const dadosDoVetorPHP = <?php echo $vetorJson; ?>;

        // Agora, dadosDoVetorPHP é um array JavaScript nativo: [2, 5, "ola"]
        console.log("Dados recebidos do PHP (tipo:", typeof dadosDoVetorPHP, "):", dadosDoVetorPHP);

        // A função JavaScript que será chamada pelo botão
        function processarVetor() {
            // No nosso caso, dadosDoVetorPHP já é um array JS, então podemos usá-lo diretamente.
            const arrayRecebido = dadosDoVetorPHP;

            // Desestruturando o array para variáveis individuais
            const [numero1, numero2, texto] = arrayRecebido;

            // Exibindo os valores no console
            console.log(`Função processarVetor executada!`);
            console.log(`Número 1: ${numero1}`);
            console.log(`Número 2: ${numero2}`);
            console.log(`Texto: ${texto}`);
        }
    </script>

</body>
</html>