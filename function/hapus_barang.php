<?php include_once("../core.php");

    $id = (isset($_GET['id_barang'])) ? (int)$_GET['id_barang'] : false;

    if($id){
        $db->query("DELETE FROM tb_barang WHERE id = '".$id."'");
        $db->query("DELETE FROM tb_transaksi WHERE id_barang = '".$id."'");
    }
    header('location:../data_barang.php');