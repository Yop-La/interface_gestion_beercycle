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
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="css_form_validation/screen.css">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/tuto.css" rel="stylesheet">
    <link rel='stylesheet' href='DataTables/media/css/jquery.dataTables.min.css'/>	
		<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="DataTables/media/js/jquery.dataTables.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="fonctions.js"></script>
    <script src="js/saisie_clients.js"></script>

  </head>
  <body>
    <div class="container">
      <?php include("header.php");
      			include("menu.php");

						/* retourne un menu qui change en fonction de la page et du visiteur ( de ses droits ) */
						afficherMenuEtTitre(1,'commandeBEE');
						if($_SESSION['identification'])
						{
						
							// on vérifie que l'index fonction de post est bien instanciée et on définit des variables js en fonction de sa valeur. Ses variables vont définir le comportement du formulaire qui a globalement trois rôles :
									// saisie d'un client pour une vente -> après validation -> redirection vers saisie_vente
									// maj des données d'un client qui necessite une expédition -> redirection vers identification_client
									// maj des données d'un client qui veut acheter immédiatement -> redirection vers saisie IMEI
									// et peut être une quatrième : maj des infos d'un client
								echo '<script>';
								echo 'var erreur_post=-1;';
								if(empty($_POST['fonction']))
								{
										echo 'erreur_post=0;';
								}
								else
								{
										echo 'var fonction = "'.$_POST['fonction'].'";'; // définition de la variable fonction qui va dicter le comportement du formulaire

										if($_POST['fonction']=='maj_client_expe' && (empty($_POST['pseudo']) || empty($_POST['prenom']) || empty($_POST['nom'])))
										{
												echo 'erreur_post=1;';
										}

										if($_POST['fonction']=='maj_client_immediate') 
												if(empty($_POST['pseudo']) || empty($_POST['prenom']) || empty($_POST['nom']) || empty($_POST['id_vente']))
														echo 'erreur_post=2;';
												else
														echo 'var id_vente = "'.$_POST['id_vente'].'";'; 
										
										if($_POST['fonction']=='retirer_boutique' && (empty($_POST['prenom']) || empty($_POST['nom']) || empty($_POST['pseudo'])))
										{
												echo 'erreur_post=4;';
										}

										if(!in_array($_POST['fonction'],array('insert_client','maj_client_expe','maj_client_immediate','retirer_boutique')))
										{
												echo 'erreur_post=3;';
										}
								}

								echo '</script>';
			?>
			<section class="contenu">
				<article>
					<div class="row">
						<form class="col-lg-offset-2 col-lg-8  well">	
							<div class="row ">
								<div class="col-lg-10 col-lg-offset-1">
									<h1 class="Bold ">
									<?php
										if($_POST['fonction']=='insert_client')
												echo "Formulaire de saisie d'un nouveau client";
										elseif($_POST['fonction']=='maj_client_expe')
												echo "Saisie des données pour l'expédition au client";
										elseif($_POST['fonction']=='maj_client_immediate')
												echo "Saisie des données pour vente immédiate";
										elseif($_POST['fonction']=='retirer_boutique')
												echo "Saisie des données client pour remise du produit en boutique plus tard";
									?>
									</h1>
								</div>
							</div>
							<legend>
									Identité
							</legend>
							<div class="form-group row">
								<div class="col-lg-4">
									<label for="pseudo">Pseudonyme</label>
									<?php
											if($_POST['fonction']=='insert_client')
													echo '<input type="text" name="pseudo" id="pseudo" class="form-control" required/>';
											elseif(in_array($_POST['fonction'],array('maj_client_expe','maj_client_immediate','retirer_boutique')))
													echo '<input type="text" name="pseudo" id="pseudo" class="form-control" value="'.$_POST['pseudo'].'" required/>';
									?>
								</div>
								<div class="col-lg-4">
									<label for="prenom">Prénom</label>
									<?php
											if($_POST['fonction']=='insert_client')
													echo '<input type="text" name="prenom" id="prenom" class="form-control" required/>';
											elseif(in_array($_POST['fonction'],array('maj_client_expe','maj_client_immediate','retirer_boutique')))
													echo '<input type="text" name="prenom" id="prenom" class="form-control" value="'.$_POST['prenom'].'"required/>';
									?>
								</div>
								<div class="col-lg-4">
									<label for="nom">Nom</label>
									<?php
											if($_POST['fonction']=='insert_client')
													echo '<input type="text" name="nom" id="nom" class="form-control" required/>';
											elseif(in_array($_POST['fonction'],array('maj_client_expe','maj_client_immediate','retirer_boutique')))
													echo '<input type="text" name="nom" id="nom" class="form-control" value="'.$_POST['nom'].'" required/>';
									?>
								</div>
							</div>
							<legend>
									Contacts
							</legend>
							<div class="form-group row">
								<div class="col-lg-4">
									<label for="mail">Adresse mail</label>
									<input type="text" name="mail" id="mail" class="form-control"/>
								</div>
								<div class="col-lg-4">
									<label for="tel1">Téléphone n°1</label>
									<input type="text" name="tel1" id="tel1" class="form-control"/>
								</div>
								<div class="col-lg-4">
									<label for="tel2">Téléphone n°2</label>
									<input type="text" name="tel2" id="tel2" class="form-control"/>
								</div>
							</div>
							<legend>
									Lieu de livraison
							</legend>
							<div class="form-group row">
								<div class="col-lg-3">
									<label for="adresse_liv">Adresse de livraison</label>
									<input type="text" name="adresse_liv" id="adresse_liv" class="form-control"/>
								</div>
								<div class="col-lg-3">
									<label for="ville_liv">Ville de livraison</label>
									<input type="text" name="ville_liv" id="ville_liv" class="form-control"/>
								</div>
								<div class="col-lg-3">
									<label for="region_liv">Région de livraison</label>
									<input type="text" name="region_liv" id="region_liv" class="form-control"/>
								</div>
								<div class="col-lg-3">
									<label for="pays_liv">Pays de livraison</label>
									<input type="text" name="pays_liv" id="pays_liv" class="form-control"/>
								</div>
							</div>
							<legend>
									Lieu de facturation
							</legend>
							<div class="form-group row">
								<div class="col-lg-3">
									<label for="adresse_fac">Adresse de facturation</label>
									<input type="text" name="adresse_fac" id="adresse_fac" class="form-control"/>
								</div>
								<div class="col-lg-3">
									<label for="ville_fac">Ville de facturation</label>
									<input type="text" name="ville_fac" id="ville_fac" class="form-control"/>
								</div>
								<div class="col-lg-3">
									<label for="region_fac">Région de facturation</label>
									<input type="text" name="region_fac" id="region_fac" class="form-control"/>
								</div>
								<div class="col-lg-3">
									<label for="pays_fac">Pays de facturation</label>
									<input type="text" name="pays_fac" id="pays_fac" class="form-control"/>
								</div>
							</div>
							<legend>
									Commentaires
							</legend>
							<div class="row form-group">
								<div class="col-lg-8 col-lg-offset-2">
									<label for="commentaire">Commentaires</label>
									<textarea name="commentaire" id="commentaire" class="form-control"></textarea>
								</div>
							</div>
							<div class="row">
								<div style="border-bottom: 1px solid #E5E5E5;" class="col-lg-offset-2 col-lg-8"></div>
							</div>
							</br>

							<?php
									if($_POST['fonction']=='insert_client')
									{	
							?>
							<div class="row form-group" id="commandes_formulaires">
								<div class="col-lg-3 col-lg-offset-3">
									<button class="btn btn-default form-control" id="saisie_vente" type="submit"> Saisie de la vente </button>
								</div>
								<div class="col-lg-3">
									<button type="submit" class="btn btn-primary form-control"> Enregistrer </button>
								</div>
							</div>
							<?php
									}
									elseif(in_array($_POST['fonction'],array('maj_client_expe','maj_client_immediate','retirer_boutique')))
									{
							?>
							<div class="row form-group" id="commandes_formulaires">
								<div class="col-lg-4 col-lg-offset-4">
									<button class="btn btn-primary form-control" id="maj_client_pour_expe" type="submit"> 
										<?php
												if(in_array($_POST['fonction'],array('maj_client_expe','retirer_boutique')))
														echo 'Finir la vente';
												else
														echo 'Vers saisie des IMEI';
										?>
									</button>
								</div>
							</div>
							<?php
									}
							?>
						</form>
					</div>

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
  </body>
</html>

