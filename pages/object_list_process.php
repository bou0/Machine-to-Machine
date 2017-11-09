<?php
	session_start();
	require_once 'connect_db.php';

	if(isset($_POST['btn-login']))
	{
		//$user_name = $_POST['user_name'];
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
		
		$password = sha1($password);
		
		try
		{	
		
			$stmt = $db->prepare("SELECT * FROM users WHERE email=:email");
			$stmt->execute(array(":email"=>$email));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			
			if($row['password']==$password){
				
				echo "ok"; // log in
				$_SESSION['user_session'] = $row['id'];
			}
			else{
				
				echo "email or password does not exist."; // wrong details 
			}
				
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

?>