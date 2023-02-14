<?php include_once("../core.php");

    $id = (isset($_GET['id'])) ? (int)$_GET['id'] : false;

    if ($id) {
        $db->query("DELETE FROM tb_transaksi WHERE id_trans = '".$id."'");
    }
    header('location:../persediaan.php?id_barang='.$_GET['idbrg']);