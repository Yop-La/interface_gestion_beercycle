<?php
session_start();	
header ('Content-type:text/html; charset=utf-8');
if(!isset($_SESSION['identification']))
{
		$_SESSION['identification']=false;
}
include("fonctions.php");
// chaîne de caractère retour qui sera compléter au fur et à mesure envoyé au client
$retour=null;
if($_SESSION['identification'])
{
		
// ce fichier sert à enregistrer les ventes saisies dans le formulaire saisie vente. Il y a deux cas possibles de vente
		// soit on est dans le cas d'une vente immédiate -> on enregistre directement l'IMEI ( se fait après avoir valider le formulaire de saisie de l'IMEI )
		// soit on est dans le cas d'une vente avec livraison -> on n'enregistre pas l'IMEI car produit pas donné au client de suite ( se fait après avoir valider le formulaire de saisie d'une vente )
// dans le deuxième cas, on met la vente dans cmde_client, les stocks et on produit les factures clients
		// tableau qui contient touts les indexs du post
		$index_post=["id_vendeur","ref_canal_distrib","marque","modele","etat","qte_vendu","lieu_stockage","qte_dispo","pseudo","prenom","nom","devise","prix_devise","prix_usd"];
		
// afin se savoir si on insère la vente ( et de vérifier l'instanciation des post pour l'insertion d'une vente aussi )

		$insertion_vente=true;
		foreach($index_post as $index)
		{
				if(empty($_POST[$index]))
				{
						$insertion_vente=false;
				}
		}
	
// connexion à la bdd
include("connexion.php");

// afin de savoir si on finalise une vente immédiate
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

				$req_insert_vente="insert into cmde_client(ref_produit, pseudo, ref_canal_distrib, date_cmde, ref_vendeur, code_devise, qte, montant_ht, montant_port, montant_taxe, montant_total, taux_taxe, flag_cmde_livree, user_id, date_heure_maj) values(?, ?, ?,NOW(), ?, ?, ?, null, null, null, null, null, null, 'bidon', NOW() )";
				$pdo_insert_vente=$bdd->prepare($req_insert_vente);
				$pdo_insert_vente->execute(array(
						$id_produit,
						$_POST['pseudo'],
						$ref_canal_distrib,
						$_POST['id_vendeur'],
						$code_devise,
						$_POST['qte_vendu']
				));
				// pour afficher les erreurs de base  lors d'une exécution d'une requete
				errors_pdo($pdo_insert_vente);
				$last_id_vente=$bdd->lastInsertId(); // on récupère l'id du dernier enregistrement pour pouvoir le mettre à jour par la suite
				$pdo_insert_vente->closeCursor();

		// 2ème partie : maj des stocks
				// on récupère la ref_lieu_stockage
				$ref_lieu_stockage = retour_select('select ref_lieu_stockage from lieu_stockage where libelle = ?',array($_POST['lieu_stockage']),'ref_lieu_stockage',$bdd);
				// on calcule la nouvelle quantité du stock
				$qte_stock = $_POST['qte_dispo']-$_POST['qte_vendu'];

				// on insère la nouvelle ligne de stock 
				$req_insert_stock='insert into position_zfw (date_archivage, ref_lieu_stockage, ref_produit, qte, user_id, date_heure_maj) values(NOW(),:ref_lieu_stockage,:ref_produit,:qte,"bidon",NOW())';
				$pdo_insert_stock=$bdd->prepare($req_insert_stock);
				$pdo_insert_stock->execute(array(
						'ref_lieu_stockage'=>$ref_lieu_stockage,
						'ref_produit'=>$id_produit,
						'qte'=>$qte_stock
				));
				errors_pdo($pdo_insert_stock);
				$pdo_insert_stock->closeCursor();
						
				
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
