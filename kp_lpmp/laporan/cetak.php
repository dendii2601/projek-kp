<?php
    //koneksi ke database
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "projek_kp";
     
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
   $query = "SELECT tb_barang.id_brg, tb_barang.tanggal, tb_barang.pengirim, tb_barang.jam, tb_barang.penerima FROM tb_barang";
    $sql = mysqli_query ($conn,$query);
    $data = array();
    while ($row = mysqli_fetch_assoc($sql)) {
    	array_push($data, $row);
    }
     
    #setting judul laporan dan header tabel
    $judul = "Laporan Data Barang";
    $header = array(
    		array("label"=>"ID", "length"=>10, "align"=>"L"),
    		array("label"=>"Tanggal ", "length"=>30, "align"=>"L"),
    		array("label"=>"Pengirim", "length"=>40, "align"=>"L"),
            array("label"=>"Jam", "length"=>30, "align"=>"L"),
            array("label"=>"Penerima", "length"=>20, "align"=>"L"),
            
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