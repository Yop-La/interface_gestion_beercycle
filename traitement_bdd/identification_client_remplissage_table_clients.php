<?php
		session_start();	
		header ('Content-type:text/html; charset=utf-8');
		if(!isset($_SESSION['identification']))
		{
				$_SESSION['identification']=false;
		}
		if($_SESSION['identification'])
		{

		// pour remplir la table des clients
				
				// connexion à la base
				include("connexion.php");

				// requête à soumettre à la base sql pour récupérer tous les clients
				$tous_les_clients="select username, prenom, nom from client"; 
				// requête à soumettre à la base sql pour récupérer tous les prospects
				$tous_les_prospects="select username, prenom, nom from prospect"; 
				
				//fonction qui retourne les données de la requête au format de la DataTable nommée "listes des demandes non satisfaites"
				echo '{"data": [';

				$pdo_tous_clients = $bdd->query($tous_les_clients);
				$nbre_clients= $pdo_tous_clients->rowCount();
				$indice_client = 1;
				
				$pdo_tous_prospects = $bdd->query($tous_les_prospects);
				$nbre_prospects= $pdo_tous_prospects->rowCount();
				$indice_prospect = 1;
				while ($client = $pdo_tous_clients->fetch())
				{
						echo '[';
						echo '"'.$client['username'].'",';
						echo '"'.$client['prenom'].'",';
						echo '"'.$client['nom'].'"';
						if($indice_client==$nbre_clients && $nbre_prospects==0)
								echo ']';
						else
								echo '],';
						$indice_client++;
				}
				while ($prospect = $pdo_tous_prospects->fetch())
				{
						echo '[';
						echo '"'.$prospect['username'].'",';
						echo '"'.$prospect['prenom'].'",';
						echo '"'.$prospect['nom'].'"';
						if($indice_prospect==$nbre_prospects)
								echo ']';
						else
								echo '],';
						$indice_prospect++;
				}
				echo ']}';
		}
?>
