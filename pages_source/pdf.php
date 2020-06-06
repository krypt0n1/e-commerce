<?php
	require('pdf/fpdf.php');

  $date = date("Y-m-d");

  $pdf = new FPDF('P','mm','A4');
  $pdf -> Addpage();
  $pdf -> setFont('Arial','B',14);
  $pdf -> setXY(10,50);

  $pdf -> Image('img/hero-1.jpg',17,10,20);
  $pdf -> cell(180,-70,"$date",0,1,'R');
  $pdf -> Ln(30);
  
  $pdf -> Ln(20);
  $pdf -> multicell(120,10," Information du Client :\n Nom : BOUZIANE mohamed wadii\n Email : wadii.bouziane2001@gmail.com.com\n Tel : 0675559660",1,2);

  $pdf -> cell(185,40,"Details commandes :",0,2,'C');

  $pdf -> setFillColor(255,255,255);

  $pdf -> cell(30,10,"Ordre",1,0,'C',1);
  $pdf -> cell(60,10,"Description",1,0,'C',1);
  $pdf -> cell(30,10,"Prix",1,0,'C',1);
  $pdf -> cell(30,10,"Quantite",1,0,'C',1);
  $pdf -> cell(40,10,"Montant",1,1,'C',1);

  $pdf -> cell(30,10,"1",1,0,'C');
  $pdf -> cell(60,10,"Razer Nari",1,0,'C');
  $pdf -> cell(30,10,"1800 Dh",1,0,'C');
  $pdf -> cell(30,10,"2",1,0,'C');
  $pdf -> cell(40,10,"3600 Dh",1,1,'C');

  $pdf -> cell(30,10,"2",1,0,'C');
  $pdf -> cell(60,10,"Alienware Helios 300",1,0,'C');
  $pdf -> cell(30,10,"21000 Dh",1,0,'C');
  $pdf -> cell(30,10,"1",1,0,'C');
  $pdf -> cell(40,10,"21000 Dh",1,1,'C');

  $pdf -> cell(30,10,"3",1,0,'C');
  $pdf -> cell(60,10,"Steelseries Sensei 310",1,0,'C');
  $pdf -> cell(30,10,"550 Dh",1,0,'C');
  $pdf -> cell(30,10,"5",1,0,'C');
  $pdf -> cell(40,10,"2750 Dh",1,1,'C');

  $pdf -> Output();
?>	