<?php 
session_start();
unset($_SESSION['logado']);
header("location: http://listaccb.esy.es/areadousuario.php");
 ?>