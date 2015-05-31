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
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="js/saisie_commandes_fournisseurs.js"></script>
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
							<form class="col-lg-12 well">
								<legend> Entête de la commande </legend>
								<!-- 1ère ligne : entête de la commande : nom fournisseur + ref_externe + date ?-->
								<div class="row form-group">
									<div class="col-lg-2 col-lg-offset-2">
										<label for="ref_externe">Référence externe</label>
										<input type="text" name="ref_externe" id="ref_externe" class="form-control" required>
									</div>
									<div class="col-lg-2">
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
									<div class="col-lg-2">
										<label for="code_devise">Code devise</label>
										<select name="code_devise" id="code_devise" class="form-control" required>
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
									<div class="col-lg-2">
										<label for="montant_expe">Montant d'expédition</label>
										<input type="text" name="montant_expe" id="montant_expe" class="form-control" required>
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
										<div class="col-lg-offset-3 col-lg-2">
											<label for="ref_dmd_zfw1">Réf demande zfw</label>
											<select name="ref_dmd_zfw1" id="ref_dmd_zfw1" class="form-control" >
												<option value="" selected ></option>
												<?php
														$data = $bdd->query('SELECT DISTINCT ref_dde_zfw  FROM demande_zfw where qte_ddee>qte_cmdee');
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
									</div>
								</div>
								<legend> Commentaire </legend>
								<div class="row form-group">
									<div class="col-lg-8 col-lg-offset-2">
										<label for="commentaires">Commentaires</label>
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
  </body>
</html>

