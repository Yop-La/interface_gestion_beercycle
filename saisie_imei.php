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
  </head>
  <body>
    <div class="container">
      <?php include("header.php");
      			include("menu.php");
						include("traitement_bdd/fonctions.php");
						include("traitement_bdd/connexion.php");

						/* retourne un menu qui change en fonction de la page et du visiteur ( de ses droits ) */
						afficherMenuEtTitre(1,'commandeBEE');
						if($_SESSION['identification'])
						{
								echo '<script>;';			
								echo 'var erreur_post=-1;';
								if(empty($_POST['id_vente']))
								{
										echo 'var erreur_post=0';
								}
								echo '</script>;';
								// on récupère le nbre de produits de la commande
								$qte = retour_select('select qte from cmde_client where ref_cmdec = ?',array($_POST['id_vente']),'qte',$bdd);
								
			?>
			<article>
				<div class="row">
					<form class="col-lg-offset-4 col-lg-4  well">	
						<div class="row ">
							<h3 class="Bold centrer_texte">
								Saisie de l'IMEI pour vente immédiate
							</h3>
						</div>
						<div class="row">
							<div style="border-bottom: 1px solid #E5E5E5;" class="col-lg-offset-2 col-lg-8"></div>
						</div>
						</br>
						<div class="form-group row">
							<div class="col-lg-10 col-lg-offset-1">
								<label for="ref_cmde_client">Référence de la commande client</label>
								<?php
										echo '<input type="text" name="ref_cmde_client" id="ref_cmde_client" class="form-control" readonly="true" required value="'.$_POST['id_vente'].'"/>';
								?>
							</div>
						</div>
						<?php
								for($indice_imei=1 ;$indice_imei<=$qte;$indice_imei++)
								{
										echo '<div class="form-group row">';
											echo '<div class="col-lg-10 col-lg-offset-1">';
											echo '<label for="IMEI"'.$indice_imei.'>Code IMEI '.$indice_imei.'</label>';
											echo '<input type="text" name="IMEI'.$indice_imei.'" id="IMEI'.$indice_imei.'" class="form-control" required/>';
											echo '</div>';
										echo '</div>';
								}
						?>
						<div class="row">
							<div style="border-bottom: 1px solid #E5E5E5;" class="col-lg-offset-2 col-lg-8"></div>
						</div>
						</br>
						<div class="row form-group" id="commandes_formulaires">
							<div class="col-lg-6 col-lg-offset-3">
								<button class="btn btn-primary form-control" id="finaliser_vente" type="submit"> Finaliser la vente </button>
							</div>
						</div>
					</form>
				</div>
			</article>




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
						if(erreur_post==0)
						{
								alert("Le post id_vente est vide !");
								window.location.replace("identification_client.php");
						}
						else if(erreur_post==-1)
						{
								// soumission du formulaire
								$('form:eq(0)').on('submit',function(e){
								
										e.preventDefault();
				//première partie : vérification du bon remplissage des champs		



				// deuxième partie, si champs bien remplis alors on envoie le formulaire
										
										// Envoi de la requête HTTP en mode asynchrone
										$.ajax({
												dataType: "json",
												url: 'traitement_bdd/saving_ventes.php', // Le nom du fichier indiqué dans le formulaire
												type: 'POST', // La méthode indiquée dans le formulaire (get ou post)
												async : false,
												data: $(this).serialize(), 
												success: function(retour) { // Je récupère la réponse du fichier PHP
														if(retour[0]) // si il y pas d'erreur
														{
																window.location.replace("identification_client.php");
														}
														else //si il y a une erreur
														{
																alert(retour[1]);
														}
												}
										});
								});
						}
						


				});
		</script>
  </body>
</html>

