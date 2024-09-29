<?php
require_once '../connect.php'; // Make sure connect.php is correctly set up for your database connection

// Fetch poll data from the database
try {
  // Query to fetch polls and their vote count, ordered by the most recent vote or creation date
  $query = '
    SELECT 
      p.id, p.question, 
      p.selection1, p.selection1_count, 
      p.selection2, p.selection2_count, 
      p.selection3, p.selection3_count, 
      p.selection4, p.selection4_count,
      MAX(v.created_at) AS last_voted
    FROM polls p
    LEFT JOIN votes v ON p.id = v.poll_id
    GROUP BY p.id
    ORDER BY (MAX(v.created_at) IS NULL), MAX(v.created_at) DESC, p.created_at DESC'; 
    // Sort by: polls with votes first, then by latest vote, and finally by poll creation date for empty polls

  $stmt = $pdo->query($query);
  $polls = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  // Handle any errors
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
        $labels = json_encode([
          $poll['selection1'],
          $poll['selection2'],
          isset($poll['selection3']) ? $poll['selection3'] : null,
          isset($poll['selection4']) ? $poll['selection4'] : null
        ]);

        $data = json_encode([
          $poll['selection1_count'],
          $poll['selection2_count'],
          isset($poll['selection3_count']) ? $poll['selection3_count'] : 0,
          isset($poll['selection4_count']) ? $poll['selection4_count'] : 0
        ]);

        echo '
        var ctx' . $index . ' = document.getElementById("chart' . $index . '").getContext("2d");
        var chart' . $index . ' = new Chart(ctx' . $index . ', {
          type: "pie",
          data: {
            labels: ' . $labels . ',
            datasets: [{
              data: ' . $data . ',
              backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0"]
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
