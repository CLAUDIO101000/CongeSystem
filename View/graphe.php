<?php
include_once '../Controller/function.php';

$congesParMois = getCongesParMois();

$totalConges = array_sum(array_column($congesParMois, 'total'));
$pourcentages = array();

foreach ($congesParMois as $moisData) {
    $mois = $moisData['mois'];
    $total = $moisData['total'];
    $pourcentages[$mois] = ($total / $totalConges) * 100;
}

$moisLabels = ["Jan", "Fev", "Mar", "Avr", "Mai", "Juin", "Juil", "Aoû", "Sep", "Oct", "Nov", "Dec"];
$pourcentagesParMois = array_fill(0, 12, 0);

foreach ($pourcentages as $mois => $pourcentage) {
    $pourcentagesParMois[$mois - 1] = $pourcentage;
}
?>

<div class="chart-container">
    <canvas id="congeChart"></canvas>
</div>
<script>
    const ctx = document.getElementById('congeChart').getContext('2d');
    const congeChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($moisLabels); ?>,
            datasets: [{
                label: 'Pourcentage de Congés',
                data: <?php echo json_encode($pourcentagesParMois); ?>,
                backgroundColor: 'rgba(45, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        callback: function(value) {
                            return value + "%";
                        }
                    }
                }
            }
        }
    });
</script>