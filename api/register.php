<!-- not completed code -->
<?php
require_once '../connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$password = $_POST['password'];
	$email = $_POST['email'];
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);

	$sql = "INSERT INTO users (email, password) VALUES (?, ?)";

	if ($stmt = $conn->prepare($sql)) {
		$stmt->bindParam(1, $email);
		$stmt->bindParam(2, $hashed_password);

		if ($stmt->execute()) {
			echo "New user registered successfully.";
		} else {
			echo "Error: " . $stmt->errorInfo()[2];
		}
	} else {
		echo "Error: " . $conn->errorInfo()[2];
	}
}
?>