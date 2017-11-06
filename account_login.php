<?php

/**
 * Nous créons deux variables : $username et $password qui valent respectivement "Sdz" et "salut"
 */

$username =  "Sdz";
$password =  "salut";

if( isset($_POST['pseudo']) && isset($_POST['pass']) ){
    
    if($_POST['pseudo'] == $username && $_POST['pass'] == $password){ // Si les infos correspondent...
        session_start();
        $_SESSION['user'] = $username;
        echo "Success";
    }
    else{ // Sinon
        echo "Failed";
    }
    
    
    
}

?>
