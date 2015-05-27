<?php
session_start();	
header ('Content-type:text/html; charset=utf-8');
if(!isset($_SESSION['identification']))
{
		$_SESSION['identification']=false;
}
include("fonctions.php");
if($_SESSION['identification'])
{
// ce fichier sert à enregistrer les ventes saisies dans le formulaire saisie vente. Il y a deux cas possibles de vente
		// soit on est dans le cas d'une vente immédiate -> on enregistre directement l'IMEI ( se fait après avoir valider le formulaire de saisie de l'IMEI )
		// soit on est dans le cas d'une vente avec livraison ( a retirer en boutique plus tard ou à livrer chez le client ) -> on n'enregistre pas l'IMEI car produit pas donné au client de suite 
		
// dans les deux cas, on met la vente dans cmde_client, on met à jour les stocks et on produit les factures clients
		// tableau qui contient touts les indexs du post
		$index_post=["id_vendeur","ref_canal_distrib","marque","modele","etat","qte_vendu","lieu_stockage","qte_dispo","pseudo","prenom","nom","devise","prix_devise","prix_usd","fonction","montant_total"];
		
// afin se savoir si on insère la vente ( et de vérifier l'instanciation des post pour l'insertion d'une vente aussi )

		$insertion_vente=true;
		foreach($index_post as $index)
		{
				if(empty($_POST[$index]))
				{
						if(!isset($_POST['qte_dispo']))
								$insertion_vente=false;
				}
		}
	
// connexion à la bdd
include("connexion.php");

// afin de savoir si on finalise une vente immédiate (rengistrement IMEI )
		$update_vente_immediate=true;
		if(empty($_POST['ref_cmde_client']))
		{
				$update_vente_immediate=false;
		}
		if($update_vente_immediate)
		{
				$qte = retour_select('select qte from cmde_client where ref_cmdec = ?',array($_POST['ref_cmde_client']),'qte',$bdd);
				for($indice_imei=1;$indice_imei<=$qte;$indice_imei++)
				{
						if(empty($_POST['IMEI'.$indice_imei]))
						{
								$update_vente_immediate=false;
						}
				}
		}




// pour vérifier l'instanciation des post et le remplissage des champs
		if(!$insertion_vente && !$update_vente_immediate)
		{
				erreur('Tous les champs ou post ne sont pas instanciées ou pas tous remplis');
		}

		// pour insérer la vente après saisie du formulaire des ventes
		if($insertion_vente && !$update_vente_immediate)
		{
		// 1ère partie : enregistrement de la vente dans cmde_client
				// on récupère la ref_produit
				$id_produit=get_id_produit($_POST['marque'],$_POST['modele'],$_POST['etat'],$bdd);

				// on récupère la ref_canal_distrib
				$ref_canal_distrib = retour_select("select ref_canal_distrib from utilisateur where identifiant = ?",array($_POST['id_vendeur']),'ref_canal_distrib',$bdd);

				// on récupère le code devise
				$code_devise = retour_select("select code_devise from devise where libelle = ?",array($_POST['devise']),'code_devise',$bdd);


				// on récupère le prix de la vente dans la devise de la vente
				
				// tableau qui à partir de $_POST['fonction'] nous donne le statut de la commande
				$statut_commande=array();
				$statut_commande['vente_immediate']='livré';
				$statut_commande['a_livrer']='a expédier';
				$statut_commande['a_retirer_en_boutique']='a retirer en boutique ultérieurement';

				// on récupère la ref_lieu_stockage par défaut du vendeur
				$ref_stock_defaut = retour_select("select ls.ref_lieu_stockage as ref_stock from utilisateur as ut, canal_de_distribution as cdd, lieu_stockage as ls where identifiant = ? and ut.ref_canal_distrib=cdd.ref_canal_distrib and ls.ref_lieu_stockage=cdd.ref_lieu_stockage_defaut",array($_POST['id_vendeur']),'ref_stock',$bdd);
				
				// afin de déterminer la date de livraison prévue
				if($_POST['fonction']!='vente_immediate')
				{
						$qte_dispo = retour_select("select qte from position_zfw_reelle where ref_produit = ? and qte !=0 and ref_lieu_stockage = ? order by date_archivage desc limit 1",array($id_produit,$ref_stock_defaut),'qte',$bdd);
						if($qte_dispo>$_POST['qte_vendu'] and $qte_dispo != null)
								$date_liv_prevu="DATE_ADD(NOW(), INTERVAL 10 DAY))";
						else
								$date_liv_prevu="DATE_ADD(NOW(), INTERVAL 15 DAY))";
						$date_liv_reelle="null";
							
				}
				else
				{
						$date_liv_prevu=' NOW())';
						$date_liv_reelle = 'NOW()';
				}

				$req_insert_vente="insert into cmde_client(ref_produit, pseudo, ref_canal_distrib, date_cmde, ref_vendeur, code_devise, qte, montant_ht, montant_port, montant_taxe, montant_total, taux_taxe, statut, user_id, date_heure_maj, date_livraison_reelle, date_livraison_prevue) values(?, ?, ?,NOW(), ?, ?, ?, ?, null, 0, ?, 0, ?, 'bidon', NOW(), ".$date_liv_reelle.",".$date_liv_prevu;
				$pdo_insert_vente=$bdd->prepare($req_insert_vente);
				$pdo_insert_vente->execute(array(
						$id_produit,
						$_POST['pseudo'],
						$ref_canal_distrib,
						$_POST['id_vendeur'],
						$code_devise,
						$_POST['qte_vendu'],
						$_POST['montant_total'],
						$_POST['montant_total'],
						$statut_commande[$_POST['fonction']]
				));
				// pour afficher les erreurs de base  lors d'une exécution d'une requete
				errors_pdo($pdo_insert_vente);
				$last_id_vente=$bdd->lastInsertId(); // on récupère l'id du dernier enregistrement pour pouvoir le mettre à jour par la suite
				$pdo_insert_vente->closeCursor();

		// 2ème partie : maj des stocks
				// maj du stock previ dans tout les cas
				// on récupère la ref_lieu_stockage
				$ref_lieu_stockage = retour_select('select ref_lieu_stockage from lieu_stockage where libelle = ?',array($_POST['lieu_stockage']),'ref_lieu_stockage',$bdd);
				// on calcule la nouvelle quantité du stock
				$qte_avt_vente = retour_select('select qte from position_zfw_previ where ref_lieu_stockage = ? and ref_produit = ? order by date_archivage desc limit 1 ',array($ref_lieu_stockage, $id_produit),'qte',$bdd);
				if($qte_avt_vente == null)
				{
						$qte_avt_vente = 0;
				}

				$qte_stock = $qte_avt_vente-$_POST['qte_vendu'];

				// on insère la nouvelle ligne de stock 
				$req_insert_stock='insert into position_zfw_previ (date_archivage, ref_lieu_stockage, ref_produit, qte, user_id, date_heure_maj) values(NOW(),:ref_lieu_stockage,:ref_produit,:qte,"bidon",NOW())';
				$pdo_insert_stock=$bdd->prepare($req_insert_stock);
				$pdo_insert_stock->execute(array(
						'ref_lieu_stockage'=>$ref_lieu_stockage,
						'ref_produit'=>$id_produit,
						'qte'=>$qte_stock
				));
				errors_pdo($pdo_insert_stock);
				$pdo_insert_stock->closeCursor();
				
				// maj du stock réelle dans le cas d'une vente immédiated
				if($_POST['fonction']=='vente_immediate')
				{
						// on calcule la nouvelle quantité du stock
						$qte_avt_vente = retour_select('select qte from position_zfw_reelle where ref_lieu_stockage = ? and ref_produit = ? order by date_archivage desc limit 1 ',array($ref_lieu_stockage, $id_produit),'qte',$bdd);
						if($qte_avt_vente == null)
						{
								$qte_avt_vente = 0;
						}

						$qte_stock = $qte_avt_vente-$_POST['qte_vendu'];

						// on insère la nouvelle ligne de stock 
						$req_insert_stock='insert into position_zfw_reelle (date_archivage, ref_lieu_stockage, ref_produit, qte, user_id, date_heure_maj) values(NOW(),:ref_lieu_stockage,:ref_produit,:qte,"bidon",NOW())';
						$pdo_insert_stock=$bdd->prepare($req_insert_stock);
						$pdo_insert_stock->execute(array(
								'ref_lieu_stockage'=>$ref_lieu_stockage,
								'ref_produit'=>$id_produit,
								'qte'=>$qte_stock
						));
						errors_pdo($pdo_insert_stock);
						$pdo_insert_stock->closeCursor();
				}

// pour produire la facture client
				
				$req_factu_client = "insert into facturation_client(ref_cmdec, montant_ht, montant_ttc, code_devise, delai_reglt_prev, statut, user_id, date_heure_maj) values(?, ?, ?, ?,DATE_ADD(NOW(), INTERVAL 15 DAY) , 'ouverte', 'bidon', NOW())";
				$pdo_factu_client = $bdd -> prepare($req_factu_client);
				$pdo_factu_client->execute(array(
						$last_id_vente,
						$_POST['montant_total'],
						$_POST['montant_total'],
						$code_devise
				));
				errors_pdo($pdo_factu_client);
				$pdo_factu_client->closeCursor();
				
				// on renvoie l'id de la vente qui sera utilisé dans le cas de la vente immédiate (saisie de l'IMEI)
				retour_ajax($last_id_vente);
		}
		// pour mettre à jour la vente et insérer l'IMEI dans la table IMEI vente après saisie du formulaire IMEI et dans le cas d'une vente immédiate
		if(!$insertion_vente && $update_vente_immediate)
		{
				
				for($indice_imei=1;$indice_imei<=$qte;$indice_imei++)
				{
						$req_insert_imei = 'insert into imei_vente(code_imei, ref_cmdec, user_id, date_heure_maj) values(?,?,"bidon",NOW())';
						$pdo_insert_imei=$bdd->prepare($req_insert_imei);
						$pdo_insert_imei->execute(array(
								$_POST['IMEI'.$indice_imei],
								$_POST['ref_cmde_client']
						));
						errors_pdo($pdo_insert_imei);
						$pdo_insert_imei->closeCursor();
				}
		}
// pour finaliser la vente après saisie IMEI dans le cas d'une vente immédiate ou après saisie des infos d'expéditions dans le cadre d'une vente avec livraison
		if(!$insertion_vente && $update_vente_immediate)
		{
				retour_ajax('Vente bien registré !');
		}
}
else
{		
		erreur("Erreur : vous n'êtes pas authentifié");
}
