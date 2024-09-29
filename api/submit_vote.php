<?php
require_once '../connect.php';
session_start();

header('Content-Type: application/json');

try {
  // Ensure the session contains a user_id
  if (!isset($_SESSION['userid'])) {
    throw new Exception('User not logged in.');
  }

  // Retrieve user_id from the session
  $user_id = $_SESSION['userid'];

  // Get data from the POST request
  $input = json_decode(file_get_contents(filename: 'php://input'), true);

  $poll_id = isset($input['poll_id']) ? (int) $input['poll_id'] : 0;
  $selection = isset($input['selection']) ? $input['selection'] : null;

  if (!$poll_id || !$selection) {
    throw new Exception('Missing data.');
  }

  // Start a transaction
  $pdo->beginTransaction();

  // 1st Query: Update the poll's count based on selection
  $updateQuery = "UPDATE polls 
                    SET {$selection}_count = {$selection}_count + 1
                    WHERE id = :poll_id";
  $updateStmt = $pdo->prepare($updateQuery);
  $updateStmt->execute(['poll_id' => $poll_id]);

  // 2nd Query: Insert vote into votes table
  $insertQuery = "INSERT INTO votes (user_id, poll_id, selection, created_at) 
                    VALUES (:user_id, :poll_id, :selection, now())";
  $insertStmt = $pdo->prepare($insertQuery);
  $insertStmt->execute([
    'user_id' => $user_id,
    'poll_id' => $poll_id,
    'selection' => $selection
  ]);

  // Commit the transaction
  $pdo->commit();

  // Return success response
  echo json_encode(['success' => true]);
} catch (Exception $e) {
  // Rollback the transaction on failure
  if ($pdo->inTransaction()) {
    $pdo->rollBack();
  }
  echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>