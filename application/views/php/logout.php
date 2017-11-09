<?php 
session_start();
unset($_SESSION['logado']);
unset($_SESSION['usuario']);
header("location: http://listaccb.esy.es/areadousuario.php");
 ?>