<?php
require_once '../connect.php'; // Ensure this includes your database connection
session_start();

header('Content-Type: application/json'); // Ensure JSON response

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['success' => false, 'error' => 'Unauthorized: Admin not logged in.']);
    exit(); // Ensure no further code is executed
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get the poll title and selections from the POST request
        $title = $_POST['title'] ?? '';
        $question1 = $_POST['answer1'] ?? '';
        $question2 = $_POST['answer2'] ?? '';
        $question3 = $_POST['answer3'] ?? '';
        $question4 = $_POST['answer4'] ?? '';

        // Validate input (you can add more robust validation)
        if (empty($title) || empty($question1) || empty($question2)) {
            throw new Exception("Poll title, Question 1, and Question 2 are required.");
        }

        // Prepare the insert query
        $insertQuery = "INSERT INTO polls (question, selection1, selection2, selection3, selection4) 
                        VALUES (:title, :selection1, :selection2, :selection3, :selection4)";
        $insertStmt = $pdo->prepare($insertQuery);
        $insertStmt->execute([
            'title' => $title,
            'selection1' => $question1,
            'selection2' => $question2,
            'selection3' => $question3,
            'selection4' => $question4,
        ]);

        // Successful insert
        echo json_encode(['success' => true, 'message' => 'Poll created successfully.']);
    } catch (Exception $e) {
        // Return error response
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    // Return an error if the request is not POST
    echo json_encode(['success' => false, 'error' => 'Invalid request method. Only POST is allowed.']);
}
?>
