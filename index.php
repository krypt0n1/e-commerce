<?php
include ('pages_source/header.php');
?>

<?php
    function afficherArticles($tab){
        echo "
        <div class='row'>
            <div class=''>
                <figure class='card card-product-grid card-lg'> <a href='articles.php?plus={$tab['id_produit']}' class='img-wrap' data-abc='true'><img src='images/{$tab['vignette']}'></a>
                <figcaption class='info-wrap'>
                <div class='row'>
                <div class=''> <a href='articles.php?plus={$tab['id_produit']}' class='title' data-abc='true'>{$tab['label']}</a> 
                </div>
                <div class=''>
                            <div class='rating text-right'> <i class='fa fa-star'></i> <i class='fa fa-star'></i> <i class='fa fa-star'></i> 
                            </div>
                        </div>
                </div>
                </figcaption>
                <div class='bottom-wrap'> <a href='articles.php?plus={$tab['id_produit']}' class='btn btn-primary float-right' data-abc='true'> Buy now </a>";
                if(is_null($tab['tauxpromotion']))
                echo"
                    <div class='price-wrap'> <span class='price h5'>{$tab['prix']} DH</span> <br> <small class='text-success'>Free shipping</small> </div>";
                else{
                    $prix=$tab['prix']-$tab['prix']*$tab['tauxpromotion']/100;
                    echo "<div class='price-wrap'> <span class='price h5'><s>{$tab['prix']} DH</s></span> <span class='price h5'>$prix DH</span> <br> <small class='text-success'>Free shipping</small> </div>";
                }
                echo"    
                </div>
                </figure>
            </div>
        </div>
        ";
    }
    function afficherArticles2($tab){
        echo "
        <div class='row'>
            <div class=''>
                <figure class='card card-product-grid card-lg'> <a href='articles.php?plus={$tab['product_id']}' class='img-wrap' data-abc='true'><img src='images/{$tab['vignette']}'></a>
                <figcaption class='info-wrap'>
                <div class='row'>
                <div class=''> <a href='articles.php?plus={$tab['product_id']}' class='title' data-abc='true'>{$tab['label']}</a> 
                </div>
                <div class=''>
                            <div class='rating text-right'> <i class='fa fa-star'></i> <i class='fa fa-star'></i> <i class='fa fa-star'></i> 
                            </div>
                        </div>
                </div>
                </figcaption>
                <div class='bottom-wrap'> <a href='articles.php?plus={$tab['product_id']}' class='btn btn-primary float-right' data-abc='true'> Buy now </a>";
                if(is_null($tab['tauxpromotion']))
                echo"
                    <div class='price-wrap'> <span class='price h5'>{$tab['prix']} DH</span> <br> <small class='text-success'>Free shipping</small> </div>";
                else{
                    $prix=$tab['prix']-$tab['prix']*$tab['tauxpromotion']/100;
                    echo "<div class='price-wrap'> <span class='price h5'><s>{$tab['prix']} DH</s></span> <span class='price h5'>$prix DH</span> <br> <small class='text-success'>Free shipping</small> </div>";
                }
                echo"    
                </div>
                </figure>
            </div>
        </div>
        ";
    }


?>
<?php
    //rechercher
 if(isset($_GET['rech'])){
        $mot=$_GET['rechercher'];
		$sql="SELECT a.id_produit as product_id,label,prix,quantite,vignette,tauxpromotion FROM stock a 
		LEFT JOIN promotion p ON a.product_id = p.id_produit
        where label like '%$mot%'
        GROUP BY a.product_id";
		$req=mysqli_query($con,$sql) or die("erreur req");
		while($tab=mysqli_fetch_assoc($req)){
            afficherArticles2($tab);
		}
	}  
//afficher article appartient a une categorie

if(isset($_GET['id_categorie'])){

    $SQL = "SELECT a.id_produit as product_id,label,prix,quantite,vignette,tauxpromotion FROM 
    stock a LEFT JOIN promotion p ON a.id_produit  = p.id_produit
    where a.id_categorie={$_GET['id_categorie']}
	ORDER by date_creation DESC LIMIT 4";
            $req = mysqli_query($con,$SQL);
            $sql="SELECT * FROM categories where id_categorie={$_GET['id_categorie']}";
        $tab=mysqli_fetch_assoc(mysqli_query($con,$sql));
        
        echo"<div class='container'><h3><u>{$tab['categorie']}</u></h3></div>";
            echo"<div class='container d-flex justify-content-center justify-content-around'>";

            while($tab=mysqli_fetch_assoc($req)) {
              
                afficherArticles2($tab);
                
            }
            echo"</div>";
        
}

if(!isset($_GET['id_categorie'])){
    $con=mysqli_connect("localhost","root","","e-commerce");
    $sql = "SELECT * FROM stock NATURAL JOIN promotion WHERE now() BETWEEN datedebut AND datefin ORDER BY tauxpromotion DESC LIMIT 4";
    
    $req = mysqli_query($con,$sql);
    echo "<div class='container'><H3><u>Notre Promotions</u></H3>";
    echo "<div class='container d-flex justify-content-center justify-content-around'>";
    while($tab=mysqli_fetch_assoc($req)){	 
        afficherArticles($tab);
    }
    
    echo "</div></div>";


//Nouveaux Articles 
$sql="SELECT a.id_produit as product_id,label,prix,quantite,vignette,tauxpromotion FROM stock a LEFT JOIN promotion p ON a.id_produit  = p.id_produit
	ORDER by date_creation DESC LIMIT 4";
	$req=mysqli_query($con,$sql);
echo "<div class='container'><H3><u>Nouveaux Articles</u></H3>";
echo "<div class='container d-flex justify-content-center justify-content-around'>";
while($tab2=mysqli_fetch_assoc($req)){
	afficherArticles2($tab2);
	
}
	echo "</div></div>";
 
//afficher les articles les plus ventes

	$sql="SELECT stock.id_produit id_produit,label,vignette,stock.prix prix,tauxpromotion,count(detail.id_produit) AS nbVentes FROM stock 
    INNER JOIN detail ON stock.id_produit=detail.id_produit
    LEFT JOIN promotion ON stock.id_produit=promotion.id_produit   
    GROUP BY stock.id_produit ORDER BY nbVentes DESC LIMIT 4";
    
echo "<div class='container'><H3><u>Plus Ventes</u></H3>";
echo"<div class='container d-flex justify-content-center justify-content-around'>";
$req=mysqli_query($con,$sql);
while($tab=mysqli_fetch_assoc($req)){
afficherArticles($tab);
}
echo"</div></div>";


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
    
    <script src="pages_source/js/jquery-3.3.1.min.js"></script>
    <script src="pages_source/js/bootstrap.min.js"></script>
    <script src="pages_source/js/jquery-ui.min.js"></script>
    <script src="pages_source/js/jquery.countdown.min.js"></script>
    <script src="pages_source/js/jquery.nice-select.min.js"></script>
    <script src="pages_source/js/jquery.zoom.min.js"></script>
    <script src="pages_source/js/jquery.dd.min.js"></script>
    <script src="pages_source/js/jquery.slicknav.js"></script>
    <script src="pages_source/js/owl.carousel.min.js"></script>

