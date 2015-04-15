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
								include("traitement_bdd/connexion.php");
								afficherMenuEtTitre(1,'demandes_zfw');
			?>
			<ul class="nav nav-tabs">
					<li class="active"><a href="#saisie_demande" data-toggle="tab">Saisie des demandes de produits de ZFW</a></li>
					<li><a href="#modification_demande" data-toggle="tab">Modification des demandes de produits de ZFW</a></li>
			</ul>
			<div class="tab-content">
					<div class="tab-pane active" id="saisie_demande">		
						<section class="row contenu">
							<article class="col-lg-offset-3 col-lg-6">
									<h3 class="row titre_page">
										Espace de saisie des demandes de produits de ZFW
									</h3>
									<div class="row">
										<form class="well col-lg-offset-2 col-lg-8" method="post" action="traitement_bdd/saving_dmd_zfw.php">
												<legend>Origine de la demande</legend>
												<div class="form-group">
													<label for="password">Canal de distribution </label>
													<select id="canal_distri" name="canal_distri" class="form-control">
														<option value="" selected></option>
														<?php
																$data = $bdd->query('SELECT DISTINCT libelle FROM canal_de_distribution');
																while ($valeur = $data->fetch())
																{
																		echo '<option value="' . $valeur['libelle'] . '">' .  $valeur['libelle'] . '</option>';
																}
														?>
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
														<option value="" selected></option>
													<?php
															$data = $bdd->query('SELECT DISTINCT marque FROM produit');
															while ($valeur = $data->fetch())
															{
																	echo '<option value="' . $valeur['marque'] . '">' .  $valeur['marque'] . '</option>';
															}
													?>
													</select>
												</div>
												<div class="form-group">
												</div>
												<div class="form-group">
												</div>
												<button type="submit" class="btn btn-danger centrer"> Submit </button>
										</form>
									</div>
							</article>
						</section>
					</div>
					<div class="tab-pane" id="modification_demande">
						<p> Espace de saisie des modifications des demandes </p>
					</div>
			</div>
				
			
			
			
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
		<script src="bootstrap/js/jquery-1.11.2.js"></script> 
    <script src="bootstrap/js/bootstrap.min.js"></script>
		<script>
				$(function() {
						// pour gérer le champ marque (lecture bbd + ajout champ modele et suppression du champ etat si changement)
						$('#marque').change(function(){
								$('.form-group:eq(3)').load('traitement_bdd/ajax_demandes_zfw.php',{marque:$('#marque').val(),type: 'marque'});
								$('#etat').remove();
								$('[for="etat"]').remove();
						});
						//pour ajouter le champ etat (lecture bdd + ajout champ label si changement )
						$('.form-group:eq(3)').on('change', "#modele", function(){
								$('.form-group:eq(4)').load('traitement_bdd/ajax_demandes_zfw.php',{modele:$('#modele').val(),type: 'modele'});
						});
						// partie vérification du formulaire
						$('form').submit(function(){
								var canal_valide = check_select($('#canal_distri'));		
								var marque_valide = check_select($('#marque'));		
								var modele_valide = check_select($('#modele'));		
								var etat_valide = check_select($('#etat'));
								var quantite_valide = check_nombre_entier($('#quantite'));
								if(marque_valide && modele_valide && canal_valide && etat_valide && quantite_valide)
								{
										var c = confirm("Etes vous sur de vouloir continuer ?");
										return c;
								}
								else
								{
										alert("Erreur de saisie : veuillez modifier votre saisie !");
										return false;
								}

						});
						// fonctions qui vérifie les champs

						// fonction qui vérifie que les select ne soient pas vides
						function check_select(select){
								if(select.val()=="")
								{
										surligne(select,true);
										return false;
								}
								else
								{
									
										surligne(select,false);
										return true;
								}
						}
						// fonction qui verifie que les quantités soient entières dans un input
						function check_nombre_entier(input){
								if(!/^\d{1,2}$/.test(input.val()))
								{
										surligne(input,true);
										return false;
								}
								else
								{
									
										surligne(input,false);
										return true;
								}
						}
						//fonction qui modifie l'apparence du champ si mal rempli
						function surligne(champ,erreur)
						{
								if(erreur)
								{
										champ.css('border-color','red');
								}
								else
								{
										champ.css('border-color','');
								}
						}
				});
		</script>
  </body>
</html>
