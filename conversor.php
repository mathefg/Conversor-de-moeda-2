<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de moedas 1.0</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <h1>Conversor de moeda</h1>
        <?php 
        $moeda=$_REQUEST['valor'];
        //Cotação vinda da API do banco central
        $inicio= date("m-d-Y" , strtotime("-7 days"));
        $fim= date("m-d-Y");
    
        $url='https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''.$inicio .'\'&@dataFinalCotacao=\''.$fim .'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';
        $dados=json_decode(file_get_contents($url), true);
        //é necessario o true no final para que esteja dentro de um array
        
        //var_dump($dados);
    
        $cotação=$dados['value'][0]["cotacaoCompra"];

        $conv=$moeda / $cotação;
        echo"<p> O valor a ser convertido é de R$".number_format($moeda,2);
        echo"<p>O valor em Dolar é <strong> US$".number_format($conv,2) . "</strong></p>";
        echo"Cotação atualizada de acordo com o <strong>Banco Central do Brasil</strong>"
        ?>
        <button onclick="javascript:history.go(-1)">&#x1F519 Voltar</button>
    </main>
</body>
</html>