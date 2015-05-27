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
  </head>
  <body>
    <div class="container">
      <?php include("header.php");
      			include("menu.php");
						include("traitement_bdd/connexion.php");

						/* retourne un menu qui change en fonction de la page et du visiteur ( de ses droits ) */
						afficherMenuEtTitre(1,'commandeBEE');
						if($_SESSION['identification'])
						{
			?>
			<section class="contenu">
				<article>
					<div class="row">
						<form class="col-lg-offset-2 col-lg-8  well">	
							<div class="row ">
								<div class="col-lg-10 col-lg-offset-1">
									<h1 class="Bold ">
										Saisie des ventes
									</h1>
								</div>
							</div>
							<legend>
									Vendeur et lieux de vente
							</legend>
							<div class="form-group row">
								<div class="col-lg-4 col-lg-offset-2">
									<label for="id_vendeur">Identifiant du vendeur</label>
									<select id="id_vendeur" name="id_vendeur" class="form-control">
										<option value="" selected></option>
										<?php
												$data = $bdd->query("SELECT identifiant FROM utilisateur where code_profile='VEND'");
												while ($valeur = $data->fetch())
												{
														echo '<option value="' . $valeur['identifiant'] . '">' .  $valeur['identifiant'] . '</option>';
												}
												$data->closeCursor();
										?>
									</select>
								</div>
								<div class="col-lg-4">
									<label for="ref_canal_distrib">Canal de distribution</label>
									<input type="ref_canal_distrib" name="ref_canal_distrib" id="ref_canal_distrib" class="form-control" required readonly="true"/>
								</div>
							</div>
							<legend>
									Produit vendu et quantité
							</legend>
							<div class="form-group row">
								<div class="col-lg-3">
									<label for="marque"> Marque </label>
									<select id="marque" name="marque" class="form-control">
										<option value="" selected></option>
										<?php
												$data = $bdd->query("SELECT distinct marque FROM produit");
												while ($valeur = $data->fetch())
												{
														echo '<option value="' . $valeur['marque'] . '">' .  $valeur['marque'] . '</option>';
												}
												$data->closeCursor();
										?>
									</select>
								</div>
								<div class="col-lg-3">
									<label for="modele"> Modèle </label>
									<select id="modele" name="modele" class="form-control">
										<option value="" selected></option>
									</select>
								</div>
								<div class="col-lg-3">
									<label for="etat"> Etat </label>
									<select id="etat" name="etat" class="form-control">
										<option value="" selected></option>
									</select>
								</div>
								<div class="col-lg-3">
									<label for="qte_vendu"> Quantité</label>
									<input type="text" name="qte_vendu" id="qte_vendu" class="form-control" required/>
								</div>
							</div>
							<legend>
									Disponibilité du produit
							</legend>
							<div class="form-group row">
								<div class="col-lg-4 col-lg-offset-2">
									<label for="lieu_stockage"> Lieu de stockage </label>
									<select id="lieu_stockage" name="lieu_stockage" class="form-control">
										<option value="" selected></option>
									</select>
								</div>
								<div class="col-lg-4">
									<label for="qte_dispo"> Quantité disponible </label>
									<input type="text" name="qte_dispo" id="qte_dispo" class="form-control" readonly='true' required/>
								</div>
							</div>
							<legend>
									Acheteur
							</legend>
							<div class="form-group row">
								<div class="col-lg-4">
									<label for="pseudo"> Pseudo</label>
									<?php
											echo '<input type="text" name="pseudo" id="pseudo" class="form-control" required value="'.$_POST['pseudo'].'"/>';
									?>
								</div>
								<div class="col-lg-4">
									<label for="prenom"> Prénom </label>
									<?php
											echo '<input type="text" name="prenom" id="prenom" class="form-control" required value="'.$_POST['prenom'].'"/>';
									?>
								</div>
								<div class="col-lg-4">
									<label for="nom"> Nom </label>
									<?php
											echo '<input type="text" name="nom" id="nom" class="form-control" required value="'.$_POST['nom'].'"/>';
									?>
								</div>
							</div>
							<legend>
									Devise et prix de la vente
							</legend>
							<div class="form-group row">
								<div class="col-lg-4">
									<label for="devise"> Devise</label>
									<select id="devise" name="devise" class="form-control">
										<option value="" selected></option>
										<?php
												$data = $bdd->query("SELECT distinct libelle FROM devise");
												while ($valeur = $data->fetch())
												{
														echo '<option value="' . $valeur['libelle'] . '">' .  $valeur['libelle'] . '</option>';
												}
												$data->closeCursor();
										?>
									</select>
								</div>
								<div class="col-lg-4 col-lg-offset-4">
									<label for="prix_usd"> Prix unitaire en dollard (indicatif)</label>
									<input type="text" name="prix_usd" id="prix_usd" class="form-control" readonly='true' required/>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-lg-4 col-lg-offset-2">
									<label for="montant_total"> Montant total de la vente</label>
									<input type="text" name="montant_total" id="montant_total" class="form-control" required/>
								</div>
								<div class="col-lg-4">
									<label for="prix_devise"> Prix unitaire de la vente</label>
									<input type="text" name="prix_devise" id="prix_devise" class="form-control" required/>
								</div>
							</div>
							<div class="row">
								<div style="border-bottom: 1px solid #E5E5E5;" class="col-lg-offset-2 col-lg-8"></div>
							</div>
							</br>
							<div class="row form-group">
								<div class="col-lg-offset-4 col-lg-4">
									<button type="submit" class="btn btn-primary form-control" value="a_retirer_en_boutique" > A retirer en boutique </button>
								</div>
							</div>
							<div class="row form-group">
								<div class="col-lg-offset-4 col-lg-4">
									<button value="a_livrer" type="submit" class="btn btn-default form-control" > A livrer </button>
								</div>
							</div>
							<div class="row form-group">
								<div class="col-lg-offset-4 col-lg-4">
									<button type="submit" class="btn btn-primary form-control" value="vente_immediate" > Vente immédiate </button>
								</div>
							</div>
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
		<script>
				$(function(){
									// lorque que le champ marque cela charge les modèles correspondants dans le champ modèle
									$('#marque').change(function(){
											$.ajax({
													url: 'traitement_bdd/chargement_marque_modele_etat_cmde_fournisseurs.php',
													type: "POST",
													async: false,
													data: { marque: $(this).val(), type: "marque" }, 
													success: function(html) { 								
															$('#modele').html(html);
													}
											});
											$('#modele').trigger('change');
									});
							// lorque que le champ modele change cela charge les états correspondants dans le champ modèle
									$('#modele').change(function(){
											$.ajax({
													url: 'traitement_bdd/chargement_marque_modele_etat_cmde_fournisseurs.php',
													type: "POST",
													async: false,
													data: { modele: $(this).val(), type: "modele" }, 
													success: function(html) { 								
															$('#etat').html(html);
															$('#etat').trigger('change');
													}
											});
									});

							// lorque le champ "identifiant du vendeur" change cela change la ref_canal_distrib correspondante
									$('#id_vendeur').change(function(){
											$.ajax({
													dataType: "json",
													url: 'traitement_bdd/saisie_ventes_remplissage_form.php',
													type: "POST",
													data: { id_vendeur: $(this).val() }, 
													success: function(rep) {
															if(rep[0])
															{
																	$('#ref_canal_distrib').val(rep[1]);

															}
															else
															{
																	alert("qqch s'est mal passé : ".rep[1]);
															}
													}
											});
									});


							// lorque que le champ etat change et qu'il n'est pas vide cela charge les stocks qui contiennent le produit défini par la marque, le modèle et l'état correspondant
							// et cela charge aussi le prix usd
									$('#etat').change(function(){
													$.ajax({
															dataType: "json",
															url: 'traitement_bdd/saisie_ventes_remplissage_form.php',
															type: "POST",
															async: false,
															data: { marque: $('#marque').val(), modele: $('#modele').val(), etat: $('#etat').val(), id_vendeur_canal: $(id_vendeur).val() }, 
															success: function(ret) {
																	if(ret[0])
																	{
																			$('#lieu_stockage').html(ret[1][1]);
																			$('#lieu_stockage').trigger('change');
																			if(ret[1][0]==0) // si le prix usd n'est pas dans le catalogue
																					alert("Le prix en dollard pour ce produit et ce canal de distribution n'est pas dans le catalogue. \n Vous pouvez tout de même saisir un prix \n Veuillez prévenir l'administrateur pour l'ajouter");
																			$('#prix_usd').val(ret[1][0]);
																	}
																	else
																			alert('problème : '+ret[1]);
															}
													});
									});
							// lorque que le champ lieu_stockage change, on charge les quantitées disponibles correspondantes
									$('#lieu_stockage').change(function(){
											if($(this).val()!='')
											{	
													$.ajax({
															dataType: "json",
															url: 'traitement_bdd/saisie_ventes_remplissage_form.php',
															type: "POST",
															data: { marque: $('#marque').val(), modele: $('#modele').val(), etat: $('#etat').val(),  lieu_stockage: $(this).val() }, 
															success: function(ret) {
																	if(ret[0])
																	{
																			$('#qte_dispo').val(ret[1]);
																	}
																	else
																			alert('problème : '+ret[1]);
															}
													});
											}
											else
											{
													$('#qte_dispo').val('');	
											}
									});
							
							// lorque que le champ devise change et qu'il n'est pas vide cela charge le prix dans cette devise
									$('#devise').change(function(){
													$.ajax({
															dataType: "json",
															url: 'traitement_bdd/saisie_ventes_remplissage_form.php',
															type: "POST",
															async: false,
															data: { marque: $('#marque').val(), modele: $('#modele').val(), etat: $('#etat').val(), id_vendeur3: $(id_vendeur).val(), devise: $(devise).val(), prix_usd: $(prix_usd).val() }, 
															success: function(ret) {
																	if(ret[0])
																	{
																			if(!ret[1][0])
																			{
																					if(!isNaN($(prix_usd).val()))
																							alert("Le prix dans la devise sélectionnée n'est pas dans le catalogue. Contacter l'administrateur pour lui demander de l'ajouter.\nLe prix proposé est simplement la conversion du prix en dollard dans la devise sélectionnée"); 	
																					else
																							alert("Le prix pour ce produit et cette ref_canal_distrib n'exsite dans pas dans la devise sélectionnée dans le catalogue. De plus, aucune convertion ne peut être proposée car le prix en dollard n'existe pas dans le catalogue aussi. Vous pouvez cependant saisir un prix pour finaliser la vente. \n Contactez l'administrateur pour ajouter ces prix au catalogue");										
																			}
																			$('#prix_devise').val(ret[1][1]);
																			$('#prix_devise').trigger('change');
																	}
																	else
																			alert('problème : '+ret[1]);
															}
													});
									});

// lorsque le champ prix unitaire de la vente change, on demande à rentrer la quantité si ce champ est vide puis on calcule le montant total de la vente
				
									$('#prix_devise').change(function(){
											if(!isNaN($('#prix_devise').val()))
											{
													$("#montant_total").val($('#qte_vendu').val()*$('#prix_devise').val());
											}
											else
													$("#montant_total").val('prix unitaire inexistant');
									});
								

// partie soumission du formulaire lorque l'on clique sur "enregistrer"
						// pour connaitre le bouton de soumission du formulaire
								var buttonpressed;
								$('[type="submit"]').click(function() {
										buttonpressed = $(this).attr('value');
								})

								// soumission du formulaire
								$('form:eq(0)').on('submit',function(e){

										e.preventDefault();
				//première partie : vérification du bon remplissage des champs		



				// deuxième partie, si champs bien remplis alors on envoie le formulaire
										
										var id_vente={}; // pour récupérer l'id de la vente que l'on insère à la soumission du formulaire
										// Envoi de la requête HTTP en mode asynchrone
										var infos_vente = $(this).serializeArray();
										infos_vente.push({name: 'fonction', value: buttonpressed });
										console.log(infos_vente);
										$.ajax({
												dataType: "json",
												url: 'traitement_bdd/saving_ventes.php', // Le nom du fichier indiqué dans le formulaire
												type: 'POST', // La méthode indiquée dans le formulaire (get ou post)
												data: infos_vente, 
												success: function(retour) { // Je récupère la réponse du fichier PHP
														if(retour[0]) // si il y pas d'erreur
														{
																var maj_client={};// ce tableau contient les données pour préremplir le formulaire de maj des données client
																$('form:eq(0)')[0].reset();
																if(buttonpressed=='vente_immediate')
																{
																		maj_client['id_vente']=retour[1]; // on ajoute la ref de la vente dans le cas d'une vente immédiate afin de pouvoir saisr les IMEI après maj des données clients
																		maj_client['fonction']='maj_client_immediate'; // permet de définir le comportement du formulaie de saisie des clients. C'est grâce à cette infos que l'on redirige vers saisie_imei par la suite
																}
																else if(buttonpressed=='a_livrer')
																{
																		maj_client['fonction']='maj_client_expe';// permet de définir le comportement du formulaire de saisie des clients 
																}
																else if(buttonpressed=='a_retirer_en_boutique')
																{
																		maj_client['fonction']='retirer_boutique';// permet de définir le comportement du formulaire de saisie des clients
																		
																}
																// on remplit le tableau avec les infos du client
																maj_client['pseudo']=$('#pseudo').val();
																maj_client['prenom']=$('#prenom').val();
																maj_client['nom']=$('#nom').val();
																post('saisie_clients.php',maj_client);// on redirige vers saisie_clients.php

														}
														else //si il y a une erreur
														{
																alert(retour[1]);
														}
												}
										});
								});
						


				});
		</script>
  </body>
</html>

