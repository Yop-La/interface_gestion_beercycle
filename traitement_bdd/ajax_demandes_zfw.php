<?php
	session_start();	
  header ('Content-type:text/html; charset=utf-8');
	if(!isset($_SESSION['identification']))
	{
			$_SESSION['identification']=false;
	}
	if($_SESSION['identification'])
	{
			if(isset($_POST['type']) && ( isset($_POST['marque']) || isset($_POST['modele'])))
			{
					// connexion à la bdd
					include("connexion.php");
					// maj du champ modele
					if($_POST['type']=='marque')
					{
							$data = $bdd->prepare('SELECT distinct modele FROM produit where marque = ? order by modele');
							$data->execute(array($_POST['marque']));
							echo '<label for="modele"> Modèle </label>';
							echo '<select id="modele" name="modele" class="form-control">';
							echo '<option value="" selected></option>';

							while ($valeur = $data->fetch())
							{
									echo '<option value="' . $valeur['modele'] . '">' .  $valeur['modele'] . '</option>';
							}
							echo '</select>';
					}
					// maj du champ etat
					if($_POST['type']=='modele')
					{
							$data = $bdd->prepare('SELECT distinct commentaire FROM produit where modele = ? order by etat');
							$data->execute(array($_POST['modele']));
							echo '<label for="etat"> Etat </label> <select id="etat" name="etat" class="form-control">';
							echo '<option value="" selected></option>';

							while ($valeur = $data->fetch())
							{
									echo '<option value="' . $valeur['commentaire'] . '">' .  $valeur['commentaire'] . '</option>';
							}
							echo '</select>';
					}
			}
	}
	else
	{
			echo header('Location: access.php');		
	}
?>
