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
$id = mysqli_real_escape_string($link, $_REQUEST['id']);
$motivo = mysqli_real_escape_string($link, $_REQUEST['motivo']);
$fecha_falsa = date("1900-01-01");
$timestamp = date("Y-m-d H:i:s");

// attempt insert query execution
$sql = "UPDATE retiro_en_bodega SET fecha='$fecha_falsa' WHERE id='$id'";
$sql2 = "INSERT INTO anula_retiro_en_bodega_log (id_retiro_en_bodega, motivo, timestamp) VALUES ('$id', '$motivo', '$timestamp')";

if(mysqli_query($link, $sql)){
	if(mysqli_query($link, $sql2)){
		header("Location: autorizados_bodega.php");
	} else{
		echo "ERROR: Could not able to execute $sql2. " . mysqli_error($link);
	}
	} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// close connection
mysqli_close($link);
?>