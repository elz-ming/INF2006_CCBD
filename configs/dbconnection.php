<?php
require_once "constant.php";

$conn = new mysqli(Host_Name, Database_User, Password,Database_Name);

if ($conn->connect_error){
	die("Connection Failed: ". $conn->connect_error);
}
?>