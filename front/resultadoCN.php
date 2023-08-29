<?php
include('conexao.php');
require('verifica.php');

$dataAtual = date("Y-m-d");
$data_hora = date("Y-m-d H:i:s");

$acertos = isset($_SESSION['acertos']) ? $_SESSION['acertos'] : 0;
$erros = isset($_SESSION['erros']) ? $_SESSION['erros'] : 0;

$sql1 = "SELECT * FROM `resultado` WHERE data_hora='$dataAtual' AND codUser=$codUser";
$rs1 = $conn->query($sql1);

$mensagem = "";
$botao = "";

if ($acertos == $rs1->num_rows <= 1) {
    $mensagem = "Parabéns! Você acertou! Pronto para a próxima pergunta?";
    $botao = '<a href="questaoCN.php" class="btn-next">Próxima Pergunta</a>';
    echo 'teste1';
} elseif ($acertos >= 2) {
    $mensagem = "Parabéns! Você acertou!";
    $mensagem2 = "Suas tentativas diárias terminaram. Deseja acessar o ranking? Até amanhã!";
    $botao = '<a href="ranking.php" class="btn-next">Acessar Ranking</a>';
    echo 'teste2';
} elseif ($erros == $rs1->num_rows <= 1) {
    $altCorretaCompleta = isset($_SESSION['altCorretaCompleta']) ? $_SESSION['altCorretaCompleta'] : "alternativa desconhecida";
    $mensagem = "Você errou :( A resposta correta era: " . $altCorretaCompleta;
    $botao = '<a href="questaoCN.php" class="btn-next">Próxima Pergunta</a>';
    echo 'teste3';
} elseif ($erros >= 2) {
    $altCorretaCompleta = isset($_SESSION['altCorretaCompleta']) ? $_SESSION['altCorretaCompleta'] : "alternativa desconhecida";
    $mensagem = "Você errou :( A resposta correta era: " . $altCorretaCompleta . ". Suas tentativas diárias terminaram, descanse e tente novamente amanhã ;) Deseja acessar o ranking?";
    $botao = '<a href="ranking.php" class="btn-next">Acessar Ranking</a>';
}

//problemas no $rs1->num_rows
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/resuCN.css">

    <title>Resultado</title>
</head>

<body>
    <div class="mensagem-container">
        <h1><?php echo $mensagem; ?></h1>
        <!-- <h3><?php echo $mensagem2 ?></h3> -->
        <button class="botao1"> 
            <span class="botaoproximo"> <?php echo "<a>$botao</a>" ?></span>
        </button>
        <button class="botao1" style="text-decoration: none; color: #aa422f;"></button>
        <button class="botao2">
            <a href="index.php" target="_self"> Voltar a tela e início </a>
        </button>
    </div>
</body>

</html>
