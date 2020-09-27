<?php

require 'auth/isAuth.php';

// isAuth();

$fighter = json_encode($_POST['fighter']);
$power = json_encode($_POST['power']);
$created_at = json_encode($_POST['created_at']);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>グラフ</title>
</head>
<body>
    <!-- グラフを表示 -->
    <canvas id="myChart"></canvas>

    <div>
        <a href="./mainForm.php">データの入力はこちら</a>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>
        let $fighter = JSON.parse('<?= $fighter; ?>')
        let $created_at = JSON.parse('<?= $created_at; ?>')
        let $power = JSON.parse('<?= $power; ?>')

        function getVal ($val)
        {
            return $val.join(',')
        }

        let myData = document.getElementById('myChart')
        let chart = new Chart(myData, {
            type: 'line',
            data: {
                // created_atカラム
                labels: $created_at,
                datasets: [{
                    label: $fighter,
                    backgroundColor: 'orange',
                    borderColor: 'blue',
                    // fighterカラム
                    data: $power
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>
</html>