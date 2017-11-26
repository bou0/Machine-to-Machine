//si le formulaire est mal rempli
        function surligne(champ, erreur)
        {
            if(erreur)
                champ.style.backgroundColor = "#fba";
                else
                    champ.style.backgroundColor = "";
        }
        
        //Verifier l'adresse ail si il est correct
        function verifMail(champ)
		{
           var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
        
           if(!regex.test(champ.value))
           {
              surligne(champ, true);
              return false;
           }
           else
           {
              surligne(champ, false);
              return true;
           }
        }


      //vérifier que la longueur est correcte
		function verifPseudo(champ)
        {
           if(champ.value.length < 2 || champ.value.length > 25)
           {
              surligne(champ, true);
              return false;
           }
           else
           {
              surligne(champ, false);
              return true;
           }
        }

    	
		//Tout vérifier avant l'envoi
        function verifForm(f)
        {
           var pseudoOk = verifPseudo(f.pseudo);
           var mailOk = verifMail(f.email);
           
           if(verifPseudo(f.pseudo) && verifMail(f.email) ){
        	   return true;
           }
              
           else
           {
              alert("Veuillez remplir correctement tous les champs");
              return false;
           }
        }