<?php
error_reporting( E_ALL & ~E_DEPRECATED & ~E_NOTICE );
if(!mysql_connect("localhost","root",""))
{
	die('PROBLEMA DE CONEXION ! --> '.mysql_error());
}
if(!mysql_select_db("copreser_intranet"))
{
	die('PROBLEMA DE SELECCION DE BDD ! --> '.mysql_error());
}

?>