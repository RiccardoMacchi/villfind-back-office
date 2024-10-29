<canvas id="{{ $chartId }}" style="style=position: relative; height:80vh; max-width:90%; min-width:200px"
    class="w-100 h-auto mx-auto my d-block"></canvas>

<script>
    const dataValues_{{ $chartId }} = @json($data);
    const labels_{{ $chartId }} = @json($labels);

    // grafico in base all'ID della statistica
    const ctx_{{ $chartId }} = document.getElementById('{{ $chartId }}').getContext('2d');

    if (dataValues_{{ $chartId }}.reduce((acc, val) => acc + val, 0) === 0) {
        displayNoDataMessage(ctx_{{ $chartId }});
    } else {
        const chart_{{ $chartId }} = new Chart(ctx_{{ $chartId }}, {
            type: 'bar',
            data: {
                labels: labels_{{ $chartId }},
                datasets: [{
                    label: '{{ $chartLabel }}',
                    data: dataValues_{{ $chartId }},
                    backgroundColor: @json($backgroundColors),
                    borderColor: @json($borderColors),
                    borderWidth: 2
                }]
            },
            options: {
                devicePixelRatio: 2,
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            padding: 30,
                            font: {
                                weight: 'bold',
                                size: 15
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                const total = dataValues_{{ $chartId }}.reduce((acc, curr) => acc +
                                    curr, 0);
                                const value = tooltipItem.raw;
                                const percentage = ((value / total) * 100).toFixed(2);
                                return `${value} (${percentage}%)`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            color: 'black',
                            font: {
                                weight: '900',
                                size: 15
                            }
                        },
                        grid: {
                            color: '#ccc'
                        }
                    },
                    x: {
                        ticks: {
                            color: 'black',
                            font: {
                                weight: '900',
                                size: 15
                            }
                        },
                        grid: {
                            color: '#ccc'
                        }
                    }
                }
            }
        });

        window.addEventListener('resize', function() {
            chart_{{ $chartId }}.resize();
        });
    }

    // dati mancanti
    function displayNoDataMessage(ctx) {
        ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
        ctx.font = "15px Arial";
        ctx.fillStyle = "#000";
        ctx.textAlign = "center";
        ctx.textBaseline = "middle";
        ctx.fillText("No Data Available", ctx.canvas.width / 2, ctx.canvas.height / 2);
    }
</script>
