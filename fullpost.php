<?php 
	require_once("include/DataBase.php");
	require_once("include/Session.php");
	require_once("include/Functions.php");
?>
<?php confirm_login(); ?>
<?php 
	if(isset($_POST["Submit"])){
		$name=mysqli_real_escape_string($Connection,$_POST["Name"]);
		$email=mysqli_real_escape_string($Connection,$_POST["Email"]);
		$comment=mysqli_real_escape_string($Connection,$_POST["Comment"]);
		$status="OFF";
		$postId=$_GET["id"];
		if(empty($email) || empty($name) || empty($comment) ){
			$_SESSION["errorMessage"]="*All Fields Are Required!";
		}elseif(strlen($comment)>500){
			$_SESSION["errorMessage"]="*Only 500 Characters Are Allowed In Comment!";
		}else{
			$query="INSERT INTO comments (name, email, comment, status, post_id) VALUES ('$name', '$email', '$comment','$status','$postId')";
			$Execute=mysqli_query($Connection,$query);
			if($Execute){
				$_SESSION["successMessage"]="*Comment Submited Successfully!";
				redirect_to("fullpost.php?id={$postId}");
			}else{
				$_SESSION["errorMessage"]="*Comment Couldn't Be Submit!";
				redirect_to("fullpost.php?id={$postId}");
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Full Blog Post</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/blog.css">
	<script src="https://kit.fontawesome.com/50e1039004.js"></script>
	<style type="text/css">

		.field-info{
			color: rgb(251,174,44);
			font-family: Bitter,Georgia,serif;
			font-size: 1.2em;
		}

		#comments{
			background-color: #F6F7F9;
		}

		.comment-info{
			color: #365899;
			font-family: sans-serif;
			font-size: 1.1em;
			font-weight: bold;
			padding-top: 10px;
		}

		.comment{
			margin-top: -2px;
			padding-bottom: 10px;
			font-size: 1.1em;
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
	        			<a class="nav-link" href="blog.php">Blog</a>
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

			<form class="form-inline my-2 my-lg-0 ml-auto" action="blog.php" method="Get">
	      		<input class="form-control mr-sm-2" type="search" name="Search" placeholder="Search" aria-label="Search">
	      		<button class="btn btn-outline-success my-2 my-sm-0" name="SearchButton" type="submit">Search</button>
	    	</form>
	    	</div>
    	</div>
	</nav>

	<div style="height: 10px; background-color: #27AAE1"></div>

	<div class="container">
		<div class="blog-header">
			<h1>The Complete Responsive CMS Blog</h1>
			<p class="lead">The Complete Blog Using PHP</p>
		</div>

		<div>
			<?php echo errorMessage(); 
			echo successMessage();
			?>
		</div>

		<div class="row">
			
			<div class="col-lg-8 col-md-8 col-sm-10">
				<?php 

					if(isset($_GET["SearchButton"])){
						$search= htmlspecialchars($_GET["Search"]);
						$displayQuery="SELECT * FROM admin_panel WHERE datetime LIKE '%$search%' OR title LIKE '%$search%' OR category LIKE '%$search%' OR post LIKE '%$search%'";
					}else{
						$postId=$_GET["id"];
						$displayQuery="SELECT * FROM admin_panel WHERE id='$postId' ORDER BY datetime DESC";
					}

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

				<div class="blog-post">
					<figure class="figure">
						<img class="figure-img img-fluid rounded img-thumbnail" src="upload/<?php echo $image?>">	
						<figcaption class="figure-caption">
							<h2 id="heading"><?php echo htmlentities($title); ?></h2>
							<p class="description">Category: <?php echo htmlentities($category);?> Published On: <?php echo htmlentities($dateTime); ?></p>
							<p><?php echo $post; ?> </p>
						</figcaption>
					</figure>
				</div>

				<br>

				<?php } ?>
				<br><br>
				<span class="field-info">Share your thoughts about this post</span>
				<br><br>
				<span class="field-info">Comments</span>

				<?php 
					$postId=$_GET["id"];
					$extractCommentsQuery="SELECT * FROM comments WHERE post_id=$postId AND status='ON'";
					$Execute=mysqli_query($Connection, $extractCommentsQuery);

					while($dataRows=mysqli_fetch_array($Execute)){
						$commentDate=$dataRows["datetime"];
						$name=$dataRows["name"];
						$comment=$dataRows["comment"];
				?>

						<div id="comments">
							<img style="margin-left: 10px; margin-top: 10px;" class="float-left" src="images/profile.jpg" width=70px; height=70px;>
							<p style="margin-left: 90px;" class="comment-info"><?php echo $name ?></p>
							<p style="margin-left: 90px;" class="description" ><?php echo $commentDate ?></p>
							<p style="margin-left: 10px;" class="comment"><?php echo $comment ?></p>	
						</div>
						<hr>

					<?php }?>

				<div>
					<form action="fullpost.php?id=<?php echo $postId?>" method="Post" >
						<fieldset>
							<div class="form-group">
								<label for="Name"> <span class="field-info">Name:</span></label>
								<input class="form-control" id="name" type="text" name="Name" placeholder="Name">
							</div>

							<div class="form-group">
								<label for="Email"> <span class="field-info">Email:</span></label>
								<input class="form-control" id="email" type="text" name="Email" placeholder="Email">
							</div>

							<div class="form-group">
								<label for="comment"> <span class="field-info">Input Your Comment:</span></label>
								<textarea class="form-control" name="Comment" id="comment" rows="4"></textarea>
							</div>
							<input class="btn btn-primary btn-block" type="submit" name="Submit" value="Submit Comment">
							<br>
						</fieldset>
					</form>
				</div>

			</div>

			<div class="offset-lg-1 col-lg-3 offset-md-1 col-md-3 col-sm-2">
				<h2>Test</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam fermentum nunc malesuada nibh posuere, at fermentum ex eleifend. Fusce a nisi feugiat, consectetur est vitae, sagittis nisl. In suscipit quis augue a pellentesque. Nam est est, iaculis sed felis sit amet, porta scelerisque dui. Quisque tempor varius molestie. Fusce ac vulputate ipsum. Donec egestas vehicula orci, quis suscipit justo vehicula at. Praesent eget ipsum commodo, sodales velit ac, laoreet est.</p>
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





