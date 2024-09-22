<?php
    // if the session $_SESSION["control"] is not set on any page that requires the file sessioncontrol.php, the page will be immediately redirected to the index page (unprotected zone) 


	 if (!isset($_SESSION["control"])) {
		header("Location: ./");
		exit();
	}
	$id_session=$_SESSION['control'];
?>  