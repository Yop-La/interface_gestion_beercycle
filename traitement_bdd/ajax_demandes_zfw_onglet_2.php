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

				// requête à soumettre à la base sql
				$requete_sql="select marque,ref_dde_zfw, libelle, dz.ref_produit, dz.user_id as user_saisie,dz.date_demande, dz.date_dern_maj,commentaire, modele, qte_ddee from canal_de_distribution as cd  ,demande_zfw as dz, produit as p where cd.ref_canal_distrib = dz.ref_canal_distrib and dz.ref_produit=p.ref_produit and qte_cmdee=0"; 

				//fonction qui retourne les données de la requête au format de la DataTable nommée "listes des demandes non satisfaites"

				echo '{"data": [';
				$reponse = $bdd->query($requete_sql);
				$nbre_row= $reponse->rowCount();
				$indice_row = 1;
				while ($row = $reponse->fetch())
				{
						echo '[';
						echo '"'.$row['libelle'].'",';
						echo '"'.$row['ref_dde_zfw'].'",';
						echo '"'.$row['date_demande'].'",';
						echo '"'.$row['date_dern_maj'].'",';
						echo '"'.$row['user_saisie'].'",';
						echo '"'.$row['ref_produit'].'",';
						echo '"'.$row['marque'].'",';
						echo '"'.$row['modele'].'",';
						echo '"'.$row['commentaire'].'",';
						echo '"'.$row['qte_ddee'].'"';
						if($indice_row==$nbre_row)
								echo ']';
						else
								echo '],';
						$indice_row++;
				}
				echo ']}';



		// pour gérer le formulaire de l'onglet 2 
		// il y a ici 2 fonctions en rappport avec ce formulaire
		// 1ère fonction : pré-remplissage après avoir cliqué sur une ligne du tableau
		// 2ème fonction : mise à jour des champs du formulaire en fonction de la valeur
		// des autres champs

		// 1ère fonction : pré-remplissage après avoir cliqué sur une ligne du tableau
		


		}
?>
