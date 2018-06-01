<?php
// Reference de l'acces à la base de données
define("BDD_MDP","");
define("BDD_USER","root");
define("BDD_HOST", "localhost");
define("BDD_NAME", "m2m");
define("BDD_CHARSET", "utf8");

// Pour la creation de la nom de table comme
// exple durant@yahoo.fr donne durantyahoofr_data
function nomtable_user_data ($email){
    $nomtable_user_data     = preg_replace('/[^a-zA-Z0-9]/', '', $email).'_data';
    return $nomtable_user_data;
}

// Pour la creation de la nom de table comme 
// exple durant@yahoo.fr donne durantyahoofr_object
function nomtable_user_object ($email){
    $nomtable_user_object   = preg_replace('/[^a-zA-Z0-9]/', '', $email).'_object';
    return $nomtable_user_object;
}

?>