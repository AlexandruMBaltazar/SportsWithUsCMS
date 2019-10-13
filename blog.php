<?php 
	require_once("include/DataBase.php");
	require_once("include/Session.php");
	require_once("include/Functions.php");
?>
<?php confirm_login(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Blog</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/blog.css">
	<script src="https://kit.fontawesome.com/50e1039004.js"></script>
	<style type="text/css">
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

		<div class="row">
			
			<div class="col-lg-8 col-md-8 col-sm-10">
				<?php 

					if(isset($_GET["SearchButton"])){
						$search= htmlspecialchars($_GET["Search"]);
						$displayQuery="SELECT * FROM admin_panel WHERE datetime LIKE '%$search%' OR title LIKE '%$search%' OR category LIKE '%$search%' OR post LIKE '%$search%'";
					}elseif(isset($_GET["Category"])){
						$postCategory=$_GET["Category"];
						$displayQuery="SELECT * FROM admin_panel WHERE category='$postCategory' ORDER BY datetime DESC";
					}elseif(!isset($_GET["Page"])){
						redirect_to("blog.php?Page=1");
					}elseif(isset($_GET["Page"])){
						$page=$_GET["Page"];
						if($page==0){
							$showPostFrom=0;
						}else{
							$showPostFrom=($page*3)-3;
						}
						$displayQuery="SELECT * FROM admin_panel ORDER BY datetime DESC LIMIT $showPostFrom, 3";
					}else{
						$displayQuery="SELECT * FROM admin_panel ORDER BY datetime DESC LIMIT 0, 3";
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
							<p><?php 
								if(strlen($post) > 150){
									$post=substr($post, 0, 150)."...";
								}
								echo $post; ?>
							</p>
						</figcaption>
					</figure>
					<a href="fullpost.php?id=<?php echo $id; ?>"><span class="btn btn-info" style="float: right;">Read More &rsaquo;&rsaquo;</span></a>
				</div>

				<br>

				<?php } ?>

				<?php 
				if(isset($_GET["Page"])){
				$totalQuery="SELECT COUNT(*) FROM admin_panel";
				$executeTotalQuery=mysqli_query($Connection, $totalQuery);
				$dataRow=mysqli_fetch_array($executeTotalQuery);
				$totalPosts=array_shift($dataRow);

				$postPagination=ceil($totalPosts/3);
				?>

				<nav aria-label="Page navigation">
				  <ul class="pagination">
				    <li class="page-item">
				    	<?php 
				    		if($_GET["Page"] > 1) {
				   		?>
					      	<a class="page-link" href="blog.php?Page=<?php $page=$_GET["Page"] - 1; echo $page;?>" aria-label="Previous">
					      					
					        <span aria-hidden="true">&laquo;</span>
					        <span class="sr-only">Previous</span>
					      </a>
				       <?php } ?>	
				    </li>
				    <?php for ($i=1; $i <= $postPagination ; $i++) {  ?>
				    <li class="page-item"><a class="page-link" href="blog.php?Page=<?php echo $i?>"><?php echo $i?></a></li>
				    <?php }?>
				    <?php 
				    	if($_GET["Page"] != $postPagination) {
				   	?>
					      <a class="page-link" href="blog.php?Page=<?php $page=$_GET["Page"] + 1; echo $page;?>" aria-label="Next">
					        <span aria-hidden="true">&raquo;</span>
					        <span class="sr-only">Next</span>
					      </a>
				  <?php }?>
				    </li>
				  </ul>
				</nav>
			<?php }?>
			</div>

			<div class="offset-lg-1 col-lg-3 offset-md-1 col-md-3 col-sm-2">
				<h2>About Me</h2>
				<img class="img-fluid rounded-circle" style="max-width: 100%; height: auto;" src="images/me.jpg">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam fermentum nunc malesuada nibh posuere, at fermentum ex eleifend. Fusce a nisi feugiat, consectetur est vitae, sagittis nisl. In suscipit quis augue a pellentesque. Nam est est, iaculis sed felis sit amet, porta scelerisque dui. Quisque tempor varius molestie. Fusce ac vulputate ipsum. Donec egestas vehicula orci, quis suscipit justo vehicula at. Praesent eget ipsum commodo, sodales velit ac, laoreet est.</p>

				<div class="card mb-3" style="max-width: 18rem;">
					<div class="card-header">Categories</div>
					<div class="card-body">
						<h5 class="card-title">List Of Categories:</h5>
						<?php 
							$categoryQuery="SELECT name FROM category ORDER BY datetime DESC";
							$Execute=mysqli_query($Connection, $categoryQuery);

							while($dataRowsCategory=mysqli_fetch_array($Execute)){
								$name=$dataRowsCategory["name"];
						?>
							<a href="blog.php?Category=<?php echo $name?>"><span style="display: block;"><?php echo$name?></span></a>
						<?php }?>
					</div>
				    <div class="card-footer">Footer</div>
				</div>



				<div class="card mb-3" style="max-width: 18rem;">
					<div class="card-header">Recent Posts</div>
					<div class="card-body">
						<h5 class="card-title">Recent Added Posts:</h5>
						<?php
							$postQuery="SELECT * FROM admin_panel ORDER BY datetime DESC LIMIT 0, 5";
							$Execute=mysqli_query($Connection, $postQuery);
							while($dataRowsPost=mysqli_fetch_array($Execute)){
								$id=$dataRowsPost["id"];
								$title=$dataRowsPost["title"];
								$datetime=$dataRowsPost["datetime"];
								$image=$dataRowsPost["image"];
						?>
							<img class="float-left" style="margin-top: 10px; margin-right: 10px; height: 90px; width: 90px;" src="upload/<?php echo $image?>">
							<a href="fullpost.php?id=<?php echo $id?>">
								<p id="heading" style="margin-left: 90px;"><?php echo $title?></p>
							</a>
							<p class="description" style="margin-left: 90px;"><?php echo $datetime?></p> 
							<hr>
						<?php } ?>
					</div>
				    <div class="card-footer">Footer</div>
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





