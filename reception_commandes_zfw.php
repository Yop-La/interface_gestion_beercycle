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
							<article class="contenu">
								<div class="row">
									<div class="col-lg-2 col-lg-offset-1">
										<table id="liste_ref_externe_fourni" class="display" width="100%" cellspacing="0">
												<thead>
														<tr>
																<th>Références externes</th>
														</tr>
												</thead>
								 
												<tfoot>
														<tr>
																<th>Références externes</th>
														</tr>
												</tfoot>
										</table>
									</div>
									<!-- formulaire de validation des commandes fournisseurs -->
									<form class="col-lg-offset-1 col-lg-7  well">
										
										<!-- 1ère ligne de la commande -->
										<div class="row" id="ligne_cmde_1">
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
												<!-- champ modèle -->
												<div class="col-lg-8 col-lg-offset-1">
													<label for="modele1">Modèle</label>
													<select name="modele1" id="modele1" class="form-control" required>
														<option selected="selected"></option>    
													</select>
												</div>
											</div>					
											<div class="form-group row">
												<div class="col-lg-offset-1 col-lg-10">
													<!-- champ état -->
													<label for="etat1">Etat</label>
													<select name="etat1" id="etat1" class="form-control" required>
														<option selected="selected"></option>    
													</select>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-lg-offset-4 col-lg-4">
													<!-- champ quantité reçue -->
													<label for="qte_cmde1">Quantitée reçue</label>
													<input type="text" name="qte_recue1" id="qte_recue1" class="form-control" required/>
												</div>
											</div>
											<!-- répartition des produits dans les stocks -->
											<legend>
													Répartition des produits dans les stocks
											</legend>
											<div class="form-group row vertical-align" id="repartition_four_stock_ligne1_1">

												<div class="col-lg-4 col-lg-offset-2">
													<!-- champ lieu_stockage -->
													<label for="ref_lieu_stockage1_1">Lieu de stockage</label>
													<select name="ref_lieu_stockage1_1" id="ref_lieu_stockage1_1" class="form-control" required/>
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
													<label for="qte_lieu_stockage1_1">Quantité attribué</label>
													<input type="text" name="qte_lieu_stockage1_1" id="qte_lieu_stockage1_1" class="form-control" required/>
												</div>
												<div class="col-lg-2">
													<button type="button" class="btn  btn-primary form-control">
														Delete
													</button>
												</div>
											</div>
											<div class="col-lg-offset-5 col-lg-2 form-group" id="ajout_repartition_four">
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
												<button class="btn btn-default form-control" type="button" >Ajouter</button>
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
// 1er onglet ------- gestion de la réception des commandes envoyées directement par le fournisseur 
		// cela sert à remplir et à paramétrer la DataTable
						var table_ref_externe_fourni=$('#liste_ref_externe_fourni').dataTable( {
								ajax: {
										"url": "traitement_bdd/reception_commande_remplissage_table_ref_externe_fourni.php",
										"type": "POST"
								},
								lengthMenu: [[3, 5,10,15,-1], [3, 5, 10, 15,"Toutes"]],
								responsive: true
						});
				});

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

		// partie pour gérer l'ajout et la suppression de ligne de ligne de la partie "répartition des produits" dans les différents stocks

						// bouton qui supprime la ligne n°1 de la partie "répartition des produits dans les stocks" de la 1ère ligne du formulaire
						$('button:eq(1)').click(function(){
								suppression_ligne(this,2);

						//		maj_indice_ligne('[id*="ligne_cmde_"]','h3',/\d+/)
						});

						// bouton ajout d'une ligne du formulaire de la partie "réparition dans les différents stocks
						$('button:eq(2)').click(function(){
								// on détermine la ligne dans laquelle le bouton se trouve
								var num_ligne=$(this).parent().parent().attr('id').match(/\d+/);
								// on ajoute une ligne vide à partie "répartition des produits de la ligne déterminé par l'emplacement du bouton
								ajout_ligne_vide(clone_first_empty_ligne_repartition_fourni,'#ajout_repartition_four',true);
								// on met à jour dans cette ligne les id et name des lignes de la partie "répartition des produits"
								maj_indice_ligne('[id*="repartition_four_stock_ligne'+num_ligne+'_"]','',/\d+$/)
						});

						// sert à cloner la première ligne de la partie "répartition des produits" de la première ligne du formulaire
						var clone_first_empty_ligne_repartition_fourni = clone_ligne('#repartition_four_stock_ligne1_1');	

		// partie pour gérer l'ajout et la suppression de ligne du formulaire

						// bouton ajout d'une ligne du formulaire
						$('button:eq(3)').click(function(){
								ajout_ligne_vide(clone_first_empty_ligne_fourni,'#fin_des_lignes',true)
								maj_indice_ligne('[id*="ligne_cmde_"]','h3',/\d+/)
						});	
						
						// bouton delete de la ligne n°1
						$('button:eq(0)').click(function(){
								suppression_ligne(this,3);
								maj_indice_ligne('[id*="ligne_cmde_"]','h3',/\d+/)
						});

						// cette partie sert à cloner la première ligne et à la garder en mémoire pour pouvoir l'insérer à volonté aprèsi
						var clone_first_empty_ligne_fourni = clone_ligne('#ligne_cmde_1');
						
		</script>
  </body>
</html>

