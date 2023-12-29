<!-- resources/views/reports/pdf.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório PDF</title>
</head>
<body>
    <h1>Relatório PDF</h1>

    <!-- Conteúdo do relatório usando os dados passados do controlador -->
    <p>Descrição : {{ $data['descricao'] }}</p>
    <p>Categorias: {{ $data['id'] }}</p>
    <!-- Adicione mais informações conforme necessário -->
</body>
</html>
