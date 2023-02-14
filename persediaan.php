<?php include_once("core.php"); 
$id_barang = (isset($_GET['id_barang'])) ? (int)$_GET['id_barang'] : "";
$method = (isset($_GET['method'])) ? $_GET['method'] : "";?>
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
          <?php 
              $c1 = $db->query("SELECT * FROM tb_barang WHERE id = '".$id_barang."'");
              if ($c1->num_rows < 1) :?>
              <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Stock</h1>
              </div>
                <h5>Silahkan pilih barang di menu <i><b>Inventory</b></i> untuk melihat persediaan.</h5>
          <?php else : ?>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Stock</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
            <div class="dropdown">
                  <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Metode PPA</button>
                  <div class="dropdown-menu " aria-labelledby="triggerId">
                      <a class="dropdown-item" href="persediaan.php?id_barang=<?= $id_barang ?>">None</a>
                      <a class="dropdown-item" href="persediaan.php?id_barang=<?= $id_barang ?>&method=fifo">First In - First Out (FIFO)</a>
                      <a class="dropdown-item" href="persediaan.php?id_barang=<?= $id_barang ?>&method=lifo">Last In - First Out (LIFO)</a>
                      <a class="dropdown-item" href="persediaan.php?id_barang=<?= $id_barang ?>&method=average">Weight Average</a>
                  </div>
              </div>
              <div class="btn-group mr-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#modelId">
                  <span data-feather="plus-circle"></span> Tambah Transaksi
                </button>
                <!-- Modal -->
                <form action="function/tambah_transaksi.php" method="post">
                  <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title">Tambah Transaksi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <div class="modal-body">
                          <div class="container-fluid">
                            <div class="form-group">
                              <input type="hidden" class="form-control" name="idbrg" value="<?= $id_barang ?>">
                            </div>
                            <div class="form-group">
                              <label for="tgl">Tanggal</label>
                              <input type="date" class="form-control" name="tgl" id="tgl">
                            </div>
                            <div class="form-group">
                              <label for="jnstrans">Jenis Transaksi</label>
                              <select class="form-control" name="jnstrans" id="jnstrans">
                                <option>Persediaan Awal</option>
                                <option>Pembelian</option>
                                <option>Penjualan</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="jml">Jumlah</label>
                              <input type="number" class="form-control" name="jml" id="jml" min="0">
                            </div>
                            <div class="form-group">
                              <label for="hrg">Harga per unit</label>
                              <input type="number" class="form-control" name="hrg" id="hrg" min="0">
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
          <?php
            $jpa = 0;
            $sat = "";
            $q = $db->query("SELECT * FROM tb_transaksi t INNER JOIN tb_barang b ON t.id_barang = b.id WHERE id_barang = '".$id_barang."'");
            while($row = $q->fetch_assoc()){
              $jpa = ($row['jenis'] == "Penjualan") ? $jpa - $row['jumlah'] : $jpa + $row['jumlah'];
              $sat = $row['satuan'];
            }
            unset($q);
            if($method):
          ?>
          <table>
            <tr>
              <th>Medote</th><th>: <?= strtoupper($method);?></th>
            </tr>
            <tr>
              <th>JPA</th><th>: <?= $jpa ?> <?= $sat ?></th>
            </tr>
          </table>
          <br>
          <?php endif; ?>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Tanggal</th>
                  <th>Jenis Transaksi</th>
                  <th>Jumlah</th>
                  <th>Harga/Satuan</th>
                  <th>Total Harga</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                    $no = 0;
                    $t_jml = 0;
                    $t_hrg = 0;
                    $sat = "";
                    $order = ($method == "fifo") ? "DESC" : "ASC";

                    $q = $db->query("SELECT * FROM tb_transaksi t INNER JOIN tb_barang b ON t.id_barang = b.id WHERE id_barang = '".$id_barang."' ORDER BY tgl ".$order);
                    while($row = $q->fetch_assoc()){
                        if ((($method == "average") and ($row['jenis'] != "Penjualan")) or ($method == "") or (($method != "") and ($row['jenis'] != "Penjualan")) and ($t_jml < $jpa)) {
                            $no++;
                            $t_jml = ($row['jenis'] == "Penjualan") ? $t_jml - $row['jumlah'] : $t_jml + $row['jumlah'];
                            $sat = $row['satuan'];
                            $t_hrg = ($row['jenis'] == "Penjualan") ? $t_hrg - ($row['jumlah'] * $row['hrg_punit']) : $t_hrg + ($row['jumlah'] * $row['hrg_punit']) ;
                            if($method != "average" and ($method != "" and $t_jml > $jpa)){
                              $a = $t_jml - $jpa;
                              $row['jumlah'] = $row['jumlah']- $a;
                            }
                ?>
                <tr>
                  <td><?=$no?></td>
                  <td><?=$row['tgl']?></td>
                  <td><?=$row['jenis']?></td>
                  <td><?=$row['jumlah']?> <?=$sat?></td>
                  <td>Rp. <?=number_format($row['hrg_punit'],0,",",".")?> ,-</td>
                  <td>Rp. <?=number_format($row['jumlah'] * $row['hrg_punit'],0,",",".")?> ,-</td>
                  <td><a href="function/hapus_transaksi.php?id=<?=$row['id_trans']?>&idbrg=<?=$row['id']?>"><i class="material-icons text-danger">delete</i></a></td>
                </tr>
                <?php }} ?>
              </tbody>
              <tfoot>
                <tr>
                    <th></th>
                    <th colspan="2">Jumlah</th>
                    <th><?= ($method == "average") ? $t_jml : $jpa ?> <?=$sat?></th>
                    <th></th>
                    <th>Rp. <?=number_format($t_hrg,0,",",".")?> ,-</th>
                    <th></th>
                </tr>
              </tfoot>
            </table>
            <?php if($method == "average"):?>
              <b>NPA</b>&emsp;= ( Total Harga / Jumlah ) * JPA<br>
              &emsp;&emsp;&emsp;= ( Rp. <?= number_format($t_hrg,0,",",".") ?> ,- / <?= number_format($t_jml,0,",",".") ?> <?= $sat ?> ) * <?= $jpa ?> <?= $sat ?><br>
              &emsp;&emsp;&emsp;= <b>Rp. <?= number_format(($t_hrg / $t_jml) * $jpa,2,",",".") ?> ,-</b>
            <?php elseif($method != ""): ?>
              <b>NPA</b>&emsp;= <b>Rp. <?=number_format($t_hrg,0,",",".")?> ,-</b><br>
            <?php endif; ?>
          </div>
          <?php endif; ?>
        </main>
      </div>
    </div>
    <?php include_once('inc/foot.php'); ?>
</body>
</html>
