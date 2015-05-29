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
// ce fichier sert à enregistrer les ventes saisies dans le formulaire saisie vente et aussi à enregistrer les IMEI. Il y a deux cas possibles de vente
		// soit on est dans le cas d'une vente immédiate -> on enregistre directement l'IMEI ( se fait après avoir valider le formulaire de saisie de l'IMEI )
		// soit on est dans le cas d'une vente avec livraison ( a retirer en boutique plus tard ou à livrer chez le client ) -> on n'enregistre pas l'IMEI car produit pas donné au client de suite 
		// c'est la variable $_POST['fonction'] qui nous permet de savoir dans quelles cas de ventes on est. Elle peut prendre trois valeurs :
				// 'vente_immediate'
				// 'a_livrer'
				// 'a_retirer_en_boutique'

// ce fichier est utilisé après saisie des ventes ( 1er cas d'utilisation ) et après saisie des IMEI. Les posts nous permettent de savoir si on est dans le cas d'une saisie de vente ou d'une saisie de IMEI

// dans tous les cas de ventes, on met la vente dans cmde_client, on met à jour les stocks (réélles et/ou prévi) et on produit les factures clients. Et dans le cas, de la vente immédiate, on réutilisera ce fichier pour enregistrer les IMEI
		// tableau qui contient touts les indexs du post exceptée les champs des lignes de commandes
		$index_post=["id_vendeur","ref_canal_distrib","pseudo","prenom","nom","devise","fonction","montant_total", 'nbre_ligne_vente'];

		$index_post_ligne_vente = ["marque","modele","etat","qte_vendu","lieu_stockage","qte_dispo","prix_devise","prix_usd"];
		
// afin se savoir si on insère une vente ( et de vérifier l'instanciation des post pour l'insertion d'une vente aussi )

		$insertion_vente=true; // vaut true si on est dans le cas d'une saisie de vente
		// on regarde si les index_post dans le cas d'une saisie de vente sont présents et non vides
		foreach($index_post as $index)
		{
				if(empty($_POST[$index]))
				{
						$insertion_vente=false;
						break;
				}
		}
		// on regarde si les posts des lignes de vente sont présents et non vides
		if($insertion_vente)
		{
				for($indice_ligne_vente=1;$indice_ligne_vente<=$_POST['nbre_ligne_vente'];$indice_ligne_vente++)
				{
						foreach($index_post_ligne_vente as $index)
						{
								if(empty($_POST[$index.'_'.$indice_ligne_vente]))
								{
										if($index=='qte_dispo')
										{
												if(!isset($_POST[$index.'_'.$indice_ligne_vente]))
												{
														$insertion_vente=false;
														break;
												}
										}
										else
										{
												$insertion_vente=false;
												break;
										}
										
								}
						}
				}
		}

	
// connexion à la bdd
include("connexion.php");

