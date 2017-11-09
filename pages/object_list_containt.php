
<?php
    require 'connect_db.php';
    require 'param_tables.php';
    
    $req = $db->query("SELECT * FROM $nomtable_user_object");
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