<?php
include ('pages_source/header.php');
?>
<br><br>
<center>
<div class="container justify-content ">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Please sign up </h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="POST">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                <input type="text" name="nom" id="first_name" class="form-control input-sm" placeholder="First Name">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="prenom" id="last_name" class="form-control input-sm" placeholder="Last Name">
			    					</div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="adresse" id="password_confirmation" class="form-control input-sm" placeholder="adresse">
			    					</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="pays"  class="form-control input-sm" placeholder="pays">
			    					</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="ville"  class="form-control input-sm" placeholder="ville">
									</div>
								</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="zipcode"  class="form-control input-sm" placeholder="zipcode">
									</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="file" name="avatar"  class="form-control input-sm" placeholder="avatar">
			    					</div>
			    				</div>
			    			</div>
			    			
			    			<input type="submit" value="Register" name="ok" class="btn btn-info btn-block">
			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
	</div>
</center>
<?php
	if(isset($_POST['ok'])){
		$pass=base64_encode($_POST['password']);
		$sql="INSERT INTO membres VALUES(NULL,'{$_POST['nom']}','{$_POST['prenom']}'
		,'{$_POST['email']}','$pass','{$_POST['adresse']}','{$_POST['pays']}'
		,'{$_POST['ville']}','{$_POST['zipcode']}','{$_POST['avatar']}',0)";
		$req=mysqli_query($con,$sql);
	}
?>
<?php
    include ('pages_source/footer.php');
?>

<link rel="stylesheet" href="pages_source/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="pages_source/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="pages_source/css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="pages_source/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="pages_source/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="pages_source/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="pages_source/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="pages_source/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="pages_source/css/style.css" type="text/css">
<script src="pages_source/js/jquery-3.3.1.min.js"></script>
<script src="pages_source/js/bootstrap.min.js"></script>
<script src="pages_source/js/backend.js"></script>