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
<title>INTRANET COPRESER</title>
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
?>

<center>
<font face="helvetica" size=6><b>INTRANET</b></font><br><br>

<?php
if ($_SESSION['admin']==0)
{
echo "
<table border=0>
<tr>
<td><a href='autorizados_bodega.php'><img width='180' src='imagenes/retiro_en_bodega.png'></a></td>
<td><a href='visita_cliente.php'><img width='180' src='imagenes/visita_cliente.png'></a></td>
<td><a href='../stock/index.php?orden=ASC&categoria=CodProd'><img width='180' src='imagenes/niveles_de_stock.png'></a></td>
<td><a href='../ldp/'><img width='180' src='imagenes/lista_de_precio.png'></a></td>
<td><a href='libreta_de_direcciones.php'><img width='180' src='imagenes/agenda.png'></a></td>
<td><a href='http://mail.copreser.cl'><img width='180' src='imagenes/correo.png'></a></td>
</tr>
<tr>
<td bgcolor=#edebe9><center><font face='helvetica'>Retiro en Bodega</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>Visita de Cliente</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>Niveles de Stock</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>Listas de Precio</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>Libreta de Direcciones</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>Correo Corporativo</font></center></td>
</tr>
<tr>
<td><a href='http://keep.google.com'><img width='180' src='imagenes/keep.png'></a></td>
<td><a href='http://spreadsheets.google.com'><img width='180' src='imagenes/spreadsheets.png'></a></td>
<td><a href='http://docs.google.com'><img width='180' src='imagenes/docs.png'></a></td>
<td><a href='http://slides.google.com'><img width='180' src='imagenes/slides.png'></a></td>
<td><a href='http://calendar.google.com'><img width='180' src='imagenes/calendar.png'></a></td>
<td><a href='http://drive.copreser.cl'><img width='180' src='imagenes/drive.png'></a></td>
</tr>
<tr>
<td bgcolor=#edebe9><center><font face='helvetica'>Google Keep</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>Google Spreadsheets</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>Google Docs</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>Google Slides</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>Google Calendar</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>Google Drive</font></center></td>
</tr>
<tr>
<td><a href='cambio_clave.php'><img width='180' src='imagenes/cambio_clave.png'></a></td>
</tr>
<tr>
<td bgcolor=#edebe9><center><font face='helvetica'>Cambio de Contraseña</font></center></td>
</tr>
</table>
";
}
if ($_SESSION['admin']==1)
{
echo "
<table border=0>
<tr>
<td><a href='autorizados_bodega.php'><img width='180' src='imagenes/retiro_en_bodega.png'></a></td>
<td><a href='visita_cliente.php'><img width='180' src='imagenes/visita_cliente.png'></a></td>
<td><a href='../stock/index.php?orden=ASC&categoria=CodProd'><img width='180' src='imagenes/niveles_de_stock.png'></a></td>
<td><a href='../ldp/'><img width='180' src='imagenes/lista_de_precio.png'></a></td>
<td><a href='libreta_de_direcciones.php'><img width='180' src='imagenes/agenda.png'></a></td>
<td><a href='http://mail.copreser.cl'><img width='180' src='imagenes/correo.png'></a></td>
</tr>
<tr>
<td bgcolor=#edebe9><center><font face='helvetica'>Retiro en Bodega</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>Visita de Cliente</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>Niveles de Stock</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>Listas de Precio</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>Libreta de Direcciones</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>Correo Corporativo</font></center></td>
</tr>
<tr>
<td><a href='http://drive.copreser.cl'><img width='180' src='imagenes/drive.png'></a></td>
<td><a href='http://keep.google.com'><img width='180' src='imagenes/keep.png'></a></td>
<td><a href='http://spreadsheets.google.com'><img width='180' src='imagenes/spreadsheets.png'></a></td>
<td><a href='http://docs.google.com'><img width='180' src='imagenes/docs.png'></a></td>
<td><a href='http://slides.google.com'><img width='180' src='imagenes/slides.png'></a></td>
<td><a href='http://calendar.google.com'><img width='180' src='imagenes/calendar.png'></a></td>
</tr>
<tr>
<td bgcolor=#edebe9><center><font face='helvetica'>Google Drive</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>Google Keep</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>Google Spreadsheets</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>Google Docs</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>Google Slides</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>Google Calendar</font></center></td>
</tr>
<tr>
<td><a href='cambio_clave.php'><img width='180' src='imagenes/cambio_clave.png'></a></td>
</tr>
<tr>
<td bgcolor=#edebe9><center><font face='helvetica'>Cambio de Contraseña</font></center></td>
</tr>
</table>
";
}
if ($_SESSION['admin']==2)
{
echo "
<table border=0>
<tr>
<td><a href='autorizados_bodega.php'><img width='180' src='imagenes/retiro_en_bodega.png'></a></td>
<td><a href='visita_cliente.php'><img width='180' src='imagenes/visita_cliente.png'></a></td>
<td><a href='http://192.168.5.100'><img width='180' src='imagenes/CCTV.png'></a></td>
<td><a href='libreta_de_direcciones.php'><img width='180' src='imagenes/agenda.png'></a></td>
<td><a href='cambio_clave.php'><img width='180' src='imagenes/cambio_clave.png'></a></td>
</tr>
<tr>
<td bgcolor=#edebe9><center><font face='helvetica'>Retiro en Bodega</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>Visita de Cliente</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>CCTV</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>Libreta de Direcciones</font></center></td>
<td bgcolor=#edebe9><center><font face='helvetica'>Cambio Contraseña</font></center></td>
</tr>
</table>
";
}
?>
</center>

</body>
</html>