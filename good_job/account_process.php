<?php
include_once'../includes/db.php';
 
  // filtre et recuperation de données (Email et Pseudo) 
  $email     = filter_input(INPUT_POST, 'email',   $filter = FILTER_SANITIZE_STRING);
  $pseudo    = filter_input(INPUT_POST, 'pseudo',  $filter = FILTER_SANITIZE_STRING);
    
  // Scriptage et création du nom de la table
  $l_STR_cle        = md5($email);
  $l_STR_nomtable   = 'data_'.preg_replace(REGULAR_EXPRESSION, '', $email);
  $l_STR_password  = password_hash($_POST['password'], PASSWORD_BCRYPT);
  
  $l_STR_Requete    = "INSERT INTO   users   (  email, pseudo, cle, nomtable, password  )     VALUES ( :email, :pseudo, :cle, :nomtable, :password) ;";
  
  try {
      $l_OBJ_Requete    = $bdd->prepare($l_STR_Requete);
      $l_OBJ_Requete->bindParam(':email', $email,    PDO::PARAM_STR);
      $l_OBJ_Requete->bindParam(':pseudo', $pseudo,    PDO::PARAM_STR);
      $l_OBJ_Requete->bindParam(':cle', $l_STR_cle,    PDO::PARAM_STR);
      $l_OBJ_Requete->bindParam(':nomtable', $l_STR_nomtable,    PDO::PARAM_STR);
      $l_OBJ_Requete->bindParam(':password', $l_STR_password,    PDO::PARAM_STR);
      
      $l_OBJ_Requete->execute();    // Execution de la requete
       
  } catch (Exception $e) {
      $_SESSION['Erreur'][]    = $e->getMessage();
  }   
?>


