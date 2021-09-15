<?php
    include('../../config.php');

    $nama=$_POST['nama'];
    $tanggal=$_POST['tanggal'];
    $email=$_POST['email'];
    $no_hp=$_POST['no_hp'];

    $sql = "INSERT INTO data_barang(nama, tanggal, email, no_hp)VALUES('$nama','$tanggal','$email','$no_hp')";
    $query=mysqli_query($conn,$sql);
    if($query){
        echo "<script>alert('Insert Barang Sukses!!!')</script>";
        echo "<script>top.location='../../dashboard/dasboard_barang.php'</script>";
    }else{
        echo "<script>alert('Insert Barang Gagal!!!')</script>";
        echo "<script>top.location='../../dashboard/dasboard_barang.php'</script>";
    }
?>