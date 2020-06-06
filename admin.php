<?php
 // include ('pages_source/header.php');
?>
<?php
 $con=mysqli_connect("localhost","root","","e-commerce");

 //REMOVE CATEGORIE //
      if(isset($_GET['rem'])){
      $sql="DELETE FROM categories where id_categorie={$_GET['rem']}";
      $req=mysqli_query($con,$sql);
      }
//REMOVE ARTICLES //
      if(isset($_GET['remA'])){
        $sql="DELETE FROM stock where id_produit={$_GET['remA']}";
        $req=mysqli_query($con,$sql);
        }
//ADD CATEGORIES //
      if(isset($_POST['Add'])){
          $date= date("Y-m-d");
          $lab=$_POST['lab'];
          $decr=$_POST['desc'];
          $sql="INSERT INTO categories (`id_categorie`, `categorie`, `description`, `date_creation`) 
          Values (NULL,'$lab',' $decr','$date') ";
          $req=mysqli_query($con,$sql) or die ("erreur requ !!");
      }

  //Update Promotion
     /*  if(isset($_GET['updA'])){
            $sql="INSERT INTO promotion (`id_promotion`, `tauxpromotion`, `datedebut`, `datefin`, `id_produit`)
             VALUES (NULL,{$_GET['prom']},'{$_GET['dteD']}','{$_GET['dteF']}',{$_GET['updA']})";
      } */
?>
<div id="main">
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
  <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="admin.php?categories">Categories</a>
  <a href="admin.php?stock">Stock</a>
  <a href="admin.php?promo">Promotion</a>
  <a href="index.php">Retour</a>
  </div>
  <center>
  
<?php
  if(isset($_GET['stock'])){
    if(isset($_GET['save'])){
      $sql="INSERT INTO stock (`id_produit`, `label`, `description`, `prix`,`quantite`,`vignette`,`date_creation`
      ,`id_categorie`) VALUES(NULL,'{$_GET['label']}','{$_GET['descr']}',{$_GET['prix']},{$_GET['qte']},
      '{$_GET['vign']}','{$_GET['dte']}',{$_GET['cat']})";
      $req=mysqli_query($con,$sql) or die("erreur");
    }
    $sql="SELECT * FROM categories order by date_creation desc";
    $req=mysqli_query($con,$sql); 
    echo"
    <div class='container'>
    <form method='POST'>
    <select name='stk' class='form-control'>";
    while($tab=mysqli_fetch_assoc($req)){
    echo"
        <option value='{$tab['id_categorie']}'>{$tab['categorie']}</option> 
    ";
    }
        echo"<input class='btn btn-success' type='submit' name='ok' value='afficher'></form>";
   if(isset($_POST['ok'])){
    $sql="SELECT * FROM stock where id_categorie={$_POST['stk']} order by date_creation desc";
    $req=mysqli_query($con,$sql);
    echo "<center><h2 style='margin-top:15px;'><u>Articles</u> </h2></center>";
    echo "<div class='container'><table class='table'><tr class='bg-info'><th>label</th>
    <th>Description</th><th>prix</th><th>Qauntite</th><th>Vignette</th><th>Date de creation</th>
    <th>Categorie</th><th></th></tr>";
    while($tab=mysqli_fetch_assoc($req)){
      echo"
            <tr><td>{$tab['label']}</td>
            <td>{$tab['description']}</td>
            <td>{$tab['prix']}</td>
            <td>{$tab['quantite']}</td>
            <td><img src='images/{$tab['vignette']}' height=50 width=50></td>
            <td>{$tab['date_creation']}</td>
            <td>{$tab['id_categorie']}</td>
            <td><a href='admin.php?remA={$tab['id_produit']}' class='btn btn-info'>Delete</a></td>
            </tr>
      ";
    }
    echo"</table></div> <hr>";
?>

<div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Nouveau Article</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="GET">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               Label: <input type="text" name="label" id="first_name" class="form-control input-sm" placeholder="PC">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
                      Description :
			    					<textarea name="descr" placeholder="pc gamer ......">

                    </textarea>
			    					</div>
			    				</div>
			    			</div>

			    			<div class="form-group">
                  Prix:
			    				<input type="number" min=1 name="prix"  class="form-control input-sm" placeholder="100">
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
                      Quantite :
			    						<input type="number" min=1 name="qte"  class="form-control input-sm" placeholder="60">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="file" name="vign"  class="form-control input-sm" placeholder="image.jpg">
			    					</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
                      Date :
			    						<input type="date" name="dte"  class="form-control input-sm" placeholder="pays">
			    					</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="hidden" name="cat"  class="form-control input-sm" value="<?php echo"{$_POST['stk']}";?>">
									</div>
								</div>
			    			<input type="submit" value="Valider" name="save" class="btn btn-Success btn-block">
			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
	</div>  
  <?php
  }
 
  include ('pages_source/footer.php');
  }
