<?php
session_start();
include_once '../dbconnect.php';

if(!isset($_SESSION['user']))
{
 header("Location: ../index.php");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<title>COPRESER INTRANET</title>
<style>
table {
    border-collapse: collapse;
	font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif;
}
th, td {
    padding: 8px;
    text-align: left;
    border: 1px solid #ddd;
}
th {
    background-color: #4CAF50;
    color: white;
}
tr:nth-child(even) {background-color: #f2f2f2;}
tr:hover {background-color:#9c9c9c;color:white}
</style>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel="icon" type="image/png" sizes="16x16" href="../favicon.ico">
</head>
<body>

<?php

date_default_timezone_set('America/Santiago');


echo "<center><img src='imagenes/logo_metro.jpg'></center><br>";
echo "<hr>";
echo "<font face='helvetica' size=4><b>Bienvenido " . strtoupper($_SESSION['nombre']) . "</b> (<a href='../logout.php?logout'>cerrar sesion</a>)</font>";
echo "<hr>";
echo "<font face='helvetica' size=4><a href='visita_cliente.php'>Volver al listado de autorizados</a></font><hr>";

include "connection.php";

?>

<center>
<br>
<font face="Helvetica" size=4><b>INGRESO DE NUEVA AUTORIZACION DE VISITA CLIENTE</b></font><br>
<br>
<br>
<form action="autoriza_visita_cliente_exe.php" method="post">
<table>
<tr>
<td>NOMBRE EMPRESA</td>
<td>:</td>
<td><input type="text" name="nombre_empresa"></td>
<td>NOMBRE CLIENTE</td>
<td>:</td>
<td><input type="text" name="nombre_cliente"></td>
<td>RUT CLIENTE</td>
<td>:</td>
<td><input type="text" name="rut_cliente"></td>
</tr>
<tr>
<td>PATENTE VEHICULO</td>
<td>:</td>
<td><input type="text" name="patente_vehiculo"></td>
<td>FECHA</td>
<td>:</td>
<td><input type="date" name="fecha"></td>
<td>HORA APROX</td>
<td>:</td>
<td><input type="time" name="hora_aprox"></td>
</tr>
<tr>
<td>MARCA TEMPORAL</td>
<td>:</td>
<td>
<?php
echo date("d/m/Y H:i:s");
?>
</td>
<td>AUTORIZADO POR</td>
<td>:</td>
<td>
<?php
echo $_SESSION['nombre'];
?>
</td>
<td>VISITA A</td>
<td>:</td>
<td><input type="text" name="visita_a"></td>
</tr>
</table>
<br><br>
<input type="submit" value="AÑADIR AUTORIZACION">
</form>
</center>

</body>
</html>