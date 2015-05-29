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
    <script src="js/fonctions.js"></script>
  </head>
  <body>
    <div class="container">
      <?php include("header.php");
      			include("menu.php");
						/* retourne un menu qui change en fonction de la page et du visiteur ( de ses droits ) */
						afficherMenuEtTitre(1,'commandeBEE');
						if($_SESSION['identification'])
						{
			?>
			<section class="contenu">
				<article>
					<div class="row ">
						<h1 class="Bold titre_page">
							Identification du client
						</h1>
					</div>
					<div class="row">
						<div class="col-lg-offset-2 col-lg-8">
							<table id="table_clients" class="display" width="100%" cellspacing="0">
									<thead>
											<tr>
													<th>Pseudo</th>
													<th>Prénom</th>
													<th>Nom</th>
											</tr>
									</thead>
					 
									<tfoot>
											<tr>
													<th>Pseudo</th>
													<th>Prénom</th>
													<th>Nom</th>
											</tr>
									</tfoot>
							</table>
						</div>
					</div>
					</br>
					<div class="row">
						<div class="col-lg-offset-5 col-lg-2 form-group" id="nouveau_client">
							<button type="button" class="btn  btn-primary form-control" >
								Nouveau client !
							</button>
						</div>
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
				$(function() {
// chargement de la table clients
						var table_clients = $('#table_clients').dataTable( {
								ajax: {
										"dataType" : "json",
										"url": "traitement_bdd/identification_client_remplissage_table_clients.php",
										"type": "POST",
								},
								lengthMenu: [[5,10,15,-1], [5, 10, 15,"Toutes"]],
								responsive: true
						});
// on redirige vers la saisie de la vente lorsque que l'on clique sur un client du tableau
						$('#table_clients').on('click', 'tr', function () {
								// on récupère les données de la ligne cliquée
								var ligne = table_clients.fnGetData( this );
										
								// on demande à confirmer pour s'assurer que le client sélectionné est le bon
								var c = confirm("Le ou la client(e) sélectionné(e) est "+ligne[1]+" "+ligne[2]+"\n Etes vous sur de vouloir continuer ?");
								if(c)
								{
										// déclaration du tableau qui contient les données du client et qui sera envoyer à la page de saisie des commandes
										var infos_client={};
										infos_client['pseudo']=ligne[0];
										infos_client['prenom']=ligne[1];
										infos_client['nom']=ligne[2];
										infos_client['fonction']='insert_client';
										// redirection vers la page saisie_ventes.php via une requête post qui envoie les données du client par la même occasion
										post('saisie_ventes.php',infos_client)
								}
						});
// on redirige vers la saisie d'un nouveau client lorsque que l'on clique sur le bouton nouveau client
				
						$('button').on('click',function(e){
								e.preventDefault();
								var infos_client={};
								infos_client['fonction']='insert_client';
								post('saisie_clients.php',infos_client);

						});
				});


		</script>
  </body>
</html>

