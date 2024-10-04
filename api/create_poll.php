<?php

require_once '../connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $answer1 = $_POST['answer1'] ?? '';
    $answer2 = $_POST['answer2'] ?? '';
    $answer3 = $_POST['answer3'] ?? '';
    $answer4 = $_POST['answer4'] ?? '';

    // Validate form data
    if (empty($title) || empty($answer1) || empty($answer2)) {
        echo "At least question field 1 and 2 are required.";
        exit;
    }

    // Prepare the SQL query
    $sql = "INSERT INTO polls (question, selection1, selection2, selection3, selection4) VALUES (?, ?, ?, ?, ?)";

    // Initialize the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters
        $stmt->bind_param("sssss", $title, $answer1, $answer2, $answer3, $answer4);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New poll created successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>