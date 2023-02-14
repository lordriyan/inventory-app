<?php error_reporting(0);

    $db = mysqli_connect("localhost", "root", "", "db_sisven");
    $err = explode(" ",mysqli_connect_error());
    if($err[0]){
        session_destroy();
        switch ($err[0]) {
            case 'No':
                $errno = "SQL: Server mysqlnya keliatannya belum hidup";
                break;
            case 'php_network_getaddresses:':
                $errno = "SQL: Hmm.. Ada masalah dengan hostname sqlnya";
                break;
            case 'Access':
                $errno = "SQL: Login sqlnya salah keknya deh";
                break;
            case 'Unknown':
                $errno = "SQL: Aduh.. databasenya gak ketemu :(";
                break;
            default:
                $errno = "SQL: Yahh.. ada error, tapi aku gak tau masalahnya apa :(";
                break;
        }
    } else {
        session_start();
        $errno = "Login required";
    }
    $url = basename($_SERVER['PHP_SELF']);

    if (!isset($_SESSION['user'])) {
        if ($url != "index.php") {
            header('location:index.php');
        }
    } else {
        if ($url == "index.php") {
            header('location:dashboard.php');
        }
    }
?>