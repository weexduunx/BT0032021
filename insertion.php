<?php
include('db.php');
include('fonctions.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Ajouter")
	{
		$image = '';
		if($_FILES["image"]["name"] != '')
		{
			$image = upload_image();
		}
		$statement = $connection->prepare("
			INSERT INTO utilisateurs (nom, prenom,username,email,tel, image) 
			VALUES (:nom, :prenom, :username, :email, :tel, :image)
		");
		$result = $statement->execute(
			array(
				':nom'	=>	$_POST["nom"],
				':prenom'	=>	$_POST["prenom"],
				':username'	=>	$_POST["username"],
				':email'	=>	$_POST["email"],
				':tel'	=>	$_POST["tel"],
				':image'		=>	$image
			)
		);
		if(!empty($result))
		{
			echo 'Données insérées';
		}
	}
	if($_POST["operation"] == "Editer")
	{
		$image = '';
		if($_FILES["image"]["name"] != '')
		{
			$image = upload_image();
		}
		else
		{
			$image = $_POST["hidden_user_image"];
		}
		$statement = $connection->prepare(
			"UPDATE utilisateurs 
			SET nom = :nom, prenom = :prenom, username = :username, email = :email, tel = :tel, image = :image  
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':nom'	=>	$_POST["nom"],
				':prenom'	=>	$_POST["prenom"],
				':username'	=>	$_POST["username"],
				':email'	=>	$_POST["email"],
				':tel'	=>	$_POST["tel"],
				':image'		=>	$image,
				':id'			=>	$_POST["utilisateur_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Donnée mise à jour';
		}
	}
}

?>