// afin de savoir si on finalise une vente immédiate (enregistrement IMEI )
		$update_vente_immediate=true;
		if(empty($_POST['ref_cmde_client']))
		{
				$update_vente_immediate=false;
		}
		$qte_totale=0;
		if($update_vente_immediate)
		{
				$qte_totale = retour_select('select qte_totale from cmde_client where ref_cmdec = ?',array($_POST['ref_cmde_client']),'qte_totale',$bdd);
				for($indice_imei=1;$indice_imei<=$qte_totale;$indice_imei++)
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

				// on détermine les dates de livraison réelle et prévue. Pour se faire, nous devons regarder la présence des produits de la commande dans les stocks. On en profite aussi pour déterminer la quantité totale de produits
				$qte_totale=0;// nbre de produits dans la vente
				$en_stock=true;	// vaut true si tout les produits de la commande sont en stocks	
				for($indice_ligne_vente=1;$indice_ligne_vente<=$_POST['nbre_ligne_vente'];$indice_ligne_vente++)
				{
						// on récupère l'id produit pour chaque ligne de vente	
						$id_produit=get_id_produit(
								$_POST['marque_'.$indice_ligne_vente],
								$_POST['modele_'.$indice_ligne_vente],
								$_POST['etat_'.$indice_ligne_vente],
								$bdd
						);
						// on met à jour la qte_total
						$qte_totale+=$_POST['qte_vendu_'.$indice_ligne_vente];


						$qte_dispo = retour_select(
								"select qte from position_zfw_reelle where ref_produit = ? and qte !=0 and ref_lieu_stockage = ? order by date_archivage desc limit 1",
								array
								(
										$id_produit,
										$_POST['lieu_stockage_'.$indice_ligne_vente]
								)
								,'qte',
								$bdd
						);
						// on estime que le produit n'est plus en stock si jamais la qte dans le stock est plus petite que la quantité+2 du produit vendu
						if(!($qte_dispo>=($_POST['qte_vendu_'.$indice_ligne_vente]+2) and $qte_dispo != null))
						{
								$en_stock=false;		
						}
				}
				// maintenat que l'on sait si tous les produits sont en stock ou non, on détermine les dates de lvraison prévue et réelle
				if($_POST['fonction']!='vente_immediate')
				{
						if($en_stock)
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
				
				// tableau qui à partir de $_POST['fonction'] nous donne le statut de la commande
				$statut_commande=array();
				$statut_commande['vente_immediate']='livré';
				$statut_commande['a_livrer']='a expédier';
				$statut_commande['a_retirer_en_boutique']='a retirer en boutique ultérieurement';
				
				


		$req_insert_cmde = 'insert into cmde_client(pseudo, ref_canal_distrib, date_cmde, ref_vendeur, code_devise, montant_ht, montant_port, montant_taxe, montant_total, qte_totale, taux_taxe, statut, user_id, date_heure_maj, date_livraison_reelle, date_livraison_prevue) values(:pseudo,:ref_canal_distrib,NOW(),:ref_vendeur,:code_devise,:montant_ht,null,0,:montant_total,:qte_totale,0,:statut,"bidon",NOW(), '.$date_liv_reelle.', '.$date_liv_prevu;

		$pdo_insert_cmde = $bdd->prepare($req_insert_cmde);
		$pdo_insert_cmde->execute(array(
				'pseudo'=>$_POST['pseudo'],
				'ref_canal_distrib'=>$_POST['ref_canal_distrib'],
				'ref_vendeur'=>$_POST['id_vendeur'],
				'code_devise'=>$_POST['devise'],
				'montant_total'=>$_POST['montant_total'],
				'montant_ht'=>$_POST['montant_total'],
				'qte_totale'=>$qte_totale,
				'statut'=>$statut_commande[$_POST['fonction']]
		));
		$ref_cmdec=$bdd->lastInsertId(); 
		errors_pdo($pdo_insert_cmde);
		$pdo_insert_cmde->closeCursor();

		// on va maintenant enregistrer les lignes de vente
		for($indice_ligne_vente=1;$indice_ligne_vente<=$_POST['nbre_ligne_vente'];$indice_ligne_vente++)
		{
				// on récupère l'id produit pour chaque ligne de vente	
				$ref_produit=get_id_produit(
						$_POST['marque_'.$indice_ligne_vente],
						$_POST['modele_'.$indice_ligne_vente],
						$_POST['etat_'.$indice_ligne_vente],
						$bdd
				);

				$req_insert_ligne_cc = 'insert into ligne_commande_client(ref_cmdec,ref_produit,qte_vendue, prix_vente, user_id, date_heure_maj) values(:ref_cmdec, :ref_produit, :qte_vendue, :prix_vente, "bidon", NOW())';
				$pdo_insert_ligne_cc = $bdd->prepare($req_insert_ligne_cc);
				$pdo_insert_ligne_cc->execute(array(
						'ref_cmdec'=>$ref_cmdec,
						'ref_produit'=>$ref_produit,
						'qte_vendue'=>$_POST['qte_vendu_'.$indice_ligne_vente],
						'prix_vente'=>$_POST['prix_devise_'.$indice_ligne_vente]
				));
				errors_pdo($pdo_insert_ligne_cc);
				$pdo_insert_ligne_cc->closeCursor();
		}

		// 2ème partie : maj des stocks (prévi et réelle )
				// le stock prévi est maj dans tous les cas
				// le stock réelle est maj dans le cas d'une vente immédiate

				// parcoure chaque ligne de vente pour 
				for($indice_ligne_vente=1;$indice_ligne_vente<=$_POST['nbre_ligne_vente'];$indice_ligne_vente++)
				{

				// maj du stock previ dans tous les cas
				
						// on récupère l'id produit pour chaque ligne de vente	
						$ref_produit=get_id_produit(
								$_POST['marque_'.$indice_ligne_vente],
								$_POST['modele_'.$indice_ligne_vente],
								$_POST['etat_'.$indice_ligne_vente],
								$bdd
						);


						// on calcule la nouvelle quantité du stock
						$qte_avt_vente = retour_select(
								'select qte from position_zfw_previ where ref_lieu_stockage = ? and ref_produit = ? order by date_archivage desc limit 1 ',
								array(
										$_POST["lieu_stockage_".$indice_ligne_vente],
										$ref_produit
								)
								,'qte',
								$bdd
						);
						if($qte_avt_vente == null)
						{
								$qte_avt_vente = 0;
						}

						$qte_stock = $qte_avt_vente-$_POST['qte_vendu_'.$indice_ligne_vente];
				
						// on insère la nouvelle ligne de stock 
						$req_insert_stock=
						'insert into position_zfw_previ (
								date_archivage, 
								ref_lieu_stockage, 
								ref_produit, 
								qte, 
								user_id, 
								date_heure_maj
							) 
							values(
									NOW(),
									:ref_lieu_stockage,
									:ref_produit,
									:qte,
									"bidon",
									NOW()
							)';
						$pdo_insert_stock=$bdd->prepare($req_insert_stock);
						$pdo_insert_stock->execute(array(
								'ref_lieu_stockage'=>$_POST["lieu_stockage_".$indice_ligne_vente],
								'ref_produit'=>$id_produit,
								'qte'=>$qte_stock
						));
						errors_pdo($pdo_insert_stock);
						$pdo_insert_stock->closeCursor();
				
				// maj du stock réelle dans le cas d'une vente immédiate
				$maj_stock = true;// on fait la maj du tock réelle sauf si le produit n'est pas dans le stock
				if($_POST['fonction']=='vente_immediate')
				{
						
								// on récupère l'id produit pour chaque ligne de vente	
								$ref_produit=get_id_produit(
										$_POST['marque_'.$indice_ligne_vente],
										$_POST['modele_'.$indice_ligne_vente],
										$_POST['etat_'.$indice_ligne_vente],
										$bdd
								);


								// on regarde si le produit est en stock on calcule la nouvelle quantité du stock dans ce cas. Sinon on ne fait pas la maj du stock ( pas de qte négative pour le stock réelle )
								$qte_avt_vente = retour_select(
										'select qte from position_zfw_reelle where ref_lieu_stockage = ? and ref_produit = ? order by date_archivage desc limit 1 ',
										array(
												$_POST["lieu_stockage_".$indice_ligne_vente],
												$ref_produit
										)
										,'qte',
										$bdd
								);
								if($qte_avt_vente==0)
								{
										$maj_stock=false;
								}
								else if($qte_avt_vente==null)
								{
										$qte_stock=0;		
								}
								else
								{
										$qte_stock = $qte_avt_vente-$_POST['qte_vendu_'.$indice_ligne_vente];
								}

						}
						if($maj_stock)
						{
								// on insère la nouvelle ligne de stock 
								$req_insert_stock=
								'insert into position_zfw_reelle (
										date_archivage, 
										ref_lieu_stockage, 
										ref_produit, 
										qte, 
										user_id, 
										date_heure_maj
									) 
									values(
											NOW(),
											:ref_lieu_stockage,
											:ref_produit,
											:qte,
											"bidon",
											NOW()
									)';
								$pdo_insert_stock=$bdd->prepare($req_insert_stock);
								$pdo_insert_stock->execute(array(
										'ref_lieu_stockage'=>$_POST["lieu_stockage_".$indice_ligne_vente],
										'ref_produit'=>$id_produit,
										'qte'=>$qte_stock
								));
								errors_pdo($pdo_insert_stock);
								$pdo_insert_stock->closeCursor();
						}

				}

