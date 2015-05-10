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
		// lecture du contenu à insérer après
		// on récupère la ref_canal_distrib
		$req = $bdd->prepare('SELECT DISTINCT ref_canal_distrib FROM canal_de_distribution where libelle = ?');
		$req->execute(array($_POST['canal_distri']));
		$data = $req->fetch();
		$canal_distri=$data['ref_canal_distrib'];
		$req->closeCursor();

		// on récupère la ref_produit
		$req = $bdd->prepare('SELECT DISTINCT ref_produit FROM produit where modele = ? and commentaire = ?');
		$req->execute(array(
			$_POST['modele'],
			$_POST['etat']));
		$data = $req->fetch();
		$ref_produit=$data['ref_produit'];
		$req->closeCursor();

		// on écrit la demande de produit dans la table demande_zfw
		$req=$bdd->prepare('INSERT INTO demande_zfw (ref_canal_distrib, ref_produit, qte_ddee, qte_cmdee, user_id, date_dern_maj, date_demande) VALUES (:ref_canal_distrib, :ref_produit, :qte_dde, 0, \'bidon\', NOW(), NOW())') or die(print_r($bdd->errorInfo()));
		$req->execute(array(
			'ref_canal_distrib' => $canal_distri, 
			'ref_produit' => $ref_produit,
			'qte_dde' => $_POST['quantite']
			));
		$ref_dmd_zfw=$bdd->lastInsertId();
		$req->closeCursor();
		
		// création d'un prépayement associé à cette demande

		$req_new_prepayement = 'insert into paiement_dde_zfw (ref_dde_zfw ,montant_regle, user_id, date_heure_maj) values(:ref_dmd_zfw,0,"bidon",NOW())';

		$pdo_new_prepayement = $bdd->prepare($req_new_prepayement);
		$pdo_new_prepayement->execute(array('ref_dmd_zfw' => $ref_dmd_zfw));
		$pdo_new_prepayement->closeCursor();

}
else
{
		echo header('Location: ../access.php');
}
?>
