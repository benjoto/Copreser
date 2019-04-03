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
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
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
    //toma todos los datos de los clientes
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

    <form id="datosCliente">
        <br />    
        <b style="font-size:20px">seleccionar cliente</b>
        <b style="font-size:20px;margin-left:195px;">ingresar descripcion del producto</b><br/><br/>
            <select class="caja" name="comboClientes">              
                <option></option>
                <?php 
                //cargar combo, y mantener al cliente que se elige
                while($fila = sqlsrv_fetch_array($resultado)){ 
                    $codigoCliente=$fila['CodAux'];                              
                    $valorCombo = $_GET['comboClientes'];                
                    
                    
                    if($codigoCliente==$valorCombo){
                        echo "<option name='valueDelCod' value=\"".utf8_encode(strtoupper($codigoCliente."\" selected>".$fila['NomAux']))."</option>\n";
                    }else{
                        echo "<option value=\"".utf8_encode(strtoupper($codigoCliente."\">".$fila['NomAux']))."</option>\n";
                    }  
                    
                    
                };
                echo "</select>";            
/*
                if (isset($_GET['btnAddProd'])){
                //si imprimo aca el codigo del cliente me muestra el ultimo cliente de la tabla
                echo "el boton se esta apretando";             

            }
*/            
                ?>   
                        
                
                
       <!-- <input type="text" name="buscarProducto" id="buscarProducto" value="<?php //$desProd ?>" placeholder="nombre del producto" style="margin-left:120px;" required>-->

        <button id="enviar">enviar</button>
        <!--<input type="submit" name="btnEnviar" value="enviar" />-->




    <!--DESDE ACA EMPIEZO LA TABLA PARA LLENAR CON LOS DATOS DE LOS CLIENTES-->

    
    <div id="respuesta"></div>


    <hr />

    <h1 style="text-align:center">Productos</h1>
    <br />
        
    <!-- fin del formulario de productos y clientes -->  
    </form>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </body>

    <!--consultar los datos de los clientes-->
    <script>
        $('#enviar').click(function(){
            $.ajax({
                url: 'tablaCliente.php',
                type: 'GET',
                data: $('#datosCliente').serialize(),
                success: function(res){
                    $('#respuesta').html(res);
                }
            });
        });
    </script>
</html>
