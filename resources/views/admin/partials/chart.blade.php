<canvas id="{{ $chartId }}" style="max-width: 600px;" class="w-100 h-auto mx-auto d-block"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dataValues = @json($data);
    const labels = @json($labels);

    const ctx = document.getElementById('{{ $chartId }}').getContext('2d');

    if (dataValues.reduce((acc, val) => acc + val, 0) === 0) {
        displayNoDataMessage();
    } else {
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: '{{ $chartLabel }}',
                    data: dataValues,
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
                            padding: 15
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                const total = dataValues.reduce((acc, curr) => acc + curr, 0);
                                const value = tooltipItem.raw;
                                const percentage = ((value / total) * 100).toFixed(2);
                                return `${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        window.addEventListener('resize', function() {
            chart.resize();
        });
    }

    function displayNoDataMessage() {
        ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
        ctx.font = "20px Arial";
        ctx.fillStyle = "#000";
        ctx.textAlign = "center";
        ctx.textBaseline = "middle";
        ctx.fillText("No Data Available", ctx.canvas.width / 2, ctx.canvas.height / 2);
    }
</script>
