<?php
$db = mysql_connect("localhost", "copreser_sadmin", "jUAS~*.8]q;7") or die("NO SE PUDO CONECTAR");

if(!$db) 

	die("NO HAY BDD");

if(!mysql_select_db("copreser_intranet",$db))

 	die("NO SE SELECCIONO BDD");
?>