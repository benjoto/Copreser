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
echo "<font face='helvetica' size=4><a href='autorizados_bodega.php'>Volver al listado de autorizados</a></font><hr>";

include "connection.php";

?>

<center>
<br>
<font face="Helvetica" size=4><b>ANULAR RETIRO EN BODEGA</b></font><br>
<br>
<form action="anula_retiro_en_bodega_exe.php" method="post">
<table>
<tr>
<td>ID</td>
<td>:</td>
<td>
<select name="id">
<?php
$cn=mysql_connect("localhost",'root', '') or die("Note: " . mysql_error());
$res=mysql_select_db("copreser_intranet",$cn) or die("Note: " . mysql_error());
$res=mysql_query("SELECT * FROM retiro_en_bodega WHERE fecha='" . date('Y-m-d') . "';") or die("Note: " . mysql_error());
while($ri = mysql_fetch_array($res)){
echo "<option value=" .$ri['id'] . ">" . $ri['id'] . "</option>";
}
?>
</select>
</td>
</tr>
<tr>
<td>MOTIVO</td>
<td>:</td>
<td><input type="text" name="motivo"></td>
</tr>
</table>
<br>
<input type="submit" value="ANULAR AUTORIZACION">
</form>
</center>

</body>
</html>