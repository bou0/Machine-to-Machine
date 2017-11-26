<?php
    session_start();   
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>Connexion M2M Stockage de data d'objets connectés</title>
            <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
            <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
            <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
            <script type="text/javascript" src="js/validation.min.js"></script>
            <link href="css/style_login.css" rel="stylesheet" type="text/css" media="screen">
        </head>
        
        <body>
            <?php include 'header.php';?>
        <div class="signin-form">
        
        	<div class="container">
             
                
               <form class="form-signin" method="post" id="login-form">
              
                <h2 class="form-signin-heading">Connexion</h2><hr />
                
                <div id="error">
                
                </div>
                
                <div class="form-group">
                <input type="email" class="form-control" placeholder="Adresse Email" name="email" id="email" />
                <span id="check-e"></span>
                </div>
                
                <div class="form-group">
                <input type="password" class="form-control" placeholder="Mot de passe" name="password" id="password" />
                </div>
               
             	<hr />
                
                <div class="form-group">
                    <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
            			<span class="glyphicon glyphicon-log-in"></span> &nbsp; Se connecter
        			</button>
        			<input type="button" class="btn btn-primary" value="Créer un compte"  
        				onClick="window.location.href='account_create.php'"/>
                </div>  
              
              </form>
        
            </div>
            
        </div>
            
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script>
            $('document').ready(function()
            { 
                 /* validation */
            	 $("#login-form").validate({
                  rules:
            	  {
            			password: {
            			required: true,
            			},
            			user_email: {
                        required: true,
                        email: true
                        },
            	   },
                   messages:
            	   {
                        password:{
                                  required: "Entrer votre mot de passe"
                                 },
                        user_email: "Entrer votre adresse email",
                   },
            	   submitHandler: submitForm	
                   });  
            	   /* validation */
            	   
            	   /* login submit */
            	   function submitForm()
            	   {		
            			var data = $("#login-form").serialize();
            				
            			$.ajax({
            				
            			type : 'POST',
            			url  : 'pages/object_list_process.php',
            			data : data,
            			beforeSend: function()
            			{	
            				$("#error").fadeOut();
            				$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; envoye...');
            			},
            			success :  function(response)
            			   {						
            					if(response=="ok"){
            									
            						$("#btn-login").html('<img src="img/btn-ajax-loader.gif" /> &nbsp; Connexion...');
            						setTimeout(' window.location.href = "pages/object_list.php"; ',4000);
            					}
            					else{
            									
            						$("#error").fadeIn(1000, function(){						
            				$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
            											$("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Se connecter');
            									});
            					}
            			  }
            			});
            				return false;
            		}
            	   /* login submit */
            });
        
        </script>
        <?php 
       
        include 'footer.php';?>
        </body>
    </html>