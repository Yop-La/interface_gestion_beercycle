<?php
		session_start();	
		header ('Content-type:text/html; charset=utf-8');
		if(!isset($_SESSION['identification']))
		{
				$_SESSION['identification']=false;
		}
		if($_SESSION['identification'])
		{

// pour remplir la dataTable de la réception des commandes par ZFW | BEE
				
		// connexion à la base
		include("connexion.php");
				
		// on va afficher dans ce tableau toutes les références externes des prestataires
		// Ces réfs externes se divisent en 6 catégories
		// catégorie 1 : envoyé par fourni, récupéré par | ZFW | et suite à demande zfw 
		//            																	 | BEE |	

				// requête associée
				$requete1="select distinct ref_cmde_externe from cmde_fournisseur as cf, ligne_commande_origine as lco where ref_demande_zfw!=0 and cf.ref_cmdef=lco.ref_cmdef and cf.statut='ouvert'"; 
		
		// catégorie 2 : envoyé par bee, récupéré par | ZFW | et suite à demande zfw 

				// requête associée
				$requete2="select distinct ref_externe_prestataire from expedition_bee as eb, ligne_expedition_bee as leb, ligne_commande_origine as lco where ref_demande_zfw!=0 and eb.ref_expedition_bee=leb.ref_expedition_bee and leb.ref_l_cmdef = lco.ref_l_cmdef"; 

		// catégorie 3 : envoyé par fourni, récupéré par | ZFW | et suite à aucune demande zfw 
		//            																	 | BEE |	

				// requête associée
				$requete3="select distinct ref_cmde_externe from cmde_fournisseur as cf, ligne_commande_origine as lco where ref_demande_zfw=0 and cf.ref_cmdef=lco.ref_cmdef and cf.statut='ouvert'"; 
		
		// catégorie 4 : envoyé par bee, récupéré par | ZFW | et suite à aucune demande zfw 

				// requête associée
				$requete4="select distinct ref_externe_prestataire from expedition_bee as eb, ligne_expedition_bee as leb, ligne_commande_origine as lco where ref_demande_zfw=0 and eb.ref_expedition_bee=leb.ref_expedition_bee and leb.ref_l_cmdef = lco.ref_l_cmdef"; 


				//fonction qui retourne les données de la requête au format de la DataTable nommée "liste_ref_externe_fourni".

				// exécution des 4 requeêtes et récupération de leurs nombres de lignes
				$reponse1 = $bdd->query($requete1);
				$nbre_row1= $reponse1->rowCount();
				$reponse2 = $bdd->query($requete2);
				$nbre_row2= $reponse2->rowCount();
				$reponse3 = $bdd->query($requete3);
				$nbre_row3= $reponse3->rowCount();
				$reponse4 = $bdd->query($requete4);
				$nbre_row4= $reponse4->rowCount();
				// on envoie le début du json
				echo '{"data": [';

				$indice_row = 1;
				while ($row = $reponse1->fetch())
				{
						echo '[';
						echo '"'.$row['ref_cmde_externe'].'"';
						echo	',"four"'; 
						echo	',"dem"';
						if($nbre_row2 != 0 or $nbre_row3 != 0 or $nbre_row4 != 0 or $indice_row!=$nbre_row1)
								echo '],';
						else
								echo ']';
						$indice_row++;
				}
				$reponse1->closeCursor();
				$indice_row = 1;
				while ($row = $reponse2->fetch())
				{
						echo '[';
						echo '"'.$row['ref_externe_prestataire'].'"';
						echo	',"bee"'; 
						echo	',"dem"'; 
						if($nbre_row3 != 0 or $nbre_row4 != 0 or $indice_row!=$nbre_row2)
								echo '],';
						else
								echo ']';
						$indice_row++;
				}
				$reponse2->closeCursor();
				$indice_row = 1;
				while ($row = $reponse3->fetch())
				{
						echo '[';
						echo '"'.$row['ref_cmde_externe'].'"';
						echo	',"four"'; 
						echo	',"pas dem"'; 
						if($nbre_row4 != 0 or $indice_row!=$nbre_row3)
								echo '],';
						else
								echo ']';
						$indice_row++;
				}
				$reponse3->closeCursor();
				$indice_row = 1;
				while ($row = $reponse4->fetch())
				{
						echo '[';
						echo '"'.$row['ref_externe_prestataire'].'"';
						echo	',"bee"'; 
						echo	',"pas dem"'; 
						if($indice_row==$nbre_row4)
								echo ']';
						else
								echo '],';
						$indice_row++;
				}
				$reponse4->closeCursor();
				echo ']}';
		}
?>
