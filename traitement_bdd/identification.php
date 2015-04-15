<?php
  session_start();
  header ('Content-type:text/html; charset=utf-8');
 
	// fonction
  function pas_authentification(){
    $_SESSION['identification']=false;
    header('Location: ../access.php');
    exit;
  }

// script d'authenfication

if(!(isset($_POST['username']) and isset($_POST['password']))){
   pas_authentification();   
}else{
  include("connexion.php");
	$req = $bdd->prepare('SELECT mot_de_passe FROM utilisateur where identifiant = ?');
  $req -> execute(array($_POST['username']));
  if($row = $req->fetch()){
    do
    {
      if($row['mot_de_passe']==$_POST['password']){
        $_SESSION['identification']=true;  
        header('Location: ../acceuil.php');
        echo('salut');
        exit;
      }else{
        pas_authentification();
      }
    }while($row = $req->fetch());
    }else{    
      pas_authentification();
    }
  
}

?>
