<?php
session_start();
include_once '../dbconnect.php';

if(!isset($_SESSION['user']))
{
 header("Location: ../index.php");
}
          
    date_default_timezone_set('America/Santiago');

    $link = mysqli_connect("localhost", "root", "", "copreser_intranet");
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    //captura el id del usuario actual  
    $id = $_SESSION['user_id'];
    $codVendedor=$_SESSION['cod_vend_softland'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<title>COPRESER INTRANET</title>
<style>


.caja {
   margin:20px auto 40px auto;	
   border:1px solid #d9d9d9;
   height:30px;
   overflow: hidden;
   width: 230px;
   position:relative;
}
select {
   background: transparent;
   border: none;
   font-size: 14px;
   height: 30px;
   padding: 5px;
   width: 250px;
}
select:focus{ outline: none;}

.caja::after{
	content:"\025be";
	display:table-cell;
	padding-top:7px;
	text-align:center;
	width:30px;
	height:30px;
	background-color:#d9d9d9;
	position:absolute;
	top:0;
	right:0px;	
	pointer-events: none;
}



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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
	echo "<font face='helvetica' size=4>  </font>";	
		
}
echo "<hr>";

include "connection.php";
$result=mysql_query("SELECT * FROM visita_cliente WHERE fecha='" . date("Y-m-d") . "'");
$num=mysql_numrows($result);
?>

<h1 style="text-align:center;">NOTA DE VENTA</h1>


<?php

//consulta a la bd para mostrar el nombre del cliente en el combobox
    $serverName = "localhost\SQLEXPRESS";
    $uid = "nesguepa";
    $pwd = "123456";
    $databaseName = "COPRESER2014";
    
    
    $connectionInfo = array( "UID"=>$uid, "PWD"=>$pwd, "Database"=>$databaseName);
        
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    $consulta ="SELECT
    COPRESER2014.softland.cwtauxi.NomAux,
    COPRESER2014.softland.cwtauxi.CodAux,
    COPRESER2014.softland.cwtauxven.VenCod,
    COPRESER2014.softland.cwtauxi.DirAux,
    COPRESER2014.softland.cwtauxi.DirNum,
    COPRESER2014.softland.cwtauxi.CiuAux,
    COPRESER2014.softland.cwtauxi.FonAux1,
    COPRESER2014.softland.cwtauxi.EMail,
    COPRESER2014.softland.cwtauxi.RutAux
    FROM COPRESER2014.softland.cwtauxven
    INNER JOIN COPRESER2014.softland.cwtauxi ON COPRESER2014.softland.cwtauxven.CodAux = COPRESER2014.softland.cwtauxi.CodAux
    WHERE COPRESER2014.softland.cwtauxven.VenCod=$codVendedor ORDER BY NomAux ASC";

    $resultado = sqlsrv_query( $conn, $consulta);

    $fila = sqlsrv_fetch_array($resultado);
    
?>

<div class="dropDownList">    

<form >
    <br />    
    <b style="font-size:20px">seleccionar cliente</b>
    <b style="font-size:20px;margin-left:195px;">ingresar descripcion del producto</b><br/><br/>
        <select class="caja" name="comboClientes" >              
            <option></option>
            <?php 
            //cargar combo, y mantener al cliente que se elige
            while($fila = sqlsrv_fetch_array($resultado)){ 
                $codigoCliente=$fila['CodAux'];                              
                $valorCombo = $_GET['comboClientes'];
                
                if($codigoCliente==$valorCombo){
                    echo "<option value=\"".utf8_encode(strtoupper($codigoCliente."\" selected>".$fila['NomAux']))."</option>\n";
                }else{
                    echo "<option value=\"".utf8_encode(strtoupper($codigoCliente."\">".$fila['NomAux']))."</option>\n";
                }  
                
                
            };
            echo "</select>";

            if (isset($_GET['btnAddProd'])){

            echo "el boton se esta apretando";           
        }
            ?>   
                    
            
              
    <input type="text" name="buscarProducto" id="buscarProducto" value="<?php $desProd ?>" placeholder="nombre del producto" style="margin-left:120px;" required>
    <input type="submit" name="btnEnviar" value="enviar"/>


<?php
//esta consulta llena la tabla de los clientes
   if(isset($_GET["comboClientes"])){    
       $cliente=$_GET["comboClientes"];              


        $consulta2 ="SELECT
        COPRESER2014.softland.cwtauxi.NomAux,
        COPRESER2014.softland.cwtauxi.CodAux,
        COPRESER2014.softland.cwtauxven.VenCod,
        COPRESER2014.softland.cwtauxi.DirAux,
        COPRESER2014.softland.cwtauxi.DirNum,
        COPRESER2014.softland.cwtauxi.CiuAux,
        COPRESER2014.softland.cwtauxi.FonAux1,
        COPRESER2014.softland.cwtauxi.EMail,
        COPRESER2014.softland.cwtauxi.RutAux
        FROM COPRESER2014.softland.cwtauxven
        INNER JOIN COPRESER2014.softland.cwtauxi ON COPRESER2014.softland.cwtauxven.CodAux = COPRESER2014.softland.cwtauxi.CodAux
        WHERE COPRESER2014.softland.cwtauxi.CodAux='$cliente'";

        $resultado2 = sqlsrv_query( $conn, $consulta2);

        while($fila2 = sqlsrv_fetch_array($resultado2))
        {
            $nombre_cliente = $fila2['NomAux'];
            $codaux_cliente = $fila2['CodAux'];
            $vencod_cliente = $fila2['VenCod'];
            $direccion_cliente = $fila2['DirAux'];
            $numero_direccion_cliente = $fila2['DirNum'];
            $ciudad_cliente = $fila2['CiuAux'];
            $fono_cliente = $fila2['FonAux1'];
            $email_cliente = $fila2['EMail'];
            $rut_cliente = $fila2['RutAux'];
        };

   }
   //usar la misma query pero ahora igualando los datos con lo que se captura en la variable cliente
