<?php
		session_start();	
		header ('Content-type:text/html; charset=utf-8');
		if(!isset($_SESSION['identification']))
		{
				$_SESSION['identification']=false;
		}
		if($_SESSION['identification'])
		{

		// pour remplir la watable de l'onglet 2
				
				// connexion à la base
				include("connexion.php");
				// requête à soumettre à la base afin de récupérer toutes les ref_dde_zfw encore modifiables
				$requete_sql="select ref_dde_zfw from demande_zfw where qte_cmdee=0";

				// on récupère toutes les ref_dde_zfw encore modifiables et on les stockent dans $ref_dde_zfw
				$ref_dde_zfw=array();	
				$reponse = $bdd->query($requete_sql);
				while($row=$reponse->fetch())
				{
						array_push($ref_dde_zfw,$row['ref_dde_zfw']);
				}
				$reponse->closeCursor();

				// requête à soumettre à la base sql qui permet de récupérer tous les prépayements associées aux demandes. On enregistre ces couples dans le tableau ref_dde_zfw_to_prepaiements
				$placeholders = rtrim(str_repeat('?, ', count($ref_dde_zfw)), ', ') ;
				$requete_sql="select ref_dde_zfw, montant_regle from paiement_dde_zfw where ref_dde_zfw IN ($placeholders)";
				$prepaiements=$bdd->prepare($requete_sql);
				$prepaiements->execute($ref_dde_zfw);
				$ref_dde_zfw_to_prepaiements=array();
				while($row = $prepaiements->fetch())
				{
						$ref_dde_zfw_to_prepaiements[$row['ref_dde_zfw']]=$row['montant_regle'];
				}
				$prepaiements->closeCursor();
				// requête à soumettre à la base sql qui permet de récupérer toutes les demandes non satisfaites
				$requete_sql="select dz.ref_canal_distrib as canal_distri, marque,ref_dde_zfw, libelle, dz.ref_produit, dz.user_id as user_saisie,dz.date_demande, dz.date_dern_maj,commentaire, modele, qte_ddee, qte_cmdee from canal_de_distribution as cd  ,demande_zfw as dz, produit as p where cd.ref_canal_distrib = dz.ref_canal_distrib and dz.ref_produit=p.ref_produit and qte_cmdee=0"; 

				//fonction qui retourne les données de la requête au format de la DataTable nommée "listes des demandes non satisfaites"
				echo '{"data": [';
				$reponse = $bdd->query($requete_sql);
				$nbre_row= $reponse->rowCount();
				$indice_row = 1;
				while ($row = $reponse->fetch())
				{
						echo '[';
						echo '"'.$row['libelle'].'",';
						echo '"'.$row['canal_distri'].'",';// pas afficher
						echo '"'.$row['ref_dde_zfw'].'",';
						echo '"'.$row['date_demande'].'",';
						echo '"'.$row['date_dern_maj'].'",';
						echo '"'.$row['user_saisie'].'",';
						echo '"'.$row['ref_produit'].'",';// pas afficher
						echo '"'.$row['marque'].'",'; // pas afficher
						echo '"'.$row['modele'].'",';
						echo '"'.$row['commentaire'].'",';
						echo '"'.$row['qte_ddee'].'",';
						echo '"'.$row['qte_cmdee'].'"';
						if($indice_row==$nbre_row)
								echo ']';
						else
								echo '],';
						$indice_row++;
				}
				echo ']}';
				$reponse->closeCursor();


		}
?>
