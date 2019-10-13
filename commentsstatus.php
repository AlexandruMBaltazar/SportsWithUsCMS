<?php 
	require_once("include/DataBase.php");
	require_once("include/Functions.php");
?>

<?php
	if(isset($_GET["approvecomment"])){
		$commentId=$_GET["approvecomment"];
		$approveQuery="UPDATE comments SET status='ON' WHERE id='$commentId'";
		$Execute=mysqli_query($Connection, $approveQuery);
																																																																																	
		if($Execute){
			redirect_to("comments.php");
		}
	}elseif(isset($_GET["disapprovecomment"])){
		$commentId=$_GET["disapprovecomment"];
		$approveQuery="UPDATE comments SET status='OFF' WHERE id='$commentId'";
		$Execute=mysqli_query($Connection, $approveQuery);
																																																																																	
		if($Execute){
			redirect_to("comments.php");
		}
	}elseif(isset($_GET["deletecomment"])){
		$commentId=$_GET["deletecomment"];
		$approveQuery="DELETE FROM comments WHERE id='$commentId'";
		$Execute=mysqli_query($Connection, $approveQuery);
																																																																																	
		if($Execute){
			redirect_to("comments.php");
		}
	}

		
?>