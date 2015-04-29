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
    <link rel='stylesheet' href='DataTables/media/css/jquery.dataTables.min.css'/>	
    <script src="bootstrap/js/jquery.js"></script>
    <script src="DataTables/media/js/jquery.dataTables.min.js" type="text/javascript" charset="utf-8"></script>
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
			<!-- 1er onglet : saisie des demandes-->
			<div class="tab-content">
					<div class="tab-pane active" id="saisie_demande">		
						<section class="row contenu">
							<article class="col-lg-offset-3 col-lg-6">
									<h3 class="row titre_page">
										Espace de saisie des demandes de produits de ZFW
									</h3>
									<div class="row">
										<form class="well col-lg-offset-2 col-lg-8" action="traitement_bdd/saving_dmd_zfw.php">
												<legend>Origine de la demande</legend>
												<div class="form-group">
													<label for="canal_distri">Canal de distribution </label>
													<select id="canal_distri" name="canal_distri" class="form-control">
														<option value="" selected></option>
														<?php
																$data = $bdd->query('SELECT DISTINCT libelle FROM canal_de_distribution');
																while ($valeur = $data->fetch())
																{
																		echo '<option value="' . $valeur['libelle'] . '">' .  $valeur['libelle'] . '</option>';
																}
																$data->closeCursor();
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
															$data->closeCursor();
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
					<!-- 2ème onglet : modification des demandes-->
					<div class="tab-pane" id="modification_demande">
						<section class="contenu">
							<h3 class="row titre_page">
								<div class="centrer_texte">
									Liste des demandes de produits encore modifiables
								</div>
							</h3>
							<div class="row">
								<div class="col-lg-12">
									<table id="liste_demandes_non_traitees" class="display" width="100%" cellspacing="0">
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
															<th>Quantité</th>
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
															<th>Quantité</th>
													</tr>
											</tfoot>
									</table>
								</div>
							</div>
							<div class="row">
								<aside class="col-lg-offset-1 col-lg-5">
									<div class="row">
										<h4 class="centrer_texte">
											Infos sur la demande sélectionnée 
										</h4>
										<table class="table table-bordered table-striped table-condensed">
											<thead>
												<tr>
													<th>Nom du champ</th>
													<th>Valeur du champ</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th>ref_dde_zfw</th>
													<th></th>
												</tr>
												<tr>
													<th>date_demande</th>
													<th></th>
												</tr>
												<tr>
													<th>date_dern_maj</th>
													<th></th>
												</tr>
												<tr>
													<th>user_saisie</th>
													<th></th>
												</tr>
											</tbody>
										</table>
									</div>
								</aside>
								<article class="col-lg-5">
									<h4 class="centrer_texte">
										Formulaire de mofication d'une demande	
									</h4>
									<form class="well" action="traitement_bdd/saving_modif_dmd_zfw.php" >
										<legend>Origine de la demande</legend>
										<div class="form-group">
											<label for="modif_canal_distri">Modification du canal de distribution </label>
											<select id="modif_canal_distri" name="modif_canal_distri" class="form-control">
												<option value="" selected></option>
												<?php
														$data = $bdd->query('SELECT DISTINCT libelle FROM canal_de_distribution');
														while ($valeur = $data->fetch())
														{
																echo '<option value="' . $valeur['libelle'] . '">' .  $valeur['libelle'] . '</option>';
														}
														$data->closeCursor();
												?>
											</select>
										</div>
										<legend>Caractéristiques produit</legend>
										<div class="form-group">
											<label for="modif_quantite"> Modification de la quantite </label>
											<input name="modif_quantite" id="modif_quantite" type="text" class="form-control">
										</div>
										<div class="form-group">
											<label for="modif_marque"> Modification de la marque </label>
											<select id="modif_marque" name="modif_marque" class="form-control">
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
								</article>
							</div>
						</section>
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
    <script src="bootstrap/js/bootstrap.min.js"></script>
		<script>
				$(function() {



			/* 1er onglet */

						// pour gérer le champ marque (lecture bbd + ajout champ modele et suppression du champ etat si changement)
						$('#marque').change(function(){
								$('.form-group:eq(3)').load('traitement_bdd/ajax_demandes_zfw_onglet_1.php',{marque:$('#marque').val(),type: 'marque',id_select: 'modele'},function(){
										if($('#marque').val()=='')
										{
												$('#modele').remove();
												$('[for="modele"]').remove();
										}
								});
								$('#etat').remove();
								$('[for="etat"]').remove();
						});
						//pour ajouter le champ etat (lecture bdd + ajout champ label si changement )
						$('.form-group:eq(3)').on('change', "#modele", function(){
								$('.form-group:eq(4)').load('traitement_bdd/ajax_demandes_zfw_onglet_1.php',{modele:$('#modele').val(),type: 'modele',id_select: 'etat'});
						});
						// partie vérification du formulaire
						$('form:eq(0)').submit(function(event){
								event.preventDefault();
								var canal_valide = check_select($('#canal_distri'));		
								var marque_valide = check_select($('#marque'));		
								var modele_valide = check_select($('#modele'));		
								var etat_valide = check_select($('#etat'));
								var quantite_valide = check_nombre_entier($('#quantite'));
								if(marque_valide && modele_valide && canal_valide && etat_valide && quantite_valide )
								{
										var c = confirm("Etes vous sur de vouloir continuer ?");
										if(c)
										{
												url = $('form:eq(0)').attr( "action" );
												var a_poster=$('form:eq(0)').serialize();
												var posting=$.post( url,a_poster);

												posting.done(function(data){
														// cela met à jour la DataTable
														table_dmd_non_traitees.api().ajax.reload();
														$('form:eq(0)')[0].reset();
														$('#marque').trigger("change");
												});
												return true;
										}
										else
										{
												return false;
										}
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
						// fonction qui verifie que les quantités soient des nombres
						function check_nombre(input){
								if(!/^\d{1,2}.\d{1,2}$|\d{1,2}/.test(input.val()))
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

	
	/* 2ème onglet */
			// variable qui permet de s'assurer que l'utilisateur a sélectionné une demande pour la modifier

			var demande_selectionne=false;

			// variable  qui va contenir la ref demande à modifier 
			var ref_demande_selectionne=null;

			// cela sert à remplir et à paramétrer la DataTable
					var table_dmd_non_traitees=$('#liste_demandes_non_traitees').dataTable( {
        			ajax: {
									"url": "traitement_bdd/ajax_demandes_zfw_onglet_2.php",
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
    			} );

		// permet de remplir le tableau infos sur la demande sélectionnée et le formulaire lorsqu'on clique sur une ligne du tableau des demandes
				$('#liste_demandes_non_traitees tbody').on('click', 'tr', function () {
						var cells =$('td', this);
						var ref_dmd = cells.eq(1).text();
						alert( 'La référence de la demande que vous allez modifier est : '+ref_dmd+'.' );


						//cela met à jour le tableau " infos sur la demande sélectionnée
						var data_tableau_infos_demande = [];
						data_tableau_infos_demande.push(cells.eq(1).text());	
						data_tableau_infos_demande.push(cells.eq(2).text());	
						data_tableau_infos_demande.push(cells.eq(3).text());	
						data_tableau_infos_demande.push(cells.eq(4).text());	
						$('tbody:eq(1) th:odd').each(function(index){
								$(this).html(data_tableau_infos_demande[index]);
						});
						//cela met à jour le formulaire pour modifier une demande
						var ligne = table_dmd_non_traitees.fnGetData( this );
						demande_selectionne=true;
						$('#modif_canal_distri').val(cells.eq(0).text());
						$('#modif_quantite').val(cells.eq(7).text());
						$('#modif_marque').val(ligne[7]);
						// déclenche l'événement "change" sur le champ marque afin de mettre à jour les champs modèle et état qui en dépendent
						$('#modif_marque').trigger("change",[cells.eq(5).text(),cells.eq(6).text()]);
						// enregistre les données nécessaires à la maj de cette demande : ref_produit et ref_canal_distrib
						ref_demande_selectionne=ligne[2];

				});	
				// lorsque qu'on change le champ marque, cela insère le champ modèle et enlève le champ etat et label
						$('#modif_marque').change(function(event,modele,etat){
								$('.form-group:eq(8)').load('traitement_bdd/ajax_demandes_zfw_onglet_1.php',
										{marque:$('#modif_marque').val(),type: 'marque',id_select: 'modif_modele'},
										function(){
												if(modele!=undefined)
												{
														$('#modif_modele').val(modele);
														$('#modif_modele').trigger("change",etat);
												}
												if($('#modif_marque').val()=='')
												{
														$('#modif_modele').remove();
														$('[for="modif_modele"]').remove();
												}
										});
								$('#modif_etat').remove();
								$('[for="modif_etat"]').remove();
						});
						//pour ajouter un évènement au champ modèle après construction du dom: lorqu'on change le champ modèle cela ajoute le champ état
						$('.form-group:eq(8)').on('change', "#modif_modele", function(event,etat){
								$('.form-group:eq(9)').load('traitement_bdd/ajax_demandes_zfw_onglet_1.php',
										{modele:$('#modif_modele').val(),type: 'modele',id_select: 'modif_etat'},
										function(){
												if(etat!=undefined)
												{
														console.log();
														$('#modif_etat').val(etat);
												}
										});
						});
						//pour signaler à l'utilisateur que le formulaire est inutilisable tant qu'une ligne de demande n'a pas été sélectionnée
						$('form:eq(1)').change(function(){
								if(demande_selectionne==false)
								{
										alert("impossible d'utiliser le formulaire tant qu'une ligne de demande n'a pas été sélectionnée");
								}


						});
						// partie vérification et soumission du formulaire
						$('form:eq(1)').submit(function(event){
								event.preventDefault();
								//vérification des champs
								var canal_valide = check_select($('#modif_canal_distri'));
								var marque_valide = check_select($('#modif_marque'));		
								var modele_valide = check_select($('#modif_modele'));		
								var etat_valide = check_select($('#modif_etat'));
								var quantite_valide = check_nombre_entier($('#modif_quantite'));
								
								// si tous les champs sont correctement remplis
								if(marque_valide && modele_valide && canal_valide && etat_valide && quantite_valide )
								{
										if(demande_selectionne)
										{
												var c = confirm("Etes vous sur de vouloir continuer ?");
												if(c)
												{
														url = $('form:eq(1)').attr( "action" );
														var a_poster=$('form:eq(1)').serialize()+"&ref_demande="+ref_demande_selectionne;
														var posting=$.post( url,a_poster);

														posting.done(function(data){
																// cela met à jour la DataTable
																table_dmd_non_traitees.api().ajax.reload();
																$('form:eq(1)')[0].reset();
																$('#modif_marque').trigger("change");
																demande_selectionne=false;
														});
														return true;
												}
												else
												{
														return false;
												}
										}
										else
										{
												alert("impossible de valider le formulaire tant qu'une ligne de demande n'a pas été sélectionnée");
												return false;
										}

								}
								else
								{
										alert("Erreur de saisie : veuillez modifier votre saisie !");
										return false;
								}

						});
			});
		</script>
  </body>
</html>
