<?php
session_start();	
header ('Content-type:text/html; charset=utf-8');
if(!isset($_SESSION['identification']))
{
		$_SESSION['identification']=false;
}
if($_SESSION['identification'])
{
		//connexion à la bdd
		include("connexion.php");
		include("fonctions.php");
		
// variable qui contient l'identifiant de la dernière commande inséreé dans la table cmde_fournisseur

		$ref_cmdef=null;
		
// Partie 0 : on vérifie que l'on a bien toutes les variables dans le $_POST	qu'elles contiennent les bonnes choses et si ce n'est pas le cas , on renvoie un message d'erreur


		// comptage des lignes de commandes 
		$nbre_ligne_champs = (count($_POST)-3)/7;
		
		// on vérifie que les variables des lignes de commandes dans le post sont toutes bien là ! et qu'elles contiennent les bonnes choses
		$variables_presentes=true;
		$variables_non_vide=true;
		$variables_correctes=true;
		$indice_row=0;
		do{
				$indice_row++;
				// définition des indices du tableau post qui changent d'une ligne à l'autre
				$marque='marque'.$indice_row;
				$modele='modele'.$indice_row;
				$etat='etat'.$indice_row;
				$ref_dmd_zfw='ref_dmd_zfw'.$indice_row;
				$qte_cmde='qte_cmde'.$indice_row;
				$prix_unitaire='prix_unitaire'.$indice_row;	
				$code_devise='code_devise'.$indice_row;
				// on teste la présence des variables
				if(!($_POST[$marque]!==null and $_POST[$modele]!==null and $_POST[$etat]!==null and $_POST[$ref_dmd_zfw]!==null and $_POST[$qte_cmde]!==null and $_POST[$prix_unitaire]!==null and $_POST[$code_devise]!==null))
				{
						$variables_presentes=false;
				}
				// on teste leurs contenus

		}while($variables_presentes && $indice_row !=$nbre_ligne_champs);

		if(!(isset($_POST['commentaires']) and isset($_POST['fournisseur']) and isset($_POST['ref_externe'])))
		{
				$variables_presentes=false;
		}

		







		// si toutes les variables sont présentes alors on les enregistrent	
		if($variables_presentes )
		{
		
// partie I : écriture de l'entête de la commande dans la table cmde_fournisseur
				$ref_fournisseur = $_POST['fournisseur'];
				$ref_cmde_externe = $_POST['ref_externe'];
				$commentaire = $_POST['commentaires'];
		
				// préparation de la requête d'insertion de l'entête
				$req=$bdd->prepare('INSERT INTO cmde_fournisseur(ref_fournisseur, date_cmde, statut, ref_cmde_externe, commentaire, user_id, date_heure_maj) VALUES (:ref_fournisseur, NOW(), \'ouvert\', :ref_commande_externe, :commentaire, \'bidon\', NOW())') or die(print_r($bdd->errorInfo()));
				
				// exécution de la requête d'insertion de la requête
				$req->execute(array(
					'ref_fournisseur' => $ref_fournisseur, 
					'ref_commande_externe' => $ref_cmde_externe,
					'commentaire' => $commentaire
					));
				$ref_cmdef=$bdd->lastInsertId();
				$req->closeCursor();

// partie II : écriture des lignes de commande fournisseur dans la table ligne_commande_origine


				// déclaration du tableau qui va contenir les couples ref_dmd_zfw et quantite commande afin de pouvoir mettre à jour les quantités commandées par la suite
				$maj_champs_qtee_cmdee=array();

				// on va maitenat écrire dans la table ligne_commande_origine
				for($indice_row=1;$indice_row<=$nbre_ligne_champs;$indice_row++)
				{
						// définition des indices du tableau post qui changent d'une ligne à l'autre
						$marque='marque'.$indice_row;
						$modele='modele'.$indice_row;
						$etat='etat'.$indice_row;
						$ref_dmd_zfw='ref_dmd_zfw'.$indice_row;
						$qte_cmde='qte_cmde'.$indice_row;
						$prix_unitaire='prix_unitaire'.$indice_row;
						$code_devise='code_devise'.$indice_row;
						
						// on écrit les couples ref_dmd_zfw et qte_cmdee dans la table $maj_champs_qtee_cmdee
						$maj_champs_qtee_cmdee[$_POST[$ref_dmd_zfw]]=$_POST[$qte_cmde];

						// on récupère la ref_produit de la ligne à partir du modèle et de l'état
						$req = $bdd->prepare('SELECT DISTINCT ref_produit FROM produit where modele = ? and commentaire = ?');
						$req->execute(array(
							$_POST[$modele],
							$_POST[$etat]));
						$data = $req->fetch();
						$ref_produit=$data['ref_produit'];
						$req->closeCursor();

					// préparation de la requête d'insertion de la ligne de commande courante
					$req=$bdd->prepare('INSERT INTO ligne_commande_origine(ref_cmdef, ref_demande_zfw, ref_produit, qte_cmdee, prix_unitaire, code_devise) VALUES (:ref_cmdef, :ref_demande_zfw, :ref_produit, :qte_cmdee, :prix_unitaire, :code_devise)') or die(print_r($bdd->errorInfo()));
					
					// exécution de la requête d'insertation de la ligne de commande courante
					$req->execute(array(
						'ref_cmdef' => $ref_cmdef,
						'ref_demande_zfw' => $_POST[$ref_dmd_zfw], 
						'ref_produit' => $ref_produit,
						'qte_cmdee' => $_POST[$qte_cmde],
						'prix_unitaire' => $_POST[$prix_unitaire],
						'code_devise' => $_POST[$code_devise]
						));
					$req->closeCursor();

			}

			// maj des champs quantité commandée de la table demande_zfw
			foreach($maj_champs_qtee_cmdee as $ref_dmd_zfw => $qte_cmdee)
			{
					$req=$bdd->prepare('UPDATE demande_zfw SET qte_cmdee = :qte_cmdee WHERE ref_dde_zfw = :ref_dde_zfw');	
					$req->execute(array(
						'qte_cmdee' => $qte_cmdee,
						'ref_dde_zfw' => $ref_dmd_zfw
						));
					$req->closeCursor();
			}
		// on redirige vers l'écran de saisie des commandes
		echo header('Location: ../saisie_commandes_fournisseurs.php');
		}
		else
		{
			echo "Erreur d'enregistrement : votre demande n'a pas été enregistrée. Veuillez la renouveller";
		}




}
else
{
		echo header('Location: ../access.php');
}
?>
