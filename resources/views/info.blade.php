<!-- resources/views/info.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Bem-vindo ao Sistema de Controle de Gastos</h1>
        <p class="lead">Aqui estão algumas informações sobre a API e como utilizá-la.</p>

        <h2>Endpoints Disponíveis</h2>
        <ul>
            <li><strong>GET /api/users</strong> - Retorna todos os usuários cadastrados.</li>
            <li><strong>POST /api/incomes</strong> - Cadastra uma nova receita.</li>
            <li><strong>GET /api/expenses</strong> - Retorna todas as despesas cadastradas.</li>
        </ul>

        <h2>Documentação</h2>
        <p>
            Consulte a <a href="/docs" target="_blank">documentação completa</a> para detalhes sobre autenticação e uso dos endpoints.
        </p>

        <footer class="mt-5">
            <p>&copy; {{ date('Y') }} Controle de Gastos. Todos os direitos reservados.</p>
        </footer>
    </div>
</body>

</html>
