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
echo "<hr>";

include "connection.php";
$result=mysql_query("SELECT * FROM libreta_de_direcciones ORDER BY nombre_completo ASC");
$num=mysql_numrows($result);

?>
<center><br>
<font face="Helvetica" size=4><b>LIBRETA DE DIRECCIONES</b></font><br><br></center>
<table border="1" cellspacing="1" cellpadding="2" style="width: 100%;">
<tr>

<th><b>NOMBRE Y APELLIDOS</b></th>
<th><b>DEPARTAMENTO</b></th>
<th><b>CORREO</b></th>
<th><b>ANEXO</b></th>
<th><b>CELULAR</b></th>


<?php
$i=0;
while ($i < $num)
{
?>

<tr>
<td>
<b><font size=2><?php echo mysql_result($result,$i,"nombre_completo"); ?></font></b>
</td>
<td>
<?php echo mysql_result($result,$i,"area"); ?>
</td>
<td>
<?php echo mysql_result($result,$i,"correo"); ?>
</td>
<td>
<?php echo mysql_result($result,$i,"anexo"); ?>
</td>
<td>
<?php echo mysql_result($result,$i,"celular"); ?>
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