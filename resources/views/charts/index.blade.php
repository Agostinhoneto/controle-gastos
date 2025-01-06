@include('layouts.topo')
@extends('layout')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficos com Chart.js</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Estilo adicional para garantir que o gráfico se ajuste bem */
        #despesasReceitasChart {
            max-width: 100%;
            height: 400px;
            margin: 20px 0;
        }
    </style>
</head>

@include('layouts.sidebar')

<body>
    <div style="width: 80%; margin: auto;">
        <canvas id="despesasReceitasChart"></canvas>
    </div>
    <script>
        const ctx = document.getElementById('despesasReceitasChart').getContext('2d');

        const data = {
            labels: @json($meses), // Passa os meses
            datasets: [{
                    label: 'Despesas',
                    data: @json($despesasTotais), // Passa os totais de despesas
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
                    hoverBackgroundColor: 'rgba(255, 99, 132, 0.7)', // Cor ao passar o mouse
                    hoverBorderColor: 'rgba(255, 99, 132, 1)',
                    borderRadius: 4, // Bordas arredondadas
                    borderSkipped: false, // Evitar que as bordas se sobreponham
                },
                {
                    label: 'Receitas',
                    data: @json($receitasTotais), // Passa os totais de receitas
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    hoverBackgroundColor: 'rgba(54, 162, 235, 0.7)',
                    hoverBorderColor: 'rgba(54, 162, 235, 1)',
                    borderRadius: 4,
                    borderSkipped: false,
                }
            ]
        };

        const config = {
            type: 'bar', // Tipo de gráfico: bar
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14, // Tamanho da fonte da legenda
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: 'rgba(0, 0, 0, 0.7)', // Cor de fundo do tooltip
                        titleFont: {
                            size: 16
                        },
                        bodyFont: {
                            size: 14
                        },
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': R$ ' + tooltipItem.raw.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                size: 14, // Tamanho da fonte dos ticks no eixo X
                            }
                        }
                    },
                    y: {
                        ticks: {
                            font: {
                                size: 14, // Tamanho da fonte dos ticks no eixo Y
                            },
                            callback: function(value) {
                                return 'R$ ' + value.toLocaleString(); // Exibir valores com formato monetário
                            }
                        }
                    }
                },
                animation: {
                    duration: 1000, // Tempo de animação do gráfico
                    easing: 'easeOutBounce', // Efeito de animação
                }
            }
        };

        new Chart(ctx, config);
    </script>

</body>

</html>