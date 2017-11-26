	<!-- V E R I F I C A T I O N  A J A X  E T  E C H A N G E S  J S O N //-->

	$(document).ready(function(){
    	$("#pseudo").keyup(function(){
    	//On vérifie si le pseudo est ok ou n'a pas ete déjà pris
       		check_pseudo();
        });

        function check_pseudo(){
    		$.ajax({
    			type: "post",
    			url:  "pages/account_process.php",
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
	});
    
    //Traitement du formulaire d'inscription
	$("#register_form").submit(function(){
		var status = $("#status");
		var pseudo = $("#pseudo").val();
	
		if(pseudo == ""){
			status.html("Veuillez remplir tous les champs").fadeIn(400);
		}else {	
			$.ajax({
				type: "post",
				url:  "pages/account_process.php",
				data: {
					'pseudo' : pseudo,
					beforeSend: function(){
						$("#bRegister").attr("value", "Traitement en cours...");
					},
					success: function(data){
						if(data != "register_success"){
							status.html(data).fadeIn(400);
							$("#bRegister").attr("value", "Inscription");
							$("#bRegister").addClass("btn-primary").css("color", "white");
						} else {
							$("#connexion").show();
							$("#connexion h1").html("Connexion");
							$("#inscription").html("<strong>Juste une dernière étape " + pseudo  + " ").fadeIn(400);}
			 	        }
                    }
                });
			}
		}
    );  