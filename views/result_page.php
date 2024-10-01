<?php
require_once '../connect.php';
try {
  $query = 'SELECT question, selection1, selection1_count, selection2, selection2_count, selection3, selection3_count, selection4, selection4_count FROM polls';
  $stmt = $pdo->query($query);
  $polls = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Failed to fetch poll data: " . $e->getMessage();
  $polls = []; // Set polls to an empty array if there is an error
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Poll Results</title>
  <link rel="stylesheet" href="/css/styles.css" />
  <link rel="stylesheet" href="/css/result_page.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <?php include '../components/background.php'; ?>
  <?php include '../components/header.php'; ?>

  <main>
    <?php
    foreach ($polls as $index => $poll) {
      echo '<div class="poll-item">';
      echo '<h2>' . htmlspecialchars($poll['question']) . '</h2>';
      echo '<canvas id="chart' . $index . '" width="200" height="200"></canvas>';
      echo '</div>';
    }
    ?>
  </main>
  <?php include '../components/footer.php'; ?>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      <?php
      foreach ($polls as $index => $poll) {
        // Prepare the labels (selections) and data (counts)
        $labels = [];
        $data = [];
        $backgroundColor = ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0"];
        $colors = [];

        if (!is_null($poll['selection1'])) {
          $labels[] = $poll['selection1'];
          $data[] = $poll['selection1_count'];
          $colors[] = $backgroundColor[0];
        }
        if (!is_null($poll['selection2'])) {
          $labels[] = $poll['selection2'];
          $data[] = $poll['selection2_count'];
          $colors[] = $backgroundColor[1];
        }
        if (!is_null($poll['selection3'])) {
          $labels[] = $poll['selection3'];
          $data[] = $poll['selection3_count'];
          $colors[] = $backgroundColor[2];
        }
        if (!is_null($poll['selection4'])) {
          $labels[] = $poll['selection4'];
          $data[] = $poll['selection4_count'];
          $colors[] = $backgroundColor[3];
        }

        $labels = json_encode($labels);
        $data = json_encode($data);
        $colors = json_encode($colors);

        echo '
        var ctx' . $index . ' = document.getElementById("chart' . $index . '").getContext("2d");
        var chart' . $index . ' = new Chart(ctx' . $index . ', {
          type: "pie",
          data: {
            labels: ' . $labels . ',
            datasets: [{
              data: ' . $data . ',
              backgroundColor: ' . $colors . '
            }]
          },
          options: {
            responsive: true
          }
        });
        ';
      }
      ?>
    });
  </script>
  <script src="../js/result_page.js"></script>
</body>

</html>