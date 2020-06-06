<?php
    include('pages_source/header.php');
    if(isset($_POST['conexion'])){
    $sql="SELECT * from membres where email='{$_POST['email']}' AND password={$_POST['psw']}";
    $req=mysqli_query($con,$sql);
    $row=mysqli_num_rows($req);
    if($row!=0){
        $tab=mysqli_fetch_assoc($req);
        $_SESSION['login']=$tab['id_membre'];
        
    }
    else echo"<script>alert('mot de passe ou login est incorrect !!')</script>";
    echo"<script>window.location.href('index.php')</script>";
    }
    
?>

<div class="container">
    <div class="row">
        <div class="col-md-offset-5 col-md-3">
            <form method="POST">
            <div class="form-login">
            <h4>Welcome </h4>
            <input type="email" required id="email" name="email" class="form-control input-sm chat-input" placeholder="email" />
            </br>
            <input type="password" required name="psw" id="userPassword" class="form-control input-sm chat-input" placeholder="password" />
            </br>
            <div class="wrapper">
            <span class="group-btn">     
            <input type="submit" class="btn btn-primary btn-md" name="conexion" value="se connecter">
            </span>
            </div>
</form> 
            </div>
            </div>
        
        </div>
    </div>
</div>
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