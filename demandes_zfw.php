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
		<title> Demandes ZFW</title>
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
								afficherMenuEtTitre(1,'demandes_zfw');
			?>
						
				
			
			<section class="row contenu">
				<article class="col-lg-offset-3 col-lg-6">
						<h3 class="row titre_page">
							Espace de saisie des demandes de produits de ZFW
						</h3>
						<form class="well row col-lg-offset-2 col-lg-8" method="post" action="">
							<legend>Origine de la demande</legend>
							<div class="form-group">
								<label for="date_commande">Date de la commande</label>
								<input name="date_commande" id="date_commande" type="date" class="form-control">
							</div>
							<div class="form-group">
								<label for="password">Canal de distribution </label>
								<select id="canal_distri" name="canal_distri" class="form-control">
									<option value="boutique_1">Boutique n°1</option>
									<option value="boutique_2">Boutique n°1</option>
									<option value="site_1">Site n°1</option>
									<option value="site-2">Site n°2</option>
								</select>
							</div>
							<legend>Caractéristiques produit</legend>
							<div class="form-group">
								<label for="quantite"> Quantite </label>
								<input name="quantite" id="quantite" type="text" class="form-control">
							</div>
							<div class="form-group">
								<label for="marque"> Marque </label>
								<select id="marque" name="marque" class="form-control">
									<option value="samsung">Samsung</option>
									<option value="apple">Apple</option>
									<option value="htc">HTC</option>
									<option value="sony">Sony</option>
								</select>
							</div>
							<div class="form-group">
								<label for="modele"> Modèle </label>
								<select id="modele" name="modele" class="form-control">
									<option value="modele1">Modèle n°1</option>
									<option value="modele2">Modèle n°2</option>
									<option value="modele3">Modèle n°3</option>
									<option value="modele4">Modèle n°4</option>
								</select>
							</div>
							<div class="form-group">
								<label for="etat"> Etat </label>
								<select id="modele" name="modele" class="form-control">
									<option value="neuf">Neuf</option>
									<option value="occasion">Occasion</option>
									<option value="recondiotionne">Reconditionnée</option>
								</select>
							</div>
							<div class="form-group">
								<label for="couleur"> Couleur </label>
								<select id="couleur" name="couleur" class="form-control">
									<option value="rouge">Rouge</option>
									<option value="bleu">Bleu</option>
									<option value="orange">Orange</option>
								</select>
							</div>

							<button type="submit" class="btn btn-danger centrer"> Submit </button>
						</form>
				</article>
			</section>
			
			
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
