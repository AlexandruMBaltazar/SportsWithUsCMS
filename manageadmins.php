<?php 
	require_once("include/DataBase.php");
	require_once("include/Session.php");
	require_once("include/Functions.php");
?>
<?php confirm_login(); ?>
<?php 
	if(isset($_POST["Submit"])){
		$admin="{$_SESSION["User"]["username"]}";
		$username= mysqli_real_escape_string($Connection,$_POST["Username"]);
		$password= mysqli_real_escape_string($Connection,$_POST["Password"]);
		$confirmPassword= mysqli_real_escape_string($Connection,$_POST["ConfirmPassword"]);
		if(empty($username) || empty($password) || empty($confirmPassword)){
			$_SESSION["errorMessage"]="*All Fields Must Be Filled Out!";
			redirect_to("manageadmins.php");
		}elseif(strlen($password) < 8){
			$_SESSION["errorMessage"]="*Your Password Is Too Short (8 characters min)!";
			redirect_to("manageadmins.php");
		}elseif ($password != $confirmPassword) {
			$_SESSION["errorMessage"]="*Your Password Does Not Match!";
			redirect_to("manageadmins.php");
		}else{
			$query="INSERT INTO registration (username, password, added_by) VALUES ('$username', '$password', '$admin')";
			$Execute=mysqli_query($Connection,$query);
			if($Execute){
				$_SESSION["successMessage"]="*Admin Added Successfully!";
				redirect_to("manageadmins.php");
			}else{
				$_SESSION["errorMessage"]="*Admin Couldn't Be Add!";
				redirect_to("manageadmins.php");
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
		}s

	</style>

</head>
<body>

	<div class="container-fluid">

		<div class="row">
			
			<div id="dashboard" class="col-lg-2 col-md-12 col-sm-12">
			
				<ul id="side-menu" class="nav nav-pills flex-column">
					<li class="nav-item"><a class="nav-link" href="dashboard.php"> <span class="fas fa-th"></</span> &nbsp;Dashboard</a></li>
					<li class="nav-item"><a class="nav-link" href="addnewpost.php"> <span class="far fa-list-alt"></span> &nbsp;Add New Post</a></li>
					<li class="nav-item"><a class="nav-link" href="categories.php"> <span class="fas fa-tags"></span> &nbsp;Categories</a></li>
					<li class="nav-item"><a class="nav-link active" href="manageadmins.php"> <span class="fas fa-users"></span> &nbsp;Manage Admins</a></li>
					<li class="nav-item"><a class="nav-link" href="comments.php"> <span class="fas fa-comments"></span> &nbsp;Comments</a></li>
					<li class="nav-item"><a class="nav-link" href="#"> <span class="fas fa-blog"></span> &nbsp;Live Blog</a></li>
					<li class="nav-item"><a class="nav-link logout" href="logout.php"> <span class="fas fa-sign-out-alt"></span> &nbsp;Log Out</a></li>
				</ul>
			</div>



			<div id="main-content" class="col-lg-10 col-md-12 col-sm-12">

				<h1>Manage Admins</h1>

				<div>
					<?php echo errorMessage(); 
					echo successMessage();
					?>
				</div>

				<div>
					<form action="manageadmins.php" method="Post">
						<fieldset>
							<div class="form-group">
								<label for="username"> <span class="field-info">User Name:</span></label>
								<input class="form-control" id="username" type="text" name="Username" placeholder="User Name">
							</div>

							<div class="form-group">
								<label for="password"> <span class="field-info">Password:</span></label>
								<input class="form-control" id="password" type="password" name="Password" placeholder="Password">
							</div>

							<div class="form-group">
								<label for="confirm-password"> <span class="field-info">Confirm Password:</span></label>
								<input class="form-control" id="confirm-password" type="password" name="ConfirmPassword" placeholder="Retype Password">
							</div>
							<br>
							<input class="btn btn-success btn-block" type="submit" name="Submit" value="Add New Admin">
						</fieldset>
						<br>
					</form>
				</div>

				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
						    <tr>
						      	<th scope="col">Admin Name</th>
							    <th scope="col">Added By</th>
							    <th scope="col">Date & Time</th>
							    <th scope="col">Action</th>
						    </tr>
					  	</thead>

					  	<tbody>
					  		
					  		<?php

					  			$selectQuery="SELECT id, datetime, username, added_by FROM registration ORDER BY datetime DESC";
					  			$Execute=mysqli_query($Connection, $selectQuery);

					  			while($dataRows=mysqli_fetch_array($Execute)){
					  				$id=$dataRows["id"];
					  				$username=$dataRows["username"];
					  				$addedBy=$dataRows["added_by"];
					  				$datetime=$dataRows["datetime"];
					  		?>	
					  			<tr>
								    <td><?php echo $username ?></td>
								    <td><?php echo $addedBy ?></td>
								    <td><?php echo $datetime ?></td>
								    <td>
								    	<a href="deleteadmins.php?Delete=<?php echo $id ?>" class="btn btn-danger" >Delete</a>
								    </td>
							    </tr>

					  		<?php } ?>

					  		
					  	</tbody>

					</table>
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