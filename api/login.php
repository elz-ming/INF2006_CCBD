<?php
require_once '../connect.php'; // Ensure this includes your database connection
session_start();

header('Content-Type: application/json'); // Ensure JSON response

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get the email and password from the POST request
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validate email and password (you can add more robust validation)
        if (empty($email) || empty($password)) {
            throw new Exception("Email and password are required.");
        }

        // Debugging: Log the email being searched
        error_log('Email being searched: ' . $email);

        // Query to fetch the hashed password and admin ID for the provided email
        $fetchAdminQuery = "SELECT id, password_hash FROM admin WHERE email = :email";
        $fetchAdminStmt = $pdo->prepare($fetchAdminQuery);
        $fetchAdminStmt->execute(['email' => $email]);
        $admin = $fetchAdminStmt->fetch(PDO::FETCH_ASSOC);

        // Check if any rows were returned
        if (!$admin || !isset($admin['id'])) {
            throw new Exception("Email not found or ID not available.");
        }

        // Verify the password using password_verify()
        if (!password_verify($password, $admin['password_hash'])) {
            throw new Exception("Invalid password.");
        }

        // Authentication successful
        // Set the session variable to keep the admin logged in
        $_SESSION['admin_id'] = $admin['id']; // Store the admin ID in the session

        echo json_encode(['success' => true, 'message' => 'Login successful']);

    } catch (Exception $e) {
        // Return error response
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    // Return an error if the request is not POST
    echo json_encode(['success' => false, 'error' => 'Invalid request method. Only POST is allowed.']);
}
?>
