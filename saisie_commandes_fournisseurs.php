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
		<title> Saisie des commandes fournisseurs</title>
    <meta charset="utf-8">
		<link rel="stylesheet" href="css_form_validation/screen.css">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/tuto.css" rel="stylesheet">
    <link rel='stylesheet' href='DataTables/media/css/jquery.dataTables.min.css'/>	
		<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="DataTables/media/js/jquery.dataTables.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js"></script>
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
					<h3 class="row titre_page">
						<div class="centrer_texte">
							Liste des demandes de produits non satisfaites
						</div>
					</h3>
					<div class="row">
						<div class="col-lg-offset-1 col-lg-10">
							<table id="table_demandes" class="display" width="100%" cellspacing="0">
									<thead>
											<tr>
													<th>Canal de distribution</th>
													<th>identifiant canal de distribution</th>
													<th>Réf demande</th>
													<th>date demande</th>
													<th>date dernière maj</th>
													<th>Utilisateur</th>
													<th>Réf produit</th>
													<th>Marque</th>
													<th>Modèle</th>
													<th>Etat</th>
													<th>Quantité commandée</th>
													<th>Quantité demandée</th>
													<th>Montant prépayement</th>
											</tr>
									</thead>
					 
									<tfoot>
											<tr>
													<th>Canal de distribution</th>
													<th>identifiant canal de distribution</th>
													<th>Réf demande</th>
													<th>date demande</th>
													<th>date dernière maj</th>
													<th>Utilisateur</th>
													<th>Réf produit</th>
													<th>Marque</th>
													<th>Modèle</th>
													<th>Etat</th>
													<th>Quantité commandée</th>
													<th>Quantité demandée</th>
													<th>Montant prépayement</th>
											</tr>
									</tfoot>
							</table>
						</div>
					</div>
					<article>
						<div class="row">
							<h3 style="text-align:center" class="row col-lg-offset-3 col-lg-6 titre_page">Saisie des commandes fournisseurs</h3>
						</div>
						<div class="row">
							<form class="col-lg-12 well" id="cmde_fournisseurs" action="traitement_bdd/saving_commandes_fournisseurs.php" method="post">
								<legend> Entête de la commande </legend>
								<!-- 1ère ligne : entête de la commande : nom fournisseur + ref_externe + date ?-->
								<div class="row form-group">
									<div class="col-lg-4 col-lg-offset-2">
										<label for="ref_externe">Référence externe</label>
										<input type="text" name="ref_externe" id="ref_externe" class="form-control" required>
									</div>
									<div class="col-lg-4">
										<label for="fournisseur">Nom du fournisseur</label>
										<select name="fournisseur" id="fournisseur" class="form-control"required>
												<option value="" selected></option>
												<?php
														$data = $bdd->query('SELECT DISTINCT nom, ref_fournisseur FROM fournisseur');
														while ($valeur = $data->fetch())
														{
																echo '<option value="' . $valeur['ref_fournisseur'] . '">' .  $valeur['nom'] . '</option>';
														}
														$data->closeCursor();
												?>
										</select>
									</div>
								</div>
								<legend> Détails de la commande </legend>
								<!-- 2ème ligne : champs de saisie d'une ligne de commande fournisseur-->

								<div class="row form-group ligne_champs">
									<div class="row">
										<h3 class="col-lg-offset-5 col-lg-2 Bold"> Ligne n° 1 </h3></br>
										<div class="col-lg-offset-3 col-lg-2">
											<button type="button" class="btn  btn-primary form-control">
												Delete
											</button>
										</div>
									</div>
									<div class="row form-group">

										<div class="col-lg-2">
											<label for="marque1">Marque</label>
											<select name="marque1" id="marque1" class="form-control" required>
												<option value="" selected></option>
												<?php
														$data = $bdd->query('SELECT DISTINCT marque  FROM produit');
														while ($valeur = $data->fetch())
														{
																echo '<option value="' . $valeur['marque'] . '">' .  $valeur['marque'] . '</option>';
														}
														$data->closeCursor();
												?>
											</select>
										</div>
										<div class="col-lg-4">
											<label for="modele1">Modèle</label>
											<select name="modele1" id="modele1" class="form-control" required>
												<option selected="selected"></option>    
											</select>
										</div>
										<div class="col-lg-6">
											<label for="etat1">Etat</label>
											<select name="etat1" id="etat1" class="form-control" required>
												<option selected="selected"></option>    
											</select>
										</div>
									</div>
									<div class="row form-group">
										<div class="col-lg-offset-2 col-lg-2">
											<label for="ref_dmd_zfw1">Réf demande zfw</label>
											<select name="ref_dmd_zfw1" id="ref_dmd_zfw1" class="form-control" >
												<option value="" selected ></option>
												<?php
														$data = $bdd->query('SELECT DISTINCT ref_dde_zfw  FROM demande_zfw where qte_ddee!=qte_cmdee');
														while ($valeur = $data->fetch())
														{
																echo '<option value="' . $valeur['ref_dde_zfw'] . '">' .  $valeur['ref_dde_zfw'] . '</option>';
														}
														$data->closeCursor();
												?>
											</select>
										</div>
										<div class="col-lg-2">
											<label for="qte_cmde1">Quantitée commandée</label>
											<input type="text" name="qte_cmde1" id="qte_cmde1" class="form-control" required/>
										</div>
										<div class="col-lg-2">
											<label for="prix_unitaire1">Prix unitaire</label>
											<input type="text" name="prix_unitaire1" id="prix_unitaire1" class="form-control" required/>
										</div>
										<div class="col-lg-2">
											<label for="code_devise1">Code devise</label>
											<select name="code_devise1" id="code_devise1" class="form-control" required>
												<option value="" selected></option>
												<?php
														$data = $bdd->query('SELECT DISTINCT libelle, code_devise  FROM devise');
														while ($valeur = $data->fetch())
														{
																echo '<option value="' . $valeur['code_devise'] . '">' .  $valeur['libelle'] . '</option>';
														}
														$data->closeCursor();
												?>
											</select>
										</div>
									</div>
								</div>
								<legend> Commentaire </legend>
								<div class="row form-group">
									<div class="col-lg-8 col-lg-offset-2">
										<label for="commentaire">Commentaires</label>
										<textarea name="commentaires" id="commentaires" class="form-control"></textarea>
									</div>
								</div>
								<div class="row" id='commandes'>
									<div class="col-lg-3 col-lg-offset-3">
										<button class="btn btn-default form-control" type="button" id="ajouter">Ajouter</button>
									</div>
									<div class="col-lg-3">
										<button type="submit" class="btn btn-danger form-control" id="valider"> Valider </button>
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
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <script>
					

			$(function() {
			// gestion de la validation du formulaire
			$("form").validate();

			//cela permet de remplir et de paramétrer la DataTable : liste des demandes
					var table_dmd=$('#table_demandes').dataTable( {
        			ajax: {
									"url": "traitement_bdd/chargement_table_demande_cmde_fournisseurs.php",
									"type": "POST"
							},
							lengthMenu: [[3, 5,10,15,-1], [3, 5, 10, 15,"Toutes"]],
							columnDefs: [
									{
											"targets": [ 1 ],
											"visible": false,
											"searchable": false
									},									
									{
											"targets": [ 2 ],
											"visible": false,
									},
									{
											"targets": [ 5 ],
											"visible": false,
									},
									{
											"targets": [ 6 ],
											"visible": false,
											"searchable": false
									},
									{
											"targets": [ 7 ],
											"visible": false,
									}
							],
							responsive: true
    			});
			// ajout de l'événèment clique sur le bouton delete pour supprimer la ligne
					$('div button:eq(0)').click(function(){
							$(this).parent().parent().parent().remove();
							maj_name();
					});

			// lorque que le champ marque cela charge les modèles correspondants dans le champ modèle
					$('.ligne_champs select:eq(0)').change(function(){
							var select_marque_ligne=$('select:eq(0)',$(this).parent().parent());
							var select_modele_ligne=$('select:eq(1)',$(this).parent().parent());
							var select_marque_ligne=this;
							var select_etat_ligne=$('select:eq(2)',$(this).parent().parent());
							$.ajax({
									url: 'traitement_bdd/chargement_marque_modele_etat_cmde_fournisseurs.php',
									type: "POST",
									async: false,
									data: { marque: $(this).val(), type: "marque" }, 
									success: function(html) { 								
											$(select_modele_ligne).html(html);
									}
							});
					});
			// lorque que le champ modele cela charge les états correspondants dans le champ modèle
					$('.ligne_champs select:eq(1)').change(function(){
							console.log('changement modèle');
							var select_marque_ligne=$('select:eq(0)',$(this).parent().parent());
							var select_etat_ligne=$('select:eq(2)',$(this).parent().parent());
							$.ajax({
									url: 'traitement_bdd/chargement_marque_modele_etat_cmde_fournisseurs.php',
									type: "POST",
									async: false,
									data: { modele: $(this).val(), type: "modele" }, 
									success: function(html) { 								
											$(select_etat_ligne).html(html);
									}
							});
					});

			// affiche sélectionnez d'abord une marque si on clique sur le champ modèle et qu'il est vide et que aucune marque n'a été sélectionné
					$('.ligne_champs select:eq(1)').click(function(){
							var select_marque_ligne=$('select:eq(0)',$(this).parent().parent());
							if($(this).val()=='' && $(select_marque_ligne).val()=='')
									alert("Sélectionnez d'abord une marque");
					});

			// affiche sélectionnez d'abord un modèle si on clique sur le champ état et qu'il est vide et que aucun modèle  n'a été sélectionné
					$('.ligne_champs select:eq(2)').click(function(){
							var select_modele_ligne=$('select:eq(1)',$(this).parent().parent());
							if($(this).val()=='' && $(select_modele_ligne).val()=='')
									alert("Sélectionnez d'abord un modèle");
					});
			// variable qui contient la toute première ligne vide du formulaire qu'on utilise par la suite pour insérer des lignes
					var clone_first_empty = $('div[class="row form-group ligne_champs"]');
					clone_first_empty=$(clone_first_empty).clone(true);



			// fonction pour renvoyer la première ligne vide du formulaire
			function first_empty_row()
			{
					var first_empty_row=-1;
					$('[class*="ligne_champs"]').each(function(num_ligne){
							var champs_vide=true;
							var selects_vide=true;
							selects_vide = $('select',this).each(function(){
									if($(this).val()!="")
									{
											champs_vide=false;
											return false;
									}
							});
							if(selects_vide==true)
							{
									$('input',this).each(function(){
											if($(this).val()!="")
											{
													champs_vide=false;
													return false;
											}
									});
							}
							if(champs_vide==true)
							{
									first_empty_row=num_ligne+1;
									return false;
							}
							
					});
					return first_empty_row;
			}

			// fonction pour ajouter une ligne vide au formulaire
					function ajout_ligne_vide()
					{
							var new_ligne_champs_vide=clone_first_empty.clone(true);
							$('legend:last').before(new_ligne_champs_vide);
							maj_name();
					}
			// pour que cela ajoute une ligne quand on clique sur le bouton ajouter
					$('#ajouter').click(function(){
							ajout_ligne_vide();
					});
			// fonction pour mettre à jour les name des champs après insertion ou suppression de ligne
					function maj_name()
					{
							$('[class*="ligne_champs"]').each(function(num_ligne){
									maj_name_dune_ligne_de_champs(this,num_ligne+1);
							});
					}
			// fonction qui change les name des champs d'une ligne. Elle se contente de changer le numéro de ligne du name par celui qui lui est communiqué
					function maj_name_dune_ligne_de_champs(ligne_de_champs,num_row)
					{
							$('[name]',ligne_de_champs).each(function(){
									// maj des names
									var name_courant = $(this).attr('name');
									name_courant=name_courant.replace(/\d+/,num_row);
									$(this).attr('name',name_courant);
									// maj des id
									var id_courant = $(this).attr('id');
									id_courant=id_courant.replace(/\d+/,num_row);
									$(this).attr('id',id_courant);
							});
							// maj des numéro de ligne (titre)
							var titre_courant = $('h3',$(ligne_de_champs)).text();
							$('h3',$(ligne_de_champs)).text(titre_courant.replace(/\d+/,num_row));

							//maj des labels
							$('label',ligne_de_champs).each(function(){
									// maj des names
									var for_courant = $(this).attr('for');
									for_courant=for_courant.replace(/\d+/,num_row);
									$(this).attr('for',for_courant);
							});
							if(num_row%2==0)
							{
									$(ligne_de_champs).css('background-color','white');
							}
							else
							{
									$(ligne_de_champs).css('background-color','#F9F9F9');
							}
					}

			// ajoute ou remplit une ligne du formulaire lorque l'on clique sur une ligne du tableau
					$('tbody:eq(0)').on('click', 'tr', function () {
						var cells =$('td', this);
						var ref_dmd = cells.eq(1).text();
						var ligne = table_dmd.fnGetData( this );
						// variable qui va contenir la ligne à remplir ou à insérer 
						var ligne_a_remplir_ou_inserer=null;

						// on change la couleur de la ligne cliquée pour réduire les erreurs de saisie
						$(this).css('background-color','#717197');

						//récupération des données nécessaire au remplissage du formulaire
						var ref_dmd_zfw=ligne[2];
						var marque=ligne[7];
						var modele=ligne[8];
						var etat=ligne[9];
						var qte_cmdee=ligne[11]-ligne[10];
					
						num_ligne_vide=first_empty_row();
						if(num_ligne_vide==-1)
						{
								ligne_a_remplir_ou_inserer=clone_first_empty.clone(true);	
						}
						else
						{
								ligne_a_remplir_ou_inserer=$('.ligne_champs:eq('+(num_ligne_vide-1)+')')
						}
								// tableau qui contient toutes les valeurs des selects
								var table_vals_selects=[];
								table_vals_selects.push(marque);
								table_vals_selects.push(modele);
								table_vals_selects.push(etat);
								table_vals_selects.push(ref_dmd_zfw);
								// on remplit la ligne de champs qui est soit déjà dans le formulaire soit à insérer par la suite
								$('select',ligne_a_remplir_ou_inserer).each(function(indice){ // on remplit d'abord les selects
												$(this).val(table_vals_selects[indice]);
												if(indice==0 || indice==1)
														$(this).trigger('change');
								});
								$('input[name*="qte"]',ligne_a_remplir_ou_inserer).val(qte_cmdee);// puis on remplit le champ qqte à commander

								// on insère la ligne si il n'y a plus de ligne de champs vides
								if(num_ligne_vide==-1)
										$('legend:last').before(ligne_a_remplir_ou_inserer);
								maj_name();
					});
			});

		</script>
  </body>
</html>

