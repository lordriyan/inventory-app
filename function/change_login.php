<?php include_once("../core.php");

    if (isset($_POST['opasstxt'])) {
        $q1 = $db->query("SELECT * FROM tb_setting");
        $oldpass = $q1->fetch_assoc()['login_password'];
        $op = md5($_POST['opasstxt']);
        if ($oldpass == $op) {
            // Update login
            $pass = md5($_POST['npasstxt']);
            $uname = $_POST['usrname'];
            $db->query("UPDATE tb_setting SET login_username = '".$uname."', login_password = '".$pass."'");
            header('location:../settings.php?suc=Login telah diperbaharui');
        } else {
            header('location:../settings.php?err=Password lama tidak cocok');
        }

    }