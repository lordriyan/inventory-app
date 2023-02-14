<?php include_once("core.php"); ?>
<!doctype html>
<html lang="en">
  <head>
    <?php include_once("inc/head.php") ?>
    <link href="assets/css/floating-labels.css" rel="stylesheet">
  </head>
  <body>
    <form class="form-signin" action="function/check_login.php" method="post">
      <div class="text-center mb-4">
        <h1 class="h3 mb-3 font-weight-normal">Sistem Inventory</h1>
        <p>Dikembangkan untuk memenuhi tugas akhir matakuliah sistem inventory.</p>
        <b class="text-danger"><?=$errno?></b>
      </div>
      <div class="form-label-group">
        <input type="text" id="inputUsername" name="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <label for="inputUsername">Username</label>
      </div>
      <div class="form-label-group">
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
        <label for="inputPassword">Password</label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted text-center"> &copy; 2019</p>
    </form>
  </body>
</html>