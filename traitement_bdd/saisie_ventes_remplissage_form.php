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
				include("connexion.php");

				// pour afficher la ref_canal_distrib du vendeur dans le formulaire de saisie des ventes
				if(isset($_POST['id_vendeur']))
				{
						$req_canal_distrib='select libelle from utilisateur as ut, canal_de_distribution as cdd where identifiant = ? and ut.ref_canal_distrib=cdd.ref_canal_distrib';
						$pdo_canal_distrib=$bdd->prepare($req_canal_distrib);
						$pdo_canal_distrib->execute(array($_POST['id_vendeur']));
						$rep_canal_distrib=$pdo_canal_distrib->fetch();
						// pour afficher les erreurs de base  lors d'une exécution d'une requete
						errors_pdo($pdo_canal_distrib);
						retour_ajax($rep_canal_distrib['libelle']);
						$pdo_canal_distrib->closeCursor();
				}
				// pour afficher les stocks qui contiennent ou non le produit vendu
						// le stock avec l'écriture en bleu sera celui par défaut
						// les stock avec un fond rouge sont ceux qui n'ont pas le produit
						// les stock avec un fond vert sont ceux ont le produit
								// stock en bleu et vert afficher en priorité
								// puis stock en vert
								// puis stock en rouge
				// et pour charger le prix usd du produit presque vendu
				if(isset($_POST['marque']) and isset($_POST['modele']) and isset($_POST['etat']) and isset($_POST['id_vendeur_canal']))
				{
						//récupération de la ref_produit sur le point d'etre vendu
						$id_produit=get_id_produit($_POST['marque'],$_POST['modele'],$_POST['etat'],$bdd);
						
						// on récupère la ref_canal_distrib du vendeur pour trouver le prix du produit pour ce canal
						$req_canal_distrib='select ref_canal_distrib from utilisateur where identifiant = ?';
						$pdo_canal_distrib=$bdd->prepare($req_canal_distrib);
						$pdo_canal_distrib->execute(array($_POST['id_vendeur_canal']));
						$rep_canal_distrib=$pdo_canal_distrib->fetch();
						$ref_canal_distrib=$rep_canal_distrib['ref_canal_distrib'];
						errors_pdo($pdo_canal_distrib);
						$pdo_canal_distrib->closeCursor();
						
						// on récupère le prix usd du produit puis on récupére les stocks dans lesquels il se trouve
						$req_prix_usd="select prix from catalogue_produit where code_devise='USD' and ref_canal_distrib= ? and ref_produit = ? and date_validite>=NOW()"; 
						$pdo_prix_usd=$bdd->prepare($req_prix_usd);
						$pdo_prix_usd->execute(array($ref_canal_distrib,$id_produit));
						$rep_prix_usd=$pdo_prix_usd->fetch();
						$prix_usd=$rep_prix_usd['prix'];
						errors_pdo($pdo_prix_usd);
						$pdo_prix_usd->closeCursor();
						
						// ce tableau contient dans sa première case le prix usd et dans sa deuxième une liste déroulante de tous les stocks contenant le produit ou non
						$tab_retour=array();
						if($prix_usd==null && $id_produit != null) // si le prix usd n'est pas dans le catalogue
						{
								array_push($tab_retour,"Inexistant dans catalogue");
						}
						else
						{
								array_push($tab_retour,$prix_usd);
						}
						if($_POST['etat']=='')
						{
								$retour='<option value="" selected></option>';
								array_push($tab_retour,$retour);
								retour_ajax($tab_retour);	
						}

						// on récupère le stock du vendeur pour le proposer en 1er choix
						$req_stock='select ls.libelle as stock from utilisateur as ut, canal_de_distribution as cdd, lieu_stockage as ls where identifiant = ? and ut.ref_canal_distrib=cdd.ref_canal_distrib and ls.ref_lieu_stockage=cdd.ref_lieu_stockage_defaut';
						$pdo_stock=$bdd->prepare($req_stock);
						$pdo_stock->execute(array($_POST['id_vendeur_canal']));
						$rep_stock=$pdo_stock->fetch();
						$stock_defaut=$rep_stock['stock'];
						errors_pdo($pdo_stock);
						$pdo_stock->closeCursor();
			
						$retour=''; // cette variable contient la liste déroulante des lieux de stockage
						
						$retour='<option selected class="Bold" "value="' . $stock_defaut . '">' .  $stock_defaut . '</option>';

						// on récupère tous les autres stocks
						$req_stocks='select libelle from lieu_stockage where libelle != ?';
						$pdo_stocks = $bdd->prepare($req_stocks);
						$pdo_stocks -> execute(array($stock_defaut));
						while($ret_stocks=$pdo_stocks->fetch())
						{
								$retour.='<option "value="' . $ret_stocks['libelle'] . '">' . $ret_stocks['libelle'] . '</option>';
						}
						errors_pdo($pdo_stocks);
						$pdo_stocks->closeCursor();
						
						array_push($tab_retour,$retour);
						array_push($tab_retour,$retour);
						retour_ajax($tab_retour);	
				}
					// pour afficher les quantités disponibles dans les stocks
				if(isset($_POST['marque']) and isset($_POST['modele']) and isset($_POST['etat']) and isset($_POST['lieu_stockage']) )
				{
						// on récupère l'id du produit sur le point d'être vendu
						$id_produit=get_id_produit($_POST['marque'],$_POST['modele'],$_POST['etat'],$bdd);

						// on récupère la ref lieu de stockage
						$req_ref_lieu_stockage='select ref_lieu_stockage from lieu_stockage where libelle = ?';
						$pdo_ref_lieu_stockage = $bdd->prepare($req_ref_lieu_stockage);
						$pdo_ref_lieu_stockage->execute(array($_POST['lieu_stockage']));
						errors_pdo($pdo_ref_lieu_stockage);
						$ret_ref_lieu_stockage=$pdo_ref_lieu_stockage->fetch();
						$ref_lieu_stockage=$ret_ref_lieu_stockage['ref_lieu_stockage'];
					
						// on récupère la qte dispo pour ce produit et cette ref_lieu_stockage
						$req_qte_dispo='select qte, date_archivage as max_date from position_zfw_reelle where ref_lieu_stockage = ? and ref_produit = ? order by date_archivage desc limit 1';		
						$pdo_qte_dispo = $bdd->prepare($req_qte_dispo);
						$pdo_qte_dispo->execute(array($ref_lieu_stockage,$id_produit));
						errors_pdo($pdo_qte_dispo);
						$ret_qte_dispo=$pdo_qte_dispo->fetch();
						$qte=$ret_qte_dispo['qte'];	
						if($qte==null)
								$qte=0;
						retour_ajax($qte);
				}

				// pour charger dans le formulaire le prix dans la devise sélectionnée
				if(isset($_POST['marque']) and isset($_POST['modele']) and isset($_POST['etat']) and isset($_POST['id_vendeur3']) and isset($_POST['devise']) and isset($_POST['prix_usd']))
				{
						
						//récupération de la ref_produit sur le point d'etre vendu
						$id_produit=get_id_produit($_POST['marque'],$_POST['modele'],$_POST['etat'],$bdd);
						
						// on récupère la ref_canal_distrib du vendeur pour trouver le prix du produit dans la devise sélectionnée pour ce canal
						$req_canal_distrib='select ref_canal_distrib from utilisateur where identifiant = ?';
						$pdo_canal_distrib=$bdd->prepare($req_canal_distrib);
						$pdo_canal_distrib->execute(array($_POST['id_vendeur3']));
						$rep_canal_distrib=$pdo_canal_distrib->fetch();
						$ref_canal_distrib=$rep_canal_distrib['ref_canal_distrib'];
						errors_pdo($pdo_canal_distrib);
						$pdo_canal_distrib->closeCursor();

						// on récupère le code_devise du vendeur pour trouver le prix du produit dans la devise sélectionnée
						$req_code_devise='select code_devise from devise where libelle = ?';
						$pdo_code_devise=$bdd->prepare($req_code_devise);
						$pdo_code_devise->execute(array($_POST['devise']));
						$rep_code_devise=$pdo_code_devise->fetch();
						$code_devise=$rep_code_devise['code_devise'];
						errors_pdo($pdo_code_devise);
						$pdo_code_devise->closeCursor();


						// on récupère le prix dans la devise sélectionné du produit puis on récupére les stocks dans lesquels il se trouve
						$req_prix_devise="select prix from catalogue_produit where code_devise=? and ref_canal_distrib= ? and ref_produit = ? and date_validite>=NOW()"; 
						$pdo_prix_devise=$bdd->prepare($req_prix_devise);
						$pdo_prix_devise->execute(array($code_devise,$ref_canal_distrib,$id_produit));
						$rep_prix_devise=$pdo_prix_devise->fetch();
						$prix_devise=$rep_prix_devise['prix'];
						errors_pdo($pdo_prix_devise);

						// si on ne trouve aucun enregistrement dans catalogue_produit pour cette devise alors on fait directement la conversion dans le else	
						// ce tableau $retour contient :
								//dans sa première case un boolean pour savoir si le prix pour cette devise est dans le catalogue
								// dans sa seconde case : le prix dans la devise qui est soit celui du catalogue, soit celui calculé à partir du cours
						$retour=array();
						if($pdo_prix_devise->rowCount()!=0)
						{
								array_push($retour,true);
								array_push($retour,$prix_devise);
								retour_ajax($retour);

						}
						else if($code_devise!='USD')
						{
								// on récupère le cours de la devise correspondante
								$req_cours="select cours from parite_devise where code_devise= ?"; 
								$pdo_cours=$bdd->prepare($req_cours);
								$pdo_cours->execute(array($code_devise));
								$rep_cours=$pdo_cours->fetch();
								$cours=$rep_cours['cours'];
								errors_pdo($pdo_cours);
								$pdo_cours->closeCursor();
								if($cours!=null)
								{
										array_push($retour,false);
										if($_POST['prix_usd']==0)
												array_push($retour,'Inexistant dans catalogue');
										else
												array_push($retour,$_POST['prix_usd']*$cours);
										retour_ajax($retour);
								}
								else
										array_push($retour,false);
										array_push($retour,'cours introuvable !');
										retour_ajax($retour);
						}
						else
						{
								array_push($retour,false);
								array_push($retour,'Inexistant dans catalogue');
								retour_ajax($retour);
						}
						$pdo_prix_devise->closeCursor();
				}
		}
		else
		{
				erreur(" Erreur : vous n'êtes pas authentifié");
		}
?>
