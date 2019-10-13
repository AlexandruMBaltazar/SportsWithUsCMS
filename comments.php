<?php 
	require_once("include/Session.php");
	require_once("include/DataBase.php");
	require_once("include/Functions.php");
?>
<?php confirm_login(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/admin_panel_style.css">
	<script src="https://kit.fontawesome.com/50e1039004.js"></script>
	<style type="text/css">

		.navbar-nav{
			margin: -3px 0px 0px auto;
        }

		.navbar-nav li{
			font-weight: bold;
			font-family: Bitter, Georgia, Times, serif;
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

	<div style="height: 10px; background-color: #27AAE1"></div>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<div class="navbar-header">	
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapse" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
     				<span class="navbar-toggler-icon"></span>
    			</button>
				<a class="navbar-brand" href="blog.php">	
					<img src="images/logo.png" width="55"; height="55"> 
					Sports With Us		
				</a>
			</div>

			<div class="collapse navbar-collapse" id="collapse">
			<ul class="nav navbar-nav">
					<li class="nav-item">
	        			<a class="nav-link" href="#">Home</a>
	      			</li>
	      			<li class="nav-item active">
	        			<a class="nav-link" href="blog.php" target="_blank">Blog</a>
	      			</li>
	      			<li class="nav-item">
	        			<a class="nav-link" href="#">About Us</a>
	      			</li>
	      			<li class="nav-item">
	        			<a class="nav-link" href="#">Services</a>
	      			</li>
	      			<li class="nav-item">
	        			<a class="nav-link" href="#">Constact Us</a>
	      			</li>
	      			<li class="nav-item">
	        			<a class="nav-link" href="#">Feature</a>
	      			</li>
			</ul>

			<form class="form-inline my-2 my-lg-0 ml-auto" action="blabla.php" method="Get">
	      		<input class="form-control mr-sm-2" type="search" name="Search" placeholder="Search" aria-label="Search">
	      		<button class="btn btn-outline-success my-2 my-sm-0" name="SearchButton" type="submit">Search</button>
	    	</form>
	    	</div>
    	</div>
	</nav>

	<div style="height: 10px; background-color: #27AAE1"></div>

	<div class="container-fluid">

		<div class="row">
			
			<div id="dashboard" class="col-lg-2 col-md-12 col-sm-12">

				<ul id="side-menu" class="nav nav-pills flex-column" style="margin-top: 1em;">
					<li class="nav-item"><a class="nav-link" href="dashboard.php"> <span class="fas fa-th"></</span> &nbsp;Dashboard</a></li>
					<li class="nav-item"><a class="nav-link" href="addnewpost.php"> <span class="far fa-list-alt"></span> &nbsp;Add New Post</a></li>
					<li class="nav-item"><a class="nav-link" href="categories.php"> <span class="fas fa-tags"></span> &nbsp;Categories</a></li>
					<li class="nav-item"><a class="nav-link" href="manageadmins.php"> <span class="fas fa-users"></span> &nbsp;Manage Admins</a></li>
					<li class="nav-item"><a class="nav-link active" href="#"> <span class="fas fa-comments"></span> &nbsp;Comments</a></li>
					<li class="nav-item"><a class="nav-link" href="#"> <span class="fas fa-blog"></span> &nbsp;Live Blog</a></li>
					<li class="nav-item"><a class="nav-link logout" href="logout.php"> <span class="fas fa-sign-out-alt"></span> &nbsp;Log Out</a></li>
				</ul>
			</div>



			<div id="main-content" class="col-lg-10 col-md-12 col-sm-12">
				
				<div>
					<?php echo errorMessage(); 
					echo successMessage();
					?>
				</div>
				<h1>Un-Approved Comments</h1>
				<div class="table-responsive">
					
					<table class="table table-striped table-hover">
						<thead>
						    <tr>
						      	<th scope="col">No</th>
							    <th scope="col">Name</th>
							    <th scope="col">Date</th>
							    <th scope="col">Comment</th>
							    <th scope="col">Status</th>
							    <th scope="col">Details</th>
						    </tr>
					  	</thead>

					  	<tbody>

					  		<?php 
					  			$CommentsQuery="SELECT * FROM comments WHERE status='OFF' ORDER BY datetime DESC";
					  			$Execute=mysqli_query($Connection, $CommentsQuery);

					  			while($dataRows=mysqli_fetch_array($Execute)){
					  				$commentId=$dataRows["id"];
									$dateTime=$dataRows["datetime"];
									$name=$dataRows["name"];
									$comment=$dataRows["comment"];
									$postId=$dataRows["post_id"];

									if(strlen($comment) > 18){
										$comment=substr($comment, 0, 18)."...";
									}

									if(strlen($name) > 10){
										$name=substr($name, 0, 10)."...";
									}
					  		?>

					  		<tr>
					  			<td><?php echo htmlentities($commentId)?></td>
					  			<td><?php echo htmlentities($name)?></td>
					  			<td><?php echo htmlentities($dateTime)?></td>
								<td><?php echo htmlentities($comment)?></td>
					  			<td>
					  				<a class="btn btn-success" href="commentsstatus.php?approvecomment=<?php echo $commentId?>">Approve</a> 
					  				<a class="btn btn-danger" href="commentsstatus.php?deletecomment=<?php echo $commentId?>">Delete</a>
					  			</td>
					  			<td><a class="btn btn-primary" href="fullpost.php?id=<?php echo $postId ?>" target="_blank">Live Preview</a></td>
					  		</tr>

					  		<?php } ?>
	
					  	</tbody>
					</table>
				</div>

				<h1>Approved Comments</h1>
				<div class="table-responsive">
					
					<table class="table table-striped table-hover">
						<thead>
						    <tr>
						      	<th scope="col">No</th>
							    <th scope="col">Name</th>
							    <th scope="col">Date</th>
							    <th scope="col">Comment</th>
							    <th scope="col">Status</th>
							    <th scope="col">Details</th>
						    </tr>
					  	</thead>

					  	<tbody>

					  		<?php 
					  			$CommentsQuery="SELECT * FROM comments WHERE status='ON' ORDER BY datetime DESC";
					  			$Execute=mysqli_query($Connection, $CommentsQuery);

					  			while($dataRows=mysqli_fetch_array($Execute)){
					  				$commentId=$dataRows["id"];
									$dateTime=$dataRows["datetime"];
									$name=$dataRows["name"];
									$comment=$dataRows["comment"];
									$postId=$dataRows["post_id"];

									if(strlen($comment) > 18){
										$comment=substr($comment, 0, 18)."...";
									}

									if(strlen($name) > 10){
										$name=substr($name, 0, 10)."...";
									}
					  		?>

					  		<tr>
					  			<td><?php echo htmlentities($commentId)?></td>
					  			<td><?php echo htmlentities($name)?></td>
					  			<td><?php echo htmlentities($dateTime)?></td>
								<td><?php echo htmlentities($comment)?></td>
					  			<td>
					  				<a class="btn btn-warning" href="commentsstatus.php?disapprovecomment=<?php echo $commentId?>">Disapprove</a> 

					  				<a class="btn btn-danger" href="commentsstatus.php?deletecomment=<?php echo $commentId?>">Delete</a>
					  			</td>
					  			<td><a class="btn btn-primary" href="fullpost.php?id=<?php echo $postId ?>" target="_blank">Live Preview</a></td>
					  		</tr>

					  		<?php } ?>
	
					  	</tbody>
					</table>
				</div>

			</div>
		</div>
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