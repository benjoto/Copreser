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
    width: 100%;
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
echo "<font face='helvetica' size=4><a href='index.php'>Volver al Menu Principal</a></font>";
if($_SESSION['admin']==1)
{
	echo "<font face='helvetica' size=4> - </font>";
	echo "<font face='helvetica' size=4><a href='autoriza_retiro_en_bodega.php'>Añadir Autorizacion</a></font>";
	echo "<font face='helvetica' size=4> - </font>";
	echo "<font face='helvetica' size=4><a href='anula_retiro_en_bodega.php'>Anular Autorizacion</a></font>";
}
echo "<hr>";

include "connection.php";
$result=mysql_query("SELECT * FROM retiro_en_bodega WHERE fecha='" . date("Y-m-d") . "'");
$num=mysql_numrows($result);

?>
<center><br>
<font face="helvetica" size=4><b>AUTORIZADOS PARA RETIRAR EN BODEGA  <?php echo date('d/m/Y'); ?> </b></font><br><br></center>
<table border="1" cellspacing="1" cellpadding="2" style="width: 100%;">
<tr>

<th><b>ID</b></th>
<th><b>NOMBRE EMPRESA</b></th>
<th><b>NOMBRE CHOFER</b></th>
<th><b>RUT CHOFER</b></th>
<th><b>PATENTE VEHICULO</b></th>
<th><b>HORA APROX</b></th>
<th><b>AUTORIZADO POR</b></th>


<?php
$i=0;
while ($i < $num)
{
?>

<tr>
<td>
<b><font size=2><?php echo mysql_result($result,$i,"id"); ?></font></b>
</td>
<td>
<?php echo mysql_result($result,$i,"nombre_empresa"); ?>
</td>
<td>
<?php echo mysql_result($result,$i,"nombre_chofer"); ?>
</td>
<td>
<?php echo mysql_result($result,$i,"rut_chofer"); ?>
</td>
<td>
<?php echo mysql_result($result,$i,"patente_vehiculo"); ?>
</td>
<td>
<?php echo mysql_result($result,$i,"hora_aprox"); ?>
</td>
<td>
<?php echo mysql_result($result,$i,"autorizado_por"); ?>
</td>
</tr>
<?php
$i++;
}
mysql_close();
?>

</table>
</body>
</html>