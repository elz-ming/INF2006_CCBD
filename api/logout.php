<?php
// logout.php
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect to the home page
header("Location: /index.php");
exit();
?>