<?php include_once("../core.php");

    if (isset($_POST['inputUsername']) and isset($_POST['inputPassword'])) {
        $user = mysqli_real_escape_string($db, $_POST['inputUsername']);
        $pass = md5(mysqli_real_escape_string($db, $_POST['inputPassword']));

        $q = $db->query("SELECT * FROM tb_setting WHERE login_username = '".$user."' AND login_password = '".$pass."' LIMIT 1");
        if($q->num_rows > 0){
            $_SESSION['user'] = true;
            header('location:../dashboard.php');
        } else {
            header('location:../index.php');
        }
    }