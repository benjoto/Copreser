<?php
    //---------------desde aca esta la consulta para calcular el costo y el stock--------------------------
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

    
    while( $row = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_NUMERIC))
    {
        $A=$row[0];
        $B=utf8_encode($row[1]);
        $C=utf8_encode($row[2]);
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
    $stock=$ingresada - $despachada;

        
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
    //-------------aca termina la consulta para calcular el stock-----------------------

?>