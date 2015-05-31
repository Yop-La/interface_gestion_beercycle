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
    <script src="js/saisie_ventes.js"></script>
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
							<div class="remplir_en_premier">
								<legend>
										Vendeur et lieux de vente
								</legend>
								<div class="form-group row">
									<div class="col-lg-4 col-lg-offset-2">
										<label for="id_vendeur">Identifiant du vendeur</label>
										<select id="id_vendeur" name="id_vendeur" class="form-control" required>
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
										<label for="ref_canal_distrib">Canal de distribution </label>
										<select required id="ref_canal_distrib" name="ref_canal_distrib" class="form-control">
											<option value="" selected></option>
											<?php
													$data = $bdd->query("SELECT ref_canal_distrib, libelle FROM canal_de_distribution");
													while ($valeur = $data->fetch())
													{
															echo '<option value="' . $valeur['ref_canal_distrib'] . '">' .  $valeur['libelle'] . '</option>';
													}
													$data->closeCursor();
											?>
										</select>
									</div>
								</div>
								<legend>
										Devise de la transaction
								</legend>
								<div class="form-group row">
									<div class="col-lg-4 col-lg-offset-4">
										<label for="devise"> Devise</label>
										<select id="devise" name="devise" class="form-control" required>
											<option value="" selected></option>
											<?php
													$data = $bdd->query("SELECT code_devise, libelle FROM devise");
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
							<div class="ligne_vente bordure_ligne" >
								<div class="row vertical-align">
									<div class="col-lg-6 col-lg-offset-4">
										<h3 class="Bold ">
												Ligne de vente n°1
										</h3>
									</div>
									<div class="col-lg-2">
										<button type="button" class="btn  btn-primary form-control suppression_ligne">
											Delete
										</button>
									</div>
								</div>		
								<legend>
										Saisie du produit vendu et de sa quantité
								</legend>
								<div class="form-group row">
									<div class="col-lg-4 col-lg-offset-1">
										<label for="marque_1"> Marque </label>
										<select id="marque_1" name="marque_1" class="form-control" required disabled>
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
									<div class="col-lg-6">
										<label for="modele_1"> Modèle </label>
										<select id="modele_1" name="modele_1" class="form-control" required disabled>
											<option value="" selected></option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-lg-8 col-lg-offset-1">
										<label for="etat_1"> Etat </label>
										<select id="etat_1" name="etat_1" class="form-control" required disabled>
											<option value="" selected></option>
										</select>
									</div>
									<div class="col-lg-2">
										<label for="qte_vendu_1"> Quantité</label>
										<input type="text" name="qte_vendu_1" id="qte_vendu_1" class="form-control" required disabled/>
									</div>
								</div>
								<legend>
										Disponibilité et prix du produit
								</legend>
								<div class="form-group row">
									<div class="col-lg-4 col-lg-offset-2">
										<label for="lieu_stockage_1"> Lieu de stockage </label>
										<select id="lieu_stockage_1" name="lieu_stockage_1" class="form-control" required disabled>
											<option value="" selected></option>
											<?php
													$data = $bdd->query("SELECT ref_lieu_stockage, libelle FROM lieu_stockage");
													while ($valeur = $data->fetch())
													{
															echo '<option value="' . $valeur['ref_lieu_stockage'] . '">' .  $valeur['libelle'] . '</option>';
													}
													$data->closeCursor();
											?>
										</select>
									</div>
									<div class="col-lg-4">
										<label for="qte_dispo_1"> Quantité disponible </label>
										<input type="text" name="qte_dispo_1" id="qte_dispo_1" class="form-control" readonly='true' required disabled/>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-lg-4 col-lg-offset-2">
										<label for="prix_usd_1"> Prix unitaire en dollard</label>
										<input type="text" name="prix_usd_1" id="prix_usd_1" class="form-control" readonly='true' required disabled/>
									</div>
									<div class="col-lg-4">
										<label for="prix_devise_1"> Prix unitaire de la vente</label>
										<div class="input-group">
											<span class="input-group-addon devise_montant">€</span>
											<input type="text" name="prix_devise_1" id="prix_devise_1" class="form-control" required disabled/>
										</div>
									</div>
								</div>
								</br>
							</div>
							</br>
							<div class="row">
								<div class="col-lg-offset-4 col-lg-4 form-group" id="ajout_ligne_vente">
										<button type="button" class="btn  btn-primary form-control" >
											Ajouter ligne de vente
										</button>
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
									Montant total de la vente ( sans frais de port )
							</legend>
							<div class="form-group row">
								<div class="input-group col-lg-6 col-lg-offset-3" >
									<span class="input-group-addon devise_montant">€</span>
									<input type="text" class="form-control" style="text-align:right" name="montant_total" id="montant_total" required>
									<span class="input-group-btn">
										<button class="btn btn-primary" type="button" id='calcul_montant'>Calculer Montant totale</button>
									</span>
								</div>
							</div>
							<div class="row">
								<div style="border-bottom: 1px solid #E5E5E5;" class="col-lg-offset-2 col-lg-8"></div>
							</div>
							</br>
							<div class="row form-group">
								<div class="col-lg-4">
									<button type="submit" class="btn btn-danger form-control" value="a_retirer_en_boutique" > A retirer en boutique </button>
								</div>
								<div class="col-lg-4">
									<button value="a_livrer" type="submit" class="btn btn-danger form-control" > A livrer </button>
								</div>
								<div class="col-lg-4">
									<button type="submit" class="btn btn-danger form-control" value="vente_immediate" > Vente immédiate </button>
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

