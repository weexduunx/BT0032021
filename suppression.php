<?php

include('db.php');
include("fonctions.php");

if(isset($_POST["utilisateur_id"]))
{
	$image = get_image_name($_POST["utilisateur_id"]);
	if($image != '')
	{
		unlink("img/" . $image);
	}
	$statement = $connection->prepare(
		"DELETE FROM utilisateurs WHERE id = :id"
	);
	$result = $statement->execute(
		array(
			':id'	=>	$_POST["utilisateur_id"]
		)
	);

	if(!empty($result))
	{
		echo 'Data Deleted';
	}
}



?>