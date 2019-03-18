<?php
$db = mysql_connect("localhost", "root", "") or die("NO SE PUDO CONECTAR");

if(!$db) 

	die("NO HAY BDD");

if(!mysql_select_db("copreser_intranet",$db))

 	die("NO SE SELECCIONO BDD");
?>