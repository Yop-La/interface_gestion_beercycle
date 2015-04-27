<?php
	session_start();
	header ('Content-type:text/html; charset=utf-8');
	if(!isset($_SESSION['identification']))
	{
			$_SESSION['identification']=false;
	}		
?>

<!DOCTYPE html>
	<html>
  <head>
		<title> Validation des commandes par ZFW</title>
    <meta charset="utf-8">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/tuto.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <?php include("header.php");
      			include("menu.php");
						/* retourne un menu qui change en fonction de la page et du visiteur ( de ses droits ) */
						afficherMenuEtTitre(1,'commandeZFW');
						if($_SESSION['identification'])
						{
			?>

			<ul class="nav nav-tabs">
					<li class="active"><a href="#fournisseurs" data-toggle="tab">Commandes expédiées par les fournisseurs</a></li>
					<li><a href="#beerecycle" data-toggle="tab">Commandes expédiées par Beerecycle</a></li>
			</ul>
			<div class="tab-content">
					<div class="tab-pane active" id="fournisseurs">Texte d'accueil</div>
					<div class="tab-pane" id="beerecycle">Tous les livres</div>
			</div>




			<?php 
						}else
						{
							echo header('Location: acceuil.php');
						}
					/* Pied de page  */		
      		include("footer.php"); 
			?>
  	</div>
		<script src="bootstrap/js/jquery.js"></script> 
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>

