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
				
// ce fichier est appelé en ajax par le formulaire de saisie des ventes. Il sert uniquement à remplir le formulaire. Il sert dans trois cas 
		// 1 er cas : pour sélectionner par défaut le canal de distribution du vendeur sélectionnée
		// 2 ème cas : pour afficher le sotck par défaut du vendeur, charger les prix (usd et dans la devise)

		// 3ème cas : pour afficher les quantités dispo dans les stocks

		// il reste à faire le contrôle des données reçues et à mettre en place des messages d'erreurs 

				// pour afficher la ref_canal_distrib du vendeur dans le formulaire de saisie des ventes
				if(isset($_POST['id_vendeur']))
				{
						$ref_canal_distrib_defaut = retour_select('select ref_canal_distrib from utilisateur where identifiant = ?',array($_POST['id_vendeur']),'ref_canal_distrib',$bdd);
						retour_ajax($ref_canal_distrib_defaut);
				}
				// pour afficher le stock par défaut du vendeur
				// et pour charger le prix usd et dans la devise du produit presque vendui
				if(isset($_POST['marque']) and isset($_POST['modele']) and isset($_POST['etat']) and isset($_POST['ref_canal_distrib']) and isset($_POST['devise']) and isset($_POST['id_vendeur_canal']))
				{
						//récupération de la ref_produit sur le point d'etre vendu
						$id_produit=get_id_produit($_POST['marque'],$_POST['modele'],$_POST['etat'],$bdd);
						
						// on récupère le prix usd du produit
						$req_prix_usd="select prix from catalogue_produit where code_devise='USD' and ref_canal_distrib= ? and ref_produit = ? and date_validite>=NOW()"; 
						$pdo_prix_usd=$bdd->prepare($req_prix_usd);
						$pdo_prix_usd->execute(array(
								$_POST['ref_canal_distrib'],
								$id_produit
						));
						$rep_prix_usd=$pdo_prix_usd->fetch();
						$prix_usd=$rep_prix_usd['prix'];
						errors_pdo($pdo_prix_usd);
						$pdo_prix_usd->closeCursor();
						
						// ce tableau contient dans sa première case le prix usd, dans sa deuxième le stock par défaut du vendeur, dans sa troisième un booléan pour savoir si le prix dans la devise est dans le catalogue et dans sa quatrième le prix dans la devise
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
								array_push($tab_retour,"");
						}

						// on récupère le stock du vendeur pour le proposer en 1er choix
						$req_stock='select ls.ref_lieu_stockage as stock from utilisateur as ut, canal_de_distribution as cdd, lieu_stockage as ls where identifiant = ? and ut.ref_canal_distrib=cdd.ref_canal_distrib and ls.ref_lieu_stockage=cdd.ref_lieu_stockage_defaut';
						$pdo_stock=$bdd->prepare($req_stock);
						$pdo_stock->execute(array($_POST['id_vendeur_canal']));
						$rep_stock=$pdo_stock->fetch();
						$stock_defaut=$rep_stock['stock'];
						errors_pdo($pdo_stock);
						$pdo_stock->closeCursor();

						array_push($tab_retour,$stock_defaut);

						// on récupère le prix dans la devise
								// si il existe pas dans le catalogue, on fait la consertion à partir du courset du prix en dollard
								// si on ne trouve pas le cours ou le prix en dollard, on retourne un message d'erreur
								
						// on récupère le prix dans la devise sélectionné du produit
						$req_prix_devise="select prix from catalogue_produit where code_devise=? and ref_canal_distrib= ? and ref_produit = ? and date_validite>=NOW()"; 
						$pdo_prix_devise=$bdd->prepare($req_prix_devise);
						$pdo_prix_devise->execute(array(
								$_POST['devise'],
								$_POST['ref_canal_distrib'],
								$id_produit
						));
						$rep_prix_devise=$pdo_prix_devise->fetch();
						$prix_devise=$rep_prix_devise['prix'];
						errors_pdo($pdo_prix_devise);
						
						// si le prix est dans le catalogue, on l'envoie
						if($pdo_prix_devise->rowCount()!=0)
						{
								array_push($tab_retour,true);
								array_push($tab_retour,$prix_devise);
								retour_ajax($tab_retour);

						}// sinon on propose une convertion
						else
						{
								array_push($tab_retour,false);
								// on récupère le cours de la devise correspondante
								$req_cours="select cours from parite_devise where code_devise= ?"; 
								$pdo_cours=$bdd->prepare($req_cours);
								$pdo_cours->execute(array($_POST['devise']));
								$rep_cours=$pdo_cours->fetch();
								$cours=$rep_cours['cours'];
								errors_pdo($pdo_cours);
								$pdo_cours->closeCursor();
								if($cours!=null)
								{
										if(!verif_entier($tab_retour[0]))
												array_push($tab_retour,'Inexistant dans catalogue');
										else
												array_push($tab_retour,$tab_retour[0]*$cours);
										retour_ajax($tab_retour);
								}
								else
								{
										array_push($tab_retour,'cours introuvable !');
										retour_ajax($tab_retour);
								}
						}
						$pdo_prix_devise->closeCursor();

				}
					// pour afficher les quantités disponibles dans les stocks
				if(isset($_POST['marque']) and isset($_POST['modele']) and isset($_POST['etat']) and isset($_POST['lieu_stockage']) )
				{
						// on récupère l'id du produit sur le point d'être vendu
						$id_produit=get_id_produit($_POST['marque'],$_POST['modele'],$_POST['etat'],$bdd);

						// on récupère la qte dispo pour ce produit et cette ref_lieu_stockage
						$req_qte_dispo='select qte from position_zfw_reelle where ref_lieu_stockage = ? and ref_produit = ? order by date_archivage desc limit 1';		
						$pdo_qte_dispo = $bdd->prepare($req_qte_dispo);
						$pdo_qte_dispo->execute(array(
								$_POST['lieu_stockage'],
								$id_produit
						));
						errors_pdo($pdo_qte_dispo);
						$ret_qte_dispo=$pdo_qte_dispo->fetch();
						$qte=$ret_qte_dispo['qte'];	
						if($qte==null)
								$qte=0;
						retour_ajax($qte);
				}
		}
		else
		{
				erreur(" Erreur : vous n'êtes pas authentifié");
		}
?>
