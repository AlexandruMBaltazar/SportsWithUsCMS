<?php
	require_once("include/DataBase.php");
	require_once("include/Session.php");
	require_once("include/Functions.php");

	$idDelete=$_GET["Delete"];
	$deleteQuery="DELETE FROM admin_panel WHERE id='$idDelete'";

	$Execute=mysqli_query($Connection, $deleteQuery);

	if($Execute){
		$_SESSION["successMessage"]="*Post Deleted Successfully!";
		redirect_to("dashboard.php");
	}else{
		$_SESSION["errorMessage"]="*Post Couldn't Be Deleted!";
		redirect_to("dashboard.php");
	}

?>