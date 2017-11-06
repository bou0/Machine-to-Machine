<?php

    //Vérification du pseudo
    if(!empty($_POST['pseudo_check'])){
        $pseudo = $_POST['pseudo_check'];
        $pseudo = preg_replace('#[^a-z0-9]#i', '', $pseudo); // filter everything but letters and numbers
        if(strlen($pseudo) < 3 || strlen($pseudo) > 16){
            echo '<br/>3 � 16 caractètres SVP.';
            exit();
        }
        
        if(is_numeric($pseudo[0])){
            echo '<br/>Le pseudo doit commencer par une lettre.';
            exit();
        }
        
        //Connexion à la base de données
        require "connect_db.php";
        
        $q = $db->prepare('SELECT id FROM users WHERE pseudo = ?');
        $q->execute(array($pseudo));
        
        $numRows = $q->rowCount();
        if($numRows > 0){
            echo '<br/>Pseudo déjà utilisé !';
            exit();
        } else {
            echo 'success';
            exit();
        }
    }
    
    //Vérification des mots de passe
    if(!empty($_POST['pass1_check']) && !empty($_POST['pass2_check'])){
        if(strlen($_POST['pass1_check']) < 6 || strlen($_POST['pass1_check'])  < 6){
            echo '<br/>Trop court (6 caractères minimum)';
            exit();
        } else if($_POST['pass1_check'] == $_POST['pass2_check']){
            echo 'success';
            exit();
        } else {
            echo '<br/>Les deux mots de passe sont différents';
            exit();
        }
        
    }
    
    //Vérification de l'email
    if(!empty($_POST['email_check'])){
        $email = $_POST['email_check'];
        
        //V�rifier l'adresse mail
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo '<br/>Adresse email invalide !';
            exit();
        }
        //Connexion à la base de données
        require "connect_db.php";
        
        $q = $db->prepare('SELECT id FROM users WHERE email = ?');
        $q->execute(array($email));
        
        $numRows = $q->rowCount();
        if($numRows > 0){
            echo '<br/>Adresse email déjà utilisée !';
            exit();
        } else {
            echo 'success';
            exit();
        }
    }


?>