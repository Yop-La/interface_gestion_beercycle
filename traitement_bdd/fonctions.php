<?php
		
		// fonction pour vérifier que post est un entier
		function verif_entier($post)
		{
				if (is_numeric($post) && (intval(0 + $post) == $post)) {
						return true;
				} else {
						return false;
				}
		}
		
		// fonction pour vérifier que post est un entier non nulle
		function verif_entier_non_nul($post)
		{
				if (is_numeric($post) && (intval(0 + $post) == $post && $post!=0)) {
						return true;
				} else {
						return false;
				}
		}

		// fonction pour vérifier post est un double
		function verif_double($post)
		{
				if(is_numeric($post)) {
						return true;
				} else {
						return false;
				}
		}

		// fonction pour vérifier que post n'est pas une chaîne vide

		function verif_chaine_non_vide($post)
		{
				if($post!='') {
						return true;
				} else {
						return false;
				}
		}

		// fonction qui retourne les messages d'erreur des scripts ajax
		function erreur($message)
		{
					$retour=array();
					array_push($retour,false);
					array_push($retour,$message);
					echo json_encode($retour);
					exit;
		}

		// fonction qui retourne les résultats des scripts ajax (sans erreur)
		function retour_ajax($contenu)
		{
					$retour=array();
					array_push($retour,true);
					array_push($retour,$contenu);
					echo json_encode($retour);
					exit;
		}
		// fonction qui retourne la ref produit à partir de la marque, du modèle et de l'état passés en paramètres
		function get_id_produit($marque,$modele,$etat,$bdd)
		{
				$requete_get_id_produit='select ref_produit from produit where marque = ? and modele = ? and commentaire = ?';
				$retour_produit=$bdd->prepare($requete_get_id_produit);
				$retour_produit->execute(array(
						$marque,
						$modele,
						$etat
				));
				$produit=$retour_produit->fetch();
				$retour_produit->closeCursor();
				return($produit['ref_produit']);
		}

		// fonction pour afficher les erreurs sql après exécution d'une requête pdo
		function errors_pdo($pdo)
		{
				$erreurs_sql = $pdo->errorInfo();
				if($erreurs_sql[1]!=null)
				{
						erreur('Erreur d\'exécution de la requete : '.print_r($erreurs_sql,true));
				}

		}
		// fonction pour exécuter une requête de type select avec les méthodes prepare et  execute. Cette fonction est faîte pôur les requêtes qui ne retournent qu'une seule ligne
				// $req est la requête sous forme de string
				// $array est le tableau des données qui complètent la requête ( les  ? )
				// $index_rep est l'index permettant de sélectionner la réponse de la requête
		function retour_select($req,$array,$index_rep,$bdd)
		{
				$pdo=$bdd->prepare($req);
				$pdo->execute($array);
				$rep=$pdo->fetch();
				errors_pdo($pdo);
				$pdo->closeCursor();
				return($rep[$index_rep]);
		}	
		// idem que fonction précedente sauf que cela retourne tout le retour de fecth et pas juste une case
		function retour_fetch_select($req,$array,$bdd)
		{
				$pdo=$bdd->prepare($req);
				$pdo->execute($array);
				$rep=$pdo->fetch();
				errors_pdo($pdo);
				$pdo->closeCursor();
				return($rep);
		}

			
	?>
