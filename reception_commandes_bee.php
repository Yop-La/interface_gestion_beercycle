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
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/reception_commandes_zfw.js"></script>
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

			<section class="contenu">
				<article>
					<div class="row">
						<div class="col-lg-2 col-lg-offset-1">
							<table id="liste_ref_externe_fourni" class="display" width="100%" cellspacing="0">
									<thead>
											<tr>
													<th>Références externes</th>
													<th>Emetteur</th>
													<th>Nbre ligne commande</th>
											</tr>
									</thead>
					 
									<tfoot>
											<tr>
													<th>Références externes</th>
													<th>Emetteur</th>
													<th>Nbre ligne commande</th>
											</tr>
									</tfoot>
							</table>
						</div>
						<!-- formulaire de validation des commandes fournisseurs -->
						<form class="col-lg-offset-1 col-lg-7  well">	
							<div class="row ">
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
								<div class="col-lg-3">
									<label for="ref_externe">Référence externe</label>
									<input type="text" name="ref_externe" id="ref_externe" class="form-control" readonly="true" required/>
								</div>
								<div class="col-lg-3">
									<label for="nbre_ligne_cmde">Nombre ligne</label>
									<input type="text" name="nbre_ligne_cmde" id="nbre_ligne_cmde" class="form-control" readonly="true" required/>
								</div>
								<div class="col-lg-3">
									<label for="fourn_expediteur">Expéditeur</label>
									<input type="text" name="expediteur" id="expediteur" class="form-control" readonly="true" required/>
								</div>
								<div class="col-lg-3">
									<label for="destinataire">Destinataire</label>
									<input type="text" name="destinataire" id="destinataire" class="form-control" required readonly value="BEE">
								</div>
							</div>
							<!-- 1ère ligne de la commande -->
							<div class="row ligne_cmde">
								<div class="row vertical-align">
									<div class="col-lg-offset-4 col-lg-6">
										<h3 class="Bold ">
												Ligne de commande n°1
										</h3>
									</div>
									<div class="col-lg-2">
										<button type="button" class="delete_ligne_cmde btn  btn-primary form-control">
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
								<div class="form-group row qte_recu">
									<div class="col-lg-offset-4 col-lg-4">
										<!-- champ quantité reçue -->
										<label for="qte_recue1">Quantitée reçue</label>
										<input type="text" name="qte_recue1" id="qte_recue1" class="form-control" required/>
									</div>
								</div>
								<!-- répartition des produits dans les stocks -->
								<legend>
										Répartition des produits dans les stocks
								</legend>
								<div class="form-group row vertical-align ligne_stock">

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
										<button type="button" class="delete_ligne_stock btn btn-primary form-control">
											Delete
										</button>
									</div>
								</div>
								<div class="col-lg-offset-4 col-lg-4 form-group">
										<button type="button" class="ajout_stock btn  btn-default form-control" >
											Ajouter stock
										</button>
								</div>
							</div>
							<div class="row" id="fin_des_lignes">
								<div style="border-bottom: 1px solid #E5E5E5;" class="col-lg-offset-2 col-lg-8"></div>
							</div>
							</br>
							<div class="row form-group" id="commandes_formulaires">
								<div class="col-lg-3 col-lg-offset-3">
									<button class="btn btn-default form-control " id="ajout_ligne" type="button" > Ajouter ligne</button>
								</div>
								<div class="col-lg-3">
									<button type="submit" class="btn btn-danger form-control" > Valider </button>
								</div>
							</div>
						</form>
					</div>
				<article>
			</section>





			<?php 
						}else
						{
							echo header('Location: acceuil.php');
						}
					/* Pied de page  */		
      		include("footer.php"); 
			?>

  </body>
</html>

