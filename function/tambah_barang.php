<?php include_once("../core.php");

    if (isset($_POST['nmbrg']) and isset($_POST['sat'])) {
        $nmbrg = mysqli_escape_string($db, $_POST['nmbrg']);
        $sat = mysqli_escape_string($db, $_POST['sat']);

        $sql = "INSERT INTO tb_barang(nama, satuan) VALUES('".$nmbrg."','".$sat."')";

        $db->query($sql);
    }

    header('location:../data_barang.php');