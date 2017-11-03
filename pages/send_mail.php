<?php 
$to = $email;
$from = "didid8665@gmail.com";
$subject = "M2M - Activation de votre compte";
$message = "<!DOCTYPE html>
        					<html>
        						<head>
        							<meta charset=\"UTF-8\" />
        						</head>
        						<body>
        							Hi $pseudo,<br/><br/>
        							
        						   <h2>Complétez cette dernière étape pour activer votre compte</h2>
        						   <p>Pour ce faire, il suffit de cliquez sur le lien suivant:<br/>
        						   
        						   http://localhost/m2m/activation.php?id=$user_id&amp;u=$pseudo&amp;e=$email&amp;ssl=$hash_pass<br/>
        						   Si l'URL n'apparait pas comme un lien actif, veuillez copier/coller ce
        						   dernier dans la barre d'adresse de votre navigateur internet.</p>
        						   
        						   <h2>Indentifiants de connexion avec la clé:</h2>
        						   <p>
                                        Pseudo          : $pseudo<br/>
        								Adresse e-mail  : $email<br/>
        								Mot de passe    : $pass1<br/>
                                        clé             : $cle  <br/>
        						   </p>
        						   <p>Rendez-vous sur le site <a href=\"http://localhost/m2m/acount_authentification\"></a></p>
        						</body>
        					</html>";

$headers = "From: $from\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=utf-8\n";
if(mail($to, $subject, $message, $headers)){
    echo 'register_success';
}
exit();

?>