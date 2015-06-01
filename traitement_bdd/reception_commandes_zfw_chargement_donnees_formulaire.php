<?php
session_start();	
header('Content-type:text/html; charset=utf-8');
if(!isset($_SESSION['identification']))
{
		$_SESSION['identification']=false;
}
if($_SESSION['identification'])
{
		// si les post sont bien instanciées
		if(isset($_POST['ref_externe']) and isset($_POST['expediteur']) )
		{
				// connexion à la bdd
				include("connexion.php");
				include("fonctions.php");

				// si l'expéditeur est le fournisseur directement 
				if($_POST['expediteur']=='FOURNISSEUR')
				{
						$requete1="select ref_produit, qte_cmdee from cmde_fournisseur as cf, ligne_commande_origine as lco where cf.ref_cmdef=lco.ref_cmdef and cf.ref_cmde_externe= ? and cf.statut='ouvert'";
						// déclaration du tableau qui va avoir autant de lignes que de lignes de commande. Et il y aura dans chacune de ses cases, un tableau contenant la ref_produit, la qte_cmde, la marque, le modele et l'état de la ligne de commande correspondante
						$ref_produit_qte=array();
		
						$data = $bdd->prepare($requete1);
						$data -> execute(array($_POST['ref_externe']));
						while($row = $data->fetch())
						{
								$tampon=array();
								array_push($tampon,$row['ref_produit']);
								array_push($tampon,$row['qte_cmdee']);
								// on récupère la marque, le modèle et l'état correspondant
								$req = $bdd->prepare("select marque, modele, commentaire from produit where ref_produit= ?");
								$req->execute(array($row['ref_produit']));
								$produit = $req->fetch();
								array_push($tampon,$produit['marque']);
								array_push($tampon,$produit['modele']);
								array_push($tampon,$produit['commentaire']);
								errors_pdo($req);
								$req->closeCursor();
								array_push($ref_produit_qte,$tampon);
						}
						errors_pdo($data);
						$data->closeCursor();
						retour_ajax($ref_produit_qte);
				}
				// si l'expéditeur est BEE
				elseif($_POST['expediteur']=='BEE')
				{
							$requete2="select ref_produit, qte_expediee from expedition_bee as eb, ligne_expedition_bee as leb where eb.ref_expedition_bee=leb.ref_expedition_bee and eb.ref_externe_prestataire= ? and statut='ouvert'";
						// déclaration du tableau 2x2 qui va cotenir les ref_pdrt et leurs quantités
						$ref_produit_qte=array();
		
						$data = $bdd->prepare($requete2);
						$data -> execute(array($_POST['ref_externe']));
						while($row = $data->fetch())
						{
								$tampon=array();
								array_push($tampon,$row['ref_produit']);
								array_push($tampon,$row['qte_expediee']);
								// on récupère la marque, le modèle et l'état correspondant
								$req = $bdd->prepare("select marque, modele, commentaire from produit where ref_produit= ?");
								$req->execute(array($row['ref_produit']));
								$produit = $req->fetch();
								array_push($tampon,$produit['marque']);
								array_push($tampon,$produit['modele']);
								array_push($tampon,$produit['commentaire']);
								errors_pdo($req);
								$req->closeCursor();
								array_push($ref_produit_qte,$tampon);
						}
						errors_pdo($data);
						$data->closeCursor();
						echo retour_ajax($ref_produit_qte);
			
				}
				else
				{
						erreur("Erreur : le post expéditeur n'a pas une valeur attendu ! Actualisez la page !'");
				}
		}
		else
		{
				erreur("Erreur : les posts nécessaire au chargement de la page ne sont pas instanciés ou remplis ! Actualisez la page !'");
		}
}
else
{
			echo header('Location: access.php');		
}
