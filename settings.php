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
            <h1 class="h2">Settings</h1>
            <?= (isset($_GET['err'])) ? "<h6 class='text-danger'>".$_GET['err']."<h6>" : "";?>
            <?= (isset($_GET['suc'])) ? "<h6 class='text-success'>".$_GET['suc']."<h6>" : "";?>
          </div>
          <h4>Security</h4>
          <h6>Login configuration</h6>
          <form action="function/change_login.php" method="post">
          <div class="form-group">
            <label for="usrname">New Username</label>
            <input type="text" class="form-control" name="usrname" id="usrname">
          </div>
          <div class="form-group">
            <label for="npasstxt">New Password</label>
            <input type="password" class="form-control" name="npasstxt" id="npasstxt">
          </div>
          <div class="form-group">
            <label for="opasstxt">Old Password</label>
            <input type="password" class="form-control" name="opasstxt" id="opasstxt">
          </div>
          <button type="submit" class="btn btn-outline-secondary">Save</button>
          </form>
          <hr>
        </main>
      </div>
    </div>
    <?php include_once('inc/foot.php'); ?>
</body>
</html>
