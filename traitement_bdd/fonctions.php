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
?>
