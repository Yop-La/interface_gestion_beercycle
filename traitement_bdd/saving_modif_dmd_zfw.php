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

		// récupération de la ref_canal_distribution associée à la modification de demande
		$req = $bdd->prepare('SELECT ref_canal_distrib FROM canal_de_distribution WHERE libelle = ?');
		$req->execute(array($_POST['modif_canal_distri']));
		$ref_canal_distrib=$req->fetch()['ref_canal_distrib'];
		$req->closeCursor();

		// récupération de la ref_produit associée à la modification de demande
		$req = $bdd->prepare('SELECT ref_produit FROM produit WHERE modele = ? and commentaire = ?');
		$req->execute(array($_POST['modif_modele'],$_POST['modif_etat']));
		$ref_produit=$req->fetch()['ref_produit'];
		$req->closeCursor();

		// on met à jour la demande
		$req = $bdd->prepare('UPDATE demande_zfw SET ref_canal_distrib = :nv_canal, ref_produit = :nv_ref_prdt, qte_ddee = :nv_qqte_ddee, date_dern_maj = NOW(), user_id="bidon" WHERE ref_dde_zfw = :ref_dde_zfw');
		$req->execute(array(
			'nv_canal' => $ref_canal_distrib,
			'nv_ref_prdt' => $ref_produit,
			'nv_qqte_ddee' => $_POST['modif_quantite'],
			'ref_dde_zfw' => $_POST['ref_demande']
			));
		$req->closeCursor();
	
}
else
{
		echo header('Location: ../access.php');
}
?>
