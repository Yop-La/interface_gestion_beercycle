<?php
		session_start();	
		header ('Content-type:text/html; charset=utf-8');
		include("fonctions.php");
		if(!isset($_SESSION['identification']))
		{
				$_SESSION['identification']=false;
		}
		if($_SESSION['identification'])
		{
				// Ce fichier sert à pré-remplir le formulaire saisie des clients dans les cas suivants :
						// soit dans le cas ou l'on doit saisir les infos d'expédition d'un client pour lui envoyer le produit qu'il va bientôt acheter
						// soit dans le cas ou l'on doit mettre à jour les données d'un client sauf le pseudo qui est définitive
				include("connexion.php");

				//tableau qui contient les nom des champs soit de la table client, soit de la table prospect qui vont servir au pré-remplissage
				$champs_preremplissage=array();

				// pour préremplir le formulaire de saisie des clients, dans le cas où l'on a besoin des infos pour expédier le produit sur le point d'ere vendu
				if(!empty($_POST['pseudo']) && !empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['fonction']))
				{
						$champs_preremplissage=['username','prenom','nom','email','tel1','tel2','adresse_liv','ville_liv','region_liv','pays_liv','adresse_fac','ville_fac','region_fac','pays_fac','commentaire'];
						$ret_client_prospect=null;
						$req_get_client='select * from client where username = ?';
						$pdo_get_client=$bdd->prepare($req_get_client);
						$pdo_get_client->execute(array($_POST['pseudo']));
						if($pdo_get_client->rowCount()==0)
						{
								$req_get_prospect='select * from prospect where username = ?';
								$pdo_get_prospect=$bdd->prepare($req_get_prospect);
								$pdo_get_prospect->execute(array($_POST['pseudo']));
								errors_pdo($pdo_get_prospect);
								$ret_client_prospect=$pdo_get_prospect->fetch();		
								$pdo_get_prospect->closeCursor();
								$champs_preremplissage=['username','prenom','nom','email','tel1','tel2','adresse','ville','region','pays','commentaire'];
						}
						errors_pdo($pdo_get_client);
						$ret_client_prospect=$pdo_get_client->fetch();		
						$pdo_get_client->closeCursor();
						$donnees_form=array();
						foreach($champs_preremplissage as $champ)
						{
								if($ret_client_prospect[$champ]==null)
								{
										$donnees_form[$champ]='';
								}
								$donnees_form[$champ]=$ret_client_prospect[$champ];
						}
						retour_ajax($donnees_form);
						}
		}
		else
		{
				erreur(" Erreur : vous n'êtes pas authentifié");
		}
?>
