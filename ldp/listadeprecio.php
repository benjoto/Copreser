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
$CodLista = $_GET['CodLista'];

$connectionInfo = array( "UID"=>$uid, "PWD"=>$pwd, "Database"=>$databaseName);

/* Connect using SQL Server Authentication. */
$conn = sqlsrv_connect( $serverName, $connectionInfo);

$tsql = "
SELECT
COPRESER2014.softland.iw_tlprprod.CodLista,
COPRESER2014.softland.iw_tlprprod.CodProd,
COPRESER2014.softland.iw_tprod.DesProd,
COPRESER2014.softland.iw_tlprprod.ValorPct
FROM COPRESER2014.softland.iw_tlprprod 
INNER JOIN COPRESER2014.softland.iw_tprod
ON COPRESER2014.softland.iw_tlprprod.CodProd = COPRESER2014.softland.iw_tprod.CodProd
WHERE COPRESER2014.softland.iw_tlprprod.CodLista='" . $CodLista . "'";

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
echo "<img src='imagenes\logo_inv.png' width=15%><a href='index.php'><img src='imagenes\logo_volver.png' width=5%></a>";
echo "<table style='width:100%'>
  <tr>
    <th>CODIGO LISTA</th>
    <th>CODIGO PRODUCTO</th> 
    <th>DESCRIPCION</th>
	<th>PRECIO</th>
  </tr><tr>";
  
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC))
{
	echo "<tr><td>".$row[0]."</td>";
	echo "<td>".$row[1]."</td>";
	echo "<td>".utf8_encode(strtoupper($row[2]))."</td>";
	echo "<td>$ " . number_format($row[3],0) . "</td></tr>";
}

echo "</table>";

sqlsrv_free_stmt( $stmt);
sqlsrv_close( $conn);
?>



















