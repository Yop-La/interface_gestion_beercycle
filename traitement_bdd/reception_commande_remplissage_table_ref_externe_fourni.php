<?php
		session_start();	
		header ('Content-type:text/html; charset=utf-8');
		if(!isset($_SESSION['identification']))
		{
				$_SESSION['identification']=false;
		}
		if($_SESSION['identification'])
		{

		// variable de retour : pas beosoin de gérer les messages d'erreurs -> dataTable s'en occupe
		$retour=array();


// pour remplir la dataTable de la réception des commandes par ZFW | BEE
				
		// connexion à la base
		include("connexion.php");
		include("fonctions.php");
				
		// on va afficher dans ce tableau toutes les références externes des prestataires
		// Ces réfs externes se divisent en 2 catégories
		// catégorie 1 : envoyé par fourni, récupéré par | ZFW |
		//            																	 | BEE |	

				// requête associée
				$requete0="select distinct ref_cmde_externe from cmde_fournisseur as cf where cf.statut='ouvert'"; 
		
		// catégorie 2 : envoyé par bee, récupéré par | ZFW |

				// requête associée
				$requete1="select distinct ref_externe_prestataire from expedition_bee as eb where eb.statut='ouvert'"; 


				// boucle : 0 => gestion des commandes de cmde_fournisseur / 1 => gestion des commandes de expedition_bee	
				for($i=0;$i<=1;$i++)
				{
						$index=['ref_cmde_externe','ref_externe_prestataire'];
						$expediteur=['FOURNISSEUR','BEE'];
						$requete='requete'.$i;
						$reponse='reponse'.$i;
						$$reponse = $bdd->query($$requete);
						errors_pdo($$reponse);
						// on parcoure toutes les commandes 
						while ($row = $$reponse->fetch())
						{
								// ce tableau contient dans 
										// sa première case : la ref externe
										// sa deuxième cas : le nom de l'expéditeur ( BEE ou FOURNISSEUR )
										// sa troisième case : le nbre de ligne de la commandes
								$tampon=array();
								array_push($tampon,$row[$index[$i%2]]);
								array_push($tampon,$expediteur[$i%2]);
								// on va lire dans la bbd le nombre lignes de la commande en cours
								if($index[$i%2]=='ref_cmde_externe')
								{
										$requete4="select count(*) as nbre_ligne from cmde_fournisseur as cf, ligne_commande_origine as lco where cf.ref_cmdef=lco.ref_cmdef and cf.ref_cmde_externe = ?";
								}
								else
								{
										$requete4="select count(*) as nbre_ligne from expedition_bee as eb, ligne_expedition_bee as leb where eb.ref_expedition_bee=leb.ref_expedition_bee and eb.ref_cmde_externe = ?";
								}
										$reponse4=$bdd->prepare($requete4);
										$reponse4->execute(array($row[$index[$i%2]]));
										errors_pdo($reponse4);
										$nbre_ligne_cmde = $reponse4->fetch();
										$nbre_ligne_cmde = $nbre_ligne_cmde['nbre_ligne'];
										array_push($tampon,$nbre_ligne_cmde);
										$reponse4->closeCursor();

								array_push($retour,$tampon);
						}
						
						$$reponse->closeCursor();
				}
				// on envoie le résutat des requêtes au tableau
				echo '{"data": ';
				echo json_encode($retour);
				echo '}';
		}

?>
