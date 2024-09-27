<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poll Results</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php include '../components/background.php'; ?>
    <?php include '../components/header.php'; ?>

    <h1>Poll Results</h1>
    <link rel="stylesheet" href="/css/styles.css" />
    <div class="charts" style = "padding=100px">
        <?php
        $polls = [
            ['question' => 'Favorite Color?', 'options' => ['Red', 'Blue', 'Green'], 'votes' => [10, 15, 5]],
            ['question' => 'Best Programming Language?', 'options' => ['PHP', 'JavaScript', 'Python'], 'votes' => [20, 30, 25]],
            ['question' => 'Favorite Fruit?', 'options' => ['Apple', 'Banana', 'Orange'], 'votes' => [12, 8, 10]],
            ['question' => 'Preferred IDE?', 'options' => ['VS Code', 'PHPStorm', 'Sublime Text'], 'votes' => [25, 15, 10]]
        ];

        foreach ($polls as $index => $poll) {
            echo '<h2>' . $poll['question'] . '</h2>';
            echo '<canvas id="chart' . $index . '"></canvas>';
            echo '<script>
                var ctx = document.getElementById("chart' . $index . '").getContext("2d");
                var chart = new Chart(ctx, {
                    type: "pie",
                    data: {
                        labels: ' . json_encode($poll['options']) . ',
                        datasets: [{
                            data: ' . json_encode($poll['votes']) . ',
                            backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0", "#9966FF", "#FF9F40"]
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
            </script>';
        }
        ?>
    </div>

    <?php include '../components/footer.php'; ?>
</body>
</html>