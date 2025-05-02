<!DOCTYPE html>
<html>
<head>
    <title>Alerta de Gastos</title>
</head>
<body>
    <h1>Alerta de Gastos Semanais</h1>
    <p>O total de despesas da semana ultrapassou o limite:</p>
    <p><strong>Total gasto:</strong> R$ {{ number_format($total, 2, ',', '.') }}</p>
</body>
</html>
