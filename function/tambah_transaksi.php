<?php include_once("../core.php");

    if (isset($_POST['idbrg'])) {
        $idbrg = (int)$_POST['idbrg'];
        $tgl = $_POST['tgl'];
        $jnstrans = (string)$_POST['jnstrans'];
        $jml = (int)$_POST['jml'];
        $hrg = (int)$_POST['hrg'];

        $db->query("INSERT INTO tb_transaksi(id_barang, tgl, jenis, jumlah, hrg_punit)
                    VALUES('".$idbrg."', '".$tgl."', '".$jnstrans."', '".$jml."', '".$hrg."')");
    }

    header('location:../persediaan.php?id_barang='.$idbrg);
    