<!DOCTYPE html>
<html>
<head>
    <title>Nova Despesa</title>
</head>
<body>
    <h1>Nova Despesa Registrada</h1>
    <p>Olá {{ $user->name }},</p>
    
    <p>Uma nova despesa foi registrada:</p>
    <ul>
        <li>Descrição: {{ $despesa->descricao }}</li>
        <li>Valor: R$ {{ number_format($despesa->valor, 2, ',', '.') }}</li>
        <li>Data: {{ \Carbon\Carbon::parse($despesa->data_pagamento)->format('d/m/Y') }}</li>
    </ul>
    
    
    <p>Atenciosamente,<br>
    {{ config('app.name') }}</p>
</body>
</html>