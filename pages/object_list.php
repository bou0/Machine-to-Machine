<?php
    session_start();
    
    if(!isset($_SESSION['user_session']))
    {
    	header("Location: ../index.php");
    }
    
    include_once 'connect_db.php';
    
    $stmt = $db->prepare("SELECT * FROM users WHERE id=:id");
    $stmt->execute(array(":id"=>$_SESSION['user_session']));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html >
    <html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $row['pseudo']; ?>&nbsp; | Liste des Objets </title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
    <link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
    <script type="text/javascript" src="../js/jquery-1.11.3-jquery.min.js"></script>

    <link href="../css/style.css" rel="stylesheet" media="screen">
    
    
    </head>
    
        <body>
        
            <nav class="navbar navbar-default navbar-fixed-top">
                  <div class="container">
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Liste des objets</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="">M2M</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                      <ul class="nav navbar-nav">
                        <li><a href=""></a></li>
                        <li><a href=""></a></li>
                        <li><a href=""></a></li>
                      </ul>
                      <ul class="nav navbar-nav navbar-right">
                        
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            			  <span class="glyphicon glyphicon-user"></span>&nbsp;Bonjour <?php echo $row['pseudo']; ?>&nbsp;<span class="caret"></span></a>
                          <ul class="dropdown-menu">
<!--                             <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a></li> -->
                            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Se déconnecter</a></li>
                          </ul>
                        </li>
                      </ul>
                    </div><!--/.nav-collapse -->
                  </div>
                </nav>
                
             <div><br/><br/><br/></div>   
            <div class="body-container">
            	<div class="container">
                	<div class="container">
                		<table id="users_info" class="table table-striped table-bordered">
                			<tr>
                				<th>id</th>
                				<th>nom</th>
                				<th>description</th>
                				<th>mesure</th>
                				<th>unite</th>
                			</tr>
                		</table>
                	</div>
                	<div>
            			<p align="center">
                            <a href="../create_object.php" class="btn btn-info btn-lg" alt="Ajouter un objet">
                              <span class="glyphicon glyphicon-plus">Objet</span> 
                            </a>
                      	</p>  
                		
                	</div>
            	</div>
            <br/><br></br>
            <?php include '../footer.php';?>
            <script src="../bootstrap/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="../js/jquery.min.js"></script>
            	<!-- Script for table Object usermail -->
            	<script>
            		$.ajax({
            			url : 'object_list_containt.php', 
            			type: 'POST',
            			cache: false,
            			datatype: {},
            			success: function( retour ){
            				// Parsing de la chaine (au format JSON) retournée par le php pour la transfromer en tableau de données
            				var data = JSON.parse( $.trim(retour) );
            				
            				// Parcours tout les données retournées par le PHP
            				data.forEach(function(user){
            
            					// Ajout des lignes dans le tableau d'affichage
            					$("table#users_info").append('<tr>\
                						<td>'+ user.id +'</td>\
                						<td>'+ user.nom +'</td>\
                						<td>'+ user.description +'</td>\
                						<td>'+ user.mesure +'</td>\
                						<td>'+ user.unite +'</td>\
                					</tr>');
            				});
            			},
            		});
            	</script>
          </div>  
        </body>
    </html>