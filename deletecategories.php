<?php 
	require_once("include/DataBase.php");
	require_once("include/Session.php");
	require_once("include/Functions.php");
?>

<?php
	
	$categoryId=$_GET["Delete"];

	$deleteQuery="DELETE FROM category WHERE id='$categoryId'";
	$Execute=mysqli_query($Connection, $deleteQuery);

	if($Execute){
		$_SESSION["successMessage"]="*Category Deleted Successfully!";
		redirect_to("categories.php");
	}else{
		$_SESSION["errorMessage"]="*Cdmin Couldn't Be Deleted !";
		redirect_to("categories.php");
	}

?>