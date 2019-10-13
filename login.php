<?php 
	require_once("include/DataBase.php");
	require_once("include/Session.php");
	require_once("include/Functions.php");
?>

<?php 
	if(isset($_POST["Submit"])){
		$username= mysqli_real_escape_string($Connection,$_POST["Username"]);
		$password= mysqli_real_escape_string($Connection,$_POST["Password"]);
		if(empty($username) || empty($password)){
			$_SESSION["errorMessage"]="*All Fields Must Be Filled Out!";
			redirect_to("login.php");
		}else{
			$Found_Account=login_attempt($username,$password);
			$_SESSION["User"]=$Found_Account;
			if($Found_Account){
				$_SESSION["successMessage"]="Welcome {$_SESSION["User"]["username"]}!";
				redirect_to("dashboard.php");
			}else{
				$_SESSION["errorMessage"]="*Wrong Username or Password!";
				redirect_to("login.php");
			}
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
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

		body{
			background-color: white;
		}
	</style>

</head>
<body>

		<div style="height: 10px; background-color: #27AAE1"></div>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<div class="navbar-header">	
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapse" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
     				<span class="navbar-toggler-icon"></span>
    			</button>
				<a class="navbar-brand" href="login.php">	
					<img src="images/logo.png" width="55"; height="55"> 
					Sports With Us		
				</a>
			</div>

			<div class="collapse navbar-collapse" id="collapse">
	    	</div>
    	</div>
	</nav>
<div style="height: 10px; background-color: #27AAE1"></div>


	<div class="container-fluid">

		<div class="row">
			
			<div id="main-content" class="offset-lg-4 col-lg-4 offset-md-4 col-md-4 col-sm-12">
				<div>
					<br><br><br><br>
					<?php echo errorMessage(); 
					echo successMessage();
					?>
				</div>
				<h2>Welcome Back</h2>

				<div>
					<form action="login.php" method="Post">
						<fieldset>
							<div class="form-group">
								<label for="username"> <span class="field-info">User Name:</span></label>
								<div class="input-group mb-3 input-group-lg">
									<div class="input-group-prepend">
    									<span class="input-group-text"><span class="fas fa-user" style="color: #6499BE;"></span></span>
  									</div>
									<input class="form-control" id="username" type="text" name="Username" placeholder="User Name">
								</div>
							</div>

							<div class="form-group">
								<label for="password"> <span class="field-info">Password:</span></label>
								<div class="input-group mb-3 input-group-lg">
									<div class="input-group-prepend">
    									<span class="input-group-text"><span class="fas fa-lock" style="color: #6499BE;"></span></span>
  									</div>
									<input class="form-control" id="password" type="password" name="Password" placeholder="Password">
							    </div>
							</div>
							<br>
							<input class="btn btn-info btn-block" type="submit" name="Submit" value="Login">
						</fieldset>
						<br>
					</form>
				</div>
			</div>
		</div>
	</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>