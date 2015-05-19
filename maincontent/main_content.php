<?php
    session_start();
    include 'login.php';
    $m = $_GET['m'];
    $a = $_GET['a'];
    if (isset($m))
    {
        switch($m)
        {
            default :
                LoginSessionCheck();
            break;
            
            case "CheckLogin" :
                CheckLogin();
            break;
            
            case "Logout" :
                Logout();
            break;
        }
    }
    else
    {
        LoginSessionCheck();
    }
?>