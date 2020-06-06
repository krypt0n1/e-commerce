<?php
	include ('pages_source/header.php');
?>
 <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="pages_source/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="pages_source/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="pages_source/css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="pages_source/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="pages_source/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="pages_source/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="pages_source/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="pages_source/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="pages_source/css/style.css" type="text/css">

  <?php 

if(isset($_GET['plus'])) {

	$sql = "SELECT * FROM stock a LEFT JOIN promotion p NATURAL JOIN photos ph 
	ON a.id_produit = p.id_produit WHERE a.id_produit = {$_GET['plus']}";
	?>
	
	
	<br><br><br>
		<div class="container">
			<div class="card">
				<div class="container-fliud">
					<div class="wrapper row">
						<div class="preview col-md-6">
	
							<div class="preview-pic tab-content">
	
	
	
								<!------ Include the above in your HEAD tag ---------->
	
								<div class="container">
									<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
										<ol class="carousel-indicators">
											<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
											<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
											<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
										</ol>
										<div class="carousel-inner">
											<div class="carousel-item active">
												<?php
								  $req = mysqli_query($con,$sql);
								  $tab=mysqli_fetch_assoc($req);
									  echo"
									 <img class='d-block w-100' style='height:350px' src='images/{$tab['vignette']}'>
									
									  ";
									 ?>
											</div>
	
											<?php
								  
									  echo"
									  <div class='carousel-item'>
									 <img class='d-block w-100' style='height:350px' src='pages_source/img/product/{$tab['vignette']}'>
									  </div>
									  ";
									 ?>
	
										</div>
										<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="sr-only">Previous</span>
										</a>
										<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="sr-only">Next</span>
										</a>
									</div>
								</div>
	
							</div>

							<ul class="preview-thumbnail nav nav-tabs">
	
							</ul>
	
						</div>
						
						<div class="details col-md-6">
							<h3 class="product-title">
								<?php
								   
									  echo"
									  {$tab['label']}
									  
									  ";
									 ?>
							</h3>
							<br>
							<p class="product-description">
		
								<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-scrollable" role="document">
										<div class="modal-content">

											<div class="modal-body">
												<?php
								$sql="SELECT * FROM description d NATURAL JOIN stock a WHERE d.id_produit = {$_GET['plus']}";
								$req = mysqli_query($con,$sql);
								  $tab=mysqli_fetch_assoc($req);
								
							  echo $tab['definition'];                        
							?>
											</div>
											
										</div>
									</div>
								</div>
	
							</p>
							<h4 class="price">prix d'article: <span>
	
									<?php
								$price=0;
								
								 $sql1 = "SELECT * FROM stock a LEFT JOIN promotion p 
								 ON a.id_produit = p.id_produit WHERE a.id_produit = {$_GET['plus']}";
								
								  $req1 = mysqli_query($con,$sql1);
								  $tab1=mysqli_fetch_assoc($req1);
								
					$prixpromotion=$tab1['prix']-$tab1['prix']*$tab1['tauxpromotion']/100;
									  if(is_null($tab1['tauxpromotion'])){
										  $prix = $tab1['prix'];
			 echo"
			{$tab1['prix']} DH
			 <br><br>";
			 
			}
		else{
			$prix = $prixpromotion;
			echo"
	  <s style='color:red;'>{$tab1['prix']} DH </s>{$prixpromotion} DH
		";
				}
				echo"<br><br>{$tab1['quantite']}<span class='text-success'><strong> In STOCK</strong></span>";
        
									 ?>
								</span></h4>			 
								<br>
							<div class="action">
								<form method="post">
									<h4>
									<?php
									echo"	<label>Qantite :</label> <input min='1' type='number' max='{$tab1['quantite']}' name='qte' required>"; ?>
										<?php
										echo"<label></label> <input type='hidden' name='id' value='{$_GET['plus']}'>";
										?>
									</h4>
									<?php 
									if($tab1['quantite']>0) {
									echo"
									<input type='submit' name='add' class='btn btn-primary' value='add to cart'>";
									}
									else{	
										echo"<span class='text-danger'><strong>Out of Stock</strong></span>";}
									?>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<div class='container'>
		<table class="table table-striped">
			<u><h3>Description</h3></u>
			<tr>
				<td class="">Items</td><td class="">description</td>
			</tr>
				
			<?php
			
			$sql="SELECT * FROM description d NATURAL JOIN stock a 
			WHERE d.id_produit = {$_GET['plus']}";
			$req=mysqli_query($con,$sql);
			while($tab=mysqli_fetch_assoc($req)){
			echo"<tr><td>{$tab['element']}</td><td>{$tab['definition']}</td></tr>";
		}
		echo"</tr></table>";
			?>
	</div>
		<?php
	   
	
		  if(isset($_POST['add'])){
			   $taille = 0;
				/////////////////////////////////////////
			  if(isset($_SESSION['pannier'])){
				$taille = count($_SESSION['pannier']);
				foreach($_SESSION['pannier'] as $key => $val)
					if($_POST['id']==$_SESSION['pannier'][$key]['ida']){
						$_SESSION['pannier'][$key]['qte']+= $_POST['qte'];
						$_SESSION['pannier'][$key]['ida']= $_POST['id'];
						$_SESSION['pannier'][$key]['prix']= $prix;
						exit();
					}
					
				}
				
				$_SESSION['pannier'][$taille]['ida']= $_POST['id'];
				$_SESSION['pannier'][$taille]['qte']= $_POST['qte'];
				$_SESSION['pannier'][$taille]['prix']= $prix;
			
				
			}
	
	
	}

		  ?>
<?php
    include ('pages_source/footer.php');
?>

 <script src="pages_source/js/jquery-3.3.1.min.js"></script>
    <script src="pages_source/js/bootstrap.min.js"></script>
    <script src="pages_source/js/jquery-ui.min.js"></script>
    <script src="pages_source/js/jquery.countdown.min.js"></script>
    <script src="pages_source/js/jquery.nice-select.min.js"></script>
    <script src="pages_source/js/jquery.zoom.min.js"></script>
    <script src="pages_source/js/jquery.dd.min.js"></script>
    <script src="pages_source/js/jquery.slicknav.js"></script>
    <script src="pages_source/js/owl.carousel.min.js"></script>
    <script src="pages_source/js/main.js"></script>