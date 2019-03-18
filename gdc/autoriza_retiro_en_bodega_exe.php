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
$nombre_empresa = mysqli_real_escape_string($link, $_REQUEST['nombre_empresa']);
$nombre_chofer = mysqli_real_escape_string($link, $_REQUEST['nombre_chofer']);
$rut_chofer = mysqli_real_escape_string($link, $_REQUEST['rut_chofer']);
$patente_vehiculo = mysqli_real_escape_string($link, $_REQUEST['patente_vehiculo']);
$fecha = mysqli_real_escape_string($link, $_REQUEST['fecha']);
$hora_aprox = mysqli_real_escape_string($link, $_REQUEST['hora_aprox']);
$timestamp = date("Y-m-d H:i:s");
$autorizado_por = $_SESSION['nombre'];

$nombre_empresa = strtoupper($nombre_empresa);
$nombre_chofer = strtoupper ($nombre_chofer);
$rut_chofer = strtoupper ($rut_chofer);
$patente_vehiculo = strtoupper ($patente_vehiculo);

// attempt insert query execution
$sql = "INSERT INTO retiro_en_bodega (nombre_empresa, nombre_chofer, rut_chofer, patente_vehiculo, fecha, hora_aprox, autorizado_por, timestamp) VALUES ('$nombre_empresa', '$nombre_chofer', '$rut_chofer', '$patente_vehiculo', '$fecha', '$hora_aprox', '$autorizado_por', '$timestamp')";
if(mysqli_query($link, $sql))
	{
		header("Location: autorizados_bodega.php");
	}
	else
	{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	}
 
// close connection
mysqli_close($link);
?>