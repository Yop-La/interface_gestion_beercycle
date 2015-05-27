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
// Ce fichier sert à traiter l'enregistrement du formulaire saisie_client. Il y a trois cas possibles :
	// soit le formulaire est utilisé pour insérer et dans ce cas on le sait grâce à $_POST['fonction'] qui sera égale à 'insert_client'
	// soit le formulaire est utilisé pour mettre à jour les données clients nécessecaire à l'expédition d'un produit ( $_POST['fonction'] = 'maj_client_expe' 
	// soit le formulaire est utilisé pour mettre à jour les données clients dans le cas d'une vente immédiate ( $_POST['fonction'] = 'maj_client_immediat' 
		
// fonction pour insérer un client	
		function insert_client($cumul_qte_cmdee,$date_dern_cmde,$nb_cmde,$bd)
		{
				// réquête pour insérer le client
				$req_insert_client="insert into client(username, nom, prenom, email, tel1, tel2, adresse_liv, ville_liv, region_liv,pays_liv,adresse_fac,ville_fac,region_fac,pays_fac,commentaire,user_id,date_heure_maj, cumul_qte_cmdee, date_dern_cmde, nb_cmde) values(:username, :nom, :prenom, :email, :tel1, :tel2, :adresse_liv, :ville_liv, :region_liv, :pays_liv, :adresse_fac, :ville_fac, :region_fac, :pays_fac, :commentaire,'bidon',NOW(), :cumul_qte_cmdee, :date_dern_cmde, :nb_cmde)";

				$pdo_insert_client = $bd->prepare($req_insert_client);
				$pdo_insert_client->execute(array(
						'username'=>$_POST['pseudo'], 
						'nom'=>$_POST['nom'], 
						'prenom'=>$_POST['prenom'], 
						'email'=>$_POST['mail'], 
						'tel1'=>$_POST['tel1'], 
						'tel2'=>$_POST['tel2'], 
						'adresse_liv'=>$_POST['adresse_liv'], 
						'ville_liv'=>$_POST['ville_liv'], 
						'region_liv'=>$_POST['region_liv'], 
						'pays_liv'=>$_POST['pays_liv'], 
						'adresse_fac'=>$_POST['adresse_fac'], 
						'ville_fac'=>$_POST['ville_fac'], 
						'region_fac'=>$_POST['region_fac'], 
						'pays_fac'=>$_POST['pays_fac'], 
						'commentaire'=>$_POST['commentaire'],
						'cumul_qte_cmdee'=>$cumul_qte_cmdee,
						'date_dern_cmde'=>$date_dern_cmde,
						'nb_cmde'=>$nb_cmde

				));
				errors_pdo($pdo_insert_client);
				$pdo_insert_client->closeCursor();
		}
		
		
		// on vérifie que tous les posts sont bien présents et instanciées
		// contient les index des champs de la partie identité du formulaire
		$index_post_identite=['pseudo','prenom','nom'];
		// contient les indexs des champs de la partie contacts du formulaire
		$index_post_contacts=['mail','tel1','tel2'];
		// contient le début des indexs des champs des deux parties adresse
		$index_post_adresse=['adresse','ville','region','pays'];
		// contient la fin des indexs des champs des deux parties adresse
		$fin_post_adresse=['_fac','_liv'];


// vérification de la présence et de l'instanciation des post de la partie identité
		foreach ($index_post_identite as $index){
				if(!isset($_POST[$index]))
				{
						erreur('Erreur : tous les posts de la partie identité ne sont pas instanciées');
				}
				if($_POST[$index]=='')
				{
						$_POST[$index]=null;
				}
		}
// vérification de la présence et de l'instanciation des post de la partie contacts
		foreach ($index_post_contacts as $index)
		{
				if(!isset($_POST[$index]))
				{
						erreur('Erreur : tous les posts de la partie contact ne sont pas instanciées');
				}
				if($_POST[$index]=='')
				{
						$_POST[$index]=null;
				}
		}
// vérification de la présence et de l'instanciation des post des partie adresses
		foreach ($index_post_adresse as $index){
				foreach($fin_post_adresse as $fin_index)
				{
						if(!isset($_POST[$index.$fin_index]))
						{	
								erreur('Erreur : tous les posts des parties adresse ne sont pas instanciées');
						}
						if($_POST[$index.$fin_index]=='')
						{
								$_POST[$index.$fin_index]=null;
						}
				}
		}
// vérification de la présence et de l'instanciation du commentaire
		if(!isset($_POST['commentaire']))
		{
				erreur("Erreur : le commentaire n'est pas instancié");
		}
		if($_POST['commentaire']=='')
		{
				$_POST['commentaire']=null;
		}
		if(empty($_POST['fonction']))
		{
				erreur("Le post fonction n'est pas instancié ou vide !"); 
		}

