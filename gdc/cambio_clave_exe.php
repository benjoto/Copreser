<?php
session_start();
include_once '../dbconnect.php';
if(!isset($_SESSION['user']))
{
 header("Location: ../index.php");
}
?>
<?php

date_default_timezone_set('America/Santiago');

$link = mysqli_connect("localhost", "root", "", "copreser_intranet");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security
$password = md5(mysqli_real_escape_string($link, $_REQUEST['password']));
$id = $_SESSION['user_id'];


// attempt insert query execution
$sql = "UPDATE users SET password='$password' WHERE user_id='$id'";
if(mysqli_query($link, $sql))
	{
		header("Location: index.php");
	}
	else
	{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	}
 
// close connection
mysqli_close($link);
?>