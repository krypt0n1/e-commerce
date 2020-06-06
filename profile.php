<?php
    include ('pages_source/header.php');
    if(isset($_SESSION['login'])){
        $id=$_SESSION['login'];
    $sql="SELECT * from membres where id_membre=$id";
    $tab=mysqli_fetch_assoc(mysqli_query($con,$sql));
    
    ?>

<style>
.profile-header {
    transform: translateY(5rem);
}

</style>
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
<div class="container">
    <u><h1>Profile de <?php echo"{$tab['nom']}";?></h1></u>
</div>


<div class="row py-5 px-4">
    <div class="col-xl-4 col-md-6 col-sm-10 mx-auto">

        <!-- Profile widget -->
        <div class="bg-white shadow rounded overflow-hidden">
            <div class="px-4 pt-0 pb-4 bg-dark">
                <div class="media align-items-end profile-header">
                    <?php
                    echo"
                    <div class='profile mr-3'><img src='pages_source/img/avatar/{$tab['avatar']}' class='rounded mb-2 img-thumbnail' width='100' height='100'><a href='#' class='btn btn-dark btn-sm btn-block'>Edit profile</a></div>
                    ";
                    ?>
                    
                    <div class="media-body mb-5 text-white">
                        <h4 class="mt-0 mb-0"><?php echo "{$tab['nom']} {$tab['prenom']}"?></h4>
                        <p class="small mb-4"> <i class="fa fa-map-marker mr-2"></i><?php echo"{$tab['adresse']}";?></p>
                    </div>
                </div>
            </div>

            <div class="bg-light p-4 d-flex justify-content-end text-center">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block">241</h5><small class="text-muted"> <i class="fa fa-picture-o mr-1"></i>Photos</small>
                    </li>
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block">84K</h5><small class="text-muted"> <i class="fa fa-user-circle-o mr-1"></i>Followers</small>
                    </li>
                </ul>
            </div>

            <div class="py-4 px-4">
                
                        <ul class="list-inline small text-muted mt-3 mb-0">
                            <li class="list-inline-item"><i class="fa fa-comment-o mr-2"></i>12 Comments</li>
                            <li class="list-inline-item"><i class="fa fa-heart-o mr-2"></i>200 Likes</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- End profile widget -->

    </div>
</div>
<?php
    include ('pages_source/footer.php');
    }
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