// a ce stade :
		//on a vérifier que tous les posts sont bien instanciées 

// il reste à vérifier que ces variables ne soient pas vides et qu'elles aient le bon contenu

		//connexion à la bdd
		include("connexion.php");

// insertion du client dans la table clients
		if($_POST['fonction']=='insert_client')
		{
				insert_client(0,null,0,$bdd);
				retour_ajax('Enregistrement effectué');
		}elseif(in_array($_POST['fonction'],array('maj_client_expe','maj_client_immediate','retirer_boutique')))
		{
				// première étape : mise à jour des données clients ou insertion du client si que présnet dans la table prospect
				
				// on cherche d'abord à savoir si c'est un client ou un prospect
				$req_client = 'select * from client where username = ?';
				$pdo_client = $bdd->prepare($req_client);
				$pdo_client->execute(array($_POST['pseudo']));
				$pas_client = ($pdo_client->rowCount()==0);
				errors_pdo($pdo_client);
				$pdo_client->closeCursor();

				// on récupère les infos de la commande de ce client (la quantité surtout )
				$qte_cmde_client = retour_select('select  qte, max(date_cmde) from cmde_client where pseudo = ?',array($_POST['pseudo']),'qte',$bdd); 
				// si c'est un prospect on l'insère dans la table client et on le supprime de la table prospect
				if($pas_client)
				{
						insert_client($qte_cmde_client,'NOW()',1,$bdd);
						$req_supp_prospect = 'delete from prospect where username = ?';
						$pdo_supp_prospect=$bdd->prepare($req_supp_prospect);
						$pdo_supp_prospect->execute(array($_POST['pseudo']));
						errors_pdo($pdo_supp_prospect);
						$pdo_supp_prospect->closeCursor();
				}
				// si le client est déjà dans la table client, on met à jour ses données
				else
				{
						// n réucpère certaine infos de ce client afin de les mettre à jour
						$ret_infos_client = retour_fetch_select('select  cumul_qte_cmdee, nb_cmde from client where username = ?',array($_POST['pseudo']),$bdd);
						$cumul_qte_cmdee=$ret_infos_client['cumul_qte_cmdee']+$qte_cmde_client;
						$nb_cmde=$ret_infos_client['nb_cmde']+1;
						// requete pour mettre à jour les données clients
						$req_maj_client='update client set nom=:nom, prenom=:prenom, email=:email, tel1=:tel1, tel2=:tel2, adresse_liv=:adresse_liv, ville_liv=:ville_liv, region_liv=:region_liv,pays_liv=:pays_liv,adresse_fac=:adresse_fac,ville_fac=:ville_fac,region_fac=:region_fac,pays_fac=:pays_fac,commentaire=:commentaire,user_id="bidon",date_heure_maj=NOW(), cumul_qte_cmdee=:cumul_qte_cmdee,date_dern_cmde = NOW(), nb_cmde=:nb_cmde where username = :username';
						$pdo_maj_client=$bdd->prepare($req_maj_client);
						$pdo_maj_client->execute(array(
								'nom'=>$_POST['nom'], 
								'prenom'=>$_POST['prenom'], 
								'email'=>$_POST['mail'], 
								'tel1'=>$_POST['tel1'], 
								'tel2'=>$_POST['tel2'], 
								'adresse_liv'=>$_POST['adresse_liv'], 
								'ville_liv'=>$_POST['ville_liv'], 
								'region_liv'=>$_POST['region_liv'], 
								'pays_liv'=>$_POST['pays_liv'], 
								'adresse_fac'=>$_POST['adresse_fac'], 
								'ville_fac'=>$_POST['ville_fac'], 
								'region_fac'=>$_POST['region_fac'], 
								'pays_fac'=>$_POST['pays_fac'], 
								'commentaire'=>$_POST['commentaire'],
								'cumul_qte_cmdee'=>$cumul_qte_cmdee,
								'nb_cmde'=>$nb_cmde,
								'username'=>$_POST['pseudo']
						));
						errors_pdo($pdo_maj_client);
						$pdo_maj_client->closeCursor();
		
						if(in_array($_POST['fonction'],array('maj_client_expe','retirer_boutique')))
						{
								retour_ajax('Vente terminée !');
						}
						elseif($_POST['fonction']=='maj_client_immediate')
						{
								retour_ajax("Reste à saisir l'IMEI");
						}
								
				}

				
		}
		else
		{
				erreur('bug');
		}
		
}
else
{		
		erreur("Erreur : vous n'êtes pas authentifié");
}



?>
