<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerta de Gastos</title>
</head>
<body>
    <h1>Alerta de Gastos</h1>
    <p>Olá, {{ $dados->user->name ?? 'Usuário' }}</p>

    <p>Seu gasto atual é de R$ {{ number_format($dados->valor, 2, ',', '.') }}</p>
    <p>O limite de gastos que você definiu é de R$ {{ number_format($dados->limite_gastos ?? 1000, 2, ',', '.') }}</p>
    <p>Considere revisar seus gastos para evitar despesas acima do seu limite.</p>

    <a href="{{ url('/despesas') }}">Verificar despesas</a>

    <p>Obrigado por utilizar nosso sistema de controle de custos!</p>
</body>
</html>