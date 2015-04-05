<?php
	session_start();
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
      <?php include("header.html");
      			include("menu.php"); 
						afficherMenuEtTitre(1,'acceuil');			
			?>
			

			
			<?php 
					/* Pied de page  */		
      		include("footer.html"); 
			?>
  	</div>
		<script src="bootstrap/js/jquery.js"></script> 
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>





