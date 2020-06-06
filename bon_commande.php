<?php
  session_start();
  require "pdf/fpdf.php";
			
		class PDF extends FPDF {
			// Page header
			function Header() {
			    // Logo
			    $this->Image('pages_source/img/logo.png',50,10,40);
			    $this->Ln(50);
			}

			// Page footer
			function Footer() {
			    // Position at 1.5 cm from bottom
			    $this->SetY(-15);
			    // Arial italic 8
			    $this->SetFont('Arial','I',8);
			    // Page number
			    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
			    //Return to home page
			    $this->Cell(0,10,"accueil.php",0,0,'R');
			 
			}
		}

		$cnx=mysqli_connect("localhost","root","","e-commerce");
		$req = $cnx -> Query("SELECT * FROM membres WHERE id_membre={$_SESSION['login']}"); 
		$tabClient = $req -> fetch_assoc();
		$clInfos = " Client: {$tabClient['nom']} {$tabClient['prenom']}\n Adresse : {$tabClient['adresse']}";
		$avt = "{$tabClient['avatar']}";


		$pdf = new PDF('P','mm','A5');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',12);
		$pdf -> setXY(10,50);

		$pdf -> multicell(100,10,$clInfos,1);
		
		//bon de commande
		$pdf->SetFont('Arial','',11);
		$x = 10;
		$y = $pdf -> getY()+10;
		$w = 20;
		$pdf -> rect($x,$y+10,$w,$x,1);				
		$pdf -> rect($x+20,$y+10,$w+30,$x,1);		
		$pdf -> rect($x+70,$y+10,$w,$x,1);		
		$pdf -> rect($x+90,$y+10,$w+15,$x,1);



		$pdf -> Cell($x+10,$y-30,'Numero',0,0,'C');
		$pdf -> Cell($x+40,$y-30,'Designation',0,0,'C');
		$pdf -> Cell($x+10,$y-30,'Quantite',0,0,'C');
		$pdf -> Cell($x+25,$y-30,'Prix',0,2,'C');



		$req = mysqli_query($cnx,"SELECT * FROM stock a LEFT JOIN detail d ON a.id_produit=d.id_produit
								WHERE id_command={$_SESSION['id_comm']}");
		$x = 10;
		$w = 20;
		$h = 10;
		$n = 0;
		$total = 0;
		while($tdet = mysqli_fetch_assoc($req)) {
			$n++;
			$pdf -> setX($x);
			$pdf -> cell($x+10,$h,$n,1,0,'C');
			$pdf -> cell($x+40,$h,$tdet['label'],1,0,'C');
			$pdf -> cell($x+10,$h,$tdet['quantite'],1,0,'C');
			$pdf -> cell($x+25,$h,"{$tdet['prix']} Dh",1,1,'C');
			$total += $tdet['prix']*$tdet['quantite'];
		}

		$pdf->SetFont('Arial','B',12);
		$pdf -> cell($x+80,$h,"Total : ",1,0,'C');
		$pdf -> cell($x+25,$h,"$total Dh",1,2,'C');
		$pdf -> Output();
		
?>