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
					<li class="nav-item"><a class="nav-link active" href="dashboard.php"> <span class="fas fa-th"></</span> &nbsp;Dashboard</a></li>
					<li class="nav-item"><a class="nav-link" href="addnewpost.php"> <span class="far fa-list-alt"></span> &nbsp;Add New Post</a></li>
					<li class="nav-item"><a class="nav-link" href="categories.php"> <span class="fas fa-tags"></span> &nbsp;Categories</a></li>
					<li class="nav-item"><a class="nav-link" href="manageadmins.php"> <span class="fas fa-users"></span> &nbsp;Manage Admins</a></li>
					<li class="nav-item"><a class="nav-link" href="comments.php"> <span class="fas fa-comments"></span> &nbsp;Comments</a></li>
					<li class="nav-item"><a class="nav-link" href="#"> <span class="fas fa-blog"></span> &nbsp;Live Blog</a></li>
					<li class="nav-item"><a class="nav-link logout" href="logout.php"> <span class="fas fa-sign-out-alt"></span> &nbsp;Log Out</a></li>
				</ul>
			</div>



			<div id="main-content" class="col-lg-10 col-md-12 col-sm-12">
				
				<h1>Admin Dashboard</h1>
				<div>
					<?php echo errorMessage(); 
					echo successMessage();
					?>
				</div>

				<div class="table-responsive">
					
					<table class="table table-striped table-hover">
						<thead>
						    <tr>
						      	<th scope="col">No</th>
							    <th scope="col">Post Title</th>
							    <th scope="col">Date & Time</th>
							    <th scope="col">Author</th>
							    <th scope="col">Category</th>
							    <th scope="col">Banner</th>
							    <th scope="col">Comments</th>
							    <th scope="col">Action</th>
							    <th scope="col">Details</th>
						    </tr>
					  	</thead>

					  	<tbody>

					  		<?php 
					  			$displayQuery="SELECT * FROM admin_panel ORDER BY datetime DESC";
					  			$Execute=mysqli_query($Connection, $displayQuery);

					  			while($dataRows=mysqli_fetch_array($Execute)){
					  				$id=$dataRows["id"];
									$dateTime=$dataRows["datetime"];
									$title=$dataRows["title"];
									$category=$dataRows["category"];
									$author=$dataRows["author"];
									$image=$dataRows["image"];
									$post=$dataRows["post"];
					  		?>

					  		<tr>
					  			<td><?php echo $id ?></td>
					  			<td style="color: #5E5EFF;"><?php 
					  				if(strlen($title)>15){
					  					$title = substr($title, 0,15)."...";
					  				}

					  			echo $title ?></td>
					  			<td>
					  				<?php 

					  					if(strlen($dateTime)>11){
					  						$dateTime = substr($dateTime, 0,11);
					  					}

					  					echo $dateTime 
					  				?>
					  			</td>
					  			<td><?php echo $author ?></td>
					  			<td>
					  				<?php 
					  				
					  					if(strlen($category)>7){
					  						$category = substr($category,0,7)."..";
					  					}
					  				
					  					echo $category 
					  				?>
					  			</td>
					  			<td> <img src="upload/<?php echo $image ?>" width="170px" height="50px"></td>

					  			<td>


					  				<?php
					  					$disapproveQuery="SELECT COUNT(*) AS 'total_dissapproved' FROM comments WHERE status='OFF' AND post_id=$id";
					  					$ExecuteDisapprove=mysqli_query($Connection, $disapproveQuery);

					  					$dataRowsDisapproved=mysqli_fetch_array($ExecuteDisapprove);
					  					$totalDisapproved=$dataRowsDisapproved["total_dissapproved"];
					  				?>
					  				<h5 style="display: inline;"><span class="badge badge-danger"><?php echo $totalDisapproved?></span></h5>


					  				<?php
					  					$approveQuery="SELECT COUNT(*) AS 'total_approved' FROM comments WHERE status='ON' AND post_id=$id";
					  					$ExecuteApproved=mysqli_query($Connection, $approveQuery);

					  					$dataRowsApproved=mysqli_fetch_array($ExecuteApproved);
					  					$totalApproved=$dataRowsApproved["total_approved"];	
					  				?>
					  				<h5 style=" padding-left: 20px; display: inline;"><span class="badge badge-success"><?php echo $totalApproved?></span></h5>
					  			</td>

					  			<td>
					  				<a class="btn btn-warning" href="editpost.php?Edit=<?php echo $id ?>">Edit</a> 

					  				<a href="deletepost.php?Delete=<?php echo $id ?>" class="btn btn-danger" >Delete</a>
					  				
					  			</td>
					  			<td><a class="btn btn-primary" href="fullpost.php?id=<?php echo $id ?>" target="_blank">Live Preview</a></td>
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