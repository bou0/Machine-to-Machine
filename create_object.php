<?php require 'header.php';
session_start();

?>
    
    <div class="container">

      <form class="form-signin" id="dynsel" name="dynsel" >
        <h2 class="form-signin-heading">OBJET</h2>
        
        
        <input name="input-objet" type="text" id="inputObjet" class="form-control objet" placeholder="ID Objet" required autofocus onblur="verifMail(this)"><br/>
        
        <input name="nameobjet" type="text" id="nameObjet" class="form-control objet" placeholder="Nom de l'objet" required autofocus onblur="verifMail(this)">
         <div class="form-group">
             <label for="description">Description</label>
             <textarea class="form-control" rows="5" id="description"></textarea>
        </div>
        
		
        <!-- T Y P E  D A T A -->
        <label></label>
        <select name="select1" id="select1" onchange="selectoption();" >
           <option selected="selected" style="width:147px">Type de données</option>
           <option>Temperature</option>
           <option>humidité</option>
           <option>Flux hydrolique</option>
           <option>Mesure Courant</option>
           <option>Autre</option>
        </select> 
        <br/>

        <!-- A J O U T  ET  S U P P R E S S I O N-->
        
        <input name="title" type="text" id="title"  placeholder="Ajouter de nouveau Type" value="" size="40"  /><br/>
        <input type="button" name="add"  style="width:147px" value="Ajouter" onclick="addoption()"  onblur="verifMail(this)"/>
        <input type="button" name="del"  style="width:148px" value="Supprimer" onclick="deloption()"  onblur="verifMail(this)"/>
        <br>
        
        <!-- V A D I T I O N -->
        <input type="button" class="btn btn-danger" value="Annuler"  onClick="window.location.href='pages/object_list.php'"/>
        <button class="btn btn-primary" type="submit">Valid</button>
      </form>

    </div> <!-- /container -->

    <script src="js/verif_saisie.js"></script>
    <script type="text/javascript">
    
	<!-- V E R I F I C A T I O N  A J A X  E T  E C H A N G E S  J S O N //-->

	$(document).ready(function(){
		$(".btn").click(function(){
			
			});
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
</script>
 <?php require 'footer.php';?>
