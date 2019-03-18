<?php
session_start();
if(!isset($_SESSION['user']))
{
 header("Location: ../index.php");
}

$serverName = "localhost\SQLEXPRESS";
$uid = "nesguepa";
$pwd = "123456";
$databaseName = "COPRESER2014";
$CodProd = $_GET['CodProd'];

$connectionInfo = array( "UID"=>$uid, "PWD"=>$pwd, "Database"=>$databaseName);

/* Connect using SQL Server Authentication. */
$conn = sqlsrv_connect( $serverName, $connectionInfo);

$tsql1 = "SELECT CodProd, DesProd, DesProd2 FROM softland.iw_tprod WHERE CodProd='" . $CodProd . "' ORDER BY CodProd ASC";
$tsql1_1 = "SELECT CodProd, DesProd, DesProd2 FROM softland.iw_tprod WHERE CodProd='" . $CodProd . "' ORDER BY CodProd ASC";
$tsql2 = "SELECT
SUM(COPRESER2014.softland.iw_gmovi.CantIngresada)
FROM
COPRESER2014.softland.iw_gmovi INNER JOIN COPRESER2014.softland.iw_gsaen
ON
COPRESER2014.softland.iw_gmovi.Tipo = COPRESER2014.softland.iw_gsaen.Tipo
AND COPRESER2014.softland.iw_gmovi.NroInt = COPRESER2014.softland.iw_gsaen.NroInt
AND COPRESER2014.softland.iw_gmovi.CodProd='" . $CodProd . "'
AND COPRESER2014.softland.iw_gsaen.Estado='V'
AND COPRESER2014.softland.iw_gsaen.CodBode='002'";
$tsql3= "SELECT
SUM(COPRESER2014.softland.iw_gmovi.CantDespachada)
FROM
COPRESER2014.softland.iw_gmovi INNER JOIN COPRESER2014.softland.iw_gsaen
ON
COPRESER2014.softland.iw_gmovi.Tipo = COPRESER2014.softland.iw_gsaen.Tipo
AND COPRESER2014.softland.iw_gmovi.NroInt = COPRESER2014.softland.iw_gsaen.NroInt
AND COPRESER2014.softland.iw_gmovi.CodProd='" . $CodProd . "'
AND COPRESER2014.softland.iw_gsaen.Estado='V'
AND COPRESER2014.softland.iw_gsaen.CodBode='002'";
$tsql4 = "SELECT TOP 1 PreUniMB FROM COPRESER2014.softland.iw_gmovi WHERE CodProd='" . $CodProd . "' AND CantIngresada>'0' ORDER BY Fecha DESC";

$tsql5 = "SELECT
SUM(COPRESER2014.softland.iw_gmovi.CantIngresada)
FROM
COPRESER2014.softland.iw_gmovi INNER JOIN COPRESER2014.softland.iw_gsaen
ON
COPRESER2014.softland.iw_gmovi.Tipo = COPRESER2014.softland.iw_gsaen.Tipo
AND COPRESER2014.softland.iw_gmovi.NroInt = COPRESER2014.softland.iw_gsaen.NroInt
AND COPRESER2014.softland.iw_gmovi.CodProd='" . $CodProd . "'
AND COPRESER2014.softland.iw_gsaen.Estado='V'
AND COPRESER2014.softland.iw_gsaen.CodBode='08'";
$tsql6= "SELECT
SUM(COPRESER2014.softland.iw_gmovi.CantDespachada)
FROM
COPRESER2014.softland.iw_gmovi INNER JOIN COPRESER2014.softland.iw_gsaen
ON
COPRESER2014.softland.iw_gmovi.Tipo = COPRESER2014.softland.iw_gsaen.Tipo
AND COPRESER2014.softland.iw_gmovi.NroInt = COPRESER2014.softland.iw_gsaen.NroInt
AND COPRESER2014.softland.iw_gmovi.CodProd='" . $CodProd . "'
AND COPRESER2014.softland.iw_gsaen.Estado='V'
AND COPRESER2014.softland.iw_gsaen.CodBode='08'";

/* Execute the query. */

$stmt1 = sqlsrv_query( $conn, $tsql1);
$stmt1_1 = sqlsrv_query( $conn, $tsql1_1);
$stmt2 = sqlsrv_query( $conn, $tsql2);
$stmt3 = sqlsrv_query( $conn, $tsql3);
$stmt4 = sqlsrv_query( $conn, $tsql4);
$stmt5 = sqlsrv_query( $conn, $tsql5);
$stmt6 = sqlsrv_query( $conn, $tsql6);

if ( $stmt1 ){}
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
echo "<img src='imagenes\logo_inv.png' width=15%><a href='index.php?orden=ASC&categoria=CodProd'><img src='imagenes\logo_volver.png' width=5%></a>";
echo "<table style='width:100%'>
  <tr>
    <th>CODIGO</th>
    <th>DESCRIPCION</th> 
    <th>PROVEEDOR</th>
	<th>BODEGA</th>
	<th>STOCK</th>
	<th>ULTIMO COSTO</th>
  </tr><tr>";
  
while( $row = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_NUMERIC))
{
	$A=$row[0];
	$B=utf8_encode($row[1]);
	$C=utf8_encode($row[2]);
	echo "<td>".$row[0]."</td>";
	echo "<td>".utf8_encode($row[1])."</td>";
	echo "<td>".utf8_encode($row[2])."</td>";
	echo "<td>LOGISTICA</td>";
}
while( $row2 = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_NUMERIC))
{
	$ingresada = $row2[0];
}
while( $row3 = sqlsrv_fetch_array( $stmt3, SQLSRV_FETCH_NUMERIC))
{
	$despachada = $row3[0];
}
while( $row4 = sqlsrv_fetch_array( $stmt4, SQLSRV_FETCH_NUMERIC))
{
	$costo = $row4[0];
}
$stock=$ingresada-$despachada;
echo "<td>" . $stock . "</td>";
echo "<td>$ " . number_format($costo,0) . "</td></tr>";
echo "<tr><td>".$A."</td>";
echo "<td>".$B."</td>";
echo "<td>".$C."</td>";
echo "<td>SHOWROOM</td>";
	
while( $row6 = sqlsrv_fetch_array( $stmt5, SQLSRV_FETCH_NUMERIC))
{
	$ingresada = $row6[0];
}
while( $row7 = sqlsrv_fetch_array( $stmt6, SQLSRV_FETCH_NUMERIC))
{
	$despachada = $row7[0];
}
while( $row8 = sqlsrv_fetch_array( $stmt4, SQLSRV_FETCH_NUMERIC))
{
	$costo = $row8[0];
}
$stock=$ingresada-$despachada;
echo "<td>" . $stock . "</td>";
echo "<td>$ " . number_format($costo,0) . "</td></tr></table>";

sqlsrv_free_stmt( $stmt1);
sqlsrv_free_stmt( $stmt2);
sqlsrv_free_stmt( $stmt3);
sqlsrv_free_stmt( $stmt4);
sqlsrv_free_stmt( $stmt5);
sqlsrv_free_stmt( $stmt6);
sqlsrv_close( $conn);
?>



















