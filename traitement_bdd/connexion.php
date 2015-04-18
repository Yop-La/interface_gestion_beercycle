<?php
try
{  
		$bdd = new PDO('mysql:host=localhost;dbname=beezfw;charset=utf8', 'root', '');
		mysql_set_charset( 'utf8' );	
		//$bdd = new PDO('mysql:host=mysql51-153.perso;dbname=alexandraa_beere;charset=utf8', 'alexandraa_beere', 'Bgrnht12a');
}
catch(Exception $e)
{
		die('Erreur : '.$e->getMessage());
}
?>
