<?php 
	require_once("include/DataBase.php");
	require_once("include/Session.php");
	require_once("include/Functions.php");
?>

<?php confirm_login(); ?>

<?php 
	if(isset($_POST["Submit"])){
		$admin="{$_SESSION["User"]["username"]}";
		$title=mysqli_real_escape_string($Connection,$_POST["Title"]);
		$category=mysqli_real_escape_string($Connection,$_POST["Category"]);
		$post=mysqli_real_escape_string($Connection,$_POST["Post"]);
		$image=$_FILES["Image"]["name"];
		$location="upload/".basename($_FILES["Image"]["name"]);
		if(empty($title)){
			$_SESSION["errorMessage"]="*Title Field Is Empty!";
			redirect_to("addnewpost.php");
		}elseif(strlen($title)<2){
			$_SESSION["errorMessage"]="*Title Needs To Be At Least 2 Characters Long!";
			redirect_to("addnewpost.php");
		}else{
			$query="INSERT INTO admin_panel (title, category, author, image, post) VALUES ('$title', '$category', '$admin', '$image', '$post')";
			$Execute=mysqli_query($Connection,$query);
			move_uploaded_file($_FILES["Image"]["tmp_name"], $location);
			if($Execute){
				$_SESSION["successMessage"]="*Post Added Successfully!";
				redirect_to("addnewpost.php");
			}else{
				$_SESSION["errorMessage"]="*Post Couldn't Be Add!";
				redirect_to("addnewpost.php");
			}
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/admin_panel_style.css">
	<script src="https://kit.fontawesome.com/50e1039004.js"></script>

	<style type="text/css">
		
		.field-info{
			color: rgb(251,174,44);
			font-family: Bitter,Georgia,serif;
			font-size: 1.2em;
		}

		#footer{
			padding: 4px;
			border-top: 1px solid black;
			color: #eee;
			background-color: #211f22;
			text-align: center;		
	    }

		#footer hr{
			background-color: white;
		}

	</style>

</head>
<body>

	<div class="container-fluid">

		<div class="row">
			
			<div id="dashboard" class="col-lg-2 col-md-12 col-sm-12">
			
				<ul id="side-menu" class="nav nav-pills flex-column">
					<li class="nav-item"><a class="nav-link" href="dashboard.php"> <span class="fas fa-th"></</span> &nbsp;Dashboard</a></li>
					<li class="nav-item"><a class="nav-link active" href="addnewpost.php"> <span class="far fa-list-alt"></span> &nbsp;Add New Post</a></li>
					<li class="nav-item"><a class="nav-link" href="categories.php"> <span class="fas fa-tags"></span> &nbsp;Categories</a></li>
					<li class="nav-item"><a class="nav-link" href="manageadmins.php"> <span class="fas fa-users"></span> &nbsp;Manage Admins</a></li>
					<li class="nav-item"><a class="nav-link" href="comments.php"> <span class="fas fa-comments"></span> &nbsp;Comments</a></li>
					<li class="nav-item"><a class="nav-link" href="#"> <span class="fas fa-blog"></span> &nbsp;Live Blog</a></li>
					<li class="nav-item"><a class="nav-link logout" href="logout.php"> <span class="fas fa-sign-out-alt"></span> &nbsp;Log Out</a></li>
				</ul>
			</div>



			<div id="main-content" class="col-lg-10 col-md-12 col-sm-12">

				<h1>Add New Post</h1>

				<div>
					<?php echo errorMessage(); 
					echo successMessage();
					?>
				</div>

				<div>
					<form action="addnewpost.php" method="Post" enctype="multipart/form-data">
						<fieldset>
							<div class="form-group">
								<label for="title"> <span class="field-info">Title:</span></label>
								<input class="form-control" id="title" type="text" name="Title" placeholder="Title">
							</div>
							<div class="form-group">
								<label for="category"> <span class="field-info">Category:</span></label>
								<select class="form-control" id="category" name="Category">
									<?php

							  			$selectQuery="SELECT datetime, name, creatorname FROM category ORDER BY datetime DESC";
							  			$Execute=mysqli_query($Connection, $selectQuery);

							  			while($dataRows=mysqli_fetch_array($Execute)){
							  				$categoryName=$dataRows["name"];
							  		?>	

							  		<option><?php echo $categoryName ?></option>

							  		<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="image"> <span class="field-info">Select Image:</span></label>
								<input class="form-control" type="file" name="Image" id="image" >
							</div>
							<div class="form-group">
								<label for="postarea"> <span class="field-info">Input Your Text:</span></label>
								<textarea class="form-control" name="Post" id="postarea" rows="4"></textarea>
							</div>
							<br>
							<input class="btn btn-success btn-block" type="submit" name="Submit" value="Add New Post">
						</fieldset>
						<br>
					</form>
				</div>	  				  	
			</div>
		</div>
	</div>

	<div style="height: 10px; background-color: #27AAE1;">
		
	</div>

	<div id="footer">
		<hr>
		<p>Website By | Alexandru Baltazar | &copy; 2019-2020 --- All rights reserved </p>
		<hr>
	</div>

	<div style="height: 10px; background-color: #27AAE1;">
		
	</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>