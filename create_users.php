<?php

require_once 'connect.php'; 

session_start();

// Set session to expire after 1 day
if (!isset($_SESSION['created'])) {
    $_SESSION['created'] = time();

    // Generate a unique 8-digit user ID using a custom PostgreSQL function
    $sql = "SELECT generate_unique_8_digit_user() AS newid";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $userId = $row['newid']; 
    
    // Current timestamp
    $currentTimestamp = date('Y-m-d H:i:s');
    
    // Insert the new user into the database
    $sql = "INSERT INTO users (userid, created_at) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId, $currentTimestamp]);
    
    $_SESSION['userid'] = $userId;
    
    } 

else if (time() - $_SESSION['created'] > 86400) { // 86400 seconds = 24 hours
    session_unset();   
    session_destroy();  
    header("Location: index.php"); // redirect to poll page
    exit;
}



?>
