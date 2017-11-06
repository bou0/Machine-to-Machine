<?php
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
                //Création de la table
                $create_table = "CREATE TABLE $nomtable(
                    id_object INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    objectIO VARCHAR(100),
                    data1 VARCHAR(100)
                 )";
                $db->exec($create_table);
                //Envoie de mail
                require_once "account_send_mail.php";
        }
        exit();
    }
?>