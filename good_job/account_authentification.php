<?php $title = "Bienvenue dans M2M Stockage de data d'objets connectés"; ?>
<?php require "header.php"; ?>

<!-- 	:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
	
<!-- 									A U T H E N T I F I C A T I O N                                        -->
<!--                                           C O N N E X I O N                                               -->

<!-- 	:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->

    <section id="connexion">
		<h1>Cliquez sur ce bouton pour vous connecter <a href="index.html">ce Lien pour se connecter</a></h1>
		<input type="button" class="btn btn-primary" value="Se connecter"  onClick="window.location.href='index.php'"/>
		
	</section>
   

	
	<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script>
    

<!-- 	:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->

<!-- 									J A V A S C R I P T                                                    -->
<!-- 	        	 			  A U T H E N T I F I C A T I O N                                              -->

<!-- 	:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
	    $("#login_form").submit(function(){
			var pseudo = $("#login").val();
			var pass   = $("#mdp").val();
			var status = $("#status2");	
			
			if(pseudo == "" || pass == ""){
				status.html("Veuillez remplir tous les champs.").fadeIn(400);	
			} else {
				$.ajax({
					type: 'post',
					url: "login.php",
					data: {
						'pseudo' : pseudo,
						'pass' : pass
					},
					beforeSend: function(){
						status.html("Connexion en cours...").fadeIn(400);
					},
					success: function(data){
						if(data == "login_failed"){
							status.html("Pseudo ou mot de passe invalide !").fadeIn(400);
						} 
						else {
							window.location = "pages/object_list.php";
						}
					}
				});
			}
		


	});

    
		        
    </script>
<?php require "footer.php"; ?>