<?php
session_start();
header ('Content-type:text/html; charset=utf-8');
$_SESSION=array ();
session_destroy();
header('Location: access.php');

?>