//////////////////////////////////
    if(isset($_GET['promo'])){
      $sql="SELECT * FROM categories order by date_creation desc";
      $req=mysqli_query($con,$sql); 
      echo"
      <div class='container'>
      <form method='POST'>
      <select name='stk' class='form-control'>";
      while($tab=mysqli_fetch_assoc($req)){
      echo"
          <option value='{$tab['id_categorie']}'>{$tab['categorie']}</option> 
      ";
      }
          echo"<input class='btn btn-success' type='submit' name='ok' value='afficher'></form>";
     if(isset($_POST['ok'])){
      $sql="SELECT * FROM stock  as s LEFT JOIN promotion as p ON s.id_produit=p.id_produit where s.id_categorie={$_POST['stk']} order by date_creation desc";
      $req=mysqli_query($con,$sql);
      echo "<center><h2 style='margin-top:15px;'><u>Gestion Promotion</u> </h2></center>";
      echo "<div class='container'><table class='table'><tr class='bg-info'><th>label</th>
      <th>prix</th><th>Qauntite</th><th>Vignette</th>
      <th>Date debut</th><th>Date fin</th><th>Promotion</th><th></th></tr>";
      while($tab=mysqli_fetch_assoc($req)){
        echo"
              <tr><td>{$tab['label']}</td>
              <td>{$tab['prix']}</td>
              <td>{$tab['quantite']}</td>
              <td><img src='images/{$tab['vignette']}' height=50 width=50></td>
              <form method='GET'>
              <td><input type='date' name='dteD' class='form-control col-md-9'></td>
              <td><input type='date' name='dteF' class='form-control col-md-9'></td>
              <td><input type='number' name='prom' class='form-control col-md-5' min=0 paleceholder='90%'></td>
              <td><input type='submit' class='btn btn-warning' name='updA' value='promo' > <input type='hidden' name='id' value='{$tab['id_produit']}'>
              </td>
              </tr>
              </form>
        ";
      }
      echo"</table></div> <hr>";
      include ('pages_source/footer.php');

    }
  }

//////////////////////////////
    if(isset($_GET['categories'])){
      $sql="SELECT * FROM categories";
      $req=mysqli_query($con,$sql);
      echo "<center><h2 style='margin-top:15px;'><u>All categories</u> </h2></center>";
      echo "<div class='container'><table class='table'><tr class='bg-primary'><th>Categories</th>
      <th>Description</th><th>Date de creation</th><th></th></tr>";
      while($tab=mysqli_fetch_assoc($req)){
        echo"
              <tr><td>{$tab['categorie']}</td>
              <td>{$tab['description']}</td>
              <td>{$tab['date_creation']}</td>
              <td><a href='admin.php?rem={$tab['id_categorie']}' class='btn btn-danger'> Remove </a></td>
              </tr>
        ";
      }
      echo"</table></div> ";
  
      echo"
      <form method='Post'>
      <h5 class='modal-title' id='exampleModalLabel'>New Categories</h5>
    
    <div class='modal-body'>
        <div class='form-group'>
          <label for='recipient-name' class='col-form-label'>Label:</label>
          <input type='text' name='lab' class='form-control col-md-4' id='recipient-name'>
        </div>
        <div class='form-group'>
          <label for='message-text' class='col-form-label '>Description:</label>
          <textarea name='desc' class='form-control col-md-4' id='message-text'></textarea>
        </div>

        <input type='submit' name='Add'  class='btn btn-success' value='Ajouter une Categorie'>
 </form>
</center>
</div>";
include ('pages_source/footer.php');

}  
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #0984e3;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: white;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

#main {
  transition: margin-left .5s;
  padding: 16px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>
<body>



<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>

</body>


</html> 



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