<?php include_once("core.php"); ?>
<!doctype html>
<html lang="en">
    <head>
    <?php include_once("inc/head.php"); ?>
    <link href="assets/css/dashboard.css" rel="stylesheet">
    </head>
  <body>
    <?php include_once("inc/header.php"); ?>
    <div class="container-fluid">
      <div class="row">
        <?php include_once("inc/nav.php"); ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Inventory</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#modelId">
                  <i class="material-icons">add</i> Tambah Barang
                </button>
                <!-- Modal -->
                <form action="function/tambah_barang.php" method="post">
                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Barang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="form-group">
                                          <label for="nmbrg">Nama Barang</label>
                                          <input type="text" class="form-control" name="nmbrg" id="nmbrg" placeholder="cth. Komputer">
                                        </div>
                                        <div class="form-group">
                                          <label for="sat">Satuan</label>
                                          <input type="text" class="form-control" name="sat" id="sat" placeholder="cth. unit, buah, meter">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Barang</th>
                  <th>Jumlah</th>
                  <th>Satuan</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              <?php
                $no = 0;
                $q1 = $db->query("SELECT * FROM tb_barang");
                while ($row = $q1->fetch_assoc()) {
                    $no++;
                    $jml = 0;
                    $q2 = $db->query("SELECT jumlah,jenis FROM tb_transaksi WHERE id_barang = ".$row['id']);
                    while ($r = $q2->fetch_assoc()) {
                        $jml = ($r['jenis'] != "Penjualan") ? $jml + $r['jumlah'] : $jml - $r['jumlah'];
                    }
              ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= $row['nama'] ?></td>
                  <td><?= $jml ?></td>
                  <td><?= $row['satuan'] ?></td>
                  <td>
                    <a data-toggle="tooltip" data-placement="left" title="Hapus" href="function/hapus_barang.php?id_barang=<?=$row['id']?>"><i class="material-icons text-danger">delete</i></a>
                    <a data-toggle="tooltip" data-placement="left" title="Liat detail persediaan" href="persediaan.php?id_barang=<?=$row['id']?>"><i class="material-icons">description</i></a>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>
    <?php include_once('inc/foot.php'); ?>
</body>
</html>
