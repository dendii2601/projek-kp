<?php
    include("../../config.php");

    $id = $_POST["id"];
    
    $nama = $_POST["nama"];
    $tanggal = $_POST["tanggal"];
    $email = $_POST["email"];
    $no_hp = $_POST["no_hp"];
    

    $sql = "UPDATE data_barang SET nama='$nama', tanggal='$tanggal', email='$email', no_hp='$no_hp' WHERE id='$id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo"<script>alert('Update Sukses !!!')</script>";
        echo"<script>top.location='../../dashboard/dasboard_barang.php'</script>";
    }
    else{
        echo"<script>alert('Update Gagal !!!')</script>";
        echo"<script>top.location='../../dashboard/dasboard_barang.php'</script>";
    }
?>