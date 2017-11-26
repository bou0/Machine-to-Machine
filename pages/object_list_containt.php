
<?php
// Requete permettant de Lister les objects d'utilisateur courant 
    require_once 'connect_db.php';
    session_start();

    $usermail_object_courant = $_SESSION['super_user_email'];
    
    $req = $db->query("SELECT * FROM $usermail_object_courant");/*.nomtable_user_object($email)*/
    $result = array();
    
    while ($row = $req->fetch(PDO::FETCH_OBJ) ){
    	$result[] = array(
    	    'id'         =>  $row->id,
    	    'nom'        =>  $row->nom,
    	    'description'=>  $row->description,
    	    'mesure'     =>  $row->mesure,
    	    'unite'      =>  $row->unite
    	);
    }
    $req->closeCursor();
    echo json_encode($result);
?>