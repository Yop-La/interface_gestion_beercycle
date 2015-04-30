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
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
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
						afficherMenuEtTitre(1,'commandeZFW');
						if($_SESSION['identification'])
						{
			?>

			<ul class="nav nav-tabs">
					<li class="active"><a href="#fournisseurs" data-toggle="tab">Commandes expédiées par les fournisseurs</a></li>
					<li><a href="#beerecycle" data-toggle="tab">Commandes expédiées par Beerecycle</a></li>
			</ul>
			<div class="tab-content">
					<!-- 1er onglet validation des commandes envoyées par les fournisseurs directement -->
					<div class="tab-pane active" id="fournisseurs">
						<section class="contenu">
							<article>
								<div class="row">
									<div class="col-lg-2 col-lg-offset-1">
										<table id="liste_ref_externe_fourni" class="display" width="100%" cellspacing="0">
												<thead>
														<tr>
																<th>Références externes</th>
																<th>Emetteur</th>
																<th>Suite à demande</th>
														</tr>
												</thead>
								 
												<tfoot>
														<tr>
																<th>Références externes</th>
																<th>Emetteur</th>
																<th>Suite à demande</th>
														</tr>
												</tfoot>
										</table>
									</div>
									<!-- formulaire de validation des commandes fournisseurs -->
									<form class="col-lg-offset-1 col-lg-7  well">	
										<div class="row vertical-align">
											<div class="col-lg-10 col-lg-offset-1">
												<h1 class="Bold ">
													Formulaire de réception des commandes
												</h1>
											</div>
										</div>
										<legend>
												Entête de la commande
										</legend>
										<div class="form-group row">
											<div class="col-lg-3 col-lg-offset-2">
												<label for="fourn_ref_externe">Référence externe</label>
												<input type="text" name="fourn_ref_externe" id="fourn_ref_externe" class="form-control" disabled="disabled" required/>
											</div>
											<div class="col-lg-2">
												<label for="fourn_expediteur">Expéditeur</label>
												<input type="text" name="fourn_expediteur" id="fourn_expediteur" class="form-control" disabled="disabled" required/>
											</div>
											<div class="col-lg-3">
												<label for="fourn_expediteur">Référence demande</label>
												<input type="text" name="fourn_ref_demande" id="fourn_ref_demande" class="form-control" disabled="disabled" required/>
											</div>
										</div>
										<!-- 1ère ligne de la commande -->
										<div class="row" id="ligne_cmde_fourn_1">
											<div class="row vertical-align">
												<div class="col-lg-6 col-lg-offset-4">
													<h3 class="Bold ">
															Ligne de commande n°1
													</h3>
												</div>
												<div class="col-lg-2">
													<button type="button" class="btn  btn-primary form-control">
														Delete
													</button>
												</div>
											</div>
											<!-- validation ou modification des produits -->
											<legend>
													Validation ou modification de la commande
											</legend>
											<div class="form-group row">
												<!-- champ marque -->
												<div class="col-lg-3">
													<label for="fourn_marque1">Marque</label>
													<select name="fourn_marque1" id="fourn_marque1" class="form-control" required>
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
												<!-- champ modèle -->
												<div class="col-lg-8 col-lg-offset-1">
													<label for="fourn_modele1">Modèle</label>
													<select name="fourn_modele1" id="fourn_modele1" class="form-control" required>
														<option selected="selected"></option>    
													</select>
												</div>
											</div>					
											<div class="form-group row">
												<div class="col-lg-offset-1 col-lg-10">
													<!-- champ état -->
													<label for="fourn_etat1">Etat</label>
													<select name="fourn_etat1" id="fourn_etat1" class="form-control" required>
														<option selected="selected"></option>    
													</select>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-lg-offset-4 col-lg-4">
													<!-- champ quantité reçue -->
													<label for="fourn_qte_recue1">Quantitée reçue</label>
													<input type="text" name="fourn_qte_recue1" id="fourn_qte_recue1" class="form-control" required/>
												</div>
											</div>
											<!-- répartition des produits dans les stocks -->
											<legend>
													Répartition des produits dans les stocks
											</legend>
											<div class="form-group row vertical-align" id="repartition_four_stock_ligne1_1">

												<div class="col-lg-4 col-lg-offset-2">
													<!-- champ lieu_stockage -->
													<label for="fourn_ref_lieu_stockage1_1">Lieu de stockage</label>
													<select name="fourn_ref_lieu_stockage1_1" id="fourn_ref_lieu_stockage1_1" class="form-control" required/>
														<option value="" selected></option>
														<?php
																$data = $bdd->query('SELECT libelle, ref_lieu_stockage FROM lieu_stockage');
																while ($valeur = $data->fetch())
																{
																		echo '<option value="' . $valeur['ref_lieu_stockage'] . '">' .  $valeur['libelle'] . '</option>';
																}
																$data->closeCursor();
														?>
													</select>
												</div>			
												<div class="col-lg-4">
													<!-- champ quantité pour le lieu de stockage choisi -->
													<label for="fourn_qte_lieu_stockage1_1">Quantité attribué</label>
													<input type="text" name="fourn_qte_lieu_stockage1_1" id="fourn_qte_lieu_stockage1_1" class="form-control" required/>
												</div>
												<div class="col-lg-2">
													<button type="button" class="btn  btn-primary form-control">
														Delete
													</button>
												</div>
											</div>
											<div class="col-lg-offset-5 col-lg-2 form-group" id="ajout_repartition_four1">
													<button type="button" class="btn  btn-default form-control">
														Ajouter
													</button>
											</div>
										</div>
										<div class="row" id="fin_des_lignes">
											<div style="border-bottom: 1px solid #E5E5E5;" class="col-lg-offset-2 col-lg-8"></div>
										</div>
										</br>
										<div class="row form-group" id="commandes_formulaires">
											<div class="col-lg-3 col-lg-offset-3">
												<button class="btn btn-default form-control ajout_ligne" type="button" >Ajouter</button>
											</div>
											<div class="col-lg-3">
												<button type="submit" class="btn btn-danger form-control" > Valider </button>
											</div>
										</div>
									</form>
								</div>
							<article>
						</section>
					</div>
					<!-- 2eme onglet validation des commandes envoyées par BEE -->
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
    <script src="bootstrap/js/bootstrap.min.js"></script>
		<script>

				$(function() {
// gestion de la réception des commandes envoyées directement par le fournisseur et par bee 
		// cela sert à remplir et à paramétrer la DataTable
						var table_ref_externe = $('#liste_ref_externe_fourni').dataTable( {
								ajax: {
										"url": "traitement_bdd/reception_commande_remplissage_table_ref_externe_fourni.php",
										"type": "POST"

								},
								lengthMenu: [[5,10,15,-1], [5, 10, 15,"Toutes"]],
								columnDefs: [
										{
												"targets": [ 1 ],
												"visible": false,
												"searchable": true
										},									
										{
												"targets": [ 2 ],
												"visible": false,
												"searchable": true
										}
								],
								responsive: true
						});

		// pré-remplissage dur formulaire lorsque que l'on clique sur une ligne du formulaire
					$('#liste_ref_externe_fourni').on('click', 'tr', function () {
						var cells =$('td', this);
						var ligne = table_ref_externe.fnGetData( this );
						var ref_externe=ligne[0];
						var expediteur=ligne[1];
						var ref_demande=ligne[2];
						// on remplit l'entête du formulaire
						$('#fourn_ref_externe').val(ref_externe);
						$('#fourn_expediteur').val(expediteur);
						$('#fourn_ref_demande').val(ref_demande);
	
						// on récupère toutes les données nécessaire au remplissage du formulaire
						$.ajax({
									dataType: "json",
									url: 'traitement_bdd/reception_commandes_zfw_chargement_donnees_formulaire.php',
									type: "POST",
									data: { ref_externe: ref_externe, expediteur: expediteur, ref_demande: ref_demande }, 
									success: function(donnees_cmde) {
											nbre_tot_row=donnees_cmde.length;
											// on doit connaître l'état du formulaire ou le mettre dans un état défini avant d'y insérer les données
											// on actionne tous les boutons supprimer du formulaire
											$('[class*="btn-primary"]').trigger('click');
											for(indice_row=0;indice_row<nbre_tot_row;indice_row++)
											{
													donnees_ligne=donnees_cmde[indice_row];
													// à chaque nouvelle ligne de commande, on ajoute une ligne au formulaire
													$('[class*="ajout_ligne"]').trigger('click');
													// on définie les id de la ligne et des champs dans lesquelles on va insérer les données
													var id_ligne="#ligne_cmde_fourn_"+(indice_row+1);
													var id_marque="#fourn_marque"+(indice_row+1);
													var id_modele="#fourn_modele"+(indice_row+1);
													var id_etat="#fourn_etat"+(indice_row+1);
													var id_qte_recue="#fourn_qte_recue"+(indice_row+1);
				
													//on insère les données
													$(id_marque).val(donnees_ligne[2]);
													$(id_marque).trigger('change');
													$(id_modele).val(donnees_ligne[3]);
													$(id_modele).trigger('change');
													$(id_etat).val(donnees_ligne[4]);
													$(id_qte_recue).val(donnees_ligne[1]);
													var ligne_courante=donnees_cmde[indice_row];


											}
									}
						});
								

					});

		// cette partie gère les liste déroulante marque, modèle et état qui sont des listes déroulantes changeantes en fonction de la valeur choisie des autres
		 			// lorque que le champ marque cela charge les modèles correspondants dans le champ modèle
					$('select:eq(1)').change(function(){
							var select_modele_ligne=$('select:eq(1)',$(this).parent().parent().parent());
							var select_marque_ligne=this;
							var select_etat_ligne=$('select:eq(2)',$(this).parent().parent().parent());
							$.ajax({
									url: 'traitement_bdd/chargement_marque_modele_etat_cmde_fournisseurs.php',
									type: "POST",
									async: false,
									data: { marque: $(this).val(), type: "marque" }, 
									success: function(html) { 								
											$(select_modele_ligne).html(html);
											// cela permet de recharger les données du champ état qui dépendent du champ modèle
											$(select_modele_ligne).trigger('change');
									}
							});
					});
			// lorque que le champ modele cela charge les états correspondants dans le champ modèle
					$('select:eq(2)').change(function(){
							var select_marque_ligne=$('select:eq(0)',$(this).parent().parent().parent());
							var select_etat_ligne=$('select:eq(2)',$(this).parent().parent().parent());
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
// cette partie les ajouts et suppression d'éléments du formulaire
		// fonction pour cloner, ajouter et maj des indices de ligne

						// cette fonction retourne un clone de la ligne dont l'id est id
						function clone_ligne(id)
						{
								var clone = $(id);
								clone=$(clone).clone(true);
								return clone;
						}

						// fonction pour insérer une ligne. Cette fonction insére un clone de clone avant l'élément "id insérer avant" si before=true sinon cela l'insère après.
						function ajout_ligne_vide(clone,id_inserer_avant,before)
						{
								var new_ligne=$(clone).clone(true);
								if(before)
										$(id_inserer_avant).before(new_ligne);
								else
										$(id_inserer_avant).after(new_ligne);
										
						}

						// fonction pour supprimer une ligne. Cela supprime un parent de ligne_cible. Le parent supprimé est celui choisi par nbre_parent. Nbre_parent est un nombre qui représente le ième
						// parent à suprrimer
						function suppression_ligne(ligne_cible,nbre_parent)
						{
								var papa=$(ligne_cible);
								for(var i=1;i<=nbre_parent;i++)
								{
										papa=$(papa).parent()
								}
								$(papa).remove();
						}

						// fonction pour mettre à jour les indices des lignes après suppression ou insertion. Cette fonction met à jour tous les indices des lignes sélectionnées par le sélecteur jquery 
						// "selecteur_ligne". On doit préciser la regex qui va sélectionner la partie à mettre à jour. Par défauti (si element=''), cette fonction met à jour tous les name et tous les 
						// id des lignes ainsi que l'id des lignes. Si on précise un élément particulier, le texte de celui sera mis à jour ( fait pour les titres surtout ).
						function maj_indice_ligne(selecteur_ligne,element_particulier,regex)
						{
								// on parcoure une à une les lignes sélectionnées
								$(selecteur_ligne).each(function(num_ligne){
										// maj des name
										$('[name]',this).each(function(){
												var name_courant=$(this).attr('name');
												name_courant=name_courant.replace(regex,(num_ligne+1));
												$(this).attr('name',name_courant);
										});
										// maj des id
										$('[id]',this).each(function(){
												var id_courant=$(this).attr('id');
												id_courant=id_courant.replace(regex,(num_ligne+1));
												$(this).attr('id',id_courant);
										});
										//maj d'un élément particulier
										if(element_particulier!='')
										{
												var titre_ligne=$(element_particulier,this)[0];
												var texte_titre_ligne=$(titre_ligne).text();
												texte_titre_ligne=texte_titre_ligne.replace(regex,(num_ligne+1));
												$(titre_ligne).text(texte_titre_ligne);
										}

										//maj de l'id de la ligne
										var id_ligne=$(this).attr('id');
										id_ligne=id_ligne.replace(regex,(num_ligne+1));
										$(this).attr('id',id_ligne);
								});
						}						
						// fonction qui colore une ligne sur deux une sélection de ligne
						function color_selection_ligne(selecteur_lignes)
						{
								// on parcoure une à une les lignes sélectionnées
								$(selecteur_lignes).each(function(num_ligne){
										if(num_ligne%2==0)
												$(this).css('background-color','white');
								});
						}

		// partie pour gérer l'ajout et la suppression de ligne de ligne de la partie "répartition des produits" dans les différents stocks

						// bouton qui supprime la ligne n°1 de la partie "répartition des produits dans les stocks" de la 1ère ligne du formulaire
						$('button:eq(1)').click(function(){
								var num_ligne=$(this).parent().parent().parent().attr('id').match(/\d+/);
								suppression_ligne(this,2);
								maj_indice_ligne('[id*="repartition_four_stock_ligne'+num_ligne+'_"]','',/\d+$/)

						});

						// bouton ajout d'une ligne du formulaire de la partie "réparition dans les différents stocks
						$('button:eq(2)').click(function(){
								// on détermine la ligne dans laquelle le bouton se trouve
								var num_ligne=$(this).parent().parent().attr('id').match(/\d+/);
								// on ajoute une ligne vide à partie "répartition des produits de la ligne déterminé par l'emplacement du bouton
								ajout_ligne_vide(clone_first_empty_ligne_repartition_fourni,'#ajout_repartition_four'+num_ligne,true);
								// on met à jour dans cette ligne les id et name des lignes de la partie "répartition des produits"
								maj_indice_ligne('[id*="repartition_four_stock_ligne'+num_ligne+'_"]','',/\d+$/)
						});

						// sert à cloner la première ligne de la partie "répartition des produits" de la première ligne du formulaire
						var clone_first_empty_ligne_repartition_fourni = clone_ligne('#repartition_four_stock_ligne1_1');	

		// partie pour gérer l'ajout et la suppression de ligne du formulaire

						// bouton ajout d'une ligne du formulaire
						$('button:eq(3)').click(function(){
								ajout_ligne_vide(clone_first_empty_ligne_fourni,'#fin_des_lignes',true)
								maj_indice_ligne('[id*="ligne_cmde_fourn_"]','h3',/\d+/)
								color_selection_ligne('[id*="ligne_cmde_fourn_"]');

						});	
						
						// bouton delete de la ligne n°1
						$('button:eq(0)').click(function(){
								suppression_ligne(this,3);
								maj_indice_ligne('[id*="ligne_cmde_fourn_"]','h3',/\d+/)
								color_selection_ligne('[id*="ligne_cmde_fourn_"]');
						});

						// cette partie sert à cloner la première ligne et à la garder en mémoire pour pouvoir l'insérer à volonté aprèsi
						var clone_first_empty_ligne_fourni = clone_ligne('#ligne_cmde_fourn_1');
						
				});
		</script>
  </body>
</html>

