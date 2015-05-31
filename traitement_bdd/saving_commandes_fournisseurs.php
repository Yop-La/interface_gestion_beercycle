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
		

		
// Partie 0 : on vérifie que l'on a bien toutes les variables dans le $_POST	qu'elles contiennent les bonnes choses et si ce n'est pas le cas , on renvoie un message d'erreur

		// définition des tableaux contenant les index du post
				// pour l'entete
				$index_entete=['ref_externe','fournisseur','code_devise','montant_expe','nbre_ligne','commentaires'];
				// pour les lignes de cmde fourni
				$index_ligne=['marque','modele','etat','ref_dmd_zfw','qte_cmde','prix_unitaire'];
		
		// on vérifie que les index de l'entête sont présents et non vides
		foreach($index_entete as $index)
		{
				if(empty($_POST[$index]))
				{
						if(!($index=='commentaires' && isset($_POST[$index])))
								erreur(" Tous les post de la partie entete ne sont pas présents ou remplis. Vérifier votre saisie");
				}
		}
		
		// on vérifie que les variables des lignes de commandes dans le post sont toutes bien là ! et qu'elles ne sont pas vides
		for($indice_ligne=1;$indice_ligne<=$_POST['nbre_ligne'];$indice_ligne++)
		{
				foreach($index_ligne as $index)
				{
						if(empty($_POST[$index.$indice_ligne]))
						{
								erreur(" Tous les post des lignes de commandes ne sont pas présents ou remplis. Vérifier votre saisie");
						}

				}
		}

		// espace pouir vérifier le contenu de ces variables !




// partie I : écriture de l'entête de la commande dans la table cmde_fournisseur*
			
				// on vérifie d'abord que la ref_externe n'existe dans aucune table !
				$ref_externe_existe=retour_select(
						'select ref_cmde_externe from cmde_fournisseur where ref_cmde_externe = ?',
						array($_POST['ref_externe']),
						'ref_cmde_externe',
						$bdd
				);
				if($ref_externe_existe!==null)
				{
						erreur("La ref externe saisie existe déjà dans la base. Or elle doit être unique" );
				}
		
				// insertion de la commande fournisseur
				$req_insert_cmde = 
				'insert into cmde_fournisseur
				(
							ref_fournisseur,
							date_cmde,
							statut,
							ref_cmde_externe,
							commentaire,
							code_devise,
							user_id,
							date_heure_maj
					)values
					(
							:ref_fourni,
							NOW(),
							"ouvert",
							:ref_externe,
							:commentaire,
							:code_devise,
							"bidon",
							NOW()
					)';



				$pdo_insert_cmde=$bdd->prepare($req_insert_cmde);
				$pdo_insert_cmde->execute(array(
						'ref_fourni' => $_POST['fournisseur'], 
						'ref_externe' => $_POST['ref_externe'],
						'commentaire' => $_POST['commentaires'],
						'code_devise' => $_POST['code_devise']
				));
				errors_pdo($pdo_insert_cmde);
				$ref_cmdef=$bdd->lastInsertId();
				$pdo_insert_cmde->closeCursor();

// partie II : écriture des lignes de commande fournisseur dans la table ligne_commande_origine et maj des qte cmde dans la table demande_zfw				
				$montant_total=0; //sert dans la partie facturation
				for($indice_ligne=1;$indice_ligne<=$_POST['nbre_ligne'];$indice_ligne++)
				{
				// première étape : insertion des lignes
						// définition des indices du tableau post qui changent d'une ligne à l'autre
						$marque='marque'.$indice_ligne;
						$modele='modele'.$indice_ligne;
						$etat='etat'.$indice_ligne;
						$ref_dmd_zfw='ref_dmd_zfw'.$indice_ligne;
						$qte_cmde='qte_cmde'.$indice_ligne;
						$prix_unitaire='prix_unitaire'.$indice_ligne;

						// calcul montant total
						$montant_total+=$_POST[$qte_cmde]*$_POST[$prix_unitaire];

						// on récupère la ref produit 
						$ref_produit=get_id_produit($_POST[$marque],$_POST[$modele],$_POST[$etat],$bdd);

						$req_insert_ligne =
						"insert into ligne_commande_origine(
								ref_cmdef,
								ref_demande_zfw,
								ref_produit,
								qte_cmdee,
								prix_unitaire,
								user_id,
								date_heure_maj
							)values(
								:ref_cmdef,
								:ref_dmd_zfw,
								:ref_produit,
								:qte_cmdee,
								:prix_unitaire,
								'bidon',
								NOW()
							);";
						$pdo_insert_ligne = $bdd->prepare($req_insert_ligne);
						$pdo_insert_ligne->execute(array(
								'ref_cmdef' => $ref_cmdef,
								'ref_dmd_zfw' => $_POST[$ref_dmd_zfw],
								'ref_produit' => $ref_produit,
								'qte_cmdee' => $_POST[$qte_cmde],
								'prix_unitaire' => $_POST[$prix_unitaire]
						));
						errors_pdo($pdo_insert_ligne);
						$pdo_insert_ligne->closeCursor();

				// deuxième étape : maj de la table dmd_zfw
						
						$req_update_dmd_zfw = 
						"UPDATE demande_zfw 
						SET 
							qte_cmdee = :qte_cmdee,
							date_dern_maj=NOW(),
							user_id='bidon'
						WHERE 
							ref_dde_zfw = :ref_dde_zfw";
						
						$pdo_update_dmd_zfw=$bdd->prepare($req_update_dmd_zfw);
						$pdo_update_dmd_zfw->execute(array(
							'qte_cmdee'=>$_POST[$qte_cmde],
							'ref_dde_zfw'=>$_POST[$ref_dmd_zfw]
						));
						errors_pdo($pdo_update_dmd_zfw);
						$pdo_update_dmd_zfw->closeCursor();
				}

// partie III : écriture de la facturation fournisseur
						
						
				// ajout des frais de port au montant total
				$montant_total+=$_POST['montant_expe'];

				$req_insert_factu = "insert into facturation_fournisseur(
					ref_cmdef,
					montant_ht,
					montant_ttc,
					code_devise,
					delai_reglt_prev,
					date_edition,
					statut,
					user_id,
					date_heure_maj
				)values(
					:ref_cmdef,
					:montant_ht,
					:montant_ttc,
					:code_devise,
					DATE_ADD(NOW(), INTERVAL 15 DAY),
					NOW(),
					'ouverte',
					'bidon',
					NOW()
				)";

				$pdo_insert_factu = $bdd->prepare($req_insert_factu);
				$pdo_insert_factu->execute(array(
					'ref_cmdef'=>$ref_cmdef,
					'montant_ht'=>$montant_total,
					'montant_ttc'=>$montant_total,
					'code_devise'=>$_POST['code_devise']
				));
				errors_pdo($pdo_insert_factu);
				$pdo_insert_factu->closeCursor();

				retour_ajax('Commande bien enregistrée');
}
else
{
		echo header('Location: ../access.php');
}
?>
