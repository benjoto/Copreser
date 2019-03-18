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

$connectionInfo = array( "UID"=>$uid, "PWD"=>$pwd, "Database"=>$databaseName);

/* Connect using SQL Server Authentication. */
$conn = sqlsrv_connect( $serverName, $connectionInfo);

$tsql = "SELECT CodLista, DesLista, TipoPrecios FROM softland.iw_tlispre ORDER BY CodLista ASC";

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
    <th>CODIGO</th>
    <th>DESCRIPCION</th>
	<th>TIPO PRECIO</th>
    <th>ENLACE</th>
  </tr>";
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC))
{
	if ( strtoupper(substr($row[0],0,1)) == 'V' OR substr($row[0],0,1) == '6' OR substr($row[0],0,1) == '7' OR substr($row[0],0,1) == '9' )
	{
		continue;
	}

	echo "<tr>";
	echo "<td><font face='Arial'>" . strtoupper($row[0]) . "</font></td>";
	echo "<td>" . strtoupper($row[1]) . "</td>";
	echo "<td><font face='Arial'>";
	if ($row[2]=='1')
	{
		echo "PRECIO BRUTO";
	}
	else
		echo "PRECIO NETO";
	echo "</font></td>";
	echo "<td><a href='listadeprecio.php?CodLista=" . $row[0] . "'>VER INFORMACION</a></td>";
	echo "</tr>";
	
}
echo "</table>";

sqlsrv_free_stmt( $stmt);		
sqlsrv_close( $conn);
?>