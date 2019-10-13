<?php
	require_once("include/DataBase.php");
	require_once("include/Functions.php");
	require_once("include/Session.php");

	$adminId=$_GET["Delete"];

	$deleteQuery="DELETE FROM registration WHERE id='$adminId'";
	$Execute=mysqli_query($Connection, $deleteQuery);

	if($Execute){
		$_SESSION["successMessage"]="*Admin Deleted Successfully!";
		redirect_to("manageadmins.php");
	}else{
		$_SESSION["errorMessage"]="*Admin Couldn't Be Deleted !";
		redirect_to("manageadmins.php");
	}
?>