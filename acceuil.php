<?php
	session_start();
	header ('Content-type:text/html; charset=utf-8');
	if(!isset($_SESSION['identification']))
	{
			$_SESSION['identification']=false;
	}
	header ('Content-type:text/html; charset=utf-8');
?>

<!DOCTYPE html>
	<html>
  <head>
		<title> Beerecyle Home Page</title>
    <meta charset="utf-8">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/tuto.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <?php 
						if($_SESSION['identification']){
								include("header.php");
      					include("menu.php"); 
								afficherMenuEtTitre(1,'acceuil');
			?>
			<aside class="row">
				<article class="col-lg-offset-3 col-lg-6">
					</br>
					</br>
					<h2> Dashboard personnalisé </h2>
					</br>
					</br>
					<p> 
						Sur cette page d'acceuil, nous allons retrouver un contenu personnalisé qui
						sera adapté au besoin du visiteur. On pourra, par exemple, afficher l'état
						des stocks si le visiteur est un vendeur. Ou bien afficher les ventes du mois 
						pour les personnes qui s'occupent du business.
						</br>
						</br>
						</br>
				</article>
				
			</aside>
			
			<?php 
					/* Pied de page  */		
      					include("footer.php"); 
						}
						else
						{
								echo header('Location: access.php');		
						}
			?>
  	</div>
		<script src="bootstrap/js/jquery.js"></script> 
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>





