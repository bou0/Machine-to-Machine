<?php 
//Connection to the database
include_once'params.php';
try
{
    $db = new PDO('mysql:host='.BDD_HOST.';dbname='.BDD_NAME.';charset='.BDD_CHARSET,BDD_USER,BDD_MDP);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

?>
