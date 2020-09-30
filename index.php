<?php

require 'auth/isAuth.php';

session_start();
isAuth();

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
        <button onclick="location.href='./mainForm.php'">データの入力はこちら</button>
    </div>
    <form action="./delete.php" method="post" id="deleteForm">
        <input type="hidden" name="fighter" value="<?= $_POST['fighter']; ?>">
    </form>
    <div>
        <button id="delete">データの削除はこちら</button>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>
        // グラフを描画
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
                    // powerカラム
                    data: $power,
                    lineTension: 0,
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

        // フォームを送信
        document.getElementById('delete').addEventListener('click', function() {
            document.getElementById('deleteForm').submit();
        });
    </script>
</body>
</html>