@include('layouts.topo')
@extends('layout')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficos com Chart.js</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
@include('layouts.sidebar')

<body>
    <div style="width: 80%; margin: auto;">
        <canvas id="despesasReceitasChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('despesasReceitasChart').getContext('2d');

        const data = {
            labels: @json(array_keys($despesas->toArray())), // Meses
            datasets: [
                {
                    label: 'Despesas',
                    data: @json(array_values($despesas->toArray())), // Totais de despesas
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Receitas',
                    data: @json(array_values($receitas->toArray())), // Totais de receitas
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }
            ]
        };

        const config = {
            type: 'bar', // Tipo de gráfico: bar, line, pie, etc.
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        };

        new Chart(ctx, config);
    </script>
</body>
</html>
