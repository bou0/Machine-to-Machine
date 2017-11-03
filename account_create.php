<?php $title = "Bienvenue dans M2M Stockage de data d'objets connect�s"; ?>
<?php require "includes/header.php"; ?>

<!-- 	:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
	
<!-- 									 C R E A T I O N   C O M P T E                                         -->

<!-- 	:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
	   <section id="inscription">
    
    	<form action="" method= "post" id="register_form" onsubmit="return false;" >

    
        	<h2 class="form-signin-heading">Cr��er un compte</h2>
        	<div class = "form-group"> 
        		<label for="pseudo">Pseudo:</label>
    			<input type="text" placeholder="Entrez votre pseudo" id="pseudo" name="pseudo" maxlength="16" required 
    					onblur="verifPseudo(this)" class="form-control"/>
    			<small id="output_checkuser"></small>
    		</div>
        		
        	<div class = "form-group"> 
        		<label for="pass1">Mot de passe:</label>
    			<input type="password" placeholder="Entrez votre mot de passe " id="pass1" name="pass1" required class="form-control"/>
    			<small id="output_pass1"></small>
    			
    			<label for="pass2">Confirmer votre mot de passe:</label>
				<input type="password" placeholder="Confirmez votre mot de passe" id="pass2" name="pass2" required class="form-control"/> 
				<small id="output_pass2"></small>	
        	</div>
        	
        	<div class = "form-group"> 
        		<label for="email">Adresse electronique:</label>
    			<input type="email" placeholder="johndoe@exemple.com" id="email" name="email" required
    				class="form-control" onblur="verifMail(this)"/>
    			<small id="output_email"></small>
        	</div>
        	
        	<input class="btn btn-danger" type="reset" value="Cancel" onclick="myreset()" >
        	
        	<div id="status">
    			Remplir tous les champs
    		</div>
    		<input type="submit" id="bRegister" class="btn btn-success" value="Valid" /><br/><br/>
    		<input type="button" class="btn btn-primary" value="Cr�er un compte"  onClick="window.location.href='account_authentification.php'"/>
    	</form>
    </section>

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
				<a href="#">Mot de passe oubli� ?</a> <br/>
				<input type="submit" class="btn btn-primary" value="Connexion" />
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
    $(document).ready(function(){
    	$("#connexion").hide();
		$("#register_form input").focus(function(){
        	$("#status").fadeOut(800);
        });

        $("#pseudo").keyup(function(){
        	//On v�rifie si le pseudo est ok ou n'a pas ete d�j� pris
        		check_pseudo();
        });

        $("#pass1").keyup(function(){
        	//On v�rifie si le mot de passe est ok
        		if($(this).val().length < 6){
        			$("#output_pass1").css("color", "red").html("<br/>Trop court (6 caract�res minimum)");
        		} else if($("#pass2").val() != "" && $("#pass2").val() != $("#pass1").val()){
        			$("#output_pass1").html("<br/>Les deux mots de passe sont diff�rents");
        			$("#output_pass2").html("<br/>Les deux mots de passe sont diff�rents");
        		} else {
        			$("#output_pass1").html('<img src="img/check.png" class="small_image" alt="" />');
        		}
        });

        $("#pass2").keyup(function(){
        	//On v�rifie si les mots de passe co�ncident
        		check_password();
        });

        $("#email").keyup(function(){
        	//On v�rifie si les mots de passe co�ncident
        		check_email();
        });

        function check_pseudo(){
        		$.ajax({
        			type: "post",
        			url:  "register.php",
        			data: {
        				'pseudo_check' : $("#pseudo").val()
        			},
        			success: function(data){
        						if(data == "success"){
        							$("#output_checkuser").html('<img src="img/check.png" class="small_image" alt="" />');
        							return true;
        						} else {
        							$("#output_checkuser").css("color", "red").html(data);
        						}
        					 }
        		});
        }

        function check_password(){
        		$.ajax({
        			type: "post",
        			url:  "register.php",
        			data: {
        				'pass1_check' : $("#pass1").val(),
        				'pass2_check' : $("#pass2").val()
        			},
        			success: function(data){
        						if(data == "success"){
        							 $("#output_pass2").html('<img src="img/check.png" class="small_image" alt="" />');
        							 $("#output_pass1").html('<img src="img/check.png" class="small_image" alt="" />');
        						} else {
        							$("#output_pass2").css("color", "red").html(data);
        						}
        					 }
        		});
        }

        function check_email(){
        		$.ajax({
        			type: "post",
        			url:  "register.php",
        			data: {
        				'email_check' : $("#email").val()
        			},
        			success: function(data){
        						if(data == "success"){
        							$("#output_email").html('<img src="img/check.png" class="small_image" alt="" />');
        						} else {
        							$("#output_email").css("color", "red").html(data);
        						}
        					 }
        		});
        }


    	//Traitement du formulaire d'inscription
		$("#register_form").submit(function(){
			var status = $("#status");
			var pseudo = $("#pseudo").val();
			var pass1 = $("#pass1").val();
			var pass2 = $("#pass2").val();
			var email = $("#email").val();

			if(pseudo == "" || pass1 == "" || pass2 == "" || email == "" ){
				status.html("Veuillez remplir tous les champs").fadeIn(400);
			} else if(pass1 != pass2) {
				status.html("Les deux mots de passe sont diff�rents").fadeIn(400);
			} else {	
				$.ajax({
					type: "post",
					url:  "register.php",
					data: {
						
						'pseudo' : pseudo,
						'pass1' : pass1,
						'pass2' : pass2,
						'email' : email,
					},
					beforeSend: function(){
									$("#bRegister").attr("value", "Traitement en cours...");
								},
					success: function(data){
								if(data != "register_success"){
									status.html(data).fadeIn(400);
									$("#bRegister").attr("value", "Inscription");
									$("#bRegister").addClass("btn-primary").css("color", "white");
								} else {
									$("#presentation").hide();
									$("#connexion").show();
									$("#connexion h1").html("Connexion");
									$("#inscription").html("<strong>Juste une derni�re �tape " + pseudo  + " " + email + 
											" !</strong><br/>Un lien d'activation de votre compte vient de vous �tre envoy� � l'adresse �lectronique indiqu�e lors de l'inscription.<br/>Veuillez tout simplement cliquer ce lien pour finir votre inscription.<br/><em>(Pensez � v�rifier vos spams ou courriers ind�sirables, si vous ne voyez pas ce mail dans votre bo�te de r�ception)</em><br/><br/>").css("width", "inherit").fadeIn(400);
								}
							 }
				});
			}
		});

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
	       
		
	});
    
    
		        
    </script>
<?php require "includes/footer.php"; ?>