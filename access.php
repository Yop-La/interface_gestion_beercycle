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
		<title> Beerecyle Access</title>
    <meta charset="utf-8">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/tuto.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <?php include("header.php");
      			include("menu.php");
						/* retourne un menu qui change en fonction de la page et du visiteur ( de ses droits ) */
						afficherMenuEtTitre(1,'access');
						if(!$_SESSION['identification'])
						{
			?>
			<section class="row contenu">
				<article class="col-lg-offset-4 col-lg-4">	
						<form class="well" method="post" action="identification.php">
							<legend>Authentification</legend>
							<div class="form-group">
								<label for="username">User name</label>
								<input name="username" id="username" type="text" class="form-control">
							</div>
							<div class="form-group">
								<label for="password">Password </label>
								<input name="password" id="password" type="password" class="form-control">
							</div>
							<button type="submit" class="btn btn-danger centrer"> Submit </button>
						</form>
				</article>
			</section>

			
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





