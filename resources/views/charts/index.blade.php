@include('layouts.topo')
@extends('layout')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficos com Chart.js</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .dark-mode {
            background-color: #121212;
            color: white;
        }
        .dark-mode .card {
            background-color: #1e1e1e;
        }
        #despesasReceitasChart {
            max-width: 100%;
            height: 400px;
            margin: 20px 0;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }
    </style>
</head>

@include('layouts.sidebar')

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-3 shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Controle de Gastos</a>
            <button class="btn btn-outline-dark" id="toggleDarkMode">Modo Escuro</button>
        </div>
    </nav>

    <!-- Conteúdo principal -->
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title text-center mb-4">Despesas e Receitas</h4>
                <div>
                    <canvas id="despesasReceitasChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Configuração do gráfico
        const ctx = document.getElementById('despesasReceitasChart').getContext('2d');
        const data = {
            labels: @json($meses), // Passa os meses
            datasets: [
                {
                    label: 'Despesas',
                    data: @json($despesasTotais), // Dados de despesas
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
                },
                {
                    label: 'Receitas',
                    data: @json($receitasTotais), // Dados de receitas
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                }
            ]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14,
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': R$ ' + tooltipItem.raw.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            callback: function(value) {
                                return 'R$ ' + value.toLocaleString();
                            }
                        }
                    }
                },
            }
        };

        new Chart(ctx, config);

        // Alternância de tema claro/escuro
        const toggleDarkMode = document.getElementById('toggleDarkMode');
        toggleDarkMode.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
        });
    </script>
</body>

</html>
