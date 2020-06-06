<?php 
	session_start();
	
	$con=mysqli_connect("localhost","root","","e-commerce");
	if(isset($_GET['deconx'])){
		unset($_SESSION['login']);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Krypton store</title>

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
	
	<style>
.container {
    margin-top: 50px;
    margin-bottom: 50px
}
.badge {
        background-color: green;
    }
    .botbar{
        height: 50px;
    }
    .navbar-expand{
        height: 100px;
    }
.card-product-list,
.card-product-grid {
    margin-bottom: 0
}

.card {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 0.10rem;
    margin-top: 10px
}

.card-product-grid:hover {
    -webkit-box-shadow: 0 4px 15px rgba(153, 153, 153, 0.3);
    box-shadow: 0 4px 15px rgba(153, 153, 153, 0.3);
    -webkit-transition: .3s;
    transition: .3s
}

.card-product-grid .img-wrap {
    border-radius: 0.2rem 0.2rem 0 0;
    height: 220px
}

.card .img-wrap {
    overflow: hidden
}

.card-lg .img-wrap {
    height: 280px
}

.card-product-grid .img-wrap {
    border-radius: 0.2rem 0.2rem 0 0;
    height: 228px;
    padding: 16px
}

[class*='card-product'] .img-wrap img {
    height: 100%;
    max-width: 100%;
    width: auto;
    display: inline-block;
    -o-object-fit: cover;
    object-fit: cover
}

.img-wrap {
    text-align: center;
    display: block
}

.card-product-grid .info-wrap {
    overflow: hidden;
    padding: 18px 20px
}

[class*='card-product'] a.title {
    color: #212529;
    display: block
}

.rating-stars {
    display: inline-block;
    vertical-align: middle;
    list-style: none;
    margin: 0;
    padding: 0;
    position: relative;
    white-space: nowrap;
    clear: both
}

.rating-stars li.stars-active {
    z-index: 2;
    position: absolute;
    top: 0;
    left: 0;
    overflow: hidden
}

.rating-stars li {
    display: block;
    text-overflow: clip;
    white-space: nowrap;
    z-index: 1
}

.card-product-grid .bottom-wrap {
    padding: 18px;
    border-top: 1px solid #e4e4e4
}


</style>
</head>
<body>
<?php
if(isset($_SESSION['login'])){
	$id=$_SESSION['login'];
$sql="SELECT * from membres where id_membre=$id";
$tab=mysqli_fetch_assoc(mysqli_query($con,$sql));

?>
<header>
	<!-- Start Middle Navigation Bar -->
	<nav class="navbar navbar-expand bg-primary">
		<div class="container ">

			<div class="logo" style="margin-right:50px !important;">
				<a class="navbar-brand" href="index.php"><img src="pages_source/img/logo.png" alt="Biougnach" title="Biougnach" width=50 height=50></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			</div>
			
			<div class="collapse navbar-collapse col-sm-10" id="navbarSupportedContent">
				
				<form class="form-inline my-2 my-lg-0 col-sm-8 midsearch" method="GET"" style="margin-left:100px;">
					<input class="form-control col-sm-6" type="search" name="rechercher" placeholder="Recherche...">
					<button class="btn col-sm-0" type="submit" name="rech"><i class="fa fa-search" style="color: white;"></i></button>
				</form>
				 
				<ul class="navbar-nav ml-auto" style="margin-right:100px;">
					<li>
						<form method="get" action="panier.php">
							<button  class="btn btn-primary" style="height:60px;" type="submit"><i class="fa fa-shopping-cart"></i><br>  Panier
						<?php
							$count=0;
							if(isset($_SESSION['pannier'])){
								$count=count($_SESSION['pannier']);
							}
							echo"<div class='badge'>$count</div>"
						?>
						</button>
						</form>
					</li>
					&nbsp
				
					<li>
					<div class="dropdown">
						<form method="GET">
							<?php echo"<img src='pages_source/img/avatar/{$tab['avatar']}' style='border-radius:20px 20px 20px 20px; ' 
							width='60' height='60' data-toggle='dropdown' class='avatar  dropdown-toggle aria-haspopup='true' aria-expanded='false' '>"?>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="index.php?deconx">
							Deconection
						</a>
						<a class="dropdown-item" href="profile.php">Profile</a>
						<?php if($tab['qualite']!=0) 
						echo "<a class='dropdown-item' href='admin.php'>administration</a>";
						?>

						</div>
						</form>
						</div>
					</li>
					
				</ul>
			</div>
			</div>

		</div>
	</nav>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark botbar">
		<div class="container">
			<ul class="navbar-nav ml-auto col">
				<li class="nav-item">
					<a class="nav-link" href="index.php"><i class="fa fa-home"></i></a>
				</li>

				<?php
					$SQL = "SELECT * FROM categories ORDER BY categorie";
					$req = $con -> Query($SQL);
					while($categs = $req -> fetch_array()) {
						echo "
							<li class=\"nav-item category\">
								<a class=\"nav-link\" href=\"index.php?id_categorie={$categs['id_categorie']}\">| {$categs['categorie']}</a>
							</li>
						";
					}
				?>
			</ul>
		</div>
	</nav>
	<!-- End Bottom Navigation Bar -->
</header>
<?php
}
?>

<!--/////////////////////////////////////-->
	<?php
if(!isset($_SESSION['login'])){
?>
<!-- Start Header -->
<header>

	<!-- Start Top Navigation Bar -->

	<!-- End Top Navigation Bar -->
	

	<!-- Start Middle Navigation Bar -->
	<nav class="navbar navbar-expand bg-primary">
		<div class="container ">

			<div class="logo" style="margin-right:50px !important;">
				<a class="navbar-brand" href="index.php"><img src="pages_source/img/logo.png" alt="Biougnach" title="Biougnach" width=150 height=80></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			</div>
			
			<div class="collapse navbar-collapse col-sm-10" id="navbarSupportedContent">
				
				<form class="form-inline my-2 my-lg-0 col-sm-8 midsearch" method="GET" style="margin-left:100px;">
					<input class="form-control col-sm-6" type="search" name="rechercher" placeholder="Recherche...">
					<button class="btn col-sm-0" type="submit" name="rech"><i class="fa fa-search" style="color: white;"></i></button>
				</form>
				 
				<ul class="navbar-nav ml-auto" style="margin-right:100px;">
					<li>
						<form method="get" action="panier.php">
							<button  class=" panierBtn btn btn-primary" style="height:60px;" type="submit"><i class="fa fa-shopping-cart"></i><br>  Panier
						<?php
							$count=0;
							if(isset($_SESSION['pannier'])){
								$count=count($_SESSION['pannier']);
							}
							echo"<div class='badge'>$count</div>"
						?>
						</button>
						</form>
					</li>
					&nbsp
					<li>
					<div class="dropdown">
					<button class="btn btn-secondary bg-info dropdown-toggle" style="height: 60px;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Authentifier
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" href="login.php">se connecter</a>
							<a class="dropdown-item" href="register.php">register</a>
						</div>
						</div>
					</li>
				</ul>

			</div>

		</div>
	</nav>
	<!-- End Middle Navigation Bar -->
	

	<!-- Start Bottom Navigation Bar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark botbar">
		<div class="container">
			<ul class="navbar-nav ml-auto col">
				<li class="nav-item">
					<a class="nav-link" href="index.php"><i class="fa fa-home"></i></a>
				</li>

				<?php
					$SQL = "SELECT * FROM categories ORDER BY categorie";
					$req = $con -> Query($SQL);
					while($categs = $req -> fetch_array()) {
						echo "
							<li class=\"nav-item category\">
								<a class=\"nav-link\" href=\"index.php?id_categorie={$categs['id_categorie']}\">| {$categs['categorie']}</a>
							</li>
						";
					}
				?>
			</ul>
		</div>
	</nav>
	<!-- End Bottom Navigation Bar -->
</header>
<?php
}
?>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/backend.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.zoom.min.js"></script>
    <script src="js/jquery.dd.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>