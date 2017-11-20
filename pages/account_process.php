<?php
    include_once 'params.php';
    // Verification des infos : pseudo, mots de passe, email
    include_once 'account_email_verif.php';
    //Traitement de l'inscription
    if(isset($_POST['pseudo'])){
        require_once "connect_db.php";
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
            echo "Cet adresse mail est déjà utilisée";
        } else if(strlen($pseudo) < 3 || strlen($pseudo) > 16) {
            echo "Pseudo éronné !";
        }  else if(is_numeric($pseudo[0])) {
            echo "Le pseudo doit commencer par une lettre.";
        }  else if($pass1 != $pass2) {
            echo "Les mots de passe ne correspondent pas.";
        } else {
                $cle        = md5($email);
                $hash_pass = sha1($pass1);
                
                $q = $db->prepare('INSERT INTO users(pseudo, email, password, ip, created, cle)
                				   VALUES(:pseudo, :email, :password, :ip, now(), :cle)');
                $q->execute(array(
                    'pseudo'    => $pseudo,
                    'email'     => $email,
                    'password'  => $hash_pass,
                    'ip'        => $_SERVER['REMOTE_ADDR'],
                    'cle'       => $cle
                ));
                $user_id = $db->lastInsertId();
                
                //Creation de Table table_user_data & table_user_object
                require_once 'params_create_tables.php';
                
                //Envoie de mail
                require_once "params_send_mail.php";
        }
        exit();
    }
?>