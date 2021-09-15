<?php
    //koneksi ke database
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "kp";
     
    $conn = mysqli_connect($host, $user, $pass);
    if ($conn) {
    	$open = mysqli_select_db($conn,$db);
    	if (!$open) {
    		die ("Database tidak dapat dibuka ".mysqli_error());
    	}
    } else {
    	die ("Server MySQL tidak terhubung ".mysqli_error());
    }
    //akhir koneksi
     
    #ambil data di tabel dan masukkan ke array
   // $query = "SELECT * FROM transaksi JOIN konsumens ON transaksi.id_konsumen = konsumens.id JOIN peruqiyah ON transaksi.id_peruqiyah = peruqiyah.id ";
   $query = "SELECT * FROM data_barang";
    $sql = mysqli_query ($conn,$query);
    $data = array();
    while ($row = mysqli_fetch_assoc($sql)) {
    	array_push($data, $row);
    }
     
    #setting judul laporan dan header tabel
    $judul = "Laporan Data Order";
    $header = array(
    		array("label"=>"ID", "length"=>10, "align"=>"L"),
    		array("label"=>"Nama ", "length"=>30, "align"=>"L"),
    		array("label"=>"Tanggal", "length"=>40, "align"=>"L"),
            array("label"=>"Email", "length"=>30, "align"=>"L"),
            array("label"=>"No_Hp", "length"=>20, "align"=>"L"),
            
    	);
     
    #sertakan library FPDF dan bentuk objek
    require_once ("fpdf.php");
    $pdf = new FPDF();
    $pdf->AddPage();
     
    #tampilkan judul laporan
    $pdf->SetFont('Arial','B','16');
    $pdf->Cell(0,20, $judul, '0', 1, 'C');
     
    #buat header tabel
    $pdf->SetFont('Arial','','10');
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(255);
    $pdf->SetDrawColor(128,0,0);
    foreach ($header as $kolom) {
    	$pdf->Cell($kolom['length'], 5, $kolom['label'], 1, '0', $kolom['align'], true);
    }
    $pdf->Ln();
     
    #tampilkan data tabelnya
    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('');
    $fill=false;
    foreach ($data as $baris) {
    	$i = 0;
    	foreach ($baris as $cell) {
    		$pdf->Cell($header[$i]['length'], 5, $cell, 1, '0', $kolom['align'], $fill);
    		$i++;
    	}
    	$fill = !$fill;
    	$pdf->Ln();
    }
     
    #output file PDF
    ob_end_clean();
    $pdf->Output();
    ?>