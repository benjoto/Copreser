<?php
    $serverName = "localhost\SQLEXPRESS";
    $uid = "nesguepa";
    $pwd = "123456";
    $databaseName = "COPRESER2014";
    
    
    $connectionInfo = array( "UID"=>$uid, "PWD"=>$pwd, "Database"=>$databaseName);
        
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

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
                echo "
    <table >
        
    <tr>
        <td><label><b>Nombre Cliente</b></label><input value=".utf8_encode(strtoupper($nombre_cliente))."></td> 
        <td><label><b>Codigo Cliente</b></label><input value=".utf8_encode(strtoupper($codaux_cliente))."></td>    
        <td><label><b>Codigo Vendedor</b></label><input value=".utf8_encode(strtoupper($vencod_cliente))."></td>       
        <td><label><b>Rut Cliente</b></label><input value=".utf8_encode(strtoupper($rut_cliente))."></td>
        <td><label><b>Dirección Cliente</b></label><input value=".utf8_encode(strtoupper($direccion_cliente))."></td>        
    </tr>
    <tr>
        <td><label><b>N° Dirección Cliente</b></label><input value=".utf8_encode(strtoupper($numero_direccion_cliente))."></td>
        <td><label><b>Ciudad Cliente</b></label><input value=".utf8_encode(strtoupper($ciudad_cliente))."></td>
        <td><label><b>Telefono Cliente</b></label><input value=".utf8_encode(strtoupper($fono_cliente))."></td>
        <td><label><b>Correo Cliente</b></label><input value=".utf8_encode(strtoupper($email_cliente))."></td>
    </tr>
    </table>   
    ";
            
?>