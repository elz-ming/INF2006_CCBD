<?php
// Include the database connection
require '../connect.php';



try {
  // Query to fetch data from the test_data table
  $stmt = $pdo->query('SELECT * FROM test_data');



  $data = $stmt->fetchAll();



  // Send the data as JSON response
  echo json_encode($data);

  error_log("Line 3 executed.");
} catch (PDOException $e) {
  // Handle any errors during the fetch
  echo json_encode(['error' => 'Failed to fetch data: ' . $e->getMessage()]);
}
?>