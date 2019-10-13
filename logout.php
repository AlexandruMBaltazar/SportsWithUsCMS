<?php 
	require_once("include/Session.php");
	require_once("include/DataBase.php");
	require_once("include/Functions.php");	
?>

<?php
	$_SESSION["User"]=null;
	session_destroy();
	redirect_to("login.php");
?>