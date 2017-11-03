<?php
//Vérification du pseudo
if(!empty($_POST['pseudo_check'])){
    $pseudo = $_POST['pseudo_check'];
    $pseudo = preg_replace('#[^a-z0-9]#i', '', $pseudo); // filter everything but letters and numbers
    if(strlen($pseudo) < 3 || strlen($pseudo) > 16){
        echo '<br/>3 à 16 caractètres SVP.';
        exit();
    }
    
    if(is_numeric($pseudo[0])){
        echo '<br/>Le pseudo doit commencer par une lettre.';
        exit();
    }
    
    //Connexion à la base de données
    require "includes/connect_db.php";
    
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
    
    //Vérifier l'adresse mail
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo '<br/>Adresse email invalide !';
        exit();
    }
    //Connexion à la base de données
    require "includes/connect_db.php";
    
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

//Traitement de l'inscription
if(isset($_POST['pseudo'])){
    require "includes/connect_db.php";
    extract($_POST);
    $pseudo = preg_replace('#[^a-z0-9]#i', '', $pseudo); // filter everything but letters and numbers
    $q = $db->prepare('SELECT id FROM users WHERE pseudo = ?');
    $q->execute(array($pseudo));
    $pseudo_check = $q->rowCount();
    
    $q = $db->prepare('SELECT id FROM users WHERE email = ?');
    $q->execute(array($email));
    $email_check = $q->rowCount();
    
    if(empty($pseudo)|| empty($pass1) || empty($pass2) || empty($email) ){
        echo "Tous les champs n'ont pas été remplis.";
    } else if($pseudo_check > 0) {
        echo "Pseudo déjà utilisé";
    } else if($email_check > 0) {
        echo "Cette adresse mail est déjà utilisée";
    } else if(strlen($pseudo) < 3 || strlen($pseudo) > 16) {
        echo "Pseudo éronné !";
    }  else if(is_numeric($pseudo[0])) {
        echo "Le pseudo doit commencer par une lettre.";
    }  else if($pass1 != $pass2) {
        echo "Les mots de passe ne correspondent pas.";
    } else {
            $cle        = md5($email);
            $nomtable   = 'data_'.preg_replace('/[^a-zA-Z0-9]/', '', $email);
            $hash_pass = sha1($pass1);
            
            $q = $db->prepare('INSERT INTO users(pseudo, email, password, ip, created, cle, nomtable)
            				   VALUES(:pseudo, :email, :password, :ip, now(), :cle, :nomtable )');
            
            $q->execute(array(
                'pseudo'    => $pseudo,
                'email'     => $email,
                'password'  => $hash_pass,
                'ip'        => $_SERVER['REMOTE_ADDR'],
                'cle'       => $cle,
                'nomtable'  => $nomtable
            ));	
    
            $user_id = $db->lastInsertId();
            
            		if(!file_exists( "members/$user_id")){
            			mkdir("members/$user_id", 0755);
            		}
            
            $to = $email;
            $from = "diakit09@gmail.com";
            $subject = "M2M - Activation de votre compte";
            $message = "<!DOCTYPE html>
    					<html>
    						<head>
    							<meta charset=\"UTF-8\" />
    						</head>
    						<body>
    							Hi $pseudo,<br/><br/>
    							
    						   <h2>Complétez cette dernière étape pour activer votre compte</h2>
    						   <p>Pour ce faire, il suffit de cliquez sur le lien suivant:<br/>
    						   
    						   http://localhost/m2m/activation.php?id=$user_id&amp;u=$pseudo&amp;e=$email&amp;ssl=$hash_pass<br/>
    						   Si l'URL n'apparait pas comme un lien actif, veuillez copier/coller ce
    						   dernier dans la barre d'adresse de votre navigateur internet.</p>
    						   
    						   <h2>Indentifiants de connexion:</h2>
    						   <p>
    								Adresse e-mail  : $email<br/>
    								Mot de passe    : $pass1<br/>
                                    clé             : $cle  <br/>
    						   </p>
    						   <p>Rendez-vous sur le site <a href=\"http://localhost/m2m/activation\"></a></p>
    						</body>
    					</html>";
            
            $headers = "From: $from\n";
            $headers .= "MIME-Version: 1.0\n";
            $headers .= "Content-type: text/html; charset=utf-8\n";
            if(mail($to, $subject, $message, $headers)){
                echo 'register_success';
            }
            exit();
    }
    exit();
}
?>