?>
</div>

<!--DESDE ACA EMPIEZO LA TABLA PARA LLENAR CON LOS DATOS DE LOS CLIENTES-->
<table name="tablaCliente">
    
    <tr>
        <td><label><b>Nombre Cliente</b></label><input value="<?php echo utf8_encode(strtoupper($nombre_cliente)) ;?>"/></td> 
        <td><label><b>Codigo Cliente</b></label><input value="<?php echo utf8_encode(strtoupper($codaux_cliente));?>"/></td>    
        <td><label><b>Codigo Vendedor</b></label><input value="<?php echo utf8_encode(strtoupper($vencod_cliente));?>"/></td>       
        <td><label><b>Rut Cliente</b></label><input value="<?php echo utf8_encode(strtoupper($rut_cliente));?>"/></td>
        <td><label><b>Dirección Cliente</b></label><input value="<?php echo utf8_encode(strtoupper($direccion_cliente));?>"/></td>        
    </tr>
    <tr>
        <td><label><b>N° Dirección Cliente</b></label><input value="<?php echo utf8_encode(strtoupper($numero_direccion_cliente));?>"/></td>
        <td><label><b>Ciudad Cliente</b></label><input value="<?php echo utf8_encode(strtoupper($ciudad_cliente));?>"/></td>
        <td><label><b>Telefono Cliente</b></label><input value="<?php echo utf8_encode(strtoupper($fono_cliente));?>"/></td>
        <td><label><b>Correo Cliente</b></label><input value="<?php echo utf8_encode(strtoupper($email_cliente));?>"/></td>
    </tr>
    </table>


<hr />

<h1 style="text-align:center">Productos</h1>
<br />
    
<!-- fin del formulario de productos y clientes -->  
</form>

    
    
    <form name="prodAgregados">
        <table name="productosAElegir">
        <tr>
            <th>Seleccionar</th>
            <th>nombre</th>
            <th>codigo</th>               
        </tr>
        <tr>    
<?php
    //aca se hara la consulta por los productos
    if(isset($_GET["buscarProducto"])){ 
        $nomProducto=$_GET["buscarProducto"];
                    
            $consulta3 ="SELECT * FROM COPRESER2014.softland.iw_tprod where DesProd Like '%$nomProducto%' AND Inactivo='0' ORDER BY DesProd ASC";
            
            $resultado3 = sqlsrv_query( $conn, $consulta3);
            $fila3 = sqlsrv_fetch_array($resultado3);            
            while($fila3 = sqlsrv_fetch_array($resultado3))            
            {                
                $codigoProd = $fila3['CodProd'];
                $desProd = $fila3['DesProd'];
                ?>
                <td><input type="checkbox" name="codigo[]" value="<?php echo $codigoProd;?>"></td>
                <td><?php echo utf8_encode(strtoupper($desProd));?></td>
                <td><?php echo utf8_encode(strtoupper($codigoProd));?></td>
                </tr>
                <?php
                
            };  
    
    }        
?>


        </table>

        <input type="submit" name="btnAddProd" value="Agregar"/>
    </form>
    <br />
    <br />
    <hr />

    <table name="tablaProductosSeleccionados">
    <tr>
        <th>codigo</th>
        <th>nombre</th>
        <th>stock</th>
        <th>precio ultimo costo</th>
        <th>precio de venta</th>        
    </tr>
    <tr>

    <?php
    //aca se hara la consulta por los productos
    //desde aca se toma el value del checkbox y se imprime en la tabla    
    if(isset($_GET["codigo"])){ 
        $codigoFinal=$_GET["codigo"];
        
                    
            foreach($codigoFinal as $cod){

            $consulta4 ="SELECT * FROM COPRESER2014.softland.iw_tprod where CodProd = '$cod' ORDER BY DesProd ASC";
            
            $resultado4 = sqlsrv_query( $conn, $consulta4);
            
            
            //$fila4 = sqlsrv_fetch_array($resultado4);            
            while($fila4 = sqlsrv_fetch_array ($resultado4))            
            {                

                //no he modificado nada desde aca
                $desProd = $fila4['DesProd'];
                $codigoProd = $fila4['CodProd'];                
                ?>
                <td><?php echo utf8_encode(strtoupper($codigoProd));?></td>
                <td><?php echo utf8_encode(strtoupper($desProd));?></td>
                <td><!--usar la variable $stock aca de forma directa-->1</td>
                <td><!--usar la variable $costo aca de forma directa-->1</td>
                <td>En desarrollo</td>
                </tr>
                <?php
                
            };  
        }
    
    }        
?>         
    </tr>
    </table>


<br /><br /><br /><br /><br /><br />




</body>
</html>