// pour produire la facture client
				
				$req_factu_client = 
				"insert into facturation_client(
							ref_cmdec, 
							montant_ht, 
							montant_ttc, 
							code_devise, 
							delai_reglt_prev, 
							statut, 
							user_id, 
							date_heure_maj
					) values(
							?, 
							?, 
							?, 
							?,
							DATE_ADD(NOW(), 
							INTERVAL 15 DAY) , 
							'ouverte', 
							'bidon', 
							NOW()
					)";
				$pdo_factu_client = $bdd -> prepare($req_factu_client);
				$pdo_factu_client->execute(array(
						$ref_cmdec,
						$_POST['montant_total'],
						$_POST['montant_total'],
						$_POST['devise'],
				));
				errors_pdo($pdo_factu_client);
				$pdo_factu_client->closeCursor();
				
				// on renvoie la ref de la vente qui sera utilisé dans le cas de la vente immédiate (saisie de l'IMEI)
				retour_ajax($ref_cmdec);
		}
		// pour mettre à jour la vente et insérer l'IMEI dans la table IMEI vente après saisie du formulaire IMEI et dans le cas d'une vente immédiate
		if(!$insertion_vente && $update_vente_immediate)
		{
				
				for($indice_imei=1;$indice_imei<=$qte_totale;$indice_imei++)
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

?>
