<?php
session_start();
include_once 'dbconnect.php';

if(isset($_SESSION['user'])!="")
{
	header("Location: gdc/index.php");
}

if(isset($_POST['btn-login']))
{
	$user = mysql_real_escape_string($_POST['user']);
	$upass = mysql_real_escape_string($_POST['pass']);
	
	$user = trim($user);
	$upass = trim($upass);
	
	$res=mysql_query("SELECT user_id, username, password, admin, nombre, cod_vend_softland FROM users WHERE username='$user'");
	$row=mysql_fetch_array($res);
	
	$count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row
	
	if($count == 1 && $row['password']==md5($upass))
	{
		$_SESSION['user'] = $row['username'];
		$_SESSION['admin'] = $row['admin'];
		$_SESSION['nombre'] = $row['nombre'];
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['cod_vend_softland'] = $row['cod_vend_softland'];
		header("Location: gdc/index.php");
	}
	else
	{
		?>
        <script>alert('USUARIO Y CONTRASEÑA INVALIDO');</script>
        <?php
	}
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>COPRESER INTRANET</title>
<link rel="stylesheet" href="gdc/css/style_3.css">
</head>
<body>
<center>
<br>
<div class="main">
<div class="login-form">
<br>
<img src="gdc/imagenes/logo_metro.jpg" width="300"/>
<form method="post">
<input type="text" name="user" placeholder="USUARIO" required />
<input type="password" name="pass" placeholder="CONTRASEÑA" required />
<div class="submit"><button type="submit" name="btn-login">ENTRAR</button></div>
</div>
</div>
</form>
v2.1.0
</center>
</body>
</html>