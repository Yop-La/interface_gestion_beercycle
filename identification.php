<?php
  session_start();
  header ('Content-type:text/html; charset=utf-8');
 
	// fonction
  function pas_authentification($entre){
    $_SESSION['identification']=false;
    header('Location: access.php');
    exit;
  }

// script d'authenfication

if(!(isset($_POST['username']) and isset($_POST['password']))){
   pas_authentification();   
}else{
  try
  {
      $bdd = new PDO('mysql:host=localhost;dbname=alexandraa_beere;charset=utf8','root','');
      //$bdd = new PDO('mysql:host=mysql51-153.perso;dbname=alexandraa_beere;charset=utf8', 'alexandraa_beere', 'Bgrnht12a');
  }
  catch(Exception $e)
  {
					pas_authentification();
          die('Erreur : '.$e->getMessage());
  }
  $req = $bdd->prepare('SELECT vi_password FROM bee_visitor_infos where vi_username = ?');
  $req -> execute(array($_POST['username']));
  if($row = $req->fetch()){
    do
    {
      if($row['vi_password']==$_POST['password']){
        $_SESSION['identification']=true;  
        header('Location: acceuil.php');
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
