<?php
include('db.php');
include('fonctions.php');
if(isset($_POST["utilisateur_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM utilisateurs 
		WHERE id = '".$_POST["utilisateur_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["nom"] = $row["nom"];
		$output["prenom"] = $row["prenom"];
		$output["username"] = $row["username"];
		$output["email"] = $row["email"];
		$output["tel"] = $row["tel"];
		if($row["image"] != '')
		{
			$output['image'] = '<img src="img/'.$row["image"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["image"].'" />';
		}
		else
		{
			$output['image'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
	}
	echo json_encode($output);
}
?>