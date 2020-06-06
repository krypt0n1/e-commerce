<?php

include ('pages_source/header.php');

if(isset($_GET['checkout'])){

    if(isset($_SESSION['login']) && $_SESSION['pannier']!=""){
    $sql="SELECT * FROM membres where id_membre={$_SESSION['login']}";
    $date = date('Y-m-d');
    $req=mysqli_query($con,$sql) or die("erreur 1");
    $tab=mysqli_fetch_assoc($req);
        $sql2="INSERT INTO command
         VALUES (NULL,'$date',{$tab['id_membre']},'{$tab['adresse']}',0,1)";
        $req2=mysqli_query($con,$sql2) or die("erreur 2");

        for($i=0;$i<count($_SESSION['pannier']);$i++){               
            $sql = "SELECT * FROM stock a LEFT JOIN promotion p NATURAL JOIN photos ph ON 
            a.id_produit = p.id_produit WHERE a.id_produit = {$_SESSION['pannier'][$i]['ida']}";
            $req = mysqli_query($con,$sql);
            $tab=mysqli_fetch_assoc($req) or die("erreur 3");
            $idart = $_SESSION['pannier'][$i]['ida'];
            $qnt = $_SESSION['pannier'][$i]['qte'];
            $prix = $_SESSION['pannier'][$i]['prix'];
            $idcmd=mysqli_insert_id($con);
            $_SESSION['id_comm']=$idcmd;                 
            $req="INSERT INTO detail values(NULL,'$qnt','$prix','$idart','$idcmd')";
            mysqli_query($con,$req);
  
            $qstock = $tab['quantite'];                              
            $newqt = $qstock-$qnt;
                                
            $sql2="UPDATE stock a SET quantite = $newqt 
            WHERE a.id_produit= {$_SESSION['pannier'][$i]['ida']}";
                                
            mysqli_query($con,$sql2) or die("erreur 4");
  
  
                              
          }
          unset($_SESSION['pannier']);
        echo"<script>alert('votre commande est bien faite !!')</script>";
        echo"<script>window.open('bon_commande.php')</script>";
    }
    else echo"<script>alert('Vous devez se connecter !!')</script>";
}


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



 <script src="pages_source/js/jquery-3.4.1.min.js"></script>
<script src="pages_source/js/bootstrap.min.js"></script>
<script src="pages_source/js/main.js"></script>
         

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">remove</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    //recalculer
                  if(isset($_GET['recalculer'])){
                    for($i=0;$i<count($_GET['nqte']);$i++){
                        $_SESSION['pannier'][$i]['qte']=$_GET['nqte'][$i];
                    }

                  }
                    
                    //vider le panier
                    if(isset($_GET['vider'])){
                        unset($_SESSION['pannier']);
                    }
                    if(isset($_SESSION['pannier']) && $_SESSION['pannier']!=null){
                       
                    $allprix=0;
                        //remove article
                    if (isset($_GET['sup'])) {
                        $sup=$_GET['sup'];
                        array_splice($_SESSION['pannier'],$sup,1);
                    }
                   
                    for($i=0;$i<count($_SESSION['pannier']);$i++) {
                    $sql = "SELECT * FROM stock s LEFT JOIN promotion p NATURAL JOIN photos ph ON s.id_produit = p.id_produit 
                    WHERE s.id_produit ={$_SESSION['pannier'][$i]['ida']}";
                  $con = mysqli_connect("localhost","root","","e-commerce") or die("erreur conx");
                              $req = mysqli_query($con,$sql) or die("erreur requete");
                              $tab=mysqli_fetch_assoc($req);
                    echo"
                    <tr>
                        <td class='col-sm-8 col-md-6'>
                        <div class='media'>
                            <a class='thumbnail pull-left' style='width: 80px; height: 40px;'  href='#'>    
                             
                                  
                                 <img class='d-block w-100' src='images/{$tab['vignette']}' style='width: 300px; height: 70px;'>
                                
                                  
                                 </a>
                            <div class='media-body'>
                                <h4 class='media-heading'><a href='#'>Product name</a></h4>
                                <h5 class='media-heading'> by <a href='#'>{$tab['label']}</a></h5>
                                <span>Status: </span><span class='text-success'><strong>In Stock</strong></span>
                            </div>
                        </div></td>
                        <form method='get'>
                        <td class='col-sm-1 col-md-1' style='text-align: center'>
                        <input type='number' min='1' max='{$tab['quantite']}' class='form-control' name='nqte[]'  value='{$_SESSION['pannier'][$i]['qte']}'>
                        </td>
                        <td class='col-sm-1 col-md-1 text-center'><strong>
                        ";
                        
                            echo"{$_SESSION['pannier'][$i]['prix']}DH";

                        $total=$_SESSION['pannier'][$i]['qte']*$_SESSION['pannier'][$i]['prix'];
                        echo"
                        </strong></td>
                        <td class='col-sm-1 col-md-1'>
                        
                        <a href='panier.php?sup=$i'>
                       <center>   <i class='fa fa-trash-alt'></i></a>      </center>
                        </td>
                        
                        
                      
                    </tr>";
                    $allprix+=$total;           
                        }
                        echo"
                        <tr>
                        <td></td><td></td><td><td></td><td class='col-sm-2 col-md-2 text-center'>
                       <b>PRIX  TOTALE  </b>
                        </td>
                        </tr>
                        <tr>
                        <td></td><td></td><td><td></td><td class='col-sm-1 col-md-1 text-center'>
                           <b><h5>$allprix DH</h5></b>
                        </td>
                        </tr>
                          ";   
                    
                                    ?>
               
                  
                           
                        <td>
                        <td>
                            
                        <button type='submit' name='checkout' value="checkout" class='btn btn-success' data-toggle='modal' data-target='#exampleModal'>
                            <span class='glyphicon glyphicon-remove'>
                            </span>Checkout</a>
                        </button>
                        </td>
                            <td>
                            
                            <button type='submit' name='recalculer' value="recalculer" class='btn btn-warning'  data-toggle="modal" data-target="#myModal">
                                <span class='glyphicon glyphicon-remove'></span>recalculer</a>
                            </button>
                        </td>
                            <td>
                            
                        <button type='submit' name='vider' value="vider" class='btn btn-danger'>
                            <span class='glyphicon glyphicon-remove'></span>vider</a>
                        </button>
                    </td>
                        </form>
                            </td>
                  
                        <?php
                    }
                    ?>
    
    <div class="container">
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>


                        
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

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