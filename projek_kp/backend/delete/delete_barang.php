<?php
    include("../../config.php");
    session_start();

    $id = $_GET['id'];

    $sql = "DELETE FROM data_barang WHERE id='$id'";
    $query = mysqli_query($conn, $sql) or die ("Tidak ada database");

    if($query){
        echo"<script>alert('Hapus Barang sukses!')</script>";
        echo "<script>top.location='../../dashboard/dasboard_barang.php'</script>";
    }else{
        echo"<script>alert('Hapus Barang gagal!')</script>";
        echo "<script>top.location='../../dasboard_barang.php'</script>";
    }
?>