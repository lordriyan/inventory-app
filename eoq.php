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
            <h1 class="h2">EOQ Calculator</h1>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="alpha_R">Banyak barang yang dibutuhkan</label>
                <input type="number" class="form-control" id="alpha_R" onchange="data_changed();" value="0" min="0">
                <small class="form-text text-muted">Banyak barang yang dibutuhkan dalam 1 tahun</small>
              </div>
              <div class="form-group">
                <label for="alpha_P">Harga barang per-unit</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>
                  <input type="number" class="form-control" id="alpha_P" onchange="data_changed();" value="0" min="0">
                  <small class="form-text text-muted fwidth">Harga pembeliaan barang per-unitnya</small>
                </div>
              </div>
              <div class="form-group">
                <label for="alpha_C">Biaya pesan</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>
                  <input type="number" class="form-control" id="alpha_C" onchange="data_changed();" value="0" min="0">
                  <small class="form-text text-muted fwidth">Biaya pemesanan setiap kali pesan</small>
                </div>
              </div>
              <div class="form-group">
                <label for="alpha_H">Biaya simpan</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>
                  <input type="number" class="form-control" id="alpha_H" onchange="data_changed();" value="0" min="0">
                  <small class="form-text text-muted fwidth">Biaya simpan per-unit per-tahun</small>
                </div>
              </div>
              <div class="form-group">
                <label for="alpha_K">Biaya Backorder (Optional)</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>
                  <input type="number" class="form-control" id="alpha_K" onchange="data_changed();" value="0" min="0">
                  <small class="form-text text-muted">Backorder terjadi ketika permintaan pelanggan tidak dapat dipenuhi dari persediaan yang ada dan pelanggan menyetujui untuk menunggu pengiriman pesanan tersebut</small>
                </div>
              </div>
              <div class="form-group">
                <label for="alpha_L">Tenggang waktu</label>
                <div class="input-group mb-3">
                  <input type="number" class="form-control" id="alpha_L" onchange="data_changed();" value="0" min="0">
                    <select class="form-control" id="alpha_L_scale" onchange="data_changed();">
                      <option>Hari</option>
                      <option>Minggu</option>
                      <option>Bulan</option>
                    </select>
                </div>
              </div>
              <div class="form-group">
                <label for="alpha_N">Lama perusahaan beroperasi dalam 1 tahun</label>
                <div class="input-group mb-3">
                  <input type="number" class="form-control" id="alpha_N" onchange="data_changed();" value="0" min="0">
                    <select class="form-control" id="alpha_N_scale" onchange="data_changed();">
                      <option>Hari</option>
                      <option>Minggu</option>
                      <option>Bulan</option>
                    </select>
                </div>
              </div>
            </div>
            <div class="col-md-7">
              <h5>Result</h5>
              <hr>
              <div id="result">
                <canvas id="myChart" width="400" height="200"></canvas>
                <hr>
                <table>
                  <tr><th>Jumlah pemesanan</th><td> : <span id="q"></span></td></tr>
                  <tr><th>Jumlah unit maksimum backorder</th><td> : <span id="j"></span></td></tr>
                  <tr><th>Jumlah unit maksimum persediaan</th><td> : <span id="m"></span></td></tr>
                  <tr><th>Total biaya</th><td> : <span id="tc"></span></td></tr>
                  <tr><th>Frekuensi pemesanan</th><td> : <span id="f"></span></td></tr>
                  <tr><th>Interval pemesanan</th><td> : <span id="v"></span></td></tr>
                  <tr><th>Titik pemesanan kembali</th><td> : <span id="b"></span></td></tr>
                </table>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
    <?php include_once('inc/foot.php'); ?>
    <script src="assets/js/eoq.js"></script>
</body>
</html>