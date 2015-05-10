<?php
try
{  
		$bdd = new PDO('mysql:host=localhost;dbname=alexandraabeezfw;charset=utf8', 'root', '');
//		$bdd = new PDO('mysql:host=alexandraabeezfw.mysql.db;dbname=alexandraabeezfw;charset=utf8', 'alexandraabeezfw', 'Bgrnht12a');
		mysql_set_charset( 'utf8' );	

}
catch(Exception $e)
{
		die('Erreur : '.$e->getMessage());
}
?>
