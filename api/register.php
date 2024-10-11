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

        // Check if the email is already registered
        $checkEmailQuery = "SELECT COUNT(*) FROM admin WHERE email = :email";
        $checkEmailStmt = $pdo->prepare($checkEmailQuery);
        $checkEmailStmt->execute(['email' => $email]);
        $emailExists = $checkEmailStmt->fetchColumn();

        if ($emailExists) {
            throw new Exception("Email is already registered.");
        }

        // Hash the password
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        // Insert new user into the database
        $insertQuery = "INSERT INTO admin (email, password_hash) 
                VALUES (:email, :password_hash)
                RETURNING id"; // Return the generated UUID
        $insertStmt = $pdo->prepare($insertQuery);
        $insertStmt->execute([
            'email' => $email,
            'password_hash' => $passwordHash,
        ]);

        // Fetch the generated UUID
		$adminId = $insertStmt->fetchColumn(); // This retrieves the UUID of the inserted row

        // Store the admin ID in the session
        $_SESSION['admin_id'] = $adminId; 

        // Registration successful
        echo json_encode(['success' => true, 'message' => 'Registration successful. You can now log in.']);

    } catch (Exception $e) {
        // Return error response
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    // Return an error if the request is not POST
    echo json_encode(['success' => false, 'error' => 'Invalid request method. Only POST is allowed.']);
}
?>
