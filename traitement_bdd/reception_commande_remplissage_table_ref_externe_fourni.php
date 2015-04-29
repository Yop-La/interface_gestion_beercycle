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

				// requête à soumettre à la base sql pour récupérer tout_s les ref_cmdl_externe qui répondent à une demanda de zfw
				$requete_sql="select distinct ref_cmde_externe from cmde_fournisseur as cf, ligne_commande_origine lco where ref_demande_zfw!=0 and cf.ref_cmdef=lco.ref_cmdef"; 

				//fonction qui retourne les données de la requête au format de la DataTable nommée "listes des demandes non satisfaites"

				echo '{"data": [';
				$reponse = $bdd->query($requete_sql);
				$nbre_row= $reponse->rowCount();
				$indice_row = 1;
				while ($row = $reponse->fetch())
				{
						echo '[';
						echo '"'.$row['ref_cmde_externe'].'"';
						if($indice_row==$nbre_row)
								echo ']';
						else
								echo '],';
						$indice_row++;
				}
				echo ']}';
		}
?>
