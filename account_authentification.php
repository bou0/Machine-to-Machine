<?php $title = "Bienvenue dans M2M Stockage de data d'objets connectés"; ?>
<?php require "includes/header.php"; ?>

<!-- 	:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
	
<!-- 									A U T H E N T I F I C A T I O N                                        -->
<!--                                           C O N N E X I O N                                               -->

<!-- 	:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->

    <section id="connexion">
		<h1>Connectez-vous</h1>
		<form id="login_form" method="post" onsubmit="return false;">
			<p>
				<label for="login">Pseudo:</label>
				<input type="text" placeholder="Entrez votre pseudo" id="login" name="login" required/>
				<label for="mdp">Mot de passe:</label>
				<input type="password" id="mdp" name="mdp" required/>
				<label for="cnx_persistent">
					<input type="checkbox" id="cnx_persistent" style="vertical-align: top;"/> Garder ma session active
				</label>
				<a href="#">Mot de passe oublié ?</a> <br/>
				<input type="button" class="btn btn-primary" value="Créer un compte"  onClick="window.location.href='account_create.php'"/>
    	
				<input type="submit" class="btn btn-success" value="Connexion" />
			</p>
			<div id="status2">
				Remplir tous les champs
			</div>
		</form>
	</section>
   
<!-- 	:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
	
<!-- 									      J A V A S C R I P T                                              -->
<!-- 							         C R E A T I O N   C O M P T E                                         -->

<!-- 	:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->

	
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
						} else {
							window.location = "profile.php";
						}
					}
				});
			}
		


	});

    
		        
    </script>
<?php require "includes/footer.php"; ?>