<?php
session_start();
if(!isset($_SESSION['user']))
{
 header("Location: ../index.php");
}

$orden = $_GET['orden'];
$categoria = $_GET['categoria'];

$serverName = "localhost\SQLEXPRESS";
$uid = "nesguepa";
$pwd = "123456";
$databaseName = "COPRESER2014";

$connectionInfo = array( "UID"=>$uid, "PWD"=>$pwd, "Database"=>$databaseName);

/* Connect using SQL Server Authentication. */
$conn = sqlsrv_connect( $serverName, $connectionInfo);

$tsql = "SELECT CodProd, DesProd, DesProd2 FROM softland.iw_tprod WHERE Inactivo='0' ORDER BY " . $categoria . " " . $orden;

/* Execute the query. */

$stmt = sqlsrv_query( $conn, $tsql);

if ( $stmt ){}
else
{
     echo "Error in statement execution.\n";
     die( print_r( sqlsrv_errors(), true));
}

echo "
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
";
echo "<img src='imagenes\logo_inv.png' width=15%><a href='../index.php'><img src='imagenes\logo_volver.png' width=5%></a>";
echo "<table style='width:100%'>
  <tr>
    <th>CODIGO <a href='index.php?orden=DESC&categoria=CodProd'><img src='imagenes/arriba.png' width=16></a> <a href='index.php?orden=ASC&categoria=CodProd'><img src='imagenes/abajo.png' width=16></a></th>
    <th>DESCRIPCION <a href='index.php?orden=DESC&categoria=DesProd'><img src='imagenes/arriba.png' width=16></a> <a href='index.php?orden=ASC&categoria=DesProd'><img src='imagenes/abajo.png' width=16></a></th> 
    <th>PROVEEDOR <a href='index.php?orden=DESC&categoria=DesProd2'><img src='imagenes/arriba.png' width=16></a> <a href='index.php?orden=ASC&categoria=DesProd2'><img src='imagenes/abajo.png' width=16></a></th>
	<th>STOCK Y ULTIMO COSTO</th>
  </tr>";
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC))
{
	if ( strtoupper(substr($row[0],0,1)) == 'V' OR substr($row[0],0,1) == '6' OR substr($row[0],0,1) == '7' OR substr($row[0],0,1) == '9' OR substr($row[0],0,2) == '3-' )
	{
		continue;
	}

	echo "<tr>";
	echo "<td><font face='Arial'>" . utf8_encode(strtoupper($row[0])) . "</font></td>";
	echo "<td>" . utf8_encode(strtoupper($row[1])) . "</td>";
	echo "<td>" . strtoupper($row[2]) . "</td>";
	echo "<td><a href='stock.php?CodProd=" . $row[0] . "'>VER INFORMACION</a></td>";
	echo "</tr>";
	
}
echo "</table>";

sqlsrv_free_stmt( $stmt);		
sqlsrv_close( $conn);
?>