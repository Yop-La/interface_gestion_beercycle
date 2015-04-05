<?php
	session_start();
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
      <?php include("header.html");
      			include("menu.php"); 
						afficherMenuEtTitre(1,'access');			
			?>
			
			<div class="row">
				<section class="col-lg-offset-4 col-lg-4">	
					<div class="form_authentification">
						<form class="well" method="post" action="identification.php">
							<legend>Authentification</legend>
							<label for="username">User name</label>
							<input name="username" id="username" type="text" class="form-control">
							<label for="password">Password </label>
							<input name="password" id="password" type="password" class="form-control">
							<button type="submit" class="btn btn-danger submit_authentification"> Submit </button>
						</form>
					</div>
				</section>
			</div>

			
			<?php 
					/* Pied de page  */		
      		include("footer.html"); 
			?>
  	</div>
		<script src="bootstrap/js/jquery.js"></script> 
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>





